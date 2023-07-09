<script>
    
    export default {
        data() {
            return {
                questions: [],
                currentQuestionIndex: 0,
                currentQuestion: null,
                responses: {},
                showError: false,
                seeData: undefined,
                mailError: false,
                answers6: 0,
            }
        },

        methods: {
            async getData() {
                const res = await(await fetch(`${this.API_URL}/questions/get/`, {})).json();

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
                const ans = await (await fetch(`${this.API_URL}/responses/store`, {
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

                    this.seeData = ans.token

                    console.log(seeData);

                    // Réinitialiser les données
                    this.responses = {};
                    this.currentQuestionIndex = 0;
                    this.currentQuestion = this.questions[this.currentQuestionIndex];
                    // this.$router.push({ name: 'responses' }); // Rediriger vers la page de réponses
                    // console.log("push");
                } else {
                    console.error(ans.error);
                }
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

                // if (this.currentQuestionIndex === 5) {
                //     const responseText = this.responses[this.currentQuestion.id];
                //     if (responseText) {
                //         this.answers6 = responseText.count(); // Affecter la valeur à la propriété answers6
                //         return;
                //     }
                // }

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
        },
        created() {
            this.getData();
        },
    }

</script>

<template>
    <div class="container">
      <img src="@/assets/bigscreen.svg" alt="" srcset="">
  
      <div class="quizz_box">
        <h1>Liste des questions</h1>
        <div v-if="currentQuestion !== null">
          <div class="quizz_form">
            <h3>Question {{ currentQuestion.question_number }}/20</h3>
            <div>
              <h3>{{ currentQuestion.question_body }}</h3>
            </div>
            <template v-if="currentQuestion.question_type === 'A'">
              <div class="responses_box">
                <div v-for="choice in currentQuestion.choices" :key="choice.id" class="responses">
                  <input type="radio" :id="choice.id" :value="choice.choice_text" v-model="responses[currentQuestion.id]">
                  <label :for="choice.id">{{ choice.choice_text }}</label>
                </div>
              </div>
            </template>
            <template v-else-if="currentQuestion.question_type === 'C'">
              <input type="number" class="input_numb" :id="currentQuestion.id" v-model.number="responses[currentQuestion.id]" min="1" max="5">
              <p v-if="showError" class="error_message">Veuillez entrer un nombre entre 1 et 5.</p>
            </template>
            <template v-else>
              <input type="text" :id="currentQuestion.id" v-model="responses[currentQuestion.id]" class="input_text">
              <p v-if="mailError" class="error_message">Veuillez une adresse mail valide</p>
            </template>
            <div class="form_validate">
                <div class="form_state">
                    <button type="button" class="btn" @click="previousQuestion" v-if="currentQuestionIndex > 0">Précédent</button>
                    <button type="button" class="btn" @click="nextQuestion" v-if="currentQuestionIndex < questions.length - 1">Suivant</button>
                </div>
                <!-- <button type="button" class="btn" @click="submitForm(currentQuestion.survey_id, currentQuestion.id, responses[currentQuestion.id])" v-if="currentQuestionIndex === questions.length - 1">Soumettre</button> -->
                <button type="button" class="btn" @click="submitAllResponses" v-if="currentQuestionIndex === questions.length - 1">Soumettre</button>
            </div>
          </div>
        </div>
        <!-- <div v-if="ans.status === 'done'">
          <h2>seeData</h2>
        </div> -->
        <div v-else>
          <h2>Questionnaire terminé. Merci!</h2>
        </div>
      </div>
    </div>
  </template>


<style scoped>

.responses {
    padding: 8px;
}

.error_message {
  color: red;
}

.quizz_box {
    align-items: center;
    border: 1px solid white;
    
    background-color: rgb(49, 49, 49);
    margin-top: 50px;
    border-radius: 35px;
    padding: 3%;
    text-align: left;
}

img {
    margin-top: 5%;
    width: 50%;
}
.quizz_form {
    display: inline-block;
    margin-top: 5%;
    width: 100%;
}

/* .responses_box {
    width: 100%;
} */

.responses label {
    padding: 20px;
    font-size: 20px;
}

input[type=radio] {
    transform: scale(2);
}

.input_numb {
    width: 100%;
    font-size: 25px;
}

.input_text {
    width: 100%;
    font-size: 25px;
}

.form_validate {
    display: flex;
    width: 100%;
    justify-content: space-between;
}

.form_state .btn {
    margin-right: 10px;
}
.btn {
    margin-top: 10px;
    background-color: #4D1EF7;
    color: white;
    font-size: 30px;
}

/* .next-btn {
    margin-top: 10px;
} */

</style>