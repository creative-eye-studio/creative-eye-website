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

import { ScrollWeb } from './smoothScroll';
import { Parallax } from './parallax';
import { createApp } from 'vue';
import AOS from 'aos';
import ContactForm from './vue/controllers/ContactForm';
import LastPosts from './vue/controllers/LastPosts';
import LastReal from './vue/controllers/LastReal';
import SliderServices from './vue/controllers/SliderServices';

// Variables
// -----------------------------------------------
const pageDatas = document.querySelector('body');
const values = {
    damping: pageDatas.dataset.damping,
    scrollImgSpeed: pageDatas.dataset.scrollimg
};

// Instantieur
// -----------------------------------------------
const commonCalls = () => {
    // Initialisation de AOS pour les animations au défilement
    AOS.init();

    // Création de l'application avec des composants spécifiques et montage dans l'élément avec l'ID 'website'
    createApp({
        components: { LastPosts, LastReal, SliderServices, ContactForm },
    }).mount('#website');
    
    // Appel à la fonction parallax pour des effets visuels au défilement
    parallax();

    // Appel à la fonction scrollWeb pour gérer les événements de défilement
    scrollWeb();
}

// Écouteur d'événement pour s'assurer que le DOM est entièrement chargé avant d'exécuter commonCalls
document.addEventListener('DOMContentLoaded', commonCalls);

// Écouteur d'événement pour swup, déclenché après chaque remplacement du contenu (nouvelle page chargée)
document.addEventListener('swup:contentReplaced', commonCalls);


// Smooth Scrollbar
// -----------------------------------------------
function scrollWeb() {
    // Crée une instance de ScrollWeb en utilisant la valeur de damping de l'objet 'values'
    const scrollWebInstance = new ScrollWeb(values.damping);
    // Appelle la méthode init pour initialiser l'instance
    scrollWebInstance.init();
    // Retourne l'instance créée
    return scrollWebInstance;
}



// Parallax
// -----------------------------------------------
function parallax() {
    // Crée une instance de la classe Parallax avec les valeurs de damping et scrollImgSpeed
    const parallaxInstance = new Parallax(values.damping, values.scrollImgSpeed);
    // Appelle la méthode initParallax pour initialiser l'instance
    parallaxInstance.initParallax();
    // Retourne l'instance créée
    return parallaxInstance;
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