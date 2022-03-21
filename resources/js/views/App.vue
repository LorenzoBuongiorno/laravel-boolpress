<template>
<div>
    <header>
        <TheNavbar></TheNavbar>
    </header>
    <div class="main-page">
        BOOL BLOG
    </div>
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            
               <Card v-for="post of posts" :key="post.id" :post="post"></Card>
            
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
import TheNavbar from "../components/TheNavbar.vue";
import Card from "../components/Card.vue";

export default {
      components: {TheNavbar, Card },
  data() {
    return {
      posts: [],
    };
  },
  methods: {
      fetchPosts() {
          axios.get("/api/posts")
          .then(resp => {
              this.posts = resp.data;
          });
      }

  },
  mounted() {
    this.fetchPosts();
  },
}
</script>

<style>

</style>