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

                // Vérification de la validité de la réponse pour les questions de type "C"
                if (this.currentQuestion.question_type === 'C' && (responseText < 1 || responseText > 5)) {
                    alert('Veuillez entrer un nombre entre 1 et 5.');
                    return; // Arrêt de la soumission du formulaire si la réponse est invalide
                }

                // Soumettre les réponses au serveur
                const ans = await(await fetch(`${API_URL}/store/${surveyId}/${questionId}`, {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json; charset=utf-8'
                    },
                    body: JSON.stringify({
                        answers : this.answers,
                        response_text: responseText
                    })
                })).json();

                console.log(ans);

                if (ans.status == 'done') {
                    this.answers = ans.result;
                    console.log(ans);
                    this.currentQuestionIndex++;

                    if (this.currentQuestionIndex < this.questions.length) {
                        this.currentQuestion = this.questions[this.currentQuestionIndex];
                    } else {
                        this.currentQuestion = null;
                        // redirige a la page reponse après avoir redpondu a là dernière question
                        this.$router.push({ name: 'responses' });
                    }

                } else {
                    console.error(ans.error);
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
      <h1>bigscreen</h1>
  
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
              <textarea :id="currentQuestion.id" v-model="answers[currentQuestion.id]" cols="153" rows="5"></textarea>
            </template>
            <div class="d-grid gap-2">
                <button type="submit" class="btn" @click="submitForm(currentQuestion.survey_id, currentQuestion.id, answers[currentQuestion.id])">Submit</button>
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

.btn {
    margin-top: 10px;
    background-color: #4D1EF7;
    color: white;
    font-size: 30px;
}

.next-btn {
    margin-top: 10px;
}

</style>