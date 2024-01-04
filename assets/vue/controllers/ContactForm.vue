<template>
    <div class="contact-form margin-left padding-all">
        <div class="row-no-marge">
            <div class="col-12">
                <h2>
                    <span class="small">Nous contacter</span>
                    <span class="title">Vous avez un projet ? Nous avons les solutions !</span>
                </h2>
                <p><em>Tous les champs sont obligatoires</em></p>
            </div>    
        </div>
        
        <form method="post" class="row-no-marge">
            <div class="col-6 col-sm-12 input-group">
                <input type="text" name="nom" id="nom" required>
                <label for="nom">Nom *</label>
            </div>

            <div class="col-6 col-sm-12 input-group">
                <input type="text" name="prenom" id="prenom" required>
                <label for="prenom">Prénom *</label>
            </div>

            <div class="col-6 col-sm-12 input-group">
                <input type="text" name="fonction" id="fonction" required>
                <label for="fonction">Fonction *</label>
            </div>

            <div class="col-6 col-sm-12 input-group">
                <input type="text" name="societe" id="societe" required>
                <label for="societe">Société *</label>
            </div>

            <div class="col-6 col-sm-12 input-group">
                <select name="profil" id="profil" required>
                    <option value="">Choisissez votre secteur *</option>
                    <option value="Commerce de gros">Commerce de gros</option>
                    <optgroup label="Communication">
                        <option value="Agence de publicité">Agence de publicité</option>
                        <option value="Imprimerie">Imprimerie</option>
                        <option value="Signalétique">Signalétique</option>
                    </optgroup>
                    <optgroup label="Évenementiel">
                        <option value="Évenementiel">Organisateur d'évenements</option>
                        <option value="Évenementiel">Régisseur</option>
                        <option value="Évenementiel">Disc Jockey</option>
                    </optgroup>
                    <optgroup label="Artisanat">
                        <option value="Hotellerie / Restauration">Hotellerie / Restauration</option>
                        <option value="Métiers de bouche">Métiers de bouche</option>
                        <option value="Métiers de la construction">Métiers de la construction</option>  
                        <option value="Art floral">Art floral</option>
                        <option value="Viticulteurs">Viticulteurs</option>
                    </optgroup>
                    <option value="Autre">Autre</option>
                </select>
            </div>

            <div class="col-6 col-sm-12 input-group">
                <select name="profil" id="profil" required>
                    <option value="">Particulier / Professionnel *</option>
                    <option value="Particulier">Particulier</option>
                    <option value="Professionnel">Professionnel</option>
                </select>
            </div>

            <div class="col-6 col-sm-12 input-group">
                <input type="text" name="codepostal" id="codepostal" required>
                <label for="codepostal">Code postal *</label>
            </div>

            <div class="col-6 col-sm-12 input-group">
                <input type="text" name="ville" id="ville" required>
                <label for="ville">Ville *</label>
            </div>

            <div class="col-6 col-sm-12 input-group">
                <input type="tel" name="telephone" id="telephone" required>
                <label for="telephone">Téléphone *</label>
            </div>

            <div class="col-6 col-sm-12 input-group">
                <input type="email" name="mail" id="mail" required>
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
                <textarea name="message" id="message" class="wd-100" required></textarea>
                <label for="">Message *</label>
            </div>
            

        </form>
    </div>
</template>

<script>
    export default {}
</script>