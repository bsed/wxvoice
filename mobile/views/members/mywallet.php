<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript" src="../bdt/js/mywallet.js"></script>
<link type="text/css" rel="stylesheet" href="../bdt/css/user.min.css">
<body class=" bg-greyfa">
<div id="container" class="container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white b-b-grey fc-black">
            <div class="statebar">
                <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png"></a>
                <h2 class="fs34">收入</h2>
            </div>
        </div>
        <div class="page__bd">
            <div class="top-space4"></div>
            <div class="bg-white" id="my_wallet">
                <p class="fs28 fc-grey999">总金额(元)</p>
                <h2 class="fc-navy"><?=$total;?></h2>
            </div>
            <div class="bg-white" id="my_wallet">
                <p class="fs28 fc-grey999">未提现(元)</p>
                <h2 class="fc-navy wei"><?=$total - $tixian;?></h2>
                <a class="get-cash fs28 fc-white bg-red can">提现</a>
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
            <p class="cash-tips fs28 fc-blue">提示：每天最多能提现2000元，另外，根据微信规则，低于1元不提供提现功能。</p>

        </div>

        <div class="page__fd">
            <a class="charge_tips fs28 fc-grey999">提现记录</a>
        </div>
    </div>
</div>


<!--弹出的解释说明-->
<div class="js_dialog" style="display:none;">
    <div class="appui-mask"></div>
    <div class="appui-helptext bg-white" id="helptext" style="display:none;">
        <h2 class="appui-helptext-hd fs32 fc-black b-b-grey">提现记录</h2>
        <div class="appui-helptext-bd fc-black456 b-b-grey">
            <div class="appui-helptext-bd-con fc-black">
                <?php foreach($tixianRecord as $k=>$v):?>
                <p class="fs30 mb10">(<?=$k+1;?>) <?=date('Y/m/d',$v['created']);?>提现<?=$v['price'];?>元,状态:<?php if($v['status'] == 1):?>已到账<?php else:?>未到账<?php endif;?></p>
                <?php endforeach;?>
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