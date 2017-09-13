<?php
use yii\helpers\Html;
use \common\tools\htmls;
?>
<div class="sd pph">
    <div class="wk_c_left_t">
        <span class="wk_c_left_t1">内容页面</span><span class="wk_c_left_t2">Content</span>
    </div>
    <div class="wk_c_left_cnt">
        <ul><li class="wk_menu1_cur">
                <a href="" title="常见问题" class="a">常见问题</a></li>
        </ul>
    </div>
    <div class="clear"></div>
    <div id="wk_zcyl1" class="area"></div>
    <div class="clear"></div>
    <div class="wk_c_left_cont">
        <span class="wk_c_left_cont1">联系方式</span>
        <span class="wk_c_left_cont2">Contact</span>
    </div>
    <div class="wk_left_contdiv">
                    <span>
                        <strong>地 址：</strong>
                        <strong><?=$site['address'];?></strong>
                    </span>
        <span>
            <strong>咨询热线：</strong><?=$site['telphone'];?></span>
    </div>
    <div class="clear"></div>
</div>
