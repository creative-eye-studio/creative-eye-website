<template>
    <form id="news-form" class="position-relative" @submit.prevent="submitForm()">
        <input class="news-input" type="email" name="news" id="news" v-model="this.formData.email" placeholder="Inscrivez vous à notre newsletter" aria-label="Inscrivez vous à notre newsletter">

        <div class="checkbox">
            <input type="checkbox" name="news-rgpd" id="news-rgpd" class="checkbox-white" required>
            <label for="news-rgpd" class="label-checkbox checkbox-white">En soumettant ce formulaire, j'accepte de transmettre mon adresse e-mail à des fins de relation marketing</label>
        </div>

        <p class="send-status_white"></p>
        
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
                var status = document.querySelector(".send-status_white");
                axios.post('/mailjet', this.formData).then((response) => {
                    console.log(response.data);
                    status.textContent = "Votre inscription a bien été prise en compte";
                });
            } catch(error) {
                console.error("Erreur lors de l'inscription de l'Email : " + error);
            }
        }
    },
}
</script>