
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        islogged: false
    },
    mutations: {
        setIslogged(state, islogged) {
            state.islogged = islogged
        }
    },
    actions: {
        updateIslogged({ commit }, islogged) {
            commit('setIslogged', islogged)
        }
    }
})
