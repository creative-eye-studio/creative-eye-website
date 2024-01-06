<template>
    <figure class="real-item position-relative cover-img border-all margin-top-on-md" v-for="real in reals">
        <a :href='"realisation/" + real.url'>
            <img :src='"../uploads/images/reals/main/" + real.thumb' alt="" class="image position-absolute">
            <figcaption class="infos position-absolute w-100">
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
            reals: null
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                const response = await fetch('/api/reals');
                this.reals = await response.json();
            } catch (error) {
                console.error('Erreur lors de la récupération des données:', error);
            }
        }
    },
}
</script>