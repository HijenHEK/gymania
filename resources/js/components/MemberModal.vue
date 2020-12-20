<template>
  <div class="modal">
    <font-awesome-icon  size="2x" @click="hideModal" color="white" class="icon icon--close" icon="times"></font-awesome-icon>

    <div class="content">
        
        <div class="user-card">
                <div class="avatar">
                    <img :src="member.avatar" alt="" srcset="">
                </div>
                <div class="name">
                    {{member.name}}
                </div>
                <div class="id">
                    #{{member.id}}
                </div>

                <div class="param">
                        <font-awesome-icon  size="lg" color="red" class="icon " icon="trash"></font-awesome-icon>

                        <font-awesome-icon  size="lg" color="blue" class="icon" icon="edit"></font-awesome-icon>
                </div>
        </div>
    
    </div>
  </div>
</template>

<script>
export default {
    props : ['member'],
    methods : {
        hideModal(){
            this.$emit('hide-modal');
        }
    }
}
</script>

<style scoped>
.user-card {
        margin: 0.5rem;
        padding: 0.5rem;
        border-radius: 5px;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }


    .avatar {
        width: 50%;
        margin: 0 auto;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        
    }


    .avatar img {
        width: 100%;
    }
</style>