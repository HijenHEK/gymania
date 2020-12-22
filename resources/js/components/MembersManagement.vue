<template>
  
  <div>



    <div v-if="!selected" class="nav">
        <input type="search" class="search" placeholder="Search" v-model="query" @keyup="search()" id="search">
        <div>
            <font-awesome-icon  size="lg" icon="plus"  class="icon icon--success" @click="modal ='addMember'"></font-awesome-icon>
                &nbsp;
            <font-awesome-icon  size="lg" @click="rows = !rows" :icon="rows ? 'th-large' : 'bars'  " class="icon icon--primary"></font-awesome-icon>
        </div>
    </div>

    <div v-if="!selected" :class="rows ? 'rows' : 'cards'">
        <div v-for="member in members" :key="member.id" @click="selected = member" class="user-card">
                <div class="id">
                    #{{member.id}}
                </div>
                <div class="avatar">
                    <img :src="member.avatar" alt="" srcset="">
                </div>
                <div class="name">
                    {{member.name}}
                </div>
                <div class="active-membership">
                    memberships : {{member.memberships.length}}
                </div>

                <!-- <div class="param">
                        <font-awesome-icon  size="lg" color="red" class="icon " icon="trash"></font-awesome-icon>

                        <font-awesome-icon  size="lg" color="blue" class="icon" icon="edit"></font-awesome-icon>
                </div> -->
        </div>
    </div>
    <single-member v-if="selected" @back="selected=null" :member="selected"></single-member>
    <cu-member v-if="modal=='addMember'" @hide-modal="modal=null" @next-step="addPackagesModal"></cu-member>
    <add-package v-if="modal=='addpackage'" @hide-modal="modal=null" :member="createdMember" ></add-package>
    
 </div>
</template>

<script>

export default {
    data(){
        return {
            data : {},
            members : {},
            selected : null,
            rows : true,
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
        search(){
            if(this.query == "") {
                this.members = this.data 
            }else {

                this.members = this.data.filter((member) => {
                    if(member.name.includes(this.query) || !this.query){
                        return member
                }
            })
                    
                }
            
            
        }
        
    },
    mounted(){
        axios.get('/members').then(response => {
            this.data = response.data
            this.members = this.data
            })
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
    }
    .rows > * ,.cards > * {
        cursor: pointer;
        -webkit-user-select: none;
    }
    
    .cards .user-card {
        margin: 0.5rem;
        padding: 0.5rem;
        box-shadow: 0 0 1px 0px rgb(158, 158, 158);
        border-radius: 5px;
        max-width: 12rem;
        background-color: white;
        height: 16rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }
    .cards .user-card .name {
        text-align: center;
    }
    .avatar {
        width: 80%;
        margin: 0 auto;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        
    }
    .cards .avatar img {
            width: 100%;
    }

    .rows {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
    }
    .rows .user-card {
        width: 100%;
        margin: 0.2rem;
        padding: 0.3rem 1rem;
        box-shadow: 0 0 1px 0px rgb(158, 158, 158);
        border-radius: 5px;
        background-color: white;
        height: 5rem;
        display: flex;
        align-items: center;
    }
    .rows .user-card .name {
        text-align: center;
        flex : 0.2;
        padding: 0 0.5rem;
    }
    .rows .user-card .id {
        
                padding: 0 0.5rem;

    }
    .rows .avatar {
                padding: 0 0.5rem;

        height:  80%;
        width: unset;
        margin: unset;
        
    }
    .rows .avatar img {
            height:  100%;
    }

    .rows .user-card .param {
        margin-left: auto ;
        padding: 0 0.5rem;

    }

    .param .icon {
        margin: 0.2rem;
        cursor: pointer;
    }
    
    .search {
        font-size: 1rem;
        padding: 0.5rem 2rem;
        border-radius: 5px;
        background-color: white;
                box-shadow: 0 0 1px 0px rgb(223, 223, 223);

        }
</style>