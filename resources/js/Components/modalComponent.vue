<script setup>

</script>

<template>

    <div class="modal">


        <div class="modal-content">
            <div class="modal-header">
              <span class="close" @click="$emit('closeModal', false)">
                &times;
              </span>
            </div>
            <div class="modal-body">
              <slot></slot>
            </div>
        
        </div>

    </div>


</template>

<style scoped>

  .modal {
    display: block; 
    position: fixed;
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4); 
    -webkit-animation-name: fadeIn; 
    -webkit-animation-duration: 0.4s;
    animation-name: fadeIn;
    animation-duration: 0.4s;
    display:flex;
    justify-content: center;
    padding-top: 40px;  
  }

  .modal-content {
    background-color: #fefefe;
    width: 100%;
    -webkit-animation-name: slideIn;
    -webkit-animation-duration: 0.4s;
    animation-name: slideIn;
    animation-duration: 0.4s;
    width: 600px;
    height: 300px;
    border-radius: 20px;
  }

  .close {
    color: rgb(0, 0, 0);
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }

  .modal-header {
    padding: 2px 16px;
  }

  @-webkit-keyframes slideIn {
    from {bottom: -300px; opacity: 0} 
    to {bottom: 0; opacity: 1}
  }

  @keyframes slideIn {
    from {bottom: -300px; opacity: 0}
    to {bottom: 0; opacity: 1}
  }

  @media screen and (max-width: 580px){
    .modal-content{
      width:350px;
    }

  }

</style>