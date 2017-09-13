<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript" src="../bdt/js/myarticle.js"></script>
<body class="bg-white">
<div id="container" class="container myhomepage-container bg-white">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white fc-black b-b-grey scrollhd">
            <div class="statebar">
                <a onclick="goBack();" class="nav-act left-act">
                    <img src="../bdt/images/nav_icon_back1.png"></a>
                <h2 class="fs34">我的文章</h2>
                <!--<a class="nav-act right-act" href="article_edit.html"><img src="../bdt/../bdt/images/nav_icon_publish1.png" /></a>-->
            </div>
        </div>
        <!--页面主体-->
        <div class="page__bd mb10 bg-white scrollbd" id="homepage" style="display:block;">
            <!--占位空间-->
            <div class="top-space4"></div>
            <!--我朋友圈发表的文章和短消息-->
            <div class="my-article mt10" id="acticlePage">
             <?php foreach($list as $k=>$v):?>
                <div class="my-article-item mb20" >
                    <span class="fs50"><?=date('d',$v['created'])?><i class="fs28"><?=date('m',$v['created'])?>月</i></span>
                    <a class="my-article-content mb10" onclick="gotoMessageOrAriticle(<?=$v['id']?>,'<?=$v['from']?>','<?=$v['publishtype']?>',1)">
                        <div class="my-article-alltext bg-greyfa" id="textId<?=$v['id']?>">
                            <p class="fs30 fc-black face_tag"><?=$v['title']?></p></div>
                    </a>
                    <div class="clear"></div>
                </div>
               <?php endforeach;?>



            </div>
        </div>
    </div>
</div>



</body>
