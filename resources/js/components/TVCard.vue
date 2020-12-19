<template>
    <div v-if="show">
        <router-link :to="{ path: '/tv/' + show.id }">
            <img
                :src="show.poster_path"
                :alt="show.name + '\'s poster'"
                class="hover:opacity-75 transition ease-in-out duration-150"
            />
        </router-link>
        <div class="mt-2">
            <router-link
                :to="{ path: '/tv/' + show.id }"
                class="text-lg mt-2 hover:text-gray-300"
                >{{ show.name }}</router-link
            >
            <div class="flex items-center text-gray-400 text-sm mt-1">
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
                <span class="ml-1">{{ show.vote_average }}%</span>
                <span class="mx-2">|</span>
                <span>{{ show.first_air_date }}</span>
            </div>
            <span
                class="text-gray-400 text-sm"
                v-for="(genre_id, index) in show.genre_ids"
                :key="genre_id"
            >
                {{ genre[genre_id]
                }}<span v-if="index != show.genre_ids.length - 1">,</span>
            </span>
        </div>
    </div>
</template>

<script>
export default {
    props: ["show", "genre"]
};
</script>
