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
                    <h2>ボランティアをしたい</h2>
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
                    <li>ボランティアをしたい</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div id="volunteer" class="maincontents">
            
            <!-- sec01 -->
            <div class="section vol01 sec01">
                <div class="container clearfix">
                    <div class="left">
                        <div class="h3"><h3><img src="../../../../sass/themes/frontend/images/h3_vol01.png" class="img_responsive"></h3></div>
                        <p>宮崎市民活動センターにて<span class="color_b">個人ボランティアの登録</span>が必要になります。<br>
                            簡単な手続き後、ボランティア先をコーディネーターと一緒に探し、<br>
                            希望する団体へおつなぎします。登録は無料です。<br>
                            また登録することにより、新しいボランティア募集の情報をメールで受け取ることができます。
                        </p>
                        <p class="attention">※単発型のイベントボランティアに関してはセンター登録は不要となりますので直接<a href="#!">お問合せ</a>先へご連絡ください。</p>
                        <p class="btn_blue subp">
                            <router-link :to="{ name: 'various' }">
                                <span>申請書ダウンロードページへ</span>
                            </router-link>
                        </p>
                    </div>
                    <div class="right">
                        <p class="img"><img src="../../../../sass/themes/frontend/images/flow_vol.png" alt="ボランティア募集の流れ" class="img_responsive"></p>
                    </div>
                </div>
            </div>
            
            <div class="container tight">
                
                <!-- sec02 -->
                <div class="section vol01 sec02">
                    <div class="title"><img src="../../../../sass/themes/frontend/images/balloon_vol01.png" alt="ボランティアってなに？"></div>
                    <div class="body clearfix">
                        <p class="img"><img src="../../../../sass/themes/frontend/images/illust_whatvol.png" alt="ボランティア"></p>
                        <p class="text">そもそも「ボランティア」には「志願者・自ら進んでする人」の意思があります。<br>つまり、ボランティアは人から言われてするものではなく、自らの意思で自主的な活動なのです。</p>
                    </div>
                </div>
                
                <!-- sec03 -->
                <div class="section vol01 sec03">
                    <div class="h4 subp"><h4>ボランティアの4原則</h4></div>
                    <div class="box">
                        <div class="title"><img src="../../../../sass/themes/frontend/images/title_4gensoku.png" alt="一般にボランティアには4原則があります。" class="img_responsive"></div>
                        <div class="body">
                            <div class="left">
                                <dl>
                                    <dt>自発性</dt>
                                    <dd>自ら進んですること。他から強制されてするものではありません。</dd>
                                </dl>
                                <dl>
                                    <dt>社会性</dt>
                                    <dd>市民参加によって社会をよりよくしていこうとする活動です。</dd>
                                </dl>
                            </div>
                            <div class="center">
                                <img src="../../../../sass/themes/frontend/images/illust_4gensoku.png" alt="4原則" class="img_responsive">
                            </div>
                            <div class="right">
                                <dl>
                                    <dt>無償性</dt>
                                    <dd>見返りを求めての活動ではないことです。</dd>
                                </dl>
                                <dl>
                                    <dt>先駆性</dt>
                                    <dd>社会における問題点を自ら見つけ、解決していくことです。</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- sec04 -->
                <div class="section vol01 sec04">
                    <div class="h4 subp"><h4>ボランティア活動をする上で気をつけたいこと</h4></div>
                    <div class="box clearfix">
                        <div class="col">
                            <p>活動対象者の気持ちを大切にしましょう。</p>
                            <p>プライバシーを守りましょう。</p>
                            <p>約束を守りましょう。</p>
                            <p>心配なことは相談しましょう。</p>
                        </div>
                        <div  class="col">
                            <p>気付いたことを話しましょう。</p>
                            <p>無理なく継続できる活動をしましょう。</p>
                            <p>ボランティア保険の加入をおすすめします。<span>宮崎市民活動センターでは加入不可(<a href="http://www.my-shakyo.jp/" target="_blank">社会福祉協議会</a>にてお申込みください。)</span></p>
                        </div>
                    </div>
                </div>
                
                <!-- sec05 -->
                <div class="section vol01 sec05">
                    <div class="h4 subp"><h4>どんなボランティアがあるの？</h4></div>
                    <div class="title">内容は多種多様。<br>好きなことや興味のあることから見つけていくのもおすすめです</div>
                    <ul class="voltype">
                        <li><img src="../../../../sass/themes/frontend/images/img_vol_type01.png"></li>
                        <li><img src="../../../../sass/themes/frontend/images/img_vol_type02.png"></li>
                        <li><img src="../../../../sass/themes/frontend/images/img_vol_type03.png"></li>
                        <li><img src="../../../../sass/themes/frontend/images/img_vol_type04.png"></li>
                        <li><img src="../../../../sass/themes/frontend/images/img_vol_type05.png"></li>
                        <li><img src="../../../../sass/themes/frontend/images/img_vol_type06.png"></li>
                        <li><img src="../../../../sass/themes/frontend/images/img_vol_type07.png"></li>
                    </ul>
                    <p class="btn_blue subp">
                        <router-link :to="{ name: 'noticeIndex' }">
                            <span>ボランティア募集一覧へ</span>
                        </router-link>
                    </p>
                    <div class="copy"><img src="../../../../sass/themes/frontend/images/text_vol01_copy.png" class="img_responsive"></div>
                </div>
                
            </div>
            
        </div>

    </div>
</template>