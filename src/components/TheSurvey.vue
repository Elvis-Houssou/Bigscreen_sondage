<script>


    export default {
        data() {
            return {
                questions: [],
                currentQuestionIndex: 0,
                currentQuestion: null,
                responses: {},
                showError: false,
                mailError: false,
                FormError: false,
                showPopup: false,
                link: ''
            }
        },

        methods: {
            // updateAnswerCount,
            async getData() {
                const res = await(await fetch(`${this.API_URL}/user/get/questions`, {})).json();

                if (res.status == 'done') {
                    this.questions = res.result;
                    console.log(res);
                    this.currentQuestion = this.questions[this.currentQuestionIndex];
                }
                else {
                    console.error(res.error);
                }
            },

            async submitAllResponses() {
                const responses = [];

                // Construire la liste des réponses à envoyer
                for (const questionId in this.responses) {
                    const responseText = this.responses[questionId];
                    responses.push({
                        response_text: responseText,
                        question_id: questionId,
                        survey_id: this.currentQuestion.survey_id
                    });
                }

                // Envoyer les réponses au serveur
                const ans = await (await fetch(`${this.API_URL}/user/store/responses`, {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json; charset=utf-8'
                    },
                    body: JSON.stringify({
                        responses: responses
                    })
                })).json();

                
                if (ans.status === 'done') {
                    console.log(ans);

                    
                    document.getElementById("form").style.display = "none"; 

                    this.showPopup = true;
                    this.link = `${window.location.origin}/reponse/${ans.token}`;


                    // Réinitialiser les données
                    this.responses = {};
                    this.currentQuestionIndex = 0;
                    this.currentQuestion = this.questions[this.currentQuestionIndex];
                    
                    // this.showPopupWithLink(ans.token); // Afficher la pop-up avec le lien de redirection
                } else {
                    console.error(ans.error);
                    this.FormError = true;

                }

                // this.FormError = false;

            },
            closePopup() {
                this.showPopup = false; // Fermer la fenêtre pop-up
                window.location.reload(); // Recharger la page
            },
            // showPopupWithLink(token) {
            //     const link = `${window.location.origin}/reponse/${token}`;
            //     const popupContent = `Copiez le lien suivant pour accéder à la page des réponses : ${link}`;
            //     alert(popupContent);
            // },

            copyToClipboard() {
                var textToCopy = document.getElementById("myText").textContent;
                navigator.clipboard.writeText(textToCopy).then(function() {
                    console.log('Texte copié : ' + textToCopy);
                    document.getElementById("copy").style.display = "none"; 
                    document.getElementById("copied").style.display = "initial"; 

                    setTimeout(function() {
                        document.getElementById("copied").style.display = "none"; // Masquer le message après 3 secondes
                        document.getElementById("copy").style.display = "initial"; 
                    }, 3000);
                }, function() {
                    console.error('Erreur lors de la copie du texte');
                });
                
            },
            
            previousQuestion() {
                this.currentQuestionIndex--;
                if (this.currentQuestionIndex >= 0) {
                    this.currentQuestion = this.questions[this.currentQuestionIndex];
                }
            },

            nextQuestion() {
                // Sauvegarde de la réponse dans la variable responseText
                const responseText = this.responses[this.currentQuestion.id];
                // Vérification de l'e-mail lors du passage à la question suivante
                if (this.currentQuestionIndex === 0) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    const responseText = this.responses[this.currentQuestion.id];
                    if (!emailRegex.test(responseText)) {
                        this.mailError = true;
                    // alert('Veuillez entrer une adresse e-mail valide.');
                        return; // Arrêt du passage à la question suivante si l'e-mail est invalide
                    }
                }

                // Vérification de la validité de la réponse pour les questions de type "C"
                if (this.currentQuestion.question_type === 'C') {
                    const responseText = this.responses[this.currentQuestion.id];
                    if (responseText < 1 || responseText > 5) {
                        // alert('Veuillez entrer un nombre entre 1 et 5.');
                        this.showError = true;
                        return; // Arrêt du passage à la question suivante si la réponse est invalide
                    }
                }

                // Sauvegarde de la réponse dans l'objet responses
                this.responses[this.currentQuestion.id] = responseText;

                this.currentQuestionIndex++;

                if (this.currentQuestionIndex < this.questions.length) {
                    this.currentQuestion = this.questions[this.currentQuestionIndex];
                } else {
                    this.currentQuestion = null;
                    // Redirige à la page reponse après avoir répondu à la dernière question
                    // this.$router.push({ name: 'responses' });
                }

                this.showError = false; // Réinitialisation de l'indicateur d'erreur
                this.mailError = false; // Réinitialisation de l'indicateur d'erreur
            },

            // updateAnswerCount(choice) {
            //     if (this.currentQuestionIndex === 5) {
            //         if (!this.answerCounters[choice.id]) {
            //             // Initialiser le compteur si c'est la première sélection
            //             this.answerCounters[choice.id] = 1;
            //         } else {
            //             // Incrémenter le compteur si déjà sélectionné
            //             this.answerCounters[choice.id]++;
            //         }
            //     }
            // }
            
        },
        created() {
            this.getData();
        },
    }

</script>

<template>
    <div class="container">
        <img src="@/assets/bigscreen.svg" alt="" srcset="">

      
        <div class="quizz_box" id="form">

            <h1>Formulaire</h1>
            <br>
            <h5>Merci de répondre à toutes les questions et de valider le formulaire en fin de page.</h5>
            <div v-if="currentQuestion !== null">
                <div class="quizz_form">
                    <h3>Question {{ currentQuestion.question_number }}/20</h3>
                    <div>
                        <h4>{{ currentQuestion.question_body }}</h4>
                        <p v-if="FormError" class="error_message">Veuillez répondre à toutes les questions du formulaire </p>

                    </div>
                    <div class="field">
                        <template v-if="currentQuestion.question_type === 'A'">
                        <div>
                            <div v-for="choice in currentQuestion.choices" :key="choice.id" class="form-check">
                                <input type="radio" :id="choice.id" :value="choice.choice_text" v-model="responses[currentQuestion.id]" class="form-check-input"> <!-- @change="updateAnswerCount(choice)" a mettre dans le input-->
                                <label :for="choice.id" class="form-check-label">{{ choice.choice_text }}</label>
                                <!-- <span>{{ answerCounters[choice.id] || 0 }}</span>  -->
                            </div>
                        </div>
                        </template>
                        <template v-else-if="currentQuestion.question_type === 'C'">
                            <input type="number" class="form__field" :id="currentQuestion.id" placeholder="Entrez un nombre" v-model.number="responses[currentQuestion.id]" min="1" max="5">
                            <p v-if="showError" class="error_message">Veuillez entrer un nombre compris entre 1 et 5.</p>
                        </template>
                        <template v-else-if="currentQuestion.id === 1">
                            <input type="email" class="form__field" :id="currentQuestion.id" placeholder="Entrez votre adresse mail" v-model="responses[currentQuestion.id]"  required>
                            <p v-if="mailError" class="error_message">Veuillez une adresse mail valide</p>
                        </template>
                        <template v-else>
                            <input type="text" :id="currentQuestion.id" v-model="responses[currentQuestion.id]" placeholder="Entrez votre réponse" class="form__field">
                            <!-- <p v-if="mailError" class="error_message">Veuillez une adresse mail valide</p> -->
                        </template>
                    </div>
                    <div class="form_validate">
                        <div class="form_state">
                            <i class="bi bi-arrow-left-square-fill" id="left" @click="previousQuestion" v-if="currentQuestionIndex > 0"></i>
                            <i class="bi bi-arrow-right-square-fill" id="next" @click="nextQuestion" v-if="currentQuestionIndex < questions.length - 1"></i>
                        </div>
                        <!-- <button type="button" class="btn" @click="submitForm(currentQuestion.survey_id, currentQuestion.id, responses[currentQuestion.id])" v-if="currentQuestionIndex === questions.length - 1">Soumettre</button> -->
                        <button type="button" class="btn" @click="submitAllResponses" v-if="currentQuestionIndex === questions.length - 1">Soumettre</button>
                    </div>
                </div>
            </div>
            <div v-else>
            <h2>Questionnaire terminé. Merci!</h2>
            </div>
        </div>
    </div>

    <!-- lien de redirection -->
      
    <template  v-if="showPopup">
            <div class="redirection">
                <!-- ... Votre code existant ... -->
                <button class="close-button" @click="closePopup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                </button>
                <div>
                    <p>
                        Toute l’équipe de Bigscreen vous remercie pour votre engagement. Grâce à
                        votre investissement, <br> nous vous préparons une application toujours plus facile
                        à utiliser, seul ou en famille.
                        
                    </p>
                    <P>Si vous désirez consulter vos réponses ultérieurement, vous pouvez consultez
                        cette adresse:</P>
                    <!-- Ajoutez ici le contenu stylisé de votre fenêtre pop-up -->
                    <div class="block">
                        <button class="flex ml-auto gap-2" @click="copyToClipboard()" id="copy">
                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                            Copier le lien 
                        </button>
                        <button class="flex ml-auto gap-2" @click="copyToClipboard()" id="copied" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                            </svg>
                            lien copié
                        </button>
                        <div id="myText" class="overflow-y-auto">
                            <p>{{ link }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
  </template>


<style scoped>

.container img {
    margin-top: 5%;
    width: 50%;
    margin-left: 23%;
    flex-wrap: wrap;
}

.redirection {
    position: absolute;
    top: 0;
    margin-top: 20%;
    margin-left: 28%;
    max-width: 45%;
    padding: 2%;
    background-color: rgb(49, 49, 49);
    border-radius: 15px;
    box-shadow: 1px 1px 8px 1px #383838;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
}


.close-button {
    position: absolute;
    right: 0;
    margin-top: -55px;
    margin-right: -15px;
    background: none;
    border: none;

}

#myText {
    background-color: rgb(29, 29, 29);
    padding: 1% 1% 1% 3%;
    text-align: left;
}


.block {
    background-color: rgb(43, 43, 43);
    border-radius: 4px;
    text-align: right;
}

.block button {
    background: none;
    border: none;
    color: white;
}

.quizz_box {
    align-items: center;
    max-width: 70%;
    /* background-color: rgb(240, 239, 239);
    box-shadow: 5px 10px 8px 1px #888888; */
    margin-top: 5%;
    margin-left: 15%;
    border-radius: 15px;
    padding: 3%;
}

.quizz_box h1 {
    text-align: center;
    font-family: 'Orbitron', sans-serif;
    font-weight: 700;

}

.quizz_box h3 {
    font-family: 'Orbitron', sans-serif;
    font-weight: 600;
}

.quizz_box h4 {
    /* font-family: 'Orbitron', sans-serif; */
    margin-top: 3%;
    font-family: 'Poppins', sans-serif;
    font-size: 24px;
    font-weight: 400;
}

.quizz_box h5 {
    font-family: 'Poppins', sans-serif;
    font-size: 25px;
    font-weight: 400;
}

.quizz_form {
    display: inline-block;
    margin-top: 5%;
    text-align: left;
    width: 100%;
}

.field {
    margin-top: 5%;
    /* background-color: rgb(240, 239, 239);
    box-shadow: 5px 10px 8px 1px #888888; */
}

.form__field {
    font-family: inherit;
    width: 100%;
    border: 0;
    border-bottom: 2px solid #11998e;
    outline: 0;
    font-size: 1.3rem;
    padding: 7px 1%;
    background: transparent;
    -webkit-transition: 0.5s;
    transition: 0.3s ease;
}

.form__field:focus {
    padding-bottom: 6px;  
    font-weight: 700;
    border-width: 3px;
    border-image: linear-gradient(to right, #11998e, white);
    border-image-slice: 1;
}




.error_message {
  color: red;
}

.form-check {
    margin: 5% 1%;
    display: flex;
    align-items: center;
}


.form-check-input {
    /* margin-left: 1%; */
    align-items: center;
    margin-right: 2%;

}


.form-check-label {
    margin-left: 2%;
    font-size: 25px;
    flex-wrap: wrap;
}


input {
    color: white;
}

input[type=radio] {
    transform: scale(2);
}

input[type=radio]:focus {
    box-shadow: 1px 1px 15px 2px #11998e;
}

input[type=radio]:checked {
    background-color: #11998e;
    border: 1px solid #11998e;
    
}




/* .input_text:focus {
    border: 3px solid #00CFCF;
    outline: none;
} */

.form_validate {
    display: flex;
    align-items: center;
    width: 100%;
    justify-content: space-between;
    margin-top: 5%;
}

.form_state {
    width: 50%;
}

#left {
    margin-right: 3%;
    font-size: 55px;
    color: #00CFCF;
    transition: 0.5s ease-in-out;
}

#next {
    /* margin-right: 1%; */
    /* margin-left: 3%; */
    font-size: 55px;
    color: #00CFCF;
    transition: 0.5s ease-in-out;
}

#next:hover, #left:hover {
    color: white;
}

.btn {
    background-color: #00CFCF;
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

/* .next-btn {
    margin-top: 10px;
} */

</style>