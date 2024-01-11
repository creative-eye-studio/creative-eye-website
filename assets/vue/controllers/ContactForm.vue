<template>
    <div class="contact-form margin-left-no-md padding-vertical-on-md">
        <div class="row">
            <div class="col-12">
                <h2>
                    <span class="small">Nous contacter</span>
                    <span class="title">Vous avez un projet ? Nous avons les solutions !</span>
                </h2>
                <p><em>Tous les champs sont obligatoires</em></p>
            </div>    
        </div>
        
        <form method="post" class="row">
            <div class="col-6 col-md-12 input-group">
                <input type="text" name="nom" id="nom" title="Veuillez entrer votre nom de famille" required>
                <label for="nom">Nom *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="text" name="prenom" id="prenom" title="Veuillez entrer votre prénom" required>
                <label for="prenom">Prénom *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="text" name="societe" id="societe" title="Veuillez indiquer le nom de votre entreprise" required>
                <label for="societe">Société *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="text" name="fonction" id="fonction" title="Veuillez indiquer votre fonction au sein de l'entreprise" required>
                <label for="fonction">Fonction *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <select v-model="selectedOption" name="secteur" id="secteur" title="Quel est le secteur d'activité de votre entrprise ?" required>
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
                <select name="profil" id="profil" title="Veuillez indiquer si vous êtes un particulier ou un professionnel" required>
                    <option value=""></option>
                    <option value="Particulier">Particulier</option>
                    <option value="Professionnel">Professionnel</option>
                </select>
                <label for="profil" class="label-select">Particulier / Professionnel *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="text" name="codepostal" id="codepostal" title="Veuillez indiquer le code postal de votre entreprise" required>
                <label for="codepostal">Code postal *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="text" name="ville" id="ville" title="Veuillez indiquer la ville de votre entreprise" required>
                <label for="ville">Ville *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="tel" name="telephone" id="telephone" title="Veuillez indiquer votre numéro de teléphone pour être recontacté(e)" required>
                <label for="telephone">Téléphone *</label>
            </div>

            <div class="col-6 col-md-12 input-group">
                <input type="email" name="mail" id="mail" title="Veuillez indiquer votre adresse e-mail pour être recontacté(e)" required>
                <label for="mail">E-Mail *</label>
            </div>

            <div class="col-12 services-form">
                <p class="small">Je suis intéressé par :</p>
                    <div class="services-list">
                        <p class="checkbox">
                            <input type="checkbox" name="besoin" id="identite-visuelle" value="Conception d'identité visuelle">
                            <label class="label-checkbox" for="identite-visuelle">Conception d'identité visuelle</label>    
                        </p>
                        <p class="checkbox">
                            <input type="checkbox" name="besoin" id="signature-marque" value="Signature de marque">
                            <label class="label-checkbox" for="signature-marque">Signature de marque</label>    
                        </p>
                        <p class="checkbox">
                            <input type="checkbox" name="besoin" id="support-print" value="Support print">
                            <label class="label-checkbox" for="support-print">Support print</label>    
                        </p>
                        <p class="checkbox">
                            <input type="checkbox" name="besoin" id="reportage-photo" value="Reportage photo">
                            <label class="label-checkbox" for="reportage-photo">Reportage photo</label>    
                        </p>
                        <p class="checkbox">
                            <input type="checkbox" name="besoin" id="site-internet" value="Création de site internet">
                            <label class="label-checkbox" for="site-internet">Création de site internet</label>    
                        </p>
                        <p class="checkbox">
                            <input type="checkbox" name="besoin" id="application-mobile" value="Création d'application mobile">
                            <label class="label-checkbox" for="application-mobile">Création d'application mobile</label>    
                        </p>
                        <p class="checkbox">
                            <input type="checkbox" name="besoin" id="ecommerce" value="Boutique E-commerce">
                            <label class="label-checkbox" for="ecommerce">Boutique E-commerce</label>    
                        </p>
                        <p class="checkbox">
                            <input type="checkbox" name="besoin" id="emailing" value="Campagne d'emailing">
                            <label class="label-checkbox" for="emailing">Campagne d'emailing</label>    
                        </p>
                        <p class="checkbox">
                            <input type="checkbox" name="besoin" id="seo" value="Référencement naturel SEO">
                            <label class="label-checkbox" for="seo">Référencement naturel SEO</label>    
                        </p>
                    </div>
            </div>

            <div class="col-12 input-group">
                <textarea name="message" id="message" class="wd-100" title="Veuillez décrire précisément votre projet" required></textarea>
                <label for="message">Message *</label>
            </div>

            <div class="col-12">
                <input type="submit" value="Envoyer" />
            </div>
            

        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
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
    }
</script>