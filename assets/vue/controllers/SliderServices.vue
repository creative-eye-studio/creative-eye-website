<template>
    <swiper 
        navigation
        :modules="modules"
        :slides-per-view="'auto'"
        :space-between="50"
        @swiper="onSwiper"
        @slideChange="onSlideChange"
    >
        <swiper-slide>
            <figure class="thumb">
                <img src="" alt="">
            </figure>
            <h3 class="small-title">
                Nom du service 
            </h3>
            <p>Introduction</p>
        </swiper-slide>
        <swiper-slide>
            <figure class="thumb">
                <img src="" alt="">
            </figure>
            <h3 class="small-title">
                Nom du service 
            </h3>
            <p>Introduction</p>
        </swiper-slide>
        <swiper-slide>
            <figure class="thumb">
                <img src="" alt="">
            </figure>
            <h3 class="small-title">
                Nom du service 
            </h3>
            <p>Introduction</p>
        </swiper-slide>
    </swiper>
</template>

<script>
    // import Swiper core and required modules
    import { Navigation, Pagination, A11y } from 'swiper/modules';

    // Import Swiper Vue.js components
    import { Swiper, SwiperSlide } from 'swiper/vue';

    // Import Swiper styles
    import 'swiper/css';
    import 'swiper/css/bundle';

    // Import Swiper styles
    export default {
        components: {
            Swiper,
            SwiperSlide,
        },
        setup() {
            const onSwiper = (swiper) => {
                console.log(swiper);
            };
            const onSlideChange = () => {
                console.log('slide change');
            };
            return {
                onSwiper,
                onSlideChange,
                modules: [Navigation, Pagination, A11y],
            };
        },
    };
</script>