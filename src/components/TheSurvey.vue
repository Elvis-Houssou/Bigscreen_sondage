<script>
 import "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js";

    const API_URL = 'http://127.0.0.1:8000/api';
    
    export default {
        data() {
        return {
            questions: [],
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
                }
                else {
                    console.error(res.error);
                }
            },

            async submitForm(surveyId, questionId, responseText) {
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
                }
                else {
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
            <div v-for="question in questions" :key="question.id" class="quizz_form">
                <div>
                    <h3>{{ question.question_body }}</h3>
                </div>
                <template v-if="question.question_type === 'A'">
                    <div class="responses_box">
                    <div v-for="choice in question.choices" :key="choice.id" class="responses">
                        <input type="radio" :id="choice.id" :value="choice.choice_text" v-model="answers[question.id]">
                        <label :for="choice.id">{{ choice.choice_text }}</label>
                    </div>
                    </div>
                </template>
                <template v-else-if="question.question_type === 'C'">
                    <input type="number" :id="question.id" v-model="answers[question.id]" min="1" max="5">
                </template>
                <template v-else>
                    <textarea :id="question.id" v-model="answers[question.id]" cols="50" rows="5"></textarea>
                </template>
                <button type="submit" @click="submitForm(question.survey_id,question.id, answers[question.id])">Submit</button>
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
    text-align: left;
}

.responses label {
    padding: 20px;
    font-size: 20px;
}

input[type=radio] {
    transform: scale(2);
}

</style>