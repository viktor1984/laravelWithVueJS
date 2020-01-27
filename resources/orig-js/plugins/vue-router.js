import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from '@/routes'
// import store from '@/store'

Vue.use(VueRouter);

export const router = new VueRouter({
  mode: 'history',
  routes
});

Vue.router = router;

// router.beforeEach((to, from, next) => {
//   const checkRoute = (route) => {
//     const routes = ['pushex.index', 'pushex.projects', 'pushex.settings', 'pushex.feedback']
//     return routes.includes(route)
//   }

  // if (from.name && checkRoute(to.name)) store.dispatch('activatePreloader')
//   next()
// })

// router.afterEach((to, from) => {
//   if (store.getters.isPreloaderDisplayed) setTimeout(() => store.dispatch('deactivatePreloader'), 1500)
// })

export default {
  router
}
