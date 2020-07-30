import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        users: [
            {
                name: 'Vasya',
                email: 'vasyaLoh@loh.loh'
            },
            {
                name: 'Petya',
                email: 'petyaToszeLoh@loh.loh'
            }
        ]
    },
    getters: {
        //
    },
    mutations: {
        //
    },
    actions: {
        //
    }
});
