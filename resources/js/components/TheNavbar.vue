<template>
  <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="/">Laravel Boolpress</a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-bs-controls="navbarSupportedContent"
        aria-bs-expanded="false"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav ms-auto"></ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" v-for="route in routes" :key="route.path">
            <!-- <a class="nav-link" @click="$router.push({name:'contacts.index'})"> Contatti </a> -->
            <router-link class="nav-link" :to="!route.path ? '/' : route.path">{{route.meta.linkText}}</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  </div>
</template>

<script>
export default {
    data() {
        return {
            routes: []
        }
    },
    mounted() {
        this.routes = this.$router.getRoutes();
    }
}
</script>

<style>

</style>