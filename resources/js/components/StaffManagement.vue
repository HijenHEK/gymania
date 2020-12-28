<template>
  
  <div >



    <management-nav :rows="rows" @change-display="rows = !rows" @search="search" @display-modal="modal ='addUser'"/>
        

    <div :class="{'cards' : !rows}" >
        <data-display v-for="user in users.data" :key="user.id" @click.native="selected = user ; modal ='addUser'"  :class="!rows ? 'data-card' : 'data'">
                <div class="avatar" >
                    <img :src="user.avatar" alt="" srcset="">
                </div>

                <div class="id">
                    #{{user.id}}
                </div>
                <div class="name">
                    {{user.name}}
                </div>

                <div class="role">
                    {{user.role.name}}
                </div>
                
                
        </data-display>
    </div>
    <!-- <single-user class="pagination" v-if="selected" @back="selected=null" :id="selected.id"></single-user> -->
    <modal-ui v-if="modal" @hide-modal="modal=null;selected= null">
        <cu-user v-if="modal=='addUser'" :user="selected" @done="modal=null;selected= null"></cu-user>
      <!--  <add-package v-if="modal=='addpackage'" @done="modal=null" :user="createdUser" ></add-package> -->
    </modal-ui>
            <laravel-vue-pagination :data="users" @pagination="loadData" />

 </div>
</template>

<script>
import DataDisplay from './DataDisplay.vue'
import ManagementNav from "./ManagementNav.vue"
import LaravelVuePagination from "./LaravelVuePagination.vue"
import _ from 'lodash'
import CuUser from './CuUser.vue'

export default {
  components: { 
      DataDisplay,
        ManagementNav,
        LaravelVuePagination,
        CuUser
       },
    data(){
        
    return {
            data : {},
            users : {},
            selected : null,
            rows : false,
            query : '',
            modal : null,
            createdUser : null ,
        }
    },
    methods :{
        addPackagesModal(id){
            this.createdUser = id

            this.modal='addpackage' 
        },
        loadData(p){
            if(this.query.length > 0) {
                this.search(this.query , p)
            }else {
                this.getUsers(p)
            }
        },

        search : _.debounce(function(query,page = 1) {
            this.query=query
            // if(this.query == "") {
            //     this.users = this.data 
            // }else {

            //     this.users = this.data.filter((user) => {
            //         if(user.name.includes(this.query) || !this.query){
            //             return user
            //     }
            // })
                    
            //     }
            axios.get('/users?q='+query+'&page='+page).then((response) => {
                console.log(response.data)
                        this.users = response.data
            })
            
        }),
        getUsers(page = 1){
            axios.get('/users?page='+page).then(response => {
                this.users = response.data
            })
        }
        
    },
    mounted(){
        Echo.channel('updates')
            .listen('UserUpdate' , (e)=>{
                this.getUsers()
            })
        this.getUsers()
    }
}
</script>

<style scoped>
.cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
.pagination {
    margin-top: auto ;
    margin-bottom: 1rem;
}
</style>