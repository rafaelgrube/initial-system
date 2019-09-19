<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-outline-primary hover:shadow"
      data-toggle="modal"
      data-target="#userCompanies"
    >Empresas do Usuário</button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="userCompanies"
      tabindex="-1"
      role="dialog"
      aria-labelledby="userCompaniesTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="userCompaniesTitle">Associar Empresas ao Usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Actions -->
            <div class="form-group">
              <span class="btn-link mr-2" role="button" @click.prevent="attachAll()">Associar todos</span>
              <span
                class="btn-link mr-2"
                role="button"
                @click.prevent="detachAll()"
              >Desassociar todos</span>
            </div>

            <!-- Filter -->
            <div class="form-group">
              <input
                type="search"
                v-model="filter"
                class="form-input"
                placeholder="Buscar por"
                maxlength="128"
                aria-label="search"
              />
            </div>

            <!-- Companies -->
            <div class="form-check" v-for="(company, index) in filtered" :key="`company${index}`">
              <input
                class="form-check-input"
                type="checkbox"
                :id="`company${index}`"
                :checked="UserHasThisCompany(company.id)"
                @click.prevent="toggleCompany(company.id)"
              />
              <label class="form-check-label" :for="`company${index}`">{{ company.name }}</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    companies: { type: Array, required: true },
    user: { type: Object, required: true }
  },

  data() {
    return {
      filter: "",
      userCompanies: this.user.companies
    };
  },

  computed: {
    filtered() {
      const companies = this.companies;
      const filter = this.filter;

      if (filter) {
        return companies.filter(el => el.name.includes(filter));
      }

      return companies;
    }
  },

  methods: {
    async attachAll() {
      const uri = `/users/${this.user.login}/companies/attach-all`;

      return await axios
        .post(uri)
        .then(({ data }) => {
          this.userCompanies = data;
          this.$bus.$emit("my-alert", {
            message: "Usuário atualizado com sucesso",
            type: "success"
          });
        })
        .catch(({ response }) => console.error(response.data));
    },

    async detachAll() {
      const uri = `/users/${this.user.login}/companies/detach-all`;

      return await axios
        .post(uri)
        .then(({ data }) => {
          this.userCompanies = data;
          this.$bus.$emit("my-alert", {
            message: "Usuário atualizado com sucesso",
            type: "success"
          });
        })
        .catch(({ response }) => console.error(response.data));
    },

    async toggleCompany(companyId) {
      const uri = `/users/${this.user.login}/companies`;

      return await axios
        .post(uri, { company_id: companyId })
        .then(({ data }) => {
          this.userCompanies = data;

          this.$bus.$emit("my-alert", {
            message: "Usuário atualizado com sucesso.",
            type: "success"
          });
        })
        .catch(({ response }) => console.error(response.data));
    },

    UserHasThisCompany(companyId) {
      return this.userCompanies.find(i => i.id === companyId);
    }
  }
};
</script>