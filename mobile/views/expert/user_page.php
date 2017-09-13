<body>
<script type="text/javascript" src="../bdt/js/user_page.js"></script>
<div id="container" class="container userpage-container bg-greyf1">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd fc-white scrollhd">
            <div class="statebar">
                <a class="nav-act left-act" onclick="goBack();">
                    <img src="../bdt/images/nav_icon_back.png"></a>
                <h2 id="homePame" class="fs34" style="display:none;"><?=$info['user']['nickname']?>的主页</h2>
            </div>
        </div>

        <!--页面主体-->
        <div class="page__bd scrollbd" id="page__bd">
            <!--行家信息-->
            <?php if($info):?>
            <div class="expert-pagehead bg-white">
                <div class="expert-pagehead-cover" id="bgImg">
                    <img src="../bdt/images/headbg.jpg"></div>
                <div class="expert-pagehead-detail">
                    <div class="expert-pagehead-basicinfo">
							<span class="expert-pagehead-picture" id="userImg">
							<img src="<?=Yii::$app->params['public'].'/attachment'.$info['user']['photo']?>"></span>
                        <a class="expert-pagehead-askbtn bg-red fc-white fs24" id="question" style="" href="/questions/wen_questions.html?id=<?=$info['user']['id']?>">向<?php if($info['user']['sex'] == 1):?>他<?php else:?>她<?php endif;?><br>提问</a>
                        <h3 class="expert-pagehead-name fs34 fc-black mt5" id="userName">
                            <span><?=$info['user']['nickname']?></span>
                                <?php if($info['user']['vip'] == 1):?>
                            <i><img src="../bdt/images/v2.png"></i>
                            <?php endif;?>
                        </h3>
                        <div class="expert-pagehead-tags appui-expert-tags fs18 fc-greyabc mt5">
                            <p class="appui-expert-tags-industry">
                                <?php if($tags):?>
                                <?php foreach($tags as $k=>$v):?>
                                <span>投资</span>
                                <?php endforeach;?>
                                <?php endif;?>
                            </p><p class="appui-expert-tags-address">
                                <span><?=$info['des']?></span>
                            </p></div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="expert-pagehead-introduce fc-black fs20 mt15" id="masterInfo"><?=$info['des']?></p>
                    <div class="expert-pagehead-fans mt15" id="focusDiv">
                        <span><i class="fs20 fc-greyabc">关注</i><i class="fs24 fc-black" ><?=$getNums?></i></span>
                        <i class="bg-greyd mr10 ml10"></i>
                        <span><i class="fs20 fc-greyabc">粉丝</i><i class="fs24 fc-black" id="fansCountNums"><?=$fansNums?></i></span>
                        <?php if($circleId):?>
                        <a class="fs24 bc-blue fc-blue ml10" href="/circle/circle_page.html?id=<?=$circleId?>">进入圈子</a>
                        <?php endif;?>
                        <a class="bc-blue fc-blue fs24" onclick="facus(<?=$member_id?>,<?=$info['user']['id']?>)" id="focus">
                            <?php if($foucs):?>已关注<?php else:?>关注<? endif;?>
                        </a>
                    </div>
                </div>
            </div>
            <?php else:?>
<!-- 非行家-->
                <div class="expert-pagehead bg-white">
                    <div class="expert-pagehead-cover" id="bgImg">
                        <img src="../bdt/images/headbg.jpg"></div>
                    <div class="expert-pagehead-detail">
                        <div class="expert-pagehead-basicinfo">
							<span class="expert-pagehead-picture" id="userImg">
							<img src="<?=Yii::$app->params['public'].'/attachment'.$member['photo']?>"></span>
                            <h3 class="expert-pagehead-name fs34 fc-black mt5" id="userName">
                                <span><?=$member['nickname']?></span>
                            </h3>
                        </div>
                        <div class="clearfix"></div>
                        <p class="expert-pagehead-introduce fc-black fs20 mt15" id="masterInfo"><?=$member['slogan']?></p>
                        <div class="expert-pagehead-fans mt15" id="focusDiv">
                            <span><i class="fs20 fc-greyabc">关注</i><i class="fs24 fc-black" id="focusCount"><?=$getNums?></i></span>
                            <i class="bg-greyd mr10 ml10"></i>
                            <span><i class="fs20 fc-greyabc">粉丝</i><i class="fs24 fc-black" id="fansCountNums"><?=$fansNums?></i></span>
                            <a class="bc-blue fc-blue fs24" onclick="facus(<?=$member_id?>,<?=$member['id']?>)" id="focus"><?php if($foucs):?>已关注<?php else:?>关注<? endif;?></a>
                        </div>
                    </div>
                </div>
            <?php endif;?>

            <!--行家主页分类导航-->
            <div class="expert-pagenavbar bg-greyf1 fs24" style="display:none;">
                <span class="pagenav pagenav0" id="fanCoil" style="display:none;">圈子<i class="bg-red" style="display:none;"></i></span>
                <span class="pagenav pagenav1 fwb" id="column">专栏<i class="bg-red" style="display: block;"></i></span>
                <!-- 	<a>最新</a>
                    <i class="bg-greyd mr10 ml10"></i>
                    <a class="fc-red">精选</a> -->
            </div>

            <div class="expert-pages bg-greyf1 mt10" id="expert-pages">
                <div class="f-f-module mb10 bg-white">
                    <div class="find-container">
                        <div class="find-header">
                            <div class="f-h-left">
                                <a href="/questions/qanda_detail.html">
                                    <img src="../bdt/images/user_3994_80.jpg"><i><img src="../bdt/images/v2.png"></i></a>
                                <div class="f-h-middle">
                                    <span class="fs30 fc-blue operate" onclick="gotoUser_pageHtml(3994);">张百忍</span>
                                    <span class="fs22 publish-time fc-black456">2个小时前</span></div></div>
                            <div class="f-h-right"><span class="pubtype fc-greyabc fs32"><i>·</i>
                                    <em class="fs24">回答</em><i>·</i></span></div></div>
                        <div class="module-content mt10" id="contentDiv3820" onclick="gotoQADetailHtml(3820)">
                            <div class="appui-qanda-question">即墨创智新区新兴中心城的洋房怎么样，能点评下吗，现在居然有卖到一万一的，是否可以入手？谢谢</div>
                            <div class="appui-qanda-answer">
                                <div class="appui-qanda-answerstyle voice free" id="a_play_0_3820"><i></i>
                                    <span class="appui_qanda-voice-wave"><em class="wave1"></em><em class="wave2"></em><em class="wave3"></em></span><em class="tips">免费收听</em>
                                    <span class="appui_qanda-voice-wait" style="display:none;"></span></div>
                                <em class="appui-qanda-answer-time">57"</em>
                            </div></div>
                        <div class="time-statistic fs22">
                            <!--<div>文章来源-暂无</div>-->
                            <span class="fc-greyabc"><i>44</i>收听</span>
                            <span class="fc-red"></span>
                            <div class="statistic">
                                <a class="like fc-greyabc " onclick="dianzanClick(3820,2)" id="dianzan3820">0</a>
                                <a class="comment ml10 fc-greyabc" id="pinglun_3820" onclick="pubcommentClick(3820,3820,2)">0</a>
                                <span class="show-comment ml10" id="showComment_3820" onclick="showCommentList(3820,2,0);" style="opacity: 0.15;">
                                    <img src="../bdt/images/up_more.png"></span></div></div></div><div class="dynamic-comment bg-greyfa" style="display:none;" id="commentDiv_3820"></div></div>
                <div class="f-f-module mb10 bg-white">
                    <div class="find-container"><div class="find-header">
                            <div class="f-h-left">
                                <a onclick="gotoUser_pageHtml(3994);">
                                    <img src="../bdt/images/user_3994_80.jpg"><i>
                                        <img src="../bdt/images/v2.png"></i></a>
                                <div class="f-h-middle"><span class="fs30 fc-blue operate" onclick="gotoUser_pageHtml(3994);">张百忍</span><span class="fs22 publish-time fc-black456">2017-05-24</span></div></div><div class="f-h-right"><span class="pubtype fc-greyabc fs32"><i>·</i><em class="fs24">回答</em><i>·</i></span></div></div><div class="module-content mt10" id="contentDiv3604" onclick="gotoQADetailHtml(3604)"><div class="appui-qanda-question">青岛现在在哪买房升值潜力最大?开发区跟城阳？胶南？黄岛？你怎么看？</div><div class="appui-qanda-answer"><div class="appui-qanda-answerstyle voice time" id="a_play_0_3604" onclick="playAudioQaClickFunction(3604,1,1,'a_play_0_3604');"><i></i><span class="appui_qanda-voice-wave"><em class="wave1"></em><em class="wave2"></em><em class="wave3"></em></span><em class="tips">限次收听</em><span class="appui_qanda-voice-wait" style="display:none;"></span></div><em class="appui-qanda-answer-time">52"</em></div></div><div class="time-statistic fs22"><!--<div>文章来源-暂无</div>--><span class="fc-greyabc"><i>5</i>收听</span><span class="fc-red"></span><div class="statistic"><a class="like fc-greyabc " onclick="dianzanClick(3604,2)" id="dianzan3604">1</a><a class="comment ml10 fc-greyabc" id="pinglun_3604" onclick="pubcommentClick(3604,3604,2)">0</a><span class="show-comment ml10" id="showComment_3604" onclick="showCommentList(3604,2,0);" style="opacity: 0.15;"><img src="../bdt/images/up_more.png"></span></div></div></div><div class="dynamic-comment bg-greyfa" style="display:none;" id="commentDiv_3604"></div></div><div class="f-f-module mb10 bg-white"><div class="find-container"><div class="find-header"><div class="f-h-left"><a onclick="gotoUser_pageHtml(3994);"><img src="../bdt/images/user_3994_80.jpg"><i><img src="../bdt/images/v2.png"></i></a><div class="f-h-middle"><span class="fs30 fc-blue operate" onclick="gotoUser_pageHtml(3994);">张百忍</span><span class="fs22 publish-time fc-black456">2017-05-22</span></div></div><div class="f-h-right"><span class="pubtype fc-greyabc fs32"><i>·</i><em class="fs24">发表</em><i>·</i></span></div></div><div id="contentDiv3984" class="module-content mt10" onclick="gotoArticDetailHtml(3984, this);"><h4 class="f-l-height fs30 find-text fwb mb5">青岛人口增长的警钟为谁而鸣？</h4><p class="text-style fs28 fc-black face_tag mb10 hint-more"><a class="fc-blue" href="topic.html#1">#文章#</a>青岛不是一线城市，不是帝都魔都，人口多得要往外撵，刹住商住上万亿的代价，也得把人清出去，青岛需要人口来填充，来消费，这才是这个城市可持续发展的保障。</p></div><div class="time-statistic fs22"><!--<div>文章来源-暂无</div>--><span class="fc-greyabc"><i>574</i>阅读</span><span class="fc-red"></span><div class="statistic"><a class="like fc-greyabc " onclick="dianzanClick(3984,1)" id="dianzan3984">2</a><a class="comment ml10 fc-greyabc" id="pinglun_3984" onclick="pubcommentClick(3984,3984,1)">0</a><span class="show-comment ml10" id="showComment_3984" onclick="showCommentList(3984,1,0);" style="opacity: 0.15;"><img src="../bdt/images/up_more.png"></span></div></div></div><div class="dynamic-comment bg-greyfa" style="display:none;" id="commentDiv_3984"></div></div><div class="f-f-module mb10 bg-white"><div class="find-container"><div class="find-header"><div class="f-h-left"><a onclick="gotoUser_pageHtml(3994);"><img src="../bdt/images/user_3994_80.jpg"><i><img src="../bdt/images/v2.png"></i></a><div class="f-h-middle"><span class="fs30 fc-blue operate" onclick="gotoUser_pageHtml(3994);">张百忍</span><span class="fs22 publish-time fc-black456">2017-05-21</span></div></div><div class="f-h-right"><span class="pubtype fc-greyabc fs32"><i>·</i><em class="fs24">回答</em><i>·</i></span></div></div><div class="module-content mt10" id="contentDiv3423" onclick="gotoQADetailHtml(3423)"><div class="appui-qanda-question hint-more">国家统计局发布：4月青岛刚需房房价下跌，对此你怎么看？个人感觉青岛房价不跌反涨，即墨房子都涨到9000多，看不到跌价的可能？做为刚需一枚，在青岛何处购房？谢谢</div><div class="appui-qanda-answer"><div class="appui-qanda-answerstyle voice time" id="a_play_0_3423" onclick="playAudioQaClickFunction(3423,1,1,'a_play_0_3423');"><i></i><span class="appui_qanda-voice-wave"><em class="wave1"></em><em class="wave2"></em><em class="wave3"></em></span><em class="tips">限次收听</em><span class="appui_qanda-voice-wait" style="display:none;"></span></div><em class="appui-qanda-answer-time">43"</em></div></div><div class="time-statistic fs22"><!--<div>文章来源-暂无</div>--><span class="fc-greyabc"><i>7</i>收听</span><span class="fc-red"></span><div class="statistic"><a class="like fc-greyabc " onclick="dianzanClick(3423,2)" id="dianzan3423">2</a><a class="comment ml10 fc-greyabc" id="pinglun_3423" onclick="pubcommentClick(3423,3423,2)">0</a><span class="show-comment ml10" id="showComment_3423" onclick="showCommentList(3423,2,0);" style="opacity: 0.15;"><img src="../bdt/images/up_more.png"></span></div></div></div><div class="dynamic-comment bg-greyfa" style="display:none;" id="commentDiv_3423"></div></div><div class="f-f-module mb10 bg-white"><div class="find-container"><div class="find-header"><div class="f-h-left"><a onclick="gotoUser_pageHtml(3994);"><img src="../bdt/images/user_3994_80.jpg"><i><img src="../bdt/images/v2.png"></i></a><div class="f-h-middle"><span class="fs30 fc-blue operate" onclick="gotoUser_pageHtml(3994);">张百忍</span><span class="fs22 publish-time fc-black456">2017-05-19</span></div></div><div class="f-h-right"><span class="pubtype fc-greyabc fs32"><i>·</i><em class="fs24">回答</em><i>·</i></span></div></div><div class="module-content mt10" id="contentDiv3356" onclick="gotoQADetailHtml(3356)"><div class="appui-qanda-question">从投资角度看，环湾区龙湖艳澜海岸现在值得入手吗，还是买中欧国际城。这俩个跟沧口区域比哪个升值潜力大？</div><div class="appui-qanda-answer"><div class="appui-qanda-answerstyle voice time" id="a_play_0_3356" onclick="playAudioQaClickFunction(3356,1,1,'a_play_0_3356');"><i></i><span class="appui_qanda-voice-wave"><em class="wave1"></em><em class="wave2"></em><em class="wave3"></em></span><em class="tips">限次收听</em><span class="appui_qanda-voice-wait" style="display:none;"></span></div><em class="appui-qanda-answer-time">56"</em></div></div><div class="time-statistic fs22"><!--<div>文章来源-暂无</div>--><span class="fc-greyabc"><i>9</i>收听</span><span class="fc-red"></span><div class="statistic"><a class="like fc-greyabc " onclick="dianzanClick(3356,2)" id="dianzan3356">4</a><a class="comment ml10 fc-greyabc" id="pinglun_3356" onclick="pubcommentClick(3356,3356,2)">0</a><span class="show-comment ml10" id="showComment_3356" onclick="showCommentList(3356,2,0);" style="opacity: 0.15;"><img src="../bdt/images/up_more.png"></span></div></div></div><div class="dynamic-comment bg-greyfa" style="display:none;" id="commentDiv_3356"></div></div><div class="f-f-module mb10 bg-white"><div class="find-container"><div class="find-header"><div class="f-h-left"><a onclick="gotoUser_pageHtml(3994);"><img src="../bdt/images/user_3994_80.jpg"><i><img src="../bdt/images/v2.png"></i></a><div class="f-h-middle"><span class="fs30 fc-blue operate" onclick="gotoUser_pageHtml(3994);">张百忍</span><span class="fs22 publish-time fc-black456">2017-05-19</span></div></div><div class="f-h-right"><span class="pubtype fc-greyabc fs32"><i>·</i><em class="fs24">发表</em><i>·</i></span></div></div><div id="contentDiv3832" class="module-content mt10" onclick="gotoArticDetailHtml(3832, this);"><h4 class="f-l-height fs30 find-text fwb mb5">青岛房价回落的最大希望在这里</h4><p class="text-style fs28 fc-black face_tag mb10"><a class="fc-blue" href="topic.html#1">#文章#</a>青岛楼市三月的两次调控之后，比价宽松的政策，让大家感到总体上是虚惊一场。</p><div class="pic-layout message-pic-1-style mb5"><i><img src="/data/article_pic/weixin_XrmqsH-GuKG4YytpQgetAA/0_one.jpg"></i></div></div><div class="time-statistic fs22"><!--<div>文章来源-暂无</div>--><span class="fc-greyabc"><i>90</i>阅读</span><span class="fc-red"></span><div class="statistic"><a class="like fc-greyabc " onclick="dianzanClick(3832,1)" id="dianzan3832">6</a><a class="comment ml10 fc-greyabc" id="pinglun_3832" onclick="pubcommentClick(3832,3832,1)">0</a><span class="show-comment ml10" id="showComment_3832" onclick="showCommentList(3832,1,0);" style="opacity: 0.15;"><img src="../bdt/images/up_more.png"></span></div></div></div><div class="dynamic-comment bg-greyfa" style="display:none;" id="commentDiv_3832"></div></div><div class="f-f-module mb10 bg-white"><div class="find-container"><div class="find-header"><div class="f-h-left"><a onclick="gotoUser_pageHtml(3994);"><img src="../bdt/images/user_3994_80.jpg"><i><img src="../bdt/images/v2.png"></i></a><div class="f-h-middle"><span class="fs30 fc-blue operate" onclick="gotoUser_pageHtml(3994);">张百忍</span><span class="fs22 publish-time fc-black456">2017-05-18</span></div></div><div class="f-h-right"><span class="pubtype fc-greyabc fs32"><i>·</i><em class="fs24">回答</em><i>·</i></span></div></div><div class="module-content mt10" id="contentDiv3295" onclick="gotoQADetailHtml(3295)"><div class="appui-qanda-question">如今青岛这样的二线城市房子均价都普遍过万了，就连城阳区都一万多了，个人只能接受7000多的住宅，请问去那里购买，推荐几个合适的楼盘？</div><div class="appui-qanda-answer"><div class="appui-qanda-answerstyle voice time" id="a_play_0_3295" onclick="playAudioQaClickFunction(3295,1,1,'a_play_0_3295');"><i></i><span class="appui_qanda-voice-wave"><em class="wave1"></em><em class="wave2"></em><em class="wave3"></em></span><em class="tips">限次收听</em><span class="appui_qanda-voice-wait" style="display:none;"></span></div><em class="appui-qanda-answer-time">55"</em></div></div><div class="time-statistic fs22"><!--<div>文章来源-暂无</div>--><span class="fc-greyabc"><i>4</i>收听</span><span class="fc-red"></span><div class="statistic"><a class="like fc-greyabc " onclick="dianzanClick(3295,2)" id="dianzan3295">0</a><a class="comment ml10 fc-greyabc" id="pinglun_3295" onclick="pubcommentClick(3295,3295,2)">0</a><span class="show-comment ml10" id="showComment_3295" onclick="showCommentList(3295,2,0);" style="opacity: 0.15;"><img src="../bdt/images/up_more.png"></span></div></div></div><div class="dynamic-comment bg-greyfa" style="display:none;" id="commentDiv_3295"></div></div><div class="f-f-module mb10 bg-white"><div class="find-container"><div class="find-header"><div class="f-h-left"><a onclick="gotoUser_pageHtml(3994);"><img src="../bdt/images/user_3994_80.jpg"><i><img src="../bdt/images/v2.png"></i></a><div class="f-h-middle"><span class="fs30 fc-blue operate" onclick="gotoUser_pageHtml(3994);">张百忍</span><span class="fs22 publish-time fc-black456">2017-05-17</span></div></div><div class="f-h-right"><span class="pubtype fc-greyabc fs32"><i>·</i><em class="fs24">回答</em><i>·</i></span></div></div><div class="module-content mt10" id="contentDiv3272" onclick="gotoQADetailHtml(3272)"><div class="appui-qanda-question">请问即墨创智新区的发展前景如何，目前创智新区房价普遍都已八九千，是否有投资潜力？即墨龙泉镇有了一汽入驻，未来房价会如何发展，地铁会延伸到该处吗？</div><div class="appui-qanda-answer"><div class="appui-qanda-answerstyle voice pay" id="a_play_0_3272" onclick="playAudioQaClickFunction(3272,1,1,'a_play_0_3272');"><i></i><span class="appui_qanda-voice-wave"><em class="wave1"></em><em class="wave2"></em><em class="wave3"></em></span><em class="tips">1元收听</em><span class="appui_qanda-voice-wait" style="display:none;"></span></div><em class="appui-qanda-answer-time">57"</em></div></div><div class="time-statistic fs22"><!--<div>文章来源-暂无</div>--><span class="fc-greyabc"><i>10</i>收听</span><span class="fc-red"></span><div class="statistic"><a class="like fc-greyabc " onclick="dianzanClick(3272,2)" id="dianzan3272">5</a><a class="comment ml10 fc-greyabc" id="pinglun_3272" onclick="pubcommentClick(3272,3272,2)">0</a><span class="show-comment ml10" id="showComment_3272" onclick="showCommentList(3272,2,0);" style="opacity: 0.15;"><img src="../bdt/images/up_more.png"></span></div></div></div><div class="dynamic-comment bg-greyfa" style="display:none;" id="commentDiv_3272"></div></div><div class="f-f-module mb10 bg-white"><div class="find-container"><div class="find-header"><div class="f-h-left"><a onclick="gotoUser_pageHtml(3994);"><img src="../bdt/images/user_3994_80.jpg"><i><img src="../bdt/images/v2.png"></i></a><div class="f-h-middle"><span class="fs30 fc-blue operate" onclick="gotoUser_pageHtml(3994);">张百忍</span><span class="fs22 publish-time fc-black456">2017-05-15</span></div></div><div class="f-h-right"><span class="pubtype fc-greyabc fs32"><i>·</i><em class="fs24">发表</em><i>·</i></span></div></div><div id="contentDiv3558" class="module-content mt10" onclick="gotoArticDetailHtml(3558, this);"><h4 class="f-l-height fs30 find-text fwb mb5">崂山区宜家意向地块控规调整公示，这是确定要拿地动工了？</h4><p class="text-style fs28 fc-black face_tag mb10"><a class="fc-blue" href="topic.html#1">#文章#</a></p><div class="pic-layout message-pic-1-style mb5"><i><img src="/data/u3994/html1494839177700__1_one.jpg"></i></div></div><div class="time-statistic fs22"><!--<div>文章来源-暂无</div>--><span class="fc-greyabc"><i>156</i>阅读</span><span class="fc-red"></span><div class="statistic"><a class="like fc-greyabc " onclick="dianzanClick(3558,1)" id="dianzan3558">4</a><a class="comment ml10 fc-greyabc" id="pinglun_3558" onclick="pubcommentClick(3558,3558,1)">0</a><span class="show-comment ml10" id="showComment_3558" onclick="showCommentList(3558,1,0);" style="opacity: 0.15;"><img src="../bdt/images/up_more.png"></span></div></div></div><div class="dynamic-comment bg-greyfa" style="display:none;" id="commentDiv_3558"></div></div><div class="f-f-module mb10 bg-white"><div class="find-container"><div class="find-header"><div class="f-h-left"><a onclick="gotoUser_pageHtml(3994);"><img src="../bdt/images/user_3994_80.jpg"><i><img src="../bdt/images/v2.png"></i></a><div class="f-h-middle"><span class="fs30 fc-blue operate" onclick="gotoUser_pageHtml(3994);">张百忍</span><span class="fs22 publish-time fc-black456">2017-05-15</span></div></div><div class="f-h-right"><span class="pubtype fc-greyabc fs32"><i>·</i><em class="fs24">发表</em><i>·</i></span></div></div><div id="contentDiv3525" class="module-content mt10" onclick="gotoArticDetailHtml(3525, this);"><h4 class="f-l-height fs30 find-text fwb mb5">鳌山湾的水，到底有多深？</h4><p class="text-style fs28 fc-black face_tag mb10 hint-more"><a class="fc-blue" href="topic.html#1">#文章#</a>熟悉军史的人都知道著名的“三湾改编”，就是说毛委员带着一群残兵败卒到了三湾，进行了有效的改编，支部设在连上，然后上了井冈山，打出来一篇新天地。</p></div><div class="time-statistic fs22"><!--<div>文章来源-暂无</div>--><span class="fc-greyabc"><i>313</i>阅读</span><span class="fc-red"></span><div class="statistic"><a class="like fc-greyabc " onclick="dianzanClick(3525,1)" id="dianzan3525">2</a><a class="comment ml10 fc-greyabc" id="pinglun_3525" onclick="pubcommentClick(3525,3525,1)">0</a><span class="show-comment ml10" id="showComment_3525" onclick="showCommentList(3525,1,0);" style="opacity: 0.15;"><img src="../bdt/images/up_more.png"></span></div></div></div><div class="dynamic-comment bg-greyfa" style="display:none;" id="commentDiv_3525"></div></div><a onclick="downloadMoreData(1);" id="downloadMoreData" class="appui_loadmore fs28 fc-greyabc">拼命加载中<i class="loadmore"></i></a></div>

            <div class="bottom-space4"></div>
        </div>

        <!--发布按钮-->
        <a class="publish-btn bg-green" id="sendMessage" style="display:none"><img src="../bdt/images/publish.png?v=20170325001939"></a>

        <a class="add-circle bg-red fc-white fs28" id="addCircleBtn" style="display:none;"><span>￥300</span>加入圈子</a>
    </div>
</div>

<audio id="audio-mc" style="display:none;" preload="preload" src=""></audio>

<!-- 轮播图 -->
<div class="appui-gallery-swiper" id="js-gallery-swiper" style="display: none;">
    <!--图片预览轮播-->
    <!-- swiper-slide-visible swiper-slide-active -->
    <div class="swiper" style="cursor: -webkit-grab;">
        <div class="swiper-wrapper" id="swiper-wrapper">
            <!--  <div class="swiper-slide">
            <img data-src="C:\Users\Administrator\Desktop\2.png" class="swiper-lazy">
            <div class="swiper-lazy-preloader"></div>
        </div> -->
            <!--  <div class="swiper-slide">
            <img data-src="../bdt/images/gallery/gallery2.jpg?v=20161201134425" class="swiper-lazy">
            <div class="swiper-lazy-preloader"></div>
        </div>
        <div class="swiper-slide">
            <div data-background="path/to/picture-3.jpg" class="swiper-lazy">slide3</div>
        </div> -->
            <!-- <a class="swiper-slide" href="javascript:;"><img src="../bdt/images/gallery/gallery1.jpg?v=20161201134425" /></a>
        <a class="swiper-slide" href="javascript:;"><img src="../bdt/images/gallery/gallery2.jpg?v=20161201134425" /></a>
        <a class="swiper-slide" href="javascript:;"><img src="../bdt/images/gallery/gallery3.jpg?v=20161201134426" /></a> -->
        </div>
        <div class="pagination">
            <span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span>
            <span class="swiper-pagination-switch"></span>
            <span class="swiper-pagination-switch"></span>
            <span class="swiper-pagination-switch"></span>
        </div>
    </div>
</div>

<script>
    $('.dynamic-link').each(function(index, element) {
        $(this).find('span').css('margin-top',-$(this).find('span').height()/2)
    });

    $('.page__bd').scroll(function() {
        // 当滚动到最底部以上161像素时， 给头部导航栏添加暗蓝色背景
        if ($(this).scrollTop() >= 150) {
            $(".userpage-container .page__hd").addClass("bg-white b-b-grey");
            $(".userpage-container .page__hd h2").fadeIn().addClass('fc-black');
            $(".userpage-container .page__hd .statebar .left-act img").attr('src','../bdt/images/nav_icon_back1.png');
            $(".userpage-container .page__hd .statebar .right-act img").attr('src','../bdt/images/nav_icon_share1.png');
        }else{
            $(".userpage-container .page__hd").removeClass("bg-white b-b-grey");
            $(".userpage-container .page__hd h2").fadeOut().removeClass('fc-black');
            $(".userpage-container .page__hd .statebar .left-act img").attr('src','../bdt/images/nav_icon_back.png');
            $(".userpage-container .page__hd .statebar .right-act img").attr('src','../bdt/images/nav_icon_share.png');
        }
    })
</script>

</body>