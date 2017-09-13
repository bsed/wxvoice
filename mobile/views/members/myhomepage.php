<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\tools\htmls;

$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript" src="../bdt/js/myhomepage.js"></script>
<body class="bg-white">
<div id="container" class="container myhomepage-container bg-white">
    <div id="page">
        <!--页面导航栏-->
        <div class="page__hd bg-white fc-blue b-b-grey has-tab scrollhd">
            <div class="statebar">
                <a class="nav-act left-act" onclick="goBack();"><img src="../bdt/images/nav_icon_back1.png"></a>
                <div class="tab-btn fs30 tab-btn-two" id="myhomepageTab">
                    <a class="fc-blue" onclick="categoryListFunction(0);">我答</a>
                    <a class="fc-white bg-blue" onclick="categoryListFunction(1);">我问</a>
                   <!--<a class="fc-blue" onclick="categoryListFunction(2);">我听</a>-->
                </div>
                <a class="nav-act right-act" id="page-act"><img src="../bdt/images/nav_icon_publish.png"></a>
            </div>
        </div>
        <div class="clear"></div>

        <!--页面主体-->
        <div class="page__bd mb10 bg-greyfa scrollhd">
            <!--占位空间-->
            <div class="top-space4"></div>


            <div class="homepagelist" id="homepage0" style="top: 0px; display: none;">
                <div class="my-qanda">
                    <div class="my-qanda-list" id="answerList">
                        <!--我回答的问题列表-->
                        <?php foreach($answer as $k=>$v):?>
                        <div class="my-qanda-item bg-white mb10" onclick="gotoQanda_recordHtml(<?=$v['id']?>,1,0,2)">
                            <div class="my-qanda-item-hd"><a><i>
                                        <img src="<?=Yii::$app->params['public'].'/attachment'.$v['user']['photo']?>"><i>
                                            <img src="../bdt/images/v1.png"></i></i>
                                    <span class="fc-navy fs30 ml5"><?=$v['user']['nickname']?></span></a>
                                <span class="fc-blue fs30 ml5">
                                    <?php if($v['status'] == 1):?>
                                        已回答
                                        <?php elseif($v['status'] == 0):?>
                                        待回答
                                        <?php elseif($v['status'] == 1):?>
                                        已失效
                                    <?php endif;?>
                                </span>
                                <div><i class="bg-orange"></i>
                                    <?php if($v['askprice'] == "0.00"):?>
                                    <span class="fc-orange fs30">免费</span>
                                    <?php else:?>
                                        <span class="fc-orange fs30">￥<?=$v['askprice']?></span>
                                    <?php endif;?>
                                </div></div>
                              <p class="my-qanda-item-bd fs30 fc-black mt5 face_tag">
                                    <?php if($v['imgs'] != '[]'):?>
                                <i class="appui-qanda-question-imgtag">
                                    <img src="../bdt/images/img-tag.png">
                                </i>
                                <?php endif;?>
                                </i>
                                <?=$v['question']?></p>
                            <div class="my-qanda-item-fd">
                                <i class="fs28 fc-greyabc"><?=htmls::formatTime($v['created'])?></i>
                                <span class="fs28 fc-greyabc"><i>1</i><?=$v['views']?>查看</span>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <!--我回答的问题列表END-->


                    </div>
                </div>
            </div>


            <div class="homepagelist" id="homepage1" style="top: 0px; display: block;">
                <div class="my-qanda">
                    <div class="my-qanda-list">
                        <!--我提问的问题列表-->
                        <?php foreach($ask as $k=>$v):?>
                            <div class="my-qanda-item bg-white mb10" onclick="gotoArticDetailHtml(<?=$v['id']?>,'<?=$v['from']?>','<?=$v['publishtype']?>');">
                                <div class="my-qanda-item-hd"><a><i>
                                            <img src="<?=Yii::$app->params['public'].'/attachment'.$v['user']['photo']?>">
                                            <i>
                                                <img src="../bdt/images/v1.png">
                                            </i></i>
                                        <span class="fc-navy fs30 ml5"><?=$v['user']['nickname']?></span></a>
                                    <span class="fc-blue fs30 ml5">待回答</span>
                                    <em class="fc-black fs30 ml5">优惠券</em>
                                    <div><i class="bg-orange"></i>
                                        <span class="fc-orange fs30">￥<?=$v['askprice']?></span></div></div>
                                <p class="my-qanda-item-bd fs30 fc-black mt5 face_tag">
                                    <?php if($v['imgs'] != '[]'):?>
                                        <i class="appui-qanda-question-imgtag">
                                            <img src="../bdt/images/img-tag.png">
                                        </i>
                                    <?php endif;?>
                                    </i>
                                    <?=$v['question']?></p>
                                <div class="my-qanda-item-fd">
                                    <i class="fs28 fc-greyabc"><?=htmls::formatTime($v['created'])?></i>
                                    <span class="fs28 fc-greyabc"><i>1</i><?=$v['views']?>查看</span>
                                </div>
                            </div>
                        <?php endforeach;?>
                        <!--我提问的问题列表-->
                        <script>
                            function gotoArticDetailHtml(id, from, publishtype){
                                window.location.href = "/questions/qanda_detail.html?id="+id+"&from="+from+"&publishtype="+publishtype;
                            }
                        </script>
                    </div>
                </div>
            </div>

            <!--我听过的问题列表-->
            <div class="homepagelist" id="homepage2" style="top: 0px; display: none;">
                <div class="my-qanda">
                    <div class="my-qanda-list" id="listenList">

                        <div class="my-listen-item bg-white mb10"><p class="my-listen-item-hd fs30 fc-black" onclick="gotoQanda_detailHtmlOfListen(4172,13,this)"><i class="appui-qanda-question-imgtag"><img src="../bdt/images/img-tag.png"></i>请问北京的房产还有投资机会吗</p><div class="my-listen-item-bd mt5"><a><img src="../bdt/images/user_21382_80.jpg"><i><img src="../bdt/images/v1.png"></i></a><div class="fs24 fc-greyabc"><p class="fs30"><a class="fc-navy">小敏同学</a><i class="mr5 ml5 fc-greyabc">|</i><span class="fc-black456">华麦投资控股合伙人，具有房地产投资经验，具有律师事务所北京，能够提供法律，投资等专业咨询，当然，我也可以为你唱首歌</span></p><i>3个小时前</i><span><i>4</i>人听过</span></div></div></div><div class="my-listen-item bg-white mb10"><p class="my-listen-item-hd fs30 fc-black" onclick="gotoQanda_detailHtmlOfListen(3771,13,this)">本人在杭州工作，现打算买一套房产作为资产保值，以后是否定居杭州尚不确定。现居住在转塘，倾向于考虑这附近的楼盘，半自主半投资，就是走了可以卖留下来也可以自己住。有推荐的吗？</p><div class="my-listen-item-bd mt5"><a><img src="/data/pic/photo1/user_19871_80.jpg?1494503151024"><i><img src="../bdt/images/v2.png"></i></a><div class="fs24 fc-greyabc"><p class="fs30"><a class="fc-navy">语燕</a><i class="mr5 ml5 fc-greyabc">|</i><span class="fc-black456">杭州楼市动态分析，行走的杭州房市传播大使😄👼💗</span></p><i>2017-05-28</i><span><i>70</i>人听过</span></div></div></div><div class="my-listen-item bg-white mb10"><p class="my-listen-item-hd fs30 fc-black" onclick="gotoQanda_detailHtmlOfListen(3866,13,this)">杭州去年涨晚，是不是意味着杭州还可能要涨一点?是否后面政府再出台更严厉政策。我打算买市中心二手房。自住，有钟意户型，能下手吗?</p><div class="my-listen-item-bd mt5"><a><img src="/data/pic/photo/user_7126_80.jpg"><i><img src="../bdt/images/v2.png"></i></a><div class="fs24 fc-greyabc"><p class="fs30"><a class="fc-navy">风易行</a><i class="mr5 ml5 fc-greyabc">|</i><span class="fc-black456">本人擅长投资建议，金融理财规划</span></p><i>2017-05-31</i><span><i>57</i>人听过</span></div></div></div><div class="my-listen-item bg-white mb10"><p class="my-listen-item-hd fs30 fc-black" onclick="gotoQanda_detailHtmlOfListen(3787,13,this)">现住萧山区政府旁，2003年买入东信莱茵园高层140㎡，2015年购入市北华瑞晴庐90㎡，赠送40㎡，4房。7月儿子毕业，首付200万。我们是以儿子名义再买一套小户型，还是卖掉一套置换更大的户型？</p><div class="my-listen-item-bd mt5"><a><img src="../bdt/images/user_10182_80.jpg?1493020103200"><i><img src="../bdt/images/v2.png"></i></a><div class="fs24 fc-greyabc"><p class="fs30"><a class="fc-navy">地产杭州客</a><i class="mr5 ml5 fc-greyabc">|</i><span class="fc-black456">十多年杭州房产媒体从业经历，专业解答杭州购房、房产投资咨询</span></p><i>2017-05-29</i><span><i>35</i>人听过</span></div></div></div><div class="my-listen-item bg-white mb10"><p class="my-listen-item-hd fs30 fc-black" onclick="gotoQanda_detailHtmlOfListen(3764,13,this)">在滨江上班总价考虑300万以下，刚需房，二手也可以，有没有什么推荐？是不是只能去买义桥？</p><div class="my-listen-item-bd mt5"><a><img src="/data/pic/photo0/user_22780_80.jpg?1494301932409"><i><img src="../bdt/images/v2.png"></i></a><div class="fs24 fc-greyabc"><p class="fs30"><a class="fc-navy">杭州楼外楼</a><i class="mr5 ml5 fc-greyabc">|</i><span class="fc-black456">房产投资，在目前市场中找到合理的投资品种；
市场研判，城市建设板块规划中作出适合的购买；
私人定制，根据你的自身情况做出更针对性决策！
问问题请说明所在行业，职位描述，家庭构成，利于更准确回答。</span></p><i>2017-05-28</i><span><i>39</i>人听过</span></div></div></div><div class="my-listen-item bg-white mb10"><p class="my-listen-item-hd fs30 fc-black" onclick="gotoQanda_detailHtmlOfListen(1904,13,this)">张总你好，现在手上有点闲钱不是很多，深圳肯定是买不了了。请问惠州是否适合投一下？未来三到五年预计有多大涨幅？</p><div class="my-listen-item-bd mt5"><a><img src="/data/pic/photo/user_419_80.jpg"><i><img src="../bdt/images/v2.png"></i></a><div class="fs24 fc-greyabc"><p class="fs30"><a class="fc-navy">张海利</a><i class="mr5 ml5 fc-greyabc">|</i><span class="fc-black456">深圳业内专家开发商！对深圳房地产市场了如指掌，欢迎提问！</span></p><i>2017-03-25</i><span><i>31</i>人听过</span></div></div></div><div class="my-listen-item bg-white mb10"><p class="my-listen-item-hd fs30 fc-black" onclick="gotoQanda_detailHtmlOfListen(1153,13,this)">我在青岛开发区有一套新房，还想投资一套房，在青岛那个区域投资升值潜力大？抑或是珠海投资炒房？</p><div class="my-listen-item-bd mt5"><a><img src="/data/pic/photo/user_174_80.jpg?1486966658178"><i><img src="../bdt/images/v2.png"></i></a><div class="fs24 fc-greyabc"><p class="fs30"><a class="fc-navy">问房专家团</a><i class="mr5 ml5 fc-greyabc">|</i><span class="fc-black456">问房智能专家团，解决您一切问题！</span></p><i>2017-03-08</i><span><i>353</i>人听过</span></div></div></div></div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
