<template>
  
  <div>



    <div v-if="!selected" class="nav">
        <input type="search" class="search" placeholder="Search" v-model="query" @keyup="search()" id="search">
        <div>
            <font-awesome-icon  size="lg" icon="plus"  class="icon icon--success" @click="modal ='addMember'"></font-awesome-icon>
                &nbsp;
            <font-awesome-icon  size="lg" @click="rows = !rows" :icon="rows ? 'th-large' : 'bars'" class="icon icon--primary"></font-awesome-icon>
        </div>
    </div>

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
import _ from 'lodash'
export default {
  components: { DataDisplay },
    data(){
        return {
            data : {},
            members : {},
            selected : null,
            rows : false,
            query : '',
            modal : null,
            createdMember : null ,
        }
    },
    methods :{
        addPackagesModal(id){
            this.createdMember = id

            this.modal='addpackage' 
        },
        search : _.debounce(function() {
            // if(this.query == "") {
            //     this.members = this.data 
            // }else {

            //     this.members = this.data.filter((member) => {
            //         if(member.name.includes(this.query) || !this.query){
            //             return member
            //     }
            // })
                    
            //     }
            axios.get('/members?q='+this.query).then((response) => {
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
    
    .search {
        font-size: 1rem;
        padding: 0.5rem 2rem;
        border-radius: 5px;
        background-color: white;
        box-shadow: 0 0 1px 0px rgb(223, 223, 223);

        }
</style>