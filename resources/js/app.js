import Vue from 'vue'
import VueRouter from 'vue-router'
import Buefy from 'buefy';
import 'buefy/dist/buefy.css';
import { Plugin } from 'vue-fragment'
import store from './components/store/store'

Vue.use(VueRouter);
Vue.use(Buefy);
Vue.use(Plugin);

import App from './components/App'
import LangDetect from './components/pages/LangDetect'
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
            path: '/lang-detect',
            name: 'lang.detect',
            component: LangDetect,
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
    store: store,
    components: { App },
    router,
});
