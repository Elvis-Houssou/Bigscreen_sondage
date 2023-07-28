<script>
    export default {
        data() {
            return {
                email : undefined,      // Champ de saisie de l'adresse e-mail
                password : undefined,   // Champ de saisie du mot de passe
                userText : false,       // Indicateur d'affichage du message de bienvenue
                adminName: '',          // Nom de l'administrateur connecté
                mailError: false,       // Indicateur d'erreur de saisie de l'e-mail
                passwordError: false,   // Indicateur d'erreur de saisie du mot de passe
                formError: false,       // Indicateur d'erreur de connexion
            }
        },

        methods: {
            // Méthode pour effectuer la connexion en envoyant les données au serveur
            async Login() {
                const res = await(await fetch(`${this.API_URL}/login`, {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json; charset=utf-8'
                    },
                    body: JSON.stringify({
                        email : this.email,
                        password : this.password
                    })
                })).json();

                console.log(res);

                

                if (res.status == 'done') {
                    this.formError = false;
                    this.questions = res.result;
                    console.log(res);
                    window.localStorage.setItem(this.storageName, res.token);
                    this.userText = true;
                    this.adminName = res.result.name;
                    
                    // isLoggedIn.value = true;
                    setTimeout(() => {
                        this.$router.push({name: 'admin.home'});
                    }, 1500); 
                }
                else {
                    console.error(res.error);
                    this.formError = true;

                }
            },

        },
    }

</script>

<template>
    <div class="container">
        <img src="@/assets/bigscreen.svg" alt="" srcset="">
        <div class="form_box">
            <div class="form_head">
                <h1>Login</h1>
            </div>

            <h3 v-if="userText && adminName" class="success">Bienvenue administrateur {{ adminName }} </h3>
            <p v-if="formError" class="success text-danger">Adresse mail ou Mot de passe incorrect.</p>


            <form>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        </svg>
                    </span>
                    <div class="form-floating">
                        <input type="email" v-model="email" class="form-control" id="email" placeholder="email">
                        <label for="Email" class="text-dark">Email</label>
                    </div>
                </div>
                <p v-if="mailError" class="error">Veuillez saisir votre adresse e-mail.</p>
                <div class="input-group mb-3">
                    <span class="input-group-text lock">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </span>
                    <div class="form-floating">
                        <input type="password" v-model="password" class="form-control pas" id="password" placeholder="password">
                        <label for="password" class="text-dark">Password</label>
                    </div>
                </div>
                <p v-if="passwordError" class="error">Mot de passe incorrect.</p>
                <div class="d-grid">
                    <button class="btn" type="submit" @click.prevent="Login()" >Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>    

    .container img {
        margin-top: 5%;
        width: 50%;
        margin-left: 23%;
    }

    .success  {
        text-align: center;
        color: rgb(5, 255, 5);
    }

    .error{
        color: rgb(255, 5, 5);
    }

    .form_box {
        margin-top: 10%;
        margin-left: 20%;
        align-items: center;
        border-radius: 25px;
        max-width: 700px;
        max-height: 500px;
        padding: 5%;
        background-color: rgb(49, 49, 49, 0.7);
        box-shadow: 5px 10px 8px 1px #383838;
    }

    .form_head {
        text-align: center;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        margin-bottom: 7%;
    }

    .form-floating {  
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
    }

    .form-control:focus {
        box-shadow: 1px 1px 8px 1px #11998e;
    }

    .btn {
        background-color: #11998e;
        color: white;
        font-family: 'Orbitron', sans-serif;
        font-weight: 600;
        font-size: 30px;
        transition: 0.5s ease-in-out;
    }

    .btn:hover {
    background-color: #FFFFFF;
    border: 1px solid #00CFCF;
    color: #00CFCF;
    font-size: 30px;
    transition: 0.5s ease-in-out;
    }

    .input-group-text {
        background-color: #11998e;
    }

    .lock {
        background-color: rgb(252, 59, 59);
    }

</style>
