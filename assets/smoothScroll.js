import Scrollbar from 'smooth-scrollbar';

export class ScrollWeb {

    constructor(damping){
        this.damping = damping
    }

    get init(){
        var fixedElems = document.querySelectorAll('.fixed-scroll');
        const scrollbar = Scrollbar.init(document.querySelector('#content'), {
            damping: (this.damping / 100),
            renderByPixels: true,
            continuousScrolling: true,
            delegateTo: document,
            thumbMinSize: 15
            // alwaysShowTracks: true,
        });

        scrollbar.addListener(function(status) {
            fixedElems.forEach(fixedElem => {
                var offset = status.offset;
                fixedElem.style.top = offset.y + 'px';
                fixedElem.style.left = offset.x + 'px';
            })
        });

        return scrollbar;
    }
}