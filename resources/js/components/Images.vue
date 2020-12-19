<template>
    <div @keyup.esc="showModal = false">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div
                    class="mt-8"
                    v-for="image in backdrops"
                    @click="handleModalShowing(image.file_path)"
                >
                    <img
                        v-if="image.file_path"
                        :src="
                            'https://image.tmdb.org/t/p/w500' + image.file_path
                        "
                        alt="backdrop"
                        class="hover:opacity-75 transition ease-in-out duration-150"
                    />
                </div>
                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    v-show="showModal"
                >
                    <div
                        class="container mx-auto lg:px-32 rounded-lg overflow-y-auto"
                    >
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    class="text-3xl leading-none hover:text-gray-300"
                                    @click="showModal = false"
                                >
                                    &times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <img :src="imageInModal" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["backdrops"],

    data() {
        return {
            showModal: false,
            imageInModal: null
        };
    },

    methods: {
        handleModalShowing(image) {
            this.showModal = true;
            this.imageInModal = "https://image.tmdb.org/t/p/original" + image;
        }
    }
};
</script>
