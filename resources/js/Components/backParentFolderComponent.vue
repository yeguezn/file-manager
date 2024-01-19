<script setup>
    import { Link } from '@inertiajs/vue3';
    defineProps({currentPath:String})
</script>

<template>
   <Link :href="'/parent-directory/' + currentPath">
        <button>
            <i class="fa-solid fa-arrow-up"></i>
            Go to parent directory
        </button>
    </Link>
</template>

<style scoped>

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

    button{
        margin-top: 20px;
        width: 350px;
        height: 35px;
        font-family: 'Poppins', sans-serif;
        background-color: rgb(56, 96, 180);
        border: none;
        cursor:pointer;
        color: #fff;
        font-weight: 800;
    }

</style>