
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




import ToggleButton from 'vue-js-toggle-button'
Vue.use(ToggleButton)

import wysiwyg from "vue-wysiwyg"
Vue.use(wysiwyg, {
    image: {
        uploadURL: "/api/active-center/images/upload",
        dropzoneOptions: {}
    },
})

import routeCollection from './router/index'


const router = new VueRouter({
    mode: 'hash', 
    routes: routeCollection
});



import {ServerTable, ClientTable, Event} from 'vue-tables-2';
Vue.use(ClientTable);
Vue.component('delete', {
    props: ['data', 'index', 'column'],
    template: `<a class='delete' @click='erase'></a>`,
    methods: {
        erase() {
            let id = this.data.id; // delete the item
        }
    }
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
});
