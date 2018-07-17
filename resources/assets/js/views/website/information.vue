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

        <div id="pagetitle" class="centerinfo">
            <div class="container">
                <div class="h2">
                    <h2>宮崎市民活動センターとは</h2>
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
                    <li>宮崎市民活動センターとは</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div id="maininfomation" class="maincontents">
            
            <!-- sec 01 -->
            <div class="section maininfo sec01">
                <div class="container clearfix">
                    <div class="left">
                        <div class="h3">
                            <h3><img src="../../../sass/themes/frontend/images/h3_info.png" alt="市民活動センターとは？" class="img_responsive"></h3>
                        </div>
                        <p>宮崎市民活動センターは市民活動をとおした<span class="color_b">市民交流の広場</span>です。<br>
                            <span class="color_b">ボランティア</span>や市民活動団体、地域活動団体を始めとした<span class="color_b">NPO</span>など、幅広い市民活動を総合的に支援します。</p>
                        <p>買い物ついでに、仕事帰りに、皆さんのご都合に合わせて<br>
                            <span class="am">朝9時</span>から、<span class="pm">夜10時</span>まで<span class="s">(日曜は夕方6時まで)</span>、いつでもご利用いただけます。<br>
                            どうぞお気軽においでください。					
                        </p>
                    </div>
                    <div class="right">
                        <p class="img"><img src="../../../sass/themes/frontend/images/illust_centermaininfo.png" alt="宮崎市民活動センター"></p>
                    </div>
                </div>
            </div>
            
            <div class="container tight">
                
                <!-- sec02 -->
                <div class="section maininfo sec02">
                    <div class="h4 subp"><h4>センターの歴史</h4></div>
                    <div class="img"></div>
                    <div class="history">
                        <p><span class="color_b">2000年8月</span>　宮崎市役所前の宮崎市民プラザ3階に宮崎市が 「宮崎市市民活動支援センター」という名称で 設置しました。</p>
                        <p><span class="color_b">2006年4月</span>　現在の名称に改めました。地域や社会のためにできることを考え、伝え、分かち合います。</p>
                    </div>
                </div>
                
                <!-- sec02 -->
                <div class="section maininfo sec03">
                    <div class="h4 subp"><h4>様々な活動を活かすセンターの7つの機能</h4></div>
                    <div class="col_01 clearfix">
                        <dl>
                            <dt>コーディネーション</dt>
                            <dd>ボランティアや市民活動をしたい人(団体)と応援したい人(団体)をつなぎます</dd>
                        </dl>
                        <dl>
                            <dt>活動の個別支援</dt>
                            <dd>会場・備品の提供、機器材の貸し出し、運営相談を行います</dd>
                        </dl>
                        <dl>
                            <dt>活動促進の学習・研修</dt>
                            <dd>各種講座や意見交換会で相互に学び合う機会を企画します</dd>
                        </dl>
                        <dl>
                            <dt>ネットワーク</dt>
                            <dd>市民・市民活動団体・企業・行政のネットワークを築きます</dd>
                        </dl>
                    </div>
                    <div class="col_02 clearfix">
                        <dl>
                            <dt>情報センター</dt>
                            <dd>情報誌やホームページにより情報発信・収集します</dd>
                        </dl>
                        <dl>
                            <dt>データ統計</dt>
                            <dd>ボランティア登録・市民活動団体登録をとおして市民活動のデータを集積します</dd>
                        </dl>
                        <dl>
                            <dt>災害ボランティアセンター</dt>
                            <dd>災害時の被災地と救援・復興ボランティアをつなぐ拠点となります</dd>
                        </dl>
                    </div>
                    <div class="col-coordi">
                        <p class="title">コーディネーターの役割</p>
                        <dl>
                            <dt>つなぐ</dt>
                            <dd>ボランティア活動を求める人と、ボランティア活動を希望する人の活動条件等を調整しながら、両者の思いをつなげていきます。</dd>
                        </dl>
                        <dl>
                            <dt>支える</dt>
                            <dd>ボランティアの不安や悩みを聞いて、相談・援助をし、市民活動団体の活動を支えます。</dd>
                        </dl>
                        <dl>
                            <dt>育てる</dt>
                            <dd>専門的な知識や技能について研修を行い、人材の育成に努めます。</dd>
                        </dl>
                        <dl>
                            <dt>情報を集める・知らせる</dt>
                            <dd>社会貢献が関わる市民活動団体、施設、学校、企業の情報や、ボランティアのニーズを集めます。</dd>
                        </dl>
                    </div>
                </div>
                
                <!-- sec04 -->
                <div class="section maininfo sec04" id="access">
                    <div class="h4 subp"><h4>アクセス</h4></div>
                    <div class="clearfix">
                        <div class="left"><p><img src="../../../sass/themes/frontend/images/illust_centermap.png" alt="地図" class="img_responsive"></p></div>
                        <div class="right">
                        
                            <div class="address">
                                <p><span class="title">住所</span>: 〒880-0001 宮崎市橘通西1丁目1番2号　宮崎市民プラザ3階<a href="https://www.google.co.jp/maps/search/%E5%AE%AE%E5%B4%8E%E5%B8%82%E6%B0%91%E6%B4%BB%E5%8B%95%E3%82%BB%E3%83%B3%E3%82%BF%E3%83%BC/@31.908371,131.4181083,17z/data=!3m1!4b1" target="_blank">マップ</a></p>
                                <p><span class="title">TEL</span>: (0985) 20-8777 　FAX : (0985) 20-8411</p>
                                <p><span class="title">利用時間</span>: <span class="red">午前9時～午後10時 (日曜は午後6時閉館)</span></p>
                                <p><span class="title">休館日</span>:<span class="red"> 12月29日～1月3日および市民プラザ保守点検日等</span></p>
                            </div>
                            <div class="moyori">
                                <p>最寄り駅　　：宮崎駅(徒歩約25分)</p>
                                <p>最寄りバス停：橘通一丁目(徒歩約5分)</p>
                            </div>
                            <div class="s">
                                <p>※毎週月曜日は市民プラザの休館日となっていますが、宮崎市民活動センターは開館してます。</p>
                                <p>※市民プラザ休館日は、南玄関からお入りください。</p>
                                <p>※車でお越しの際は地下駐車場、もしくは松橋駐車場をご利用ください。駐車スペースに限りがありますので、できるだけ公共交通機関をご利用ください。</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</template>