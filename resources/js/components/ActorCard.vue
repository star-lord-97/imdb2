<template>
    <div v-if="actor">
        <router-link :to="{ path: '/actors/' + actor.id }">
            <img
                :src="actor.profile_path"
                :alt="actor.name + '\'s image'"
                class="hover:opacity-75 transition ease-in-out duration-150"
            />
        </router-link>
        <div class="mt-2 flex-row">
            <router-link
                :to="{ path: '/actors/' + actor.id }"
                class="block text-lg hover:text-gray-300 mt-2"
                >{{ actor.name }}</router-link
            >
            <span
                class="text-sm text-gray-400"
                v-for="(show, index) in actor.known_for"
            >
                <router-link
                    v-if="show.media_type == 'movie'"
                    :to="{ path: '/movies/' + show.id }"
                    >{{ show.title
                    }}<span v-if="index != actor.known_for.length - 1"
                        >,&nbsp;
                    </span></router-link
                >
                <router-link
                    v-else-if="show.media_type == 'tv'"
                    :to="{ path: '/tv/' + show.id }"
                    >{{ show.name
                    }}<span v-if="index != actor.known_for.length - 1"
                        >,&nbsp;
                    </span></router-link
                >
            </span>
        </div>
    </div>
</template>

<script>
export default {
    props: ["actor"]
};
</script>

<style></style>
