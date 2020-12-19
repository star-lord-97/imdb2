<template>
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tv">
            <h2
                class="uppercase tracking-wider text-lg text-yellow-500 font -semibold"
            >
                popular tv shows
            </h2>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8"
            >
                <div class="mt-8" v-for="show in popular">
                    <TVCard :show="show" :genre="genre" />
                </div>
            </div>
        </div>
        <div class="top-rated-shows py-24">
            <h2
                class="uppercase tracking-wider text-yellow-500 text-lg font-semibold"
            >
                top rated tv shows
            </h2>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8"
            >
                <div class="mt-8" v-for="show in top_rated">
                    <TVCard :show="show" :genre="genre" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axiosWithApiUrl from "../../api";
import TVCard from "../../components/TVCard";

export default {
    components: { TVCard },

    data() {
        return {
            popular: [],
            genre: [],
            top_rated: []
        };
    },

    mounted() {
        axiosWithApiUrl.get("/tv").then(response => {
            this.popular = response.data[0];
            this.genre = response.data[1];
            this.top_rated = response.data[2];
        });
    }
};
</script>
