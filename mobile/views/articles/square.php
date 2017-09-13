<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = $this->title;
?>
<link type="text/css" rel="stylesheet" href="../bdt/css/edit.min.css">
<link type="text/css" rel="stylesheet" href="../bdt/css/swiper-3.4.0.min.css">
<!--<script type="text/javascript" src="../bdt/js/foucs_util.js"></script>-->
<script type="text/javascript" src="../bdt/js/square.js"></script>
<script type="text/javascript" src="../bdt/js/commonArticList.js"></script>
<script type="text/javascript" src="../bdt/js/commentListInPostlist.js"></script>

<body>
<div id="container" class="container bg-grey">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white fc-black b-b-grey scrollhd">
            <div class="statebar">
                <a class="nav-act left-act" onclick="goBack();">
                    <img src="../bdt/images/nav_icon_back1.png"></a>
                <h2 class="fs34">发现</h2>
                <a class="shaixuan fs28 fc-black" id="shaixuanId">
                    <span id="shaixuantext">筛选</span>
                    <img src="../bdt/images/shaixuan.png"></a>
            </div>

            <div class="shaixuan-list bc-grey bg-white fs28" id="shaixuanListId" style="display:none;">
                <a class="shaixuan-item fc-black"><img src="../bdt/images/shaixuan_all.png">全部</a>
                <a class="shaixuan-item fc-black"><img src="../bdt/images/shaixuan_hot.png">最热</a>
                <a class="shaixuan-item fc-black"><img src="../bdt/images/shaixuan_topic.png">话题</a>
                <a class="shaixuan-item fc-black"><img src="../bdt/images/shaixuan_zixun.png">资讯</a>
                <a class="shaixuan-item fc-black"><img src="../bdt/images/shaixuan_jingxuan.png">精选</a>
            </div>
        </div>

        <!--页面主体-->
        <div class="page__bd scrollbd">
            <div class="top-space1"></div>

            <!--发现列表-->
            <div class="found-friends-con" id="squareList">
                <a id="downloadMoreData" class="appui_loadmore fs24 fc-greyabc">拼命加载中<i class="loadmore"></i></a></div>
            <div class="bottom-space4"></div>
        </div>
        <div class="page__fd bg-white fs22 bc-grey scrollfdt" id="footer_tabbar">
            <?=$this->render('/_footer')?>
        </div>
    </div>
</div>


<a class="publish-btn publish-btn-square bg-white " id="sendMessage">
    <img src="../bdt/images/publish_pen.png">
</a>

<!--//发布弹出框-->
<div class="publish-type" style="display:none">
    <div class="publish-type-list fs32 fc-black type4">
        <a href="/circle/circle_file_release.html?from=index&publishtype=fatie"><i>
                <img src="../bdt/images/message_pic.jpg"></i>
            <span class="fc-black">发帖</span></a>
        <a href="/articles/article_edit.html?from=index&publishtype=article">
            <i><img src="../bdt/images/message_article.jpg"></i>
            <span class="fc-black">文章</span></a>
        <a href="/pockets/red_packets.html?from=index&publishtype=redpack">
            <i><img src="../bdt/images/message_packet.jpg"></i>
            <span class="fc-black">红包</span></a>
        <a href="/questions/start_ask.html?from=index&publishtype=ask" >
            <i><img src="../bdt/images/message_qanda.jpg"></i>
            <span class="fc-black">提问</span></a>
    </div>
    <a class="close-publish-btn bg-white" id="closePubBtn">
        <img src="../bdt/images/publish_red.png"></a>
</div>

<div class="video_dialog" style="display:none;">
    <div class="appui-mask"></div>
    <div class="appui-video-con">
        <video class="appui-video" id="myVideo" style="display:none" controls="">
            <source src="" type="video/mp4">
        </video>
    </div>
</div>

<audio id="audio-mc" preload="preload" src=""></audio>


</body>
