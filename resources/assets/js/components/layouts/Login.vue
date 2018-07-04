<template>
    <div class="signin cf">
        <div class="avatar"></div>
        <h2>宮崎市民活動センター</h2>
        <hr>
        <form @submit.prevent="signin">
            <div class="inputrow">
                <input type="text" v-model="email" id="name" placeholder="ユーザID" />
                <label class="ion ion-md-person" for="name"></label>
            </div>
            <div class="inputrow">
                <input type="password" v-model="password" id="pass" placeholder="パスワード" />
                <label class="ion ion-md-lock" for="pass"></label>
            </div>
            <input type="submit" value="ログイン" />
        </form>
    </div>
</template>
<style>
    @import 'https://unpkg.com/ionicons@4.1.2/dist/css/ionicons.min.css';
    @import 'https://fonts.googleapis.com/css?family=Oxygen:400,300,700';
    @import '../../../sass/themes/msikatsu_admin/css/login.css';
</style>

<script>
    export default {
        name: "company",
        data() {
            return {
                email: "",
                password: ""
            }
        },

        created() {
            //  if(localStorage.getItem("reload") == null){
            //     localStorage.setItem("reload", 'login');
            // }
            // else if(localStorage.getItem("reload") != 'login'){
            //     window.location.reload(true)
            //     localStorage.removeItem("reload");
            //     localStorage.setItem("reload", 'login');
            // }
        },
         computed: {
            counter: function() {
                return this.$store.getters.counter
            }
        },

        methods: {
            loginClicked() {
                if (this.username == 'Administrator' && this.password == 'npocenter') {
                    localStorage.setItem("login", this.username);
                    this.$router.push({ name: 'dashboard' })
                }
                else {
                    this.$swal({
                        title: "Error!",
                        text: "Username or Password Error",
                        type: "warning",
                        confirmButtonText: "OK"
                    });
                }
            },
            signin() {
                axios.post('/api/auth/login',
                    { email: this.email, password: this.password },
                    { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(
                        (response) => {
                            const token = response.data.access_token;
                            // const base64Url = token.split('.')[1];
                            // const base64 = base64Url.replace('-', '+').replace('_', '/');
                            // console.log(JSON.parse(window.atob(base64)));

                            localStorage.setItem('token', token);
                            this.$store.commit('changeUser', response.data.user)
                            console.log('user',  this.$store.state.user)
                            console.log('token', localStorage.getItem('token'))
                            window.location.href = '/admin'
                        }
                    )
                    .catch(
                        (error) => {
                            console.log(error)
                            this.$swal({
                                title: "",
                                text: "IDかパスワードが違います。",
                                type: "warning",
                                confirmButtonText: "OK"
                            });
                        }
                    );
            },
        }
    };
</script>