<script>
 import "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js";

    const API_URL = 'http://127.0.0.1:8000/api';
    
    export default {
        data() {
            return {
                questions: [],
                currentQuestionIndex: 0,
                currentQuestion: null,
                answers: {},
            }
        },

        methods: {
            async getData() {
                const res = await(await fetch(`${API_URL}/questions/get/`, {})).json();

                console.log(res);

                if (res.status == 'done') {
                    this.questions = res.result;
                    console.log(res);
                    this.currentQuestion = this.questions[this.currentQuestionIndex];
                }
                else {
                    console.error(res.error);
                }
            },

            async submitForm(surveyId, questionId, responseText) {
                // Vérification de la validité de l'e-mail
                if (questionId === 1) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(responseText)) {
                    alert('Veuillez entrer une adresse e-mail valide.');
                    return; // Arrêt de la soumission du formulaire si l'e-mail est invalide
                    }
                }

                // Soumettre les réponses au serveur
                const res = await fetch(`${API_URL}/store/${surveyId}/${questionId}`, {
                    method: 'post',
                    headers: {
                    'Content-Type': 'application/json; charset=utf-8',
                    },
                    body: JSON.stringify({
                    answers: this.answers,
                    response_text: responseText,
                    }),
                });
                const data = await res.json();

                if (data.status === 'done') {
                    this.answers = data.result;
                    this.currentQuestionIndex++;

                    if (this.currentQuestionIndex < this.questions.length) {
                    this.currentQuestion = this.questions[this.currentQuestionIndex];
                    } else {
                    this.currentQuestion = null;
                    // Redirige à la page reponse après avoir répondu à la dernière question
                    this.$router.push({ name: 'responses' });
                    }
                } else {
                    console.error(data.error);
                }
            },
            
            previousQuestion() {
                this.currentQuestionIndex--;

                if (this.currentQuestionIndex >= 0) {
                    this.currentQuestion = this.questions[this.currentQuestionIndex];
                }
            },

            nextQuestion() {
                // Vérification de l'e-mail lors du passage à la question suivante
                if (this.currentQuestionIndex === 0) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    const responseText = this.answers[this.currentQuestion.id];
                    if (!emailRegex.test(responseText)) {
                    alert('Veuillez entrer une adresse e-mail valide.');
                    return; // Arrêt du passage à la question suivante si l'e-mail est invalide
                    }
                }

                // Vérification de la validité de la réponse pour les questions de type "C"
                if (this.currentQuestion.question_type === 'C') {
                    const responseText = this.answers[this.currentQuestion.id];
                    if (responseText < 1 || responseText > 5) {
                    alert('Veuillez entrer un nombre entre 1 et 5.');
                    return; // Arrêt du passage à la question suivante si la réponse est invalide
                    }
                }

                this.currentQuestionIndex++;

                if (this.currentQuestionIndex < this.questions.length) {
                    this.currentQuestion = this.questions[this.currentQuestionIndex];
                } else {
                    this.currentQuestion = null;
                    // Redirige à la page reponse après avoir répondu à la dernière question
                    this.$router.push({ name: 'responses' });
                }
            },
        },
        created() {
            this.getData();
            // this.submitForm();
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
                  <input type="radio" :id="choice.id" :value="choice.choice_text" v-model="answers[currentQuestion.id]">
                  <label :for="choice.id">{{ choice.choice_text }}</label>
                </div>
              </div>
            </template>
            <template v-else-if="currentQuestion.question_type === 'C'">
              <input type="number" class="input_numb" :id="currentQuestion.id" v-model="answers[currentQuestion.id]" min="1" max="5">
            </template>
            <template v-else>
              <input type="text" :id="currentQuestion.id" v-model="answers[currentQuestion.id]" class="input_text">
            </template>
            <div class="form_validate">
                <div class="form_state">   
                    <button type="button" class="btn" @click="previousQuestion" v-if="currentQuestionIndex > 0">Précédent</button>
                    <button type="button" class="btn" @click="nextQuestion" v-if="currentQuestionIndex < questions.length - 1">Suivant</button>
                </div>
              <button type="button" class="btn" @click="submitForm(currentQuestion.survey_id, currentQuestion.id, answers[currentQuestion.id])" v-if="currentQuestionIndex === questions.length - 1">Soumettre</button>
            </div>
          </div>
        </div>
        <div v-else>
          <h2>Questionnaire terminé. Merci!</h2>
        </div>
      </div>
    </div>
  </template>


<style scoped>

@import url("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css");
.responses {
    padding: 8px;
}

.quizz_box {
    align-items: center;
    border: 1px solid white;
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