<template>
    <div>
        <!-- nav -->

        <div id="global_nav">
            <div class="navbar navbar-expand-lg">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"></button>
                <nav class="global_nav collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="clearfix">
                        <li>
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
                                        <span>ボランティアを<br>募集したい</span>
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

        <!-- pagetitle -->

        <div id="pagetitle" class="book">
            <div class="container">
                <div class="h2">
                    <h2>かわら版</h2>
                </div>
            </div>
        </div>

        <!-- topicpath -->

        <div id="topicpath">
            <div class="container">
                <ol class="topicpath">
                    <li>
                        <router-link :to="{ name: 'home' }">
                            <span>HOME</span>
                        </router-link>
                    </li>
                    <li>かわら版</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div class="maincontents">
            <div class="book container">
                <div class="book_box">
                    <div class="book_img"><img src="../../../../sass/themes/frontend/images/img_kawara.png"></div>
                    <div class="book_contents">
                        
                        <div class="links">
                            <dl v-for="attachment in attachments" :key="attachment.id">
                                <dt><a @click.prevent="downloadFile(attachment)" href="#!">{{kawarabi.subject}}</a></dt>
                                <dd v-html="kawarabi.detail"></dd>
                            </dl>
                        </div>
                        <div class="other_info">
                            <dl>
                                <dt>発行回数</dt>
                                <dd>毎月</dd>
                            </dl>
                            <!-- <dl>
                                <dt>発行日</dt>
                                <dd>発行月の第4週</dd>
                            </dl> -->
                            <dl>
                                <dt>規格</dt>
                                <dd>A4判　6～10ページ</dd>
                            </dl>
                            <!-- <dl>
                                <dt>発行部数</dt>
                                <dd>5000部</dd>
                            </dl> -->
                            <dl>
                                <dt>掲載内容</dt>
                                <dd>ボランティア活動紹介、新規市民活動団体紹介、企業貢献活動紹介、市社会福祉協議会の情報コーナー ほか</dd>
                            </dl>
                            <dl>
                                <dt>設置場所</dt>
                                <dd>宮崎市民活動センター、宮崎市民プラザ1F、宮崎市地域コミュニティ課、宮崎市社協ボランティアセンター、NPO法人みやざき子ども文化センター、よってんプラザ(橘通り)、宮崎銀行市内各支店、宮崎市立図書館、宮崎科学技術館、大淀川学習館、宮崎市民文化ホール、NPO法人宮崎文化本舗、宮崎市の各公民館、宮崎県庁、宮崎県立総合博物館、宮崎市 保健所、 ほか(順不同掲載)</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        components: {},
        name: "home",
        data() {
            return {
                kawarabi: [],
                attachments: []
            }
        },

        created() {
            this.fetchkawarabi()
        },

        methods: {
            fetchkawarabi(page_url) {
                NProgress.start()
                let vm = this;
                page_url = page_url || "/api/kawarabis-frontend"
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.kawarabi = res.data[0]
                        console.log(this.kawarabi)
                        this.pullAttachments(this.kawarabi)
                        NProgress.done()
                    })
                    .catch(err => console.log(err))
            },
            pullAttachments(kawarabi) {
                
                // Make HTTP request to store announcement
                NProgress.start()
                axios.get(`/api/asset/attachments/${kawarabi.file}`).then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        this.attachments = response.data.data;
                        console.log('Attachments: ', this.attachments)
                        this.getAttachmentSize()
                        NProgress.done()
                    } else {
                        console.log(response.data.errors)
                    }

                }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            getAttachmentSize() {
                this.upload_size = 0; // Reset to beginningƒ
                this.attachments.map((item) => { this.upload_size += parseInt(item.size) })
                this.upload_size = Number((this.upload_size).toFixed(1))
                this.$forceUpdate();
            },
            downloadFile(attachment) {
                console.log(attachment)
                window.location.href = `/api/download/${attachment.path}`
            }
        }
    };
</script>