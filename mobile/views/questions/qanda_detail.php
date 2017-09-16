<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\tools\htmls;

$this->params['breadcrumbs'][] = $this->title;
?>
<body class=" bg-white">


<link type="text/css" rel="stylesheet" href="../bdt/css/edit.min.css">
<script type="text/javascript" src="../bdt/js/hidpi-canvas.min.js"></script>
<script type="text/javascript" src="../bdt/js/qanda_detail.js"></script>
<script type="text/javascript" src="../bdt/js/comment.js"></script>
<script type="text/javascript" src="../bdt/js/picPop.js"></script>
<script type="text/javascript" src="../bdt/js/edit.min.js"></script>
<script type="text/javascript" src="../bdt/js/editor_cursor_position.js"></script>

<div id="container" class="container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white fc-black b-b-grey scrollhd">
            <div class="statebar">
                <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png"></a>
                <a class="fs32 fc-black back-btn" id="back_index" href="index.html" style="display: none;">首页</a>
                <h2 class="fs34" id="title_id"><?=$user['nickname']?>的提问</h2>
            </div>
<!--            <div class="page__hd-tips bg-greyf1"  id="coupon_count_div" style="display: none;">-->
<!--                <p class="fs24 fc-grey999">您有<span class="fc-black fs28" id="coupon_count_id">1</span>张围观券，本次收听免费！</p>-->
<!--                <a class="bg-white" id="coupon_count_close"><img src="../bdt/images/nav_icon_close1.png"></a>-->
<!--            </div>-->
        </div>
        <div class="page__bd bg-greyfa scrollbd">
            <!--无优惠券-->
            <div class="top-space1" id="noneCouponSpace" style="display: none;"></div>
            <!--有优惠券-->
            <div class="top-space6" id="hasCouponSpace" style="display: none;"></div>
            <!-------------问答详情----------------------->
            <div class="qanda-detail bg-greyfa">
                <!-------------问题相关信息----------------------->
                <div class="qanda-detail-con">
                    <!--48小时未回答退款提示-未回答则显示-已回答则隐藏-->
                    <div style="display:none" class="timeout-tips fs30 fc-grey999 bg-grey" id="tui_expired_text_id"></div>

                    <!--提问者信息-价格-状态--->
                    <div class="asker-price-status bg-white">
                        <!--提问者信息-点击可跳转至提问者主页-->
                        <a class="asker-info">
                            <span class="asker-headpic"><img id="asker_pic_id" src="<?=Yii::$app->params['public'].'/attachment'.$user['photo']?>"></span>
                            <span class="asker-orther fs28" id="asker_nickname_id"><?=$user['nickname']?></span>
                        </a>
                        <!--价格-状态-->
                        <div class="price-status">
                            <div class="price-coupon">
									<span class="price">
										<i class="fs30 fc-red" id="price_id">￥<?=$question['askprice']?></i><!--价格-->
										<em style="display:none" class="bg-black" id="price_line_id"></em><!--横线-->
									</span>
                                <span style="display:none" class="coupon" id="price_coupon_id">
                                    <img src="../bdt/images/coupon_icon.png"></span>
                            </div>
                            <span class="status fs20 fc-grey666" style="" id="expired_text_id"></span>
                        </div>
                    </div>

                    <!--原问--可有图-->
                    <div class="question-common bg-white">
                        <!--问题内容-->
                        <div class="question-info fs30">
                            <span class="question-tag fc-blue fwb mr5">原问</span>
                            <p class="question-text fc-black" id="asker_content_id"><?=$question['question']?></p>
                            <p class="question-text fc-black">
                                <?php if($pics):?>
                                    <?php foreach($pics as $k=>$v):?>
                                        <img  class="images" style="height:auto;width:100%;margin:5px;" src="<?=Yii::$app->params['public'].'/attachment'.$pics[$k]?>"?>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </p>
                        </div>
                        <!--问题图片-问题与回答中图片列表公用部分-->
                        <div class="question-piclist" style="display:none;" id="asker_content_pic_id">
                        </div>

                        <a class="topicqanda_back mt5" id="topicqanda_back" style="display:none;">
                            <span><img src="" id="topicqanda_pic"></span>
                            <span class="fs28 fc-blue fwb">查看原话题，了解更多回答</span>
                        </a>

                        <div class="ask-time-statistic fs24 fc-grey666" id="ask_time_statistic1">
                            <span class="ask-time" id="ask_time_id_1"><?=$format_time?></span>
                            <a class="reanswer-btn bg-greyfa fs24 fc-red ml20" id="reanswer_id_1" style="display:none;">重答</a>
                            <?php if($question['status'] == 1):?>
                            <p class="answer-statistic"><span id="listen_times_id_1"><?=$question['views'];?>人浏览</span></p>
                            <?php endif;?>
                        </div>

                    </div>

                <?php if($question['status'] == 1):?>
                    <!--回答-气泡-语音模式-->
                    <div class="answer-common bg-white" style="" id="answer_main_id_1">
                        <div class="answer-common-bg bg-greyfa">
                            <div class="answer-tag-expert">
                                <span class="fs28 fc-white bg-green">行家说</span>
                                <a class="answer-expert">
										<span class="answer-expert-pic mr5">
											<img src="<?=Yii::$app->params['public'].'/attachment'.$expert['photo']?>" id="answer_expert_pic1"><i>
                                                <img src="../bdt/images/v2.png"></i>
										</span>
                                    <span class="answer-expert-name">
											<i class="fs28 fc-black" id="answer_expert1"><?=$expert['nickname']?></i>
											<i class="fs20 fc-grey999" id="answer_time1"><?=htmls::formatTime($question['created']);?></i>
										</span>
                                </a>
                            </div>
                            <?php if($question['voice']):?>
                            <div class="appui-qanda-answer" id="answer_wave_mod_id" >
                                <div id="a_play_0_<?=$question['id']?>" class="appui-qanda-answerstyle free voice" onclick="playAudioQaClickFunction(<?=$question['id']?>,1,1,'a_play_0_<?=$question['id']?>');">
                                    <i></i>
                                    <span class="appui_qanda-voice-wave">
											<em class="wave1"></em>
											<em class="wave2"></em>
											<em class="wave3"></em>
										</span>
                                    <em class="tips">免费收听</em>
                                    <span class="appui_qanda-voice-wait" style="display:none;"></span>
                                </div>
                                <em class="appui-qanda-answer-time" ><?=$question['voice_time'];?>"</em>
                            </div>
                            <?php endif;?>
                            <?php if($question['article']):?>
                            <div class="pictext-info fs30" style="display:block;">
                                <p class="pictext-text fc-grey666" id="pictext_text_id_2"><?=$question['article'];?></p>
                            </div>
                            <?php endif;?>

                        </div>
                    </div>
                    <script>
                        $('#answer_wave_mod_id').click(function() {
                            alert(2);
                        }

                    </script>
                    <!--回答-气泡-语音模式 END-->
                    <?php endif;?>

                    <!--追问-无图-->
                    <div class="question-common add-question bg-white mt10" style="display:none;" id="add_question_id">
                        <!--问题内容-->
                        <div class="question-info fs30">
                            <span class="question-tag fc-blue fwb mr5">追问</span>
                            <p class="question-text fc-black" id="add_question_text_id">爽肤水地方</p>
                        </div>

                        <div class="ask-time-statistic fs24 fc-grey666" style="display:none;" id="ask_time_statistic2">
                            <span class="ask-time" id="ask_time_id_2"></span>
                            <a class="reanswer-btn bg-greyfa fs24 fc-red ml20" id="reanswer_id_2" style="display:none;">重答</a>
                            <a class="go-answer-btn bg-greyfa fs24 fc-red ml20" id="goAnswerAddQuestBtn" style="display:none;">回答</a>
                        </div>
                    </div>

                    <?php if($circle):?>
                    <!--详情页面中行家创建的圈子入口-->
                    <div class="add-circle-con bg-white" style="padding-top:0px;" id="articleqzinfo">
                        <div class="add-circle-indetail bg-white">
                            <h3 class="fc-black fs24">本文答主创建了<span class="fwb ml5 mr5" id="qzname"><?=$circle['name']?></span>圈子</h3>
                            <div class="circle-and-expert mt20"><i>
                                    <img src="<?=Yii::$app->params['public'].'/attachment'.$expert['photo']?>" id="qzbgpic"></i>
                                <div class="cae-middle">
                                    <h3 class="fs30 fwb fc-black" id="qzname1"><?=$circle['name']?></h3>
                                    <p class="fs20 fc-grey999">
                                        <span class="expert-name" id="qzusernickname1"><?=$expert['nickname']?></span>
                                <!--<span class="circle-members" id="qzmembers">29+</span>-->
                                    </p>
                                </div>
                                <a class="add-circle-btn bc-grey fc-red fs24" href="/circle/circle_share_detail.html?id=<?=$circle['id']?>" >去逛逛</a>
                            </div><p class="circle-discript fs24 fc-grey999 mt10" ><?=$circle['des']?></p>
                        </div>
                    </div>
                    <!--详情页面中行家创建的圈子入口END-->
                    <?php endif;?>


                    <!--问答操作-撤回（只允许提问者在提问后的一段时间内可撤回）-追问（只对提问者开放并且只在问题被回答后开放）-->
                    <div class="qanda-act" id="qanda_act_id" style="display:none;">
                        <a class="bg-greyf1 fs30 fc-greyabc" style="display:block;" onclick="$('#add-qanda-dialog').fadeIn();" id="addQuestion">追问</a>
                        <!-- 							<a class="bg-orange fs30 fc-white" style="display:none;" id="rewardBtn">打赏</a> -->
                    </div>



                    <div class="adv-module mt10" id="openShare" style="display:none;">
                        <img src="../bdt/images/share_adv2.png"></div>
                    <div id="about_us" class="mt10" style="display:none;">
                        <h2 class="fs28 mt20">关注"半导体"，获取<span class="fc-red">最新内容</span></h2>
                        <div>
                            <img src="../bdt/images/wenfangba.jpg" alt="">
                        </div>
                    </div>

                </div>

                <div class="recommend-qanda mt10" style="display:none">
                    <h2 class="recommend-qanda-head fs30 fc-black bg-white">推荐问答</h2>
                  <?php foreach($RecQuestions as $k=>$v):?>
                    <div class="recommend-qanda-item bg-white" onclick="gotoQADetail(<?=$v['id'];?>,1,'4')">
                        <h3 class="fs30 fc-black"><?=$v['question']?></h3>
                        <p class="fs24 fc-grey999 mt5"><span><?=$v['expert']['nickname'];?></span><span><?=$v['views'];?>人阅读</span></p>
                        <span><img src="../bdt/images/icon06.png"></span>
                    </div>
                    <?php endforeach;?>

                </div>

                    <!--文章评论模块-->
                    <div class="comment-module mt10"  id="CommentModule">
                        <!--评论列表-->
                        <div class="comment-module-con">
                            <div class="comment-module-hd b-b-grey fs30 fc-black">
                                <span class="b-b-blue">共有<i id="commentCount"><?=$count?></i>条评论</span>
                            </div>
                            <div class="comment-module-bd">
                                <div class="comment-list-con">
                                    <!--已有的评论-->
                                    <?php foreach($comments as $k=>$v):?>
                                        <div class="comment-item bc-grey" id="commentListID<?=$v['id']?>">
                                            <div class="comment-item-author">
                                                <a onclick="gotoUser_pageHtml(<?=$v['user']['id']?>)">
                                                    <i><img src="<?=Yii::$app->params['public'].'/attachment'.$v['user']['photo']?>"></i>
                                                    <span class="ml5">
                                            <i class="fs30 fc-navy"><?=$v['user']['nickname']?></i>
                                            <i class="fs20 fc-greyabc"><?=htmls::formatTime($v['created'])?></i>
                                        </span>
                                                </a>
                                            </div>
                                            <div onclick="commonJS(<?=$v['user']['id']?>,<?=$v['id']?>)" id="comment<?=$v['id']?>" class="comment-item-content fs30 fc-black  face_tag">
                                                <?php if($v['to_member_id'] !=0):?>
                                                    <span class="fc-black">回复:</span>
                                                    <span class="fc-black"><?=$to_user[$v['id']]['nickname']?></span>
                                                <?php endif;?>
                                                <?=$v['content']?>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                    <input type="hidden" name="member" value="<?=$member_id?>" >
                                    <!--已有的评论-->
                                </div>
                            </div>
                        </div>
                        <!--评论列表-->
                    </div>

            </div>
            <!--占位空间-->
            <div class="bottom-space1"></div>
        </div>
        <!--页面底部-->
       <!-- 写评论-->
        <div class="page__fd bg-white b-t-greyf1 scrollfdc" id="foot_comment_menu">
            <div class="appui-comment-fixed zan-share">
                <span class="appui-comment-btn bc-grey fs28 fc-grey666 bc-grey" onclick="commentBtn('',<?=$_GET['id'];?>);">写下你的评论...</span>
                <a class="appui-share-btn" onclick="share()" id="share"><s></s><i>分享</i>
                    <span style="display:none" class="fc-white fs20 bc-white">0</span></a>
                <a class="appui-collect-btn" onclick="collectionBtn()" id="collection"><s></s>
                    <i>收藏</i><span style="display:none" class="fc-white fs20 bc-white">0</span></a>
                <a class="appui-like-btn <?php if($dianzan):?>on<?php endif;?>" onclick="dianzanBtn(<?=$member_id?>)" id="dianzan"><s></s><i>赞</i>
                    <span class="fc-white fs20 bc-white"><?=$nums?></span>
                </a>


            </div>
        </div>
        <!-- 写评论-->
    </div>
</div>

<a class="switch-btn bg-white" style="display:none;" id="shareSwitchBtn">
    <img class="guide" src="../bdt/images/switch_guide.png">
    <img class="comment" src="../bdt/images/switch_comment.png">
</a>
<!--分享-->
<div style="display:none;">
    <div class="ellipse1"></div>
    <div class="ellipse2"></div>
    <p class="fc-white fs20">分获
        <br>享取
        <br>页收
        <br>面益</p>
</div>

<div id="jsDialog2" class="js_dialog" style="display: none;">
    <div class="appui-mask"></div>
    <div id="shareMeNow">
        <div class="share_con">
            <div id="closeArea"></div>
            <img class="share_title" src="../bdt/images/shareMe.png" alt="">
            <img class="share_close" src="../bdt/images/share_close.png" alt="">
            <img class="share_ribbon" src="../bdt/images/ribbon.png" alt="">
            <img class="share_stars" src="../bdt/images/stars.png" alt="">
            <h2 class="fs36 fc-black">所有人分享该页面都可获取收益<br>具体收益分配如下</h2>
            <p class="fs24 fc-orange">(所有收益均需扣除20%的平台服务费)</p>
            <table class="fc-black fs24">
                <tbody><tr class="bg-grey">
                    <th>行为</th>
                    <th>收益
                        <br><span>(第三人通过分享进入)</span></th>
                    <th>收益
                        <br><span>(第三人未通过分享进入)</span></th>
                </tr>
                <tr>
                    <td>分享</td>
                    <td>60%</td>
                    <td>/</td>
                </tr>
                <tr class="bg-grey">
                    <td>提问</td>
                    <td>20%</td>
                    <td>50%</td>
                </tr>
                <tr>
                    <td>收听</td>
                    <td>20%</td>
                    <td>50%</td>
                </tr>
                </tbody></table>
            <p class="fs36 fc-red"><img src="../bdt/images/join.png" alt=""><span>快邀请朋友来收听吧!</span></p>
        </div>
    </div>
</div>

<!--追问-->
<div class="js_dialog" id="add-qanda-dialog" style="display:none;">
    <div class="appui-mask"></div>
    <div class="add-qanda bg-white">
        <textarea id="zhuiwenQuestionStr" class="fs30 fc-black bc-grey bg-greyfa" placeholder="向Ta提问，等Ta语音回答；公开问题公开追问"></textarea>
        <a class="fs30 fc-white bg-orange" onclick="sendAddQuestion()">免费追问</a>
        <a class="close bc-white" onclick="$('#add-qanda-dialog').fadeOut();"><img src="../bdt/images/img_delete.png"></a>
    </div>
</div>

<audio id="audio-mc" style="display:none;" preload="preload" src=""></audio>

<div id="container-pop" class="container comment-edit-container bg-grey" style="display:none;">
    <div id="page-pop">
        <!--页面导航栏-->
        <div class="page__hd page__hd-edit fc-black bg-white b-b-grey">
            <div class="statebar">
                <a class="fc-black fs34" id="cancleID">取消</a>
                <h2 class="fs36" id="titleID">评论</h2>
                <a class="fc-black fs34" id="sendID">发送</a>
            </div>
        </div>
        <!--页面主体-->
        <div class="page__bd">
            <!--占位空间-->
            <div class="top-space1"></div>
            <div class="edit-module bg-white bc-grey">
                <div class="edit-content">
                    <div class="edit-content-container">
                        <div class="article-comment-edit-module fc-grey678 fs30" contenteditable="false">
                            <!--插入文字示例-->
                            <textarea class="fs34 fc-black" id="edit-mark" placeholder="请输入评论内容"></textarea>
                        </div>
                        <span id="placeholder" class="fc-greyabc fs30"></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="appui-gallery-swiper" id="js-gallery-swiper" style="display: none;">
    <!--图片预览轮播-->
    <!-- swiper-slide-visible swiper-slide-active -->
    <div class="swiper" style="cursor: -webkit-grab;">
        <div class="swiper-wrapper" id="swiper-wrapper">
            <!--<div class="swiper-slide">
                <img data-src="C:\Users\Administrator\Desktop\2.png" class="swiper-lazy">
                <div class="swiper-lazy-preloader"></div>
            </div>-->
            <!-- <a class="swiper-slide" href="javascript:;"><img src="../bdt/images/gallery/gallery1.jpg" /></a> -->
        </div>
        <div class="pagination">
            <span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span>
            <span class="swiper-pagination-switch"></span>
            <span class="swiper-pagination-switch"></span>
            <span class="swiper-pagination-switch"></span>
        </div>
    </div>
</div>
<!-- photoSwiper 结束 -->


<div id="mask_mod"></div>
<!-- 个性提示框————分享有钱赚 -->
<div id="prompt_box">
    <img id="closePrompt" src="../bdt/images/nav_icon_close1.png" alt="">
    <img class="prompt_bg" src="../bdt/images/promptImg.jpg" alt="">
    <img class="prompt_btn_img" src="../bdt/images/prompt_btn_img.png" alt="">
    <img class="pressBtnNow" src="../bdt/images/pressBtnNow.png" alt="">
    <!-- 确定生成按钮 -->
    <div id="prompt_btn"></div>
</div>
<!-- 被分享用户的信封 -->
<div id="mail_story">
    <!-- <img id="mail_back" src="../bdt/images/mail_lid1.png" alt=""> -->
    <!-- 信封盖子 -->
    <!--  <div class="mail_lid">
            <img src="../bdt/images/mail_lid1.png?v=20170306201700" alt="">
        </div> -->
    <!-- 这是信内容 -->
    <!-- <div id="story_con">
            <img src="../bdt/images/mail_con.png?v=20170304165256">
            <h3 class="fc-grey666"></h3>
        </div>
        <div class="mail_cover">
            <img src="../bdt/images/mail_cover.png?v=20170304142320" alt="">
        </div>
        <p class="fs26 fc-red">好的,谢谢</p> -->
    <h3 class="fc-white fs12"></h3>
    <img class="mail_story_bg" src="../bdt/images/mail_story_bg.png" alt="">
    <div class="mail_touch"></div>
    <div class="closeMail"></div>
</div>
<!-- 分享的提示框 -->
<div id="finishConform2" style="display: none;">
    <img class="finishBg" src="../bdt/images/finishConform2.png" alt="">
    <div class="finishTouch1"></div>
    <div class="finishTouch2"></div>
    <div class="closeMail"></div>
</div>
<!-- 生成 海报 -->
<div id="posters" style="display: none;">
    <h3>长按图片,保存后并分享朋友圈</h3>
    <img id="closePosters" src="../bdt/images/nav_icon_close1.png" alt="">
    <img class="posterBg" src="" alt="">
</div>


<div class="share-money" style="display:none;" id="shareView">
    <div class="appui-mask"></div>
    <div class="share-moner-con">
        <img src="../bdt/images/share_money.png?v=20170331220507">
        <a class="has-know fc-white fs28 closePopShare_dd">知道了</a>
        <a id="closeShare" class="close bc-white closePopShare_dd"><img src="../bdt/images/close.png"></a>
    </div>
</div>


<div id="js-bg" class="bg-black" style="display:none"></div>
<div id="js-page" class="bg-greyfa"><div class="appui_js_page">
        <div style="display:none" class="appui_js_page-hd bg-white fs28 fc-grey678 b-t-grey" id="commentObject">评论对象：评论内容</div>
        <div id="appiu_js_page-actID" class="appiu_js_page-act bg-white fs30 b-t-grey"></div>
        <div class="appiu_js_page-act bg-white fs30 fc-greyabc b-t-grey mt5">
            <a class="fc-black" id="appiu_js_page-cancel">取消</a></div>
    </div>
</div>
</body>
