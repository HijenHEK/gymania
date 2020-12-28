<template>
  
  <div>



        
        <management-nav  :rows="rows" @change-display="rows = !rows" @search="search" @display-modal="modal ='package'"/>


    <div :class="{'cards' : !rows}">
        <data-display v-for="p in packages.data" :key="p.id"   :class="!rows ? 'data-card' : 'data'" @click.native="edit(p)">
                
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
            <laravel-vue-pagination :data="packages" @pagination="loadData" />

 </div>
</template>

<script>
import DataDisplay from "./DataDisplay.vue";
import LaravelVuePagination from './LaravelVuePagination.vue';
import ManagementNav from "./ManagementNav.vue";

export default {
    
    components :  {
        DataDisplay,
        ManagementNav,
        LaravelVuePagination
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
        loadData(p){
            if(this.query.length > 0) {
                this.search(this.query , p)
            }else {
                this.getPackages(p)
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
            axios.get('/packages?q='+query+'&page='+page).then((response) => {
                console.log(response.data)
                        this.packages = response.data
            })
            
        }),
        edit(p){
            console.log(p)
            this.selected = p 
            this.modal = "package"
        },

        hide(){
            this.selected = null 
            this.modal = null
        },
        getPackages(page = 1){
            axios.get('/packages?page='+page).then(response => {
                this.packages = response.data
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

</style>