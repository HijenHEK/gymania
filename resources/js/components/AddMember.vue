<template>
  <div class="modal">
    <font-awesome-icon  size="2x" @click="hideModal" color="white" class="icon icon--close" icon="times"></font-awesome-icon>



<div class="content">
    
    <form v-if="step==1"  class="form" @submit.prevent="addMember" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
        <div class="group">
            
            <div class="file-upload">
                <img :src="this.avatar" ref="avatar" class="mx-auto avatar">
                <div class="upload-text">Change avatar ?</div>
            <input @change="changeAvatar" name="avatar" type="file"  class="file-input" />
            </div>
        </div> 
          <div class="group">
            <label for="name"></label>
            <input v-model="form.name" ref="add"  type="text" name="name" placeholder="name"
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
                <input type="radio" id="male" name="gender" v-model="form.gender" value="1">
                <label for="male">Male</label><br>
                <input type="radio" id="female" name="gender" v-model="form.gender" value="0">
                <label for="female">Female</label><br>
            <div v-if="form.errors.has('gender')" class="error"> 
                {{form.errors.get('gender')}}
            </div>
          </div>
          </div>
         
          

          <button :disabled="form.busy" type="submit" class="btn-green">add!</button>
                
           
        </form>
        <div v-else-if="step==2" class="adding-packages">
            <div class="body form">
                        <h3 class="header">you can add packages now !</h3>

                <div class="select-package group">
                <input type="text" name="package" id="packages" class="control" v-model="packageQuery" @keyup="searchPackages($event)" placeholder="search and select packages">
                <div v-if="searchedPackages" class="packages-list">
                    <div v-for="p in searchedPackages" :key="p.id" @click="selectPackage(p)" class="package control">
                        {{p.name}}
                    </div>
                </div>
            </div>

            <div v-if="selectedPackages.length" class="selected-packages group">
                <div class="control">packages to include :</div>    
                <div v-for="p in selectedPackages" @click="removePackage(p.index)" :key="p.index" class="package selected control">
                    {{p.name}}
                </div>
            </div>
            </div>

            <div class="footer">
                <button class="btn-gray" @click="hideModal">skip</button>

                <button class="btn-green" @click="addPackages">add packages</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Form from 'vform'

export default {
    props : ['member'],
    data(){
        return{
            form : new Form({
                name : '',
                username : '',
                email : '',
                phone : '',
                age : '',
                gender : '',
                address : '',
            }),
            step: 1 ,
            packages : {} ,
            packageQuery : '' ,
            memberCreated : {} ,
            selectedPackages : [] ,
            searchedPackages : {} ,
            avatar : '/storage/avatars/default.jpg',
        }
    },
    methods : {
        hideModal(){
            this.step = 1 ;
            this.$emit('hide-modal');
        },
        // isNumber(evt){
        //     if(! isFinite(event.key)) {
        //         if(evt.target.value.length == 1 ) {
        //             evt.target.value = ""
        //         }else {
        //             evt.target.value = evt.target.value.slice(0,-1)
        //         }
        //     }
        // },
        changeAvatar(evt){
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
        addMember(){
            this.form.post('/members').then((response)=>{
                this.memberCreated = response.data
                this.nextStep()
            })
        },
        getPackages(){
            axios.get('/packages').then((response)=>{
            this.packages = response.data
            
        })
        
        },
        searchPackages(e){
            this.searchedPackages =  this.packages.filter((p)=>{
                if( p.name.includes(this.packageQuery) && !this.selectedPackages.includes(p)) return p
            })

            if(this.packageQuery.length == 0) this.searchedPackages = {}

            if(e.keyCode == 13 && this.searchedPackages){
                this.selectPackage(this.searchedPackages[0])
            }
            
        },
        selectPackage(p){
            this.selectedPackages.push(p)
            this.searchedPackages = {}
        },
        removePackage(p){
            this.selectedPackages.splice(p,1)
        },
        addPackages(){

            
                axios.post('/members/'+this.memberCreated.id+'/memberships' , this.selectedPackages)
                .then(  response => console.log(response.data) )


                this.hideModal();
        }
        
    },
    
    mounted(){
        this.getPackages()
    }
}
</script>

<style scoped>

    .form {
        width: 20rem;
        margin: 0 auto;
        
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
.select-package {
    margin-bottom: 0.5rem;
    position: relative;
}
.packages-list {
    position: absolute;
    width: 100%;
    
}
.adding-packages {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.adding-packages  .footer {
    margin: 0 auto;
    width: 100%;
    display: flex;
    justify-content: space-between;
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