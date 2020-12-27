<template>
  <div class="body form">
    
                <h3 class="header">{{selected ? 'Update the '+selected.name : 'Create a new'}}  activity</h3>

                <form @submit.prevent="selected ? update() : create()" @keydown="form.onKeydown($event)">

                    <div class="group">
                        <label for="name"></label>
                        <input v-model="form.name" ref="add" type="text" name="name" placeholder="activity name"
                        class="control" >
                        <div v-if="form.errors.has('name')" class="error"> 
                            {{form.errors.get('name')}}
                        </div>
                    </div>
                                        
                    <div class="group">
                        <label for="desc"></label>
                        <input v-model="form.desc" ref="add"  type="text" name="desc" placeholder="activity desc"
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
                desc :  this.selected ? this.selected.desc : ''
            })
        }
    },
    methods : {

    create(){

            
                this.form.post('/activities')
                .then( response => {
                    
                })


        },
        update(){
            this.form.put('/activities/'+this.selected.id)
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