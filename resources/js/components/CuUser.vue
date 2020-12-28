<template>
  

    
    <form class="form" @submit.prevent=" user ? update() :create()" @keydown="form.onKeydown($event)" aria-autocomplete="off" enctype="multipart/form-data">
        
        <h3 class="header">
            {{   user ? 'Edit ' + user.name : 'Add a new user !' }}
        </h3>
        
        <div class="group">
            
            <div class="file-upload">
                <img :src="this.avatar ? this.avatar : user ? user.avatar : '' " ref="avatar" class="mx-auto avatar">
                <div class="upload-text">Change avatar ?</div>
            <input @change="changeAvatar" name="avatar" type="file"  class="file-input" />
            </div>
        </div> 
          <div class="group">
            <label for="name"></label>
            <input v-model="form.name" ref="add" type="text" name="name" placeholder="name"
              class="control" >
            <div v-if="form.errors.has('name')" class="error"> 
                {{form.errors.get('name')}}
            </div>
          </div>
            <div class="group">
            <label for="username"></label>
            <input v-model="form.username" ref="add"  type="text" name="username" placeholder="username"
              class="control" >
            <div v-if="form.errors.has('username')" class="error"> 
                {{form.errors.get('username')}}
            </div>
          </div>
            <div class="group">
            <label for="email"></label>
            <input v-model="form.email" ref="add"  type="email" name="email" placeholder="email"
              class="control" >
            <div v-if="form.errors.has('email')" class="error"> 
                {{form.errors.get('email')}}
            </div>
          </div>
          <div class="group">
            <label for="password"></label>
            <input v-model="form.password" ref="add"  type="password" name="password" placeholder="password"
              class="control" >
            <div v-if="form.errors.has('password')" class="error"> 
                {{form.errors.get('password')}}
            </div>
          </div>
            <div class="group">
                <select-data @selected="select" :edit="user ? user.role : null" data="roles" aria-autocomplete="off"/>
            </div>

            <!--
                  <div class="group">
            <label for="phone"></label>
            <input v-model="form.phone"  ref="add"  type="number" min="00000000" max="99999999"  name="phone" placeholder="phone"
              class="control" >
            <div v-if="form.errors.has('phone')" class="error"> 
                {{form.errors.get('phone')}}
            </div>
          </div>

          <div class="inline">
          <div class="group">
            <label for="age"></label>
            <input v-model="form.age" ref="add" type="number" min="0" max="110" name="age" placeholder="age"
              class="control" >
            <div v-if="form.errors.has('age')" class="error"> 
                {{form.errors.get('age')}}
            </div>
          </div>
            <div class="inline">
                <div >
                    <input type="radio" id="male" name="gender" v-model="form.gender" value="1">
                <label for="male">Male</label><br>
                </div>
                <div >
                    <input type="radio" id="female" name="gender" v-model="form.gender" value="0">
                <label for="female">Female</label><br>
            </div>
            <div v-if="form.errors.has('gender')" class="error"> 
                {{form.errors.get('gender')}}
            </div>
          </div>
          </div>
          -->
         
          
            <div class="footer">
          <button :disabled="form.busy" type="submit" class="btn" :class="user ? 'btn--primary' : 'btn--success'">   {{   user ? 'update !' : 'Create !' }}</button>
            
            </div>
                
           
        </form>


</template>

<script>
import Form from 'vform'
import { serialize } from 'object-to-formdata'
import SelectData from './SelectData.vue'
export default {
  components: { SelectData },
    props : {
        user : {
            type : Object ,
            default : null
        },

    },
    data(){
        return{
            form : new Form({
                name : this.user ? this.user.name : '',
                username : this.user ? this.user.username : '',
                email : this.user ? this.user.email : '',
                password : '',
                avatar : this.user ? this.user.avatar : '/storage/avatars/default.jpg',
                role_id : 3
            }),
            created : {} ,
            avatar : '',
            
        }
    },
    methods : {
        
        select(type ,data){
            console.log(data)
                this.form.role_id = data.id
        },
            

        changeAvatar(evt){
            this.form.avatar = evt.target.files[0];
            var reader = new FileReader();
                
            reader.onload = (e) => {
                this.avatar = e.target.result;
            }
            reader.readAsDataURL(evt.target.files[0]);
        },
        nextStep(){
            if(this.step == 2) this.step = 1 
            else this.step++
        },
        update(){
            this.form.submit('post','/users/'+this.user.id,{
                transformRequest: [function (data, headers) {
                    data['_method'] = 'PUT';
                return serialize(data)
                }],
              onUploadProgress: e => {
              }
            }).then((response)=>{
                this.$emit('done')
                this.$root.alert('User : '+this.user.name + ' updated successfully' , 3)

            })
        },
        create(){
            this.form.submit('post' , '/users' ,{
                transformRequest: [function (data, headers) {
                    return serialize(data)
                }],
              onUploadProgress: e => {
                  }
            }).then((response)=>{
                this.created = response.data
                this.$emit('done' , this.created.id)
                this.$root.alert('User : '+response.data.name + ' created successfully' , 3)

            })
        },
        
        
    
    
        },
    mounted(){
        
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
    .file-upload {
        margin: 0.5rem auto;
        cursor: pointer;
    position: relative;
    width: 10rem;
    height: 10rem;
    border-radius: 100% ;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;

}
.file-upload {
    box-shadow: 0 0 1px 1px rgb(155, 155, 155);
}
.file-upload img{
    width: 100%;
}
.file-upload:hover {
    background-color: rgb(49, 49, 49);
}
.file-upload:hover img {
    opacity: 0.5;
}
.file-upload:hover .upload-text{
    visibility: visible;
}
.upload-text {

    visibility: hidden;
    position: absolute;
    top: 48%;
    width: 100%;
    text-align: center;
    color: white;
    font-weight: 600;
    letter-spacing: 0.1rem;
    font-family: 'Arial Narrow', Arial, sans-serif;
}
.file-input {
    border-radius: 100% ;

    opacity: 0;
    cursor: pointer;
    position: absolute;
    z-index: 5;
    top: 0;
    left: 0;
    height: 10rem;
    width: 10rem;
}

.btn-green {
    color: white;
    background-color: rgb(48, 133, 48);
    padding: 0.5rem 1rem ;
    border-radius: 5px ;
    cursor: pointer;
    
}
.btn-gray {
    color: white;
    background-color: rgb(53, 53, 53);
    padding: 0.5rem 1rem ;
    border-radius: 5px ;
    cursor: pointer;
    
}


</style>