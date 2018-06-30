<template>
    <div>
        <h4>管理者メニュー</h4>
        <hr>
        <div class="row mt-4">
            <div class="col-md-4 topmidashi">
                <h5>団体情報登録</h5>
            </div>
            <div class="col-md-8">
                <h5>
                    <span>
                        <i class="fas fa-feather"></i>
                    </span> 団体情報の登録</h5>
                <div class="row">
                    <div class="col-md-6">
                        <router-link :to="{ name: 'groupInformationList' }">
                            <button class="btn btn-primary btn-lg btn-block topmenu">団体情報の登録</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4 topmidashi">
                <h5>情報発信</h5>
            </div>
            <div class="col-md-8">
                <h5>
                    <span>
                        <i class="fas fa-dove"></i>
                    </span> お知らせの登録</h5>
                <div class="row">
                    <div class="col-md-6">
                        <router-link :to="{ name: 'activeCenterList' }">
                            <button class="btn btn-primary btn-lg btn-block topmenu">宮崎市民可動センターからのお知らせ</button>
                        </router-link>
                    </div>
                    <div class="col-md-6">
                         <router-link :to="{ name: 'noticeList' }">
                            <button class="btn btn-primary btn-lg btn-block topmenu">登録団体、行政などからのお知らせ</button>
                        </router-link>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                         <router-link :to="{ name: 'subsidyList' }">
                            <button class="btn btn-primary btn-lg btn-block topmenu">助成金情報</button>
                        </router-link>
                    </div>
                    <div class="col-md-6">
                         <router-link :to="{ name: 'disasterList' }">
                            <button class="btn btn-primary btn-lg btn-block topmenu">災害ボランティア情報</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4 topmidashi">
                <h5>ファイル公開</h5>
            </div>
            <div class="col-md-8">
                <h5>
                    <span>
                        <i class="fas fa-file"></i>
                    </span> 各種様式ファイルの登録</h5>
                <div class="row">
                    <div class="col-md-6">
                        <router-link :to="{ name: 'variousList' }">
                            <button class="btn btn-primary btn-lg btn-block topmenu">各種様式</button>
                        </router-link>
                    </div>
                    <div class="col-md-6">
                        <router-link :to="{ name: 'businessReportList' }">
                            <button class="btn btn-primary btn-lg btn-block topmenu">事業報告</button>
                        </router-link>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <router-link :to="{ name: 'dreamList' }">
                            <button class="btn btn-primary btn-lg btn-block topmenu">夢交差点</button>
                        </router-link>
                    </div>
                    <div class="col-md-6">
                        <router-link :to="{ name: 'kawarabiList' }">
                            <button class="btn btn-primary btn-lg btn-block topmenu">かわら版</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>