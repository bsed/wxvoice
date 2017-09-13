<?php
use yii\helpers\Url;
?>
<?php if(stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')):?>
    <?php
    $a = Yii::$app->controller->action->id;
    ?>
    <script>
        wx.config(<?=$this->params['js']->config(array('onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone','startRecord','stopRecord','onVoiceRecordEnd','playVoice','pauseVoice','stopVoice','onVoicePlayEnd',
            'uploadVoice','downloadVoice','chooseImage','previewImage','uploadImage','downloadImage','translateVoice','getNetworkType','openLocation','getLocation','hideOptionMenu','showOptionMenu','hideMenuItems',
            'showMenuItems','hideAllNonBaseMenuItem','showAllNonBaseMenuItem','closeWindow','scanQRCode','chooseWXPay','openProductSpecificView','addCard','chooseCard','openCard'), false);?>);
        <?php if($a == 'article_detail' || $a == 'qanda_detail' || $a == 'circle_qanda_detail'):?>
            var title = $('input[name="title"]').val();
            var imgUrl = $('.images').attr('src');
            var des = $('input[name="title"]').val();
            var link = '<?=Url::current([], true);?>';
        <?php else:?>
            var title = "半导体微社区";
            var des = "半导体,是一个专业的社区，汇集行业顶尖人才";
            var imgUrl = "http://imgs.emifo.top/attachment/articles/user15/3531503727537642.jpeg";
            var link = '<?=Url::current([], true);?>';
        <?php endif;?>
        wx.ready(function(){
            wx.onMenuShareTimeline({
                title: title,
                link: link,
                imgUrl: imgUrl,
            });
            wx.onMenuShareAppMessage({
                title: title,
                desc: des,
                link: link,
                imgUrl: imgUrl,
            });
        });
    </script>
<?php endif;?>


