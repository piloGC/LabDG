import Vue from 'vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueSweetAlert2 from 'vue-sweetalert2';

require('./bootstrap');

window.Vue = require('vue');
window.moment=require('moment');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(VueSweetAlert2);
Vue.config.ignoredElements=['trix-editor'];
//Vue.component('eliminar-sala', require('./components/EliminarSala.vue').default);
//Vue.component('fecha', require('./components/Fecha.vue').default);
//Vue.component('eliminar-equipo', require('./components/EliminarEquipo.vue').default);
Vue.component('eliminar-sancion', require('./components/EliminarSancion.vue').default);
//Vue.component('eliminar-existencia', require('./components/EliminarExistencia.vue').default);
Vue.component('dropdown-solicitud', require('./components/Dropdown.vue').default);

import FechaIndex from './components/FechaIndex';
import FechaFormato from './components/FechaFormato';
import Dropdown from './components/Dropdown';
import EliminarExistencia from './components/EliminarExistencia';
import EliminarEquipo from './components/EliminarEquipo';
import EliminarSala from './components/EliminarSala';
import FormatoHora from './components/FormatoHora';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components:{
        EliminarExistencia,
        EliminarEquipo,
        EliminarSala,
        Dropdown,
        FechaFormato,
        FechaIndex,
        FormatoHora
    }
});