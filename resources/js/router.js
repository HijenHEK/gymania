import MainBoard from './components/MainBoard.vue'
import MembersManagement from './components/MembersManagement.vue'
import VueRouter from 'vue-router'

const routes = [
  { path: '/', component: MainBoard },
  { path: '/members', component: MembersManagement }
]

export const router = new VueRouter({
   mode: 'abstract',

  routes 
})
