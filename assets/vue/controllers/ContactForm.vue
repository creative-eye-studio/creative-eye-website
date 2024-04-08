<template>
    <div id="contact-form" class="contact-form margin-left-no-md padding-vertical-on-md">
        <div class="row">
            <div class="col-12">
                <h2>
                    <span class="small">Nous contacter</span>
                    <span class="title">Vous avez un projet ? Nous avons les solutions !</span>
                </h2>
                <p><em>Tous les champs sont obligatoires</em></p>
            </div>
        </div>

        <form class="row" @submit.prevent="submitForm()">
            <div class="col-6 col-md-12 input-group">
                <input type="text" name="nom" id="nom" v-model="this.FormData.nom"
                    title="Veuillez entrer votre nom de famille" required>
                <label for="nom">Nom *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="text" name="prenom" id="prenom" v-model="this.FormData.prenom"
                    title="Veuillez entrer votre prénom" required>
                <label for="prenom">Prénom *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="text" name="societe" id="societe" v-model="this.FormData.societe"
                    title="Veuillez indiquer le nom de votre entreprise" required>
                <label for="societe">Société *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="text" name="fonction" id="fonction" v-model="this.FormData.fonction"
                    title="Veuillez indiquer votre fonction au sein de l'entreprise" required>
                <label for="fonction">Fonction *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <select name="secteur" id="secteur" v-model="this.FormData.secteur"
                    title="Quel est le secteur d'activité de votre entrprise ?" required>
                    <option value=""></option>
                    <template v-for="option in secteurs" :key="option.label">
                        <option v-if="!option.options.length" :value="option.label">{{ option.label }}</option>
                        <optgroup v-if="option.options && option.options.length" :label="option.label">
                            <option v-for="subOption in option.options" :key="subOption.label" :value="subOption.label">
                                {{ subOption.label }}
                            </option>
                        </optgroup>
                    </template>
                </select>
                <label for="secteur" class="label-select">Votre secteur d'activité *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <select name="profil" id="profil" v-model="this.FormData.particulier"
                    title="Veuillez indiquer si vous êtes un particulier ou un professionnel" required>
                    <option value=""></option>
                    <option value="Particulier">Particulier</option>
                    <option value="Professionnel">Professionnel</option>
                </select>
                <label for="profil" class="label-select">Particulier / Professionnel *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="text" name="codepostal" id="codepostal" v-model="this.FormData.codepostal"
                    title="Veuillez indiquer le code postal de votre entreprise" required>
                <label for="codepostal">Code postal *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="text" name="ville" id="ville" v-model="this.FormData.ville"
                    title="Veuillez indiquer la ville de votre entreprise" required>
                <label for="ville">Ville *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="tel" name="telephone" id="telephone" v-model="this.FormData.telephone"
                    title="Veuillez indiquer votre numéro de teléphone pour être recontacté(e)" required>
                <label for="telephone">Téléphone *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="email" name="mail" id="mail" v-model="this.FormData.mail"
                    title="Veuillez indiquer votre adresse e-mail pour être recontacté(e)" required>
                <label for="mail">E-Mail *</label>
            </div>

            <div class="col-12 services-form">
                <p class="small">Je suis intéressé par :</p>
                <div class="services-list">
                    <p class="checkbox" v-for="item in interests">
                        <input type="checkbox" name="besoin" :id="item.id" :value="item.label">
                        <label class="label-checkbox" :for="item.id" v-html="item.label"></label>
                    </p>
                </div>
            </div>

            <div class="col-12 input-group">
                <textarea name="message" id="message" v-model="FormData.message" class="wd-100"
                    title="Veuillez décrire précisément votre projet" required></textarea>
                <label for="message">Message *</label>
            </div>

            <div class="col-12 services-form">
                <p class="checkbox">
                    <input type="checkbox" name="rgpd" id="rgpd" value="Consentement légitime au RGPD" required>
                    <label class="label-checkbox" for="rgpd">En soumettant ce formulaire, j'accepte de transmettre mes données à des fins de relation client. Le formulaire est protégé par Google ReCaptcha</label>
                </p>    
            </div>

            <div class="g-recaptcha" data-sitekey="6Lc3ArIpAAAAAOARqNO6I5Uz0CY5XFvRFuxDcMgW" data-size="invisible"></div>

            <div class="col-12">
                <button class="btn-link">Envoyer</button>
            </div>

            <div class="col-12">
                <p class="send-status"></p>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            FormData: {
                nom: '',
                prenom: '',
                societe: '',
                fonction: '',
                secteur: '',
                particulier: '',
                codepostal: '',
                ville: '',
                telephone: '',
                mail: '',
                besoins: [],
                message: ''
            },
            interests: [
                {
                    id: 'identite-visuelle',
                    label: "Identité visuelle"
                },
                {
                    id: 'signature-marque',
                    label: "Signature de marque"
                },
                {
                    id: 'support-print',
                    label: "Support print"
                },
                {
                    id: 'reportage-photo',
                    label: "Reportage photo"
                },
                {
                    id: 'site-internet',
                    label: "Création de site internet"
                },
                {
                    id: 'application-mobile',
                    label: "Création d'application mobile"
                },
                {
                    id: 'ecommerce',
                    label: "Boutique E-Commerce"
                },
                {
                    id: 'emailing',
                    label: "Campagne d'emailing"
                },
                {
                    id: 'seo',
                    label: "Référencement naturel SEO"
                },
            ],
            secteurs: [
                {
                    label: 'Commerce de gros',
                    options: [
                        { label: 'Revendeurs' },
                        { label: 'Grossistes' },
                    ]
                },
                {
                    label: 'Communication',
                    options: [
                        { label: 'Agence de publicité' },
                        { label: 'Imprimerie' },
                        { label: 'Signalétique' },
                    ],
                },
                {
                    label: 'Évenementiel',
                    options: [
                        { label: 'Organisateur d\'événements' },
                        { label: 'Régisseur' },
                        { label: 'Disc Jockey' },
                    ],
                },
                {
                    label: 'Artisanat',
                    options: [
                        { label: 'Hotellerie / Restauration' },
                        { label: 'Métiers de bouche' },
                        { label: 'Métiers de la construction' },
                        { label: 'Art floral' },
                        { label: 'Viticulteurs' },
                    ],
                },
                { label: 'Autre', options: [] },
            ],
        }
    },
    methods: {
        submitForm() {
            try {
                var status = document.querySelector(".send-status");
                document.querySelectorAll("input[name='besoin']:checked").forEach(besoin => {
                    this.FormData.besoins.push(besoin.value);
                });
                axios.post('/contact-form', this.FormData).then((response) => {
                    console.log(response.data);
                    status.textContent = "Votre message a bien été envoyé";
                });
            } catch (error) {
                console.error("Erreur lors de l'envoi de l'Email : " + error);
            }
        }
    },
}
</script>