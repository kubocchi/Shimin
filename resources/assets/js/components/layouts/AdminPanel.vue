<template>
    <div>
        <!-- <style lang="scss"> @import './assets/styles/main.scss'; </style> -->
        <div class="masthead">
            <div class="header_logo">
                <h1>
                    <a href="index.html">
                        <img src="../../../sass/themes/msikatsu_admin/img/logo.png" class="img-fluid">
                    </a>
                </h1>
            </div>
            <nav class="navbar navbar-expand-md navbar-light bg-light rounded mb-3">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav text-md-center nav-justified">
                        <li class="nav-item">
                            <router-link :to="{ name: 'dashboard' }">
                                <a class="nav-link">
                                    <span>
                                        <i class="fas fa-home"></i>
                                    </span> TOP
                                </a>
                            </router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span>
                                    <i class="fas fa-dove"></i>
                                </span> 情報発信</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <router-link :to="{ name: 'activeCenterList' }">
                                    <button class="dropdown-item">宮崎市民活動センター</button>
                                </router-link>
                                 <router-link :to="{ name: 'noticeList' }">
                                    <button class="dropdown-item">登録団体、行政等からのお知らせ</button>
                                </router-link>
                                 <router-link :to="{ name: 'subsidyList' }">
                                    <button class="dropdown-item">助成金情報</button>
                                </router-link>
                                <router-link :to="{ name: 'disasterList' }">
                                    <button class="dropdown-item">災害ボランティア情報</button>
                                </router-link>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span>
                                    <i class="fas fa-file"></i>
                                </span> ファイル公開</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown02">
                                <router-link :to="{ name: 'variousList' }">
                                    <button class="dropdown-item">各種様式</button>
                                </router-link>
                                <router-link :to="{ name: 'businessReportList' }">
                                    <button class="dropdown-item">事業報告</button>
                                </router-link>
                                <router-link :to="{ name: 'dreamList' }">
                                    <button class="dropdown-item">夢交差点</button>
                                </router-link>
                                <router-link :to="{ name: 'kawarabiList' }">
                                    <button class="dropdown-item">かわら版</button>
                                </router-link>
                            </div>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'groupInformationList' }">
                                <a class="nav-link">
                                    <span>
                                        <i class="fas fa-feather"></i>
                                    </span> 団体情報登録
                                </a>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span>
                                    <i class="fas fa-power-off"></i>
                                </span> ログアウト</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <span class="navbar-text" style=" color:#FFF; font-weight:bold;">loginuser name</span>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="container">
            <transition name="fade" >
                <router-view></router-view>
            </transition>
        </div>
        <!-- /container -->

        <!-- Site footer -->
        <footer class="footer fixed-bottom">
            <address>
                Copyright © Miyazaki NPO Center All Rights Reserved.
            </address>
        </footer>

        <!-- <footer class="footer">
            <address>
                Copyright © Miyazaki NPO Center All Rights Reserved.
            </address>
        </footer> -->
    </div>
</template>
<style>
    @import '../../../sass/themes/msikatsu_admin/css/style.css';
</style>


<script>
    export default {
        name: "company",
        data() {
            return {
            }
        },

        created() {
            
        },

        methods: {
        }
    };
</script>