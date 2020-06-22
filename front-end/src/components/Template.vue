<template>
  <div class="wrapper">
    <Navbar />
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">{{ $route.meta.description }}</h1>
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="container-fluid">
          <router-view />
        </div>
      </section>
    </div>
    <Footer />
  </div>
</template>

<script>
import Navbar from "./Navbar";
import Footer from "./Footer";
import api from "../api";

export default {
  components: {
    Navbar,
    Footer,
  },
  mounted() {
    this.checkUser();
  },
  methods: {
    async checkUser() {
      try {
        const user = await api.get(`/user`);
        console.log(user);
        this.$store.commit("setUser", user.data);
        this.$acl.change(["public", ...user.data.permissions]);
      } catch (error) {
        this.$router.push("/login");
      }
    },
  },
};
</script>
