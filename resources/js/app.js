// resources/js/app.js

import Vue from 'vue'; // Import Vue from Vue 2
import HeaderComponent from './components/HeaderComponent.vue'; // Import your HeaderComponent

// Register your components globally
Vue.component('header-component', HeaderComponent);

// Create a new Vue instance and mount it to the #app element
new Vue({
    el: '#app',
});
