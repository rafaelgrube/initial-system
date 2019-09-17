<template>
  <div class="flex flex-wrap">
    <div class="form-group md:px-2 md:w-1/2">
      <label class="form-label required" for="state">Estado</label>
      <select
        class="form-input"
        id="state"
        name="state"
        v-model="state"
        @change="getCities()"
        required
      >
        <option v-if="!loadingStates" value disabled selected>Selecione um estado</option>
        <option v-if="loadingStates" value disabled selected>Loading...</option>
        <option
          v-for="(st, index) in states"
          :key="`state${index}`"
          :value="st.nome"
          v-text="st.nome"
        ></option>
      </select>
    </div>

    <div class="form-group md:px-2 md:w-1/2">
      <label class="form-label required" for="city">Cidade</label>
      <select class="form-input" id="city" name="city" v-model="city" required>
        <option v-if="!loadingCities" value disabled selected>Selecione uma cidade</option>
        <option v-if="loadingCities" value disabled selected>Loading...</option>
        <option
          v-for="(ct, index) in cities"
          :key="`city${index}`"
          :value="ct.nome"
          v-text="ct.nome"
        ></option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    propCity: { defaul: "", type: String },
    propState: { defaul: "", type: String }
  },

  data() {
    return {
      city: "",
      cities: [],
      state: "",
      stateId: "",
      states: [],
      loadingCities: false,
      loadingStates: false
    };
  },

  mounted() {
    this.getStates();

    this.city = this.propCity;
    this.state = this.propState;
  },

  methods: {
    req() {
      let req = axios.create();

      delete req.defaults.headers.common["X-Requested-With"];
      delete req.defaults.headers.common["X-CSRF-TOKEN"];

      return req;
    },

    async getCities() {
      this.loadingCities = true;

      this.stateId = this.states.find(i => i.nome == this.state).id;

      const uri = `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${this.stateId}/municipios`;

      return await this.req()
        .get(uri)
        .then(({ data }) => {
          this.cities = data;
          this.loadingCities = false;
        })
        .catch(err => console.error(err.response.data));
    },

    async getStates() {
      this.loadingStates = true;

      const uri = `https://servicodados.ibge.gov.br/api/v1/localidades/estados`;

      return await this.req()
        .get(uri)
        .then(({ data }) => {
          this.states = data;
          this.loadingStates = false;

          if (this.state) {
            this.getCities();
            this.city = this.propCity;
          }
        })
        .catch(err => console.error(err.response.data));
    }
  }
};
</script>