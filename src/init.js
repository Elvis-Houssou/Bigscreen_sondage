// Pour stocker dans localstorage
// const storageName = 'vue_token';
// L'URL de base de notre API
const API_URL = 'http://127.0.0.1:8000/api';
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

// Vérifie si le token utilisateur est valide
// const checkUserToken = async function (token, url) {
//     const res = await ( await fetch(`${url}/user/logged/${token}`) ).json();
//     return res.status == 'done';
// }

// Exporte les variables
// export { storageName, API_URL }
// export { storageName, API_URL, getCurrentUser }
export { API_URL, storageName, getCurrentUser}
// export { storageName, API_URL, getCurrentUser, checkUserToken }