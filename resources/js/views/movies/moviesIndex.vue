<template>
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2
                class="uppercase tracking-wider text-lg text-yellow-500 font -semibold"
            >
                popular movies
            </h2>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8"
            >
                <div class="mt-8" v-for="movie in popular" :key="movie.id">
                    <MovieCard :movie="movie" :genre="genre" />
                </div>
            </div>
        </div>
        <div class="now-playing-movies py-24">
            <h2
                class="uppercase tracking-wider text-yellow-500 text-lg font-semibold"
            >
                now playing
            </h2>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8"
            >
                <div class="mt-8" v-for="movie in now_playing" :key="movie.id">
                    <MovieCard :movie="movie" :genre="genre" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axiosWithApiUrl from "../../api";
import MovieCard from "../../components/MovieCard";

export default {
    components: { MovieCard },

    data() {
        return {
            popular: [],
            genre: [],
            now_playing: []
        };
    },

    mounted() {
        axiosWithApiUrl.get("/movies").then(response => {
            this.popular = response.data[0];
            this.genre = response.data[1];
            this.now_playing = response.data[2];
        });
    }
};
</script>
