
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

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//mine
//Vue.component('example-component-2', require('./components/ExampleComponent2.vue').default);
Vue.component('test-component', require('./components/test.vue').default);
Vue.component('pie-chart-component', require('./components/PieChartComponent.vue').default);
//Vue.component('user-count-component', require('./components/UserCountComponent.vue').default);
Vue.component('user-data-component', require('./components/UserDataComponent.vue').default);
Vue.component('view-data-component', require('./components/ViewDataComponent.vue').default);
Vue.component('monthly-data-component', require('./components/MonthlyDataComponent.vue').default);
Vue.component('notification-component', require('./components/NotificationComponent.vue').default);
Vue.component('editor-component', require('./components/EditorComponent.vue').default);
Vue.component('waveform-component', require('./components/WaveformComponent.vue').default);
Vue.component('featured-content-component', require('./components/FeaturedContentComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const UserDataComponent =  require('./components/UserDataComponent.vue').default;
const ViewDataComponent =  require('./components/ViewDataComponent.vue').default;
const MonthlyDataComponent = require('./components/MonthlyDataComponent.vue').default;
const EditorComponent = require('./components/EditorComponent.vue').default;
const WaveformComponent = require('./components/WaveformComponent.vue').default;
const NotificationComponent = require('./components/NotificationComponent.vue').default;
//const ExampleComponent = require('./components/ExampleComponent.vue').default;

const FeaturedContentComponent = require('./components/FeaturedContentComponent.vue').default;

window.onload = function () {
    const app = new Vue({
        el: '#app',

        components: {
            UserDataComponent,
            ViewDataComponent,
            EditorComponent,
            WaveformComponent,
            MonthlyDataComponent,
            NotificationComponent,
            FeaturedContentComponent,
        }
    });
    const notification = new Vue({
        el: '#notification',
        components: {NotificationComponent}
    });

}
Vue.config.ignoredElements = ['trix-editor'];
