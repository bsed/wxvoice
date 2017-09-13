<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\tools\htmls;

$this->title = '全网营销';
$this->params['breadcrumbs'][] = $this->title;

?>
<link rel="stylesheet" type="text/css" href="../static/css/style_2_portal_list.css" />
<div id="wp" class="wp">
    <style id="diy_style" type="text/css">#framexxhcig {  margin:0px !important;}#portal_block_23 {  margin:0px !important;}#portal_block_23 .dxb_bc {  margin:0px !important;}</style>
    <style>
        .ct2 { border:0; padding-bottom:30px;}
        .wk_c_right_name { height:30px;}
        .wk_c_right_name_l, .wk_c_right_name_r { padding-top:0;}
        .wk_about_1_warp { width:960px; padding:15px 0;}
    </style>

</div>
<div class="wk_head_banner">
    <div class="wk_portalhead_bn6">
        <div class="wk_portalhead_bg">

        </div>
        <div class="clear"></div>
    </div>
</div>


<div class="wk_ymbg" style="min-height: 1000px;">
    <div id="wp" class="wp" >


        <div id="ct" class="ct2 wp cl" >
            <div class="wk_c_right_name" >

                <div class="wk_c_right_name_r">
                    <ul>
                        <li><img src="../static/images/right_wz.png" alt="" /></li>
                        <li>
                            <span>您现在的位置：</span>
                            <span><a href="">首页</a></span>
                            <span>→</span>
                            <?php foreach($bread as $k=>$v):?>
                                <span><a href=""><?=$v?></a></span>
                                <?php if( ($k+1) != count($bread)):?>
                                    <span>→</span>
                                <?php endif;?>
                            <?php endforeach;?>
                        </li>
                    </ul>
                </div>
                <!-- content -->
                <div class="wk_content_right_m" >
                    <div class="wk_about_1_warp">
                                            <div class="portal_block_summary">
                                             <?=$info['content']?>
                                            </div>
                    </div>
                </div>
                <!-- content -->

                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
    <div class="clear"></div>