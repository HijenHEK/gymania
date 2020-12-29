<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  props: ['activities'],
  data() {
      return {
		  labels : [],
		  data : [ ],
          options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true,
							fontSize: 12,
							fontColor : '#202020'
						},
						gridLines: {
							display: true,
						}
					}],
					xAxes: [{
						ticks: {
							beginAtZero: true,
							fontSize: 13,
							fontColor : '#202020'
						},
						gridLines: {
							display: false
						}
					}]
				},
				legend: {
					display: false,
					
					
				},
				responsive : true ,
				tooltips: {
					enabled: true,
					mode: 'single',
					callbacks: {
						label: function(tooltipItems, data) {
							return tooltipItems.yLabel + (tooltipItems.yLabel == 1 ? ' member' : ' members');
						}
					}
				},
				responsive: true,
				maintainAspectRatio: false,
				height: 200,
      }
    
      }
  },
  computed : {
	  chartData(){

		  return  {
			  		labels: this.labels,
					datasets: [{
						label: 'Active Members',

						backgroundColor: '#f87979',
						pointBackgroundColor: 'white',
						borderWidth: 1,
						pointBorderColor: '#249EBF',
						barThickness: 40,
						data: this.data
					}]
				}
		} 
  },
  watch : {
	  activities : function(){
		  	this.generateData()
			this.renderChart(this.chartData, this.options)

	  }
  },
  methods : {
	  generateData(){
			var labels = []
			var data = []
			for( const el in this.activities) {
				labels.push(this.activities[el].name)
				var c = 0
				for (const le in this.activities[el].memberships) {
					if(this.activities[el].memberships[le].statuses[0].name === 'active') {
						c++
					}
				}
				data.push(c)
				
			}
				this.labels = labels	
				this.data = data	

    },
  },
  
  mounted () {
	//   Echo.channel('updates')
	// 		.listen('MemberUpdate' , ()=>{
	// 				this.generateData()
	// 				this.renderChart(this.chartData, this.options)



	// 		})
	this.generateData()
	this.renderChart(this.chartData, this.options)

  }
}
</script>

<style>
</style>