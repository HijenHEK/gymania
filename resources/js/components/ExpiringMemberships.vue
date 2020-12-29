<template>
	<div class="data-list">
		<div class="data-title data-item" >
			<div class="name">Member</div>
			<div class="package">Activity</div>
			<div class="cycle">Cycle</div>
			<div class="status">Status</div>
			<div class="expired_at">Expire</div>
			<div class="param">&nbsp;</div>

		</div>
		<div class="data-item" v-for="m in memberships" :key="m.index" :class="'data-item--'+m.statuses[0].name">
			<div class="name">{{m.member.name}}</div>
			<div class="package">{{m.package.name}}</div>
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
				
				<font-awesome-icon v-if="m.statuses[0].name == 'expired'"  size="lg"   
				class="icon icon--primary" icon="retweet" title="renew membership" @click="renew(m)"></font-awesome-icon>

				<font-awesome-icon  size="lg"   class="icon icon--warning" icon="edit" title="edit membership"></font-awesome-icon>

			</div>
		</div>
	</div>
</template>

<script>

export default {
	data(){
		return {
			memberships : {}
		}
	} ,
	methods : {
		get(){
			axios.get('/memberships?exp=5&all=true').then((response)=>{this.memberships = response.data})
		},
		activate(m){
            axios.post('membership/'+m.id+'/activate')
        },
        suspend(m){
            axios.post('membership/'+m.id+'/suspend')
        },
        renew(m){
            axios.post('membership/'+m.id+'/renew')
        }
	},
	mounted (){
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
		min-width: 40rem;
		
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