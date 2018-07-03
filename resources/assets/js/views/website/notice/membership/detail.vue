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
                        <li class="open">
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

        <div id="pagetitle" class="topics">
            <div class="container">
                <div class="h2">
                    <h2>ボランティア募集・イベント情報</h2>
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
                    <li>
                        <router-link :to="{ name: 'noticeIndex' }">
                            <span>ボランティア募集・イベント情報</span>
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
                    <!-- format -->
                    <p class="type">
                        <span class="member">会員募集</span>
                    </p>
                    <!-- <span class="event">イベント</span><span class="member">会員募集</span> -->
                    <!-- title -->
                    <p class="title">{{membership.organizer}}</p>
                </div>
                <div class="detail_body">
                    <div class="topinformation">
                        <!-- category -->
                        <dl class="cate">
                            <dt>活動分野：</dt>
                             <dd>
                                <span v-bind:class="getCategoryWiseClass(membership.activity_category)"> {{getActivityCategoryName(membership.activity_category)}}</span>
                            </dd>
                            <!-- type01 ~ 23 -->
                        </dl>
                        <!-- dd=>sponsor -->
                        <dl class="group">
                            <dt>募集団体：</dt>
                            <dd>{{membership.organizer}}</dd>
                        </dl>
                    </div>
                    <div class="information">
                        <!-- dd=>Details -->
                        <dl>
                            <dt>内容詳細</dt>
                            <dd v-html="membership.content">
                            </dd>
                        </dl>
                        <!-- dd=>membership_fee -->
                        <dl>
                            <dt>会費</dt>
                            <dd>{{membership.amount}}円 / 月</dd>
                        </dl>
                        <!-- dd=>URL -->
                        <dl>
                            <dt>URL</dt>
                             <dd>
                                <a @click="openInNewTab(membership.linkname)">{{membership.linkname}}</a>
                            </dd>
                        </dl>
                        <!-- dd=>contact information -->
                        <dl>
                            <dt>問合せ先</dt>
                            <dd v-html="membership.contact">
                            </dd>
                        </dl>
                        <!-- dd=>attachments -->
                        <dl>
                            <dt>添付ファイル</dt>
                            <dd v-for="attachment in attachments" :key="attachment.id">
                                <a :href="'/api/download/' + attachment.path">
                                    {{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}
                                </a>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="btn_pageback">
                    <a href="#">一覧に戻る</a>
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
                membership: {
                    id: "",
                    organizer: "",
                    activity_category: "",
                    start_date: "",
                    end_date: "",
                    file: "",
                    content: "",
                    is_payment: "0",
                    amount: "",
                    payment_type: "月",
                    linkname: "",
                    contact: "",
                },
                attachments: [],
                categories: [
                    { id: 100, name: "保健・医療", class: "type01" },
                    { id: 200, name: "高齢者福祉", class: "type02" },
                    { id: 300, name: "障害者福祉", class: "type03" },
                    { id: 400, name: "児童福祉", class: "type04" },
                    { id: 500, name: "社会教育", class: "type05" },
                    { id: 600, name: "まちづくり", class: "type06" },
                    { id: 700, name: "観光", class: "type07" },
                    { id: 800, name: "農山漁村", class: "type08" },
                    { id: 900, name: "文化芸術", class: "type09" },
                    { id: 1000, name: "環境保全", class: "type10" },
                    { id: 1100, name: "災害救援", class: "type11" },
                    { id: 1200, name: "地域安全", class: "type12" },
                    { id: 1300, name: "人権・平和", class: "type13" },
                    { id: 1400, name: "国際協力", class: "type14" },
                    { id: 1500, name: "男女共同", class: "type15" },
                    { id: 1600, name: "子供育成", class: "type16" },
                    { id: 1700, name: "情報社会", class: "type17" },
                    { id: 1800, name: "科学技術", class: "type18" },
                    { id: 1900, name: "経済活動", class: "type19" },
                    { id: 2000, name: "職業・雇用", class: "type20" },
                    { id: 2100, name: "消費者保護", class: "type21" },
                    { id: 2200, name: "NPO支援", class: "type22" },
                    { id: 2300, name: "その他区分", class: "type23" }
                ],
            };
        },

        created() {
            console.log(this.$route.params)
            if (this.$route.params.id) {
                this.membership.id = this.$route.params.id
                this.getDetail()
            }
        },

        methods: {
            fillFormWithData(membership) {
                console.log(membership)
                this.pullAttachments(membership);


                this.membership.id = membership.id;
                this.membership.organizer = membership.organizer;
                this.membership.activity_category = membership.activity_category;
                this.membership.start_date = membership.start_date;
                this.membership.end_date = membership.end_date;
                this.membership.file = membership.file;
                this.membership.content = membership.content;
                this.membership.is_payment = membership.is_payment;
                this.membership.amount = membership.amount;
                this.membership.payment_type = membership.payment_type;
                this.membership.linkname = membership.linkname;
                this.membership.contact = membership.contact;

                // For Files
                // if(event.file)
                //     this.currentAddedFileIs = event.file.split(',')
            },
            pullAttachments(object) {
                // Make HTTP request to store announcement
                let loader = this.$loading.show();
                axios.get(`/api/asset/attachments/${object.file}`).then(function (response) {
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
            getDetail(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || `/api/membership/${this.membership.id}`
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.fillFormWithData(res.data)
                        console.log(res.data)
                        loader.hide()
                    })
                    .catch(err => console.log(err))
            },
            downloadFile(attachment) {
                console.log(attachment)
                window.location.href = `/api/download/${attachment.path}`
            },
            getActivityCategoryName(id) {
                return this.categories.find(x => x.id === id).name
            },
            getCategoryWiseClass(id) {
                console.log(id)
                return this.categories.find(x => x.id === id).class
            },
            openInNewTab(url) {
                var win = window.open(url, '_blank');
                win.focus();
            }
        }
    };
</script>