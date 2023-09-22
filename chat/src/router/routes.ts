import type {RouteRecordRaw} from "vue-router";

export const routes: RouteRecordRaw[] = [
    {
        path: '/:pathMatch(.*)*',
        redirect: {name: 'home'}
    },
    {
        path: '/chat',
        component: () => import("@/pages/chat/chat.vue")
    },

]