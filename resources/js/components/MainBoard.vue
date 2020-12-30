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
            <div class="side-meta">{{expiring.length}}</div>
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
      <div class="memberships main-el">
        <div class=" Expired-memberships">
          <h3 class="header">Expired Memberships</h3>
          <exp-memberships v-if="memberships.length > 0 " exp="expired"></exp-memberships> 
        </div>
        <div class=" Expiring-memberships">
          <h3 class="header">Expiring Memberships</h3>
          <exp-memberships v-if="memberships.length > 0 " :exp="5"></exp-memberships> 
        </div>
        <div class=" Expiring-memberships">
          <h3 class="header">Suspended Memberships</h3>
          <exp-memberships v-if="memberships.length > 0 " exp="suspended"></exp-memberships> 
        </div>
      </div>
      <div class="activities main-el">
        <div class=" activities-chart">
          <h3 class="header">Active members per Activity</h3>
          <activities-chart v-if="activities.length > 1 " :activities="activities"></activities-chart> 
        </div>
        <div class=" top-packages">
          <h3 class="header">Famous Packages</h3>
          <top-packages v-if="packages.length > 0 " :packages="packages"></top-packages> 
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ActivitiesChart from './ActivitiesChart.vue'
import ExpMemberships from './ExpMemberships.vue'
import TopPackages from './TopPackages.vue'
export default {
  components : {
    TopPackages,
    ActivitiesChart,
    ExpMemberships
  },
  data(){
    return {
      memberships : {},
      members : {},
      packages : {},
      activities : {},
      expiring : {} ,
      expired : {} ,
    }  
  },
  computed : {
    
    loaded (){
      return this.memberships.length && this.members.length 
    },
    
    activeMemberships(){
      return this.memberships.filter(e => {
          if(e.statuses[0].name == 'active') return e 
      })
    },
    // ExpiringMemberships(){
    //   return this.memberships.filter(e => {
    //       if(e.expired_at) {
    //         // Split timestamp into [ Y, M, D, h, m, s ]
    //       var t = e.expired_at.split(/[- :]/);
    //       // Apply each element to the Date function
    //       var date = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
    //       date.setDate(date + 3 )

    //       if(date >= new Date()) return e 
    //       }else {
    //         return e
    //       }
    //   })
    // },
  },
  methods : {
    
    getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      },
    getMemberships(){
      axios.get('/memberships?all=true').then((response)=>{this.memberships = response.data})
      axios.get('/memberships?all=true&expiring=5').then((response)=>{this.expiring = response.data})
      axios.get('/memberships?all=true&expired=true').then((response)=>{this.expired = response.data})
    },
      getMembers(){
      axios.get('/members?all=true').then((response)=>{this.members = response.data})
    },
      getPackages(){
      axios.get('/packages?all=true').then((response)=>{this.packages = response.data})
    },
    getActivities(){
      axios.get('/activities?all=true').then((response) => {this.activities = response.data})
    }
  },
  mounted(){
    Echo.channel('updates')
			.listen('MemberUpdate' , ()=>{
          this.getMemberships()
          this.getMembers()
          this.getPackages()
          this.getActivities()

			})
    this.getMemberships()
    this.getMembers()
    this.getPackages()
    this.getActivities()
  }
}
</script>

<style scoped>
.cards {
  display: flex;
  justify-content: center;
  align-items: stretch;
  flex-wrap: wrap;
  margin-top: 1rem;
}
.cards > * {
  flex-basis: 220px;
  flex-grow: 1;
  flex-shrink: 1;
  height: 100%;

}
.main {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
}
.main-el {
  flex-basis: 35rem;
  flex-grow: 1;
  flex-shrink: 1;
  min-width: 16rem;
  margin: 1rem;
}

.main-el .header {
  margin: 2rem ;
  text-align: center;
  color : rgb(36, 36, 36);

}
.Expiring-memberships {
  flex-basis: 50%;
  min-width : 50%;
  flex-shrink: 0;
}
.top-packages {
  max-height: unset;
}


@media (max-width : 600px) {
  .main {
    margin-top: 1rem;
  }
  .main-el {
    margin: 0.2;
  }

}
@media(max-width : 710px) {
  .memberships {
    font-size: 0.8rem;
  }
}
</style>