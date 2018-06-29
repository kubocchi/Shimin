<template>
    <!-- nav -->
    <div>
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
                                    <a href="../oraganization/regist.html">登録について</a>
                                </li>
                                <li>
                                    <a href="../oraganization/">団体を探したい</a>
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
                        <a href="../index.html">HOME</a>
                    </li>
                    <li>ボランティア募集・イベント情報</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div class="maincontents topics">
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
                                <!-- format -->
                                <dl class="input-group">
                                    <dt>カテゴリー</dt>
                                    <dd class="clearfix">
                                        <label class="checkbox all">
                                            <input name="category" v-model="params.noticeType" value="0" type="radio">
                                            <span  class="icon"></span>全て</label>
                                        <label class="checkbox event">
                                            <input type="radio" name="category" v-model="params.noticeType" value="1">
                                            <span class="icon"></span>イベント</label>
                                        <label   class="checkbox volunteer">
                                            <input type="radio" name="category" v-model="params.noticeType" value="2">
                                            <span class="icon"></span>ボランティア</label>
                                        <label class="checkbox member">
                                            <input type="radio" name="category" v-model="params.noticeType" value="3">
                                            <span class="icon"></span>会員募集</label>
                                    </dd>
                                </dl>
                                <!-- category -->
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
                                            @remove="onActivityCategoryRemove"
                                            >
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
                                    <button @click="fetchNotice()">検 索</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- topics list -->
                <div class="topics_list">

                    <div class="topics_body">
                        <!-- link : volunteer -->
                        <div class="item" v-for="(notice, rowNumber) in notices" v-bind:key="rowNumber">
                            <a @click="gotoDetail(notice)" href="#">
                                <div class="sinfo">
                                    <!-- format -->
                                    <div class="type">
                                        <span v-bind:class="getType(notice.type)">{{notice.type}}</span>
                                    </div>
                                    <!-- activity_date -->
                                    <div class="day">{{notice.date}}</div>
                                    <!-- category -->
                                    <div class="cate">
                                        <span v-bind:class="getCategoryWiseClass(notice.activityCategory)">
                                            {{getActivityCategoryName(notice.activityCategory)}}
                                        </span>
                                    </div>
                                </div>
                                <!-- title -->
                                <div class="title">
                                     <span v-if="notice.date === newTagDate">
                                        <span class="new">new</span>
                                    </span>
                                    {{notice.subject}}
                                </div>
                            </a>
                        </div>
                        <!-- link : event -->
                    </div>

                    <!-- pagenation -->
                    <!-- <div class="pagenation">
                        <nav class="pager">
                            <ul>
                                <li class="previous">
                                    <a href="">前のページ</a>
                                </li>
                                <li class="active">
                                    <a href="">1</a>
                                </li>
                                <li>
                                    <a href="">2</a>
                                </li>
                                <li>
                                    <a href="">3</a>
                                </li>
                                <li>
                                    <a href="">4</a>
                                </li>
                                <li>
                                    <a href="">5</a>
                                </li>
                                <li class="next">
                                    <a href="">次のページ</a>
                                </li>
                            </ul>
                        </nav>
                    </div> -->

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
                notices: [],
                categories:[
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
                    noticeType: 0,
                    activityCategory : null
                },
                newTagDate: new Date('1900-01-01')
            }
        },

        created() {
            this.fetchNotice()
        },

        methods: {
            // Pulling data from API, its a post request with search-term, type
            fetchNotice(page_url) {
                let loader = this.$loading.show();

                 fetch('/api/notices', {
                    method: "post",
                    body: JSON.stringify(this.params),
                    headers: {
                        "content-type": "application/json"
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        this.notices = res.data;
                        console.log(res.data);
                        //vm.makePagination(res.meta, res.links);

                        res.data.forEach(notice => {
                            if(new Date(notice.date) > new Date(this.newTagDate))
                                this.newTagDate = notice.date
                        });

                        console.log(this.newTagDate)
                        loader.hide()
                    })
                    .catch(err => console.log(err))
            },
            onActivityCategorySelect(selectedOption, id) {
                if(selectedOption){
                    this.params.activityCategory = selectedOption.id
                    console.log(selectedOption.id)
                }
            },
            onActivityCategoryRemove(removedOption, id) {
                if(removedOption){
                    this.params.activityCategory = null
                    console.log(removedOption.id)
                }
            },
            getActivityCategoryName(id){
                return this.categories.find(x => x.id === id).name
            },
            getType(object){
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
            getCategoryWiseClass(id){
                return this.categories.find(x => x.id === id).class
            },
            gotoDetail(object){
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
                        routeName = 'membership'
                        break;
                }
                console.log(`${routeName}/${object.id}/detail`)
                this.$router.push({path: `${routeName}/${object.id}/detail` })
            },
        }
    };
</script>