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

        <div id="pagetitle" class="format">
            <div class="container">
                <div class="h2">
                    <h2>事業報告</h2>
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
                    <li>事業報告</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div class="maincontents report">
            <div class="container">
                <!-- side nav -->
                <div class="sidenav">
                    <div id="sidenav_affix" class="rep">
                        <div id="year-btns" class="list-group">
                            <ul class="year_btns">
                                <li v-for="(businessReport, key) in businessReports" v-bind:key="key">
                                    <a  class="list-group-item list-group-item-action" v-bind:href="'#Y'+key">{{key}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- oraganization list -->
                <div class="report_list">
                    <div class="report_body">
                        <div data-spy="scroll" data-target="#year-btns" data-offset="100" class="scrollspy-example">
                            <div v-for="(businessReport, key, rowNumber) in businessReports" v-bind:key="rowNumber" class="y_block" :id="'Y'+key">
                                <div></div>
                                <p class="yearnumber">{{key}}</p>
                                <div  v-for="business in businessReport" v-bind:key="business.id">
                                    <div class="reports">
                                        <p class="title">{{business.name}}</p>
                                        <ul>
                                            <li v-for="attachment in business.attachments" v-bind:key="attachment.id">
                                                <a href="#!" @click.prevent="downloadFile(attachment)" target="_blank">
                                                   {{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- H29 -->
                        </div>
                    </div>
                
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
                businessReports: [],
            }
        },

        created() {
            this.fetchYear()

            $( "a" ).click(function( event ) {
            event.preventDefault();
            $( "<div>" )
                .append( "default " + event.type + " prevented" )
                .appendTo( "#log" );
            });
        },

        methods: {
            fetchYear(page_url) {
                NProgress.start()
                let vm = this;
                page_url = page_url || "/api/frontpage-business-reports";

                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.businessReports = res.data;
                        console.log(this.businessReports);
                        NProgress.done()
                    })
                    .catch(err => console.log(err))
            },
            downloadFile(attachment) {
                console.log(attachment)
                //window.location.href = `/api/download/${attachment.path}`

                axios({
                    url: `/api/download/${attachment.path}`,
                    method: 'GET',
                    responseType: 'blob', // important
                }).then((response) => {
                    if (!window.navigator.msSaveOrOpenBlob) {
                        // BLOB NAVIGATOR
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', attachment.name);
                        document.body.appendChild(link);
                        link.click();
                    } else {
                        // BLOB FOR EXPLORER 11
                        const url = window.navigator.msSaveOrOpenBlob(new Blob([response.data]), attachment.name);
                    }
                });
            },
        }
    };
</script>