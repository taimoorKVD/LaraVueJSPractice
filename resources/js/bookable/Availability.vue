<template>
    <div>
        <h6 class="text-secondary text-uppercase font-weight-bold">
            Check Availability
            <transition>
                <span v-if="noAvailability" class="text-danger">(Not Available)</span>
                <span v-if="hasAvailability" class="text-success">(Available)</span>
            </transition>
        </h6>
        <div class="form-row">
            <div class="col-md-6 form-group">
                <label for="from">From</label>
                <input type="date" name="from" v-model="from"
                       class="form-control form-control-sm" placeholder="Start Date"
                       @keyup.enter="check" :class="[{'is-invalid': errorFor('from')}]"
                >
                <v-error :errors="errorFor('from')"> </v-error>
            </div>
            <div class="col-md-6 form-group">
                <label for="to">To</label>
                <input type="date" name="to" v-model="to"
                       class="form-control form-control-sm" placeholder="End Date"
                       @keyup.enter="check" :class="[{ 'is-invalid' : errorFor('to') }]"
                >
                <v-error :errors="errorFor('to')"> </v-error>
            </div>
            <process-button :value="loading"> Check </process-button>
        </div>
    </div>
</template>

<script>
    import { is422 } from "../shared/utilities/response";
    import validationErrors from "../shared/mixins/ValidationErrors";

    export default {
        mixins:[validationErrors],
        name: "Availability",

        props: {
            bookableId: [String, Number],
        },

        data() {
            return {
                from: this.$store.state.lastSearch.from,
                to: this.$store.state.lastSearch.to,
                loading: false,
                status: null,
            };
        },

        methods: {
            async check() {
                this.loading = true;
                this.errors = null;

                this.$store.dispatch('setLastSearch', {
                    from: this.from,
                    to: this.to
                });

                try {
                    this.status = (await axios.get(`/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`)).status;
                    this.$emit("availability", this.hasAvailability);
                } catch (error) {
                    if (is422(error)) {
                        this.errors = error.response.data.errors;
                    }
                    this.status = error.response.status;
                    this.$emit("availability", this.hasAvailability);
                }
                this.loading = false;
            },
        },

        computed: {
            hasErrors(){
                return 422 === this.status && this.errors != null;
            },

            hasAvailability(){
                return 200 === this.status;
            },

            noAvailability(){
                return 404 === this.status;
            }

        },
    }
</script>

<style scoped>
    label {
        font-size: 0.7em;
        text-transform: uppercase;
        color:gray;
        font-weight:bolder;
    }
    .is-invalid{
        /*border-color:#b22222;*/
        background-image:none;
    }
    .invalid-feedback{
        /*color:#b22222;*/
    }
</style>
