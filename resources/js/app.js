/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

import router from './assets/router.js';
import VueMask from 'v-mask';
import Vuelidate from "vuelidate";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import MyUploadAdapter from "./assets/ckeditor/MyUploadAdapter";
import VueAWN from "vue-awesome-notifications";

import "@fortawesome/fontawesome-free/scss/fontawesome.scss";
import "@fortawesome/fontawesome-free/scss/solid.scss";


// ...

function MyCustomUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}


ClassicEditor
    .create( document.querySelector( '#editor' ), {
        extraPlugins: [ MyCustomUploadAdapterPlugin ],

        // ...
    } )
    .then(editor => {})
    .catch( error => {
        console.log( error );
    } );


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component',
    require('./components/ExampleComponent.vue').default
);


/**
 * Next, we will create a fresh Vue applicati on instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*Vue.component("list-posts", require("./components/PostListComponent.vue").default);
*/
Vue.component("modal-post", require("./components/PostModalComponent.vue").default);

Vue.component("post-list-default", require("./components/PostListDefaultComponent.vue").default);

Vue.use(Vuelidate);
Vue.use(VueAWN);
Vue.use(VueMask);
import App from "./components/App.vue";
const app = new Vue({
    el: '#app',
    //render: h => h(App),
    router
});//.$mount("#app");
