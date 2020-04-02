/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./jquery');
// require('./popper');
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

Vue.component('game-sheet', require('./components/GameSheet.vue').default);
Vue.component('income', require('./components/Income.vue').default);
Vue.component('expenses', require('./components/Expenses.vue').default);
Vue.component('expenses', require('./components/ExpensesChild.vue').default);
Vue.component('assets', require('./components/Assets.vue').default);
Vue.component('liabilities', require('./components/Liabilities.vue').default);
Vue.component('liabilities-loans', require('./components/LiabilitiesLoans.vue').default);
Vue.component('assets-stocks', require('./components/AssetsStock.vue').default);
Vue.component('assets-add-stocks', require('./components/AssetsAddStock.vue').default);
Vue.component('assets-fonds', require('./components/AssetsFonds.vue').default);
Vue.component('assets-add-fond', require('./components/AssetsAddFond.vue').default);
Vue.component('assets-fonds', require('./components/AssetsNt.vue').default);
Vue.component('assets-add-fond', require('./components/AssetsAddNt.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
