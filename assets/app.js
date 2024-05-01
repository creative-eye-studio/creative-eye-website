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
import ContactForm from './vue/controllers/ContactForm';
import AllPosts from './vue/controllers/AllPosts';
import LastPosts from './vue/controllers/LastPosts';
import LastServicePosts from './vue/controllers/LastServicePosts';
import LastReal from './vue/controllers/LastReal';
import RealsList from './vue/controllers/RealsList';
import SliderServices from './vue/controllers/SliderServices';
import Partners from './vue/controllers/Partners';
import NewsForm from './vue/controllers/NewsForm';


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
        components: { 
            AllPosts, 
            ContactForm, 
            LastPosts, 
            LastReal, 
            LastServicePosts, 
            NewsForm,
            Partners, 
            RealsList, 
            SliderServices 
        },
    });

    app.mount('#website');
}

const commonCalls = () => {
    initVueComponents();
    initServicePage();
    getActiveLink();
    scrollWeb();
    parallax();
};

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



// lien actif
// ---------------------------------------------------
function getActiveLink() {
    const actualHref = window.location.href;
    const allNavLinks = document.querySelectorAll('.main-nav a');
    
    allNavLinks.forEach(link => link.classList.remove('active-link'));

    const targetLink = Array.from(allNavLinks).find(link => link.href === actualHref);

    if (targetLink) {
        targetLink.classList.add('active-link');
    } else if (window.location.pathname === '/fr') {
        allNavLinks[0].classList.add('active-link');
    }
}



// Bouton en haut de page
// ---------------------------------------------------
document.addEventListener('DOMContentLoaded', function() {
    const btnMobTop = document.querySelector('#go-to-top');
    btnMobTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth',
            duration: 1000
        });
    });
});




// Bouton More panel
// ---------------------------------------------------
const openMorePanel = () => {
    const moreBtn = document.querySelector('.more-btn');

    if (moreBtn != null) {
        moreBtn.addEventListener('click', function() {
            document.querySelector('.more-panel').classList.toggle('open');
            moreBtn.classList.toggle('toggled');
        })    
    }
    
}

document.addEventListener("DOMContentLoaded", openMorePanel);
document.addEventListener("swup:contentReplaced", openMorePanel);



// Loader
// ---------------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
    toggleLoader('.loader-open');
});

document.addEventListener("swup:samePage", () => {
    toggleLoader('.loader-page');
});

document.addEventListener("swup:transitionStart", () => {
    toggleLoader('.loader-page', false);
});

document.addEventListener("swup:samePageWithHash", () => {
    toggleLoader('.loader-page');
});

document.addEventListener("swup:clickLink", () => {
    toggleLoader('.loader-page', false);
});

document.addEventListener("swup:transitionEnd", () => {
    setTimeout(() => {
        toggleLoader('.loader-page');
    }, 2000);
});

function toggleLoader(selector, add = true) {
    const element = document.querySelector(selector);
    element && add 
        ? element.classList.add('open') 
        : element.classList.remove('open');
}



// Page Services
// ---------------------------------------------------
function initServicePage() {
    // Animation du texte Intro
    document.querySelectorAll('.service-intro p').forEach(line => {
        line.setAttribute('data-aos', 'circle-left');
    });
}
