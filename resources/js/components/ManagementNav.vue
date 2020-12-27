<template >
  <div class="nav">
    <input type="search" class="search" placeholder="Search" v-model="query" @keyup="search()" id="search">
        <div class="nav-items">
            <font-awesome-icon  size="lg" icon="plus"  class="icon icon--success" @click="displayModal"></font-awesome-icon>
               
            <font-awesome-icon  size="lg" @click="changeDisplay" :icon="rows ? 'th-large' : 'bars'" class="icon icon--primary"></font-awesome-icon>
        </div>
  </div>
</template>

<script>
export default {
    props : ['rows'],
    data(){
        return {
            query :""
        }
    },
    methods:{
        changeDisplay(){
            this.$emit('change-display')
        },
        displayModal(){
            this.$emit('display-modal')

        },
        search(){
            this.$emit('search' , this.query)
        }
    }
}
</script>

<style>
 .nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1100px;
        width: 100%;
        margin: 1rem auto;
        padding: 1rem 0;
    }
    .nav-items {
        margin: 0 1rem;
        display: flex;
        flex-wrap: nowrap;
        
    }
    .nav-items * {
        margin: 0 0.5rem;
    }
    @media (max-width: 400px) {
           .nav {
               width: 100%;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
        } 
        .search {
                    flex-basis: unset !important;
                    min-width: unset !important;
                    max-width: 100% !important;
                    margin-bottom: 0.5rem;
        }
    }
    .search {
        max-width: 600px;
        min-width: 100px;
        flex-basis: 400px;
        flex-shrink: 1;
        flex-grow: 1;
        font-size: 1.1rem;
        padding: 0.7rem 2rem;
        border-radius: 5px;
        outline: none;
        border: none;
        background-color:rgba(230, 230, 230, 0.527) ;
        box-shadow: 0px 0px 1px 1px rgb(155, 153, 153);
        border: 1px solid rgb(190, 188, 188);
    }
    
    .search:focus{
        color: rgb(29,167,90);
        background-color : white ;
        box-shadow: 0 0 1px 1px rgba(29, 167, 91, 0.514);
        border: 1px solid rgba(29, 167, 91, 0.479);

    }
</style>