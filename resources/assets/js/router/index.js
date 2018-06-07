import Vue from 'vue';
import Router from 'vue-router';

// Views - Dashboard
import Dashboard from '../views/dashboard';

const routes = [
    { path: '/', component: Dashboard }
]

const router = new VueRouter({
    routes : routes, 
    mode : 'history'
})

export default new Router({
    mode: 'hash', 
    router
});



