<template>
  <div  v-if="loaded">
  <div class="cards">
  <router-link to="/memberships/active">
      <dashboard-card color="blue" >
          <div class="header">
            <div class="title">Active</div>
            <div class="side-meta">{{activeMemberships.length}}</div>
          </div>
      </dashboard-card>
  </router-link>
    <router-link to="/memberships/expiring">
      <dashboard-card color="red" >
          <div class="header">
            <div class="title">Expiring</div>
            <div class="side-meta">{{ExpiringMemberships.length}}</div>
          </div>
      </dashboard-card>
    </router-link>
    <router-link to="/members">
      <dashboard-card color="green" >
          <div class="header">
            <div class="title">Total members</div>
            <div class="side-meta">{{members.length}}</div>
          </div>
      </dashboard-card>
    </router-link>
    <router-link to="/packages">

          <dashboard-card color="yellow" >
          <div class="header">
            <div class="title">Packages</div>
            <div class="side-meta">{{packages.length}}</div>
          </div>
      </dashboard-card>
    </router-link>
    </div>

    <div class="main">
      <!-- <bars-chart :chartdata="data"></bars-chart> -->
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      memberships : {},
      members : {},
      packages : {},
    }  
  },
  computed : {
    data(){
      return {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
              datasets: [{
                label: 'Data One',
              backgroundColor: '#f87979',
              pointBackgroundColor: 'white',
              borderWidth: 1,
              pointBorderColor: '#249EBF',
              barThickness: 20,
              
              data: [5, 10, 15, 25, 45, 70, 115, 185, 70, 75, 70, 60]
          }]
        }
    },
    loaded (){
      return this.memberships.length && this.members.length 
    },
    
    activeMemberships(){
      return this.memberships.filter(e => {
          if(e.statuses[0].name == 'active') return e 
      })
    },
    ExpiringMemberships(){
      return this.memberships.filter(e => {
          if(e.expired_at) {

            // Split timestamp into [ Y, M, D, h, m, s ]
          var t = e.expired_at.split(/[- :]/);
          // Apply each element to the Date function
          var date = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
          date.setDate(date + 3 )

          if(date >= new Date()) return e 
          }else {
            return e
          }
      })
    },
  },
  methods : {
    
    getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      },
    getMemberships(){
      axios.get('/memberships?all=true').then(response=>this.memberships = response.data)
    },
      getMembers(){
      axios.get('/members?all=true').then(response=>this.members = response.data)
    },
      getPackages(){
      axios.get('/packages?all=true').then(response=>this.packages = response.data)
    }
  },
  created(){
    this.getMemberships()
    this.getMembers()
    this.getPackages()
  }
}
</script>

<style scoped>
.cards {
  display: flex;
  justify-content: center;
  align-items: stretch;
  flex-wrap: wrap;
}
.cards > * {
  flex-basis: 220px;
  flex-grow: 1;
  flex-shrink: 1;
  height: 100%;

}
</style>