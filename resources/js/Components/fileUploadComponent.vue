<script setup>
    import { useForm } from "@inertiajs/vue3"

    defineProps({currentPath:String})

    const form = useForm({
        newFile:null
    })

    function uploadFile(currentPath){
        let formatedCurrentPath = currentPath.replace(/\//g, '-')
        form.post('/upload-file/' + formatedCurrentPath)
    }

</script>

<template>
    <form @submit.prevent="uploadFile(currentPath)">

        <div class="input">
            <label for="fileId">Upload file</label>
            <input type="file" @input="form.newFile = $event.target.files[0]"
            class="input-file" id="fileId">
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
            </progress>
            <slot></slot>
        </div>

        <div>
            <input type="submit" value="upload file" class="button">
        </div>
    </form>

</template>

<style scoped>

    form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 400px;
        gap: 20px;
        color:#000;
    }

    .input{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;    
    }

    .input-file{
        width: 400px;
        height: 30px;
    }   

    label{
        position: absolute;
        right: 310px;
        top: -25px;
    }

    .button{
        margin-top: 20px;
        width: 150px;
        height: 35px;
        background-color: rgb(47, 194, 91);
        border: none;
        cursor:pointer;
        color: #fff;
        font-weight: 800;
        transition: .3s ease;
    }

    .button:hover{
        transform: scale(0.9);
    }

    @media screen and (max-width:580px){

        label{
            position: absolute;
            right: 320px;
            top: -25px;
        }

        .input-file{
            margin-left: 140px;
        }
    
    }

</style>