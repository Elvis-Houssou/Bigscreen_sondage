<script>
    
    export default {
        data() {
        return {
            results: [],
            answers: {},
        }
        },

        methods: {
            async getData() {
                const token = this.$route.params.token;
                const res = await(await fetch(`${this.API_URL}/user/responses/get/${token}`, {})).json();

                console.log(res);

                if (res.status == 'done') {
                    this.results = res.result;
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
        <div v-for="(result, index) in results" class="questionBlock">
            <div>
                <div class="showQuestion">
                    <h1>{{ index + 1 }} - </h1>
                    <h2> {{ result.question.question_body }} </h2>
                </div>
                <div class="responseFields">
                    <h1> {{ result.response_text }} </h1>

                </div>
            </div>
        </div>
    </div>
  </template>


<style scoped>

.showQuestion {
    display: flex;
    align-items: center;
}

.showQuestion li {
    list-style: none;
    font-size: 35px;
}

/* .responseFields {} */

.questionBlock {
    border: 5px solid white;
    align-items: center;
    /* text-align: center; */
    border-radius: 30px;
    padding: 1%;
    margin: 5%;
}


</style>