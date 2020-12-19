<template>
    <div id="vueApp" class="bg-gray-900 text-white">
        <Navbar />
        <router-view :key="$route.path" />
    </div>
</template>

<script>
import Navbar from "./components/Navbar";

export default {
    components: {
        Navbar
    }
};
</script>

<style>
#vueApp {
    font-family: "Work Sans", sans-serif;
}
</style>
