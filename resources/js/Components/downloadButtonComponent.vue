<script setup>
    defineProps({path:String})
</script>

<template>

    <a :href="path" class="download-btn">
        <i class="fa-solid fa-download fa-lg download-icon"></i>
    </a>

</template>

<style scoped>

    .download-btn{
        border: none;
        background-color: #ffffff00;
        cursor: pointer;
    }

    .download-icon{
        color:rgb(47, 194, 91);
    }

</style>