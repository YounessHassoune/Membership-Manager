import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Register from '../views/Register.vue'
import NotFound from '../views/NotFound.vue'
import UserDashboard from '../views/Individual/UserDashboard.vue'
import BuisnessDashboard from '../views/Business/BuisnessDashboard.vue'
const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/userdashboard',
    name: 'UserDashboard',
    component: UserDashboard
  },
  {
    path: '/buisnessdashboard',
    name: 'BuisnessDashboard',
    component: BuisnessDashboard
  },
  {
    path: '/:catchAll(.*)',
    name: 'NotFound',
    component: NotFound
  },


]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
