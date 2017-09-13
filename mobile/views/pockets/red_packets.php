<body class="bg-greyfa">
<script type="text/javascript" src="../bdt/js/red_packets.js"></script>
<div id="container" class="container">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd scrollhd">
            <div class="statebar">
                <a class="nav-act left-act" onclick="goBack()">
                    <img src="../bdt/images/nav_icon_back.png">
                </a>
                <h2 class="fs34 fc-white" style="font-weight:600">红包</h2>
                <a class="nav-act right-act fs24 fc-white" id="redPacketRule">规则</a>
            </div>
        </div>
        <div class="page__bd redpacketbg">
            <div class="red_packets">
                <div class="rp_button" style="margin-top: 320px;">
                    <a onclick="gotoRed_packets_fightluckHtml(1)" class="fs36">给粉丝发红包</a>
                    <a onclick="gotoRed_packets_fightluckHtml(2)" class="fs36">给新人发红包</a>
                </div>
                <div class="rp_introduce">
                    <p class="fs28">给你的粉丝，发一些红包互动吧</p>
                    <p class="check-packet fs24" onclick="gotoRed_packets_recordHtml()">查看红包记录</p>
                </div>
            </div>



        </div>

    </div>
</div>
<!--弹出的解释说明-->
<div class="js_dialog" style="display:none;">
    <div class="appui-mask"></div>
    <div class="appui-helptext bg-white" id="helptext" style="display:none;">
        <h2 class="appui-helptext-hd fs32 fc-black b-b-grey">发红包规则</h2>
        <div class="appui-helptext-bd fc-black456 b-b-grey">
            <div class="appui-helptext-bd-con fc-black">
                <p class="fs30 mb10 fwb">1、如何领取红包？</p>
                <p class="fs30 mb20">点击广场中的红包Card，进入红包领取页，红包领取成功。</p>
                <p class="fs30 mb10 fwb">2、没有领取完的红包怎么处理？</p>
                <p class="fs30 mb20">红包自生成当天起，有效期为7天，如果超过7天未被成功领取的金额，将原路退回；已被好友领取成功的红包金额将无法退回。</p>
                <p class="fs30 mb10 fwb">3、发送红包的限额是多少？</p>
                <p class="fs30 mb10">拼手气红包：一次最多可以包200个子红包，所包的红包总上限金额为2000元。</p>
                <p class="fs30 mb20">定额红包：单个红包的金额最大为200元，最多200个小红包，总金额不得超过2000元。</p>
                <p class="fs30 mb10 fwb">4、什么是粉丝红包？</p>
                <p class="fs30 mb20">粉丝红包：选择粉丝红包后，领取红包的用户都会成为红包发放者的粉丝。</p>
                <p class="fs30 mb10 fwb">5、什么是新手红包？</p>
                <p class="fs30 mb30">新手红包主要适用于尚未领取过新手红包的用户且首次授权微信平台登录的时间不超过72小时。</p>
                <p class="fs30 mb10 fwb">发红包规则最终解释权归杭州麦粒网络科技有限公司所有。</p>
            </div>
        </div>
        <h2 class="appui-helptext-fd fs32 fc-orange">知道了</h2>
    </div>
</div>
<script>
    $('#redPacketRule').click(function(e) {
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

    $('.rp_button').css('margin-top',$('#container').width()*0.8);
</script>


</body>