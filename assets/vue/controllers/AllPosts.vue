<template>
    <section class="padding-vertical-on-md">
        <h2 class="text-center margin-none">Soyez au courant de nos actualités</h2>
        <div class="row margin-top-on-md">
            <div class="col-4" v-for="post in posts" :key="post.id">
                <article class="text-img-bloc">
                    <figure class="image">
                        <img :src="'../../../uploads/images/posts/' + post.thumb" :alt="post.name[0]">
                    </figure>
                    <div class="text-content">
                        <h3 v-html="post.name[0]"></h3>
                        <div class="text" v-html="post.content"></div>
                        <p><a class="btn-link" :href="'/fr/blog/' + post.url">Lire l'article</a></p>
                    </div>    
                </article>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            posts: null
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                const response = await fetch('/api/posts');
                this.posts = await response.json();
            } catch (error) {
                console.error('Erreur lors de la récupération des données:', error);
            }
        }
    },
}
</script>