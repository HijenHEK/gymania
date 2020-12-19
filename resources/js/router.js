import MainBoard from './components/MainBoard.vue'
import ClientManagement from './components/ClientManagement.vue'
import VueRouter from 'vue-router'

const routes = [
  { path: '/', component: MainBoard },
  { path: '/clients', component: ClientManagement }
]

export const router = new VueRouter({
  routes 
})
