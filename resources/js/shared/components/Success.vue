<template>
    <div class="text-center success">
        <i class="fas fa-thumbs-up"> </i>
        <h1 class="mt-4">Successfully reviewed.</h1>
        <h6>
            <slot> </slot>
        </h6>
    </div>
</template>

<script>
    export default {
        name: "Success"
    }
</script>

<style scoped>
    .success{
        color: #999;
        font-size: 10rem;
    }
</style>
