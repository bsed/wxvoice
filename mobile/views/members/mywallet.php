<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = $this->title;
?>
<link type="text/css" rel="stylesheet" href="../bdt/css/user.min.css">
<body class=" bg-greyfa">
<div id="container" class="container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white b-b-grey fc-black">
            <div class="statebar">
                <!--a class="nav-act left-act" id="certifyHome" href="user_center.html"><img src="../bdt/images/nav_icon_back1.png" /></a-->
                <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png?v=20170209160748"></a>
                <!--a class="nav-act left-act" id="modifyPicPage" onclick="backToPrePage();" style="display:none;"><img src="../bdt/images/nav_icon_back1.png" /></a-->
                <h2 class="fs34">收入</h2>
            </div>
        </div>
        <div class="page__bd">
            <div class="top-space4"></div>
            <div class="bg-white" id="my_wallet">
                <p class="fs28 fc-grey999">总金额(元)</p>
                <h2 class="fc-navy"><?=$total;?></h2>
                <a class="get-cash fs28 fc-white bg-red" id="getCashTbtn" style="display:none;" onclick="$('#getCashTips').fadeIn();">提现</a>
            </div>
            <ul class="bg-white income" id="income">
                <i></i>
                <li>
                    <h3 class="fc-black fs30">回答收入</h3>
                    <p id="myAnswer" class="fc-grey999 fs28"><?=$QuestionPrice;?></p>
                </li>
                <li>
                    <h3 class="fc-black fs30">红包收入</h3>
                    <p id="myAsk" class="fc-grey999 fs28"><?=$PocketPrice;?></p>
                </li>
                <li>
                    <h3 class="fc-black fs30">圈子收入</h3>
                    <p id="myShare" class="fc-grey999 fs28"><?=$CirclePrice;?></p>
                </li>
                <i></i>
            </ul>
<!--            <ul class="bg-white income b-t-greyf1">-->
<!--                <i></i>-->
<!--                <li>-->
<!--                    <h3 class="fc-black fs30">红包收入</h3>-->
<!--                    <p id="myRedpacket" class="fc-grey999 fs28">0.00</p>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <h3 class="fc-black fs30">赞赏收入</h3>-->
<!--                    <p id="myReward" class="fc-grey999 fs28">0.00</p>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <h3 class="fc-black fs30">圈子收入</h3>-->
<!--                    <p id="myCircle" class="fc-grey999 fs28">0.00</p>-->
<!--                </li>-->
<!--                <i></i>-->
<!--            </ul>-->
<!--            <div class="youhuiquan bg-white" onclick="location='mycoupon.html'">-->
<!--                <img src="../bdt/images/youhuiquan.png?v=20170208234732" alt="">-->
<!--                <p class="fs30 fc-black ml10">优惠券</p>-->
<!--                <img class="rightArrow" src="../bdt/images/right.png" alt="">-->
<!--                <span class="fs30 fc-orange mr5">3张</span>-->
<!--            </div>-->
        </div>
        <div class="page__fd">
            <a class="charge_tips fs28 fc-grey999">计费规则</a>
        </div>
    </div>
</div>


<!--弹出的解释说明-->
<div class="js_dialog" style="display:none;">
    <div class="appui-mask"></div>
    <div class="appui-helptext bg-white" id="helptext" style="display:none;">
        <h2 class="appui-helptext-hd fs32 fc-black b-b-grey">计费规则</h2>
        <div class="appui-helptext-bd fc-black456 b-b-grey">
            <div class="appui-helptext-bd-con fc-black">
                <p class="fs30 mb10">1、提问者所提出的问题被成功回答后，通过其他第三人的付费收听来获得收入。每被付费收听一次，获得<span id="touListenFee">0.5</span>元；</p>
                <p class="fs30 mb10">2、行家通过回答他人提出的问题来获得收入。每成功回答一条，获得相应金额；</p>
                <p class="fs30 mb10">3、行家通过回答问题被第三人付费收听来获得收入。每被付费收听一次，获得<span id="touListenFee1">0.5</span>元；</p>
                <p class="fs30 mb10">4、若问答被分享，通过分享页面进入付费收听而产生的收益，分享者获得<span id="shareListenShare">0.6</span>元，提问者与回答者均获得<span id="shareListenQA">0.2</span>元；</p>
                <!-- 		<p class="fs30 mb10">5、若问答被连续二次分享，通过连续二次分享页面进入且付费收听而产生的收益，二次分享者获得<span id="lv2ShareListenShare">0</span>元，提问者、回答者与一次分享者均获得<span id="lv2ShareListenQA">0</span>元；</p> -->
                <p class="fs30 mb10">5、所有收入扣除<span id="qaFeeRate">20%</span>作为平台佣金。账户余额大于<span id="minPayCash">3</span>元，每日21点系统自动将账户里的余额划到微信钱包内，用户也可前往“问房吧”公众号提现；</p>
                <p class="fs30 mb10">6、备注：免费围观券收听，行家、提问者、分享者都没有收益。</p>
            </div>
        </div>
        <h2 class="appui-helptext-fd fs32 fc-orange">知道了</h2>
    </div>
</div>
<script>
    $('.charge_tips').click(function(e) {
        setTimeout(function() {
            $('.js_dialog').show();
            $('#helptext').show();
            //alert(Math.floor($('body').height()*0.70));
            $('#helptext').css('margin-top', -$('#helptext').height() / 2);
            if ($('#helptext').height() >= Math.floor($('body').height() * 0.70)) {
                $('#helptext').find('.appui-helptext-bd').height($('#helptext').height() - $('.appui-helptext-hd').height() - $('.appui-helptext-fd').height());
            }
        }, 1000);
    });

    $('.appui-helptext-fd').click(function(e) {
        $('.js_dialog').hide();
        $('#helptext').hide();
        $('#helptext').css({
            'margin-top': '0',
            'height': 'auto'
        });
    });
</script>
</body>