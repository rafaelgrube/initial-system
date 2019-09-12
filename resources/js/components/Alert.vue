<template></template>

<script>
import iziToast from "izitoast";

require("../../../node_modules/izitoast/dist/css/iziToast.min.css");

export default {
  props: ["propMessage", "propType"],

  data() {
    return {
      message: this.propMessage,
      type: this.propType
    };
  },

  created() {
    this.$bus.$on("my-alert", ({ message, type }) => {
      this.message = message;
      this.type = type;
    });

    this.show();
  },

  watch: {
    message(message) {
      if (message !== "") {
        this.show();
      }
    }
  },

  methods: {
    show() {
      if (this.message && this.type) {
        iziToast.show({
          message: this.message,
          title: this.type === "success" ? "Sucesso" : "Erro",
          color: this.type === "success" ? "green" : "red",
          position: "bottomRight"
        });

        this.message = this.type = "";
      }
    }
  }
};
</script>