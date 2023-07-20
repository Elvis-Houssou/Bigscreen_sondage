<script>
    
    export default {
        data() {
        return {
            results: [],
            answers: {},
        }
        },

        mounted() {
            window.addEventListener("scroll", this.handleScroll);
        },
        beforeDestroy() {
            window.removeEventListener("scroll", this.handleScroll);
        },

        methods: {
            async getData() {
                const token = this.$route.params.token;
                const res = await(await fetch(`${this.API_URL}/user/get/responses/${token}`, {})).json();

                console.log(res);

                if (res.status == 'done') {
                    this.results = res.result;
                    console.log(res);

                    
                }
                else {
                    console.error(res.error);
                }
            },
            formatDate(date) {
                const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
                const formattedDate = new Date(date).toLocaleString('fr-FR', options);
                return formattedDate;
            },
            scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            },
            handleScroll() {
                const scrollToTop = document.getElementById("scrollToTop");
                if (scrollToTop) {
                    if (window.scrollY > 200) {
                        scrollToTop.classList.add("show");
                    } else {
                        scrollToTop.classList.remove("show");
                    }
                }
            }
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

        <div class="main">
            <div class="info">
                <h2 v-if="results.length > 0">Vous trouverez ci-dessous les réponses que vous avez apportées à notre sondage le {{ formatDate(results[0].created_at) }} .</h2>
            </div>
            <div v-for="(result, index) in results" class="questionBlock">
                <div class="showQuestion">
                    <h3>{{ index + 1 }} </h3>
                    <h3> - </h3>
                    <h3>  {{ result.question.question_body }} </h3>
                </div>
                <div class="responseFields">
                    <h1> {{ result.response_text }} </h1>

                </div>
            </div>
        </div>
    </div>

    <div id="scrollToTop" @click="scrollToTop">
      <!-- <i class="arrow-up"></i> -->
      <i class="bi bi-arrow-up-circle-fill" id="arrow-up"></i>
    </div>
  </template>


<style scoped>
.container img {
    margin-top: 5%;
    width: 50%;
    margin-left: 23%;
}

.main {
    margin-top: 5%;
}

.info {
    margin-bottom: 2%;
}

.info h2 {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    font-size: 23px;
    text-align: center;
}
.showQuestion {
    display: flex;
    padding: 2% 5% 1% 1%;
}

.showQuestion h3 {
    margin-left: 1%;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;

}

/* .responseFields {} */

.questionBlock {
    background-color: rgb(43, 43, 43);
    border-radius: 15px;
    text-align: left;
    margin-bottom: 2%;
}

.responseFields {
    background-color: rgb(29, 29, 29);

    padding: 1% 2%;
    text-align: left;
}

#scrollToTop {   
    position: fixed;
    bottom: 20px;
    right: 20px;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

#scrollToTop.show {
    display: initial;
    opacity: 1;
}


#arrow-up {
    color: #11998e;
    line-height: 40px;
    font-size: 50px;
    cursor: pointer;
    
}

</style>