<template>
    <div>
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
                        <a href="../index.html">HOME</a>
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
                            <dl v-for="citizen in variouses.citizens" :key="citizen.id">
                                <!-- format name .pdf -->
                                <dt>
                                    <a @click="downloadFile(citizen.attachments[0])">{{citizen.subject}}</a>
                                </dt>
                                <!-- description -->
                                <dd v-html="citizen.detail"></dd>
                            </dl>
                        </div>
                    </div>
                    <!-- format group -->
                    <div class="group">
                        <!-- group name -->
                        <div class="grouptitle">個人ボランティア登録・情報変更・抹消</div>
                        <div class="list">
                            <dl v-for="personal in variouses.personals" :key="personal.id">
                                <!-- format name .pdf -->
                                <dt>
                                    <a @click="downloadFile(personal.attachments[0])">{{personal.subject}}</a>
                                </dt>
                                <!-- description -->
                                <dd v-html="personal.detail"></dd>
                            </dl>
                        </div>
                    </div>
                    <!-- format group -->
                    <div class="group">
                        <!-- group name -->
                        <div class="grouptitle">かわら版掲載申込書</div>
                        <div class="list">
                            <dl v-for="kawarabi in variouses.kawarabis" :key="kawarabi.id">
                                <!-- format name .pdf -->
                                <dt>
                                    <a @click="downloadFile(kawarabi.attachments[0])">{{kawarabi.subject}}</a>
                                </dt>
                                <!-- description -->
                                <dd v-html="kawarabi.detail"></dd>
                            </dl>
                        </div>
                    </div>
                    <!-- format group -->
                    <div class="group">
                        <!-- group name -->
                        <div class="grouptitle">各種申込用紙</div>
                        <div class="list">
                            <dl v-for="various in variouses.variouses" :key="various.id">
                                <!-- format name .pdf -->
                                <dt>
                                    <a @click="downloadFile(various.attachments[0])">{{various.subject}}</a>
                                </dt>
                                <!-- description -->
                                <dd v-html="various.detail"></dd>
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
        data() {
            return {
                variouses: [],
                pagination: {},
                edit: false,
                params: {
                    search: "",
                    group: null
                },
                selectedGroup: { 'id': null, 'label': 'すべて' },
                groups: [
                    { 'id': null, 'label': 'すべて' },
                    { 'id': 1, 'label': '市民活動団体登録・情報変更' },
                    { 'id': 2, 'label': '個人ボランティア登録・情報変更・抹消' },
                    { 'id': 3, 'label': 'かわら版掲載申込書' },
                    { 'id': 4, 'label': '各種申込用紙' },
                ]
            };
        },

        created() {
            this.fetchVarious()
        },

        methods: {
            // Pulling data from API, its a post request with search-term, type
            fetchVarious(page_url) {
                let loader = this.$loading.show();
                fetch("/api/variouses-frontend")
                    .then(res => res.json())
                    .then(res => {
                        this.variouses = res.data;
                        console.log(this.variouses);
                        
                        loader.hide()
                    })
                    .catch(err => console.log(err))
            },
            downloadFile(attachment) {
                console.log(attachment)
                window.location.href = `/api/download/${attachment.path}`
            },
        }
    };
</script>