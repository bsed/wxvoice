<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = $this->title;
?>
<body class=" bg-white" style="height: 640px;">
<div id="container" class="container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white b-b-grey fc-black scrollhd">
            <div class="statebar">
                <!--a class="nav-act left-act" id="certifyHome" href="user_center.html"><img src="../bdt/images/nav_icon_back1.png" /></a-->
                <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png"></a>
                <h2 class="fs34">我的二维码</h2>
            </div>
        </div>
        <div class="page__bd scrollbd">
            <!---------------占位空间---------------->
            <div class="top-space1"></div>
            <!-------------我的二维码------------------------>
            <div class="myqrcode-info">
                <div class="myqrcode-headpic">
                    <img id="headPic" src="../bdt/images/default_avatar_100.png">
                    <?php if($user['vip'] == 1):?>
                    <span><img src="../bdt/images/vip2.png"></span>
                    <?php endif;?>

                </div>
                <div class="myqrcode-namesex mt20"><span class="fs32 fc-black" ><?=$user['nickname']?></span>
                    <?php if($user['sex'] == 1):?>
                        <img  class="ml5" src="../bdt/images/sex_m.png"></div>
                <?php elseif($user['sex'] == 0):?>
                        <img  class="ml5" src="../bdt/images/sex_w.png"></div>
                <?php endif;?>


                <p class="myqrcode-signame fs24 fc-grey999 mt10" ><?=$user['slogan']?></p>
                <div class="myqrcode-label fc-black456 mt10" >
                   <?php if($tags):?>
                        <?php foreach($tags as $v):?>
                        <span class="label fs24"><?=$v?></span>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
                <a class="myqrcode-img"><img  src="<?= Url::to(['members/qrcode'])?>"></a>
                <p class="myqrcode-sharetext mt10 fs28 fc-orange">我已回答了<span id="answerCnt">0</span>个问题
                    <br>微信扫码，来[半导体]向我提问</p>
            </div>
            <!---------------占位空间---------------->
            <div class="bottom-space1"></div>
        </div>
    </div>
</div>



</body>
