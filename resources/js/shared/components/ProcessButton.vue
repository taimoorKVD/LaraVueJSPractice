<template>
    <div class="col-md-12">
        <button class="btn btn-secondary btn-block" @click="$parent.check" :disabled="value">
            <span v-if="!value">
                <slot> </slot>
            </span>
            <span v-if="value">
                <i class="fas fa-spinner fa-spin"> </i>
                Checking...
            </span>
        </button>
    </div>
</template>

<script>
    export default {
        name: "ProcessButton",

        props:{
            value: Boolean,
        }
    }
</script>

<style scoped>

</style>
