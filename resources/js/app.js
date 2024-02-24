require('./bootstrap');
import Vue from 'vue';
import App from './components/App';
window.$ = window.jQuery = require('jquery');
require('bootstrap');

new Vue({
    el: '#app',
    components: {
        App
    },
});
