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
        <data-display v-for="a in activities" :key="a.id"   :class="!rows ? 'data-card' : 'data'" @click.native="edit(a)">
                
                <div class="name">
                    {{a.name}}
                </div>
                
        
                <div v-if="a.desc" class="desc">
                    {{a.desc}} 
                </div>
                

                
        </data-display>
    </div>

    <modal-ui v-if="modal"  @hide-modal="hide()">
        <cu-activity v-if="modal=='activity'" @done="hide()" :selected="selected"></cu-activity>
    </modal-ui>

 </div>
</template>

<script>
import DataDisplay from './DataDisplay.vue'
export default {
    components : {
        DataDisplay 
    },
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
    
    
    .cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
   
    
</style>