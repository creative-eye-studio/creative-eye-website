<template>
    <swiper
        :navigation="{
            nextEl: '.slider-prev', 
            prevEl: '.slider-next',
        }"
        :modules="modules"
        :breakpoints="{
            '1200': {
                slidesPerView: 3,
                spaceBetween: 50
            },
            '768': {
                slidesPerView: 2,
                spaceBetween: 32
            },
            '320': {
                slidesPerView: 1,
                spaceBetween: 32
            },
        }"
    >
        <swiper-slide v-for="post in this.posts" :key="post.id">
            <article class="text-img-bloc">
                <figure class="image">
                    <img :src="'/uploads/images/posts/' + post.thumb" :alt="post.name[0]">
                </figure>
                <div class="text-content">
                    <h3 v-html="post.name[0]"></h3>
                    <div class="text post-text" v-html="post.content"></div>
                    <p><a class="btn-link" :href="'/fr/blog/' + post.url">Lire l'article</a></p>
                </div>    
            </article>
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

    export default { 
        components: {
            Swiper,
            SwiperSlide,
        },
        props: {
            servId: String,
        },
        setup() {
            return {
                modules: [Navigation, Pagination, A11y],
            };
        },
        data() {
            return {
                posts: null,
            }
        },

        mounted() {
            this.fetchData(this.servId);
        },
        methods: {
            async fetchData(id) {
                try {
                    const response = await fetch(`/api/posts-service/${id}`);
                    const data = await response.json();
                    this.posts = data;
                } catch (error) {
                    console.error('Erreur lors de la récupération des données:', error);
                }
            }
        },
    }
</script>