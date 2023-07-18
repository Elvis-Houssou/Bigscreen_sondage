<script>
  import Chart from 'chart.js/auto';

  export default {
    data() {
      return {
        answerGraphic: {},
        answerQuestion6: {
          'Oculus Quest' : 0,
          'Oculus Rift/s' : 0,
          'HTC Vive' : 0,
          'Windows Mixed' : 0,
          'Reality' : 0,
          'Valve index' : 0
        },
        answerQuestion7: {
          'SteamVR' : 0,
          'Occulus store' : 0,
          'Viveport' : 0,
          'Windows store' : 0
        },
        answerQuestion10: {
          'regarder la TV en direct' : 0,
          'regarder des films' : 0,
          'travailler' : 0,
          'jouer en solo' : 0,
          'jouer en équipe' : 0
        }, 

        answerQcm11: {
          '1' : 0,
          '2' : 0,
          '3' : 0,
          '4' : 0,
          '5' : 0,
        }, 

        answerQcm12: {
          '1' : 0,
          '2' : 0,
          '3' : 0,
          '4' : 0,
          '5' : 0,
        }, 

        answerQcm13: {
          '1' : 0,
          '2' : 0,
          '3' : 0,
          '4' : 0,
          '5' : 0,
        }, 

        answerQcm14: {
          '1' : 0,
          '2' : 0,
          '3' : 0,
          '4' : 0,
          '5' : 0,
        }, 

        answerQcm15: {
          '1' : 0,
          '2' : 0,
          '3' : 0,
          '4' : 0,
          '5' : 0,
        }, 
      }
    },

    methods: {
      async getData() {
        const res = await(await fetch(`${this.API_URL}/admin/get/graphic/${this.getCurrentUser(this.storageName).token}`, {})).json();

        // console.log(res);

        if (res.status == 'done') {
            this.answerGraphic = res.result;

            this.answerGraphic.forEach(e => {
              if ( e.question_id === 6 ) {
                switch (e.response_text) {
                  case 'Oculus Quest':
                    this.answerQuestion6['Oculus Quest']++;
                    break;
                  case 'Oculus Rift/s':
                    this.answerQuestion6['Oculus Rift/s']++;
                    break;
                  case 'HTC Vive':
                    this.answerQuestion6['HTC Vive']++;
                    break;
                  case 'Windows Mixed':
                    this.answerQuestion6['Windows Mixed']++;
                    break;
                  case 'Reality':
                    this.answerQuestion6['Reality']++;
                    break;
                  case 'Valve index':
                    this.answerQuestion6['Valve index']++;
                    break;
                  default:
                    break;
                }
              } else if (e.question_id === 7) {
                switch (e.response_text) {
                  case 'SteamVR':
                    this.answerQuestion7['SteamVR']++;
                    break;
                  case 'Occulus store':
                    this.answerQuestion7['Occulus store']++;
                    break;
                  case 'Viveport':
                    this.answerQuestion7['Viveport']++;
                    break;
                  case 'Windows store':
                    this.answerQuestion7['Windows store']++;
                    break;
                  default:
                    break;
                }
              } else if (e.question_id === 10) {
                switch (e.response_text) {
                  case 'regarder la TV en direct':
                    this.answerQuestion10['regarder la TV en direct']++;
                    break;
                  case 'regarder des films':
                    this.answerQuestion10['regarder des films']++;
                    break;
                  case 'travailler':
                    this.answerQuestion10['travailler']++;
                    break;
                  case 'jouer en solo':
                    this.answerQuestion10['jouer en solo']++;
                    break;
                  case 'jouer en équipe':
                    this.answerQuestion10['jouer en équipe']++;
                    break;
                  default:
                    break;
                }
              } else if (e.question_id === 11) {
                switch (e.response_text) {
                  case '1':
                    this.answerQcm11['1']++;
                    break;
                  case '2':
                    this.answerQcm11['2']++;
                    break;
                  case '3':
                    this.answerQcm11['3']++;
                    break;
                  case '4':
                    this.answerQcm11['4']++;
                    break;
                  case '5':
                    this.answerQcm11['5']++;
                    break;
                  default:
                    break;
                }
              } else if (e.question_id === 12) {
                switch (e.response_text) {
                  case '1':
                    this.answerQcm12['1']++;
                    break;
                  case '2':
                    this.answerQcm12['2']++;
                    break;
                  case '3':
                    this.answerQcm12['3']++;
                    break;
                  case '4':
                    this.answerQcm12['4']++;
                    break;
                  case '5':
                    this.answerQcm12['5']++;
                    break;
                  default:
                    break;
                }
              } else if (e.question_id === 13) {
                switch (e.response_text) {
                  case '1':
                    this.answerQcm13['1']++;
                    break;
                  case '2':
                    this.answerQcm13['2']++;
                    break;
                  case '3':
                    this.answerQcm13['3']++;
                    break;
                  case '4':
                    this.answerQcm13['4']++;
                    break;
                  case '5':
                    this.answerQcm13['5']++;
                    break;
                  default:
                    break;
                }
              } else if (e.question_id === 14) {
                switch (e.response_text) {
                  case '1':
                    this.answerQcm14['1']++;
                    break;
                  case '2':
                    this.answerQcm14['2']++;
                    break;
                  case '3':
                    this.answerQcm14['3']++;
                    break;
                  case '4':
                    this.answerQcm14['4']++;
                    break;
                  case '5':
                    this.answerQcm14['5']++;
                    break;
                  default:
                    break;
                }
              } else if (e.question_id === 15) {
                switch (e.response_text) {
                  case '1':
                    this.answerQcm15['1']++;
                    break;
                  case '2':
                    this.answerQcm15['2']++;
                    break;
                  case '3':
                    this.answerQcm15['3']++;
                    break;
                  case '4':
                    this.answerQcm15['4']++;
                    break;
                  case '5':
                    this.answerQcm15['5']++;
                    break;
                  default:
                    break;
                }
              }
            });
            // console.log(this.answerQuestion6);

            const ctx = document.getElementById('myChart');
            const ctx1 = document.getElementById('myChart1');
            const ctx2 = document.getElementById('myChart2');

            // Données pour le graphique de la question 6
            const dataQuestion6 = {
              labels: ['Oculus Quest', 'Oculus Rift/s', 'HTC Vive', 'Windows Mixed', 'Reality', 'Valve index'],
              datasets: [{
                data: [this.answerQuestion6['Oculus Quest'], this.answerQuestion6['Oculus Rift/s'], this.answerQuestion6['HTC Vive'], this.answerQuestion6['Windows Mixed'], this.answerQuestion6['Reality'], this.answerQuestion6['Valve index']],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733', '#FC0000', '#0041FC'],
                borderWidth: 1
              }]
            };

            // Données pour le graphique de la question 7
            const dataQuestion7 = {
              labels: ['SteamVR', 'Occulus store', 'Viveport', 'Windows store'],
              datasets: [{
                data: [this.answerQuestion7['SteamVR'], this.answerQuestion7['Occulus store'], this.answerQuestion7['Viveport'], this.answerQuestion7['Windows store']],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733'],
                borderWidth: 1
              }]
            };

            // Données pour le graphique de la question 10
            const dataQuestion10 = {
              labels: ['regarder la TV en direct', 'regarder des films', 'travailler', 'jouer en solo', 'jouer en équipe'],
              datasets: [{
                data: [this.answerQuestion10['regarder la TV en direct'] , this.answerQuestion10['regarder des films'], this.answerQuestion10['travailler'], this.answerQuestion10['jouer en solo'], this.answerQuestion10['jouer en équipe']],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733', '#0041FC'],
                borderWidth: 1
              }]
            };

            // Options communes pour tous les graphiques
            const options = {
              plugins: {
                legend: {
                  position: 'left',
                  labels: {
                    color: 'rgba(255, 255, 255)' // Modifier la couleur des légendes ici
                  }
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

            // console.log(res.result);
            // console.log(this.answerGraphic);

            const ctx4 = document.getElementById('myChartRadar');


            // radar chart js
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
                  data: [this.answerQcm11['1'], this.answerQcm11['2'], this.answerQcm11['3'], this.answerQcm11['4'], this.answerQcm11['5']],
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
                  data: [this.answerQcm12['1'], this.answerQcm12['2'], this.answerQcm12['3'], this.answerQcm12['4'], this.answerQcm12['5']],
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
                  data: [this.answerQcm13['1'], this.answerQcm13['2'], this.answerQcm13['3'], this.answerQcm13['4'], this.answerQcm13['5']],
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
                  data: [this.answerQcm14['1'], this.answerQcm14['2'], this.answerQcm14['3'], this.answerQcm14['4'], this.answerQcm14['5']],
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
                  data: [this.answerQcm15['1'], this.answerQcm15['2'], this.answerQcm15['3'], this.answerQcm15['4'], this.answerQcm15['5']],
                  fill: true,
                  backgroundColor: 'rgba(221, 0, 252, 0.2)',
                  borderColor: 'rgb(221, 0, 252)',
                  pointBackgroundColor: 'rgb(221, 0, 252)',
                  pointBorderColor: '#fff',
                  pointHoverBackgroundColor: '#fff',
                  pointHoverBorderColor: 'rgb(221, 0, 252)',
                }
              ]
            };

            

            // Options communes pour tous les graphiques
            const optionsRadar = {
              plugins: {
                legend: {
                  position: 'left',
                  labels: {
                    color: 'rgba(255, 255, 255)' // Modifier la couleur des légendes ici
                  }
                },
                tooltip: {
                  callbacks: {
                    label: function (context) {
                      const dataIndex = context.dataIndex;
                      const value = context.dataset.data[dataIndex];

                      return context.label + ': ' + value + ' votes';
                    }
                  }
                },
              },
              elements: {
                  line: {
                    borderWidth: 3,
                  },
              },
              scales: {
                r: {
                  pointLabels: {
                    color: 'rgba(255, 255, 255)',
                    font: {
                      size: 25 // Modifier la taille du texte ici (par exemple : 20)
                    },
                  },
                  angleLines: {
                    color: 'white',
                  },
                  grid: {
                    color: 'white'
                  }
                  
                }
              }
            };

            // Créer les graphiques avec les données spécifiées
            new Chart(ctx4, {
              type: 'radar',
              data: data,
              options: optionsRadar
            });
        }
        else {
            console.error(res.error);
        }
      },

      logout() {
          if (this.storageName) {
            window.localStorage.removeItem(this.storageName);
            this.$router.push({name: 'login'});
          }
      },
    },
    mounted() {
      this.getData();
    },
  };
    
    
</script>

<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Accueil</h1>
      <div class="d-grid">
        <button class="btn btn-danger" type="submit" @click.prevent="logout()" >Se deconnecter</button>
      </div>
  </div>

  <div >
    <div style="display: flex; width: 100%; justify-content: space-between;">
      <div style="width: 50%;">
        <h1>Question 6</h1>
        <canvas id="myChart" style=" max-height: 500px; margin-bottom: 5%;"></canvas>
      </div>

      <div style="width: 50%;">
        <h1>Question 7</h1>
        <canvas id="myChart1" style=" max-height: 500px;"></canvas>
      </div>      
    </div>
    <div style="display: flex; width: 100%; justify-content: space-between;">
      <div style="width: 50%;">
        <h1>Question 10</h1>
        <canvas id="myChart2" style=" max-height: 500px;"></canvas>
      </div>

      <div style="width: 50%;">
        <h1>Question 11 à 15</h1>
        <canvas id="myChartRadar" style=" max-height: 500px;"></canvas>
      </div>

    </div>
  </div>
</template>

<style scoped>  

</style>
