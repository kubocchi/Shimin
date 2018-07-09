
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
import App from './components/App'

/*************************START FRONTEND**************************/

require('./external/bootstrap')
require('./external/jquery.sliderPro')
require('./external/script')
//require('./external/scrol-fixed')
import PopperJs from 'popper.js'
//Vue.use(PopperJs)
window.jQuery = require('jquery')
import ErrorHandler from './external/error-handler'
// Vue.use(ErrorHandler)

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
import { ServerTable, ClientTable, Event } from 'vue-tables-2';
Vue.use(ClientTable);
Vue.component('delete', {
    props: ['data', 'index', 'column'],
    template: `<a class='delete' @click.prevent='erase'></a>`,
    methods: {
        erase() {
            let id = this.data.id; // delete the item
        }
    }
});

// Sweet alert
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

// vue spinner
import Spinner from 'vue-spinkit'
Vue.component('Spinner', Spinner)

// vue loading overlay
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.min.css';
Vue.use(Loading);

// Vee validate
import ja from 'vee-validate/dist/locale/ja'
import VeeValidate, { Validator } from 'vee-validate';
Validator.localize('ja', ja);
Vue.use(VeeValidate);

// Vue-select
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

// Pretty Checkbox
import PrettyCheckbox from 'pretty-checkbox-vue';
Vue.use(PrettyCheckbox);


/***********************END BACKEND***********************/

// Routes
import routeCollection from './router/index'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
const router = new VueRouter({
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    mode: 'history',
    base: '/',
    routes: routeCollection
});

import Vuex from 'vuex';
Vue.use(Vuex);
import VuexPersistence from 'vuex-persist'
const vuexLocal = new VuexPersistence({
    storage: window.localStorage
})

const store = new Vuex.Store({
    state: {
        user: null // default value
    },
    getters: {
        fruitsCount () {
            return state.user
        }
    },
    mutations: {
        changeUser(state, user) {
            console.log('Mutation: changeuser to', user)
            state.user = user
        }
    },
    plugins: [vuexLocal.plugin]
})





const app = new Vue({
    el: '#app',
    store,
    render: h => h(App),
    router,
});



