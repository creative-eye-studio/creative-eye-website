<template>
    <figure class="real-item border-all position-relative" v-if="real && real.services">
        <a :href='"fr/realisation/" + real.url'>
            <figure class="cover-img-no-sm-16-9 ht-100">
                <img :src='"../uploads/images/reals/main/" + real.thumb' alt="" class="image">
            </figure>
            
            <figcaption class="infos position-absolute-no-sm w-100">
                <h3>
                    <span class="title" v-html="real.nom"></span>
                </h3>
                <div class="services">
                    <span v-for="service in real.services">{{ service.nom[0] }}</span>
                </div>
            </figcaption>    
        </a>
    </figure> 
</template>

<script>
    export default {
        data() {
            return {
                real: {},
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            async fetchData() {
                try {
                    const response = await fetch('/api/last-real');
                    const data = await response.json();
                    this.real = data;
                    console.log(this.real.services);
                } catch (error) {
                    console.error('Erreur lors de la récupération des données:', error);
                }
            }
        },
    }
</script>