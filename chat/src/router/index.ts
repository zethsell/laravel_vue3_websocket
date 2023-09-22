import {createRouter, createWebHistory} from 'vue-router'
import {routes} from './routes'

export const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})

// router.beforeEach((to, from, next) => {
//     const userStore = useLoginStore()
//     if (to.matched.some(record => record.meta.auth) && !userStore.isLoggedIn) {
//         next({name: 'login'})
//         return
//     }
//     next()
// })