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
                                        <span>市民活動団体センターとは</span>
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

        <div id="pagetitle" class="news">
            <div class="container">
                <div class="h2">
                    <h2>助成金情報</h2>
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
                    <li>
                        <router-link :to="{ name: 'subsidyIndex' }">
                            <span>助成金情報</span>
                        </router-link>
                    </li>
                    <li>詳細</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div id="detail" class="maincontents">
            <div class="container">
                <div class="detail_haed">
                    <!-- day -->
                    <p class="day">{{subsidy.start_date}}</p>
                    <!-- title -->
                    <p class="title">{{subsidy.title}}</p>
                    <ul class="sns_share">
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="detail_body">
                    <div style="overflow:hidden" class="information">
                        <!-- text -->
                        <p v-html="subsidy.content" class="text_moredetail"></p>
                        <!-- attachments -->
                        <dl class="file">
                            <dt>添付ファイル</dt>
                            <dd>
                                <!-- <a href="#!">ドネーション説明会表.pdf</a> -->
                                <div v-cloak v-bind:key="attachment.id" v-for="attachment in attachments">
                                    <div class="form-group">
                                        <a class="label label-primary" @click.prevent="downloadFile(attachment)">
                                            {{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}
                                        </a>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        <!-- URL -->
                        <!-- <dl class="url">
                            <dt>URL</dt>
                            <dd>
                                <a href="#!">https://XXXXXXXXXXXXXXXXXXXX</a>
                            </dd>
                        </dl> -->
                    </div>
                </div>
                <div class="btn_pageback">
                    <router-link :to="{ name: 'subsidyIndex' }">
                        <span>一覧に戻る</span>
                    </router-link>
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
                subsidy: {
                    id: "",
                    title: "",
                    start_date: !!this.range ? this.dateRange[0] : "",
                    end_date: !!this.range ? this.dateRange[1] : "",
                    content: "",
                    file: "",
                    deactivate: false,
                   updated_by: this.$store.state.user != null? this.$store.state.user.id : 0,
                    created_by: this.$store.state.user != null? this.$store.state.user.id : 0
                },
                attachments: [],
            };
        },

        created() {
            console.log(this.$route.params)
            if (this.$route.params.id) {
                this.subsidy.id = this.$route.params.id
                this.getDetail()
            }
        },

        methods: {
            fillFormWithData(subsidy) {
                this.pullAttachments(subsidy);
                this.edit = true
                this.subsidy.id = subsidy.id
                this.subsidy.title = subsidy.title
                this.subsidy.start_date = subsidy.start_date
                this.subsidy.end_date = subsidy.end_date
                this.subsidy.content = subsidy.content
                this.subsidy.file = subsidy.file
                this.subsidy.deactivate = !!subsidy.deactivate == 1 ? true : false
                this.subsidy.created_by = subsidy.created_by
                this.subsidy.updated_by = subsidy.updated_by
            },
            pullAttachments(subsidy) {
                // Make HTTP request to store announcement
                NProgress.start()
                axios.get(`/api/asset/attachments/${subsidy.file}`).then(function (response) {
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
            getDetail(page_url) {
                NProgress.start()
                let vm = this;
                page_url = page_url || `/api/subsidy-frontend/${this.subsidy.id}`
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.fillFormWithData(res.data)
                        console.log(res.data)
                        NProgress.done()
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