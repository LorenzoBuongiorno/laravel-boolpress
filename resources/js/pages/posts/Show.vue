<template>
  <div class="p-4">
    <div class="show-card card dark-theme col-10 m-auto">
        <div class="card-body">
            <h5 class="card-title fs-1">{{post.title}}</h5>
            <img :src="post.coverImg" alt="">
            <h6 class="card-subtitle mb-2 text-muted fs-4">{{post.category.type}}</h6>
            <p class="card-text fs-3">{{post.content}}</p>
        </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            post: {}
        }
    },
    methods: {
        async fetchPost() {
            try {
                const resp = await axios.get("/api/posts/" + this.$route.params.post);
                this.post = resp.data;
            } catch (er) {
            this.$router.replace({name: "error"});
        }
    }
    },
    mounted() {
        this.fetchPost();
    }
}
</script>

<style>

</style>