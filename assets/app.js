/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/web/app.scss';

// start the Stimulus application
import './bootstrap';

import AOS from 'aos';
import { ScrollWeb } from './smoothScroll';
import { Parallax } from './parallax';
import { createApp } from 'vue';
import ContactForm from './vue/controllers/ContactForm';
import AllPosts from './vue/controllers/AllPosts';
import LastPosts from './vue/controllers/LastPosts';
import LastServicePosts from './vue/controllers/LastServicePosts';
import LastReal from './vue/controllers/LastReal';
import SliderServices from './vue/controllers/SliderServices';
import Partners from './vue/controllers/Partners';


// Variables
// -----------------------------------------------
const pageDatas = document.querySelector('body');
const values = {
    damping: pageDatas.dataset.damping,
    scrollImgSpeed: pageDatas.dataset.scrollimg
};

// Instantieur
// -----------------------------------------------
function initVueComponents() {
    // Créez une référence à l'application Vue
    const app = createApp({
        components: { AllPosts, LastPosts, LastServicePosts, LastReal, SliderServices, ContactForm, Partners },
    }).mount('#website');
}

const commonCalls = () => {
    initVueComponents();
    if (!commonCalls.isInitialized) {
        AOS.init();
        scrollWeb();
        parallax();
        commonCalls.isInitialized = true; // Marquez les fonctions comme étant appelées
    }
};

commonCalls.isInitialized = false;

document.addEventListener('DOMContentLoaded', commonCalls);
document.addEventListener('swup:contentReplaced', commonCalls);



// Smooth Scrollbar
// -----------------------------------------------
function scrollWeb() {
    // Retourne l'instance créée
    return new ScrollWeb(values.damping).init;
}



// Parallax
// -----------------------------------------------
function parallax() {
    // Retourne l'instance créée
    return new Parallax(values.damping, values.scrollImgSpeed).initParallax();
}



// Bouton menu
// ---------------------------------------------------
document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne tous les éléments avec la classe 'toggle-nav'
    var toggleNavButtons = document.querySelectorAll('.toggle-nav');

    // Sélectionne tous les liens dans la navigation principale
    var menuLinks = document.querySelectorAll('.main-nav a');

    // Fonction pour basculer la classe 'open-nav' sur la balise 'html'
    function toggleNavClass() {
        document.querySelector('html').classList.toggle('open-nav');
    }

    // Ajoute un écouteur d'événement aux boutons de bascule de la navigation
    toggleNavButtons.forEach(btn => {
        btn.addEventListener('click', toggleNavClass);
    });

    // Ajoute un écouteur d'événement aux liens du menu
    menuLinks.forEach(link => {
        link.addEventListener('click', toggleNavClass);
    });
});