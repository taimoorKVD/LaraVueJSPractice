<template>
<div>

    <nav class="navbar bg-light">
        <router-link :to="{ name: 'home' }" class="navbar-brand mr-auto"> Laravel SPA </router-link>

    </nav>

    <div class="container mt-4 mb-4 pr-4 pl-4">
        <router-view> </router-view>
    </div>

</div>

</template>

<script>
    import { mapState } from "vuex";
    export default {
        name: "index",

        data() {
            return {
                lastSearch: this.$store.state.lastSearch,
            }
        },

        computed:{
            ...mapState({
               lastSearchComputed: "lastSearch"
            }),
        },
    }
</script>

<style scoped>

</style>
