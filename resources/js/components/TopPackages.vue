<template>
	<div class="data-list">
		<div class="data-title data-item" >
			<div class="name">Name</div>
			<div class="activity">Activity</div>
			<div class="cycle">Cycle</div>
			<div class="active-members">Members</div>

		</div>
		<div class="data-item" v-for="p in data" :key="p.index">
			<div class="name">{{p.name}}</div>
			<div class="activity">{{p.activity}}</div>
			<div class="cycle">{{p.cycle}}</div>
			<div class="active-members">{{p.count  + (p.count == 1 ? ' Member' : ' Members' )}}</div>

		</div>
	</div>
</template>

<script>

export default {

  props: ['packages'],
  data() {
      return {
		  data : []
      }
    
      
  },
  
	
  methods : {
	  generateData(){
			var data = []
			var label = ''
			var act = ''
			var cyc = ''
			for( const el in this.packages) {
				label = this.packages[el].name
				act = this.packages[el].activity.name
				cyc = this.packages[el].cycle.name
				var c = 0
				for (const le in this.packages[el].memberships) {
					if(this.packages[el].memberships[le].statuses[0].name === 'active') {
						c++
					}
				}
				data.push({
					name : label ,
					activity : act ,
					cycle : cyc ,
					count : c
				})
				
			}
			data.sort((a, b) => b.count - a.count)
			
			data = data.slice(0,8)
			this.data = data

    },
  },
  mounted () {
	   Echo.channel('updates')
			.listen('MemberUpdate' , ()=>{
				this.generateData()


			})
	this.generateData()

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
	}
	.data-list {
		min-width: 24rem;
		
	}
	@media (max-width : 500px) {
		.data-list {
			font-size: 0.7rem;
			min-width: 20rem;
			
		}
	}
	
</style>