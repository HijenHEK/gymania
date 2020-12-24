<template>
  <div class="single-member">
    <div class="nav">
        <font-awesome-icon  size="2x" @click="back" color="black" class="icon icon--close" icon="arrow-left"></font-awesome-icon>
    </div>

        
        <div class="member-info">
                <div class="header">
                    <div class="avatar">
                        <img :src="member.avatar" alt="" srcset="">
                    </div>
                    <div class="info">
                        <div class="id">
                            <label for="ID"> ID </label> <div class="control"> {{member.id}} </div>
                        </div>
                        <div class="name">
                            <label for="Name">Name </label> <div class="control"> {{member.name}} </div>
                        </div>
                        <div class="age">
                            <label for="Age"> Age </label> <div class="control"> {{member.age || 'N/A'}} </div>
                        </div>

                        <div class="email">
                            <label for="Email"> Email </label> <div class="control">{{member.email || 'N/A'}} </div>
                        </div>
                        <div class="phone">
                            <label for="Phone"> Phone </label> <div class="control"> {{member.phone || 'N/A'}} </div>
                        </div>

                        <div class="adress">
                            <label for="Address"> Address </label> <div class="control">{{member.address || 'N/A'}} </div>
                        </div>
                    </div>
                    <div class="param">

                        <font-awesome-icon  size="lg"  class="icon icon--danger" icon="plus" @click="addPackagesModal"></font-awesome-icon>

                        <font-awesome-icon  size="lg"  class="icon icon--primary" icon="edit" @click="editMemberModal"></font-awesome-icon>

                    </div>
                    
                </div>
                <div class="content">
                    
                    <div v-for="membership in memberships" :key="membership.id" class="membership" :class="membership.status">
                            <div class="id">
                                # {{membership.id}}
                            </div>                            
                            <div class="package">
                                package : {{membership.package.name}}
                            </div>
                            <div class="fee">
                                {{membership.package.fee}} dt
                            </div>
                            <div class="cycle">
                                paid {{membership.package.cycle.name}}
                            </div>
                            <div class="activity">
                                {{membership.package.activity.name}}
                            </div>
                            <div class="status">
                                 {{membership.status}}
                            </div>
                            <div class="created">
                                 created : {{membership.created_at | moment("MMM Do YYYY")}}
                            </div>
                            <div class="expires_at">
                                 expiers :{{membership.expired_at}}
                            </div>
                    </div>
                </div>
        </div>  
        <add-package :member="member.id" v-show="modal=='addpackage'" @hide-modal="modal=null"></add-package>
        <cu-member v-show="modal=='editMember'" :member="member" action="edit" @hide-modal="modal=null" ></cu-member>

  </div>
</template>

<script>
export default {
    props : ['member'],
    data(){
        return {
            memberships : [],
            modal : null,
        }
    },
    computed : {
        
    },
    methods : {
        addPackagesModal(){
            this.modal='addpackage' 
        },
        editMemberModal(){
            this.modal='editMember' 
        },
        back(){
            this.$emit('back');
        },
        getMemberships(){
            axios.get('/members/'+this.member.id+'/memberships').then(response => this.memberships = response.data)
        }
    },
    mounted(){
        this.getMemberships()
    }
}
</script>

<style scoped>
.single-member {
    width: 100%;
    padding: 0.5rem;
            height: 100%;

}
.member-info {
        background-color: white;
        box-shadow: 0 0 2px 1px rgb(231, 231, 231);
        height: 100%;
        padding: 1rem;
        margin: 1rem 0;
        border-radius: 5px;
        width: 100%;
}
.header {
        margin: 0.5rem;
        padding: 0.5rem;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        

        width: 100%;
    }
.info {
    min-width: 200px;
    
}
.info > * {
    display: flex;
    padding: 0.2rem 0;
            border-bottom: 1px solid rgb(202, 202, 202);

}
.param {
    align-self: flex-start;
    margin : 3rem;
    margin-left: auto;
    display: flex;
    flex-wrap: nowrap;

}
.param > * {
    margin: 0.5rem;
}
.info > * >* {
    flex-basis: 7rem;
}
.info > * .control {
    flex-grow: 0.5;
    flex-shrink: 0.5;
}



    .header .avatar {
        width: 15rem;
        height:  15rem;
        min-width: 5rem;
        margin: 2rem;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        
    }


    .header .avatar img {
        width: 100%;
        
    }

    .membership {
        display: flex;
        justify-content: space-between;
        align-items: stretch;
        flex-wrap: wrap;
        margin: 0.5rem 0;
        box-shadow: 0 0 2px 1px rgb(158, 158, 158);
        width: 100%;
        background-color: white;
        border-radius: 5px;
        overflow: hidden;

    }
    .membership > * {
        flex-basis: 4rem;
        flex-grow: 1;
        flex-shrink: 1;
        padding: 1rem 0.5rem;
        font-size: 0.9rem;
        word-wrap: none;
        box-shadow: 0 0 1px 0px rgb(158, 158, 158);
        vertical-align: middle;

    }
    .active {
        box-shadow: 0 0 2px 1px rgb(29, 173, 16);
        width: 100%;
        background-color: white;
        

    }
    .active > * {
        color: white;
        background-color: rgb(21, 131, 11) ;
        box-shadow: 0 0 2px 0px white;

    }

    @media (max-width : 800px) {
        .header {
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding-top: 0 ;
            margin-top: 0 ;
        }
        .param {
            order: 1;
            margin-top: 0;
            margin-right: 0;

        }
        .info {
                margin: 0 auto;

        }
        .header .avatar {
            order: 2;
            margin: unset;
                        margin-bottom: 1rem;

        }        
        .header .info {
            order: 3;
                                    margin-bottom: 1rem;

        }
    }
</style>