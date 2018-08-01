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
                        <li class="open">
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

        <div id="pagetitle" class="question">
            <div class="container">
                <div class="h2">
                    <h2>Q & A <span class="s">センターについて</span></h2>
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
                    <li>Q&A センターについて</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div id="question" class="maincontents">
            
            <div class="question container">
                <div class="accordion" id="accordion" role="tablist">

                    <!-- 01 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q01" aria-controls="q01">
                                <span>01.</span>宮崎市民活動センターは、だれでも利用できますか？
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q01">
                            <div class="card-body">
                                <p class="l">どなたでも利用できるスペースとして交流サロンがあります。※予約は不要です</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 02 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q02" aria-controls="q02">
                                <span>02.</span>センターの開館時間、閉館日等は？
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q02">
                            <div class="card-body">
                                <p class="l">センターの開館時間は、午前9時で、月曜から土曜までは２２時閉館、日曜は１８時閉館です。</p>
                                <p class="s">休館は、宮崎市民プラザの保守点検日（年４回）、年末年始（１２月２９日～１月３日）および年数回の臨時休館日（ホームぺージ・facebook等で広報）</p>
                            </div>
                        </div>
                    </div>

                    <!-- 03 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q03" aria-controls="q03">
                                <span>03.</span>利用に際してのルールあるいは注意することは？
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q03">
                            <div class="card-body">
                                <p class="l">他の利用者の迷惑になる行為（大声、携帯電話、子どもの走り回りその他）はお控えください。</p>
                                <p class="s">センター利用に際して発生したごみは必ず全てお持ち帰りください。</p>
                            </div>
                        </div>
                    </div>

                    <!-- 04 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q04" aria-controls="q04">
                                <span>04.</span>打ち合わせができるスペースはありますか？
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q04">
                            <div class="card-body">
                                <p class="l">大会議コーナー、中A会議コーナー、中B会議コーナー、小A会議コーナー、小B会議コーナーの５つがあります。</p>
                                <p class="s">※登録団体のみ利用が可能</p>
                                <p class="link"><router-link :to="{ name: 'floormap' }">センター施設の利用方法</router-link></p>
                            </div>
                        </div>
                    </div>

                    <!-- 05 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q05" aria-controls="q05">
                                <span>05.</span>会議で使う資料やイベントのチラシを印刷したい
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q05">
                            <div class="card-body">
                                <p class="l">印刷機、コピー機、紙折り機、裁断機、丁合機、ラミネート機などがあります。</p>
                                <p class="s">※登録団体のみ利用が可能</p>
                                <p class="link"><router-link :to="{ name: 'floormap' }">センター施設の利用方法</router-link></p>
                            </div>
                        </div>
                    </div>

                    <!-- 06 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q06" aria-controls="q06">
                                <span>06.</span>パソコンはありますか？
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q06">
                            <div class="card-body">
                                <p class="l">３台設置してあります。プリントアウト（有料）も可能です。</p>
                                <p class="s">※ダウンロード、ウェブメールの閲覧、SNSの利用などは禁止です。<br>※登録団体のみ利用が可能</p>
                                <p class="link"><router-link :to="{ name: 'floormap' }">センター施設の利用方法</router-link></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 07 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q07" aria-controls="q07">
                                <span>07.</span>文房具等の貸し出しは？
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q07">
                            <div class="card-body">
                                <p class="l">センターでは原則、文房具の貸し出しは行っておりません。</p>
                                <p class="s">ステイプラー（ホッチキス）の針、セロファンテープなどの消耗品は、大量に使われる場合は、各自でご用意ください。ステイプラー（針なし）、テープ台（テープなし）などはお貸しすることができます。</p>
                            </div>
                        </div>
                    </div>

                    <!-- 08 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q08" aria-controls="q08">
                                <span>08.</span>センターで借りられる備品は？
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q08">
                            <div class="card-body">
                                <p class="l">プロジェクター、スクリーン、レザーポインター、腕章、名札、その他がありいずれも無料で借りられます。</p>
                            </div>
                        </div>
                    </div>

                    <!-- 09 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q09" aria-controls="q09">
                                <span>09.</span>イベントで使う横断幕の制作をお願いしたい
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q09">
                            <div class="card-body">
                                <p class="l">ポスタープリント（横断幕、懸垂幕、式次第）の制作を受注しています。</p>
                                <p class="s">※感熱紙による制作です。<br>※受け取り希望日の1週間前までに申し込んでください。</p>
                            </div>
                        </div>
                    </div>

                    <!-- 10 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q10" aria-controls="q10">
                                <span>10.</span>ロッカーやメールボックスの利用は？
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q10">
                            <div class="card-body">
                                <p class="l">ロッカーは有料で、メールボックスは無料で利用できます。</p>
                                <p class="link"><router-link :to="{ name: 'floormap' }">センター施設の利用方法</router-link></p>
                            </div>
                        </div>
                    </div>

                    <!-- 11 -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <a class="text-body collapsed" data-toggle="collapse" role="button" href="#q11" aria-controls="q11">
                                <span>11.</span>領収証の発行については？
                            </a>
                        </div>
                        <div class="collapse" role="tabpanel" data-parent="#accordion" id="q11">
                            <div class="card-body">
                                <p class="l">登録団体あてに限り領収証を発行いたします。</p>
                                <p class="s"><a>印刷機、ポスタープリント、印刷用紙代等の領収証のあて名はセンター登録団体名での発行になります。</a></p>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>

            <!-- <div class="container comingsoon">
                <p class="top">申し訳ありません。こちらのページは現在準備中です。<br>掲載までもうしばらくお待ちください。</p>
                <div class="btn_blue subp">
                    <router-link :to="{ name: 'home' }">
                        <span>ホームへ戻る</span>
                    </router-link>
                </div>
            </div> -->
            
        </div>

    </div>
</template>