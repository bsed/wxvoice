<?php
use common\tools\htmls;
?>
<link type="text/css" rel="stylesheet" href="../bdt/css/professList.css">
<link type="text/css" rel="stylesheet" href="../bdt/css/circle.css">
<script type="text/javascript" src="../bdt/js/searchCommon.js"></script>
<script type="text/javascript" src="../bdt/js/keys.js"></script>
<body>
<div class="search-container bg-grey" id="container">
    <audio id="audio-mc" preload="preload" src=""></audio>
    <div id="page">
        <div class="page__hd page__hd-search b-b-grey bg-white scrollhd">
            <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png"></a>
            <div class="search-module search-page-use">
                <span><img src="../bdt/images/search.png"></span>
                <em class="bg-blue"></em>
                <input type="text" class="fc-blue fs28" placeholder="请输入要搜索的内容" id="searchText">
            </div>
            <a class="search-btn bg-red fc-white fs28" id="searchBtn">搜索</a>
        </div>
        <div class="page__bd scrollbd bg-grey" id="page__bd">
            <div class="top-space7"></div>
            <!--热门搜索-->
            <div class="search-hot mt10 bg-white" style="display: none;" id="hotLabel">
                <h3 class="fs28 fc-black">热门搜索</h3>
                <div class="search-hot-list fs28 fc-black456">
                    <span class="bg-greyf1">云杉郡</span>
                    <span class="bg-greyf1">大老哥</span>
                    <span class="bg-greyf1">Mr.</span>
                    <span class="bg-greyf1">上海</span>
                    <span class="bg-greyf1">杭州</span>
                    <span class="bg-greyf1">和昌府</span>
                    <span class="bg-greyf1">青岛</span>
                    <span class="bg-greyf1">调控</span>
                    <span class="bg-greyf1">税费</span>
                    <span class="bg-greyf1">张百忍</span>
                </div>
            </div>
            <?php if($expert):?>
            <!--搜索结果推荐-行家-->
            <div class="search-resault bg-white" id="search-resault-expert" style="display:block;">
                <h3 class="fs28 fc-black b-b-grey">行家
                    <a class="fs24 fc-blue b-t-grey" onclick="seeMoreExpert()" style="display:block;">

                        <i><img src="../bdt/images/search.png"></i>
                        <span>查看更多行家</span>
                        <i><img src="../bdt/images/go.png"></i>
                    </a>
                </h3>
                <div class="search-resault-list fs28 fc-black456 bg-grey professList" id="searchExpert">
                <?php foreach($expert as $k=>$v):?>
                    <div class="appui-expert bg-white">
                            <div class="appui-expert-headpic-level">
                                <img class="appui-expert-headpic" src="<?=Yii::$app->params['public'].'/attachment'.$v['photo']?>"><i>
                                    <img src="../bdt/images/v2.png"></i>
                            </div>
                            <div class="appui-expert-info">
                                <a class="appui-expert-askbtn fs24 fc-white "  onclick="askExpert(<?=$v['id']?>)">
                                    <?php if($v['expert']['price'] == '0.00'):?>
                                    免费提问
                                   <?php else:?>
                                        <?=$v['expert']['price']?>元提问
                                     <?php endif;?>
                                </a>
                                <h3 class="appui-expert-name fs30 fc-black"><?=$v['nickname']?></h3>
                                <p class="appui-expert-introduce fs24 fc-grey666 mt5"><?=$v['slogan']?></p>
                                <div class="appui-expert-tags fs18 mt5 fc-greyabc">
                                    <p class="appui-expert-tags-industry">
                                        <span>投资</span>
                                        <span>政策</span>
                                        <span>学区</span></p>
                                        <!--<span style="display:block">530个动态</span>-->
                                </div>
                            </div>
                    </div>
                    <?php endforeach;?>
                </div>
                <script>
                    function askExpert(id){
                        window.location.href='/questions/wen_questions.html?id='+id+'&from=found&publishtype=ask';
                    }
                </script>
            </div>
            <?php endif;?>
            <?php if($circle):?>
            <!--搜索结果推荐-圈子-->
            <div class="search-resault bg-white mt10" id="search-resault-circle" style="display:block;">
                <h3 class="fs28 fc-black b-b-grey">圈子
                    <a class="fs24 fc-blue b-t-grey"  style="display:none;">
                        <i><img src="../bdt/images/search.png"></i>
                        <span>查看更多圈子</span>
                        <i><img src="../bdt/images/go.png"></i>
                    </a>
                </h3>
                <div class="search-resault-list bg-grey fs28 fc-black456 circleList">
                    <?php foreach($circle as $k=>$v):?>
                        <div class="circle-item-x bg-white fc-black mb10">
                            <a class="circle-headpic">
                                <img src="../bdt/images/default.jpg"></a>
                            <div class="circle-info">
                                <a class="goto-circle fs24 bc-green fc-green" href="/circle/circle_page.html?id=<?=$v['id']?>" style="display:block" >去逛逛</a>
                                <h3 class="circle-info-name fs30 fc-black"><?=$v['name']?></h3>
                                <p class="circle-info-canshu fs20 fc-grey999">
                                    <span>圈主:<?=$v['user']['nickname']?></span>
                                    <span class="ml<?=$v['id']?>">成员:<em><?=count($v["incircle"])?></em>人</span>
                                </p>
                                <p class="circle-info-introduce fs24 fc-grey666 mt5"><?=$v['user']['slogan']?></p>
                            </div>
                        </div>
                    <?php endforeach;?>

                </div>
            </div>
            <?php endif;?>
            <?php if($ask):?>
            <!--搜索结果推荐-问答-->
            <div class="search-resault bg-white mt10" id="search-resault-qanda" style="display:block;">
                <h3 class="fs28 fc-black b-b-grey">问答
                    <a class="fs24 fc-blue b-t-grey" onclick="seeMoreQue()" style="">
                        <i><img src="../bdt/images/search.png"></i>
                        <span>查看更多问答</span>
                        <i><img src="../bdt/images/go.png"></i>
                    </a>
                </h3>
                <div class="search-resault-list bg-grey fs28 fc-black456 qandaList">
                    <?php foreach($ask as $k=>$v):?>
                    <div class="appui-qanda-module mb10" onclick="gotoQADetailHtml1(<?=$v['id']?>,0,'undefined', this)">
                        <div class="appui-qanda-question"><?=$v['question']?></div>
                        <div class="appui-qanda-answer"><div class="appui-qanda-expertphoto" onclick="gotoUser_pageHtml(1)">
                                <img src="<?=Yii::$app->params['public'].'/attachment'.$v['expert']['photo']?>">
                                <i class="appui-userlevel bc-white">
                                    <img src="../bdt/images/v2.png"></i></div>
                            <div class="appui-qanda-answerstyle voice free" id="a_play_0_<?=$v['id']?>" onclick="playAudioQaClickFunction(<?=$v['id']?>,1,1,'a_play_0_<?=$v['id']?>');">
                                <i></i>
                                <span class="appui_qanda-voice-wave">
						<em class="wave1"></em><em class="wave2"></em>
						<em class="wave3"></em></span>
                                <em class="tips">免费收听</em>
                                <span class="appui_qanda-voice-wait" style="display:none;"></span></div>
                            <em class="appui-qanda-answer-time">180"</em></div>
                        <div class="appui-qanda-expertinfo"><div class="appui-qanda-expertinfo">
                                <div class="time-statistic fs22" id="bottom_1_80">
                                    <span class="fc-greyabc mr10 "><i><?=htmls::formatTime($v['created']);?></i></span>
                                    <span class="fc-greyabc"><i><?=$v['views']?></i>阅读</span>
                                    <span class="fc-red"></span><div class="statistic">
                                        <a class="like fc-greyabc <?php if(htmls::dianzan($v['id'])):?>on fc-red<?php endif;?>" onclick="dianzanClick(<?=$v['id']?>,1,<?=$mid;?>)" id="dianzan<?=$v['id']?>"><?=count($v['dianzan'])?></a>
                                        <a class="comment ml10 fc-greyabc" id="pinglun_<?=$v['id']?>"><?=count($v['comment'])?></a>
                                    </div></div></div></div>
                    </div>
                    <?php endforeach;?>

                </div>
            </div>
            <?php endif;?>
            <script>
                function seeMoreExpert(){
                    window.location.href = "/expert/found_expert.html";
                }
                function seeMoreLoupan(){
                    window.location.href = "/loupan/loupan_list.html";
                }
                function seeMoreCircle(){
                    window.location.href = "/expert/found_expert.html";
                }
                function seeMoreQue(){
                    window.location.href = "/questions/qanda.html";
                }
                //点赞点踩界面
                var ddClick = false;
                function dianzanClick(id,type, mid){
                    if(mid == undefined){
                        dataLoading("请先登录");
                        window.location.href="/members/login.html";
                        return false;
                    }
                    if (ddClick==false) {
                        ddClick=true;
                        if ($('#dianzan'+id).hasClass("on")) {
                            zanOrCaiRequest(0, 1,id);
                        }else{
                            zanOrCaiRequest(1, 1,id);
                        }
                    }
                }
                //data:{"articleId":1,"type":"0-取消操作，1-执行操作","status":"0-踩，1-点赞","userId":"userId"}
                function zanOrCaiRequest(type, status, id) {
                    //currAttitude：0-当前是踩，1-赞，2-无表示
                    var csrf = $('input[name="csrf"]').val();
                    $.ajax({
                        type: "post",
                        url: '/dianzan/dianzan.html',
                        dataType: "json",
                        async: true,
                        data: {
                            "question_id": id,
                            "type": type,
                            "_csrf": csrf,
                        },
                        success: function(result) {
                            ddClick = false;
                            if (result.result == "success") {
                                //"data":{"currStatus":"当前态度：0-踩，1-点赞，2-无表情","totLikes":"总点赞人数","totOppose":"总点踩人数"}
                                var zanCount = $('#dianzan'+id).html();
                                if (result.data.currStatus==1) {
                                    $('#dianzan'+id).addClass('on fc-red');
                                    dataLoadedSuccess("点赞成功");
                                    $('#dianzan'+id).text(parseInt(zanCount)+1);
                                }else if (result.data.currStatus==0) {
                                    dataLoadedSuccess("点踩成功");
                                    $('#dianzan'+id).text(parseInt(zanCount)-1);
                                    $('#dianzan'+id).removeClass('on fc-red');
                                }
                            }
                        }
                    });


                }
            </script>
        </div>
    </div>
</div>
</body>