require('./bootstrap');
import Vue from 'vue';
import App from './components/App.vue';
import BootstrapVue from 'bootstrap/dist/css/bootstrap.css';

Vue.use(BootstrapVue);

new Vue({
    el: '#app',
    components: {
    App
}
});
