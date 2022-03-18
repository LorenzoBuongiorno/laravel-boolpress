<template>
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col" v-for="post in posts" :key="post.id">
                <div class="card" style="width: 18rem;">
                    <img src="https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{post.title}}</h5>
                        <p class="card-text">{{post.content}}</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
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