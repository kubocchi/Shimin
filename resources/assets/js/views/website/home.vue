<template>
    <!-- contents -->
    <div>
        <div class="container">
            <!-- main wrap -->
            <div id="main_wrap">
                <!-- shimin news -->
                <div id="news">
                    <div class="h2">
                        <h2>センターからのお知らせ</h2>
                    </div>
                    <div class="news_contents">
                        <dl v-for="(activeCenter) in activeCenters" v-bind:key="activeCenter.id">
                            <dt>{{activeCenter.start_date}}</dt>
                            <dd>
                                <router-link :to="{ name: '#', params: { model: activeCenter }}">
                                    <span class="new"></span>{{activeCenter.title}}
                                </router-link>
                            </dd>
                        </dl>
                    </div>
                    <div class="btn_blue">
                        <a href="#">一覧へ</a>
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
                                <div class="item event">
                                    <a href="#">
                                        <p class="day">6/17(月)~8/26(日)</p>
                                        <p class="title">
                                            <span class="new"></span>ボランティア養成講座</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item event">
                                    <a href="#">
                                        <p class="day">5/20(日)</p>
                                        <p class="title">昭和の歌謡曲レコードコンサート『昭和30年代の歌声』</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item volunteer">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">第10回　青島鬼の洗濯岩アクアスロン</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item volunteer">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">田植え体験</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item member">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">宮崎市民活動センター</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item member">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">大淀地域まちづくり推進協議会</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                            </div>
                            <!-- volunteer -->
                            <div class="tab-pane fade clearfix" id="volunteer" role="tabpanel" aria-labelledby="volunteer-tab">
                                <div class="item volunteer">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">第10回　青島鬼の洗濯岩アクアスロン</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item volunteer">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">田植え体験</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item volunteer">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">第10回　青島鬼の洗濯岩アクアスロン</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item volunteer">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">田植え体験</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item volunteer">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">第10回　青島鬼の洗濯岩アクアスロン</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item volunteer">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">田植え体験</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                            </div>
                            <!-- event -->
                            <div class="tab-pane fade clearfix" id="event" role="tabpanel" aria-labelledby="event-tab">
                                <div class="item event">
                                    <a href="#">
                                        <p class="day">6/17(月)~8/26(日)</p>
                                        <p class="title">ボランティア養成講座</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item event">
                                    <a href="#">
                                        <p class="day">5/20(日)</p>
                                        <p class="title">昭和の歌謡曲レコードコンサート『昭和30年代の歌声』</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item event">
                                    <a href="#">
                                        <p class="day">6/17(月)~8/26(日)</p>
                                        <p class="title">ボランティア養成講座</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item event">
                                    <a href="#">
                                        <p class="day">5/20(日)</p>
                                        <p class="title">昭和の歌謡曲レコードコンサート『昭和30年代の歌声』</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item event">
                                    <a href="#">
                                        <p class="day">6/17(月)~8/26(日)</p>
                                        <p class="title">ボランティア養成講座</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item event">
                                    <a href="#">
                                        <p class="day">5/20(日)</p>
                                        <p class="title">昭和の歌謡曲レコードコンサート『昭和30年代の歌声』</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                            </div>
                            <!-- member -->
                            <div class="tab-pane fade clearfix" id="member" role="tabpanel" aria-labelledby="member-tab">
                                <div class="item member">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">宮崎市民活動センター</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item member">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">大淀地域まちづくり推進協議会</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item member">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">宮崎市民活動センター</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item member">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">大淀地域まちづくり推進協議会</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item member">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">宮崎市民活動センター</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                                <div class="item member">
                                    <a href="#">
                                        <p class="day">6/24(日)</p>
                                        <p class="title">大淀地域まちづくり推進協議会</p>
                                        <p class="detail">詳細</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn_blue">
                        <a href="#">一覧へ</a>
                    </div>
                    <div class="link_blue">
                        <p>
                            <a href="" class="hatena">ボランティアを募集するには？</a>
                        </p>
                    </div>
                </div>

            </div>

            <!-- side -->
            <div class="sidebar">

                <div class="erea_brown">
                    <!-- 団体を探す -->
                    <div class="btn_big">
                        <a href="#">
                            <img src="../../../sass/themes/frontend/images/btn_searchgroup.png" alt="団体をさがす">
                        </a>
                    </div>
                    <!-- 地域まちづくり情報 -->
                    <div class="btn_big">
                        <a href="#">
                            <img src="../../../sass/themes/frontend/images/btn_machidukuri.png" alt="地域街づくり情報">
                        </a>
                    </div>
                    <!-- 広報誌 -->
                    <ul class="btn_book clearfix">
                        <li>
                            <a href="#">
                                <img src="../../../sass/themes/frontend/images/btn_book_yumeko.png" alt="夢交差点">
                                <p>最新号：
                                    <br>Vol.65(H29.1月発行)</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="../../../sass/themes/frontend/images/btn_book_kawara.png" alt="かわら版">
                                <p>最新号：
                                    <br>平成29年5月1日発行</p>
                            </a>
                        </li>
                    </ul>
                    <!-- mini menu -->
                    <ul class="mini_menu">
                        <li>
                            <a href="#">事業報告</a>
                        </li>
                        <li>
                            <a href="#">各種書式</a>
                        </li>
                        <li>
                            <a href="#">助成金情報</a>
                        </li>
                        <li>
                            <a href="#">災害ボランティア情報</a>
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
                    <a href="#">管理者ログイン</a>
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
                activeCenters: [],
            }
        },

        created() {
            this.fetchActiveCenter()
            this.loadFacebookPlugin()
        },

        methods: {
            fetchActiveCenter(page_url) {
                let vm = this;
                page_url = page_url || "/api/active-centers"
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.activeCenters = res.data
                        console.log(this.activeCenters)
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
            }
        }
    };
</script>