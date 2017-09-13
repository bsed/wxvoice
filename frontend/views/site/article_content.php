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
<link rel="stylesheet" type="text/css" href="../static/css/style_2_portal_view.css" />
<div id="mu" class="cl">
    <div class="wp"></div>
</div>

<!-- nav-->
<div id="wp" class="wp">
    <script src="../static/js/forum_viewthread.js" type="text/javascript"></script>
    <script type="text/javascript">zoomstatus = parseInt(1), imagemaxwidth = '600', aimgcount = new Array();</script>
</div>

<!-- header -->
<div class="wk_head_banner">
    <div class="wk_portalhead_bn1">
        <div class="wk_portalhead_bg">
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="wk_ymbg">
    <div id="wp" class="wp">

        <div id="ct" class="ct2 wp cl">
            <div class="mn">
                <div class="wk_c_right_name">
                    <div class="wk_c_right_name_l">
                        <span class="wk_c_right_name_l2">查看内容</span>
                    </div>
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
                                <span>→</span>
                                <span><?=$info['title']?></span>

                            </li>
                        </ul>
                    </div>
                </div>
                <div class="bm vw">
                    <div class="h hm wk_hm">
                        <h1 class="ph"><?=$info['title']?></h1>
                        <p class="xg1">
                            <?=date('Y-m-d',$info['ctime'])?>
                           <span class="pipe">|</span>
                            发布者: <a href="">博睿天诚</a><span class="pipe">|</span>
                            查看: <em id="_viewnum"><?=$info['hits']?></em></p>
                    </div>

                    <!-- content -->
                    <div class="d" style="min-height:300px">
                    <?=$info['content']?>
                    </div>
                    <!-- content -->

                                <div class="pren pbm cl">
                                                    </div>
                                                                            </div>


            </div>

            <!--leftnav-->
            <?=$this->render('_leftnav',['site'=>$site])?>
            <!--leftnav-->


        </div>
    </div>


    <div class="wp mtn">
       <div id="diy3" class="area"></div>
    </div>
    <input type="hidden" id="portalview" value="1">	</div>
