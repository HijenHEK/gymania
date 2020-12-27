<template>



    <div class="form">

                    <div v-if="!selected" class="select-data group">
                        <input type="text" name="data" id="data" class="control" v-model="query" @keyup="search($event)"
                         :placeholder="data == 'activities' ? 'select an activity' : 'select a cycle' " autocomplete="off">
                        <div v-if="searched" class="data-list">

                            <div v-for="item in searched" :key="item.id" @click="select(item)" class="data control">
                                {{item.name}}
                            </div>
                        
                        </div>
                    </div>

                    <div v-if="selected" class="data selected control" @click="remove()">
                        {{selected.name}}
                    </div>
        </div>

</template>

<script>
export default {
    props : {
        data : {
            type : String ,
            required : true
        },
        edit : {
            type : Object ,
            required : false ,
            default : null,
        }
    },
    data() {
        return {
            fetched : {} ,
            selected : this.edit,
            query : '' ,
            searched : {} ,
        }
    },
    methods : {

        get(){
            axios.get('/'+this.data).then((response)=>{
                this.fetched = response.data
                console.log('/'+this.data  ,this.fetched)
            
            })
        
        },
        
        search(e){
            this.searched =  this.fetched.filter((item)=>{
                if( item.name.toLowerCase().includes(this.query.toLowerCase())) return item
            })

            if(this.query.length == 0) this.searched = {}

            if(e.keyCode == 13 && this.searched){
                this.select(this.searched[0])
            }
            
        },

        select(item){
            this.selected = item
            this.searched = {}
            console.log(this.data)
            this.$emit('selected', this.data , this.selected)
        },

        remove(){
            this.selected = null
        },

    },
    mounted() {
        Echo.channel('updates')
            .listen('CycleUpdate' , (e)=>{
                this.getPackages()
            }).listen('ActivityUpdate' , (e)=>{
                this.get()
            })
        this.get()
    }
}
</script>

<style scoped>
    .form {
        max-width: 20rem;
        margin: 0 auto;
        height: 100%;
        
    }
.select-data {
    margin-bottom: 0.5rem;
    position: relative;
}
.selected {
    margin: 0.5rem 0;
}
.data-list {
    position: absolute;
    z-index: 100;
    width: 100%;
    
}

.data-list .data {
    background-color: rgb(40, 40, 40);
    color: white;    
}
.data {
    background: rgb(155, 155, 155);
    cursor: pointer;

}
.data-list .data:first-child{
    font-weight: 600;
}
.data.selected {
    background: rgb(207, 207, 207);

}
</style>