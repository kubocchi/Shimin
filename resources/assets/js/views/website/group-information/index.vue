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
                    <li>団体をさがす</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div class="maincontents oraganization">
            <div class="container">
                <!-- side nav -->
                <div class="sidenav">
                    <div id="sidenav_affix">
                        <!-- sort  -->
                        <div class="sort_panel">
                            <div class="head">
                                <p>絞り込み検索</p>
                            </div>
                            <div class="body clearfix">
                                <!-- type -->
                                <dl class="input-group">
                                    <dd class="clearfix">
                                        <label class="checkbox individual">
                                            <input type="radio" name="type" v-model="params.type" >
                                            <span class="icon"></span>全て</label>
                                        <label class="checkbox individual">
                                            <input type="radio" name="type" v-model="params.type" value="0">
                                            <span class="icon"></span>個人</label>
                                        <label class="checkbox oraganization">
                                            <input type="radio" name="type" v-model="params.type" value="1">
                                            <span class="icon"></span>団体</label>
                                    </dd>
                                </dl>
                                <!-- cate -->
                                <dl class="input-group">
                                    <dt>活動分野</dt>
                                    <dd>
                                        <multiselect 
                                            v-model="selectedActivityCategory" 
                                            :options="categories" 
                                            @select="onActivityCategorySelect" 
                                            placeholder="選んでください"
                                            selectLabel="クリックして選択する" 
                                            deselectLabel="クリックして選択を解除する" 
                                            selectedLabel="選ばれた" 
                                            track-by="id"
                                            label="name" 
                                            v-validate="'required'" 
                                            name="activity_category" 
                                            data-vv-as="活動カテゴリ"
                                            :max-height="150" 
                                            @remove="onActivityCategoryRemove">
                                        </multiselect>
                                    </dd>
                                </dl>
                                <!-- free word -->
                                <dl class="input-group">
                                    <dt>キーワード</dt>
                                    <dd>
                                        <input type="text" v-model="params.search" placeholder="キーワードを入力...">
                                    </dd>
                                </dl>
                                <!-- enter -->
                                <div class="btn_search">
                                    <button @click="fetchGroupInformation()">検 索</button>
                                </div>
                            </div>
                        </div>

                        <!-- mini nav -->
                        <div class="mininav">
                            <ul>
                                <li>
                                    <a href="../oraganization/regist.html">市民活動団体とは？</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- oraganization list -->
                <div class="oraganization_list">

                    <div class="oraganization_body">
                        <div v-for="groupInformation in groupInformations" :key="groupInformation.id" class="item">
                            <router-link :to="{ path: `group-information/${groupInformation.id}/detail` }">
                                {{groupInformation.name}}
                            </router-link>
                        </div>
                    </div>

                    <!-- pagenation -->
                    <div class="pagenation">
                        <nav class="pager">
                            <ul>
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="previous">
                                    <span href="#" @click="fetchGroupInformation(pagination.prev_page_url)">前のページ</span>
                                </li>

                                <li class="page-item disabled">
                                    <span href="#">{{ pagination.current_page }} の {{ pagination.last_page }}</span>
                                </li>

                                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="next">
                                    <span href="#" @click="fetchGroupInformation(pagination.next_page_url)">次のページ</span>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from "vue-multiselect";
    export default {
        components: { Multiselect },
        name: "home",
        data() {
            return {
                groupInformations: [],
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
                selectedActivityCategory: null,
                params: {
                    search: "",
                    type: null,
                    activityCategory: null
                },
                newTagDate: new Date('1900-01-01'),
                pagination: {},
            }
        },

        created() {
            this.fetchGroupInformation()
        },

        methods: {
            // Pulling data from API, its a post request with search-term, type
            fetchGroupInformation(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                fetch('/api/group-informations-frontend', {
                    method: "post",
                    body: JSON.stringify(this.params),
                    headers: {
                        "content-type": "application/json"
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        this.groupInformations = res.data;
                        console.log(res.data);
                        vm.makePagination(res.meta, res.links);

                        loader.hide()
                    })
                    .catch(err => console.log(err))
            },
            onActivityCategorySelect(selectedOption, id) {
                if (selectedOption) {
                    this.params.activityCategory = selectedOption.id
                    console.log(selectedOption.id)
                }
            },
            onActivityCategoryRemove(removedOption, id) {
                if (removedOption) {
                    this.params.activityCategory = null
                    console.log(removedOption.id)
                }
            },
            getActivityCategoryName(id) {
                return this.categories.find(x => x.id === id).name
            },
            getType(object) {
                let className = ''
                switch (object) {
                    case 'イベント':
                        className = 'event'
                        break;
                    case 'ボランティア情報':
                        className = 'volunteer'
                        break;
                    case '会員募集':
                        className = 'member'
                        break;
                }
                return className
            },
            getCategoryWiseClass(id) {
                return this.categories.find(x => x.id === id).class
            },
            gotoDetail(object) {
                console.log(object)
                let routeName = ''
                switch (object.type) {
                    case 'イベント':
                        routeName = 'event'
                        break;
                    case 'ボランティア情報':
                        routeName = 'volunteer'
                        break;
                    case '会員募集':
                        routeName = 'member'
                        break;
                }
                console.log(`${routeName}/${object.id}/detail`)
                return routeName
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