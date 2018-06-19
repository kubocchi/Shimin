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
                            <a href="../index.html">
                                <span class="i"></span>
                                <span class="t">HOME</span>
                            </a>
                        </li>
                        <li class="open">
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">センター案内</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="#">市民活動センターとは</a>
                                </li>
                                <li>
                                    <a href="#">施設のご案内</a>
                                </li>
                                <li>
                                    <a href="#">各種書式</a>
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
                                    <a href="#">市民活動団体とは</a>
                                </li>
                                <li>
                                    <a href="#">登録について</a>
                                </li>
                                <li>
                                    <a href="#">団体を探したい</a>
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
                                    <a href="#">ボランティアとは</a>
                                </li>
                                <li>
                                    <a href="#">ボランティアをしたい</a>
                                </li>
                                <li>
                                    <a href="#">ボランティアを
                                        <br>募集したい</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <span class="i"></span>
                                <span class="t">Q & A</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- pagetitle -->
        
        <div id="pagetitle" class="news">
            <div class="container">
                <div class="h2">
                    <h2>センターからのお知らせ</h2>
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
                        <router-link :to="{ name: 'websiteActiveCenterIndex' }">
                            <span>センターからのお知らせ</span>
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
                    <p class="day">{{activeCenter.start_date}}</p>
                    <!-- title -->
                    <p class="title">{{activeCenter.title}}</p>
                    <ul class="sns_share">
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="detail_body">
                    <div style="overflow:hidden" class="information">
                        <!-- text -->
                        <p v-html="activeCenter.content" class="text_moredetail"></p>
                        <!-- attachments -->
                        <dl class="file">
                            <dt>添付ファイル</dt>
                            <dd>
                                <!-- <a href="#">ドネーション説明会表.pdf</a> -->
                                <div v-cloak v-bind:key="attachment.id" v-for="attachment in attachments">
                                    <div class="form-group">
                                        <span class="label label-primary">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) +
                                            'MB)'}}</span>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        <!-- URL -->
                        <dl class="url">
                            <dt>URL</dt>
                            <dd>
                                <a href="#">https://XXXXXXXXXXXXXXXXXXXX</a>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="btn_pageback">
                    <router-link :to="{ name: 'websiteActiveCenterIndex' }">
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
                activeCenter: {
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
                attachments: [],
            };
        },

        created() {
            if (this.$route.params.model)
                this.getActiveCenter(this.$route.params.model)
        },

        methods: {
            getActiveCenter(activeCenter) {
                console.log(activeCenter)
                this.pullAttachments(activeCenter);
                this.edit = true
                this.activeCenter.id = activeCenter.id
                this.activeCenter.title = activeCenter.title
                this.activeCenter.start_date = activeCenter.start_date
                this.activeCenter.end_date = activeCenter.end_date
                this.activeCenter.content = activeCenter.content
                this.activeCenter.file = activeCenter.file
                this.activeCenter.deactivate = !!activeCenter.deactivate == 1 ? true : false
                this.activeCenter.created_by = activeCenter.created_by
                this.activeCenter.updated_by = activeCenter.updated_by

                // For Files
                // if(activeCenter.file)
                //     this.currentAddedFileIs = activeCenter.file.split(',')
            },
            pullAttachments(activeCenter) {
                // Make HTTP request to store announcement
                let loader = this.$loading.show();
                axios.get(`api/asset/attachments/${activeCenter.file}`).then(function (response) {
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
        }
    };
</script>