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
                            <span>HOME</span>
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
                            <dl v-for="citizen in variouses.citizens" :key="citizen.id">
                                <!-- format name .pdf -->
                                <dt>
                                    <a @click.prevent="downloadFile(citizen.attachments[0])">
                                        <span  v-bind:class="getType(citizen.attachments[0])"></span>
                                        {{citizen.subject}}
                                    </a>

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
                                    <a @click.prevent="downloadFile(personal.attachments[0])">
                                        <span  v-bind:class="getType(personal.attachments[0])"></span>
                                        {{personal.subject}}
                                    </a>
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
                                    <a @click.prevent="downloadFile(kawarabi.attachments[0])">
                                        <span  v-bind:class="getType(kawarabi.attachments[0])"></span>
                                        {{kawarabi.subject}}
                                    </a>
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
                                    <a @click.prevent="downloadFile(various.attachments[0])">
                                        <span  v-bind:class="getType(various.attachments[0])"></span>
                                        {{various.subject}}
                                    </a>
                                </dt>
                                <!-- description -->
                                <dd v-html="various.detail"></dd>
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
                NProgress.start()
                fetch("/api/variouses-frontend")
                    .then(res => res.json())
                    .then(res => {
                        this.variouses = res.data;
                        console.log(this.variouses);

                        NProgress.done()
                    })
                    .catch(err => console.log(err))
            },
            downloadFile(attachment) {
                console.log(attachment)
                //window.location.href = `/api/download/${attachment.path}`

                // axios({
                //     url: `/api/download/${attachment.path}`,
                //     method: 'GET',
                //     responseType: 'blob', // important
                // }).then((response) => {
                //     if (!window.navigator.msSaveOrOpenBlob) {
                //         // BLOB NAVIGATOR
                //         const url = window.URL.createObjectURL(new Blob([response.data]));
                //         const link = document.createElement('a');
                //         link.href = url;
                //         link.setAttribute('download', attachment.name);
                //         document.body.appendChild(link);
                //         link.click();
                //     } else {
                //         // BLOB FOR EXPLORER 11
                //         const url = window.navigator.msSaveOrOpenBlob(new Blob([response.data]), attachment.name);
                //     }
                // });

                this.$mollah(attachment)
            },
            getType(object) {
                let className = 'other'
                switch (object.type) {
                    case 'application/pdf':
                        className = 'pdf'
                        break;
                    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                    case 'application/msword':
                        className = 'word'
                        break;
                    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                    case 'application/vnd.ms-excel':
                        className = 'xls'
                        break;
                }
                return className
            },
        }
    };
</script>