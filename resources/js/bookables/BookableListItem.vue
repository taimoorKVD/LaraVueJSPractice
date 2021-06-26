<template>
    <div class="card">
        <div class="card-header">
            <h1 align="center">{{ title }}</h1>
        </div>
        <div class="card-body">
            <p>{{ content }}</p>
            <p>{{ price }}</p>
        </div>
        <div class="card-footer">
            <button class="btn btn-success btn-sm"> Get</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BookableListItem",
        props: {
            'title':String,
            'content': String,
            'price': Number
        },
        mounted(){
            console.log(this.title);
        },
    };
</script>

<style scoped>

</style>
