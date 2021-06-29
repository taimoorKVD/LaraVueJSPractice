<template>
    <div>

        <div v-if="loading">
            <p class="text-success">Please wait, data is loading...</p>
        </div>
        <div v-else>
            <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                <div class="col d-flex align-item-stretch" v-for="(bookable, column) in bookablesInRow(row)" :key="'row' + row + column">
                    <bookable-list-item v-bind="bookable">
                    </bookable-list-item>
                </div>
                <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
            </div>
        </div>

    </div>
</template>

<script>
import BookableListItem from "./BookableListItem";
    export default {
        name: "Bookable",
        components: {
            BookableListItem
        },

        data(){
          return {
              bookables: null,
              loading: false,
              columns: 3,
          };
        },

        computed: {
            rows() {
                return this.bookables != null ? Math.ceil(this.bookables.length / this.columns) : 0;
            }
        },

        methods: {
            bookablesInRow(row) {
                return this.bookables.slice((row - 1) * this.columns, row * this.columns);
            },

            placeholdersInRow(row) {
                return this.columns - this.bookablesInRow(row).length;
            },
        },

        created() {
            // console.log('created.');
            this.loading = true;

            // *** static data for testing *** //
            // setTimeout(() => {
            //     this.bookables = [
            //         {
            //             'title': 'Laravel 7.0',
            //             'content': 'Content will be uploaded soon!'
            //         },
            //         {
            //             'title': 'Code Igniter 1.0',
            //             'content': 'Content might be uploaded soon!'
            //         },
            //         {
            //             'title': 'Code Igniter 2.0',
            //             'content': 'Content might be uploaded soon!'
            //         },
            //         {
            //             'title': 'Code Igniter 3.0',
            //             'content': 'Content might be uploaded soon!'
            //         },
            //         {
            //             'title': 'Wordpress 3.0',
            //             'content': 'Content might be uploaded soon!'
            //         },
            //         {
            //             'title': 'JQuery & ajax',
            //             'content': 'Content might be uploaded soon!'
            //         },
            //         {
            //             'title': 'Javascript',
            //             'content': 'Content might be uploaded soon!'
            //         },
            //         ];
            //     this.loading = false;
            // },1000);

            const promise = new Promise((resolve, reject) => {
                // console.log(resolve);
                // console.log(reject);
                setTimeout(() => resolve("Testing"), 3000);
            })
                .then(result => console.log(`Success ${result}`))
                .then(result => result)
                .catch(result => console.log('Error', result));
            // console.log(promise);

            // *** dynamic data for testing *** //
            const request = axios.get('/api/bookables').then(response => {
               this.bookables = response.data;
               this.loading = false;
            });
        }
    };
</script>

<style scoped>

</style>
