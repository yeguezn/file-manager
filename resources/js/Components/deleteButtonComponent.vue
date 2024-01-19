<script setup>
    import { Link } from '@inertiajs/vue3'
    defineProps({path:String})
</script>

<template>

    <Link :href="path" method="delete" as="button" class="delete-btn">
        <i class="fa-solid fa-trash fa-lg delete-icon"></i>
    </Link>

</template>

<style scoped>

    .delete-btn{
        border: none;
        cursor: pointer;
        background-color: #ffffff00;
    }

    .delete-icon{
        color: #e01b24;
    }

</style>