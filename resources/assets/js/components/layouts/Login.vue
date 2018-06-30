<template>
    <div class="signin cf">
    <div class="avatar"></div>
        <h2>宮崎市民活動センター</h2>
        <hr>
        
            <div class="inputrow">
                <input type="text" v-model="username" id="name" placeholder="ユーザID"/>
                <label  class="ion ion-md-person" for="name"></label>
            </div>
            <div class="inputrow">
                <input type="password" v-model="password" id="pass" placeholder="パスワード"/>
                <label class="ion ion-md-lock" for="pass"></label>
            </div>
            <input @click.prevent="loginClicked" type="submit" value="ログイン"/>
        
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
                username: "",
                password: ""
            }
        },

        created() {
             if(localStorage.getItem("reload") == null){
                localStorage.setItem("reload", 'login');
            }
            else if(localStorage.getItem("reload") != 'login'){
                window.location.reload(true)
                localStorage.removeItem("reload");
                localStorage.setItem("reload", 'login');
            }
        },

        methods: {
            loginClicked(){
                if(this.username == 'Administrator' && this.password == 'npocenter'){
                    localStorage.setItem("login", this.username);
                    this.$router.push({name: 'dashboard' })
                }
                else{
                     this.$swal({
                        title: "Error!",
                        text: "Username or Password Error",
                        type: "warning",
                        confirmButtonText: "OK"
                     });
                }
            }
        }
    };
</script>