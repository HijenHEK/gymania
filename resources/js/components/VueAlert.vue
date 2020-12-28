<template>
  <transition name="slide-fade">
    <div v-show="active" class="alert translate" :class="className">
        {{msg}} 
    </div>
  </transition>
</template>

<script>
export default {
    props: {
        size : {
            type: String,
            default : 'lg',
        },
        active : {
            type: Boolean,
            default : false,
        },
        color : {
            type: String,
            default : 'warning',
        },
        type : {
            type: String,
            default : 'bottom-right-corner',
        },
        msg : {
            type: String,
            required : false,
        },
    },
    data(){
        return {
            translate : false ,
        }
    },
    computed : {
        className (){
            return 'alert--'+this.color+' alert--'+this.size+' '+this.type
        }
    },

    
    mounted () {
        
   
    }
}
</script>

<style scoped>
        .top-right-corner {
            top: 10px;
            right: 10px;
        }
        .bottom-right-corner {
            bottom: 30px;
            right: 30px;
        }
        .top-left-corner {
            top: 10px;
            left: 10px;
        }
        .bottom-left-corner {
            bottom: 30px;
            left: 30px;
        }
        .slide-fade-enter-active {
  transition: all 0.5s ease;
    }
    .slide-fade-leave-active {
    transition: all 1.5s ease;
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(500px);
    opacity: 0;
    }
    .alert {
    border: none;
    outline: none;
    opacity: 1;
    padding: 1rem 2rem;
    position: absolute;
    z-index: 1000;
    }
    .alert--success {
        background-color: rgb(29,167,90);
        color: white;
    }
    .alert--primary {
        background-color: rgb(19, 91, 185);
        color: white;

    }
    .alert--light-primary {
        background-color :rgb(40,192,239);
        color: black;

    }
    .alert--dark {
        background-color :rgb(29,38,45); 
        color: white;
    }
    .alert--white {
        background-color: white;
        color: black;
    }
    .alert--danger {
        background-color: rgb(221,75,57);
        color: white;
        
    }
    .alert--warning {
        background-color:rgb(243,156,18);
        color: white;
        
    }
    .alert--lg {
        font-size: 1.1rem;
        
    }
    .alert--sm {
        font-size: 0.8rem;
    }
    .alert--xl {
        font-size: 1.4rem;
    }
</style>