import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/Admin/LoginView.vue'
import AdminView from '../views/Admin/AdminView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/administration/login',
      name: 'admin.login',
      component: LoginView
      // component: () => import('../views/Admin/LoginView.vue')
    },

    {
      path: '/administration',
      name: 'admin.home',
      component: AdminView
      // component: () => import('../views/Admin/LoginView.vue')
    },
  ]
})

export default router
