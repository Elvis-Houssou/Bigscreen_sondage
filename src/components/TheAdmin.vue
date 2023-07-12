<script>
    import Chart from 'chart.js/auto';



    export default {
      data() {
        return {
          answerCounters: [],
        }
      },

      methods: {
        async getData() {
          const res = await(await fetch(`${this.API_URL}/responses/store`, {})).json();

          console.log(res);

          if (res.status == 'done') {
              this.answerCounters = res.result;
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
            labels: ['Oculus Quest', 'Oculus Rift/s', 'HTC Vive', 'Windows Mixed', 'Reality', 'Valve index'],
            datasets: [{
              data: [15, 30, 15, 20, 10, 10],
              backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733', '#FC0000', '#0041FC'],
              borderWidth: 1
            }]
          };

          // Données pour le graphique de la question 7
          const dataQuestion7 = {
            labels: ['SteamVR', 'Occulus store', 'Viveport', 'Windows store'],
            datasets: [{
              data: [20, 30, 30, 20],
              backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733'],
              borderWidth: 1
            }]
          };

          // Données pour le graphique de la question 10
          const dataQuestion10 = {
            labels: ['regarder la TV en direct', 'regarder des films', 'travailler', 'jouer en solo', 'jouer en équipe'],
            datasets: [{
              data: [15 , 20, 15, 30, 20],
              backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733', '#0041FC'],
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
        },

        radarCarts() {
          const ctx4 = document.getElementById('myChartRadar');


          const data = {
            labels: [
              '1',
              '2',
              '3',
              '4',
              '5',
            ],
            datasets: [
              {
                label: 'Question 11',
                data: [65, 59, 90, 81, 56],
                fill: true,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgb(255, 99, 132)',
                pointBackgroundColor: 'rgb(255, 99, 132)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(255, 99, 132)'
              },
              {
                label: 'Question 12',
                data: [40, 19, 96, 27, 100],
                fill: true,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgb(54, 162, 235)',
                pointBackgroundColor: 'rgb(54, 162, 235)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(54, 162, 235)'
              },
              {
                label: 'Question 13',
                data: [48, 40, 19, 96, 27],
                fill: true,
                backgroundColor: 'rgba(0, 252, 130, 0.2)',
                borderColor: 'rgb(0, 252, 130)',
                pointBackgroundColor: 'rgb(0, 252, 130)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(0, 252, 130)'
              },
              {
                label: 'Question 14',
                data: [82, 19, 96, 17, 100],
                fill: true,
                backgroundColor: 'rgba(229, 252, 0, 0.2)',
                borderColor: 'rgb(229, 252, 0)',
                pointBackgroundColor: 'rgb(229, 252, 0)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(229, 252, 0)'
              },
              {
                label: 'Question 15',
                data: [75, 48, 40, 63, 100],
                fill: true,
                backgroundColor: 'rgba(221, 0, 252, 0.2)',
                borderColor: 'rgb(221, 0, 252)',
                pointBackgroundColor: 'rgb(221, 0, 252)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(221, 0, 252)'
              }
            ]
          };

          // Options communes pour tous les graphiques
          const options = {
            plugins: {
              legend: {
                position: 'left'
              },
              tooltip: {
                callbacks: {
                  label: function (context) {
                    return context.label + ': ' + context.parsed + ' votes';
                  }
                }
              }
            },
            elements: {
                line: {
                  borderWidth: 3,
                },
            },
          };

          // Créer les graphiques avec les données spécifiées
          new Chart(ctx4, {
            type: 'radar',
            data: data,
            options: options
          });

        }
      },
      mounted() {
        this.createCharts();
        this.radarCarts();
      },
      created() {
        // this.getData();
      }
    };
    
    
</script>

<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Accueil</h1>
  </div>

  <div style="display: flex; justify-content: space-between; width: 100%;">
    <div style="width: 50%;">
      <h1>Question 6</h1>
      <canvas id="myChart" style=" max-height: 500px; margin-bottom: 5%;"></canvas>
      <!-- <div v-if="currentQuestion.id === 6">
        <canvas id="myChart"></canvas>
      </div> -->
      <h1>Question 10</h1>
      <canvas id="myChart1" style=" max-height: 500px;"></canvas>
    </div>
    <div style="width: 50%;">
      <h1>Question 7</h1>
      <canvas id="myChart2" style=" max-height: 500px;"></canvas>
    </div>
  </div>

  <h2>Section title</h2>

  <div class="table-responsive small"> 
    <div>
      <!-- <h1>Question 7</h1> -->
      <canvas id="myChartRadar" style=" max-height: 500px;"></canvas>
    </div>
  </div>
</template>

<style scoped>  

</style>
