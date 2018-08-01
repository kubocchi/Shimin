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
                    <h2>施設のご案内</h2>
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
                    <li>施設のご案内</li>
                </ol>
            </div>
        </div>

        <!-- main contents -->

        <div class="maincontents">
            <div class="container">
                
                <!-- illust -->
                <div class="fl_mapillsut"><img class="img_responsive" src="../../../sass/themes/frontend/images/img_floormap.jpg" alt="施設のご案内"></div>
                
                <!-- floors -->
                <div class="fl_group">
                    
                    <!-- 会議コーナー -->
                    <div class="fl_col">
                        <div class="name">会議コーナー</div>
                        <div class="text">団体の会議や打ち合わせなど、センターに登録されている団体の方はどなたでもご利用になれます。会議コーナーの使用時間は2時間以内です。予約せず当日来所された時に空いているコーナーがある場合は、そのコーナーをご利用いただけますが、できるだけ予約されることをお勧めいたします。会議室の予約は、2週間前から窓口・電話にて受付しています。<br><span class="r">ご利用にはセンター登録が必要です。</span></div>
                        <dl class="spl">
                            <dt>予約方法</dt>
                            <dd>直接来所…会議コーナー予約申込書に記入</dd>
                            <dd>電話予約…当センター職員が予約申込用紙に記入</dd>
                        </dl>
                    </div>
                    
                    <!-- ロッカー -->
                    <div class="fl_col">
                        <div class="name">ロッカー</div>
                        <div class="text">団体で保管しておきたい物品の置き場所にロッカーは便利です。活動に必要な印刷用紙、機材、参考図書、事 務用品等の保管場所としてご利用いただけます(施錠はできますが、貴重品の保管はご遠慮ください)。契約は1年間(4月～翌年3月)で毎年度末に次年度利 用のお申し込みを受け付けます。申し込み多数の場合は抽選になります。鍵はセンター事務室で保管します。<br><span class="r">ご利用にはセンター登録が必要です。</span></div>
                        <dl class="spl">
                            <dt>ご利用料金</dt>
                            <dd>大ロッカー…2,400円/年</dd>
                            <dd>小ロッカー…1,200円/年</dd>
                        </dl>
                    </div>
                    
                    <!-- 作業室 -->
                    <div class="fl_col">
                        <div class="name">作業室</div>
                        <div class="text">コピー機や印刷機、製本機を会報や催し物のチラシ作りに活用できます。<br>コピー機1台(有料)、 印刷機2台(有料)、 紙折機1台(無料)、 丁合機1台(無料)、 裁断機1台(無料) が設置されています。 ※用紙はご持参ください。購入希望の際はセンター事務室にお申込ください。<br>他に、ラミネーターやポスタープリンターもご利用いただけます。<br><span class="r">ご利用にはセンター登録が必要です。</span></div>
                        <dl class="spl">
                            <dt>ご利用料金</dt>
                            <dd>コピー機 …白黒>10円/枚 　カラー>B4まで…50円/枚　A3…60円/枚</dd>
                            <dd>印 刷 機 …製版>B4まで…50円/枚　A3…80円/枚印刷>B4まで…10円/10枚　A3…15円/10枚</dd>
                        </dl>
                    </div>
                    
                    <!-- パソコンコーナー -->
                    <div class="fl_col">
                        <div class="name">パソコンコーナー</div>
                        <div class="text">センターに登録されている団体の方はどなたでもご利用になれます。プリンタやスキャナが接続されています。書類作成や、インターネットでの情報収集などに お役立てください。(ただし、検索は市民活動やボランティア活動に関わることに限らせていただきます)。フロッピーディスクやCDなどの外部記憶媒体をご利用の際はウィルスチェックをさせていただきます。<br><span class="r">ご利用にはセンター登録が必要です。</span></div>
                    </div>
                    
                    <!-- センター事務局 -->
                    <div class="fl_col">
                        <div class="name">センター事務局</div>
                        <div class="text">コーディネーターが常駐し、ボランティアなど市民活動に関する相談、情報の提供、人材育成などを行っています。センター登録(市民活動団体・個人ボラン ティア)を受け付けています。センターへの登録申込みは、所定の申請書でお申込ください。登録書・申請書は、センター事務室に置いています。</div>
                    </div>
                    
                    <!-- メールボックス -->
                    <div class="fl_col">
                        <div class="name">メールボックス</div>
                        <div class="text">郵便物や案内状、ファックスの受け取りなど、情報の受け皿としてご利用ください。引き出し(幅27cm×奥行き36cm×深さ6cm)式で施錠できませんので、小包や書留郵便はお預かりできません。ご利用は無料です。<br><span class="r">ご利用にはセンター登録が必要です。</span></div>
                    </div>
                    
                    <!-- 給湯室 -->
                    <div class="fl_col">
                        <div class="name">給湯室</div>
                        <div class="text">給湯機器や茶器類は自由にお使いいただけます(お茶の葉などの消耗品はご持参ください)。使用上の注意事項を守って正しくお使いください。<br>センター利用の際に出たごみは、必ずお持ち帰り下さい。</div>
                    </div>
                    
                    <!-- 交流サロン -->
                    <div class="fl_col">
                        <div class="name">交流サロン</div>
                        <div class="text">個人や団体の交流の場としてご利用いただけます。市民の方はどなたでも自由にご利用いただけます。<br>受験勉強など市民活動とは関係にない利用はご遠慮ください。</div>
                    </div>

                    <!-- 備品の貸し出し -->
                    <div class="fl_col">
                        <div class="name">備品の貸し出し</div>
                        <div class="text">センターが所有する各種備品（プロジェクター、スクリーン、マイクセット、延長コード、レーザーポインター、名札、腕章など）を無料で貸し出します。貸出期間は１週間以内です。電話での仮予約ができます。<br>年度内の予約を常時受け付けていますが、数に限りがあるのでお早目の申し込みをお願いいたします。備品の詳細は、センターまでお問い合わせください。<br><span class="r">ご利用にはセンター登録が必要です。</span></div>
                    </div>

                    <!-- ポスタープリント -->
                    <div class="fl_col">
                        <div class="name">ポスタープリント<span class="s">（横断幕、懸垂幕、式次第等）</span></div>
                        <div class="text">イベントなどで使う横断幕等（感熱紙、黒の単色）の制作申込ができます。受け取り希望日の１週間前までの申し込みが必要です。窓口、メール、FAX等での申し込みが可能です<br>申し込み団体の活動に関係のない内容の制作の申し込みはできません。詳細は、センターまでお問い合わせください。<br><span class="r">ご利用にはセンター登録が必要です。</span></div>
                    </div>

                    <!-- 団体の情報発信 -->
                    <div class="fl_col">
                        <div class="name">団体の情報発信</div>
                        <div class="text">団体のPR、イベント等の情報をセンターの各種媒体で発信することができます。<br>チラシ・ポスター等の掲示・設置、情報誌（かわら版）への掲載、センターウェブサイトへの掲載、ラジオ番組（宮崎サンシャインエフエム「広がれ！市民活動」）への出演による広報などがあります。<br><span class="r">ご利用にはセンター登録が必要です。</span></div>
                    </div>
                    
                </div>
                    
            </div>
        </div>

    </div>
</template>
