/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//import './bootstrap';
import { createApp } from 'vue';

import metodos from './metodosGlobales.js';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */



const app = createApp({});


// administrador
import users from './components/admin/gestion_usuarios/users.vue';
app.component('users', users);

import user_detalle from './components/admin/gestion_usuarios/user_detalle.vue';
app.component('user_detalle', user_detalle);

import servicios from './components/admin/servicios/servicios.vue';
app.component('servicios', servicios); 

// Funciones
app.mixin(metodos);



app.mount('#app');
