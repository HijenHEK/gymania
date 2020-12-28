<template>
  
  <div>



        <management-nav :rows="rows" @change-display="rows = !rows" @search="search" @display-modal="modal ='cycle'"/>


    <div :class="{'cards' : !rows}">
        <data-display v-for="c in cycles.data" :key="c.id"   :class="!rows ? 'data-card' : 'data'" @click.native="edit(c)">
                
                <div class="name">
                    {{c.name}}
                </div>
                
                
                <div class="period">
                    {{c.period}} days
                </div>
                <div v-if="c.desc" class="desc">
                    {{c.desc}}
                </div>

                
        </data-display>
    </div>

    <modal-ui v-if="modal" @hide-modal="modal=null" >
        <cu-cycle v-if="modal=='cycle'" :selected="selected" @done="hide()"></cu-cycle>
    </modal-ui>
            <laravel-vue-pagination :data="cycles" @pagination="loadData" />

 </div>
</template>

<script>
import DataDisplay from "./DataDisplay.vue"
import LaravelVuePagination from './LaravelVuePagination.vue'
import ManagementNav from "./ManagementNav.vue"


export default {
  components: { DataDisplay , ManagementNav, LaravelVuePagination},
    data(){
        return {
            selected : null,
            data : {},
            cycles : {},
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
                this.getCycles(p)
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
            axios.get('/cycles?q='+query+'&page='+page).then((response) => {
                console.log(response.data)
                        this.cycles = response.data
            })
            
        }),
        edit(c){
            console.log(c)
            this.selected = c 
            this.modal = "cycle"
        },

        hide(){
            this.selected = null 
            this.modal = null
        },
        getCycles(page = 1){
            axios.get('/cycles?page='+page).then(response => {
                this.cycles = response.data
                })
        }
        
    },
    mounted(){
        Echo.channel('updates')
            .listen('CycleUpdate' , (e)=>{
                this.getCycles()
            })
        this.getCycles()
    }
}
</script>

<style scoped>
    
    
    .cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    
    .search {
        font-size: 1.1rem;
        padding: 0.7rem 2rem;
        border-radius: 5px;
        background-color: white;
                box-shadow: 0 0 1px 0px rgb(158, 158, 158);

        }
</style>