<template>
    <div class="signin cf">
    <div class="avatar"></div>
        <h2>宮崎市民活動センター</h2>
        <hr>
        <form action="" method="post">
            <div class="inputrow">
                <input type="text" id="name" placeholder="ユーザID"/>
                <label class="ion ion-md-person" for="name"></label>
            </div>
            <div class="inputrow">
                <input type="password" id="pass" placeholder="パスワード"/>
                <label class="ion ion-md-lock" for="pass"></label>
            </div>
            <input type="submit" value="ログイン"/>
        </form>
    </div>
</template>
<style>
    @import 'https://unpkg.com/ionicons@4.1.2/dist/css/ionicons.min.css';
    @import 'https://fonts.googleapis.com/css?family=Oxygen:400,300,700';
    @import '../../../sass/themes/msikatsu_admin/css/login.css';
</style>