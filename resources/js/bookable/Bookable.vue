<template>
    <div>
        <div v-if="loading">
            <p class="text-success">Please wait, data is loading...</p>
        </div>
        <div v-else>
            <div class="row">
                <div class="col-md-8 pb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 align="center">{{ bookable.title }}</h5>
                        </div>
                        <div class="card-body">
                            <article> {{ bookable.description }}</article>
                        </div>
                    </div>

                    <review-list :bookable-id="this.$route.params.id"> </review-list>

                </div>
                <div class="col-md-4 pb-4">
                    <availability :bookable-id="this.$route.params.id"> </availability>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import Availability from "./Availability";
    import ReviewList from "./ReviewList";

    export default {
        name: "Bookable",

        components: {
            Availability,
            ReviewList
        },

        data() {
            return {
                bookable: null,
                loading:false,
            }
        },

        created() {
            this.loading = true;
            axios.get(`/api/bookables/${this.$route.params.id}`)
            .then(
                response => {
                    this.bookable = response.data;
                    this.loading = false;
                }
            );
        },
    }
</script>

<style scoped>

</style>
