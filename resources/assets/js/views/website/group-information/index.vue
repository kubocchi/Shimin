<template>
    <div>

        <!-- nav -->

        <div id="global_nav">
            <div class="navbar navbar-expand-lg">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></button>
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
                                <li><a href="../infomation/">市民活動センターとは</a></li>
                                <li><a href="../floormap/">施設のご案内</a></li>
                                <li><a href="../format/">各種書式</a></li>
                            </ul>
                        </li>
                        <li class="open">
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">市民活動団体</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="http://www.city.miyazaki.miyazaki.jp/life/activities/civic_action/307.html" target="_blank">市民活動団体とは</a></li>
                                <li><a href="../oraganization/regist.html">登録について</a></li>
                                <li><a href="../oraganization/">団体を探したい</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">ボランティア</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="../volunteer/">ボランティアをしたい</a></li>
                                <li><a href="../volunteer/recruitment.html">ボランティアを<br>募集したい</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="toggle">
                                <span class="i"></span>
                                <span class="t">Q & A</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="../question/">センターについて</a></li>
                                <li><a href="http://www.city.miyazaki.miyazaki.jp/life/activities/civic_action/" target="_blank">市民活動について</a></li>
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
                    <li><a href="../index.html">HOME</a></li>
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
                                        <label class="checkbox individual"><input type="radio"><span class="icon"></span>個人</label>
                                        <label class="checkbox oraganization"><input type="radio"><span class="icon"></span>団体</label>
                                    </dd>
                                </dl>
                                <!-- cate -->
                                <dl class="input-group">
                                    <dt>活動分野</dt>
                                    <dd>
                                        <select>
                                            <option>全て</option>  <!-- all -->
                                            <option>保健・医療</option> <!-- type01 -->
                                            <option>高齢者福祉</option> <!-- type02 -->
                                            <option>障がい者福祉</option> <!-- type03 -->
                                            <option>児童福祉</option> <!-- type04 -->
                                            <option>社会教育</option> <!-- type05 -->
                                            <option>まちづくり</option> <!-- type06 -->
                                            <option>観光</option> <!-- type07 -->
                                            <option>農山漁村</option> <!-- type08 -->
                                            <option>文化芸術</option> <!-- type09 -->
                                            <option>環境保全</option> <!-- type10 -->
                                            <option>災害救助</option> <!-- type11 -->
                                            <option>地域安全</option> <!-- type12 -->
                                            <option>人権・平和</option> <!-- type13 -->
                                            <option>国際協力</option> <!-- type14 -->
                                            <option>男女共同</option> <!-- type15 -->
                                            <option>子共教育</option> <!-- type16 -->
                                            <option>科学技術</option> <!-- type17 -->
                                            <option>情報社会</option> <!-- type18 -->
                                            <option>経済活性</option> <!-- type19 -->
                                            <option>職業・雇用</option> <!-- type20 -->
                                            <option>消費者保護</option> <!-- type21 -->
                                            <option>NPO支援</option> <!-- type22 -->
                                            <option>その他</option> <!-- type23 -->
                                        </select>
                                    </dd>
                                </dl>
                                <!-- free word -->
                                <dl class="input-group">
                                    <dt>キーワード</dt>
                                    <dd>
                                        <input type="text" placeholder="キーワードを入力...">
                                    </dd>
                                </dl>
                                <!-- enter -->
                                <div class="btn_search">
                                    <button>検 索</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- mini nav -->
                        <div class="mininav">
                            <ul>
                                <li><a href="../oraganization/regist.html">市民活動団体とは？</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- oraganization list -->
                <div class="oraganization_list">
                    
                    <div class="oraganization_body">
                        <div class="item">
                            <a href="#">NPO だっことおんぶのわ　みやざき</a>
                        </div>
                        <div class="item">
                            <a href="#">アートオブキャッツ</a>
                        </div>
                        <div class="item">
                            <a href="#">愛護四季の会</a>
                        </div>
                        <div class="item">
                            <a href="#">愛と絆を結ぶ「三輪車」</a>
                        </div>
                        <div class="item">
                            <a href="#">檍地域まちづくり推進委員会</a>
                        </div>
                        <div class="item">
                            <a href="#">青島鬼の洗濯岩トライアクアスロン実行委員会</a>
                        </div>
                        <div class="item">
                            <a href="#">青島地区ボランティアグループ</a>
                        </div>
                        <div class="item">
                            <a href="#">青空クラブ</a>
                        </div>
                        <div class="item">
                            <a href="#">青葉むつみ会</a>
                        </div>
                        <div class="item">
                            <a href="#">青柳川を守る会</a>
                        </div>
                        <div class="item">
                            <a href="#">アオウミガメの産卵地を育てる会</a>
                        </div>
                        <div class="item">
                            <a href="#">あかえ青パト隊</a>
                        </div>
                        <div class="item">
                            <a href="#">赤江北老人給食くすのき会</a>
                        </div>
                        <div class="item">
                            <a href="#">赤江東中学校はげまし隊</a>
                        </div>
                        <div class="item">
                            <a href="#">赤江ふるさと塾</a>
                        </div>
                        <div class="item">
                            <a href="#">Akaeママパパ隊</a>
                        </div>
                        <div class="item">
                            <a href="#">赤江未来の会</a>
                        </div>
                        <div class="item">
                            <a href="#">明るい郷土をつくる会</a>
                        </div>
                        <div class="item">
                            <a href="#">NPO だっことおんぶのわ　みやざき</a>
                        </div>
                        <div class="item">
                            <a href="#">アートオブキャッツ</a>
                        </div>
                        <div class="item">
                            <a href="#">愛護四季の会</a>
                        </div>
                        <div class="item">
                            <a href="#">愛と絆を結ぶ「三輪車」</a>
                        </div>
                        <div class="item">
                            <a href="#">檍地域まちづくり推進委員会</a>
                        </div>
                        <div class="item">
                            <a href="#">青島鬼の洗濯岩トライアクアスロン実行委員会</a>
                        </div>
                        <div class="item">
                            <a href="#">青島地区ボランティアグループ</a>
                        </div>
                        <div class="item">
                            <a href="#">青空クラブ</a>
                        </div>
                        <div class="item">
                            <a href="#">青葉むつみ会</a>
                        </div>
                        <div class="item">
                            <a href="#">青柳川を守る会</a>
                        </div>
                        <div class="item">
                            <a href="#">アオウミガメの産卵地を育てる会</a>
                        </div>
                        <div class="item">
                            <a href="#">あかえ青パト隊</a>
                        </div>
                    </div>
                    
                    <!-- pagenation -->
                    <div class="pagenation">
                        <nav class="pager">
                            <ul>
                                <li class="previous"><a href="">前のページ</a></li>
                                <li class="active"><a href="">1</a></li>
                                <li><a href="">2</a></li>
                                <li><a href="">3</a></li>
                                <li><a href="">4</a></li>
                                <li><a href="">5</a></li>
                                <li class="next"><a href="">次のページ</a></li>
                            </ul>
                        </nav>
                    </div>
                
                </div>
            </div>
        </div>


    </div>
</template>