
// L'URL de base de notre API
const API_URL = 'http://127.0.0.1:8000/api';

// Pour stocker dans localstorage
const storageName = 'Api_Token';

// Récupére l'id et le token de l'utilisateur depuis le localstorage
const getCurrentUser = function(key) {
    if (window.localStorage.getItem(key)) {
        let userToken = window.localStorage.getItem(key);
        return {
            // id: userId,
            token: userToken
        }
    }
    else 
        return false;
}

// Exporte les variables
export { storageName, API_URL, getCurrentUser }
