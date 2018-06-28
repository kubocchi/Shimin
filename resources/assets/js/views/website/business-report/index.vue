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
                                                <a @click.prevent="downloadFile(attachment)" target="_blank" href="#">
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
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || "/api/frontpage-business-reports";

                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.businessReports = res.data;
                        console.log(this.businessReports);
                        loader.hide()
                    })
                    .catch(err => console.log(err))
            },
            downloadFile(attachment) {
                console.log(attachment)
                //window.open(`/api/download/${attachment.path}`)
                window.location.href = `/api/download/${attachment.path}`
                // fetch(`/api/download/${attachment.path}`)
                //     .then(res => {
                //         var blob = new Blob([res.data],{type:attachment.type});
                //         var link = document.createElement('a');
                //         link.href = window.URL.createObjectURL(blob);
                //         link.download = attachment.name;
                //         link.click();
                //     })
                //     .catch(err => console.log(err))
            },
        }
    };
</script>