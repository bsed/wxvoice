<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = $this->title;
?>
<body class="bg-greyfa">
<div id="container" class="container red_packets_container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white scrollhd">
            <div class="statebar">
                <!--a class="nav-act left-act" href="myset.html" id="back"><img src="../bdt/images/nav_icon_back1.png" /></a-->
                <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png?v=20170209160748"></a>
                <h2 class=" fs36 fc-black" style="font-weight:600">关于我们</h2>
            </div>
        </div>
        <div class="page__bd scrollbd">
            <!--占位空间-->
            <div class="top-space1"></div>
            <!--主体意内容-->
            <div class="aboutus_details">
                <?=$this->params['site']['aboutus'];?>
            </div>

            <!--占位空间-->
            <div class="bottom-space4"></div>

        </div>
        <!--结束-->
    </div>
</div>



</body>
