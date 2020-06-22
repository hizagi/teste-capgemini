<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <flash-message class="col-12" style="margin-bottom: 5px" transitionIn="animated swing"></flash-message>
        <h3 class="col-12 mb-10">Inserir valor do deposito</h3>
        <currency-input class="col-md-2 col-sm-3 ml-3" v-model="value" />
        <div class="col-md-3 col-sm-4">
          <button v-if="!loading" type="submit" class="btn btn-success btn-block" v-on:click="deposit()">Depositar</button>
          <button v-if="loading" type="submit" class="btn btn-secondary btn-block" disabled><i class="fa fa-spinner fa-spin"></i></button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.list-group-item-action {
  cursor: pointer;
}
.deposit-card {
  margin-top: 15px;
}
</style>

<script>
import api from "../../api";
export default {
  data: () => ({
    value: 0,
    loading: false,
  }),
  mounted() {},
  methods: {
    async deposit() {
      const currentAccount = this.$store.state.user.accounts[0];
      this.loading = true;
      if (!currentAccount) {
        return;
      }

      try {
        const result = await this.$swal.fire({
          title: `Tem certeza que deseja proseguir com a operação?`,
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: '<i class="fa fa-check"></i> Confirmar',
          cancelButtonText: '<i class="fa fa-times"></i> Cancelar',
          reverseButtons: true,
        });

        if (!result.value) {
          return;
        }

        await api.post(`accounts/${currentAccount.id}/deposit`, {
          value: this.value,
        });
        const user = await api.get(`/user`);
        console.log(user);
        this.$store.commit("setUser", user.data);
        this.$acl.change(["public", ...user.data.permissions]);
        this.loading = false;
        this.flash("Deposito efetuado com sucesso", "success", { timeout: 10000 });
      } catch (error) {
        if (error.response.data.errors && error.response.data.errors.value.length) {
          error.response.data.errors.value.forEach((error) => {
            this.flash(this.$t(error), "error", { timeout: 10000 });
          });
        } else if (error.response.data.message) {
          this.flash(this.$t(error.response.data.message), "error", { timeout: 10000 });
        } else {
          this.flash("Não foi possível sacar", "error", { timeout: 10000 });
        }
        this.loading = false;
      }
    },
  },
};
</script>
