<template>
  
  <div>



    <div class="nav">
        <input type="search" class="search" placeholder="Search" v-model="query" @keyup="search()" id="search">
        <div>
            <font-awesome-icon  size="lg" @click="modal='package'" icon="plus" class="icon icon--success"></font-awesome-icon>
                &nbsp;            

            <font-awesome-icon  size="lg" @click="rows = !rows" :icon="rows ? 'th-large' : 'bars'  " class="icon icon--primary"></font-awesome-icon>
        </div>
    </div>

    <div :class="{'cards' : !rows}">
        <data-display v-for="p in packages" :key="p.id"   :class="!rows ? 'data-card' : 'data'" @click.native="edit(p)">
                
                <div class="name">
                    {{p.name}}
                </div>
                
                <div class="activity">
                    {{p.activity.name}}
                </div>
                <div class="username">
                    {{p.fee}} dt
                </div>
                <div class="cycle">
                    paid  {{p.cycle.name}}
                </div>

                
        </data-display>
    </div>

    <modal-ui v-if="modal"  @hide-modal="hide()">
        <cu-package v-if="modal=='package'" :selected="selected" @done="hide()"></cu-package>
    </modal-ui>

 </div>
</template>

<script>
import DataDisplay from "./DataDisplay.vue";

export default {
    
    components :  {
        DataDisplay
    },
  
    data(){
        return {
            selected : null,
            data : {},
            packages : {},
            rows : true,
            query : '',
            modal : null,
        }
    },
    methods :{
        search(){
            if(this.query == "") {
                this.packages = this.data 
            }else {

                this.packages = this.data.filter((p) => {
                    if(p.name.includes(this.query) || !this.query){
                        return p
                }
            })
                    
                }
            
            
        },
        edit(p){
            console.log(p)
            this.selected = p 
            this.modal = "package"
        },

        hide(){
            this.selected = null 
            this.modal = null
        },
        getPackages(){
            axios.get('/packages').then(response => {
                this.data = response.data
                this.packages = this.data
            })

        }
        
    },
    mounted(){
        
        Echo.channel('updates')
            .listen('PackageUpdate' , (e)=>{
                this.getPackages()
            })
        this.getPackages()
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