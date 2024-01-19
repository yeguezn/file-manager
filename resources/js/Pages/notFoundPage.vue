<script setup>
    import {Link} from "@inertiajs/vue3"
    import {Head} from "@inertiajs/vue3"
</script>

<template>
    <Head>
        <title>Resource not found</title>
    </Head>
   <div class="container">
        <h1>Resourse not found</h1>
        <Link href="/" class="button">
            Go back
        </Link>
   </div>

</template>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
    
    h1{
        color:#fff;
        font-family: 'Poppins', sans-serif;
    }

    .container{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height:100vh;
        flex-direction: column;
    }

    .button{
        margin-top: 20px;
        width: 100px;
        height: 35px;
        background-color: rgb(47, 194, 91);
        border: none;
        cursor:pointer;
        color: #fff;
        font-weight: 800;
        text-align: center;
        text-decoration: none;
        padding-top: 5px;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }

</style>