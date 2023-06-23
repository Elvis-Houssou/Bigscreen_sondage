<script>
    import Chart from 'chart.js/auto';
    // import "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js";

    const API_URL = 'http://127.0.0.1:8000/api';

    export default {
      data() {
        return {
          answers_surv: [],
          // currentQuestionIndex: 0,
          // currentQuestion: null,
          // answers: {},
        }
      },

      methods: {
        async getData() {
          const res = await(await fetch(`${API_URL}/responses/get/`, {})).json();

          console.log(res);

          if (res.status == 'done') {
              this.answers_surv = res.result;
              console.log(res);
              console.log(res.result.id);
          }
          else {
              console.error(res.error);
          }
        },

        createCharts() {
          const ctx = document.getElementById('myChart');
          const ctx1 = document.getElementById('myChart1');
          const ctx2 = document.getElementById('myChart2');

          // Données pour le graphique de la question 6
          const dataQuestion6 = {
            labels: ['Option 1', 'Option 2', 'Option 3'],
            datasets: [{
              data: [5, 60, 35],
              backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
              borderWidth: 1
            }]
          };

          // Données pour le graphique de la question 7
          const dataQuestion7 = {
            labels: ['Option A', 'Option B', 'Option C'],
            datasets: [{
              data: [20, 30, 50],
              backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
              borderWidth: 1
            }]
          };

          // Données pour le graphique de la question 10
          const dataQuestion10 = {
            labels: ['Option X', 'Option Y', 'Option Z'],
            datasets: [{
              data: [15, 50, 35],
              backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
              borderWidth: 1
            }]
          };

          // Options communes pour tous les graphiques
          const options = {
            plugins: {
              legend: {
                position: 'bottom'
              },
              tooltip: {
                callbacks: {
                  label: function (context) {
                    return context.label + ': ' + context.parsed + ' votes';
                  }
                }
              }
            }
          };

          // Créer les graphiques avec les données spécifiées
          new Chart(ctx, {
            type: 'pie',
            data: dataQuestion6,
            options: options
          });

          new Chart(ctx1, {
            type: 'pie',
            data: dataQuestion7,
            options: options
          });

          new Chart(ctx2, {
            type: 'pie',
            data: dataQuestion10,
            options: options
          });
        }
      },
      mounted() {
        this.createCharts();
      },
      created() {
        this.getData();
      }
    };
    
    
</script>

<template>
<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">bigscreen</a>

  <ul class="navbar-nav flex-row d-md-none">
    <li class="nav-item text-nowrap">
      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
        <svg class="bi"><use xlink:href="#search"/></svg>
      </button>
    </li>
    <li class="nav-item text-nowrap">
      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
        </svg>
        Dashboard
      </button>
    </li>
  </ul>

  <div id="navbarSearch" class="navbar-search w-100 collapse">
    <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
      <div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 active text-dark" aria-current="page" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
                </svg>
                Acceuil
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 active text-dark" aria-current="page" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-diamond-fill" viewBox="0 0 16 16">
                   <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM5.495 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z"/>
                </svg>
                Questionnaire
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 active text-dark" aria-current="page" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                    <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                </svg>
                Réponses
              </a>
            </li>
          </ul>
          
        </div>
      </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Accueil</h1>
        </div>

        <div style="display: flex; justify-content: space-between; width: 100%;">
            <div style="width: 50%;">
                <canvas id="myChart" style=" max-height: 500px; margin-bottom: 5%;"></canvas>
                <!-- <div v-if="currentQuestion.id === 6">
                  <canvas id="myChart"></canvas>
                </div> -->
                <canvas id="myChart1" style=" max-height: 500px;"></canvas>
            </div>
            <div style="width: 50%;">
                <h1>Question 8</h1>
                <canvas id="myChart2" style=" max-height: 500px;"></canvas>
            </div>

        </div>

        <h2>Section title</h2>

        <div class="table-responsive small">
        </div>
    </main>
  </div>
</div>

</template>

<style scoped>  
    @import url("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css");

</style>
