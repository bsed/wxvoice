<div class="tab-con">
    <?php
    $c = Yii::$app->controller->id;
    ?>
        <a href="/site/index.html" class="<?php if($c == 'site'):?>tabbtn-on<?endif;?>">
            <i class="default"></i>
            <span class="<?php if($c == 'site'):?>fc-blue<?php else:?>fc-greyabc<?endif;?>">首页</span>
        </a>
        <a href="/circle/circle_my.html" class="<?php if($c == 'circle'):?>tabbtn-on<?endif;?>">
            <i class="circle"></i>
            <span class="<?php if($c == 'circle'):?>fc-blue<?php else:?>fc-greyabc<?endif;?>">密友圈</span>
<!--            <em class="bg-red"></em>-->
        </a>
        <a href="/questions/qanda.html" class="<?php if($c == 'questions'):?>tabbtn-on<?endif;?>">
            <i class="qanda"></i>
            <span class="<?php if($c == 'questions'):?>fc-blue<?php else:?>fc-greyabc<?endif;?>">问答</span>
        </a>
        <a href="/articles/square.html" class="<?php if($c == 'articles'):?>tabbtn-on<?endif;?>">
            <i class="dynamic"></i>
            <span class="<?php if($c == 'articles'):?>fc-blue<?php else:?>fc-greyabc<?endif;?>">发现</span>
        </a>
        <a href="/members/index.html" class="<?php if($c == 'members'):?>tabbtn-on<?endif;?>">
            <i class="mine"></i>
            <span class="<?php if($c == 'members'):?>fc-blue<?php else:?>fc-greyabc<?endif;?>">我的</span>
        </a>
</div>