/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('alert', require('./components/Alert.vue').default);
Vue.component('breadcrumb', require('./components/Breadcrumb.vue').default);
Vue.component('navigation-group', require('./components/NavigationGroup.vue').default);

Vue.component('location', require('./components/Company/Location.vue').default);

Vue.component('company-table', require('./components/Company/Table.vue').default);
Vue.component('user-table', require('./components/User/Table.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.prototype.$bus = new Vue();

const app = new Vue({
    el: '#app',
});
