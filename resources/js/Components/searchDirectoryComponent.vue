<script setup>
    import { router } from "@inertiajs/vue3"
    import {reactive} from "vue"

    const form = reactive({
        directoryPath:null
    })

    function submitForm(){
        router.post("/search-directory", form)
    }

</script>

<template>
    <form @submit.prevent="submitForm">
        <div class="form-container">
            <div class="input-container">
                <label for="searchId">Search a directory</label>
                <input type="text" v-model="form.directoryPath" id="searchId"
                placeholder="example: public/directory/..." class="input-directory">
            </div>
            <div>
                <input type="submit" value="search" class="search-btn">
            </div>
        </div>

        <slot></slot>

    </form>

</template>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

    *{
        font-family: 'Poppins', sans-serif;
    }

    .form-container{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        height: 100px;
        gap: 20px;
        margin-top:50px;
        margin-left: 80px;
    }

    form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .input-container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;    
    }

    .input-directory{
        width: 400px;
        height: 30px;
        outline: none;
    }

    label{
        position: absolute;
        right: 255px;
        top: -25px;
    }

    .search-btn{
        height: 35px;
        width: 75px;
        background-color: rgb(47, 194, 91);
        border: none;
        cursor:pointer;
        color: #fff;
        font-weight: 1000;
        transition: .3s ease;
    }

    .search-btn:hover{
        transform: scale(0.90);
    }

    @media screen and (max-width: 580px){
        .form-container{
            display: flex;
            flex-direction: column;
            margin-left:20px;
        }
    }

    @media screen and (max-width: 424px){

        .input-directory{
            width: 350px;
        }

        form{
            padding-right: 20px;
        }
    
        label{
            position: absolute;
            right: 100px;
            top: -25px;
        }
    }

</style>