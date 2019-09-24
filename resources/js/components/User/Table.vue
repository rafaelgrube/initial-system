<template>
  <div>
    <div class="flex flex-wrap space-between items-center w-100">
      <div class="flex-1 mb-3">
        <a
          href="/users/create"
          class="btn btn-outline-primary hover:shadow mr-2"
          role="button"
        >Novo Usuário</a>

        <select
          name="field"
          id="field"
          v-model="field"
          class="text-gray-700 text-sm bg-gray-300 rounded px-4 py-3 cursor-pointer leading-none w-32 h-10 mr-2"
          @change="order()"
        >
          <option value disabled selected>Ordernar Por</option>
          <option value="name">Nome</option>
          <option value="username">Login</option>
          <option value="email">Email</option>
        </select>
      </div>

      <div class="flex-1 text-right">
        <input
          type="search"
          v-model="filter"
          class="mb-3 text-gray-700 bg-gray-300 rounded px-4 py-3 leading-none w-64 h-10 ml-2 mb-3"
          placeholder="Buscar por"
          @keyup.enter="search()"
        />
      </div>
    </div>

    <div class="mb-4">
      <div class="table-responsive" v-if="users.length > 0">
        <table class="table table-sm bg-white shadow-md rounded">
          <thead class="bg-gray-300 text-gray-600">
            <th>Usuário</th>
            <th>Login</th>
            <th>Email</th>
            <th class="text-center">Ações</th>
          </thead>

          <tbody>
            <tr v-for="(user, index) in users" :key="`user${index}`">
              <td>{{ user.name }}</td>
              <td>{{ user.username }}</td>
              <td>{{ user.email }}</td>
              <td class="text-center w-px whitespace-no-wrap">
                <div class="flex items-center space-around justify-center">
                  <a
                    :href="`/users/${user.username}/edit`"
                    class="text-blue-600 hover:text-blue-700"
                    role="button"
                  >Editar</a>
                  <span class="mx-2">/</span>
                  <span
                    class="text-red-600 hover:text-red-700"
                    role="button"
                    @click="destroy(user.username)"
                  >Desativar</span>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-else class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
        <h5 class="font-bold">Nenhum usuário encontrado</h5>
        <p v-if="this.field">Não foram encontrados usuários com esse termo.</p>
        <p v-else>Não foram encontrados usuários.</p>
      </div>
    </div>
  </div>
</template>

<script>
import { async } from "q";

export default {
  props: ["propUsers"],

  data() {
    return {
      field: "",
      filter: "",
      users: this.propUsers
    };
  },

  methods: {
    async destroy(username) {
      const uri = `/users/${username}`;

      return await axios
        .delete(uri)
        .then(({ data }) => {
          this.users = data;
          this.$bus.$emit("my-alert", {
            message: "Usuário desativado com sucesso",
            type: "success"
          });
        })
        .catch(err => console.error(err.response.data));
    },

    async search() {
      this.field = "";

      const uri = `/users/search`;

      return await axios
        .get(uri, {
          params: {
            filter: this.filter
          }
        })
        .then(({ data }) => (this.users = data))
        .catch(err => console.error(err.response.data));
    },

    order() {
      this.users = _.sortBy(this.users, this.field);
    }
  }
};
</script>