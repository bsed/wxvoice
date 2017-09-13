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
<link rel="stylesheet" type="text/css" href="../static/css/style_2_portal_index.css" />
<style id="diy_style" type="text/css">
    #frameAZ77IG {  border:0px !important;margin:0px !important;}
    #portal_block_3 {  border:0px !important;margin:0px !important;}
    #portal_block_3 .dxb_bc {  margin:0px !important;}
    #frameg7v9f1 {  border:0px !important;margin:0px !important;}
    #portal_block_4 {  border:0px !important;margin:0px !important;}
    #portal_block_4 .dxb_bc {  margin:0px !important;}
    #frameD33fZZ {  border:0px !important;margin:0px !important;}
    #portal_block_5 {  border:0px !important;margin:0px !important;}
    #portal_block_5 .dxb_bc {  margin:0px !important;}
    #frameCAzcC7 {  border:0px !important;margin:0px !important;}
    #portal_block_6 {  border:0px !important;margin:0px !important;}
    #portal_block_6 .dxb_bc {  margin:0px !important;}
    #frameinrzym {  border:0px !important;margin:0px !important;}
    #portal_block_7 {  border:0px !important;margin:0px !important;}
    #portal_block_7 .dxb_bc {  margin:0px !important;}
</style>
<div id="wk_section1" class="wk_section wk_section1">
    <div class="wk_header" style="display:none;">
        <div class="wrap">
            <div class="y">
                <nav class="wk_nav">
                    <ul class="fix">
                        <li id="wk_menu1"></li>
                    </ul>
                    <span class="wk_nav_icon"></span></nav>
            </div>
        </div>
    </div>

    <script type="text/javascript">document.getElementById("wk_menu1").className = "on";</script>
    <div class="wk_banner">
        <ul class="wk_pic" id="pic">
            <?php foreach( Htmls::getPiece('hdp') as $v):?>
            <li style="background-image:url(<?=Yii::$app->params['imgurl'].$v['images']?>)">
                <a title="11<?=$v['name']?>" href="<?=$v['link']?>"></a></li>
            <?php endforeach;?>
        </ul>
        <ul class="wk_list" id="list_pic">
            <?php foreach(Htmls::getPiece('hdp') as $v):?>
            <li class="on"></li>
            <?php endforeach;?>
        </ul>
    </div>

</div>
<div class="clear"></div>
<div class="wrap">
    <div id="wk_addiy1" class="area"></div>
</div>
<div class="clear"></div>
<div id="wk_section2" class="wk_section wk_section2">
    <div class="wrap">
        <?php foreach( Htmls::getPiece('fwfw') as $v):?>
        <div class="wk_home_title">
            <a><img src="<?=Yii::$app->params['imgurl'].$v['images']?>" width="262" height="78"/></a>
        </div>
        <div class="wk_service_text"><?=$v['des']?></div>
        <?php endforeach;?>

        <div class="wk_serve_column">
            <div class="wk_serve_d">
                <div id="wk_serve_diy1" class="area">
                    <div id="frameAZ77IG" class=" frame move-span cl frame-1">
                        <div id="frameAZ77IG_left" class="column frame-1-c">
                            <div id="frameAZ77IG_left_temp" class="move-span temp"></div>
                            <div id="portal_block_3" class="block move-span">
                                <div id="portal_block_3_content" class="dxb_bc">
                                    <div class="portal_block_summary">
                                        <ul class="fix">

                                            <?php foreach( Htmls::getPiece('fwjs') as $k=>$v):?>
                                            <li class="c<?=$k+1?>">
                                                <dl>
                                                    <dt class="wk_pic"><a href="#" target="_blank">
                                                            <img src="<?=Yii::$app->params['imgurl'].$v['images']?>" alt="<?=$v['name']?>" width="270" height="200"/></a>
                                                    </dt>
                                                    <dt class="wk_t"><a href="#" target="_blank"><?=$v['name']?></a></dt>
                                                     <?=$v['des']?>
                                                </dl>
                                            </li>
                                            <?php endforeach;?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="clear"></div>
        </div>
    </div>


    <div class="wk_service_foot">站在用户的角度思考问题，与客户深入沟通，找到网站设计与推广的最佳解决方案</div>
</div>
<div class="clear"></div>
<div class="wrap"><div id="wk_addiy2" class="area"></div>
</div>
<div class="clear"></div>
<div id="wk_section3" class="wk_section wk_section3">
    <div class="wk_succeed">
        <div class="wk_succeed_title">
            <a><img src="../static/images/t_cases.jpg" width="296" height="74"/></a>
        </div>
        <div class="wk_success_text">一个人能走多远，取决于与谁同行，我们是一个富有理想和激情的团队，是一个蓬勃向上并富有朝气的团队，<br/>
            也是一个技术专业化、管理人性化、创新性和学习型的优秀团队。</div>
    </div>
    <div class="wk_case_d">
        <div id="wk_case_diy1" class="area">
            <div id="frameg7v9f1" class=" frame move-span cl frame-1">
                <div id="frameg7v9f1_left" class="column frame-1-c">
                    <div id="frameg7v9f1_left_temp" class="move-span temp"></div>
                    <div id="portal_block_4" class="block move-span">
                        <div id="portal_block_4_content" class="dxb_bc">

                            <ul class="wk_portfolio-grid fix">
                                <?php foreach( htmls::getAr(['rec'=>1, 'pid'=>3], '4', ['listorder' => SORT_DESC])['list'] as $v):?>
                                <li class="wk_thumbnail">
                                    <a class="wk_thumbnail_a" href="<?=Url::toRoute(['site/article-content', 'id'=>$v['id']])?>" title="" target="_blank">
                                        <img src="<?=Yii::$app->params['imgurl'].$v['cover']?>" width="300" height="200" class="cases_img" alt=""/>
                                        <div class="wk_projectinfo"></div>
                                    </a>
                                    <div class="wk_meta">
                                        <h4 class="z">
                                            <a href="" title="<?=$v['title']?>" target="_blank"><?=$v['title']?></a>
                                        </h4>
                                        <div class="y">
                                            <a href="" title="<?=$v['title']?>" target="_blank" class="wk_cases_a_pc"></a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </li>
                                <?php endforeach;?>

                            </ul>

                        </div></div></div></div></div>

    </div>
    <div class="wk_btn_cases_more"><a href="<?=Url::toRoute(['site/case-list','pid'=>3])?>" title="查看更多" class="btn">查看更多</a></div>
</div>
<div class="clear"></div>
<div class="wrap">
    <div id="wk_addiy3" class="area"></div>
</div>
<div class="clear"></div>
<!-- solutions -->
<div id="wk_section4" class="wk_section wk_section4">
    <div class="wk_home_solutions">
        <div class="wk_home_solutions_title">
            <a><img src="../static/images/t_solutions.png" width="311" height="82"/></a>
        </div>
        <div class="wk_home_solutions_text">为客户提供各种类型的最优互联网整体解决方案</div>
        <div class="wk_home_solutions_list wrap">
            <div id="wk_solution_diy1" class="area">
                <div id="frameD33fZZ" class=" frame move-span cl frame-1">
                    <div id="frameD33fZZ_left" class="column frame-1-c">
                        <div id="frameD33fZZ_left_temp" class="move-span temp"></div>
                        <div id="portal_block_5" class="block move-span">
                            <div id="portal_block_5_content" class="dxb_bc">
                                <div class="portal_block_summary">
                                    <div class="wk_home_solutions_list_inner">

                                        <dl class="wk_solu_dl_0">
                                            <dt><a href="#" target="_blank"></a></dt>
                                            <dd class="wk_t">
                                                <a href="#" target="_blank">企业网站解决方案</a>
                                            </dd>
                                            <dd class="wk_spec">企业网站作为一个公司的网络名片，最主要的作用是展示公司形象和宣传公司的服务或产品，所...</dd>
                                            <dd class="wk_bg"></dd>
                                        </dl>

                                        <dl class="wk_solu_dl_1">
                                            <dt><a href="#" target="_blank"></a></dt>
                                            <dd class="wk_t"><a href="#" target="_blank">旅游网站解决方案</a></dd>
                                            <dd class="wk_spec">随着互联网的迅速，越多越多人，尤其是上班白领，都喜欢在网上查看旅游相关信息，然后再网上直...</dd>
                                            <dd class="wk_bg"></dd>
                                        </dl>

                                        <dl class="wk_solu_dl_2">
                                            <dt><a href="#" target="_blank"></a></dt>
                                            <dd class="wk_t"><a href="#" target="_blank">手机网站解决方案</a></dd>
                                            <dd class="wk_spec">随着智能手机的迅速发展，移动互联网时代已经到来，这带给我们是一个机遇还是危机？全取决于...</dd>
                                            <dd class="wk_bg"></dd>
                                        </dl>

                                        <dl class="wk_solu_dl_3">
                                            <dt><a href="#" target="_blank"></a></dt>
                                            <dd class="wk_t"><a href="#" target="_blank">商城网站解决方案</a></dd>
                                            <dd class="wk_spec">商城网站需要强大的后台管理系统、良好的用户购物体验、安全稳定的服务器空间，商城网站...</dd>
                                            <dd class="wk_bg"></dd>
                                        </dl>

                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="wk_btn_solutions_more"><a href="#" title="查看更多" class="btn">查看更多</a></div>
    </div>
</div>
<div class="clear"></div>
<div class="wrap">
    <div id="wk_addiy4" class="area"></div>
</div>
<div class="clear"></div>
<!--news-->
<div id="wk_section5" class="wk_section wk_section5">
    <div class="wk_home_news">
        <div class="wk_home_news_title">
            <a><img src="../static/images/t_news.jpg" width="310" height="71"/></a>
        </div>
        <div class="wk_home_news_text">
            提供网站建设相关资讯、互联网行业资讯、网站设计知识、空间域名邮箱、网站解决方案、常见问题、签约新闻等
        </div>
        <div class="wk_home_news_list">
            <div class="wrap">
                <div class="wrap">
                    <div id="wk_news_diy1" class="area">
                        <div id="frameCAzcC7" class=" frame move-span cl frame-1">
                            <div id="frameCAzcC7_left" class="column frame-1-c">
                                <div id="frameCAzcC7_left_temp" class="move-span temp"></div>
                                <div id="portal_block_6" class="block move-span">
                                    <div id="portal_block_6_content" class="dxb_bc">

                                        <div class="wk_home_news_list_inner">
                                              <!-- list-->
                                            <?php foreach( htmls::getAr(['rec'=>1, 'pid'=>5], '3', ['listorder' => SORT_DESC])['list'] as $v):?>
                                            <div class="wk_home_news_item">
                                                <dl>
                                                    <dt><?=date('Y-m-d', $v['ctime'])?></dt>
                                                    <dd class="wk_t">
                                                        <a href="<?=Url::toRoute(['site/article-content', 'id'=>$v['id']])?>" title="<?=$v['title']?>" target="_blank"><?=$v['title']?></a>
                                                    </dd>
                                                    <dd class="wk_spec">
                                                        <a href="<?=Url::toRoute(['site/article-content', 'id'=>$v['id']])?>" title="<?=$v['des']?>" target="_blank"><?=$v['des']?>
                                                        </a>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <?php endforeach;?>
                                            <!-- list end-->

                                        </div>



                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="wk_btn_news_more">
                    <a href="<?=Url::toRoute(['site/article-list', 'pid'=>5])?>" title="查看更多" class="btn">查看更多</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="wrap">
    <div id="wk_addiy5" class="area"></div>
</div>
<div class="clear"></div>
<div id="wk_section6" class="wk_section wk_section6">
    <div class="wk_home_partner">
        <div class="wk_home_partner_title">
            <a><img src="../static/images/t_kehu.jpg" width="372" height="73"/></a>
        </div>
        <div class="wk_home_partner_text">
            他们都选择了周末设计网络，我们最大的使命就是让他们的选择变得坚定和正确，为客户创造最大的价值从而实现自己的价值。
        </div>
        <div class="wk_home_partner_list wrap">
            <div id="wk_partner_diy1" class="area">
                <div id="frameinrzym" class=" frame move-span cl frame-1">
                    <div id="frameinrzym_left" class="column frame-1-c">
                        <div id="frameinrzym_left_temp" class="move-span temp"></div>
                        <div id="portal_block_7" class="block move-span">
                            <div id="portal_block_7_content" class="dxb_bc">
                                <div class="portal_block_summary"><table>
                                        <tr>

                                     <?php foreach(htmls::getPiece('hzkh') as $k=>$v):?>
                                         <?php $duotuo = json_decode( $v['value'],true)?>
                                            <td>
                                                <div class="wk_pic wk_partner_box">
                                                    <div class="wk_cont1">
                                                        <a href="#" target="_blank" title="">
                                                            <img src="<?=Yii::$app->params['imgurl'].$duotuo[0]?>" width="150" height="100" alt=""/>
                                                        </a>
                                                    </div>
                                                    <div class="wk_cont2">
                                                        <a href="#" target="_blank" title="">
                                                            <img src="<?=Yii::$app->params['imgurl'].$duotuo[1]?>" width="150" height="100" alt=""/>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                     <?php endforeach;?>

                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="wrap">
    <div id="wk_addiy6" class="area"></div>
</div>
<div class="clear"></div>

<div class="wp">
    <div id="diy1" class="area"></div>
</div>
<div class="clear"></div>

<div id="wp" class="wp"></div>
