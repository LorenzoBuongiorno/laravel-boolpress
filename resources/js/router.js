import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home.vue";
import Errore from "./pages/Error.vue";
import Contacts from "./pages/Contacts.vue";
import PostShow from "./pages/posts/Show.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: "/",
            component: Home,
            name: "home.index",
            meta: {title: "Homepage", linkText: "Home"},
        },
        {
            path: "/contatti",
            component: Contacts,
            name: "contacts.index",
            meta: {title: "Contatti", linkText: "Contatti"},
        },
        {
            path: "/posts/:post",
            component: PostShow,
            name: "posts.show",
            meta: {title: "Dettagli Post"},
        },
        {
            path:"*",
            component: Errore,
            name: "error"
        }
    ],
});
export default router;