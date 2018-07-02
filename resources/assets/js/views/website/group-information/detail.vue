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
                        <li>
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
                        <li class="open">
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

        <div id="pagetitle" class="oraganization">
            <div class="container">
                <div class="h2">
                    <h2>団体をさがす</h2>
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
                    <li>
                        <a href="#">団体をさがす</a>
                    </li>
                    <li>詳細</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div id="o_detail" class="maincontents">
            <div class="container">
                <div class="o_detail_head">
                    <!-- name -->
                    <p class="name">{{groupInformation.name}}</p>
                    <!-- category -->
                    <dl class="cate">
                        <dt>活動分野</dt>
                        <dd>
                            <span class="type05">社会教育</span>
                            <span class="type06">まちづくり</span>
                            <span class="type09">文化・芸術</span>
                            <span class="type10">環境保全</span>
                            <span class="type11">災害救助</span>
                            <span class="type12">地域安全</span>
                            <span class="type16">子供育成</span>
                        </dd>
                    </dl>
                </div>
                <div class="o_detail_body">
                    <div class="information">
                        <ul class="nav nav-tabs oraganization" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="default-tab" data-toggle="tab" href="#default" role="tab" aria-controls="home" aria-selected="true">基本情報</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sub-tab" data-toggle="tab" href="#sub" role="tab" aria-controls="sub" aria-selected="true">連絡先・事務局情報</a>
                            </li>
                        </ul>
                        <div class="tab-content oraganization" id="myTabContent">
                            <div class="tab-pane fade show active" id="default" role="tabpanel" aria-labelledby="default-tab">
                                <!-- name -->
                                <dl>
                                    <dt>団体名</dt>
                                    <dd>{{groupInformation.name}}</dd>
                                </dl>
                                <!-- Activity content -->
                                <dl>
                                    <dt>活動内容</dt>
                                    <dd>{{groupInformation.content}}</dd>
                                </dl>
                                <!-- dd=>csv02  -->
                                <dl>
                                    <dt>団体番号</dt>
                                    <dd>{{groupInformation.number}}</dd>
                                </dl>
                                <!-- dd=>csv02  -->
                                <dl>
                                    <dt>団体種類</dt>
                                    <dd>{{groupInformation.type == 0? '一般団体' : '個人登録ボランティア'}}</dd>
                                </dl>
                                <!-- dd=>csv08  -->
                                <dl>
                                    <dt>登録年月日</dt>
                                    <dd>{{groupInformation.registration_date}}</dd>
                                </dl>
                                <!-- dd=>csv12 -->
                                <dl>
                                    <dt>代表者名</dt>
                                    <dd>
                                        {{groupInformation.disclosure_name == 0? '': groupInformation.representative_name}}
                                    </dd>
                                </dl>
                                <!-- dd span=>csv13  -->
                                <dl>
                                    <dt>代表者名 ふりがな</dt>
                                    <dd>
                                        {{groupInformation.disclosure_name == 0? '':groupInformation.representative_name_phonetic}}
                                    </dd>
                                </dl>
                                <!-- dd=>csv09  -->
                                <dl>
                                    <dt>設立年月日</dt>
                                    <dd>{{groupInformation.establishment_date}}</dd>
                                </dl>
                                <!-- dd span.man=>csv41  --><!-- dd span.lady=>csv42  --><!-- dd span.all=>csv43  -->
                                <dl class="member">
                                    <dt>会員数</dt>
                                    <dd>
                                        <span class="man">男性 {{groupInformation.membership_male}}人</span>
                                        <span class="lady">女性 {{groupInformation.membership_female}}人</span>
                                        <span class="total">合計 {{groupInformation.all_member}}人</span>
                                    </dd>
                                </dl>
                                <!-- dd=>csv44 , csv45  -->
                                <dl>
                                    <dt>活動回数</dt>
                                    <dd>{{groupInformation.activity_frequency}}回/ {{groupInformation.activityDays}}</dd>
                                </dl>
                                <!-- dd=>csv46  -->
                                <dl>
                                    <dt>会費</dt>
                                    <dd>{{groupInformation.dues == 0? '無し': groupInformation.dues_price}}</dd>
                                </dl>
                                <!-- dd=>csv51  -->
                                <dl>
                                    <dt>入会</dt>
                                    <dd>{{groupInformation.method}}</dd>
                                </dl>
                                <!-- dd=>csv37  -->
                                <dl>
                                    <dt>Webサイト</dt>
                                    <dd><a href="#" target="_blank">{{groupInformation.contact_url}}</a></dd>
                                </dl>
                                <!-- dd=>53(not csv)  -->
                                <!-- <dl class="report">
                                    <dt>活動報告書</dt>
                                    <dd>
                                        <a href="#"><span class="pdf"></span>平成XX年◯◯◯◯◯◯◯◯◯◯◯◯</a>
                                        <a href="#"><span class="pdf"></span>平成XX年◯◯◯◯◯◯◯◯◯◯◯◯</a>
                                    </dd>
                                </dl> -->
                            </div>
                            <div class="tab-pane fade show" id="sub" role="tabpanel" aria-labelledby="sub-tab">
                                <!-- dd span=>csv22  -->
                                <dl>
                                    <dt>連絡先・事務所・事務局名</dt>
                                    <dd>{{groupInformation.disclosure_contact_name == 0 ? '': groupInformation.contact_name}}</dd>
                                </dl>
                                <dl>
                                    <dt>連絡先・事務所・事務局名 ふりがな</dt>
                                    <dd>{{groupInformation.disclosure_contact_name == 0 ? '': groupInformation.contact_name_phonetic}}</dd>
                                </dl>
                                <!-- dd=>csv26 csv27  -->
                                <dl>
                                    <dt>宛名</dt>
                                    <dd>{{groupInformation.contact_address_name}} {{groupInformation.contact_address_title}}</dd>
                                </dl>
                                <!-- dd=>csv29  -->
                                <dl>
                                    <dt>電話番号</dt>
                                    <dd>{{groupInformation.disclosure_contact_phone == 0 ? '': groupInformation.contact_phone}}</dd>
                                </dl>
                                <!-- dd=>csv31  -->
                                <dl>
                                    <dt>携帯番号</dt>
                                    <dd>{{groupInformation.disclosure_contact_phone_2 == 0 ? '': groupInformation.contact_phone_2}}</dd>
                                </dl>
                                <!-- dd=>csv33  -->
                                <dl>
                                    <dt>FAX</dt>
                                    <dd>{{groupInformation.disclosure_contact_fax == 0 ? '': groupInformation.contact_fax}}</dd>
                                </dl>
                                <!-- dd=>csv35  -->
                                <dl>
                                    <dt>メールアドレス</dt>
                                    <dd>{{groupInformation.disclosure_contact_mail == 0 ? '': groupInformation.contact_mail}}</dd>
                                </dl>
                                <!-- dd=>csv37  -->
                                <dl>
                                    <dt>URL</dt>
                                    <dd><a href="#">{{groupInformation.disclosure_contact_url == 0 ? '': groupInformation.contact_url}}</a></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn_pageback">
                    <a href="index.html">一覧に戻る</a>
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
                groupInformation: {},
                attachments: [],
            };
        },

        created() {
            console.log(this.$route.params)
            if (this.$route.params.id) {
                this.groupInformation.id = this.$route.params.id
                this.getDetail()
            }
        },

        methods: {
            fillFormWithData(groupInformation) {
                this.pullAttachments(groupInformation);
                
                this.groupInformation.number= groupInformation.number,
                this.groupInformation.type= groupInformation.type,
                this.groupInformation.regist_management= groupInformation.regist_management,
                this.groupInformation.open_situation= groupInformation.open_situation,
                this.groupInformation.active_status= groupInformation.active_status,
                this.groupInformation.pause_date= groupInformation.pause_date,
                this.groupInformation.application_date= groupInformation.application_date,
                this.groupInformation.registration_date= groupInformation.registration_date,
                this.groupInformation.establishment_date= groupInformation.establishment_date,
                this.groupInformation.name= groupInformation.name,
                this.groupInformation.name_phonetic= groupInformation.name_phonetic,
                this.groupInformation.representative_name= groupInformation.representative_name,
                this.groupInformation.representative_name_phonetic= groupInformation.representative_name_phonetic,
                this.groupInformation.disclosure_name= groupInformation.disclosure_name,
                this.groupInformation.representative_phone= groupInformation.representative_phone,
                this.groupInformation.disclosure_representative_phone= groupInformation.disclosure_representative_phone,
                this.groupInformation.representative_phone_2= groupInformation.representative_phone_2,
                this.groupInformation.disclosure_representative_phone_2= groupInformation.disclosure_representative_phone_2,
                this.groupInformation.representative_fax= groupInformation.representative_fax,
                this.groupInformation.disclosure_representative_fax= groupInformation.disclosure_representative_fax,
                this.groupInformation.contact_name= groupInformation.contact_name,
                this.groupInformation.contact_name_phonetic= groupInformation.contact_name_phonetic,
                this.groupInformation.disclosure_contact_name= groupInformation.disclosure_contact_name,
                this.groupInformation.postal_code= groupInformation.postal_code,
                this.groupInformation.contact_address= groupInformation.contact_address,
                this.groupInformation.contact_address_name= groupInformation.contact_address_name,
                this.groupInformation.contact_address_title= groupInformation.contact_address_title,
                this.groupInformation.disclosure_contact_address= groupInformation.disclosure_contact_address,
                this.groupInformation.contact_phone= groupInformation.contact_phone,
                this.groupInformation.disclosure_contact_phone= groupInformation.disclosure_contact_phone,
                this.groupInformation.contact_phone_2= groupInformation.contact_phone_2,
                this.groupInformation.disclosure_contact_phone_2= groupInformation.disclosure_contact_phone_2,
                this.groupInformation.contact_fax= groupInformation.contact_fax,
                this.groupInformation.disclosure_contact_fax= groupInformation.disclosure_contact_fax,
                this.groupInformation.contact_mail= groupInformation.contact_mail,
                this.groupInformation.disclosure_contact_mail= groupInformation.disclosure_contact_mail,
                this.groupInformation.contact_url= groupInformation.contact_url,
                this.groupInformation.disclosure_contact_url= groupInformation.disclosure_contact_url,
                this.groupInformation.activity_category= groupInformation.activity_category,
                this.groupInformation.active_category_supplement= groupInformation.active_category_supplement,
                this.groupInformation.membership_male= groupInformation.membership_male,
                this.groupInformation.membership_female= groupInformation.membership_female,
                this.groupInformation.all_member= groupInformation.all_member,
                this.groupInformation.dues= groupInformation.dues,
                this.groupInformation.dues_price= groupInformation.dues_price,
                this.groupInformation.content= groupInformation.content,
                this.groupInformation.rocker= groupInformation.rocker,
                this.groupInformation.mail_box= groupInformation.mail_box,
                this.groupInformation.method= groupInformation.method,
                this.groupInformation.supplement= groupInformation.supplement
            },
            pullAttachments(groupInformation) {
                // Make HTTP request to store announcement
                let loader = this.$loading.show();
                axios.get(`api/asset/attachments/${groupInformation.file}`).then(function (response) {
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
                page_url = page_url || `/api/group-information/${this.groupInformation.id}`
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
        }
    };
</script>