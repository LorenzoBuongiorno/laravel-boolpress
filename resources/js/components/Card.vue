<template>
  <div class="col d-flex justify-content-center">
    <div class="card dark-theme" style="width: 18rem;">
        <img src="https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{post.title}}</h5>
            <p class="card-text">{{post.content}}</p>
            <router-link class="btn btn-link" :to="{ name:'posts.show', params: { post: post.slug } }">Dettagli</router-link>
        </div>
    </div>
  </div>
</template>

<script>
export default {
props: {
    post: Object,
  },
  
}
</script>

<style>

</style>