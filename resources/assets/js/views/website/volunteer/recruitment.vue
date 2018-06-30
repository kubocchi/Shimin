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

        <div id="pagetitle" class="volunteer">
            <div class="container">
                <div class="h2">
                    <h2>ボランティアを募集したい</h2>
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
                    <li>ボランティアを募集したい</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div id="volunteer" class="maincontents">
            
            <!-- sec01 -->
            <div class="section vol02 sec01">
                <div class="container clearfix">
                    <div class="h3"><h3><img src="../../../../sass/themes/frontend/images/h3_vol02.png" class="img_responsive" alt="ボランティア募集の流れ"></h3></div>
                    <ul class="step clearfix">
                        <li><img src="../../../../sass/themes/frontend/images/illust_vol2_step01.png" alt="宮崎市民活動センターに来所"></li>
                        <li><img src="../../../../sass/themes/frontend/images/illust_vol2_step02.png" alt="所定の申込用紙へ記入">
                            <p>サイトからのダウンロードは
                                <router-link :to="{ name: 'various' }">
                                    <span>こちら</span>
                                </router-link>から</p>
                            </li>
                        <li><img src="../../../../sass/themes/frontend/images/illust_vol2_step03.png" alt="職員によるヒアリング"></li>
                    </ul>
                    <div class="step_sp"><img src="../../../../sass/themes/frontend/images/illust_vol2_step_sp.png" alt="ボランティア募集の流れ" class="img_responsive"></div>
                </div>
            </div>
            
            <div class="container tight">
                
                <!-- sec02 -->
                <div class="section vol02 sec02">
                    <div class="box">
                        <div class="title"><img src="../../../../sass/themes/frontend/images/illust_vol2_step04.png" alt="step4"></div>
                        <div class="clearfix group">
                            <dl>
                                <dt><span class="num">❶</span><span>イベントボランティア</span>を<br>希望の場合</dt>
                                <dd>当センター登録の個人ボランティアへのメール案内、センター内掲示板、かわら版、ホームページ等での告知を行います。<br>
                                    ボランティアに関する問合せ先や申込先は原則、募集団体宛てとさせていただきます。
                                </dd>
                            </dl>
                            <dl>
                                <dt><span class="num">❷</span><span>継続型ボランティア</span>を<br>希望の場合</dt>
                                <dd>かわら版にて告知を行います。（毎月１日発行。個人ボランティアへメール送信をしています）<br>
                                ※活動申込みができるのは原則、当センターおよび市社会福祉協議会に登録のある個人ボランティアに限定しています。問合せ・連絡先は当センターとし、職員が仲介してお繋ぎいたします。
                                </dd>
                            </dl>
                            <dl>
                                <dt><span class="num">❸</span><span>芸能団体の出演依頼</span></dt>
                                <dd>センターの所有する“ステージボランティア”情報の中から出演希望団体を選定いただき、職員が団体へお繋ぎいたします。<br>
                                ※即日対応できない場合がございますのでご了承ください。<br>
                                ※団体によっては１ヶ月前、２ヶ月前でないと対応できない団体もございます。早めのお申込をおすすめいたします。
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                
                <!-- sec03 -->
                <div class="section vol02 sec03">
                    <div class="h4 subp"><h4>ボランティア募集の際の注意点</h4></div>
                    <ul>
                        <li>公益活動に関するボランティア募集を受け付けます。</li>
                        <li>労働と判断される内容に関してはお断りする場合がございます。（※駐車場の警備、物販の販売員など）</li>
                        <li>営業活動や宗教等に関する勧誘は禁止します。</li>
                        <li>ボランティアのプライバシーは厳守してください。取得した個人名・連絡先等の情報漏洩にはご注意ください。</li>
                        <li>ボランティアのプライベートを尊重してください。過度なボランティアの押し付け、スケジュールの詰め込みなど無いようご配慮をお願いします。</li>
                    </ul>
                </div>
                
                <!-- sec04 -->
                <div class="section vol02 sec04">
                    <div class="h4 subp"><h4>ボランティアを募集される皆様へおねがい</h4></div>
                    <p>ボランティアは雇用関係にないとはいえ、責任や自主性を尊重しなければなりません。互いに思いやり、より良い関係のもと活動を行いましょう。
                        <br>また、無償の奉仕活動がボランティアの定義とされていますが、「交通費」「お弁当」などを支給することで活動の継続性や満足度の向上にもつながります。強制ではありませんが、必要経費の実費支給（現物支給）を推奨します。</p>
                </div>
                
            </div>
            
        </div>

    </div>
</template>