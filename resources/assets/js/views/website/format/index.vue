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
                        <li class="open">
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">センター案内</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="../infomation/">市民活動センターとは</a>
                                </li>
                                <li>
                                    <a href="../floormap/">施設のご案内</a>
                                </li>
                                <li>
                                    <a href="../format/">各種書式</a>
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
                                    <a href="../oraganization/regist.html">登録について</a>
                                </li>
                                <li>
                                    <a href="../oraganization/">団体を探したい</a>
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
                                    <a href="../volunteer/">ボランティアをしたい</a>
                                </li>
                                <li>
                                    <a href="../volunteer/recruitment.html">ボランティアを
                                        <br>募集したい</a>
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
                                    <a href="../question/">センターについて</a>
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

        <div id="pagetitle" class="format">
            <div class="container">
                <div class="h2">
                    <h2>各種書式</h2>
                </div>
            </div>
        </div>

        <!-- topicpath -->

        <div id="topicpath">
            <div class="container">
                <ol class="topicpath">
                    <li>
                        <router-link :to="{ name: 'home' }">
                            <span>Home</span>
                        </router-link>
                    </li>
                    <li>各種書式</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div class="maincontents">
            <div class="container">
                <div class="formattop">
                    <p>施設・設備の利用時に必要な申請書や
                        <br> 市民団体登録する際に必要な様式をダウンロードすることができます。
                    </p>
                </div>
                <!-- formats list -->
                <div class="format_body">
                    <!-- format group -->
                    <div class="group">
                        <!-- group name -->
                        <div class="grouptitle">市民活動団体・登録・情報変更・抹消</div>
                        <div class="list">
                            <dl>
                                <!-- format name .pdf -->
                                <dt>
                                    <a href="#">
                                        <span class="pdf"></span>センター登録・施設利用について</a>
                                </dt>
                                <!-- description -->
                                <dd>センター登録・施設利用の説明書です。登録には団体登録申請書・名簿・会則が必要です。</dd>
                            </dl>
                            <dl>
                                <!-- format name .xls .xlsx -->
                                <dt>
                                    <a href="#">
                                        <span class="xls"></span>団体登録申請書</a>
                                </dt>
                                <!-- description -->
                                <dd>宮崎市民活動センターに団体登録をする申請書です。</dd>
                            </dl>
                            <dl>
                                <!-- format name .word -->
                                <dt>
                                    <a href="#">
                                        <span class="word"></span>会則の手引き</a>
                                </dt>
                                <!-- description -->
                                <dd>会則の見本です。この書式にこだわる必要はありません。既にある会則・定款でかまいません。</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <!-- Software DownloadPage -->
                <div class="format_software">
                    <dl>
                        <dt>
                            <a href="https://get.adobe.com/jp/reader/" target="_blank">Adobe Reader ダウンロードページ</a>
                        </dt>
                        <dd>PDFデータを参照するには、Adobe Readerが必要です。</dd>
                    </dl>
                    <dl>
                        <dt>
                            <a href="https://www.microsoft.com/ja-jp/download/office.aspx" target="_blank">Microsoft Office　ダウンロードページ</a>
                        </dt>
                        <dd>Microsoft Word、Microsoft Excel、Microsoft Power Point等のビューワソフトウェアやWindows Media Playerのダウンロードサイトです。</dd>
                    </dl>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        components: {},
        name: "company",
        data() {
            return {
                disaster: {
                    id: "",
                    title: "",
                    start_date: !!this.range ? this.dateRange[0] : "",
                    end_date: !!this.range ? this.dateRange[1] : "",
                    content: "",
                    file: "",
                    deactivate: false,
                    created_by: 1,
                    updated_by: 1
                },
                attachments: []
            };
        },

        created() {
            console.log(this.$route.params);
            if (this.$route.params.id) {
                this.disaster.id = this.$route.params.id;
                this.getDetail();
            }
        },

        methods: {
            fillFormWithData(disaster) {
                console.log(disaster);
                this.pullAttachments(disaster);
                this.edit = true;
                this.disaster.id = disaster.id;
                this.disaster.title = disaster.title;
                this.disaster.start_date = disaster.start_date;
                this.disaster.end_date = disaster.end_date;
                this.disaster.content = disaster.content;
                this.disaster.file = disaster.file;
                this.disaster.deactivate = !!disaster.deactivate == 1 ? true : false;
                this.disaster.created_by = disaster.created_by;
                this.disaster.updated_by = disaster.updated_by;

                // For Files
                // if(disaster.file)
                //     this.currentAddedFileIs = disaster.file.split(',')
            },
            pullAttachments(disaster) {
                // Make HTTP request to store announcement
                let loader = this.$loading.show();
                axios
                    .get(`api/asset/attachments/${disaster.file}`)
                    .then(
                        function (response) {
                            console.log(response);
                            if (response.data.success) {
                                this.attachments = response.data.data;
                                console.log("Attachments: ", this.attachments);
                                this.getAttachmentSize();
                                loader.hide();
                            } else {
                                console.log(response.data.errors);
                            }
                        }.bind(this)
                    ) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getAttachmentSize() {
                this.upload_size = 0; // Reset to beginningƒ
                this.attachments.map(item => {
                    this.upload_size += parseInt(item.size);
                });
                this.upload_size = Number(this.upload_size.toFixed(1));
                this.$forceUpdate();
            },
            getDetail(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || `/api/disaster/${this.disaster.id}`;
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.fillFormWithData(res.data);
                        console.log(res.data);
                        loader.hide();
                    })
                    .catch(err => console.log(err));
            },
            downloadFile(attachment) {
                console.log(attachment);
                // fetch(`/api/download/${attachment.path}`)
                //     .then(res => {
                //         var blob = new Blob([res.data],{type:attachment.type});
                //         var link = document.createElement('a');
                //         link.href = window.URL.createObjectURL(blob);
                //         link.download = attachment.name;
                //         link.click();
                //     })
                //     .catch(err => console.log(err))
                window.location.href = `/api/download/${attachment.path}`;
            }
        }
    };
</script>