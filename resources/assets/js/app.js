
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// import Vue from 'vue'
// import App from './components/App'
// import VueRouter from 'vue-router'

// Vue.use(VueRouter)

// const app = new Vue({
//     el: '#app',
//     render: h => h(App)
// });


import Vue from 'vue'
import App from './components/App'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Dashboard from './views/Dashboard'
import ActiveCenterForm from './views/activeCenter/Form'
import ActiveCenterList from './views/activeCenter/List'

import Editor from '@tinymce/tinymce-vue';
import VueRangedatePicker from 'vue-rangedate-picker'

Vue.use(VueRangedatePicker)

Vue.use(Editor)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/active-center/form',
            name: 'activeCenterForm',
            component: ActiveCenterForm,
        },
        {
            path: '/active-center/list',
            name: 'activeCenterList',
            component: ActiveCenterList,
        },
    ],
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
});
