<link type="text/css" rel="stylesheet" href="../bdt/css/professList.css">
<script type="text/javascript" src="../bdt/js/commonExpert.js"></script>
<script type="text/javascript" src="../bdt/js/found_expert.js"></script>
<body class="bg-grey">
<div id="container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd page__hd-search fc-black bg-white scrollhd" id="topBigDiv">
            <!--列表页用的搜索-问答列表-行家列表-楼盘列表-->
            <div class="search-head b-b-grey">
                <a class="left-icon" href="index.html">
                    <img src="../bdt/images/back80.png">
                    <span class="fs28 fc-white"></span>
                </a>
                <div class="search-module" id="searchID">
                    <p class="fs28 fc-greyabc">搜索行家</p>
                </div>
                <a class="right-icon" id="searchID1">
                    <img src="../bdt/images/search80.png">
                    <span class="fs28 fc-white"></span>
                </a>
            </div>

            <div id="smallNav" class="expert" style="top: 2.55rem; height: 2.5rem;">
                <div>
                    <p>
                        <span class="fs28 fc-grey666 active" onclick="judgeIndex1(0,0,'推荐',1)">推荐</span>
                        <?php foreach($type as $k=>$v):?>
                            <span class="fs28 fc-grey666 <?php if($k==0):?><?php endif;?>" onclick="judgeIndex1(<?=$v['id'];?>,<?=$v['id'];?>,'<?=$v['name']?>',1)"><?=$v['name']?></span>
                        <?php endforeach;?>
                    </p>
                    <img id="showMoreBtn" src="../bdt/images/nav_more.png">
                </div>

<!--                <div id="openTheNav" style="display: none;">-->
<!--                    <p><span class="fs28 fc-grey666 active" onclick="judgeIndex1(0,1210,'推荐',1)">推荐</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(1,1212,'火热',1)">火热</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(2,1213,'新晋',1)">新晋</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(3,1214,'杭州',1)">杭州</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(4,1215,'上海',1)">上海</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(5,1216,'北京',1)">北京</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(6,1217,'海外',1)">海外</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(7,1219,'深圳',1)">深圳</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(8,1220,'三亚',1)">三亚</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex1(9,1221,'其他',1)">其他</span>-->
<!--                    </p>-->
<!--                    <p><span class="fs28 fc-grey666" onclick="judgeIndex(0,1201,'投资',2)">投资</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex(1,1202,'政策',2)">政策</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex(2,1203,'户型',2)">户型</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex(3,1204,'贷款',2)">贷款</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex(4,1205,'学区',2)">学区</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex(5,1206,'法律',2)">法律</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex(6,1207,'装修',2)">装修</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex(7,1208,'验房',2)">验房</span>-->
<!--                        <span class="fs28 fc-grey666" onclick="judgeIndex(8,1209,'更多',2)">更多</span>-->
<!--                    </p>-->
<!--                </div>-->
            </div>

<!--            <div class="page__hd-tips bg-greyf1"  id="coupon_count_div">-->
<!--                <p class="fs24 fc-grey999">您有<span class="fc-black fs28" id="coupon_count_id">1</span>张围观券，本次收听免费！</p>-->
<!--                <a class="bg-white" id="coupon_count_close"><img src="../bdt/images/nav_icon_close1.png"></a>-->
<!--            </div>-->
        </div>
        <!--页面主体-->
        <div class="page__bd scrollbd" id="page__bd" style="padding-top: 2.5rem;">
            <!--占位空间-->
            <!--无优惠券-->
            <div id="noneCouponSpace" class="top-space1 notop" style="display:block;"></div>
            <!--有优惠券-->
            <div id="hasCouponSpace" class="top-space6 notop" style="display:none;"></div>
            <div id="professList" class="professList">
                <a id="downloadMoreData" class="appui_loadmore fs32 fc-greyabc">拼命加载中<i class="loadmore"></i></a>
            </div>
            <!--占位空间-->
            <div class="bottom-space4"></div>
        </div>

        <!-- footer -->
        <div class="page__fd bg-white fs22 bc-grey scrollfdt" >
            <div class="tab-con">
                <?=$this->render('/_footer')?>
            </div>
        </div>
        <!-- footer -->
    </div>
</div>


</body>