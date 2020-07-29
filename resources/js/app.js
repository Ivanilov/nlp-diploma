import Vue from 'vue'
import VueRouter from 'vue-router'
import Buefy from 'buefy';
import 'buefy/dist/buefy.css';

Vue.use(VueRouter);
Vue.use(Buefy);

import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import UsersIndex from './views/UsersIndex'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
        {
            path:'/users',
            name:'users.index',
            component: UsersIndex
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
