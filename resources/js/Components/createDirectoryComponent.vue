<script setup>
    import { router } from "@inertiajs/vue3"
    import {reactive} from "vue"

    defineProps({currentPath:String})

    const form = reactive({
        directoryName:null
    })

    function submitForm(currentPath){
        router.post("/new-directory/" + currentPath, form)
    }

</script>

<template>
    <form @submit.prevent="submitForm(currentPath)">
        <div class="input">
            <label for="newDirectoryId">Create a new directory</label>
            <input type="text" name="directoryName" id="newDirectory" 
            v-model="form.directoryName" class="input-directory">
            <slot></slot>
        </div>
        <input type="submit" value="Create" class="button">
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

    .input-directory{
        width: 400px;
        height: 30px;
    }

    label{
        position: absolute;
        right: 220px;
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

    @media screen and (max-width: 580px){
        form{
            margin-left:50px;
        }

        .input-directory{
            width: 250px;
        }

        label{
            position: absolute;
            right: 40px;
            top: -25px;
        }
    }

</style>