<script>

    export default {
      data() {
        return {
          questions: [], // tableau pour stocker les questions récupérées depuis le serveur
        }
      },

      methods: {
        
        // Fonction pour récupérer les questions depuis le serveur
        async getData() {
          const res = await(await fetch(`${this.API_URL}/admin/get/question/${this.getCurrentUser(this.storageName).token}`, {})).json();

          if (res.status == 'done') {
            this.questions = res.result;
            console.log(res);
          }
          else {
            console.error(res.error);
          }
        },

        // Fonction de déconnexion de l'administrateur
        logout() {
          if (this.storageName) {
            window.localStorage.removeItem(this.storageName);
            this.$router.push({name: 'login'});
          }
        },
      },

      created() {
            this.getData();
      },
    };
    
    
</script>

<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Liste des Questions</h1>
      <div class="d-grid">
        <button class="btn btn-danger" type="submit" @click.prevent="logout()" >Se deconnecter</button>
      </div>
  </div>

  <table class="table table-dark table-hover">

    <thead>
      <tr>
        <th scope="col">Numéro de la Question</th>
        <th scope="col">Corps de la Question</th>
        <th scope="col">Type de la Question</th>
      </tr>
    </thead>

    <tbody>
      <tr v-for='(data, index) in questions' :key="index">
        <th scope="row">{{ data.question_number }}</th>
        <td >{{ data.question_body}}</td>
        <td >{{ data.question_type}}</td>
      </tr>
    </tbody>

  </table>
</template>

<style scoped>  
.table thead {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
}

.table tbody {
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
}
</style>
