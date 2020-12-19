<template>
    <div class="relative mt-3 md:mt-0" @keyup.esc="showResults = false">
        <input
            type="text"
            placeholder="Search"
            class="bg-gray-800 rounded-full w-64 px-4 py-1 pl-8 text-sm focus:outline-none focus:bg-gray-700"
            v-model="search"
            @input="getSearchResults()"
            @focus="showResults = true"
        />
        <div class="absolute top-0">
            <svg
                class="fill-current w-4 text-gray-500 mt-1.5 ml-2"
                viewBox="0 0 24 24"
            >
                <path
                    class="heroicon-ui"
                    d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"
                />
            </svg>
        </div>
        <div
            class="animate-spin right-0 top-0 mr-4 mt-1.5 absolute"
            v-if="loading"
        >
            <svg class="fill-current w-4 text-gray-500" viewBox="0 0 24 24">
                <path
                    class="opacity-75"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                />
            </svg>
        </div>
        <div
            v-if="showResults"
            class="absolute bg-gray-800 rounded w-64 mt-4 text-sm z-50"
        >
            <ul>
                <li
                    class="border-b border-gray-700"
                    v-for="searchResult in searchResults"
                    :key="searchResult.id"
                    @click="clearSearchInput()"
                >
                    <router-link
                        v-if="searchResult.media_type == 'movie'"
                        :to="'/movies/' + searchResult.id"
                        class="hover:bg-gray-700 px-3 py-3 flex items-center"
                    >
                        <img
                            v-if="searchResult.poster_path"
                            :src="
                                'https://image.tmdb.org/t/p/w92' +
                                    searchResult.poster_path
                            "
                            :alt="searchResult.title"
                            class="w-8"
                        />
                        <img
                            v-else
                            :src="
                                'https://ui-avatars.com/api/?size=235&name=' +
                                    searchResult.title
                            "
                            :alt="searchResult.title"
                            class="w-8"
                        />
                        <span class="ml-4">{{ searchResult.title }}</span>
                    </router-link>
                    <router-link
                        v-if="searchResult.media_type == 'tv'"
                        :to="'/tv/' + searchResult.id"
                        class="hover:bg-gray-700 px-3 py-3 flex items-center"
                    >
                        <img
                            v-if="searchResult.poster_path"
                            :src="
                                'https://image.tmdb.org/t/p/w92' +
                                    searchResult.poster_path
                            "
                            :alt="searchResult.name"
                            class="w-8"
                        />
                        <img
                            v-else
                            :src="
                                'https://ui-avatars.com/api/?size=235&name=' +
                                    searchResult.name
                            "
                            :alt="searchResult.name"
                            class="w-8"
                        />
                        <span class="ml-4">{{ searchResult.name }}</span>
                    </router-link>
                    <router-link
                        v-if="searchResult.media_type == 'person'"
                        :to="'/actors/' + searchResult.id"
                        class="hover:bg-gray-700 px-3 py-3 flex items-center"
                    >
                        <img
                            v-if="searchResult.profile_path"
                            :src="
                                'https://image.tmdb.org/t/p/w92' +
                                    searchResult.profile_path
                            "
                            :alt="searchResult.name"
                            class="w-8"
                        />
                        <img
                            v-else
                            :src="
                                'https://ui-avatars.com/api/?size=235&name=' +
                                    searchResult.name
                            "
                            :alt="searchResult.name"
                            class="w-8"
                        />
                        <span class="ml-4">{{ searchResult.name }}</span>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            search: "",
            searchResults: null,
            loading: false,
            showResults: true
        };
    },

    methods: {
        getSearchResults() {
            if (this.search === "") {
                this.searchResults = null;
            } else {
                this.loading = true;
                axios
                    .get(
                        "https://api.themoviedb.org/3/search/multi?api_key=e5b8b1cee0be57366cc65b548a758cca&query=" +
                            this.search
                    )
                    .then(response => {
                        this.searchResults = response.data.results.slice(0, 10);
                        this.loading = false;
                    });
            }
            this.showResults = true;
        },

        clearSearchInput() {
            this.search = "";
            this.getSearchResults();
        }
    }
};
</script>
