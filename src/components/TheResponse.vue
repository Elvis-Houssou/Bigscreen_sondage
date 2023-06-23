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
                const res = await(await fetch(`${API_URL}/responses/get`, {})).json();

                console.log(res);

                if (res.status == 'done') {
                    this.questions = res.result;
                    console.log(res);
                }
                else {
                    console.error(res.error);
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
        <h2>response</h2>
    </div>
  </template>


<style scoped>

@import url("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css");


</style>