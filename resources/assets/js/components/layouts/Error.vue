<template>
<div>
    <head>
        <meta charset="UTF-8">
        <title>宮崎市民活動センター</title>
        <meta name="Author" content=""/>
        <!-- viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
      
    </head>
    <body>
        <div class="container">
            <div class="title">ページが見つかりませんでした。</div>
            <p class="disc">申し訳ありません、お探しのページはURLが変更されたか<br>ページが削除された可能性があります。</p>
            <p class="btn"><a href="http://www.miyazaki-npocenter.jp/">ホームへ戻る</a></p>
        </div>
        <address>Copyright(C)Miyazaki NPO Center All Rights Reserved.</address>
    </body>
</div>
</template>

  <style>
    *{
        margin: 0 ;
        padding: 0 ;
    }
    html{
        font-size: 62.5% ;
        height: 100% ;
    }
    body{
        font-size: 1.5rem ;
        color: #5f4533 ;
        position: relative ;
        font-family: YuGothic , "游ゴシック", "Yu Gothic Medium" , "游ゴシック体", 'Hiragino Kaku Gothic Pro', Meiryo , sans-serif ;
        font-weight: bold ;
        height: 100% ;
    }
    body:before{
        position: absolute ;
        height: 10px ;
        width: 100% ;
        top: 0 ;
        content: " " ;
        background: url(/images/bg_blue.png) repeat center ;
    }
    .container{
        background: url(/images/bg_404.jpg) no-repeat center 100px ;
        width: 100% ;
        max-width: 1000px ;
        margin-left: auto ;
        margin-right: auto ;
        padding-top: 270px ;
    }
    .title{
        font-size: 1.7em ;
        margin-bottom: 30px ;
        text-align: center ;
    }
    p.disc{
        text-align: center ;
        margin-bottom: 20px ;
    }
    p.btn{
        text-align: center ;
        margin-bottom: 20px ;
    }
    p.btn a{
        background: url(/images/bg_blue.png) repeat center ;
        border-radius: 25px ;
        box-shadow: 2px 3px 0px rgba(0, 0, 0, 0.13) ;
        color: #fff ;
        padding: 15px 30px ;
        display: inline-block ;
        font-size: 1.4rem ;
        line-height: 1em ;
        letter-spacing: 0 ;
        text-decoration: none ;
    }
    address{
        color: #1b89e7 ;
        text-align: center ;
        width: 100% ;
        padding: 15px 0 ;
    }
    @media (max-width: 991px){
        body{
            font-size: 1.3rem ;
            }
        .container{
            background-size: 110% ;
            padding-top: 220px ;
        }
    }
</style>
