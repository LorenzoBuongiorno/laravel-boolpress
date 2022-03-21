<template>
<div>
    <header>
        <TheNavbar></TheNavbar>
    </header>
    <div class="main-page">
        BOOL BLOG
    </div>
    <div class="container py-4 d-flex flex-column align-items-center">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            
               <Card v-for="post of posts" :key="post.id" :post="post"></Card>
            
        </div>

        <div aria-label="Page navigation example">
            <ul class="pagination p-4">
                <li class="page-item btn p-0"><a class="page-link" @click="fetchPosts(pagination.current_page - 1)">Previous</a></li>
                <li class="page-item btn p-0" v-for="page in pagination.last_page" :key="page"><a class="page-link" @click="fetchPosts(page)">{{page}}</a></li>
                <li class="page-item btn p-0"><a class="page-link" @click="fetchPosts(pagination.current_page + 1)">Next</a></li>
            </ul>
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
      pagination: {}
    };
  },
  methods: {
      async fetchPosts(page = 1) {

          if(page < 1){
              page = 1;
          }

          if(page > this.pagination.last_page){
              page = this.pagination.last_page;
          }


          const resp = await axios.get("/api/posts?page=" + page);
            this.pagination = resp.data;
            this.posts = resp.data.data;
        
      },

  },
  mounted() {
    this.fetchPosts();
  },
}
</script>

<style>

</style>