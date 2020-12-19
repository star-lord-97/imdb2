<template>
    <div class="container mx-auto" v-if="movie">
        <div class="movie-info border-b border-gray-800">
            <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
                <div class="flex-none">
                    <img
                        :src="movie.poster_path"
                        :alt="movie.title + '\'s poster'"
                        class="w-64 md:w-96"
                    />
                </div>
                <div class="md:ml-24">
                    <h2 class="text-4xl font-semibold">
                        {{ movie.title }}
                    </h2>
                    <div
                        class="flex flex-wrap items-center text-gray-400 text-sm"
                    >
                        <svg
                            class="fill-current text-yellow-500 w-4"
                            viewBox="0 0 24 24"
                        >
                            <g data-name="Layer 2">
                                <path
                                    d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                                    data-name="star"
                                />
                            </g>
                        </svg>
                        <span class="ml-1">{{ movie.vote_average }}%</span>
                        <span class="mx-2">|</span>
                        <span>{{ movie.release_date }}</span>
                        <span class="mx-2">|</span>
                        <span v-for="(genre, index) in movie.genres">
                            {{ genre.name
                            }}<span v-if="index != movie.genres.length - 1"
                                >,&nbsp;
                            </span>
                        </span>
                    </div>
                    <p class="text-gray-300 mt-8">
                        {{ movie.overview }}
                    </p>
                    <div class="mt-12">
                        <h4 class="text-white font-semibold">Featured Cast</h4>
                        <div class="flex mt-4">
                            <div class="mr-8" v-for="crew in crewArray">
                                <div>{{ crew.name }}</div>
                                <div class="text-sm text-gray-400">
                                    {{ crew.job }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <TrailerModal :trailerLink="movie.youtube_link" />
                </div>
            </div>
        </div>
        <Cast :castArray="castArray" />
        <Images :backdrops="backdrops" />
    </div>
</template>

<script>
import axiosWithApiUrl from "../../api";
import Cast from "../../components/Cast";
import Images from "../../components/Images";
import TrailerModal from "../../components/TrailerModal";

export default {
    components: {
        Cast,
        Images,
        TrailerModal
    },

    data() {
        return {
            movie: null,
            crewArray: null,
            castArray: null,
            backdrops: null,
            showModal: false
        };
    },
    mounted() {
        axiosWithApiUrl
            .get("/movies/" + this.$route.params.id)
            .then(response => {
                this.movie = response.data;
                this.crewArray = response.data.credits.crew.slice(0, 5);
                this.castArray = response.data.credits.cast.slice(0, 5);
                this.backdrops = response.data.images.backdrops.slice(0, 6);
            });
    }
};
</script>

<style></style>
