// vue-setup.js
import ContactForm from './vue/controllers/ContactForm';
import LastPosts from './vue/controllers/LastPosts';
import LastReal from './vue/controllers/LastReal';
import SliderServices from './vue/controllers/SliderServices';

const app = createApp({
  components: { LastPosts, LastReal, SliderServices, ContactForm },
  data() {
    return {
      showLastPosts: false,
    };
  },
});

export default app;
