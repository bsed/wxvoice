<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use \common\tools\htmls;
use yii\helpers\Url;
AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<?php $site = htmls::site();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script> window.ppSettings = {app_uuid:'4247e9d6-30ba-11e7-b287-00163e00061e'};(function(){var w=window,d=document;function l(){var a=d.createElement('script');a.type='text/javascript';a.async=!0;a.charset='utf-8';a.src='https://ppmessage.cn/ppcom/assets/pp-library.min.js';var b=d.getElementsByTagName('script')[0];b.parentNode.insertBefore(a,b)}l();})();</script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>博睿天诚</title>
    <meta name="keywords" content="微信开发|微信定制|北京微信|微信建设|微信投票|微信商城|微信分销|博睿天诚" />
    <meta name="description" content="博睿天诚,国内知名的软件及微信第三方开发服务商,为国内近千家知名单位提供过技术服务,微信营销软件专家,为微信公众平台提供营销策划服务,同时提供网站订制,微信开发及微信商城及分销类软件开发." />
    <meta name="MSSmartTagsPreventParsing" content="True" />
    <meta http-equiv="MSThemeCompatible" content="Yes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <link rel="stylesheet" type="text/css" href="../static/css/style_2_common.css" />
    <script src="../static/js/common.js" type="text/javascript"></script>
    <script src="../static/js/jquery-1.7.2.js" type="text/javascript"></script>
    <script src="../static/js/pace.js" type="text/javascript"></script>
    <script src="../static/js/function.js" type="text/javascript"></script>
    <script src="../static/js/index.js" type="text/javascript"></script>
    <script src="../static/js/week_nav.js" type="text/javascript"></script>


</head>

<!--header-->
<body id="nv_portal" class="pg_index">
<div id="hd" style="background:#FFF; height:90px; border-bottom:1px solid #E6E6E6; ">
    <div class="clear"></div>
    <div id="week_nav">
        <div class="wk_navwp">
            <div class="">
                <div class="wk_logo">
                    <h2><a href="/" title="">
                            <img src="../static/images/logo.png" alt="" border="0" />
                        </a></h2>
                </div>
                <div class="wk_idl">

                </div>
                <div class="wk_inav">
                    <ul class="nav">
                        <li class="a" id="mn_portal">
                            <a href="/"  title="首页" >首页</a>
                        </li>
                        <li id="mn_P2" onmouseover="showMenu({'ctrlid':this.id,'ctrlclass':'hover','duration':2})">
                            <a href="javascript:;" >新闻资讯</a></li>
                        <li id="mn_P3" onmouseover="showMenu({'ctrlid':this.id,'ctrlclass':'hover','duration':2})">
                            <a href="javascript:;">服务范围</a></li>
                        <li id="mn_P4" onmouseover="showMenu({'ctrlid':this.id,'ctrlclass':'hover','duration':2})">
                            <a href="<?=Url::toRoute(['site/article-list', 'pid'=>3])?>">合作案例</a></li>
                        <li id="mn_P1" onmouseover="showMenu({'ctrlid':this.id,'ctrlclass':'hover','duration':2})">
                            <a href="javascript:;" >关于我们</a></li>
                        <li id="mn_P1">
                            <a href="javascript:;" >在线咨询</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sub_nav">
    <ul class="p_pop h_pop" id="mn_P2_menu" style="display: none">
        <li><a href="<?=Url::toRoute(['site/article-list', 'pid'=>5])?>">公司新闻</a></li>
        <li><a href="<?=Url::toRoute(['site/article-list', 'pid'=>6])?>">行业新闻</a></li>
        <li><a href="<?=Url::toRoute(['site/article-list', 'pid'=>7])?>">媒体报道</a></li>
    </ul>
    <ul class="p_pop h_pop" id="mn_P3_menu" style="display: none">
        <li><a href="">网站建设</a></li>
        <li><a href="">微信开发</a></li>
        <li><a href="">系统设计</a></li>
        <li><a href="">图像处理</a></li>
    </ul>
    <div class="p_pop h_pop" id="mn_userapp_menu" style="display: none"></div>
    <ul class="p_pop h_pop" id="mn_P5_menu" style="display: none">
        <li><a href="">常见问题</a></li>
    </ul><ul class="p_pop h_pop" id="mn_P1_menu" style="display: none">
        <li><a href="<?=Url::toRoute(['site/page', 'pid'=>12])?>">企业文化</a></li>
        <li><a href="<?=Url::toRoute(['site/page', 'pid'=>13])?>">公司团队</a></li>
        <li><a href="<?=Url::toRoute(['site/page', 'pid'=>14])?>">诚聘英才</a></li>
        <li><a href="">联系我们</a></li>
    </ul>
</div>
<div class="clear"></div>
<!-- header -->



<!--main content-->
<?= $content ?>
<!--main content-->


<!--common footer-->
<div id="wk_ft">
    <div class="wk_footer" >
        <div class="wk_contact">
            <div class="wrap">

                <div class="wk_home_about z">
                    <dl>
                        <dt><a href="#">关于我们</a></dt>
                        <dd>专注于网站定制，始终追求"用最快的速度定制出最好的网站"。懂您所需、做您所想！我们一直在思考如何为客户创造更大的价值，让客户更省心!</dd>
                        <dd><a href="<?=Url::toRoute(['site/page', 'pid'=>12])?>" class="wk_more">查看更多 >></a></dd>
                    </dl>
                </div>

                <div class="wk_home_case z">
                    <h2><a href="#">最新案例</a></h2>
                    <ul>
                        <?php foreach( htmls::getAr(['rec'=>1, 'pid'=>3], '2')['list'] as $v):?>
                        <li>
                            <a href="#" target="_blank">
                                <img src="<?=Yii::$app->params['imgurl'].$v['cover']?>" width="80" height="52"/></a>
                            <h5><a href="#" target="_blank"><?=$v['title']?></a></h5>
                            <p class="wk_text">
                                <a href="#" target="_blank"><?=$v['des']?></a>
                            </p>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="wk_home_service z">
                    <h2><a href="#">服务范围</a></h2>
                    <a class="wk_sub" href="#">品牌官网设计</a>
                    <a class="wk_sub" href="#" rel="noFollow">商城网站开发</a>
                    <a class="wk_sub" href="#">手机网站设计</a>
                    <a class="wk_sub" href="#">微信网站建设</a>
                    <a class="wk_sub" href="#">其他网站定制</a>
                </div>


                <div class="wk_home_contact z">
                    <h2><a href="<?=Url::toRoute(['site/page', 'pid'=>12])?>">联系我们</a></h2>
                    <ul>
                        <li><i class="wk_addres"></i>地址：北京市丰台区马家堡甲120号5幢3层3028</li>
                        <li><i class="wk_weibo"></i>QQ：<a target="_blank" rel="nofollow" href="http://wpa.qq.com/msgrd?v=3&uin=896792616&site=qq&menu=yes">896792616</a></li>
                        <li><i class="wk_email"></i>邮箱：<a target="_blank" rel="nofollow" href="#">896792616@qq.com</a></li>
                        <li><i class="wk_call"></i>电话：400－8888 8888</li>
                        <li><i class="wk_weixin"></i><a href="#">付款方式</a></li>
                    </ul>
                </div>


            </div>
        </div>


        <div class="wk_blogroll">
            <div class="wrap">
                <p class="wk_copyright">
                    Copyright &copy; 2016 <a href="" target="_blank">博睿天诚 </a>
                    <a title="Week Design" target="_blank">技术支持：博睿天诚</a>
                    <a href="" target="_blank" title="">( 粤ICP备11006888号 )</a>&nbsp;
                    <a href="" target="_blank" title="">
            </div>
        </div>

    </div>

    <div id="ft" class="wp cl" style="border:0;">
    </div>
</div>
<!-- 调用QQ群 -->
<!-- <iframe border="0" src="http://qm.qq.com/cgi-bin/qm/qr?k=k8hk3d485sZRFxDNUOiUIzvjcOPw9mNX#" id="iframe_fpjt" frameborder="0" height="0" width="0"></iframe> -->
<!--common footer-->

</body>
</html>
<?php $this->endPage() ?>
