import VueRouter from "vue-router";
import Bookable from "./bookables/Bookable";
import ExampleComponentTwo from "./components/ExampleComponent2";

const routes = [
    {
        path: "/",
        component: Bookable,
        name:"home"
    },
    {
        path: "/two",
        component: ExampleComponentTwo,
        name:"two"
    },
];

const router = new VueRouter({
    routes,
    mode:"history"
});

export default router;
