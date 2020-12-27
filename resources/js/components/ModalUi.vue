<template @done="hideModal">
    <div class="modal " >
    <font-awesome-icon  size="2x" @click="hideModal" color="white" class="icon icon--close" icon="times"></font-awesome-icon>
    <div class="content">
        <slot ></slot>
    </div>
    </div>
</template>
<script>

export default {

    methods : {
        hideModal(){
            this.$emit('hide-modal');
        },
        
    }
}
</script>

<style scoped>
    .modal {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(29,38,45,0.5);
    }
    .icon--close {
        position: absolute;
        margin: 5rem;
        top: 0 ;
        right : 0 ;
    }
    .content {
        background-color: rgb(224, 224, 224);
        width: 30rem;
        height: 40rem;
        padding: 2rem;
        max-width: 90%;
        border-radius: 5px;
        box-shadow: 0 0 1px 0 rgb(224, 224, 224);
    }
    @media (max-width : 800px) {
        .icon--close {
        position: absolute;
        color: black;
        margin: 0.5rem;
        top: 0 ;
        right : 0 ;
    }
    }
</style>