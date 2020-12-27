<template>
  
  <div>



    <div class="nav">
        <input type="search" class="search" placeholder="Search" v-model="query" @keyup="search()" id="search">
        <div class="nav-items">
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
.cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1100px;
        width: 100%;
        margin: 1rem auto;
        padding: 1rem 0;
    }
    .nav-items {
        margin: 0 1rem;
        display: flex;
        flex-wrap: nowrap;
    }
    @media (max-width: 400px) {
           .nav {
               width: 100%;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
        } 
        .search {
                    flex-basis: unset !important;
                    min-width: unset !important;
                    max-width: 100% !important;
                    margin-bottom: 0.5rem;
        }
    }
    .search {
        max-width: 600px;
        min-width: 100px;
        flex-basis: 400px;
        flex-shrink: 1;
        flex-grow: 1;
        font-size: 1.1rem;
        padding: 0.7rem 2rem;
        border-radius: 5px;
        outline: none;
        border: none;
        background-color:rgba(230, 230, 230, 0.527) ;
        box-shadow: 0px 0px 1px 1px rgb(155, 153, 153);
        border: 1px solid rgb(190, 188, 188);
    }
    
    .search:focus{
        color: rgb(29,167,90);
        background-color : white ;
        box-shadow: 0 0 1px 1px rgba(29, 167, 91, 0.514);
        border: 1px solid rgba(29, 167, 91, 0.479);

    }
</style>