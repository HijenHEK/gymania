<template>
  
  <div>



    <management-nav :rows="rows" @change-display="rows = !rows" @search="search" @display-modal="modal ='activity'"/>


    <div :class="{'cards' : !rows}">
        <data-display v-for="a in activities.data" :key="a.id"   :class="!rows ? 'data-card' : 'data'" @click.native="edit(a)">
                
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
                <laravel-vue-pagination :data="activities" @pagination="loadData" />

 </div>
</template>

<script>
import DataDisplay from './DataDisplay.vue'
import LaravelVuePagination from './LaravelVuePagination.vue'
import ManagementNav from "./ManagementNav.vue"

export default {
    components : {
        DataDisplay ,
        ManagementNav,
        LaravelVuePagination
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
        loadData(p){
            if(this.query.length > 0) {
                this.search(this.query , p)
            }else {
                this.getActivities(p)
            }
        },
        search : _.debounce(function(query ,page =1) {
            this.query=query

            // if(this.query == "") {
            //     this.members = this.data 
            // }else {

            //     this.members = this.data.filter((member) => {
            //         if(member.name.includes(this.query) || !this.query){
            //             return member
            //     }
            // })
                    
            //     }
            axios.get('/activities?q='+query+'&page='+page).then((response) => {
                console.log(response.data)
                        this.activities = response.data
            })
            
        }),
        edit(a){
            console.log(a)
            this.selected = a 
            this.modal = "activity"
        },

        hide(){
            this.selected = null 
            this.modal = null
        },
        getActivities(page = 1){
            axios.get('/activities?page='+page).then(response => {
                    this.activities = response.data
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
   
    
    .cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
   
    
</style>