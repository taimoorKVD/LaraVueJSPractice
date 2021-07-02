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
                    <availability :bookable-id="this.$route.params.id"
                                  @availability="checkPrice($event)" class="mb-4"> </availability>
                    <transition>
                        <price-breakdown v-if="price" :price="price" class="mb-4"> </price-breakdown>
                    </transition>
                    <transition>
                        <button class="btn btn-outline-secondary btn-block" v-if="price">Book</button>
                    </transition>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import Availability from "./Availability";
    import ReviewList from "./ReviewList";
    import PriceBreakdown from "./PriceBreakdown";
    import { mapState } from "vuex";

    export default {
        name: "Bookable",

        components: {
            Availability,
            ReviewList,
            PriceBreakdown
        },

        data() {
            return {
                bookable: null,
                loading:false,
                price: null,
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

        computed: mapState({
            lastSearch: "lastSearch"
        }),

        methods: {
          async checkPrice(hasAvailability) {
              if(!hasAvailability)
              {
                  this.price = null;
                  return;
              }

              try {
                this.price = (await axios.get(`/api/bookables/${this.bookable.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`)).data.data;
              } catch (err) {
                  this.price = null;
              }
          },
        },
    }
</script>

<style scoped>

</style>
