<script type="text/javascript" src="../bdt/js/commonQaList.js"></script>
<link type="text/css" rel="stylesheet" href="../bdt/css/user.min.css">
<script type="text/javascript" src="../bdt/js/qanda_questions.js"></script>
<body class=" bg-grey">
<div id="container" class="container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white b-b-grey fc-black">
            <div class="statebar">
                <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png"></a>
                <h2 class="fs34">向<span id="nickname"><?=$info['user']['nickname']?></span>提问</h2>
            </div>
        </div>
        <div class="page__bd">
            <!---------------占位空间---------------->
            <div class="top-space1"></div>
            <div class="qnada-q-author-data bg-white">
                <div class="qnada-q-author">
                    <div class="qnada-q-author-photo" onclick="gotoUser_pageHtml(<?=$info['user']['id']?>)">
                        <i><img src="<?=Yii::$app->params['public'].'/attachment'.$info['user']['photo']?>"></i>
                        <i><img src="../bdt/images/v2.png"></i>
                    </div>
                    <div class="qnada-q-author-info">
                        <span class="fs32 fc-navy" onclick="gotoUser_pageHtml(<?=$info['user']['id']?>)"><?=$info['user']['nickname']?>
                        </span>
                        <span class="fs24 fc-black"><i class="mr5 fs28"><?=$concerns?></i>关注</span>
                        <a onclick="facus(<?=$member_id?>,<?=$info['user']['id']?>)" id="focus" class="bc-grey fc-orange fs24 ml10">
                            <?php if($foucs):?>已关注<?php else:?>关注<? endif;?>
                        </a>
                    </div>
                </div>
                <div class="qnada-q-author-sign">
                    <p class="fs28"><?=$info['user']['slogan']?></p></div>
                <div class="qnada-q-author-label mt10 fs24 fc-greyabc">
                    <?php if($tags):?>
                        <?php foreach($tags as $k=>$v):?>
                        <span class="bc-grey mr5"><?=$v?></span>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
            <div class="qanda-questions">
                <!-------------问题输入---------------------->
                <div class="qnada-q-data bg-white mt10 " id="questions" >
                    <div class="qnada-q-data-limit">
                        <span class="appui_cell__switch appui_cell__switch-on"><i class="bg-white"></i></span>
                        <p class="fs24 fc-greyabc">公开提问</p>
                    </div>
                    <div class="qnada-q-data-input bg-greyfa bc-grey mt10">
                        <textarea id="textarea" class="fs30 fc-black" placeholder="向他/她提问，等Ta语音回答；超过48小时未回答，将按支付路径全额退款。回答后，答案将限次免费30分钟；您可以免费向TA追问。"></textarea>
                        <span class="fs30 fc-greyabc"><i id="length" class="fs30 fc-greyabc">0</i>/140</span>
                        <!--提问-插入图片示例-->
                        <div class="qanda-pic mt5">
                            <a class="add-qanda-pic bc-greyd" contenteditable="false">
                                <i class="bg-greyd"></i>
                                <i class="bg-greyd"></i>
                                <input id="filehidden" style="width: 100%;height: 100%;diplay:block;opacity: 0;" type="file" name="filehidden">
                            </a>
                        </div>
                    </div>
                    <p class="qnada-q-data-price mt10 use_coupon ">
                        <span>
                            <?php if($info['price'] == '0.00'):?>
								<em id="askPrice" price="0" coupon="0" class="fc-red fs32">免费</em>
                            <?php else:?>
                                <em id="askPrice" price="<?=$info['price']*100;?>" coupon="0" class="fc-red fs32">￥<?=$info['price']?></em>
                            <?php endif;?>
                                <!--<i class="bg-orange"></i>-->
							</span>
                            <!--<span class="ml10 fs28">可使用优惠券</span>-->
                    </p>
                    <a id="askBtn" class="qnada-q-data-askbtn bg-orange fc-white fs30">向Ta提问</a>
                    <p class="ask_tips fs24 fc-orange mt15">查看问答细则及责任声明</p>
                </div>
            </div>
        </div>
    </div>
</div>
<audio id="audio-mc" style="display:none;" preload="preload" src=""></audio>
<!--弹出的解释说明-->
<div class="js_dialog" style="display:none;">
    <div class="appui-mask"></div>
    <div class="appui-helptext bg-white" id="helptext" style="display:none;">
        <h2 class="appui-helptext-hd fs32 fc-black b-b-grey">问答细则及责任声明</h2>
        <div class="appui-helptext-bd fc-black456 b-b-grey">
            <div class="appui-helptext-bd-con">
                <p class="fs30 mb10 fc-black fwb">问答细则</p>
                <p class="fs30">1、提出问题，支付赏金后，将等待答主开始回答；</p>
                <p class="fs30">2、答主回答问题后，答主将获得赏金；</p>
                <p class="fs30">3、若48小时内无应答，则全额退款。</p>
                <p class="fs30 mb10 mt20 fc-black fwb">责任声明</p>
                <p class="fs30 mb10">问房”的相关回答仅为该答主在房地产等领域的个人经验、意见或观点，不能被自动视为该答主供职单位/机构的意见或观点，仅供用户参考所用，亦不能被认为是其他类似性质的文件。解答内容及答主个人观点不代表“问房”平台观点，“问房”平台对解答内容的正确性不予担保，对在“问房”平台之外所进行的任何接洽行为的后果亦不予承担责任。烦请您在使用“问房”前仔细阅读并确保完全理解以上声明的全部内容，请知悉，谢谢。</p>
            </div>
        </div>
        <h2 class="appui-helptext-fd fs32 fc-orange">知道了</h2>
    </div>
    <div id="scanMe" class="bg-white" style="display: none;">
        <div class="outer">
            <h3 class="fs40 fc-blue"><span>提问</span>成功!</h3>
            <p class="scan-title fs30">关注“问房”官方公众号
                <br>第一时间收到行家的回复</p>
            <img src="../bdt/images/wenfangba.jpg?v=20170221161736" alt="">
            <p class="scan-cheerup fs26">关注"问房吧"，可领<span class="fc-red">优惠券</span></p>
            <p class="scan-longtap fs32">长按，识别二维码，加关注</p>
            <a class="fs26 fc-blue" href="">不了,谢谢</a>
        </div>
    </div>
</div>
<script>
    $('.ask_tips').click(function(e) {
        setTimeout(function() {
            $('.js_dialog').show();
            $('#helptext').show();
            //alert(Math.floor($('body').height()*0.70));
            $('#helptext').css('margin-top', -$('#helptext').height() / 2);
            if ($('#helptext').height() >= Math.floor($('body').height() * 0.70)) {
                $('#helptext').find('.appui-helptext-bd').height($('#helptext').height() - $('.appui-helptext-hd').height() - $('.appui-helptext-fd').height());
            }
        }, 1000);
    });

    $('.appui-helptext-fd').click(function(e) {
        $('.js_dialog').hide();
        $('#helptext').hide();
        $('#helptext').css({
            'margin-top': '0',
            'height': 'auto'
        });
    });
</script>



</body>