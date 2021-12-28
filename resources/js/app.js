/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';
Vue.use(VueRouter);


import Login from './components/LoginComponent.vue';
import Accueil from './components/AccueilComponent.vue';
import Dashboard from './components/DashboardComponent.vue';
import Film from './components/film/FilmComponent.vue';
import DetailFilm from './components/film/DetailFilmComponent.vue';
import Serie from './components/serie/SerieComponent.vue';
import WebSerie from './components/webserie/WebSerieComponent.vue';
import Novelas from './components/novelas/NovelasComponent.vue';
import EmailVerifie from './components/EmailVerifieComponent.vue';
import ConfirmeCode from './components/ConfirmeCodeComponent.vue';
import ResetPassword from './components/ResetPasswordComponent.vue';


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const routes = [
    {
        path: '/',
        component: Login
    },
    {
        path: '/emailverifie',
        component: EmailVerifie
    },
    {
        path: '/confirmecode',
        name: 'confirmecode',
        component: ConfirmeCode,
    },
    {
        path: '/resetpassword',
        name: 'resetpassword',
        component: ResetPassword,
    },
    {
        path: '/accueil',
        component: Accueil,
        children: [
            {
                path: '/',
                components: {
                    default: Accueil,
                    two: Dashboard,
                  } 
            }, 
            {
                path: '/films',
                components: {
                    default: Accueil,
                    two: Film,
                  } 
            },
            {
                path: '/detailfilm/:film',
                name:'detailfilm',
                components: {
                    default: Accueil,
                    two: DetailFilm,
                  },
                  props: {
                    default: true,
                    two: true
                }, 
            },  
            {
                path: '/series',
                components: {
                    default: Accueil,
                    two: Serie,
                  } 
            }, 
            {
                path: '/webseries',
                components: {
                    default: Accueil,
                    two: WebSerie,
                  } 
            },
            {
                path: '/novelas',
                components: {
                    default: Accueil,
                    two: Novelas,
                  } 
            },  
        ]
    },
   
]

const router = new VueRouter({routes});

const app = new Vue({
    el: '#app',
    router: router,
});
