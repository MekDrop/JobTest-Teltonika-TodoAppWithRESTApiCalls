import Vuex from 'vuex';

export default new Vuex.Store({
    strict: true,
    state:  {
        jwt_key: null,
        error: null
    },
    mutations: {
        setData(state, data) {
            for (let x in data) {
                state[x] = data[x];
            }
        },
        clearError(state) {
            state.error = null;
        }
    },
    getters: {
        getJWTKey(state) {
            return state.jwt_key;
        },
        getError(state) {
            return state.error;
        },
        isLoggedIn(state) {
            return state.jwt_key !== null;
        }
    }
});