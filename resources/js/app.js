require('./bootstrap');

import moment from "moment";
import VueRouter from "vue-router";
import router from "./routes";
import Index from "./index";
import StarRating from "./shared/components/StarRating";
import FatalError from "./shared/components/FatalError";
import ValidationError from "./shared/components/ValidationError";
import Success from "./shared/components/Success";

window.Vue = require('vue');

Vue.use(VueRouter);

Vue.filter("fromNow", value => moment(value).fromNow());

Vue.component("star-rating", StarRating);
Vue.component("fatal-error", FatalError);
Vue.component("v-error", ValidationError);
Vue.component("v-success", Success);

const app = new Vue({
    el: '#app',
    router,
    components:{
        'index': Index
    },
});
