import {API_URL, storageName, getCurrentUser } from './init';

// Importation des fichiers CSS de Bootstrap et des icônes Bootstrap
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/scss/bootstrap.scss';
import 'bootstrap-icons/font/bootstrap-icons.css';



import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(router);

// Ajout de propriétés globales à l'application Vue pour stocker des constantes et fonctions réutilisables
app.config.globalProperties.storageName = storageName;
app.config.globalProperties.API_URL = API_URL;
app.config.globalProperties.getCurrentUser = getCurrentUser;

app.mount('#app')
