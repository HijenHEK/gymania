/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(require('vue-moment'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import { library } from '@fortawesome/fontawesome-svg-core'
import { faBars } from '@fortawesome/free-solid-svg-icons'
import { faDesktop } from '@fortawesome/free-solid-svg-icons'
import { faUsers } from '@fortawesome/free-solid-svg-icons'
import { faCogs } from '@fortawesome/free-solid-svg-icons'
import { faTimes } from '@fortawesome/free-solid-svg-icons'
import { faUserCog } from '@fortawesome/free-solid-svg-icons'
import { faTrash } from '@fortawesome/free-solid-svg-icons'
import { faEdit } from '@fortawesome/free-solid-svg-icons'
import { faThLarge } from '@fortawesome/free-solid-svg-icons'
import { faPowerOff } from '@fortawesome/free-solid-svg-icons'
import { faPlus } from '@fortawesome/free-solid-svg-icons'
import { faArrowLeft } from '@fortawesome/free-solid-svg-icons'
import { faDumbbell } from '@fortawesome/free-solid-svg-icons'
import { faCalendarDay } from '@fortawesome/free-solid-svg-icons'
import { faPauseCircle } from '@fortawesome/free-solid-svg-icons'
import { faPlayCircle } from '@fortawesome/free-solid-svg-icons'
import { faRetweet } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add([faBars,faTimes, faThLarge , faEdit , faPlus , faArrowLeft, faPauseCircle , faPlayCircle,
    faTrash ,faPowerOff,faCogs,faDesktop, faUserCog , faUsers , faDumbbell , faCalendarDay , faRetweet]);

Vue.component('font-awesome-icon', FontAwesomeIcon)


Vue.component('dashboard-ui', require('./components/DashboardUi.vue').default);
Vue.component('single-member', require('./components/SingleMember.vue').default);
Vue.component('cu-member', require('./components/CuMember.vue').default);
Vue.component('add-package', require('./components/AddPackage.vue').default);
Vue.component('cu-package', require('./components/CuPackage.vue').default);
Vue.component('select-data', require('./components/SelectData.vue').default);
Vue.component('modal-ui', require('./components/ModalUi.vue').default);
Vue.component('cu-activity', require('./components/CuActivity.vue').default);
Vue.component('cu-cycle', require('./components/CuCycle.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router' 

Vue.use(VueRouter)

import {router} from './router.js'

const app = new Vue({
    el: '#app',
    router,
});
