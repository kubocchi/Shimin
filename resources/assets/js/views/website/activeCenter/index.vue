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
                    <li>センターからのお知らせ</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div id="titlelist" class="maincontents">
            <div class="container">
                <!-- news title -->
                <div class="news_contents">
                    <dl v-for="(activeCenter) in activeCenters" v-bind:key="activeCenter.id">
                        <!-- day -->
                        <dt>{{activeCenter.start_date}}</dt>
                        <!-- title -->
                         <dd>
                            <router-link :to="{ name: 'websiteActiveCenterDetail', params: { model: activeCenter }}">
                                <span class="new"></span>{{activeCenter.title}}
                            </router-link>
                        </dd>
                    </dl>
                </div>

                <!-- pagenation -->
                <div class="pagenation">
                    <nav class="pager">
                        <ul >
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="previous">
                                <a href="#" @click="fetchActiveCenter(pagination.prev_page_url)">前のページ</a>
                            </li>

                            <li class="page-item disabled">
                                <span href="#">{{ pagination.current_page }} の {{ pagination.last_page }}</span>
                            </li>

                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="next">
                                <a href="#" @click="fetchActiveCenter(pagination.next_page_url)">次のページ</a>
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
                activeCenters: [],
                pagination: {},
            }
        },

        created() {
            this.fetchActiveCenter()
        },

        methods: {
            fetchActiveCenter(page_url) {
                let vm = this;
                page_url = page_url || "/api/active-centers"
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.activeCenters = res.data
                        console.log(this.activeCenters)
                        vm.makePagination(res.meta, res.links);
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