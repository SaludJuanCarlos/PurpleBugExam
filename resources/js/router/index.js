import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home.vue'
import ExpensesView from '../views/Expenses.vue'
import RolesView from '../views/Roles.vue'
import UsersView from '../views/Users.vue'
import CategoriesView from '../views/Categories.vue'
import DashboardView from '../components/Dashboard.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView
    },

    {
      path: "/dashboard",
      name: "dashboard",
      component: DashboardView
    },

    {
      path: "/expenses",
      name: "expenses",
      component: ExpensesView
    },
    {
      path: "/roles",
      name: "roles",
      component: RolesView
    },
    {
      path: "/users",
      name: "users",
      component: UsersView
    },
    {
      path: "/categories",
      name: "categories",
      component: CategoriesView
    },
  ]
})

export default router