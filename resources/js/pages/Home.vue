<template>
  <div class="container py-4 d-flex flex-column align-items-center">
      <div class="main-page">
            BOOLPRESS
      </div>
      <div class="fs-1 m-4 spinner-border text-danger" style="width: 5rem; height: 5rem;" role="status" v-if="loading">
        <span class="visually-hidden">Loading...</span>
      </div>
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
</template>

<script>
import axios from "axios";
import Card from "../components/Card.vue";

export default {
    components: {Card},
data() {
    return {
      posts: [],
      pagination: {},
      loading: true,
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

          try {
            const resp = await axios.get("/api/posts?page=" + page);
              this.pagination = resp.data;
              this.posts = resp.data.data;
              // console.log(this.posts);

          } catch (er) {
        console.log(er);
      } finally {
        setTimeout(() => {
          this.loading = false;
        }, 1000);
      }
      },

  },
  mounted() {
    this.fetchPosts();
  },
}
</script>

<style>

</style>