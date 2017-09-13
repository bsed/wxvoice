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
<div class="wk_head_banner">
    <div class="wk_portalhead_bn8"></div>
</div>
<div class="wk_ymbg">
    <div id="wp" class="wp">



        <div id="ct" class="ct2 wp cl">
            <div class="mn">
                <div class="wk_c_right_name">
                    <div class="wk_c_right_name_l">
                        <div class="bm_h cl">
                            <a href="" class="y xi2 rss" target="_blank" title="RSS">订阅</a>
                        </div>
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
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="listcontenttop" class="area"></div>

                <div class="wk_content_right_m">
                    <div class="wk_pro_m">
                        <!-- list -->
                        <?php foreach( $list as $k=>$v):?>
                        <div class="wk_pro_main" <?php if($k%3 == 0):?>style="margin-right:0;" <?php endif;?>>
                                <div class="wk_pro_img"><a href="" target="_blank">
                                        <img src="<?=constant('aurl').$v['cover']?>" alt=""></a></div>
                                <div class="wk_pro_main_name">
                                    <span class="wk_pro_main_name2">
                                        <a href="" title="" target="_blank"><?=$v['title']?></a></span>
                                </div>
                                <div class="wk_pro_main_cnt">
                                    <span class="wk_pro_main_cnt2"><?=$v['des']?></span>
                                </div>
                                <div class="wk_pro_main_more">
                                    <a href="<?=Url::toRoute(['site/article-content', 'id'=>$v['id']])?>" title="了解更多" target="_blank">了解更多</a> </div>
                        </div>
                        <?php endforeach;?>


                        <!-- list-->

                    </div>
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

            <!-- left_nav -->
            <?=$this->render('_leftnav',['site'=>$site])?>
            <!-- left_nav -->


        </div>
    </div>

</div>
