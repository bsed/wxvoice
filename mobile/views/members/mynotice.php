<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = $this->title;
?>

<link type="text/css" rel="stylesheet" href="../bdt/css/mynotice.css" />
<script type="text/javascript" src="../bdt/js/mynotice.js"></script>

<body class="bg-grey">
<div id="container" class="container mynotice-container bg-greyfa">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white fc-black b-b-grey has-tab scrollhd">
            <div class="statebar">
                <a onclick="goBack();" class="nav-act left-act"><img src="../bdt/images/nav_icon_back1.png"></a>
                <div class="tab-btn fs30 tab-btn-two" id="noticeSwitch">
                    <a class="bg-blue fc-white tab-on">问答消息<i class="bg-red" style="display:none;"></i></a>
                    <a class="fc-blue">系统消息<i class="bg-red" style="display:none;"></i></a>
                </div>
            </div>
        </div>
        <!--页面主体-->
        <div class="page__bd scrollbd">

            <!--问答消息-->
            <div class="notice-list" id="noticeListCon0">
                <a id="downloadMoreData" class="appui_loadmore fs32 fc-greyabc">拼命加载中<i class="loadmore"></i></a>
            </div>
            <!--系统消息-->
            <div class="notice-list" id="noticeListCon1" style="display: none;">

                <div class="notice-item bg-white b-tb-grey hasNotRead" onclick="setNoticeReadStatus(9507,1,'qanda_record.html?id=4171&amp;reAnswer=2&amp;from=notice',this)">
                    <div class="notice_head"><i><img src="../bdt/images/user_21382.jpg"><i><img src="../bdt/images/v1.png"></i></i>
                        <p class="fs28">系统消息</p><i><img id="isHasRead011" src="../bdt/images/unread.png"></i>
                    </div>
                    <p class="fs30">早上好</p>
                    <div class="notice_bottom">
                        <p class="fs22">06-06 09:07</p>
                        <p class="fs22">查看详情</p>
                    </div>
                </div>

         </div>
            <!--系统消息END-->

    </div>
</div>
<input type="hidden" name="expert"  value="<?=Yii::$app->session['expert']?>"/>


</body>
