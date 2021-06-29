<template>
    <div class="card w-100">
        <div class="card-header">
            <router-link :to="{ name: 'bookable', params: { id } }">
                <h5 align="center">{{ title }}</h5>
            </router-link>
        </div>
        <div class="card-body">
            <p>{{ description }}</p>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <router-link :to="{ name: 'bookable', params: { id } }">
                <button class="btn btn-success btn-sm"> Get</button>
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BookableListItem",
        props: {
            'title':String,
            'description': String,
            'id': Number
        },
        mounted(){
            // console.log(this.title);
        },
    };
</script>

<style scoped>

</style>
