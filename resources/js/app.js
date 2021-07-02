require('./bootstrap');

import moment from "moment";
import VueRouter from "vue-router";
import Vuex from "vuex";
import router from "./routes";
import Index from "./index";
import StarRating from "./shared/components/StarRating";
import FatalError from "./shared/components/FatalError";
import ValidationError from "./shared/components/ValidationError";
import Success from "./shared/components/Success";
import ProcessButton from "./shared/components/ProcessButton";
import StoreDefinition from "./store";

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.filter("fromNow", value => moment(value).fromNow());

Vue.component("star-rating", StarRating);
Vue.component("fatal-error", FatalError);
Vue.component("v-error", ValidationError);
Vue.component("v-success", Success);
Vue.component("process-button", ProcessButton);

const store = new Vuex.Store(StoreDefinition);

const app = new Vue({
    el: '#app',
    router,
    store,
    components:{
        'index': Index
    },
    beforeCreate() {
      this.$store.dispatch("loadStoredState");
    },
});
