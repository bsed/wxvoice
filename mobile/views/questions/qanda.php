<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript" src="../bdt/js/searchCommon.js"></script>
<link type="text/css" rel="stylesheet" href="../bdt/css/wf_house_new.css">
<script type="text/javascript" src="../bdt/js/qanda.js"></script>
<script type="text/javascript" src="../bdt/js/commonQaList.js"></script>
<body>
<div class="new_q_and_a" id="container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd page__hd-search bg-white fc-balck b-b-grey scrollhd" id="topBigDiv">
            <!--列表页用的搜索-问答列表-行家列表-楼盘列表-->
            <div class="search-head b-b-grey">
                <div class="search-module noleftbtn" id="searchID">
                    <p class="fs28 fc-greyabc">搜索问答</p>
                </div>
                <a class="right-icon" id="searchID1">
                    <img src="../bdt/images/search80.png">
                    <span class="fs28 fc-white"></span>
                </a>
            </div>
            <!-- 筛选 -->
            <div id="smallNav" style="height: 2.5rem; top: 2.55rem;">
                <div>
                    <p>
                        <span class="fs28 fc-grey666 active" onclick="judgeIndex1(0,0,'推荐',1)">推荐</span>
                        <?php foreach($type as $k=>$v):?>
                        <span class="fs28 fc-grey666 <?php if($k==0):?><?php endif;?>" onclick="judgeIndex1(<?=$v['id'];?>,<?=$v['id'];?>,'<?=$v['name']?>',1)">
                            <?=$v['name']?></span>
                        <?php endforeach;?>
                    </p>
                    <img id="showMoreBtn" src="../bdt/images/nav_more.png" >
                </div>

<!--                <div id="openTheNav" style="display:none;">-->
<!--                    <p>-->
<!--                        <span class="fs28 fc-grey666 active" onclick="judgeIndex1(0,1146,'推荐',1)">推荐</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(1,10005,'精选',1)">精选</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(2,1140,'免费',1)">免费</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(3,1141,'最新',1)">最新</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(11,1154,'其他',1)">其他</span>-->
<!--                    </p>-->
<!---->
<!--                    <p>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex(0,1155,'限购',2)">限购</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex(1,1131,'大势',2)">大势</span>-->
<!--                    </p>-->
<!---->
<!--                </div>-->

            </div>
            <!-- 筛选 -->

        </div>


        <div class="page__bd scrollbd" style="padding-top: 5rem;">
            <!--无优惠券-->
            <div id="noneCouponSpace" class="top-space1 notop" style="display:none;"></div>
            <!--有优惠券-->
            <div id="hasCouponSpace" class="top-space1 notop" style="display:block;"></div>
            <div id="professList" class="professList"></div>


            <!--问答推荐-->
        <div class="qa_recommend" id="questions">
            <a id="downloadMoreData" class="appui_loadmore fs32 fc-greyabc">拼命加载中<i class="loadmore"></i></a>
    </div>
    <!--控件-->
            <div class="page__fd bg-white fs22 bc-grey scrollfdt" id="footer_tabbar">
                <div class="tab-con">
                    <?=$this->render('/_footer')?>
                </div>

            </div>
            <!-- footer -->
    <audio id="audio-mc" style="display:none;" preload="preload" src=""></audio>
</div>

</body>
