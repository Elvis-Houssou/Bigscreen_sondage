<script>
    
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
                const res = await(await fetch(`${this.API_URL}/responses/get`, {})).json();

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



</style>