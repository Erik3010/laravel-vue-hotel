import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('token'),
        errors: []
    },

    getters: {
        isAuth: state => {
            return state.token != null;
        }
    },

    mutations: {
        SET_TOKEN(state, payload) {
            state.token = payload
        },
        SET_ERRORS(state, payload) {
            state.errors = payload
        },
        CLEAR_ERRORS(state, payload) {
            state.errors = []
        }
    },

    actions: {
        submit({ commit }, payload) {
            
        }
    }
})

export default store