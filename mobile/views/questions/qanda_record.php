<link type="text/css" rel="stylesheet" href="../bdt/css/photoswipe.css" />
<link type="text/css" rel="stylesheet" href="../bdt/css/default-skin.css" />
<script type="text/javascript" src="../bdt/js/swiper-3.4.0.min.js"></script>
<script type="text/javascript" src="../bdt/js/photoswipe.min.js"></script>
<script type="text/javascript" src="../bdt/js/photoswipe-ui-default.js"></script>
<script type="text/javascript" src="../bdt/js/picPop.js"></script>

<body class=" bg-greyfa">
<div id="container" class="container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white fc-black b-b-grey scrollhd">
            <div class="statebar">
                <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png"></a>
                <h2 class="fs34" id="nickname"><?=$info['user']['nickname'];?>的提问</h2>
            </div>
        </div>
        <div class="page__bd scrollbd">
            <!--------------- 占位空间 ---------------->
            <div class="top-space1"></div>
            <!-------------录音回答页面------------------------>
            <div class="qanda-record">
                <div class="topicqanda-detail bg-white">
                    <div class="asker-price-status bg-white">
                        <a class="asker-info"><span class="asker-headpic">
                                <img id="asker_pic_id" src="<?=Yii::$app->params['public'].'/attachment'.$info['user']['photo']?>"></span>
                            <span class="asker-orther fs28"><?=$info['user']['nickname'];?></span></a>
                        <div class="price-status"><div class="price-coupon"><span class="price">
                                    <?php if($info['askprice'] == '0.00'):?>
                                    <i class="fs30 fc-red" id="price_id">免费</i>
                                        <?php else:?>
                                         <i class="fs30 fc-red" id="price_id">¥<?=$info['askprice'];?></i>
                                    <?php endif;?>
                                    <em style="display: none;" class="bg-black" id="price_line_id"></em></span>
                                <span style="display: none;" class="coupon" id="price_coupon_id">
                                    <img src="images/coupon_icon.png"></span>
                            </div>
                            <span class="status fs20 fc-grey666"  id="expired_text_id"></span>
                        </div>
                    </div>
                    <div class="topicqanda-summary show-text hide-text mt5">
                        <p class="fs28 fc-black"><?=$info['question']?></p>
                        <style>
                            .answerimg img {
                                margin:5px;
                            }
                        </style>
                        <?php if($pics):?>
                            <?php foreach($pics as $k=>$v):?>
                        <p class="fs28 fc-black answerimg"><img src="<?=Yii::$app->params['public'].'/attachment'.$v?>"></p>
                                <?php endforeach;?>
                        <?php endif;?>
                        <span class="more-text fs24 fc-blue"><i>更多</i>
                            <img src="../bdt/images/moretext.png"></span></div>
                </div>
                <!--选择回答方式-->
                <?php if($info['status'] == 1):?>
                <div id="chooseAnsWay">
                    <div class="active"><img src="../bdt/images/voicemode-1.png" alt=""><span class="fs30">语音回答</span></div>
                    <i style="left: 25%;"></i>
                    <div class=""><img src="../bdt/images/textmode.png" alt=""><span class="fs30">图文回答</span></div>
                </div>

                <div id="wayToAnswer" style="transition: all 0.5s ease; left: 0px;">

                    <div class="answerWay answerWay1" id="answerWay1">
                        <div class="answer-mc bg-white b-tb-grey">
                            <p class="fs30 fc-grey456">录音最长300秒，单次录音最长60秒，最多加录4次</p>
                            <div class="answer-log-list mt30">
                                <a class="answer-log-item bg-greyabc" id="answer-log-item0" onclick="recordButton(0)">
                                    <i class="bg-orange" style="left:0;"></i>
                                    <em class="bg-orange" style="width:0;"></em>
                                    <span class="fc-greyabc fs28">0s</span>
                                </a>
                                <a class="answer-log-item bg-greyabc" id="answer-log-item1" onclick="recordButton(1)">
                                    <i class="bg-orange" style="left:0;"></i>
                                    <em class="bg-orange" style="width:0;"></em>
                                    <span class="fc-greyabc fs28">0s</span>
                                </a>
                                <a class="answer-log-item bg-greyabc" id="answer-log-item2" onclick="recordButton(2)">
                                    <i class="bg-orange" style="left:0;"></i>
                                    <em class="bg-orange" style="width:0;"></em>
                                    <span class="fc-greyabc fs28">0s</span>
                                </a>
                                <a class="answer-log-item bg-greyabc" id="answer-log-item3" onclick="recordButton(3)">
                                    <i class="bg-orange" style="left:0;"></i>
                                    <em class="bg-orange" style="width:0;"></em>
                                    <span class="fc-greyabc fs28">0s</span>
                                </a>
                                <a class="answer-log-item bg-greyabc" id="answer-log-item4" onclick="recordButton(4)">
                                    <i class="bg-orange" style="left:0;"></i>
                                    <em class="bg-orange" style="width:0;"></em>
                                    <span class="fc-greyabc fs28">0s</span>
                                </a>
                            </div>
                            <p class="fs30 fc-greyabc mt10">点击每段录音可试听或重录</p>
                        </div>
                        <!-------------问答详情-回答------------------------>
                        <div class="qanda-record-answer mt10">
                            <span class="time-show fs34 fc-orange">0s</span>
                            <div class="control-btn">
                                <!--录音按钮-->
                                <div class="main-control bg-white" id="record-btn"><img src="../bdt/images/record.png?v=20161221180852"></div>
                                <!--录音和破防录音-停止录音后即可播放录音-播放中可暂停可继续播放-->
                                <div class="main-control bg-greyf1" id="record-play" style="display:none;">
                                    <!--录音进度-->
                                    <div class="record-percent-circle">
                                        <span class="record-percent left-record-percent"></span>
                                        <span class="record-percent right-record-percent wth0"></span>
                                    </div>
                                    <!--播放进度-->
                                    <div class="play-percent-circle" style="display:none;">
                                        <span class="play-percent left-play-percent"></span>
                                        <span class="play-percent right-play-percent wth0"></span>
                                    </div>
                                    <!--控制按钮-->
                                    <div class="control-con bg-white">
                                        <span class="record-stop bg-orange"></span>
                                        <span class="play-start" style="display:none;"><img src="../bdt/images/start.png?v=20161221180852"></span>
                                        <span class="play-stop bg-orange" style="display:none;"></span>
                                    </div>
                                </div>
                                <a class="chonglu-btn bg-white fc-orange fs34" id="chonglu-btn" style="display:none;">重录</a>
                                <a class="addlu-btn bg-white fc-orange fs34" id="addlu-btn" style="display:none;">加录</a>
                            </div>
                            <p class="record-tips fs32 fc-black456 mt10">点击开始录音最多录制300”...</p>
                        </div>
                    </div>

                    <!-- webApp -->
                    <div class="answerWay answerWay1 new-version" id="appAnswerWay1" style="display:none">
                        <div class="answer-mc bg-white b-t-grey" id="voiceDiv">
                            <p class="fs30 fc-grey456">录音最长10分钟,您可以一次录制10分钟</p>
                        </div>
                        <!-------------问答详情-回答------------------------>
                        <div class="qanda-record-answer mt10">
                            <span class="time-show fs34 fc-orange">00:00.00</span>
                            <div class="control-btn">
                                <!--录音按钮-->
                                <div class="main-control bg-white" id="appRecordBtnId"><img src="../../bdt/images/record.png?v=20161221180852"></div>
                                <div class="play-btn bg-white fc-orange fs34" id="appPlay-btn" style="opacity: 0.3;" state="false">
                                    <img src="../../bdt/images/start.png?v=20161221180852">
                                    <span style="display: none;"></span>
                                </div>
                                <!--录音和破防录音-停止录音后即可播放录音-播放中可暂停可继续播放-->
                                <div class="main-control bg-greyf1" id="appRecord-play" style="display:none;">
                                    <!--录音进度-->
                                    <div class="record-percent-circle">
                                        <span class="record-percent left-record-percent" id="left-record-percent"></span>
                                        <span class="record-percent right-record-percent wth0" id="right-record-percent"></span>
                                    </div>
                                    <!--播放进度-->
                                    <div class="play-percent-circle" style="display:none;">
                                        <span class="play-percent left-play-percent" id="left-play-percent"></span>
                                        <span class="play-percent right-play-percent wth0" id="right-play-percent"></span>
                                    </div>
                                    <!--控制按钮-->
                                    <div class="control-con bg-white">
                                        <span class="record-stop bg-orange"></span>
                                        <span class="stop-btn" id="continue-record" style="display:none;"><img src="../bdt/images/record.png"></span>
                                        <span class="play-stop bg-orange" style="display:none;"></span>
                                    </div>
                                </div>
                                <div class="chonglu-btn bg-white fc-orange fs34" id="appChonglu-btn" style="opacity: 0.3;" state="false">重录</div>
                            </div>
                            <p class="record-tips fs32 fc-black456 mt10" id="appRecordTips">点击开始录音最多录制300”...</p>
                        </div>
                    </div>

                    <div class="answerWay answerWay2">
                        <div id="textToAns" class="bg-white b-tb-grey">
                            <textarea id="textField" placeholder="输入您要回答的内容..." maxlength="600"></textarea>
                            <div class="qanda-pic">
                                <a class="add-qanda-pic bc-grey" contenteditable="false">
                                    <i class="bg-greyf1"></i>
                                    <i class="bg-greyf1"></i>
                                    <input id="filehidden" style="width: 100%;height: 100%;diplay:block;opacity: 0;" type="file" name="filehidden">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                    <a class="send-answer fs32 fc-white bg-greyabc">确定发送</a>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<audio id="audio-mc" style="display:none;" preload="preload" src=""></audio>
<div class="appui-gallery-swiper" id="js-gallery-swiper" style="display: none;">
    <!--图片预览轮播-->
    <!-- swiper-slide-visible swiper-slide-active -->
    <div class="swiper" style="cursor: -webkit-grab;">
        <div class="swiper-wrapper" id="swiper-wrapper">
        </div>
        <div class="pagination"><span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span>
            <span class="swiper-pagination-switch"></span>
            <span class="swiper-pagination-switch"></span>
            <span class="swiper-pagination-switch"></span>
        </div>
    </div>
</div>
<!--拒绝回答选择拒绝理由-->
<div id="refuse_dialog" class="refuse_dialog" style="display:none;">
    <div class="appui-mask"></div>
    <div class="refuse-dialog-con bg-white">
        <h2 class="fs36 fwb fc-red mt5">请选择拒绝理由</h2>
        <div class="refuse-reason fs28 fc-blue mt10">
            <p class="bg-greyfa mt10 mr5">客观条件太少</p>
            <p class="bg-greyfa mt10 mr5">与房产无关</p>
            <p class="bg-greyfa mt10 mr5">不在我熟悉的范围内</p>
            <p class="bg-greyfa mt10 mr5">其它原因</p>
        </div>
        <textarea id="reasonTextarea" class="fs30 fc-black bg-greyfa bc-grey mt20" disabled="disabled" placeholder="如您选择其他原因，请填写拒绝理由，30个字以内"></textarea>
        <a id="configRefuse" type="button" class="refuse-sure fs28 fc-white bg-grey mt20">确定拒绝</a>
        <p id="refuseTips" class="refuse-reason fc-red mt5 fs28" style="display:none"></p>
        <!-- <p id="phone-emailError" class="refuse-reason fc-orange fs28" style="display:none;"></p> -->
        <a id="closeID" class="refuse_dialog_close bg-white"><img src="../bdt/images/nav_icon_close1.png?v=20170209160748"></a>
    </div>
</div>

<script type="text/javascript" src="../bdt/js/answer_record.js"></script>
<script>
    var mySwiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination', //索引class
        loop: true, //loop模式,你能够无限滑动滑块，到最后一个之后会跳转回第一个
        grabCursor: true, //值为true时，光标在Swiper上时成手掌状
        paginationClickable: true, //索引小圆点是否可点
        autoplay: 3000, //自动播放
        autoHeight: true
    });
</script>


</body>