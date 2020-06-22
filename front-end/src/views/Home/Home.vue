<template>
  <div class="card home-card">
    <div class="card-header">
      <div class="row">
        <div class="col-12">Cliente: {{ $store.state.user ? $store.state.user.name : "" }}</div>
        <div class="col-12 d-flex">
          Saldo Atual:
          <money-format
            style="margin-left: 5px;"
            v-if="$store.state.user"
            :value="parseInt($store.state.user.accounts[0].balance, 10)"
            :locale="'pt-BR'"
            :currency-code="'BRL'"
            :subunit-value="true"
            :hide-subunits="false"
          >
          </money-format>
        </div>
      </div>
    </div>
    <div class="card-body">
      <h1>Ações</h1>
      <ul class="list-group">
        <router-link tag="li" class="list-group-item list-group-item-action" to="deposit">Depositar</router-link>
        <router-link tag="li" class="list-group-item list-group-item-action" to="withdraw">Sacar</router-link>
      </ul>
      <router-view />
    </div>
  </div>
</template>

<style scoped>
.list-group-item-action {
  cursor: pointer;
}
.home-card .list-group {
  margin-bottom: 15px;
}
</style>

<script>
import MoneyFormat from "vue-money-format";
export default {
  components: {
    "money-format": MoneyFormat,
  },
  methods: {
    goToDeposit() {
      this.$router.push("/deposit");
    },
    goToWithdraw() {
      this.$router.push("/withdraw");
    },
  },
};
</script>
