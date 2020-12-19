import Vue from "vue";
import VueRouter from "vue-router";
import moviesIndex from "./views/movies/moviesIndex";
import movieShow from "./views/movies/movieShow";
import tvIndex from "./views/tv/tvIndex";
import tvShow from "./views/tv/tvShow";
import actorsIndex from "./views/actors/actorsIndex";
import actorShow from "./views/actors/actorShow";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        component: moviesIndex
    },

    {
        path: "/movies/:id",
        component: movieShow
    },

    {
        path: "/tv",
        component: tvIndex
    },

    {
        path: "/tv/:id",
        component: tvShow
    },

    {
        path: "/actors/page/:page",
        component: actorsIndex
    },

    {
        path: "/actors/:id",
        component: actorShow
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
