<script setup>
    import fileComponent from "../Components/fileComponent.vue"
    import directoryComponent from "../Components/directoryComponent.vue"

    defineProps({directoryContent:Array})

    //mime types
    const imageExtensionPattern = /\.(gif|jpe?g|png)$/i
    const videoExtensionPattern = /\.(mp4)$/i
    const textExtensionPattern = /\.(txt|pdf|docx)$/i

    function isTextFile(path){
        return textExtensionPattern.test(path)
    }

    function isVideoFile(path){
        return videoExtensionPattern.test(path)
    }

    function isImageFile(path){
        return imageExtensionPattern.test(path)
    }

    function isDirectory(path){
        return !isTextFile(path) && !isVideoFile(path)
            && !isImageFile(path)

    }

</script>

<template>
    <div v-for="path in directoryContent">

        <div v-if="isTextFile(path)" class="file">
            <fileComponent :path="path">
                <div>
                    <i class="fa-solid fa-file-lines fa-2xl mime-type-icon-color"></i>
                </div>
            </fileComponent>
        </div>

        <div v-if="isVideoFile(path)" class="file">

            <fileComponent :path="path">
                <div>
                    <i class="fa-solid fa-film fa-2xl mime-type-icon-color"></i>
                </div>
            </fileComponent>

        </div>

        <div v-if="isImageFile(path)" class="file">
            <fileComponent :path="path">
                <div>
                    <i class="fa-solid fa-file-image fa-2xl mime-type-icon-color"></i>
                </div>
            </fileComponent>
        </div>

        <div v-if="isDirectory(path)" class="file">
            <directoryComponent class="file" :fullPath="path">
            </directoryComponent>
        </div>
            
    </div>

</template>

<style scoped>
    .file{
        margin-top:20px;
    }

    .mime-type-icon-color{
        color: rgb(56, 96, 180);
    }

</style>