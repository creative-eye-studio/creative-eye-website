<template>
    <article class="partner-item row-no-marge" v-for="item in posts" :key="item.id">
        <figure class="image col-4-no-marge cover-img-no-md-4-3">
            <img :src="'../../uploads/images/partners/photos/' + item.photo" :alt="item.nom + ' - ' + item.societe">
        </figure>
        <div class="text col-8-no-marge">
            <div class="text-block">
                <h3 class="margin-bottom-none">
                    <span v-html="item.nom"></span> - <span v-html="item.societe"></span>
                </h3>

                <div class="text-content" v-html="item.texte" ref="partnerIntroContainer"></div> 

                <figure class="logo">
                    <img :src="'../../uploads/images/partners/logos/' + item.logo" :alt="item.societe">
                </figure>
                <p v-if="item.website">
                    <a :title='"Site internet de " + item.societe + " (Lien externe)"' class="btn-link" :href="item.website" v-html="'Voir le site de ' + item.societe" target="_blank" rel="noopener"></a>
                </p> 
            </div>
        </div>
    </article>
</template>

<script>
export default {
    data() {
        return {
            posts: null
        }
    },
    async mounted() {
        await this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                const response = await fetch('/api/partners');
                this.posts = await response.json();
            } catch (error) {
                console.error('Erreur lors de la récupération des données:', error);
            }
        },
    },
}
</script>