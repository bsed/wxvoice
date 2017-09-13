<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\tools\htmls;
use yii\widgets\Breadcrumbs;
$this->title = '全网营销';
$this->params['breadcrumbs'][] = $this->title;

?>
<link rel="stylesheet" type="text/css" href="../static/css/style_2_portal_list.css" />
<div id="wp" class="wp">
</div>
<div class="wk_head_banner">
    <div class="wk_portalhead_bn16">
    </div>
</div>
<div class="wk_ymbg">
    <div id="wp" class="wp">

        <div class="wp">
           <div id="diy1" class="area"></div>
        </div>

        <div id="ct" class="ct2 wp cl">
            <div class="mn">
                <div class="wk_c_right_name">
                    <div class="wk_c_right_name_l">
                        <div class="bm_h cl">
                            <a href="" class="y xi2 rss" target="_blank" title="RSS">订阅</a>                                    </div>
                    </div>
                    <div class="wk_c_right_name_r">

                        <ul>
                            <li>
                                <img src="../static/images/right_wz.png" alt="" />
                            </li>
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
                </div>
                <div id="listcontenttop" class="area"></div>
                <div class="bm">
                    <div class="wk_bm_wc cl">
                        <ul class="wk_su">
                            <!--  list-->
                            <?php foreach( $list as $k=>$v):?>
                            <li class="cl">
                                <h2><a href="<?=Url::toRoute(['site/article-content', 'id'=>$v['id']])?>" target="_blank" class="xi2" title="<?=$v['title']?>" >
                                        <?=$v['title']?>
                                    </a> </h2>
                                <p class="wk_bm_sm"><?=$v['des']?></p>
                                <span class="xg1">
                           <span class="xg1">时间: <?=date('Y-m-d H:i:s',$v['ctime'])?></span>
                                </span>
                            </li>
                            <?php endforeach;?>
                         <!-- list-->

                        </ul>
                    </div>
                    <div id="listloopbottom" class="area"></div>
                </div>
                <div class="clear"></div>
                <div class="pgs cl">
                    <div class="pg">
                        <?= LinkPager::widget([
                            'pagination'=>$pages,
                            'firstPageLabel' => '首页',
                            'nextPageLabel' => '下一页',
                            'prevPageLabel' => '上一页',
                            'lastPageLabel' => '末页',
                        ]) ?>
                    </div>
                </div>
                <div id="diycontentbottom" class="area"></div>

            </div>

            <!--leftnav-->
            <?=$this->render('_leftnav',['site'=>$site])?>
            <!--leftnav-->
        </div>
    </div>

    <div class="wp mtn">
       <div id="diy3" class="area"></div>
    </div>	</div>

