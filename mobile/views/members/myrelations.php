<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<link type="text/css" rel="stylesheet" href="../bdt/css/user.min.css">
<link type="text/css" rel="stylesheet" href="../bdt/css/listnav.css">
<link type="text/css" rel="stylesheet" href="../bdt/css/user.min.css">
<link type="text/css" rel="stylesheet" href="../bdt/css/listnav.css">
<script type="text/javascript" src="../bdt/js/edit.min.js"></script>
<script type="text/javascript" src="../bdt/js/myrelations.js"></script>
<body>
<div id="container" class="container myrelations-container bg-greyfa">
    <div id="page">
        <div class="page__hd bg-white fc-blue b-b-grey has-tab scrollhd">
            <div class="statebar">
                <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png"></a>
                <div class="tab-btn fs30 tab-btn-two">
                    <a class="bg-blue fc-white tab-on" onclick="myFocusList()" id="relationId1">关注</a>
                    <a class="fc-blue" onclick="myFansList()" id="relationId2">粉丝</a>
                </div>
            </div>
        </div>

        <!--页面主体-->
        <div class="page__bd scrollbd">
            <!--占位空间-->
            <div class="top-space4"></div>
            <!-- 好友列表 -->
            <div class="myrelationslist" id="myrelations-page0" style="display: none;">
                <div class="myrelations-list" id="page0">


                </div>
            </div>

            <!--关注列表-->
            <div class="myrelationslist" id="myrelations-page1">
                  <div class="myrelations-list b-t-grey" id="page1">
                      <?php foreach($concern as $k=>$v):?>
                        <div class="myrelations-item b-b-grey bg-white" onclick="gotoUser_pageHtml(<?=$v['concerns']['id']?>)"><a>
                                <i>
                                    <img src="<?=Yii::$app->params['public'].'/attachment'.$v['concerns']['photo']?>"></i>
                                </i>
                                <i><img src="../bdt/images/v2.png"></i></a>
                            <div><h2 class="fs30 fc-navy just-name"><?=$v['concerns']['nickname']?></h2></div>
                            <span><img src="../bdt/images/icon06.png"></span>
                        </div>
                      <?php endforeach;?>


                </div>
            </div>

            <!--粉丝列表-->
            <div class="myrelationslist" id="myrelations-page2" style="display:none;">
                <div class="myrelations-list b-t-grey" id="page2">
                    <?php foreach($fans as $k=>$v):?>
                        <div class="myrelations-item b-b-grey bg-white" onclick="gotoUser_pageHtml(<?=$v['fans']['id']?>)"><a>
                                <i>
                                    <img src="<?=Yii::$app->params['public'].'/attachment'.$v['fans']['photo']?>"></i>

                                </i>
                                <i><img src="../bdt/images/v2.png"></i></a>
                            <div><h2 class="fs30 fc-navy just-name"><?=$v['fans']['nickname']?></h2></div>
                            <span><img src="../bdt/images/icon06.png"></span>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>

            <!--占位空间-->
            <div class="bottom-space2"></div>
        </div>
    </div>
</div>



</body>
