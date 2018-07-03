<template>
    <div>

        <!-- favicon -->
        <link rel="shortcut icon" href="/images/favicon.ico">
        <!-- header -->
        <div id="header">
            <div class="container clearfix">
                <div class="head_left">
                    <h1>
                        <a href="#" class="clearfix">
                            <p class="logo">
                                <img src="/images/h1_logo.png" alt="宮崎市民活動センター">
                            </p>
                            <p class="s_text">私たちは宮崎市民の市民活動・ボランティアを支援します。</p>
                            <p class="l_text"></p>
                        </a>
                    </h1>
                </div>
                <div class="head_right">
                    <ul class="clearfix">
                        <li>開館時間 9:00 ～ 22:00</li>
                        <li>0985-20-8777</li>
                        <li>
                            <a href="https://net-semi.sakura.ne.jp/contact_ssl/miyanpo/" target="_blank">お問合せ</a>
                        </li>
                        <li>
                            <router-link :to="{ name: 'information' }">
                                <span>アクセス</span>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- contents -->
        <transition name="fade">
            <router-view></router-view>
        </transition>


        <!-- banner -->
        <div id="banner">
            <div class="container">
                <ul class="banner">
                    <li>
                        <a href="http://www.city.miyazaki.miyazaki.jp/" target="_blank">
                            <img src="/images/banner_mycity.png" alt="宮崎市">
                        </a>
                    </li>
                    <li>
                        <a href="http://www.my-shakyo.jp/" target="_blank">
                            <img src="/images/banner_myshakyo.png" alt="宮崎市社会福祉協議会">
                        </a>
                    </li>
                    <li>
                        <a href="http://www.jnpoc.ne.jp/" target="_blank">
                            <img src="/images/banner_jnpoc.png" alt="日本NPOセンター">
                        </a>
                    </li>
                    <li>
                        <a href="http://npo.pref.miyazaki.lg.jp/" target="_blank">
                            <img src="/images/banner_mynpo.png" alt="宮崎県NPOポータルサイト">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bg-wave">
                <div class="container">
                    <div class="btn_toppage">
                        <a href="#header" class="linkInThePage"></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->

        <div id="footer">
            <div class="container">
                <!-- sitemap -->
                <div class="sitemap clearfix">
                    <dl class="links">
                        <dt>センター案内</dt>
                        <dd>
                            <router-link :to="{ name: 'information' }">
                                <span>市民活動団体センターとは</span>
                            </router-link>
                        </dd>
                        <dd>
                            <router-link :to="{ name: 'floormap' }">
                                <span>施設のご案内</span>
                            </router-link>
                        </dd>
                        <dd>
                            <router-link :to="{ name: 'various' }">
                                <span>各種書式</span>
                            </router-link>
                        </dd>
                    </dl>
                    <dl class="links">
                        <dt>市民活動団体</dt>
                        <dd>
                            <a href="http://www.city.miyazaki.miyazaki.jp/life/activities/civic_action/307.html" target="_blank">市民活動団体とは</a>
                        </dd>
                        <dd>
                            <router-link :to="{ name: 'groupInformationRegist' }">
                                <span>登録について</span>
                            </router-link>
                        </dd>
                        <dd>
                            <router-link :to="{ name: 'groupInformationIndex' }">
                                <span>団体を探したい</span>
                            </router-link>
                        </dd>
                    </dl>
                    <dl class="links">
                        <dt>ボランティア</dt>
                        <dd>
                            <router-link :to="{ name: 'volunteerIndex' }">
                                <span>ボランティアをしたい</span>
                            </router-link>
                        </dd>
                        <dd>
                            <router-link :to="{ name: 'volunteerRecruitment' }">
                                <span>ボランティアを募集したい</span>
                            </router-link>
                        </dd>
                        <dt>Q&A</dt>
                        <dd>
                            <router-link :to="{ name: 'question' }">
                                <span>センターについて</span>
                            </router-link>
                        </dd>
                        <dd>
                            <a href="http://www.city.miyazaki.miyazaki.jp/life/activities/civic_action/" target="_blank">市民活動について</a>
                        </dd>
                    </dl>
                    <dl class="links">
                        <dt>
                            <router-link :to="{ name: 'activeCenterIndex' }">
                                <span>センターからのお知らせ</span>
                            </router-link>
                        </dt>
                        <dt>
                            <router-link :to="{ name: 'noticeIndex' }">
                                <span>ボランティア募集・イベント情報</span>
                            </router-link>
                        </dt>
                        <dt>
                            <router-link :to="{ name: 'machidukuri' }">
                                <span>地域まちづくり情報</span>
                            </router-link>
                        </dt>
                        <dt>
                            <router-link :to="{ name: 'yumekousatenIndex' }">
                                <span>夢交差点</span>
                            </router-link>
                        </dt>
                        <dt>
                            <router-link :to="{ name: 'kawarabanIndex' }">
                                <span>かわら版</span>
                            </router-link>
                        </dt>
                    </dl>
                    <dl class="links">
                        <dt>
                            <router-link :to="{ name: 'businessReportIndex' }">
                                <span>事業報告</span>
                            </router-link>
                        </dt>
                        <dt>
                            <router-link :to="{ name: 'subsidyIndex' }">
                                <span>助成金情報</span>
                            </router-link>
                        </dt>
                        <dt>
                            <router-link :to="{ name: 'disasterIndex' }">
                                <span>災害ボランティア情報</span>
                            </router-link>
                        </dt>
                    </dl>
                </div>

                <!-- center-info -->
                <div id="center_info" class="clearfix">
                    <div class="left">
                        <p class="logo">
                            <img src="/images/logo_foot.png" alt="宮崎市民活動センター">
                        </p>
                        <p class="l">宮崎市民活動センター</p>
                        <p class="s">開館時間 9:00 ～ 22:00</p>
                        <p class="s">※日曜は夕方6時まで</p>
                    </div>
                    <div class="right">
                        <p>〒880-0001
                            <br> 宮崎市橘通西1丁目1番2号　宮崎市民プラザ3階</p>
                        <p>TEL：(0985) 20-8777
                            <br> FAX：(0985) 20-8411</p>
                        <p>E-mail：info@miyazaki-npocenter.jp</p>
                    </div>
                </div>

                <!-- nav -->
                <ul class="foot_nav">
                    <li>
                        <router-link :to="{ name: 'privacy' }">
                            <span>利用規約</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'menseki' }">
                            <span>免責事項</span>
                        </router-link>
                    </li>
                    <li>
                        <a href="https://net-semi.sakura.ne.jp/contact_ssl/miyanpo/" target="_blank">お問合せ</a>
                    </li>
                </ul>
            </div>

            <!-- address -->
            <div class="footer_address">
                <address>Copyright(C)Miyazaki NPO Center All Rights Reserved.</address>
            </div>
        </div>

        <!-- Facebook プラグイン -->
        <div id="fb-root"></div>
    </div>
</template>
<style>
    @import '../../../sass/themes/frontend/css/common.css';
    @import '../../../sass/themes/frontend/css/volunteer.css';
    @import '../../../sass/themes/frontend/css/machidukuri.css';
    @import '../../../sass/themes/frontend/css/question.css';
</style>

<script>
    export default {
        name: "company",
        data() {
            return {
            }
        },

        created() {
            //
            console.log('reload', localStorage.getItem("reload"))

            // if(localStorage.getItem("reload") == null){
            //     localStorage.setItem("reload", 'website');
            // }
            // else if(localStorage.getItem("reload") != 'website'){
            //     window.location.reload(true)
            //     localStorage.removeItem("reload");
            //     localStorage.setItem("reload", 'website');
            // }

            this.loadNav()
        },
        watch: {
            '$route': function(from, to) {
                this.loadNav()
            }
        },

        methods: {
            loadNav(){
                console.log('nav')
                $(function () {
                    var nav = $('nav.global_nav');
                    $('li', nav)
                        .mouseover(function (e) {
                            $('ul.submenu', this).stop().slideDown('200');
                        })
                        .mouseout(function (e) {
                            $('ul.submenu', this).stop().slideUp('200');
                        });
                });
            }
        }
    };
</script>
