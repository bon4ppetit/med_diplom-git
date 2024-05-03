<script setup>

const props = defineProps({
    pathImage: String
});

</script>

<template>
    <img :src="'storage/' + pathImage">
</template>

<style scoped>

</style>
