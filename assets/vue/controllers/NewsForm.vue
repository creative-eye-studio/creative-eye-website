<template>
    <form id="news-form" class="position-relative" @submit.prevent="submitForm()">
        <input class="news-input" type="email" name="news" id="news" v-model="this.formData.email" placeholder="Inscrivez vous à notre newsletter" aria-label="Inscrivez vous à notre newsletter">
        
        <div class="g-recaptcha" data-sitekey="6Lc3ArIpAAAAAOARqNO6I5Uz0CY5XFvRFuxDcMgW" data-size="invisible"></div>
        
        <button class="btn-news-submit position-absolute" type="submit" @click="createNewsContact">&#8594</button>
    </form>
</template>

<script>
import axios from "axios";
export default {
    el: "#news-form",
    data() {
        return {
            formData: {
                email: '',
            }
        };
    },
    methods: {
        submitForm() {
            try {
                axios.post('/mailjet', this.formData).then((response) => {
                    console.log(response.data);
                });
            } catch(error) {
                console.error("Erreur lors de l'inscription de l'Email : " + error);
            }
        }
    },
}
</script>