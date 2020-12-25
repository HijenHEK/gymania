<template>
  
  <div>



    <div class="nav">
        <input type="search" class="search" placeholder="Search" v-model="query" @keyup="search()" id="search">
        <div>
            <font-awesome-icon  size="lg" @click="modal='activity'" icon="plus" class="icon icon--success"></font-awesome-icon>
                &nbsp;            

            <font-awesome-icon  size="lg" @click="rows = !rows" :icon="rows ? 'th-large' : 'bars'  " class="icon icon--primary"></font-awesome-icon>
        </div>
    </div>

    <div :class="{'cards' : !rows}">
        <div v-for="a in activities" :key="a.id"   :class="!rows ? 'data-card' : 'data'" @click="edit(a)">
                
                <div class="name">
                    {{a.name}}
                </div>
                
        
                <div class="desc">
                    {{a.desc}} 
                </div>
                

                
        </div>
    </div>

    <modal-ui v-if="modal"  @hide-modal="hide()">
        <cu-activity v-if="modal=='activity'" @done="hide()" :selected="selected"></cu-activity>
    </modal-ui>

 </div>
</template>

<script>
export default {
    data(){
        return {
            selected : null,
            data : {},
            activities : {},
            rows : true,
            query : '',
            modal : null,
        }
    },
    methods :{
        search(){
            if(this.query == "") {
                this.activities = this.data 
            }else {

                this.activities = this.data.filter((a) => {
                    if(a.name.includes(this.query) || !this.query){
                        return a
                }
            })
                    
                }
            
            
        },
        edit(a){
            console.log(a)
            this.selected = a 
            this.modal = "activity"
        },

        hide(){
            this.selected = null 
            this.modal = null
        },
        getActivities(){
            axios.get('/activities').then(response => {
                    this.data = response.data
                    this.activities = this.data
                })
        }
        
    },
    mounted(){
        
        Echo.channel('updates')
        .listen('ActivityUpdate' , (e)=>{
                this.getActivities()
            })
        this.getActivities()

    }
}
</script>

<style scoped>
    .nav {
        display: flex;
        justify-content: space-between;
        max-width: 1000px;
        width: 100%;
        margin: 0 auto;
        padding: 1rem 0;
    }
    
    .data {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin: 0.5rem 0;
        box-shadow: 0 0 2px 1px rgb(158, 158, 158);
        width: 100%;
        max-width: 1100px;
        margin: 0.5rem auto;
        background-color: white;
        border-radius: 5px;
        overflow: hidden;
                cursor: pointer;
        padding: 0 1rem;

    }
    .data > * {
        flex-basis: 4rem;
        flex-grow: 1;
        flex-shrink: 1;
        padding: 1rem 0.5rem;
        font-size: 0.9rem;
        word-wrap: none;
        vertical-align: middle;
        cursor: pointer;

    }
    .cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .data-card {
        flex-direction: column;
        align-items: center;
        width: 12rem;
        height: 15rem;
        display: flex;
        background-color: white;
        margin: 0.5rem;
        border-radius: 10px;
        box-shadow: 0 0 2px 0 rgb(158, 158, 158)   ;
        padding: 1rem 0.5rem;
        cursor: pointer;
    }
    .data-card .name {
        flex: 100%;
        font-size: 1.1rem;
    }
    .data-card > * {
        
        padding: 0.5rem 0;
        word-wrap: none;

    }
    .data-card .avatar {
        width: 8rem;
        height: 8rem;
    }
    .avatar {
        width: 4rem;
        height: 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 100%;
        flex-grow: unset;
        flex-basis: unset;

    }
    .id {
        flex-basis: 3rem;
        flex-grow: 0.1;
    }
    .avatar img {
        width: 100%;
    }
    .param {
        display: flex;
        justify-content: flex-end;
    }
    .param .icon {
        margin: 0.2rem;
        cursor: pointer;
    }
    
    .search {
        font-size: 1.1rem;
        padding: 0.7rem 2rem;
        border-radius: 5px;
        background-color: white;
                box-shadow: 0 0 1px 0px rgb(158, 158, 158);

        }
</style>