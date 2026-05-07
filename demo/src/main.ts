import { createApp } from 'vue'
import { createRouter, createWebHashHistory } from 'vue-router'
import App from './App.vue'
import './style.css'

const router = createRouter({
    history: createWebHashHistory('/Lumina/'),
    routes: [
        { path: '/',        component: () => import('./pages/Home.vue') },
        { path: '/cars',    component: () => import('./pages/Cars.vue') },
        { path: '/cars/:id', component: () => import('./pages/CarShow.vue') },
    ],
    scrollBehavior(to) {
        if (to.hash) return { el: to.hash, behavior: 'smooth' }
        return { top: 0 }
    },
})

createApp(App).use(router).mount('#app')
