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
import DetailSerie from './components/serie/DetailSerieComponent.vue';
import DetailSaison from './components/serie/DetailSaisonComponent.vue';
import WebSerie from './components/webserie/WebSerieComponent.vue';
import DetailWebSerie from './components/webserie/DetailWebSerieComponent.vue';
import DetailSaisonWeb from './components/webserie/DetailSaisonWebComponent.vue';
import Novelas from './components/novelas/NovelasComponent.vue';
import DetailNovelas from './components/novelas/DetailSerieNovelasComponent.vue';
import DetailSaisonNovelas from './components/novelas/DetailSaisonNovelasComponent.vue';
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

            /** Route film */
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

            /** Route serie */
            {
                path: '/detailsaison/:saison',
                name:'detailsaison',
                components: {
                    default: Accueil,
                    two: DetailSaison,
                  },
                  props: {
                    default: true,
                    two: true
                }, 
            },   
            {
                path: '/detailserie/:serie',
                name:'detailserie',
                components: {
                    default: Accueil,
                    two: DetailSerie,
                  },
                  props: {
                    default: true,
                    two: true
                }, 
            },

            /** Route novelas */
            {
                path: '/detailnovelas/:serie',
                name:'detailnovelas',
                components: {
                    default: Accueil,
                    two: DetailNovelas,
                  },
                  props: {
                    default: true,
                    two: true
                }, 
            },
            {
                path: '/detailsaisonnovelas/:saison',
                name:'detailsaisonnovelas',
                components: {
                    default: Accueil,
                    two: DetailSaisonNovelas,
                  },
                  props: {
                    default: true,
                    two: true
                }, 
            },

            /** Route web serie*/
            {
                path: '/detailwebserie/:serie',
                name:'detailwebserie',
                components: {
                    default: Accueil,
                    two: DetailWebSerie,
                  },
                  props: {
                    default: true,
                    two: true
                }, 
            },
            {
                path: '/detailsaisonweb/:saison',
                name:'detailsaisonweb',
                components: {
                    default: Accueil,
                    two: DetailSaisonWeb,
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
