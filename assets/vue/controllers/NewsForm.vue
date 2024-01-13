<template>
    <form id="news-form" class="position-relative">
        <input class="news-input" type="email" name="news" id="news" v-model="email" placeholder="Inscrivez vous à notre newsletter" aria-label="Inscrivez vous à notre newsletter">
        <button class="btn-news-submit position-absolute" type="submit" @click="createNewsContact">&#8594</button>
    </form>
</template>

<script>
export default {
    el: "#news-form",
    data() {
        return {
            formData: {
                email: this.email,
            }
        };
    },
    methods: {
        createNewsContact(event) {
            event.preventDefault();

            if (this.email) {
                const requestOptions = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        listIds: [5],
                        updateEnabled: false,
                        attributes: {
                            EMAIL: this.formData.email
                        }
                    })
                };

                fetch('https://api.brevo.com/v3/contacts', requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Erreur HTTP : ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Contact ajouté à la liste BREVO :', data);
                    })
                    .catch(error => {
                        console.error('Erreur BREVO :', error.message);
                    });
            }
        }
    },
}
</script>