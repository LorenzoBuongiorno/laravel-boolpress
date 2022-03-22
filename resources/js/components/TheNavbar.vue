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
          <li class="nav-item">
            <a class="nav-link" href="/login" v-if="!user">Login</a>
            <a class="nav-link" href="/admin" v-else>{{user.name}}</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  </div>
</template>

<script>
import Axios from 'axios';
export default {
    data() {
        return {
            routes: [],
            user: null,
        }
    },
    methods: {
      fetchUser() {
        Axios.get("/api/user").then((resp) => {
          this.user = resp.data;
        }).catch((er) => {
          console.error("non loggato");
        });
      }
      },
    mounted() {
      this.routes = this.$router.getRoutes().filter((route) => !!route.meta.linkText);
    this.fetchUser();
    
    }
}
</script>

<style>

</style>