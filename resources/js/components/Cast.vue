<template>
    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8"
            >
                <div class="mt-8" v-for="cast in castArray">
                    <router-link :to="{ path: '/actors/' + cast.id }">
                        <img
                            v-if="cast.profile_path"
                            :src="
                                'https://image.tmdb.org/t/p/w300' +
                                    cast.profile_path
                            "
                            :alt="cast.name"
                            class="hover:opacity-75 transition ease-in-out duration-150"
                        />
                        <img
                            v-else
                            :src="
                                'https://ui-avatars.com/api/?size=235&name=' +
                                    cast.name
                            "
                            :alt="cast.name"
                            class="hover:opacity-75 transition ease-in-out duration-150"
                        />
                    </router-link>
                    <div class="mt-2">
                        <router-link
                            :to="{ path: '/actors/' + cast.id }"
                            class="text-lg mt-2 hover:text-gray:300"
                        >
                            {{ cast.name }}
                        </router-link>
                        <div class="text-sm text-gray-400">
                            {{ cast.character }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["castArray"]
};
</script>

<style></style>
