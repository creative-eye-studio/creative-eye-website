import Scrollbar from 'smooth-scrollbar';
import AOS from 'aos';

export class ScrollWeb {

    constructor(damping){
        this.damping = damping
    }

    get init(){
        const container = document.querySelector('#content');
        const scrollbar = Scrollbar.init(container, {
            damping: (this.damping / 100),
            renderByPixels: true,
            continuousScrolling: true,
            delegateTo: document,
            thumbMinSize: 15
        });

        scrollbar.track.xAxis.element.remove();

        AOS.init({
            duration: 1000, // Durée de l'animation en millisecondes
            delay: 200, // Délai avant le début de l'animation en millisecondes
            disable: window.innerWidth < 1200, // Désactiver sur les écrans étroits
            anchorPlacement: 'top-bottom', // Placement de l'ancre pour les animations
            easing: 'ease-in-out', // Courbe d'accélération pour l'animation
        });
          
      
        [].forEach.call(document.querySelectorAll('[data-aos]'), (el) => {
          scrollbar.addListener(() => {
            if (scrollbar.isVisible(el)) {
              el.classList.add('aos-animate');
            } else {
              el.classList.remove('aos-animate');
            }
          });
        });

        // Détection du Scroll
        scrollbar.addListener(() => {
            const scrollY = scrollbar.offset.y;
            const htmlElement = document.querySelector('html');
            htmlElement.classList.toggle('onScroll', scrollY > 50);
        });

        // Scroll au click d'une ancre
        const navAnchors = document.querySelectorAll('a[href^="#"]');
        navAnchors.forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
        
                const margin = 0;
                const target = btn.getAttribute('href') || btn.getAttribute('data-link');
                const anchor = document.querySelector(target);
                const offset = container.getBoundingClientRect().top - anchor.getBoundingClientRect().top;
                if (window.innerWidth > 1200) {
                    scrollbar.scrollIntoView(anchor, { 
                        offset, 
                        offsetTop: margin
                    });    
                } else {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
                
        
                // Supprimer l'ancre de l'URL sans ajouter une nouvelle entrée dans l'historique
                history.replaceState(null, null, target);
            });
        });

        // Retour en haut de page
        document.addEventListener('swup:transitionStart', function() {
            if (window.innerWidth > 1200) {
                scrollbar.scrollTo(0, 0, 1000); 
            } else {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });



        // Désactivation de la scrollbar horizontale
        scrollbar.track.xAxis.element.remove()

        return scrollbar;
    }
}