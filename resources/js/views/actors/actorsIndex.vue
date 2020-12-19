<template>
    <div class="container mx-auto px-4 py-16">
        <div class="popular-actors">
            <h2
                class="uppercase tracking-wider text-lg text-yellow-500 font -semibold"
            >
                popular actors
            </h2>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8"
            >
                <div class="actor mt-8" v-for="actor in actors">
                    <ActorCard :actor="actor" />
                </div>
            </div>
        </div>
        <div class="flex justify-between mt-16">
            <router-link
                v-show="this.$route.params.page > 1"
                :to="{
                    path:
                        '/actors/page/' +
                        (parseInt(this.$route.params.page) - 1)
                }"
                >Previous</router-link
            >
            <router-link
                v-show="this.$route.params.page < 500"
                :to="{
                    path:
                        '/actors/page/' +
                        (parseInt(this.$route.params.page) + 1)
                }"
                >Next</router-link
            >
        </div>
    </div>
</template>

<script>
import axiosWithApiUrl from "../../api";
import ActorCard from "../../components/ActorCard";

export default {
    components: {
        ActorCard
    },

    data() {
        return {
            actors: null
        };
    },

    mounted() {
        axiosWithApiUrl
            .get("/actors/page/" + this.$route.params.page)
            .then(response => {
                this.actors = response.data;
            });
    }
};
</script>
