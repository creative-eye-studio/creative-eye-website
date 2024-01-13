<template>
    <swiper 
        :navigation="{
            nextEl: '.slider-prev', 
            prevEl: '.slider-next',
        }"
        :modules="modules"
        :slides-per-view="'auto'"
        :space-between="50"
        :breakpoints="{
            '1024': {
                slidesPerView: 2,
                spaceBetween: 32
            },
            '1200': {
                slidesPerView: 'auto',
                spaceBetween: 50
            },
        }"
        @swiper="onSwiper"
        @slideChange="onSlideChange"
    >
        <swiper-slide v-for="service in services" :key="service.id">
            <div class="text-img-bloc">
                <a :href='"fr/expertise/" + service.url'>
                    <figure class="image">
                        <img :src='"../uploads/images/services/" + service.thumb'>
                    </figure>
                    <div class="text">
                        <h3 v-html='service.titre[0]'></h3>
                        <p class="text" v-html='service.intro'></p>
                    </div>      
                </a>
            </div>
        </swiper-slide>
        <div class="swiper-arrows margin-left-auto d-flex">
            <span class="slider-next">&#8592;</span>
            <span class="slider-prev">&#8594;</span>
        </div>

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
        data() {
            return {
                services: null
            }
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
        mounted() {
            this.fetchData();
        },
        methods: {
            async fetchData() {
                try {
                    const response = await fetch('/api/services');
                    this.services = await response.json();
                } catch (error) {
                    console.error('Erreur lors de la récupération des données:', error);
                }
            }
        },
    };
</script>