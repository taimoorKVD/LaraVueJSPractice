<template>
    <div>
        <v-success v-if="success"> The review is successfully added. </v-success>
        <fatal-error v-if="error"> </fatal-error>
        <div v-if="!success && !error">
            <div class="row d-flex justify-content-center">
                <div :class="[{'col-md-4': twoColumns}, {'d-none': oneColumn}]">
                    <div class="card">
                        <div v-if="loading">
                            <p class="text-success">Please wait, data is loading...</p>
                        </div>
                        <div v-if="hasBooking">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5>Booking Information</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>
                                    Stayed at:
                                    <router-link :to="{name: 'bookable', params: { id: booking.bookable_id }}">
                                        {{ booking.bookable.title }}
                                    </router-link>
                                </p>
                                <p>
                                    From: {{ booking.from }} to: {{ booking.to }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div :class="[{'col-md-8': twoColumns}, {'col-md-8': oneColumn}]">
                    <div v-if="loading">
                        <p class="text-success">Please wait, data is loading...</p>
                    </div>
                    <div v-else>
                        <div class="card">
                            <div class="card-header">
                                <h6>Review Panel</h6>
                            </div>
                            <div v-if="alreadyReviewed">
                                <h5 class="text-info mt-3" align="center">You've already left a review for this booking.</h5>
                            </div>
                            <div v-else>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="rating" class="text-muted">Select the star rating (1 is worst - 5 is
                                            best)</label>
                                        <star-rating class="fa-3x" v-model="review.rating"></star-rating>
                                    </div>
                                    <div class="form-group">
                                        <label for="content" class="text-muted">Describe your experience with</label>
                                        <textarea cols="30" rows="10" name="content" class="form-control"
                                                  v-model="review.content" :class="[{ 'is-invalid': errorFor('content') }]"> </textarea>
                                        <v-error :errors="errorFor('content')"> </v-error>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-sm" @click.prevent="submit" :disabled="sending">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import { is404, is422 } from "../shared/utilities/response";
    import validationErrors from "../shared/mixins/ValidationErrors";

    export default {
        mixins:[validationErrors],
        name: "Review",

        data() {
            return {
                review: {
                    id: null,
                    rating: 5,
                    content: null,
                },
                existingReview: null,
                loading:false,
                sending:false,
                booking: null,
                error: false,
                success: false,
            };
        },

        async created() {
            this.review.id = this.$route.params.id;
            this.loading = true;

            try {
                this.existingReview = (await axios.get(`/api/reviews/${this.review.id}`)).data.data;
            } catch (err) {
                if (is404(err)) {
                    try {
                        this.booking = (await axios.get(`/api/booking-by-review/${this.review.id}`)).data.data;
                    } catch (err) {
                        this.error = !is404(err);
                    }
                } else {
                    this.error = false;
                }
            }
            this.loading = false;
        },

        computed: {
            alreadyReviewed() {
                return this.hasReview || !this.hasBooking;
            },

            hasReview() {
                return this.existingReview != null;
            },

            hasBooking() {
                return this.booking != null;
            },

            oneColumn() {
              return !this.loading && this.alreadyReviewed;
            },

            twoColumns() {
                return this.loading || !this.alreadyReviewed;
            },

        },

        methods:{
            submit() {
                this.errors = null;
                this.sending = true;
                this.success = false;
                axios
                    .post(`/api/reviews`, this.review)
                    .then(response => {
                        this.success = 201 === response.status;
                    })
                    .catch(err => {
                        if(is422(err)){
                            const errors = err.response.data.errors;
                            if(errors['content'] && 1 === _.size(errors)){
                                return this.errors = errors;
                            }
                        }
                        this.error = true;
                    })
                    .then(() => this.sending = false);
            },
        }

    }
</script>

<style scoped>
    textarea{
        resize:none;
    }
</style>
