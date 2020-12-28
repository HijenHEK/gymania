import MainBoard from './components/MainBoard.vue'
import MembersManagement from './components/MembersManagement.vue'
import ActivitiesManagement from './components/ActivitiesManagement.vue'
import CyclesManagement from './components/CyclesManagement.vue'
import PackagesManagement from './components/PackagesManagement.vue'
import StaffManagement from './components/StaffManagement.vue'
import VueRouter from 'vue-router'

const routes = [
  { path: '/', component: MainBoard},
  { path: '/members', component: MembersManagement },
  { path: '/packages', component: PackagesManagement },
  { path: '/activities', component: ActivitiesManagement },
  { path: '/cycles', component: CyclesManagement },
  { path: '/staff', component: StaffManagement },
  { path: '*', redirect: '/' }

]

export const router = new VueRouter({

   mode: 'abstract',
    routes 
})
