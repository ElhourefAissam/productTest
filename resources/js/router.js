import Router from "vue-router";
import Vue from "vue";
Vue.use(Router);

const routes = [
    {
        path: "/product",
        name: "product",
        component: () => import("./components/product/listing.vue")
    }
];

export default new Router({
    mode: "history",
    routes
});
