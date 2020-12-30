<template>
	<div class="data-list">
		<div class="data-title data-item" >
			<div class="name">Member</div>
			<div class="activity">Activity</div>
			<div class="cycle">Paid</div>
			<div class="status">Status</div>
			<div class="expired_at">Expire</div>
			<div class="param">&nbsp;</div>

		</div>
		<div class="data-item" v-for="m in memberships.data" :key="m.index" :class="'data-item--'+m.statuses[0].name">
			<div  class="name">{{m.member.name}}</div>
			<div class="activity">{{m.package.activity.name}}</div>
			<div class="cycle">{{m.package.cycle.name}}</div>
			<div class="status" :class="'status--'+m.statuses[0].name">{{m.statuses[0].name}}</div>

			<div v-if="m.statuses[0].name !='suspended'" class="expires_at status--expired">
				{{m.statuses[0].name == "active" ? 'expiers' : 'expired'}}  {{m.expired_at | moment( "from" , "now")}}
			</div>
			<div v-else>
				suspended {{m.statuses[0].created_at | moment("MMM Do YYYY")}}
			</div>
			<div class="param">

				<font-awesome-icon v-if="m.statuses[0].name == 'suspended'"  size="lg"   
				class="icon icon--success" icon="play-circle" title="reactivate membership" @click="activate(m)"></font-awesome-icon>

				<font-awesome-icon v-if="m.statuses[0].name == 'active'" size="lg"   
				class="icon icon--danger" icon="pause-circle" title="suspend membership" @click="suspend(m)"></font-awesome-icon>
				
				<font-awesome-icon   size="lg"   
				:class="'icon icon--'+ (isNaN(exp) ? 'success' :'primary')" icon="retweet" :title="isNaN(exp) ? 'renew membership' :'expand membership'" @click="renew(m)"></font-awesome-icon>

				<!-- <font-awesome-icon  size="lg"   class="icon icon--warning" icon="edit" title="edit membership"></font-awesome-icon> -->

			</div>
		</div>
		<laravel-vue-pagination  :data="memberships" @pagination="get"/>
	</div>
</template>

<script>
import LaravelVuePagination from "./LaravelVuePagination.vue"
export default {
	components : {
		LaravelVuePagination,
	},
	
	props : {
		exp : {
			default : 3,
		}
	},
	data(){
		return {
			memberships : {}
		}
	} ,
	methods : {
		get(page = 1){
			if(isFinite(this.exp)) {
				axios.get('/memberships?expiring='+this.exp+'&page='+page).then((response)=>{this.memberships = response.data})
			}else if (this.exp == "expired") {
				axios.get('/memberships?expired=true&page='+page).then((response)=>{this.memberships = response.data})
			}else if (this.exp == "suspended") {
				axios.get('/memberships?suspended=true&page='+page).then((response)=>{this.memberships = response.data})
			}
		},
		activate(m){
			axios.post('membership/'+m.id+'/activate')
				.then(response=> this.$root.alert('membership for  " '+m.member.name+' "  is activated' , 3 , { color : 'success'}))
        },
        suspend(m){
			axios.post('membership/'+m.id+'/suspend')
				.then(response=> this.$root.alert('membership for  " '+m.member.name+' "  is suspended' , 3 , { color : 'danger'}))
        },
        renew(m){
			axios.post('membership/'+m.id+'/renew')
				.then(response=> this.$root.alert('membership for  " '+m.member.name+' "  is renewed' , 3 , { color : 'primary'}))
        }
	},
	mounted (){
		setInterval(() => {
			this.get()
		}, 60000);
		Echo.channel('updates')
			.listen('MembershipUpdate' , ()=>{
						this.get()

			})
		this.get()
	}
}
</script>

<style scoped>

	.data-item {
		display: flex;
		padding: 0.5rem 1rem;
		margin: 0.5rem;
		border-bottom: 1px solid rgb(170, 170, 170);
	}
	.data-item .name {
		font-weight: 600;
	}
		.data-title {
		font-weight: 600;
	}
	.data-item > *{
		flex-basis: 25%;
		flex-shrink: 1;
		flex-grow: 1;
		text-align: center;
		vertical-align: middle;
	}
	.data-list {
		min-width: 20rem;
		
	}
	@media (max-width : 500px) {
		.data-list {
			font-size: 0.7rem;
			
		}
	}
	
	
	.status--active {
		color: rgb(29,167,90);
		
		
	}
	.status--suspended {

		color: rgb(243,156,18);
		
		
	}
		.status--expired {
			color: rgb(221,75,57);
		
		
	}
</style>