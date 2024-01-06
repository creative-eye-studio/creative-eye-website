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
            duration: 1000,
            delay: 200,
            disable: window.innerWidth < 1200,
        });

        // Détection du Scroll
        scrollbar.addListener(() => {
            const scrollY = scrollbar.offset.y;
            const htmlElement = document.querySelector('html');
            htmlElement.classList.toggle('onScroll', scrollY > 50);
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

        // Scroll au click d'une ancre
        const navAnchors = document.querySelectorAll('a[href^="#"]');
        navAnchors.forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
        
                const margin = 0;
                const target = btn.getAttribute('href') || btn.getAttribute('data-link');
                const anchor = document.querySelector(target);
                const offset = container.getBoundingClientRect().top - anchor.getBoundingClientRect().top;
                
                scrollbar.scrollIntoView(anchor, { 
                    offset, 
                    offsetTop: margin
                });
        
                // Supprimer l'ancre de l'URL sans ajouter une nouvelle entrée dans l'historique
                history.replaceState(null, null, target);
            });
        });

        // Retour en haut de page
        document.addEventListener('swup:contentReplaced', function() {
            scrollbar.scrollTo(0, 0, 1000); 
        })

        return scrollbar;
    }
}