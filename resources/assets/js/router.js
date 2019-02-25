import VueRouter from 'vue-router';
import store from './store.js';

let loadView = (view) => () => import(/* webpackChunkName: "view-[request]" */ `../views/${view}.vue`)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: loadView('login'),
            meta: {
                canSeeForNotLoggedInUsers: true
            }
        },
        {
            path: '/log',
            name: 'log',
            component: loadView('log'),
            meta: {
                canSeeForNotLoggedInUsers: false,
                requiredRoleToView: [
                    'role1'
                ]
            }
        },
        {
           path: '/change-password/:chash',
           name: 'change-password',
           component: loadView('change-password'),
           meta: {
               canSeeForNotLoggedInUsers: false,
               requiredRoleToView: [
                   'role1',
                   'role2'
               ]
           }
        },
        {
            path: '/',
            name: 'todo',
            component: loadView('todo'),
            meta: {
                canSeeForNotLoggedInUsers: false,
                requiredRoleToView: [
                    'role1',
                    'role2'
                ]
            }
        },
        {
            path: '*',
            name: '404',
            component: loadView(404),
            meta: {
                canSeeForNotLoggedInUsers: true,
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (!to.meta.canSeeForNotLoggedInUsers && !store.getters.isLoggedIn) {
        store.commit('setData', {error: 'To access this area you need first login'});
        next({name: 'login', params: {
            previous: to.name
        }});
    } else {
        next();
    }
});

export default router;