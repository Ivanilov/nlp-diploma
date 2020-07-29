import Vue from 'vue'
import VueRouter from 'vue-router'
import Buefy from 'buefy';
import 'buefy/dist/buefy.css';

Vue.use(VueRouter);
Vue.use(Buefy);

import App from './components/App'
import Hello from './components/pages/Hello'
import Home from './components/pages/Home'
import UsersIndex from './components/pages/UsersIndex'

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
