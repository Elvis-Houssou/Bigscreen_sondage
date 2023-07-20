<script>
    export default {
      data() {
        return {
          questions: [],
        }
      },

      methods: {
        async getData() {
            const res = await(await fetch(`${this.API_URL}/admin/get/responses/${this.getCurrentUser(this.storageName).token}`, {})).json();

            if (res.status == 'done') {
                this.questions = res.result;
                console.log(res);
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

      created() {
        this.getData();
      },
    };
    
    
</script>

<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Liste des Réponses de chaque utilisateurs</h1>
      <div class="d-grid">
        <button class="btn btn-danger" type="submit" @click.prevent="logout()" >Se deconnecter</button>
      </div>
  </div>

  <table class="table table-dark table-hover" v-for='(answer, index) in questions' :key="index">
    
    <thead>
      <tr>
        <th>Numéro de la Question</th>
        <th>Corps de la Question</th>
        <th>Réponse à la Question</th>
      </tr>
    </thead>

    <tbody>
      <tr v-for='response in answer' :key="index">
        <td >{{ response.question_id }}</td>
        <td >{{ response.question.question_body}}</td>
        <td >{{ response.response_text}}</td>
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
