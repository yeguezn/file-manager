<script setup>
import deleteButtonComponent from './deleteButtonComponent.vue'
import downloadbuttonComponent from './downloadButtonComponent.vue'
defineProps({path:String})

function getFullFileName(path){
    return path.split('/').pop()
}

function getShortFileName(path){
    let fileName = getFullFileName(path)
    return fileName.slice(0, 10) + "..."
}

function checkFileNameLength(path){
    let fileName = getFullFileName(path)
    return fileName.length < 20
}

function deleteFileRoute(path){
    let formatedPath = path.replace(/\//g, "-")
    return `/delete-file/${formatedPath}`
}

function downloadFileRoute(path){
    let formatedPath = path.replace(/\//g, "-")
    return `/download-file/${formatedPath}`
}

</script>

<template>
    <div class="container">
        <!--This slot is for the file mime type icon-->
        <slot></slot>

        <div>
            <p v-if="checkFileNameLength(path)">{{ getFullFileName(path) }}</p>
            <p v-else>{{ getShortFileName(path) }}</p>
        </div>

        <div class="download-btn-container">
            <downloadbuttonComponent :path="downloadFileRoute(path)">

            </downloadbuttonComponent>
        </div>

        <div class="delete-btn-container">

            <deleteButtonComponent :path="deleteFileRoute(path)">

            </deleteButtonComponent>

        </div>
    </div>
</template>

<style scoped>
    .container{
        width: 250px;
        height: 50px;
        border-radius:10px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 10px;
        padding-left: 20px;
        position: relative;
        background-color: #fff;
        color: black;
    }

    .delete-btn-container{
        position: absolute;
        right:10px;
    }

    .download-btn-container{
        position: absolute;
        right:45px;
    }

</style>