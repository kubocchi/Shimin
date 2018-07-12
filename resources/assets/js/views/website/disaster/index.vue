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
                    <h2>災害ボランティア情報</h2>
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
                    <li>災害ボランティア情報</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div id="titlelist" class="maincontents">
            <div class="container">
                <!-- news title -->
                <div class="news_contents">
                    <dl v-for="(disaster) in disasters" v-bind:key="disaster.id">
                        <!-- day -->
                        <dt>{{disaster.start_date}}</dt>
                        <!-- title -->
                        <dd>
                            <router-link :to="{ path: `/disaster/${disaster.id}/detail`}">
                                <span v-if="disaster.start_date === newTagDate">
                                    <span class="new"></span>
                                </span>
                               {{disaster.title}}
                            </router-link>
                        </dd>
                    </dl>
                </div>

                <!-- pagenation -->
                <div class="pagenation">
                    <nav class="pager">
                        <ul>
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="previous">
                                <a href="#!" @click.prevent="fetchDisaster(pagination.prev_page_url)">前のページ</a>
                            </li>

                            <li class="page-item disabled">
                                <span href="#!">{{ pagination.current_page }} の {{ pagination.last_page }}</span>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="next">
                                <a href="#!" @click.prevent="fetchDisaster(pagination.next_page_url)">次のページ</a>
                            </li>
                        </ul>
                    </nav>
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
                disasters: [],
                pagination: {},
                newTagDate: new Date('1900-01-01')
            }
        },

        created() {
            this.fetchDisaster()
        },

        methods: {
            fetchDisaster(page_url) {
                NProgress.start()
                let vm = this;
                page_url = page_url || "/api/disasters-frontend"
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.disasters = res.data
                        console.log(this.disasters)

                        this.disasters.forEach(disaster => {
                            if(new Date(disaster.start_date) >  new Date(this.newTagDate))
                                this.newTagDate = disaster.start_date
                        });

                        console.log(this.newTagDate)
                        vm.makePagination(res.meta, res.links);
                        NProgress.done()
                    })
                    .catch(err => console.log(err))
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };
                this.pagination = pagination;
            }
        }
    };
</script>