
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

import Vue from 'vue'
//import App from './components/App'
import App from './components/Frontend'
//import $ from 'jquery'
/*************************START FRONTEND**************************/


require('./external/bootstrap')
require('./external/jquery.sliderPro')
require('./external/script')
import PopperJs from 'popper.js'
//Vue.use(PopperJs)
window.jQuery = require('jquery')

/*************************END FRONTEND**************************/


/*************************START BACKEND**************************/
// Toggle Button
import ToggleButton from 'vue-js-toggle-button'
Vue.use(ToggleButton)

// Editor
import wysiwyg from "vue-wysiwyg"
Vue.use(wysiwyg, {
    image: {
        uploadURL: "/api/active-center/images/upload",
        dropzoneOptions: {}
    },
})

// Datatable
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

// Sweet alert
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

import Spinner from 'vue-spinkit'
Vue.component('Spinner', Spinner)

import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.min.css';
// Init plugin
Vue.use(Loading);

import ja from 'vee-validate/dist/locale/ja'
import VeeValidate, { Validator } from 'vee-validate';

Validator.localize('ja', ja);
Vue.use(VeeValidate);

/***********************END BACKEND***********************/

// Routes
import routeCollection from './router/index'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
const router = new VueRouter({
    mode: 'hash', 
    routes: routeCollection
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
});
