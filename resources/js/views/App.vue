<template>
<div>
    <header>
        <TheNavbar></TheNavbar>
    </header>
    <main>
        <router-view></router-view>
    </main>
</div>
</template>

<script>
import TheNavbar from "../components/TheNavbar.vue";


export default {
      components: {TheNavbar},
  
}
</script>

<style>

</style>