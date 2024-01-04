<template>
    <swiper
        navigation
        :modules="modules"
        :slides-per-view="'auto'"
        :space-between="50"
        @swiper="onSwiper"
        @slideChange="onSlideChange"
    >
        <swiper-slide v-for="post in this.posts" :key="post.id">
            <div class="text-img-bloc">
                <figure class="image">
                    <img :src="'../uploads/images/posts/' + post.thumb" :alt="post.name[0]">
                </figure>
                <div class="text-content">
                    <h3 v-html="post.name[0]"></h3>
                    <div class="text" v-html="post.content"></div>
                    <p><a class="btn-link" href="">Voir l'article</a></p>
                </div>    
            </div>
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
        data() {
            return {
                posts: null,
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            async fetchData() {
                try {
                    const response = await fetch('https://127.0.0.1:8000/api/lasts-posts');
                    const data = await response.json();
                    this.posts = data;
                } catch (error) {
                    console.error('Erreur lors de la récupération des données:', error);
                }
            }
        },
    }
</script>