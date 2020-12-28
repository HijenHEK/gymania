<template @done="hideModal" >
    <div class="modal" @click="handle($event)" >
    <font-awesome-icon  size="2x" @click="hideModal" color="white" class="icon icon--close" icon="times"></font-awesome-icon>
    <div class="content">
        <slot></slot>
    </div>
    </div>
</template>
<script>
import lodash from 'lodash'
export default {

    methods : {
        hideModal(){
            this.$emit('hide-modal');
        },
        handle : _.debounce(function(e){
            if(e.target.className.includes('modal')) {
                this.hideModal();
            }   
        })
    },
    mounted(){
    }
    
}
</script>

<style scoped>
    .modal {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 800;
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(29,38,45,0.5);
    }
    .header {
        margin-bottom: 2rem;
    }
    .icon--close {
        position: absolute;
        margin: 5rem;
        top: 0 ;
        right : 0 ;
    }
    .content {
        background-color: rgb(240, 240, 240);
        width: 30rem;
        min-height: 35rem;
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