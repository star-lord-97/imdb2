<template>
    <div
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8"
        v-if="cast"
    >
        <div class="mt-4" v-for="show in cast">
            <router-link v-if="show.title" :to="{ path: '/movies/' + show.id }"
                ><img
                    :src="show.poster_path"
                    :alt="show.title + '\'s poster'"
                    class="hover:opacity-75 transition ease-in-out duration-150"
            /></router-link>
            <router-link v-if="show.name" :to="{ path: '/tv/' + show.id }"
                ><img
                    :src="show.poster_path"
                    :alt="show.name + '\'s poster'"
                    class="hover:opacity-75 transition ease-in-out duration-150"
            /></router-link>
            <router-link
                v-if="show.title"
                :to="{ path: '/movies/' + show.id }"
                class="text-sm leading-normal block text-gray-400 hover:text-white mt-1"
                >{{ show.title }}</router-link
            >
            <router-link
                v-if="show.name"
                :to="{ path: '/tv/' + show.id }"
                class="text-sm leading-normal block text-gray-400 hover:text-white mt-1"
                >{{ show.name }}</router-link
            >
        </div>
    </div>
</template>

<script>
export default {
    props: ["cast"]
};
</script>

<style></style>
