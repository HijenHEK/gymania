<template>
  
  <div>



    <management-nav :rows="rows" @change-display="rows = !rows" @search="search" @display-modal="modal ='activity'"/>


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
import ManagementNav from "./ManagementNav.vue"

export default {
    components : {
        DataDisplay ,
        ManagementNav
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
        search : _.debounce(function(query) {
            // if(this.query == "") {
            //     this.members = this.data 
            // }else {

            //     this.members = this.data.filter((member) => {
            //         if(member.name.includes(this.query) || !this.query){
            //             return member
            //     }
            // })
                    
            //     }
            axios.get('/activities?q='+query).then((response) => {
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
   
    
    .cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
   
    
</style>