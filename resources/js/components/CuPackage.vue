<template>

    <div class="body form">
    
                <h3 class="header">{{selected ? 'Update the '+selected.name : 'Create a new'}}  Package</h3>

                <form @submit.prevent="selected ? update() : create()" @keydown="form.onKeydown($event)">

                    <div class="group">
                        <label for="name"></label>
                        <input v-model="form.name" ref="add" type="text" name="name" placeholder="Package name"
                        class="control" >
                        <div v-if="form.errors.has('name')" class="error"> 
                            {{form.errors.get('name')}}
                        </div>
                    </div>
                    <div class="group">

                        <select-data @selected="select" :edit="selected ? selected.activity : null" data="activities" />

                        <select-data @selected="select" :edit="selected ? selected.cycle : null" data="cycles" />
                    </div>
                    
                    <div class="group">
                        <label for="fee"></label>
                        <input v-model="form.fee" ref="add"  type="text" name="fee" placeholder="Package fee"
                        class="control" >
                        <div v-if="form.errors.has('fee')" class="error"> 
                            {{form.errors.get('fee')}}
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
            activity :  this.selected ? this.selected.activity : null ,
            cycle : this.selected ? this.selected.cycle : null ,
            form : new Form({
                name : this.selected ? this.selected.name : '',
                fee :  this.selected ? this.selected.fee : ''
            })
        }
    },
    methods : {

    
        select(type , data){
            if(type == 'activities') {
                this.activity = data
            }else if (type == 'cycles') {
                this.cycle = data
            }
            

        },

        create(){

                    
                    
                    this.form.post('/packages?activity='+this.activity.id+'&cycle='+this.cycle.id)
                .then( response => {
                        this.$emit('done')
                    })

            

        },
        update(){
            this.form.put('/packages/'+this.selected.id+'?activity='+this.activity.id+'&cycle='+this.cycle.id)
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