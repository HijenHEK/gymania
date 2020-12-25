<template>
  <div class="body form">
    

                <h3 class="header">{{selected ? 'Update the '+selected.name : 'Create a new'}}  cycle</h3>

                <form @submit.prevent="selected ? update() : create()" @keydown="form.onKeydown($event)">

                    <div class="group">
                        <label for="name"></label>
                        <input v-model="form.name" ref="add" type="text" name="name" placeholder="cycle name"
                        class="control" >
                        <div v-if="form.errors.has('name')" class="error"> 
                            {{form.errors.get('name')}}
                        </div>
                    </div>
                    <div class="group">
                        <label for="period"></label>
                        <input v-model="form.period" ref="add" type="number" min="0" max="365" name="period" placeholder="cycle period"
                        class="control" >
                        <div v-if="form.errors.has('period')" class="error"> 
                            {{form.errors.get('period')}}
                        </div>
                    </div>                  
                    <div class="group">
                        <label for="desc"></label>
                        <input v-model="form.desc" ref="add"  type="text" name="desc" placeholder="cycle desc"
                        class="control" >
                        <div v-if="form.errors.has('desc')" class="error"> 
                            {{form.errors.get('desc')}}
                        </div>
                    </div>

                    <div class="footer">

                        <button type="submit" class="btn btn--success">{{selected ? 'Update' : 'Create'}}</button>
                    </div>
                </form>

                
                


</div>
</template>

<script>
import Form from 'vform'
export default {
    props : {
        selected : {
            type : Object,
            default : null ,
        }
    },
    data() {
        return {
            form : new Form({
                name : this.selected ? this.selected.name : '',
                period : this.selected ? this.selected.period : '',
                desc :  this.selected ? this.selected.desc : ''
            })
        }
    },
    methods : {
    
            
    create(){

            
                this.form.post('/cycles')
                .then( response => {
                    
                })


        },
        update(){
            this.form.put('/cycles/'+this.selected.id)
                .then( response => {
                    this.$emit('done')
                })
        }
    },
    mounted() {
    }
}
</script>

<style scoped>
    .form {
        width: 20rem;
        margin: 0 auto;
        height: 100%;
        
    }
    .footer {
        display: flex;
        justify-content: flex-end;
    }
.select-package {
    margin-bottom: 0.5rem;
    position: relative;
}
.packages-list {
    position: absolute;
    width: 100%;
    
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