<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = $this->title;
?>
<body>
<link type="text/css" rel="stylesheet" href="../bdt/css/user.min.css">
<div id="container" class="container usercenter-container bg-grey">
    <div id="page">
        <!--页面主体-->
        <div class="page__bd scrollbd">
            <div class="user-center-container">
                <div class="user-info-module bc-grey">
                   <!-- 未登录-->
                    <div id="noLoginId" class="u-i-moudele-top bg-orange" style="<?php if($user['id']):?>display:none;<?php else:?>display:block;<?php endif;?> ">
                        <div class="u-i-m-t-con">
                            <div><i><img src="../bdt/images/default_avatar_opacity.png"></i></div>
                            <span class="mt5 fs34">
									<a class="bc-white fc-white fs24" href="login.html">登录</a>
									<a class="bc-white fc-white fs24" href="regist.html">注册</a>
								</span>
                        </div>
                    </div>
                    <div id="loginId" class="u-i-moudele-top bg-blue" style="<?php if($user['id']):?>display:block;<?php else:?>display:none;<?php endif;?> ">
                        <!--封面图片背景-->
                        <div style="display:block;" class="cover-bg"><img style="display:none;" src=""></div>
                        <!--黑色到透明色的渐变-保证姓名和签名能看清-在设置了封面的情况下才显示-->
                        <div style="display:none;" class="black-gradientbg"></div>
                        <div class="u-i-m-t-con">
                            <div>
                                <i id="headPic">
                                            <img src="<?=Yii::$app->params['public'].'/attachment'.$user['photo']?>"></i>
                                <?php if($user['vip'] == 1):?>
                                <span id="level" class="vip-level vip-level2"></span>
                                <?php elseif($user['vip'] == 0):?>
                                    <span id="level" class="vip-level vip-level5"></span>
                                    <?php else:?>
                                    <span id="level" class="vip-level vip-level1"></span>
                                <?php endif;?>
                            </div>
                            <span class="mt10 fc-white fs34" id="nickname"><?=$user['nickname']?></span>
                            <p class="signature fc-white fs24">
                                <?php if($user['vip'] == 1):?>
                                    <?php if($tags):?>
                                        <?php foreach($tags as $v):?>
                                            <span class="bc-white75"><?=$v?></span>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>
                            </p>
                        </div>
                        <p class="signature fc-white fs24"></p>
                        <?php if($user['vip'] == 1):?>
                        <a class="u-i-moudele-edit" style="display:block;" href="/members/myqrcode.html">
                            <img src="../bdt/images/qrcode_icon.png">
                            <span class="fc-white fs24">二维码</span>
                        </a>
                        <?php endif;?>
                    </div>

                    <!--好友信息-->
                    <div class="u-i-moudele-bottom bg-white fs30">
                        <a href="mywallet.html"><i id="moneyCount" class="fc-black"><?=$total;?></i><i class="fc-grey678">收入</i></a>
                        <a class="bc-grey" href="/members/myrelations.html#1"><i id="focusCount" class="fc-black"><?=$concern;?></i><i class="fc-grey678">关注</i></a>
                        <a href="/members/myrelations.html#2"><i id="fansCount" class="fc-black"><?=$fans;?></i><i class="fc-grey678">粉丝</i></a>
                    </div>
                </div>
                <!--个人中心-功能按钮列表-->
                <div class="function-module">
                    <!--功能列表-->
                    <div class="function bg-white bc-grey mt10">

                        <a class="function-btn bc-grey fc-black" href="myhomepage.html#0">
                            <img class="btn-img" src="../bdt/images/icon6_grey.png">
                            <span class="fs30">我的问答</span>
                            <img class="btn-arrow" src="../bdt/images/icon06.png">
                            <em class="statistic">
                                <i class="fs28 fc-greyabc" id="unAnswerQa" style="display:block;"></i>
                                <i class="fs28 fc-greyabc" id="unreadQa" style="display: block;"></i>
                            </em>
                        </a>
                        <a class="function-btn bc-grey fc-black" href="mynotice.html">
                            <img class="btn-img" src="../bdt/images/icon03_grey.png">
                            <span class="fs30">我的消息</span>
                            <img class="btn-arrow" src="../bdt/images/icon06.png">
                            <i class="messagetips bg-red fs26 fc-white" style="display:none"></i>
                        </a>
                        <a class="function-btn bc-grey fc-black" href="myarticle.html">
                            <img class="btn-img" src="../bdt/images/icon10_grey.png">
                            <span class="fs30">我的发布</span>
                            <img class="btn-arrow" src="../bdt/images/icon06.png">
                        </a>

                         <?php if($user['vip'] == 0):?>
                             <?php if($expert):?>
                                     <a onclick="expertMsg();" class="function-btn bc-grey fc-black">
                                     <img class="btn-img" src="../bdt/images/preson_grey.png">
                                     <span class="fs30">申请成为行家</span>
                                     <img class="btn-arrow" src="../bdt/images/icon06.png">
                                     <em class="fs30 fc-red mr5">正在审核</em>
                             <?php else:?>
                                 <a href="qanda_certify.html" class="function-btn bc-grey fc-black">
                                     <img class="btn-img" src="../bdt/images/preson_grey.png">
                                     <span class="fs30">申请成为行家</span>
                                     <img class="btn-arrow" src="../bdt/images/icon06.png">
                                     <em class="fs30 fc-red mr5">去认证</em>
                             <?php endif;?>

                        </a>
                        <?php else:?>
                        <a href="qanda_certify.html?experter=1" class="function-btn bc-grey fc-black" style="display:block;">
                            <img class="btn-img" src="../bdt/images/preson_grey.png">
                            <span class="fs30">修改行家资料</span>
                            <img class="btn-arrow" src="../bdt/images/icon06.png">
                        </a>
                        <?php endif;?>
                        <a class="function-btn bc-grey fc-black" href="personal_data.html">
                            <img class="btn-img" src="../bdt/images/icon04_grey.png">
                            <span class="fs30">修改个人信息</span>
                            <img class="btn-arrow" src="../bdt/images/icon06.png">
                        </a>
                        <script>
                            function expertMsg(){
                                dataLoadedSuccess("请等待审核");
                            }
                        </script>
                       <?php if($user['isguanjia'] != 1):?>
                            <?php if($user['honnoruser'] != 1):?>
                                 <?php if($feeusers):?>
                                     <a class="function-btn bc-grey fc-black" href="#">
                                         <img class="btn-img" src="../bdt/images/circle_grey.png">
                                         <span class="fs30">会员有效期:  <?=date('Y-m-d',$feeuser['created']);?>至<?=date('Y-m-d',$feeuser['created']+ 3600*24*365);?></span>
                                     </a>
                                 <?php endif;?>
                                 <?php if(!$feeusers):?>
                                     <a class="function-btn bc-grey fc-black" href="/circle/feeuser.html">
                                         <img class="btn-img" src="../bdt/images/icon08.png">
                                         <span class="fs30">我的会员</span>
                                         <img class="btn-arrow" src="../bdt/images/icon06.png">
                                     </a>
                                 <?php endif;?>
                             <?php else:?>
                                <a class="function-btn bc-grey fc-black" href="/circle/feeuser.html">
                                    <img class="btn-img" src="../bdt/images/icon08.png">
                                    <span class="fs30">荣誉会员</span>
                                    <img class="btn-arrow" src="../bdt/images/icon06.png">
                                </a>
                             <?php endif;?>
                           <?php else:?>
                           <a class="function-btn bc-grey fc-black" href="/circle/feeuser.html">
                               <img class="btn-img" src="../bdt/images/icon08.png">
                               <span class="fs30">群管</span>
                               <img class="btn-arrow" src="../bdt/images/icon06.png">
                           </a>
                     <?php endif;?>

<!--                        <a class="function-btn bc-grey fc-black" id="usercenterPubBtn" style="display:block;">-->
<!--                            <img class="btn-img" src="../bdt/images/icon04_grey.png">-->
<!--                            <span class="fs30">我要发文</span>-->
<!--                            <img class="btn-arrow" src="../bdt/images/icon06.png?v=20170307211453">-->
<!--                        </a>-->
<!--                        <a id="invitate" style="display:none;" class="function-btn bc-grey fc-black">-->
<!--                            <img class="btn-img" src="../bdt/images/icon09_grey.png">-->
<!--                            <span class="fs30">邀请朋友成为行家</span>-->
<!--                            <img class="btn-arrow" src="../bdt/images/icon06.png">-->
<!--                        </a>-->
                    </div>
                    <div class="function bg-white bc-grey mt10" id="loupan_manage" style="display:block;">
<!--                        <a class="function-btn bc-grey fc-black" href="loupan_manage.html">-->
<!--                            <img class="btn-img" src="../bdt/images/icon11_grey.png">-->
<!--                            <span class="fs30">楼盘管理</span>-->
<!--                            <img class="btn-arrow" src="../bdt/images/icon06.png">-->
<!--                        </a>-->
                    </div>
                    <div class="function bg-white bc-grey mt10">
                        <!-- href="myset.html" -->
                        <a class="function-btn bc-grey fc-black" href="myset.html">
                            <img class="btn-img" src="../bdt/images/icon05_grey.png">
                            <span class="fs30">设置</span>
                            <img class="btn-arrow" src="../bdt/images/icon06.png">
                        </a>
                    </div>
                </div>
            </div>
            <div class="bottom-space2"></div>
            <div class="clearclick" style="display:none"></div>
        </div>

        <!-- footer -->
        <div class="page__fd bg-white fs22 bc-grey scrollfdt" >
            <div class="tab-con">
                <?=$this->render('/_footer')?>
            </div>
        </div>
        <!-- footer -->

    </div>
</div>
</body>