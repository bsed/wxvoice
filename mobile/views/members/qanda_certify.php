<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = $this->title;
?>
<link type="text/css" rel="stylesheet" href="../bdt/css/user.min.css">
<link type="text/css" rel="stylesheet" href="../bdt/css/cropper.css">
<script type="text/javascript" src="../bdt/js/qanda_certify.js"></script>
<script type="text/javascript" src="../bdt/js/cropper.js"></script>
<script type="text/javascript" src="../bdt/js/exif.js"></script>
<body class=" bg-greyfa" onunload="myClose()" >
<div id="container" class="container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white b-b-grey fc-black">
            <div class="statebar">
                <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png"></a>
                <a class="nav-act left-act" id="modifyPicPage" onclick="goBack();" style="display:none;"><img src="../bdt/images/nav_icon_back1.png"></a>
                <h2 class="fs34">行家认证</h2>
                <a class="but_save fs28 fc-black sure-btn" id="sure-btn" style="display:none;">保存</a>
            </div>
        </div>
        <div class="page__bd">
            <div class="top-space1"></div>
            <div class="qanda-certify">
                <!--头像姓名-->
                <div class="qanda-certify-info bg-white">
                    <em class="mt20 bc-grey"><i class="bg-greyf1" id="headPic">
                            <img src="<?=Yii::$app->params['public'].'/attachment'.$info['photo']?>"></i></em>
                    <span class="fs30 fc-greyabc mb10"><?=$info['nickname']?></span>
                </div>
                <!--抬头选择-->
                <div class="qanda-certify-item bg-white mt10">
                    <h3 class="fs32 fc-grey666">头衔</h3>
                    <!-- onkeyup="this.value = this.value.substring(0, 100)" -->
                    <textarea id="masterTitle" class="fc-black456 fs30" rows="4" placeholder="输入职位描述或者在企职位"></textarea>
                    <span class="fs30 fc-greyabc"><i id="masterTitleCount">0</i>/18</span>
                </div>
                <!--头衔标签-->
<!--                <div class="qanda-certify-item bg-white mt10">-->
<!--                    <h3 class="fs32 fc-grey666">领域</h3>-->
<!--                    <textarea id="label" class="fc-black456 fs30" rows="4" placeholder="高级置业顾问；销售经理；原万科高层；房地产消费者协会高级会员"></textarea>-->
<!--                    <span class="fs30 fc-greyabc"><i id="labelCount">0</i>/5</span>-->
<!--                </div>-->
                <!--简介-->
                <div class="qanda-certify-item bg-white mt10">
                    <h3 class="fs32 fc-grey666">简介</h3>
                    <textarea id="masterInfo" class="fc-black456 fs30" rows="4" placeholder="(100个字以内)关于这些，尽情问我：房产投资、如何选择投资的房地产商品；如何挑选合适的二手房；如何理解政府最新出台限购政策......或者给你唱歌晚安小曲吧。"></textarea>
                    <span class="fs30 fc-greyabc"><i id="masterInfoCount">0</i>/100</span>
                </div>
                <!--权限-->
                <div class="qanda-certify-rights bg-white mt10">
                    <div class="fs30 fc-grey999">
                        向我提问需要支付
                        <input id="askPrice" onkeyup="num(this)" type="text" class="bg-greyf1 fc-orange fs30 ml10 mr10" placeholder="￥0-1000"> 元
                        <a class="fc-orange">收费规则</a>
                    </div>
<!--                    <div id="feeAddAsk" class="fs30 fc-grey999 b-t-grey">-->
<!--                        接受免费向我追问-->
<!--                        <span class="appui_cell__switch bg-greyabc ml5 appui_cell__switch-on"><i class="bg-white"></i></span>-->
<!--                        <a class="fc-orange">追问规则</a>-->
<!--                    </div>-->
<!--                    <div id="joinFreeFristIntv" class="fs30 fc-grey999 b-t-grey">-->
<!--                        <i id="freeListen">回答前10次免费听</i>-->
<!--                        <span class="appui_cell__switch bg-greyabc ml5 appui_cell__switch-on"><i class="bg-white"></i></span>-->
<!--                        <a class="fc-orange">免费规则</a>-->
<!--                    </div>-->
                    <div id="joinKnowledgeShare" class="fs30 fc-grey999 b-t-grey">
                        知识开放计划
                        <span class="appui_cell__switch bg-greyabc ml5 appui_cell__switch-on"><i class="bg-white"></i></span>
                        <a class="fc-orange">开放规则</a>
                    </div>
<!--                    <div id="applyExpertCertify" class="fs30 fc-grey999 b-t-grey">-->
<!--                        申请专家认证-->
<!--                        <span class="appui_cell__switch bg-greyabc ml5"><i class="bg-white"></i></span>-->
<!--                        <a class="fc-orange">专家规则</a>-->
<!--                    </div>-->
                </div>
                <!--名片上传-->
                <div class="qanda-certify-item bg-white mt10">
                    <h3 class="fs32 fc-grey999" id="certifiedPicTips">申请专家认证<span class="fs28 fc-orange">（专家文章更容易通过审核）</span></h3>
                    <!--未上传-->
                    <div class="upload-card bc-grey" id="uploadCertifiedPic">
                        <a>
                            <span class="bg-greyf1"></span>
                            <span class="bg-greyf1"></span>
                        </a>
                        <p class="fs30 fc-greyabc mt10">上传名片</p>
                        <input class="uploadCertifiedPic" accept="image/*" id="cardUpload1" type="file" name="cardUpload" onchange="cardChange('cardUpload1');">
                    </div>
                    <input type="hidden" name="uploadCertifiedPic" value=""/>
                    <div class="upload-card bc-grey upload-card-ok" id="certifiedPic" style="display:none;">
                        <img src="../bdt/images/category_adv1.jpg">
                        <input class="uploadCertifiedPic" id="cardUpload2" type="file" name="cardUpload" onchange="cardChange('cardUpload2');">
                    </div>
                </div>
                <a class="qanda-certify-postbtn bg-orange fc-white fs30" onclick="applyMasterMethods()">申请成为行家</a>
                <p>
                    <label id="protocolLabel" class="fs24">
                        <input id="aggre" type="checkbox" class="bg-greyf1 mr5" checked="true">我已阅读并同意
                    </label>
                    <a class="fc-orange fs24" id="manage-text">《问房认证用户管理条例》</a>
                </p>
            </div>
            <!---------------占位空间---------------->
            <div class="bottom-space1"></div>
        </div>
    </div>
</div>
<!--弹出手机号验证-->
<div class="phone_dialog" style="display:none;">
    <div class="appui-mask"></div>
    <div class="phone-dialog-con bg-white">
        <h2 class="fs36 fwb fc-red mt5">手机验证</h2>
        <p class="fs28 fc-black mt10">完成手机验证即可成为行家！</p>
        <form>
            <input type="number" class="mt20 fs30 fc-black bg-white bc-grey" id="phoneInput" placeholder="请输入手机号">
            <input type="number" class="mt10 fs30 fc-black bg-white bc-grey" id="codeInput" placeholder="请输入验证码">
            <input type="button" id="btnSendCode" class="mt10 fs30 fc-black bg-grey" value="发送验证码">
            <a id="verify" class="mt20 fs30 fc-white bg-red">立刻验证</a>
        </form>
        <a class="phone_dialog_close bg-white" id="closeID"><img src="../bdt/images/nav_icon_close1.png"></a>
    </div>
</div>
<div class="waitLoad" style="display:none;">
    <img src="../bdt/images/uploading1.gif">
</div>
<div class="waitUpload" style="display:none;">
    <img src="../bdt/images/uploading.gif">
</div>
<div class="upload-container bg-black123">
    <div class="row" style="margin-top: 0px;">
        <div class="col-md-9">
            <div class="img-container" id="img-container">
                <img src="../bdt/images/picture.jpg" alt="Picture" id="image" class="cropper-hidden">
                <div class="cropper-container" style="width: 400px; height: 400px;"><div class="cropper-wrap-box">
                        <div class="cropper-canvas" style="width: 400px; height: 400px; left: 0px; top: 0px;">
                            <img src="../bdt/images/picture.jpg" style="width: 400px; height: 400px; margin-left: 0px; margin-top: 0px; transform: none;">
                        </div></div>
                    <div class="cropper-drag-box cropper-modal cropper-move"></div>
                    <div class="cropper-crop-box" style="width: 320px; height: 200.93px; left: 40px; top: 99.5349px;">
                        <span class="cropper-view-box"><img src="../bdt/images/picture.jpg" style="width: 400px; height: 400px; margin-left: -40px; margin-top: -99.5349px; transform: none;"></span>
                        <span class="cropper-dashed dashed-h"></span>
                        <span class="cropper-dashed dashed-v"></span>
                        <span class="cropper-center"></span>
                        <span class="cropper-face cropper-move"></span>
                        <span class="cropper-line line-e cropper-hidden" data-action="e"></span>
                        <span class="cropper-line line-n cropper-hidden" data-action="n"></span>
                        <span class="cropper-line line-w cropper-hidden" data-action="w"></span>
                        <span class="cropper-line line-s cropper-hidden" data-action="s"></span>
                        <span class="cropper-point point-e cropper-hidden" data-action="e"></span>
                        <span class="cropper-point point-n cropper-hidden" data-action="n"></span>
                        <span class="cropper-point point-w cropper-hidden" data-action="w"></span>
                        <span class="cropper-point point-s cropper-hidden" data-action="s"></span>
                        <span class="cropper-point point-ne cropper-hidden" data-action="ne"></span>
                        <span class="cropper-point point-nw cropper-hidden" data-action="nw"></span>
                        <span class="cropper-point point-sw cropper-hidden" data-action="sw"></span>
                        <span class="cropper-point point-se cropper-hidden" data-action="se"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--弹出的解释说明-->
<div class="js_dialog" style="display:none;">
    <div class="appui-mask"></div>
    <div class="appui-helptext bg-white" id="helptext1" style="display:none;">
        <h2 class="appui-helptext-hd fs32 fc-black b-b-grey">收费规则</h2>
        <div class="appui-helptext-bd fc-black456 b-b-grey">
            <div class="appui-helptext-bd-con">
                <p class="fs30 mb10">若用户使用提问券提问，则该次回答收益不超过<span>10</span>元。</p>
            </div>
        </div>
        <h2 class="appui-helptext-fd fs32 fc-orange">知道了</h2>
    </div>
    <div class="appui-helptext bg-white" id="helptext2" style="display:none;">
        <h2 class="appui-helptext-hd fs32 fc-black b-b-grey">追问规则</h2>
        <div class="appui-helptext-bd fc-black456 b-b-grey">
            <div class="appui-helptext-bd-con">
                <p class="fs30 mb10">您回答一个问题后，提问者可以向您免费“追问”。</p>
                <p class="fs30 mb10">开启免费追问，进一步增加您与提问者的交流机会，使问答体验更加完整。</p>
            </div>
        </div>
        <h2 class="appui-helptext-fd fs32 fc-orange">知道了</h2>
    </div>
    <div class="appui-helptext bg-white" id="helptext3" style="display:none;">
        <h2 class="appui-helptext-hd fs32 fc-black b-b-grey">免费规则</h2>
        <div class="appui-helptext-bd fc-black456 b-b-grey">
            <div class="appui-helptext-bd-con">
                <p class="fs30 mb10">回答问题后前<span>10</span>次开放给他人免费听，即有机会登上首页精选。</p>
            </div>
        </div>
        <h2 class="appui-helptext-fd fs32 fc-orange">知道了</h2>
    </div>
    <div class="appui-helptext bg-white" id="helptext4" style="display:none;">
        <h2 class="appui-helptext-hd fs32 fc-black b-b-grey">开放规则</h2>
        <div class="appui-helptext-bd fc-black456 b-b-grey">
            <div class="appui-helptext-bd-con">
                <p class="fs30 mb10">欢迎您加入问房知识开放计划，让您的连珠妙语使更多人受益！加入本计划后：</p>
                <p class="fs30 mb10">1. 您回答时间超过<span>30</span>天的问题，可被免费听。</p>
                <p class="fs30 mb10">2. 您的回答的问题，将获得更多问房推广资源，包括：问房首页、问房公众号、合作伙伴外网推荐位等等。</p>
                <p class="fs30 mb10">3. 您可随时选择退出本计划，恢复付费状态。</p>
            </div>
        </div>
        <h2 class="appui-helptext-fd fs32 fc-orange">知道了</h2>
    </div>
    <div class="appui-helptext bg-white" id="helptext5" style="display:none;">
        <h2 class="appui-helptext-hd fs32 fc-black b-b-grey">问房认证用户管理条例</h2>
        <div class="appui-helptext-bd fc-black456 b-b-grey">
            <div class="appui-helptext-bd-con">
                <p class="fs30 mb10 fc-black fwb">第一章 一般规定</p>
                <p class="fs30 mb10 mt5">第一条、问房根据现行法律法规及《问房社区发布规则》，制定本规定。</p>
                <p class="fs30 mb10 mt5">第二条、本规定所称个人认证用户是指经问房审核后，拥有问房认证标识的问房行家。</p>
                <p class="fs30 mb10 mt20 fc-black fwb">第二章 个人认证的获取</p>
                <p class="fs30 mb10 mt5">第三条、同时符合下列条件的问房用户可申请成为个人认证用户：</p>
                <p class="fs30 mb10">(一) 拥有个人问房帐号；</p>
                <p class="fs30 mb10">(二) 在问房完成手机绑定；</p>
                <p class="fs30 mb10">(三) 有问答行为且能体现活跃的真实个人。</p>
                <p class="fs30 mb10 mt5">第四条、问房用户可选择下列方式获取个人认证：</p>
                <p class="fs30 mb10">(一) 线上申请：用户通过“认证入口”，提交真实的身份证明、职位证明信息进行申请；</p>
                <p class="fs30 mb10">(二) 专员邀请：由问房专员进行邀请；</p>
                <p class="fs30 mb10">(三) 行家邀请：由在线行家进行邀请。</p>
                <p class="fs30 mb10 mt5">第五条、认证用户信息审核方式：</p>
                <p class="fs30 mb10">(一) 个人验证：由审核专员通过电话或线上工具联系申请者，确认身份信息，如有需要则请申请人补充身份证明材料；</p>
                <p class="fs30 mb10">(二) 联系机构：由审核专员联系当事人所在机构，由该机构出具加盖公章的材料证明申请人身份；</p>
                <p class="fs30 mb10">如果问房认为申请者、已获得个人认证的用户身份存在不实的可能，也会通过上述方式进行查证。</p>
                <p class="fs30 mb10 mt5">第六条、问房通常在1-3个工作日完成审核。无论是否通过，申请者均会收到结果反馈消息。</p>
                <p class="fs30 mb10 mt20 fc-black fwb">第三章 个人认证用户的权责</p>
                <p class="fs30 mb10 mt5">第七条、个人认证用户与普通用户一样，享有《问房用户使用协议》、《问房社区发布规则》赋予的权利与义务。</p>
                <p class="fs30 mb10 mt5">第八条、个人认证用户拥有V认证标识。</p>
                <p class="fs30 mb10 mt5">第九条、个人认证用户拥有认证说明信息并在页面公开展示，个人认证用户可申请变更认证说明信息并有义务接受网友监督举报，认证说明信息需经问房审核通过方可变更，审核时间通常为3个工作日。</p>
                <p class="fs30 mb10 mt5">第十条、个人认证用户可变更问房昵称。站方将不定期抽查昵称变更情况，不合理的昵称变更将被修复至变更之前的状态。</p>
                <p class="fs30 mb10 mt20 fc-black fwb">第四章 个人认证的撤销</p>
                <p class="fs30 mb10 mt5">第十一条、在有效期内，用户可以根据个人意愿，主动申请撤销个人认证。申请时需说明撤销理由，经问房审核通过后即可撤销。</p>
                <p class="fs30 mb10 mt5">第十二条、两种情况下，机构可干涉其雇员、成员的认证说明：</p>
                <p class="fs30 mb10">(一) 机构出具加盖公章的材料，证明当事人已非该机构雇员、成员。</p>
                <p class="fs30 mb10">(二) 机构出具加盖公章的材料，证明当事人确系该机构雇员、成员，且其发布的言论已构成对影响该机构合理声誉。</p>
                <p class="fs30 mb10">如当事人在变更认证说明后已不符合个人认证要求，问房将做出撤销个人认证的处理。</p>
                <p class="fs30 mb10 mt5">第十三条、已取得个人认证的用户存在下述情况的，站方有权随时撤销个人认证：</p>
                <p class="fs30 mb10">(一) 经站方查证所认证身份虚假的；</p>
                <p class="fs30 mb10">(二) 认证帐户发布虚假活动的；</p>
                <p class="fs30 mb10">(三) 多次出现昵称不合理情况的；</p>
                <p class="fs30 mb10">(四) 严重违反《社区发布规则》的；</p>
                <p class="fs30 mb10">(五) 其他不符合个人认证标准的情况。</p>
                <p class="fs30 mb10 mt20 fc-black fwb">第五章 附则</p>
                <p class="fs30 mb10 mt5">第十四条、本规定自2016年1月17日起施行。</p>
                <p class="fs30 mb10 mt5">第十五条、问房拥有最终解释及执行的权利。</p>
            </div>
        </div>
        <h2 class="appui-helptext-fd fs32 fc-orange">知道了</h2>
    </div>
    <div id="scanMe" class="bg-white" style="display: none;">
        <div class="outer">
            <h3 class="fs40 fc-blue">认证提交成功!</h3>
            <p class="scan-title fs30">关注“问房”官方公众号
                <br>第一时间收到粉丝的提问</p>
            <img src="../bdt/images/wenfangba.jpg?v=20170221161736" alt="">
            <p class="scan-cheerup fs26">关注"问房吧"，可领<span class="fc-red">优惠券</span></p>
            <p class="scan-longtap fs32">长按，识别二维码，加关注</p>
            <a class="fs26 fc-blue" href="index.html">不了,去首页</a>
        </div>
    </div>
</div>
<script>
    $('.qanda-certify-rights div a').each(function(index, element) {
        $(this).click(function(e) {
            var id = index + 1;
            setTimeout(function() {
                $('.js_dialog').show();
                $('#helptext' + id).show();
                //alert(Math.floor($('body').height()*0.70));
                $('#helptext' + id).css('margin-top', -$('#helptext' + id).height() / 2);
                if ($('#helptext' + id).height() >= Math.floor($('body').height() * 0.70)) {
                    $('#helptext' + id).find('.appui-helptext-bd').height($('#helptext' + id).height() - $('.appui-helptext-hd').height() - $('.appui-helptext-fd').height());
                }
            }, 1000);

        });
    });

    $('#manage-text').click(function(e) {
        var id = 5;
        setTimeout(function() {
            $('.js_dialog').show();
            $('#helptext' + id).show();
            //alert(Math.floor($('body').height()*0.70));
            $('#helptext' + id).css('margin-top', -$('#helptext' + id).height() / 2);
            if ($('#helptext' + id).height() >= Math.floor($('body').height() * 0.70)) {
                $('#helptext' + id).find('.appui-helptext-bd').height($('#helptext' + id).height() - $('.appui-helptext-hd').height() - $('.appui-helptext-fd').height());
            }
        }, 1000);
    });

    $('.appui-helptext-fd').each(function(index, element) {
        $(this).click(function(e) {
            var id = index + 1;
            $('.js_dialog').hide();
            $('#helptext' + id).hide();
            $('#helptext' + id).css({
                'margin-top': '0',
                'height': 'auto'
            });
        });
    });
</script>



</body>
