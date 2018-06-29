<template>
    <div>
        <!-- nav -->

        <div id="global_nav">
            <div class="navbar navbar-expand-lg">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></button>
                <nav class="global_nav collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="clearfix">
                        <li>
                            <a href="../index.html">
                                <span class="i"></span>
                                <span class="t">HOME</span>
                            </a>
                        </li>
                        <li>
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">センター案内</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="../infomation/">市民活動センターとは</a></li>
                                <li><a href="../floormap/">施設のご案内</a></li>
                                <li><a href="../format/">各種書式</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">市民活動団体</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="http://www.city.miyazaki.miyazaki.jp/life/activities/civic_action/307.html" target="_blank">市民活動団体とは</a></li>
                                <li><a href="../oraganization/regist.html">登録について</a></li>
                                <li><a href="../oraganization/">団体を探したい</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">ボランティア</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="../volunteer/">ボランティアをしたい</a></li>
                                <li><a href="../volunteer/recruitment.html">ボランティアを<br>募集したい</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">Q & A</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="../question/">センターについて</a></li>
                                <li><a href="http://www.city.miyazaki.miyazaki.jp/life/activities/civic_action/" target="_blank">市民活動について</a></li>
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
                    <li><a href="../index.html">HOME</a></li>
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
                            <dl v-for="(kawarabi) in kawarabis" v-bind:key="kawarabi.id">
                                <!-- title -->
                                <dt v-cloak v-bind:key="attachment.id" v-for="attachment in attachments">
                                    <a class="label label-primary" @click="downloadFile(attachment)">
                                        {{kawarabi.subject}}
                                    </a>
                                </dt>
                                <!-- detail -->
                                <dd>{{kawarabi.detail}}</dd>
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
                kawarabis: [],
                attachments: []
            }
        },

        created() {
            this.fetchkawarabi()
        },

        methods: {
            fetchkawarabi(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || "/api/kawarabis-frontend"
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.kawarabis = res.data
                        console.log(this.kawarabis)

                        console.log(this.newTagDate)
                        loader.hide()
                    })
                    .catch(err => console.log(err))
            },
            pullAttachments(kawarabi) {
                // Make HTTP request to store announcement
                let loader = this.$loading.show();
                axios.get(`api/asset/attachments/${kawarabi.file}`).then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        this.attachments = response.data.data;
                        console.log('Attachments: ', this.attachments)
                        this.getAttachmentSize()
                        loader.hide()
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