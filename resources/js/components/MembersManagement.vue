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

    <div v-if="!selected" :class="{'cards' : !rows}" >
        <div v-for="member in members" :key="member.id" @click="selected = member"  :class="!rows ? 'data-card' : 'data'">
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


    }
    .data > * {
        flex-basis: 4rem;
        flex-grow: 1;
        flex-shrink: 1;
        padding: 1rem 0.5rem;
        font-size: 0.9rem;
        word-wrap: none;
        vertical-align: middle;
        padding: 0 1rem;

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
        height: 17rem;
        display: flex;
        background-color: white;
        margin: 0.5rem;
        border-radius: 10px;
        box-shadow: 0 0 2px 0 rgb(158, 158, 158)   ;
        padding: 1rem 0.5rem;
        cursor: pointer;
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