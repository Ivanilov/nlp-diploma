import Vue from 'vue';
import VueRouter from 'vue-router';
import Buefy from 'buefy';
import 'buefy/dist/buefy.css';
import { Plugin } from 'vue-fragment';
import store from './components/store/store';

Vue.use(VueRouter);
Vue.use(Buefy);
Vue.use(Plugin);

import App from './components/App';
import LangDetect from './components/pages/LangDetect';
import Home from './components/pages/Home';
import Sentiment from "./components/pages/Sentiment";
import Neighbouring from "./components/pages/Neighbouring";
import ConceptGraph from "./components/pages/ConceptGraph";
import Summarize from "./components/pages/Summarize";
import EntityExtraction from "./components/pages/EntityExtraction";

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
            path: '/sentiment',
            name: 'sentiment',
            component: Sentiment
        },
        {
            path: '/neighbouring',
            name: 'neighbouring',
            component: Neighbouring
        },
        {
            path: '/concept',
            name: 'concept',
            component: ConceptGraph
        },
        {
            path: '/summarize',
            name: 'summarize',
            component: Summarize
        },
        {
            path: '/entityExtract',
            name: 'entityExtract',
            component: EntityExtraction
        }
    ],
});

const app = new Vue({
    el: '#app',
    store: store,
    components: { App },
    router,
});
