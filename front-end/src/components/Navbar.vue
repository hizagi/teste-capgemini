<template>
  <div class="header-container">
    <div class="login-logo">
      <router-link to="/"><img height="60px" src="../assets/Logo-Capgemini-2018.jpg"/></router-link>
      <a><b>BANCO</b> CAPGEMINI</a>
    </div>
    <div class="logout" v-if="hasToken">
      <button type="submit" v-on:click="$store.dispatch('logout')" class="btn btn-danger btn-block">Sair</button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      hasToken: false,
    };
  },
  mounted() {
    this.checkToken();
  },
  methods: {
    checkToken() {
      this.hasToken = !!localStorage.getItem(this.$store.state.TOKEN_KEY);
    },
  },
};
</script>
<style scoped>
.header-container {
  display: flex;
  justify-content: space-between;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
  margin-bottom: 10px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
.logout {
  margin-top: 5px;
}
</style>
