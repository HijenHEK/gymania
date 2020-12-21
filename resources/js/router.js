import MainBoard from './components/MainBoard.vue'
import MembersManagement from './components/MembersManagement.vue'
import PackagesManagement from './components/PackagesManagement.vue'
import VueRouter from 'vue-router'

const routes = [
  { path: '/', component: MainBoard },
  { path: '/members', component: MembersManagement },
  { path: '/packages', component: PackagesManagement }
]

export const router = new VueRouter({
   mode: 'abstract',
  routes 
})
