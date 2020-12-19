<template>
  
  <div>



    <div class="nav">
        <input type="search" class="search" placeholder="Search" v-model="query" @keyup="search()" id="search">
        <div>
            <font-awesome-icon  size="lg" @click="rows = !rows" :icon="rows ? 'th-large' : 'bars'  " class="icon"></font-awesome-icon>
        </div>
    </div>

    <div v-if="rows" class="rows">
        <div v-for="client in clients" :key="client.id" class="user-card">
                <div class="avatar">
                    <img :src="client.avatar" alt="" srcset="">
                </div>
                <div class="name">
                    {{client.name}}
                </div>
                <div class="username">
                    {{client.username}}
                </div>

                <div class="param">
                        <font-awesome-icon  size="lg" color="red" class="icon " icon="trash"></font-awesome-icon>

                        <font-awesome-icon  size="lg" color="blue" class="icon" icon="edit"></font-awesome-icon>
                </div>
        </div>
    </div>
    <div v-else class="cards">
        <div v-for="client in clients" :key="client.id" class="user-card">
                <div class="avatar">
                    <img :src="client.avatar" alt="" srcset="">
                </div>
                <div class="name">
                    {{client.name}}
                </div>
                <div class="username">
                    {{client.username}}
                </div>

                <div class="param">
                        <font-awesome-icon  size="lg" color="red" class="icon " icon="trash"></font-awesome-icon>

                        <font-awesome-icon  size="lg" color="blue" class="icon" icon="edit"></font-awesome-icon>
                </div>
        </div>
</div>
 </div>
</template>

<script>
export default {
    data(){
        return {
            data : {},
            clients : {},
            rows : true,
            query : '',
        }
    },
    methods :{
        search(){
            if(this.query == "") {
                this.clients = this.data 
            }else {

                this.clients = this.data.filter((client) => {
                    if(client.name.includes(this.query) || !this.query){
                        return client
                }
            })
                    
                }
            
            
        }
        
    },
    mounted(){
        axios.get('/clients').then(response => {
            this.data = response.data
            this.clients = this.data
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
    .rows .user-card .username {
        flex : 0.2;
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
        font-size: 1.1rem;
        padding: 0.7rem 2rem;
        border-radius: 5px;
        background-color: white;
                box-shadow: 0 0 1px 0px rgb(158, 158, 158);

        }
</style>