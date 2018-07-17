<template>
    <div>
        <!-- eyecatch -->
        <div id="eyecatch">
            <div class="eyecatch clearfix">
                <p class="illust bg l_01">
                    <img src="../../../sass/themes/frontend/images/bg_cloud_l01.png">
                </p>
                <p class="illust bg l_02">
                    <img src="../../../sass/themes/frontend/images/bg_cloud_l02.png">
                </p>
                <p class="illust bg l_03">
                    <img src="../../../sass/themes/frontend/images/bg_cloud_l03.png">
                </p>
                <p class="illust bg r_01">
                    <img src="../../../sass/themes/frontend/images/bg_cloud_r01.png">
                </p>
                <p class="illust bg r_02">
                    <img src="../../../sass/themes/frontend/images/bg_cloud_r02.png">
                </p>
                <p class="illust bg r_03">
                    <img src="../../../sass/themes/frontend/images/bg_cloud_r03.png">
                </p>
                <p class="illust on l">
                    <img src="../../../sass/themes/frontend/images/illust_top_l.png">
                </p>
                <p class="illust on r">
                    <img src="../../../sass/themes/frontend/images/illust_top_r.png">
                </p>
                <div class="slider-pro" id="slider-main">
                    <div class="sp-slides">
                        <!-- main slide-->
                        <div class="sp-slide">
                            <img class="sp-image" src="../../../sass/themes/frontend/images/mainslide_01.jpg" alt="宮崎市民活動センター" />
                        </div>
                        <div class="sp-slide">
                            <img class="sp-image" src="../../../sass/themes/frontend/images/mainslide_02.jpg" alt="イベントの様子" />
                        </div>
                        <div class="sp-slide">
                            <img class="sp-image" src="../../../sass/themes/frontend/images/mainslide_03.jpg" alt="センター内の様子" />
                        </div>
                        <div class="sp-slide">
                            <img class="sp-image" src="../../../sass/themes/frontend/images/mainslide_04.jpg" alt="講座の様子" />
                        </div>
                        <div class="sp-slide">
                            <img class="sp-image" src="../../../sass/themes/frontend/images/mainslide_05.jpg" alt="ドネーション商品販売会" />
                        </div>
                        <div class="sp-slide">
                            <img class="sp-image" src="../../../sass/themes/frontend/images/mainslide_06.jpg" alt="センター内の様子" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- nav -->

        <div id="global_nav" class="home">
            <div class="navbar navbar-expand-lg">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"></button>
                <nav class="global_nav collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="clearfix">
                        <li class="open">
                            <router-link :to="{ name: 'home' }">
                                <span class="i"></span>
                                <span class="t">HOME</span>
                            </router-link>
                        </li>
                        <li>
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">センター案内</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <router-link :to="{ name: 'information' }">
                                        <span>市民活動センターとは</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'floormap' }">
                                        <span>施設のご案内</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'various' }">
                                        <span>各種書式</span>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">市民活動団体</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="http://www.city.miyazaki.miyazaki.jp/life/activities/civic_action/307.html" target="_blank">市民活動団体とは</a>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'groupInformationRegist' }">
                                        <span>登録について</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'groupInformationIndex' }">
                                        <span>団体を探したい</span>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">ボランティア</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <router-link :to="{ name: 'volunteerIndex' }">
                                        <span>ボランティアをしたい</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'volunteerRecruitment' }">
                                        <span>ボランティアを
                                            <br>募集したい</span>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">Q & A</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <router-link :to="{ name: 'question' }">
                                        <span>センターについて</span>
                                    </router-link>
                                </li>
                                <li>
                                    <a href="http://www.city.miyazaki.miyazaki.jp/life/activities/civic_action/" target="_blank">市民活動について</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- contents -->
        <div id="contents_wrap">

            <div class="container">

                <!-- main wrap -->
                <div id="main_wrap">

                    <!-- nponews -->
                    <div id="news">
                        <div class="h2">
                            <h2>センターからのお知らせ</h2>
                        </div>
                        <div class="news_contents">
                            <dl v-for="(activeCenter) in activeCenters" v-bind:key="activeCenter.id">
                                <dt>{{activeCenter.start_date}}</dt>
                                <dd>
                                    <router-link :to="{ path: `/active-center/${activeCenter.id}/detail`}">
                                        <span v-if="activeCenter.start_date === newTagDate">
                                            <span class="new"></span>
                                        </span> {{activeCenter.title}}
                                    </router-link>
                                </dd>
                            </dl>
                        </div>
                        <div class="btn_blue">
                            <router-link :to="{ name: 'activeCenterIndex' }">
                                <span>一覧へ</span>
                            </router-link>
                        </div>
                    </div>

                    <!-- topic -->
                    <div id="topic">
                        <div class="h2">
                            <h2>ボランティア募集・イベント情報</h2>
                        </div>
                        <div class="topic-contents">
                            <ul class="nav nav-tabs topic_tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="home" aria-selected="true">全 て</a>
                                </li>
                                <li class="nav-item">
                                    <a id="volunteer-tab" data-toggle="tab" href="#volunteer" role="tab" aria-controls="volunteer" aria-selected="true">ボランティア募集</a>
                                </li>
                                <li class="nav-item">
                                    <a id="event-tab" data-toggle="tab" href="#event" role="tab" aria-controls="event" aria-selected="true">イベント情報</a>
                                </li>
                                <li class="nav-item">
                                    <a id="member-tab" data-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">会員募集</a>
                                </li>
                            </ul>
                            <div class="tab-content topic-list" id="myTabContent">
                                <!-- all -->
                                <div class="tab-pane fade show clearfix active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                    <div v-for="(all, rowIndex) in notices.all" :key="rowIndex" v-bind:class="getType(all)">
                                        <router-link :to="{ path: gotoDetail(all) }">
                                            <span>
                                                <p class="day">{{all.date}}</p>
                                                <p class="title">
                                                    {{all.subject}}</p>
                                                <p class="detail">詳細</p>
                                            </span>
                                        </router-link>
                                    </div>
                                </div>
                                <!-- volunteer -->
                                <div class="tab-pane fade clearfix" id="volunteer" role="tabpanel" aria-labelledby="volunteer-tab">
                                    <div v-for="(volunteer, rowIndex) in notices.volunteers" :key="rowIndex" v-bind:class="getType(volunteer)">
                                        <router-link :to="{ path: gotoDetail(volunteer) }">
                                            <span>
                                                <p class="day">{{volunteer.date}}</p>
                                                <p class="title">
                                                    {{volunteer.subject}}</p>
                                                <p class="detail">詳細</p>
                                            </span>
                                        </router-link>
                                    </div>
                                </div>
                                <!-- event -->
                                <div class="tab-pane fade clearfix" id="event" role="tabpanel" aria-labelledby="event-tab">
                                    <div v-for="(event, rowIndex) in notices.events" :key="rowIndex" v-bind:class="getType(event)">
                                        <router-link :to="{ path: gotoDetail(event) }">
                                            <span>
                                                <p class="day">{{event.date}}</p>
                                                <p class="title">
                                                    {{event.subject}}</p>
                                                <p class="detail">詳細</p>
                                            </span>
                                        </router-link>
                                    </div>
                                </div>
                                <!-- member -->
                                <div class="tab-pane fade clearfix" id="member" role="tabpanel" aria-labelledby="member-tab">
                                    <div v-for="(member, rowIndex) in notices.memberships" :key="rowIndex" v-bind:class="getType(member)">
                                        <router-link :to="{ path: gotoDetail(member) }">
                                            <span>
                                                <p class="day">{{member.date}}</p>
                                                <p class="title">
                                                    {{member.subject}}</p>
                                                <p class="detail">詳細</p>
                                            </span>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn_blue">
                            <router-link :to="{ name: 'noticeIndex' }">
                                <span>一覧へ</span>
                            </router-link>
                        </div>
                        <div class="link_blue">
                            <p>
                                <router-link :to="{ name: 'volunteerIndex' }">
                                    <a class="hatena">ボランティアに参加するには？</a>
                                </router-link>
                            </p>
                            <p>
                                <router-link :to="{ name: 'volunteerRecruitment' }">
                                    <a class="hatena">ボランティアを募集するには？</a>
                                </router-link>
                            </p>
                        </div>
                    </div>

                </div>

                <!-- side -->
                <div class="sidebar">

                    <div class="erea_brown">
                        <!-- 団体を探す -->
                        <div class="btn_big">
                            <router-link :to="{ name: 'groupInformationIndex' }">
                                <img src="../../../sass/themes/frontend/images/btn_searchgroup.png" alt="団体をさがす">
                            </router-link>
                        </div>
                        <!-- 地域まちづくり情報 -->
                        <div class="btn_big">
                            <router-link :to="{ name: 'machidukuri' }">
                                <img src="../../../sass/themes/frontend/images/btn_machidukuri.png" alt="地域街づくり情報">
                            </router-link>
                        </div>
                        <!-- 広報誌 -->
                        <ul class="btn_book clearfix">
                            <li>
                                <router-link :to="{ name: 'yumekousatenIndex' }">
                                    <img src="../../../sass/themes/frontend/images/btn_book_yumeko.png" alt="夢交差点">
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'kawarabanIndex' }">
                                    <img src="../../../sass/themes/frontend/images/btn_book_kawara.png" alt="かわら版">
                                </router-link>
                            </li>
                        </ul>
                        <!-- mini menu -->
                        <ul class="mini_menu">
                            <li>
                                <router-link :to="{ name: 'businessReportIndex' }">
                                    <span>事業報告</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'various' }">
                                    <span>各種書式</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'subsidyIndex' }">
                                    <span>助成金情報</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'disasterIndex' }">
                                    <span>災害ボランティア情報</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- Facebook -->
                    <div class="erea_fb">
                        <div class="fb-page" data-href="https://www.facebook.com/miyazakiNPOcenter/" data-tabs="timeline" data-width="330" data-height="320"
                            data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/miyazakiNPOcenter/" class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/miyazakiNPOcenter/">宮崎市民活動センター(特定非営利活動法人 N P Oみやざき）</a>
                            </blockquote>
                        </div>
                        <div class="btn_fb">
                            <a href="https://www.facebook.com/miyazakiNPOcenter/" target="_blank">Facebook</a>
                        </div>
                    </div>
                    <!-- admmin btn -->
                    <div class="btn_admin">
                        <a href="/login">
                            <span>管理者ログイン</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "home",
        data() {
            return {
                notices: [],
                activeCenters: [],
                newTagDate: new Date('1900-01-01'),
                noticeType: 4
            }
        },

        created() {
            this.fetchActiveCenter()
            this.loadFacebookPlugin()
            this.loadSlider()
            this.fetchNotice()
        },

        methods: {
            fetchActiveCenter(page_url) {
                NProgress.start()
                let vm = this;
                page_url = page_url || "/api/active-centers-frontend"

                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.activeCenters = res.data
                        console.log('fetchActiveCenter', this.activeCenters)

                        this.activeCenters.forEach(activeCenter => {
                            if (new Date(activeCenter.start_date) > new Date(this.newTagDate))
                                this.newTagDate = activeCenter.start_date
                        });
                        NProgress.done()
                    })
                    .catch(err => console.log(err))
            },
            loadFacebookPlugin() {
                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) { return; }
                    js = d.createElement(s); js.id = id;
                    js.src = 'https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v3.0';
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            },
            loadSlider() {
                $(document).ready(function () {
                    $('#slider-main').sliderPro({
                        width: 920,
                        height: 470,
                        arrows: true, //矢印の有無
                        buttons: true, //ページャーの有無
                        autoplay: true, //自動再生
                        slideDistance: 0,//スライド同士の距離
                        visibleSize: '100%' //サイドの画像
                    });
                });
            },
            fetchNotice(page_url) {
                //NProgress.start()
                NProgress.start()
                fetch(`/api/notices-homepage`)
                    .then(res => res.json())
                    .then(res => {
                        this.notices = res.data;
                        console.log('fetchNotice', res.data);
                        //NProgress.done()
                        NProgress.done()
                    })
                    .catch(err => console.log(err))
            },
            getType(object) {
                let className = ''
                switch (object.type) {
                    case 'イベント':
                        className = 'item event'
                        break;
                    case 'ボランティア':
                        className = 'item volunteer'
                        break;
                    case '会員募集':
                        className = 'item member'
                        break;
                }
                return className
            },
            getCategoryWiseClass(id) {
                return this.categories.find(x => x.id === id) ? this.categories.find(x => x.id === id).class : ''
            },
            gotoDetail(object) {
                let routeName = ''
                switch (object.type) {
                    case 'イベント':
                        routeName = 'event'
                        break;
                    case 'ボランティア':
                        routeName = 'volunteer'
                        break;
                    case '会員募集':
                        routeName = 'member'
                        break;
                }
                return `notice/${routeName}/${object.id}/detail`
            },
            gotoLogin() {
                window.location.href = '/login'
            },
        }
    };
</script>