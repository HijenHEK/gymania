<template>

    <div class="body form adding-packages">
                <h3 class="header">you can add packages now !</h3>

                    <div class="select-package group">
                        <input type="text" name="package" id="packages" class="control" v-model="query" autocomplete="off" @keyup="search($event)" placeholder="search and select packages">
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

                <div class="footer">

                    <button class="btn btn--success" @click="add">add packages</button>
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

        get(){
            axios.get('/packages').then((response)=>{
            this.packages = response.data
            
            })
        
        },
        search(e){
            this.searched =  this.packages.filter((p)=>{
                if( p.name.toLowerCase().includes(this.query.toLowerCase()) && !this.selected.includes(p)) return p
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
                .then(  response => {
                    this.$emit('done');
                })


        }
    },
    mounted() {
        Echo.channel('updates')
        .listen('PackageUpdate' , (e)=>{
                this.get()
            })
        this.get();
    }
}
</script>

<style scoped>
.form {
        max-width: 20rem;
        margin: 0 auto;
        height: 100%;
        
    }
    .header {
        margin: 2rem 0;
    }
    .footer {
        display: flex;
        justify-content: flex-end;
        margin-top : 2rem ;
    }
.select-package {
    margin-bottom: 0.5rem;
    position: relative;
}
.packages-list {
    position: absolute;
    width: 100%;
    z-index: 100;
    
}
.adding-packages {
    display: flex;
    height: 100%;
    flex-direction: column;
    justify-content: flex-start;
}

.package {
    background: rgb(155, 155, 155);
    cursor: pointer;
}
.packages-list .package {
    background-color: rgb(40, 40, 40) ;
    color: white ;    
    cursor: pointer;

}
.package-list .package:first-child{
    font-weight: 600;
}
.package.selected {
    background: rgb(207, 207, 207);

}

</style>