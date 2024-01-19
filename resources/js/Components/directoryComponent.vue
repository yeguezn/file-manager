<script setup>
import { Link } from '@inertiajs/vue3'
import deleteButtonComponent from './deleteButtonComponent.vue'
defineProps({fullPath:String})

function formatDirectoryPath(fullPath){
    return fullPath.replace(/\//g, '-')
}

function getFullDirectoryName(fullPath){
    return fullPath.split('/').pop()
}

function getShortDirectoryName(fullPath){
    let directoryName = getFullDirectoryName(fullPath)
    return directoryName.slice(0, 10) + "..."
}

function checkDirectoryNameLength(fullPath){
    let directoryName = getFullDirectoryName(fullPath)
    return directoryName.length < 20

}

function deleteDirectoryRoute(fullPath){

    let directoryPath = formatDirectoryPath(fullPath)
    return `/delete-directory/${directoryPath}`

}


</script>

<template>
    <Link :href="formatDirectoryPath(fullPath)" class="container">
        <div>
            <i class="fa-solid fa-folder fa-2xl icon-color"></i>
        </div>

        <div>
            <p v-if="checkDirectoryNameLength(fullPath)">{{ getFullDirectoryName(fullPath) }}</p>
            <p v-else>{{ getShortDirectoryName(fullPath) }}</p>
        </div>

        <div class="delete-btn-container">
            <deleteButtonComponent :path="deleteDirectoryRoute(fullPath)">
            </deleteButtonComponent>
        </div>

    </Link>
</template>

<style scoped>
    .container{
        width: 250px;
        height: 50px;
        background-color: #fff;
        border-radius:10px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 10px;
        padding-left: 20px;
        position: relative;
        color: black;
        text-decoration: none;
    }

    .delete-btn-container{
        position: absolute;
        right:20px;
    }

    .icon-color{
        color: rgb(56, 96, 180);
    }


</style>