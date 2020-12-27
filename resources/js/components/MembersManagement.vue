<template>
  
  <div>



    <management-nav v-if="!selected" :rows="rows" @change-display="rows = !rows" @search="search" @display-modal="modal ='addMember'"/>
        

    <div v-if="!selected" :class="{'cards' : !rows}" >
        <data-display v-for="member in members" :key="member.id" @click.native="selected = member"  :class="!rows ? 'data-card' : 'data'">
                <div class="avatar" >
                    <img :src="member.avatar" alt="" srcset="">
                </div>

                <div class="id">
                    #{{member.id}}
                </div>
                <div class="name">
                    {{member.name}}
                </div>

                    <div class="active-membership">
                        active : {{member.memberships.length}}
                    </div>
                    <div class="expired-membership">
                        expired : {{member.memberships.length}}
                    </div>
                
                <!-- <div class="param">
                        <font-awesome-icon  size="lg" color="red" class="icon " icon="trash"></font-awesome-icon>

                        <font-awesome-icon  size="lg" color="blue" class="icon" icon="edit"></font-awesome-icon>
                </div> -->
        </data-display>
    </div>
    <single-member v-if="selected" @back="selected=null" :id="selected.id"></single-member>
    <modal-ui v-if="modal" @hide-modal="modal=null">
        <cu-member v-if="modal=='addMember'" @done="modal=null" @next-step="addPackagesModal"></cu-member>
        <add-package v-if="modal=='addpackage'" @done="modal=null" :member="createdMember" ></add-package>
    </modal-ui>
    
 </div>
</template>

<script>
import DataDisplay from './DataDisplay.vue'
import ManagementNav from "./ManagementNav.vue"
import _ from 'lodash'

export default {
  components: { 
      DataDisplay,
        ManagementNav
       },
    data(){
        
    return {
            data : {},
            members : {},
            selected : null,
            rows : false,
            modal : null,
            createdMember : null ,
        }
    },
    methods :{
        addPackagesModal(id){
            this.createdMember = id

            this.modal='addpackage' 
        },

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
            axios.get('/members?q='+query).then((response) => {
                console.log(response.data)
                        this.members = response.data
            })
            
        }),
        getMembers(){
            axios.get('/members').then(response => {
            this.data = response.data
            this.members = this.data
            })
        }
        
    },
    mounted(){
        Echo.channel('updates')
            .listen('MemberUpdate' , (e)=>{
                this.getMembers()
            })
        this.getMembers()
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