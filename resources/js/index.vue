<template>
<div>

    <nav class="navbar bg-light">
        <router-link :to="{ name: 'home' }" class="navbar-brand mr-auto"> Laravel SPA </router-link>

        <router-link :to="{ name: 'home'}" class="btn btn-default"> Home </router-link>
        <router-link :to="{ name: 'two'}" class="btn btn-default"> Contact </router-link>
    </nav>

    <div class="container mt-4 mb-4 pr-4 pl-4">
        <router-view> </router-view>
    </div>

</div>

</template>

<script>
    export default {
        name: "index"
    }
</script>

<style scoped>

</style>
