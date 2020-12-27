<template>
  
  <div>



        
        <management-nav v-if="!selected" :rows="rows" @change-display="rows = !rows" @search="search" @display-modal="modal ='addMember'"/>


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
import ManagementNav from "./ManagementNav.vue";

export default {
    
    components :  {
        DataDisplay,
        ManagementNav
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
            axios.get('/packages?q='+query).then((response) => {
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

</style>