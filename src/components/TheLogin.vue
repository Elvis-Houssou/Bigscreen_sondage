<script>
    import { isLoggedIn } from '../init';
    export default {
        data() {
        return {
            email : undefined,
            password : undefined,
        }
        },

        methods: {
            async Login() {
                const res = await(await fetch(`${this.API_URL}/user/login`, {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json; charset=utf-8'
                    },
                    body: JSON.stringify({
                        email : this.email,
                        password : this.password
                    })
                })).json();

                console.log(res);

                if (res.status == 'done') {
                    this.questions = res.result;
                    console.log(res);
                    // console.log(res.result.name);
                    alert(`bienvenu administrateur ${res.result.name}`);
                    isLoggedIn.value = true;

                    this.$router.push({name: 'admin.home'});
                }
                else {
                    console.error(res.error);
                }
            },
        },
        // created() {
        //     this.getData();
        // },
    }

</script>

<template>
    <div class="container">
        <img src="@/assets/bigscreen.svg" alt="" srcset="">
       <div class="form_box">
            <div>
                <h1>Login</h1>
            </div>
            <form>
                <div class="input-group mb-3">
                    <span class="input-group-text text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        </svg>
                    </span>
                    <div class="form-floating">
                        <input type="email" v-model="email" class="form-control" id="email" placeholder="email">
                        <label for="Email" class="text-dark">Email</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text text-white bg-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </span>
                    <div class="form-floating">
                        <input type="password" v-model="password" class="form-control" id="password" placeholder="password">
                        <label for="password" class="text-dark">Password</label>
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn" type="submit" @click.prevent="Login()" >Button</button>
                </div>
            </form>
       </div>
    </div>
</template>

<style scoped>    

    img {
        margin-top: 5%;
    }

    .form_box {
        margin-left: 23%;
        margin-top: 15%;
        align-items: center;
        border: 3px solid white;
        border-radius: 25px;
        max-width: 700px;
        max-height: 500px;
        padding: 5%;
        background-color: rgb(49, 49, 49);
    }

    .btn {
        background-color: #4D1EF7;
        color: white;
        font-size: 30px;
    }

    .input-group-text {
        background-color: #4D1EF7;
    }

</style>
