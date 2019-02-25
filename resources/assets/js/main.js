import Vue from 'vue';
import Vuex, {mapGetters} from 'vuex';
import VueRouter from 'vue-router';

import 'element-ui/lib/theme-chalk/index.css';
import '../sass/main.scss';
import ElementUI from 'element-ui';

Vue.use(ElementUI);
Vue.use(Vuex);
Vue.use(VueRouter);

(new Vue({
    store: require('./store.js').default,
    router: require('./router.js').default,
    computed: {
        ...mapGetters({
            jwt_key: 'getJWTKey',
            error: 'getError'
        }),
    },
    created() {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded",  () => {
                this._readInitialData();
            });
        } else {
            this._readInitialData();
        }
    },
    methods: {
        _readInitialData() {
            this.$store.commit(
                'setData',
                JSON.parse(
                    document.getElementById('initial').innerText
                )
            );
        },
        _onErrorClose() {
            this.$store.commit('clearError');
        }
    },
    watch: {
        error(msg) {

        }
    }
})).$mount('#app');