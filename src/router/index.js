import { createRouter, createWebHistory } from 'vue-router'

import LoginView from '../views/Admin/LoginView.vue'
import AdminView from '../views/Admin/AdminView.vue'
import AdminQuiz from '../views/Admin/AdminQuiz.vue'
import AdminAnswers from '../views/Admin/AdminAnswers.vue'

import HomeView from '../views/HomeView.vue'
import ResponseView from '../views/ResponseView.vue'

import { getCurrentUser, storageName } from '../init'


const requireAuth = (to, from, next) => {
  const token = getCurrentUser(storageName).token;
  if (token) {
    // L'utilisateur est connecté, autorise la navigation
    next();
  } else {
    // L'utilisateur n'est pas connecté, redirige vers la page de connexion
    next('/login');
  }
};

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/reponse/:token',
      name: 'responses',
      component: ResponseView
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },

    {
      path: '/administration',
      name: 'admin.home',
      component: AdminView,
      beforeEnter: requireAuth
    },

    {
      path: '/administration/questionnaire',
      name: 'admin.quizz',
      component: AdminQuiz,
      beforeEnter: requireAuth

    },

    {
      path: '/administration/reponses',
      name: 'admin.answers',
      component: AdminAnswers,
      beforeEnter: requireAuth
    },
  ]
})


export default router
