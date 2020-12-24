<template>
  <div class="modal ">
    <font-awesome-icon  size="2x" @click="hideModal" color="white" class="icon icon--close" icon="times"></font-awesome-icon>



<div class="content adding-packages">
    <div class="body form">
                            <h3 class="header">you can add packages now !</h3>

                    <div class="select-package group">
                        <input type="text" name="package" id="packages" class="control" v-model="query" @keyup="search($event)" placeholder="search and select packages">
                        <div v-if="searched" class="packages-list">
                            <div v-for="p in searched" :key="p.id" @click="select(p)" class="package control">
                                {{p.name}}
                            </div>
                        </div>
                    </div>

                <div v-if="selected.length" class="selected-packages group">
                    <div class="control">packages to include :</div>    
                    <div v-for="p in selected" @click="remove(p.index)" :key="p.index" class="package selected control">
                        {{p.name}}
                    </div>
                </div>
        </div>

                <div class="footer">

                    <button class="btn btn--success" @click="add">add packages</button>
                </div>
    </div>
  </div>
</template>

<script>
export default {
    props : ['member'],
    data() {
        return {
            packages : {} ,
            query : '' ,
            selected : [] ,
            searched : {} ,
        }
    },
    methods : {
        hideModal(){
            this.$emit('hide-modal');
        },
        get(){
            axios.get('/packages').then((response)=>{
            this.packages = response.data
            
            })
        
        },
        search(e){
            this.searched =  this.packages.filter((p)=>{
                if( p.name.includes(this.query) && !this.selected.includes(p)) return p
            })

            if(this.query.length == 0) this.searched = {}

            if(e.keyCode == 13 && this.searched){
                this.select(this.searched[0])
            }
            
        },
        select(p){
            this.selected.push(p)
            this.searched = {}
        },
        remove(p){
            this.selected.splice(p,1)
        },
        add(){

            
                axios.post('/members/'+this.member+'/memberships' , this.selected)
                .then(  response => console.log(response.data) )


                this.hideModal();
        }
    },
    mounted() {
        this.get();
    }
}
</script>

<style scoped>
    .form {
        width: 20rem;
        margin: 0 auto;
        
    }
.select-package {
    margin-bottom: 0.5rem;
    position: relative;
}
.packages-list {
    position: absolute;
    width: 100%;
    
}
.adding-packages {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.adding-packages  .footer {
    margin: 0 auto;
    width: 100%;
    display: flex;
    justify-content: flex-end;
}
.package {
    background: rgb(155, 155, 155);
    cursor: pointer;
}
.package-list .package:first-child{
    background: rgb(209, 209, 209);
}
.package.selected {
    background: rgb(207, 207, 207);

}
</style>