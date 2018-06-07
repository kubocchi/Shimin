<template>
    <div>
        <html lang="ja">
            <div class="masthead">
                <div class="header_logo">
                    <h1>
                        <a href="index.html">
                            <img src="../../sass/themes/msikatsu_admin/img/logo.png" class="img-fluid">
                        </a>
                    </h1>
                </div>
                <nav class="navbar navbar-expand-md navbar-light bg-light rounded mb-3">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav text-md-center nav-justified">
                            <li class="nav-item">
                                <a class="nav-link" href="index.html">
                                    <span>
                                        <i class="fas fa-home"></i>
                                    </span> TOP</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span>
                                        <i class="fas fa-dove"></i>
                                    </span> 情報発信</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown01">
                                    <a class="dropdown-item" href="pages/1-1_01list.html">宮崎市民可動センターからのお知らせ</a>
                                    <a class="dropdown-item" href="pages/1-2_01list.html">登録団体、行政等からのお知らせ</a>
                                    <a class="dropdown-item" href="pages/1-3_01list.html">助成金情報</a>
                                    <a class="dropdown-item" href="pages/1-4_01list.html">災害ボランティア情報</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown02" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span>
                                        <i class="fas fa-file"></i>
                                    </span> ファイル公開</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown02">
                                    <a class="dropdown-item" href="#">各種様式</a>
                                    <a class="dropdown-item" href="#">事業報告</a>
                                    <a class="dropdown-item" href="#">夢交差点</a>
                                    <a class="dropdown-item" href="#">かわら版</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span>
                                        <i class="fas fa-feather"></i>
                                    </span> 団体情報登録</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span>
                                        <i class="fas fa-power-off"></i>
                                    </span> ログアウト</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <span class="navbar-text" style=" color:#FFF; font-weight:bold;">loginuser name</span>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="container">
                <h4>管理者メニュー</h4>
                <hr>
                <div class="row mt-4">
                    <div class="col-md-4 topmidashi">
                        <h5>情報発信</h5>
                    </div>
                    <div class="col-md-8">
                        <h5><span><i class="fas fa-dove"></i></span> お知らせの登録</h5>
                        <div class="row">
                            <div class="col-md-6"> <a class="btn btn-primary btn-lg btn-block topmenu" href="pages/1-1_01list.html" role="button">宮崎市民活動センターからのお知らせ</a> </div>
                            <div class="col-md-6"> <a class="btn btn-primary btn-lg btn-block topmenu" href="pages/1-2_01list.html" role="button">登録団体、行政などからのお知らせ</a> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> <a class="btn btn-primary btn-lg btn-block topmenu" href="pages/1-3_01list.html" role="button">助成金情報</a> </div>
                            <div class="col-md-6"> <a class="btn btn-primary btn-lg btn-block topmenu" href="pages/1-4_01list.html" role="button">災害ボランティア情報</a> </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4 topmidashi">
                        <h5>ファイル公開</h5>
                    </div>
                    <div class="col-md-8">
                        <h5><span><i class="fas fa-file"></i></span> 各種様式ファイルの登録</h5>
                        <div class="row">
                            <div class="col-md-6"> <a class="btn btn-primary btn-lg btn-block topmenu" href="#" role="button">各種様式</a> </div>
                            <div class="col-md-6"> <a class="btn btn-primary btn-lg btn-block topmenu" href="#" role="button">事業報告</a> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> <a class="btn btn-primary btn-lg btn-block topmenu" href="#" role="button">夢交差点</a> </div>
                            <div class="col-md-6"> <a class="btn btn-primary btn-lg btn-block topmenu" href="#" role="button">かわら版</a> </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4 topmidashi">
                        <h5>団体情報登録</h5>
                    </div>
                    <div class="col-md-8">
                        <h5><span><i class="fas fa-feather"></i></span> 団体情報の登録</h5>
                        <div class="row">
                            <div class="col-md-6"> <a class="btn btn-primary btn-lg btn-block topmenu" href="#" role="button">団体情報の登録</a> </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /container --> 

            <!-- Site footer -->
            <footer class="footer fixed-bottom">
                <address>
                    Copyright © Miyazaki NPO Center All Rights Reserved.
                </address>
            </footer>
        </html>
    </div>
</template>

<script>
    export default 
    {
        mounted() 
        {
            console.log('Component mounted.')
        },
        components: 
        {

        }
    }
</script>