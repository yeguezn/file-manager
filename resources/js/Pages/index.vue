<script setup>
    import backParentFolderComponent from "../Components/backParentFolderComponent.vue"
    import createDirectoryComponent from "../Components/createDirectoryComponent.vue"
    import contentComponent from "../Components/contentComponent.vue"
    import fileUploadComponent from "../Components/fileUploadComponent.vue"
    import searchDirectoryComponent from "../Components/searchDirectoryComponent.vue"
    import modalComponent from "../Components/modalComponent.vue"
    import {ref} from "vue"
    import { Head } from "@inertiajs/vue3"

    defineProps({directoryContent:Array, path:String, errors:Object})

    const directoryModalVisible = ref(false)
    const fileModalVisible = ref(false)

    function checkCurrentPath(path){
        return path != 'public'
    }

    function checkErrorsValidationExists(errorsObj, inputName){
        return errorsObj[inputName]
    }

    function isEmpty(directoryContent){
        return directoryContent.length == 0
    }

    function directoryButtonToggle(flag){
        directoryModalVisible.value = flag
    }

    function fileButtonToggle(flag){
        fileModalVisible.value = flag
    }

    function getPageTitle(path){
        return path.split("-").pop()
    }

</script>

<template>

    <Head>
        <title>{{ getPageTitle(path) }}</title>
    </Head>

    <main>

        <searchDirectoryComponent>
            <div v-if="checkErrorsValidationExists(errors, 'directoryPath')" 
            class="directory-not-found">
                {{ errors.directoryPath }}
            </div>
        </searchDirectoryComponent>

        <button @click="directoryButtonToggle(true)">
            <i class="fa-solid fa-folder-plus fa-lg"></i>
            Create directory
        </button>

        <modalComponent v-if="directoryModalVisible" 
        @closeModal="(flag) => directoryButtonToggle(flag)">

            <createDirectoryComponent :currentPath="path">
                <div v-if="checkErrorsValidationExists(errors, 'directoryName')">
                    {{ errors.directoryName }}
                </div>
            </createDirectoryComponent>
            
        </modalComponent>

        <button @click="fileButtonToggle(true)">
            <i class="fa-solid fa-cloud-arrow-up fa-lg"></i>
            Upload file
        </button>

        <modalComponent v-if="fileModalVisible" :modalToggle="fileButtonToggle"
        @closeModal="(flag) => fileButtonToggle(flag)">

            <fileUploadComponent :currentPath="path">
                <div v-if="checkErrorsValidationExists(errors, 'newFile')">
                    {{ errors.newFile }}
                </div>
            </fileUploadComponent>

        </modalComponent>
        
        
        <backParentFolderComponent :currentPath="path" v-if="checkCurrentPath(path)"
        class="parent-folder-btn">
        </backParentFolderComponent>

        <div v-if="isEmpty(directoryContent)">
            <h1>No files yet</h1>
        </div>

        <div v-else class="content-container">
            <contentComponent :directoryContent="directoryContent">
            </contentComponent>
        </div>
    </main>

</template>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

    *{
        font-family: 'Poppins', sans-serif;
    }

    main{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color:#fff;
    }

    h1{
        text-align: center;
    }

    .directory-not-found{
        padding-left: 5px;
        padding-top: 0px;
    }

    button{
        margin-top: 20px;
        width: 350px;
        height: 35px;
        background-color: rgb(47, 194, 91);
        border: none;
        cursor:pointer;
        color: #fff;
        font-weight: 800;
    }

    .content-container{
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
        width:900px;
        margin-top: 60px;
    }

    @media screen and (max-width: 663px){

        .directory-not-found{
            text-align: center;
        }
    
    }

    @media screen and (max-width:565px){
        .content-container{

            display: flex;
            gap: 10px;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            width: 400px;
        }
    }

</style>