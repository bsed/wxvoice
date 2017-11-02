/*公众号ID，需要特别注意，lhj*/
//半导体
var wenxinAppid = "";
/*服务器域名地址*/
var hostConf                      = "";
//获取系统参数
var getSystemParamsUrl            = hostConf + "/getSystemParams.html";
//微信主机地址
var wxShareUrl              	  = window.location.href;
// 获取文章首页分类列表
var getCategoryUrl                = hostConf + "/getCategoryList.html";
// 获取文章详情
var getArticleDetail              = hostConf + "/getArticleDetail.html";
// 获取专题文章列表
var getArticleZjData              = hostConf + "/getArticleZjData.html";
// 获取大咖文章列表
var getArticleDkData              = hostConf + "/getArticleDkData.html";
// 获取首页列表
var getHomeData                   = hostConf + "/getHomeData.html";
// 获取朋友圈列表
var getFriendArticleList          = hostConf + "/getFriendArticleList.html";
// 获取朋友圈列表
var setFriendNewMsgReadingStatusUrl= hostConf + "/setFriendNewMsgReadingStatus.html";
// 获取朋友圈更多评论列表
var getCommentList                = hostConf + "/getCommentList.html";
//获取朋友圈点赞或者踩
var getSetLikeOrOppose            = hostConf + "/setLikeOrOppose.html";
//发表短文
var submitMessageurl              = hostConf + "/submitMessage.html";
//发表短长文
var submitLenMessageurl           = hostConf + "/submitLenMessage.html";
// 收藏文章
var setFavorite                   = hostConf + "/setFavorite.html";
//发表评论
var submitComment                 = hostConf + "/submitComment.html";
//删除评论
var delComment                    = hostConf + "/delComment.html";
//获取分页评论
var getPageCommentList            = hostConf + "/getPageCommentList.html";
//转发
var forwardContent                = hostConf + "/forwardContent.html";

var weixinAuthUrl                 = hostConf + "/access_token.html";
//获取全部分类数据；
var getPageCategories             = hostConf + "/getPageCategories.html";
//获取分类分页数据
var getPageListByCategories       = hostConf + "/getPageListByCategories.html";
//获取推荐的昵称
var getRecommendNicknameUrl       = hostConf + "/getRecommendNickname.html";
//修改微信昵称
var resetWeixinNickname           = hostConf + "/resetWeixinNickname.html";
//注册账号
var doRegister                    = hostConf + "/doRegister.html";
//获取手机验证码
var sendPhoneCode                 = hostConf + "/sendPhoneCode.html";
//检查昵称是否可用
var checkNickname                 = hostConf + "/checkNickname.html";
//用验证码登录接口
var doLoginByPhoneCode            = hostConf + "/doLoginByPhoneCode.html";
//用账号密码登录接口
var doLogin                       = hostConf + "/doLogin.html";
//用户登录状态查询
var getUserLoginStatus            = hostConf + "/getUserLoginStatus.html";
//用户重置密码
var doResetPassword               = hostConf + "/doResetPassword.html";
//获取我的主页基础数据
var getMyHomePageData             = hostConf + "/getMyHomePageData.html";
//获取我的主页数据列表
var getMyContentList              = hostConf + "/getMyContentList.html";
//获取我的收藏基础数据
var getMyFavoriteList             = hostConf + "/getMyFavoriteList.html";
//获取好友文章或问答列表
var getContentListByUser          = hostConf + "/getContentListByUser.html";
//获取用户主页基础数据
var getUserHomePageData           = hostConf + "/getUserHomePageData.html";
//加关注
var doFocus                       = hostConf + "/doFocus.html";
//取消关注
var removeFocus                   = hostConf + "/removeFocus.html";
// 获取用户列表（好友、关注、粉丝）
var getMyRelatedUsers             = hostConf + "/getMyRelatedUsers.html";
//申请互粉
var applyFriend                   = hostConf + "/applyFriend.html";
//删除文章
var delArticle					  = hostConf + "/delArticle.html";
//获取文章/问答的点赞或者点踩数据
var getLikeAndOpposeUrl			  = hostConf + "/getLikeAndOppose.html";
//获取消息列表
var getMyPageNotices			  = hostConf + "/getMyPageNotices.html";
//修改消息状态
var updateSysNoticeStatusURL      = hostConf + "/updateSysNoticeStatus.html";
//获取消息详情
var getNoticeDetail				  = hostConf + "/getNoticeDetail.html";
//删除消息
var deleteNotice				  = hostConf + "/deleteNotice.html";

var iconDefaultPicForNullUrl 	  = hostConf + "images/default_icon.jpg";

var userHeadPicUploadUrl          = hostConf + "/userHeadPicUpload.html";

var userHomeBgPicUploadUrl        = hostConf + "/userHomeBgPicUpload.html";

var defaultWeixinSharePicUrl 	  = hostConf + "images/wenfang.jpg";

var defaultRedPacketPicUrl 	  	  = hostConf + "images/hongbao.jpg";

var getWxShareDataUrl             = hostConf + "/getWxShareData.html";
//修改资料
var updateUserInfo                = hostConf + "/updateUserInfo.html";
//获取地域数据
var getAreaList                   = hostConf + "/getAreaList.html";
//获取行业数据
var getIndustryList               = hostConf + "/getIndustryList.html";
//修改标签数据
var getLableList                  = hostConf + "/getLableList.html";
//获取用户基本信息
var getEditUserInfo               = hostConf + "/getEditUserInfo.html";
//分页获取新消息
var getFriendNewMsgByPage         = hostConf + "/getFriendNewMsgByPage.html";
//获取提问者信息
var getMasterInfo         		  = hostConf + "/getMasterInfo.html";
//向他提问
var askQuestion         		  = hostConf + "/askQuestion.html";
var askQuestionV2         		  = hostConf + "/askQuestionV2.html";
//获取用户文章或问答列表 
//var getContentListByUser          = hostConf + "/getContentListByUser.html";
//申请答主信息页面内容获取
var getApplyMasterConfigInfo      = hostConf + "/getApplyMasterConfigInfo.html";
//申请答主信息页面提交
var postApplyMasterConfig         = hostConf + "/postApplyMasterConfig.html";
//申请答主信息页面提交
var postApplyMasterConfig         = hostConf + "/postApplyMasterConfig.html";

var getConfigValueUrl             = hostConf + "/getConfigValue.html";
//回答问题界面
var postAnswer             		  = hostConf + "/postAnswer.html";
//获取问答详情
var getQaDetail             	  = hostConf + "/getQaDetail.html";
//获取朋友圈问答列表
var getFriendQaList               = hostConf + "/getFriendQaList.html";
//获取合集列表
var getQaHjData              	  = hostConf + "/getQaHjData.html";
//获取合集下方的列表
var getQaZjPageData               = hostConf + "/getQaZjPageData.html";
//获取答主列表
var getQaDzData               	  = hostConf + "/getQaDzData.html";
//拒绝回答问题
var rejectQuestion                = hostConf + "/rejectQuestion.html";
//撤回问题
var cancelQuestion                = hostConf + "/cancelQuestion.html";
//重新回答
var reAnswer                      = hostConf + "/reAnswer.html";
//追问回答
var postAnswerForZhuiwen          = hostConf + "/postAnswerForZhuiwen.html";
//追问问题
var askQuestionForZhuiwen         = hostConf + "/askQuestionForZhuiwen.html";
//申请答主信息页面提交
var modifyMasterConfig        	  = hostConf + "/modifyMasterConfig.html";
//申请听录音界面
var toListen        			  = hostConf + "/toListen.html";

//获取专家列表
var getZjPageDataUrl        	  = hostConf + "/getZjPageData.html";

//如果是微信浏览器，检查是session是否已保存openid，如果没有，在login或者regist时，首先获得openid
var checkOpenidUrl                = hostConf + "/checkOpenid.html";
//更改消息read状态
var setNoticeReadStatusUrl        = hostConf + "/setNoticeReadStatus.html";
//认证图片上传（名片)
var userCertifiedPicUploadUrl     = hostConf + "/userCertifiedPicUpload.html";
//修改标签数据
var getLableList                  = hostConf + "/getLableList.html";
//通过标签请求专家列表数据
var getZjDataByLable              = hostConf + "/getZjDataByLable.html";
//获取交易状态
var getTradeResultUrl             = hostConf + "/pay/getTradeResult.html";
//获取二维码数据
var getMyqrcodeDataUrl            = hostConf + "/getMyqrcodeData.html";
//修改密码
var modifyPassword                = hostConf + "/modifyPassword.html";
//获取新消息url
var getNewMessageStatusUrl        = hostConf + "/getNewMessageStatus.html";
//手机号绑定
var bindPhoneCode                 = hostConf + "/bindPhoneCode.html";
//手机号解绑
var unbindPhoneCode               = hostConf + "/unbindPhoneCode.html";
// 获取优惠券数据
var getMyCouponsList              = hostConf + "/getMyCouponsList.html";
// 我的收入
var getMyWallet              	  = hostConf + "/getMyWallet.html";
// 获取是否有优惠券
var getMyCouponsCount             = hostConf + "/getMyCouponsCount.html";
//数据统计url
var createStatlogUrl              = hostConf + "/createStatlog.html";
//获取热词
var getHotKey                     = hostConf + "/getHotKey.html";
//获取搜索内容
var getSearchContent          	  = hostConf + "/getSearchContent.html";
//获取更多的搜索内容
var getSearchContentMore          = hostConf + "/getSearchContentMore.html";
//获取未回答内容的个数
var getUserUnanswerQaCnt          = hostConf + "/getUserUnanswerQaCnt.html";
//获取分页获取评论通知
var getPageContentNoticeList      = hostConf + "/getPageContentNoticeList.html";
//修改评论通知的读取状态
var setContentNoticeReadStatus    = hostConf + "/setContentNoticeReadStatus.html";
//获取公众号关注状态
var checkUserSubscriptionStatus   = hostConf + "/checkUserSubscriptionStatus.html"
var checkUserShare38Url           = hostConf + "/checkUserShare38.html"
var get38picUrl                   = hostConf + "/get38pic.html"

//话题入口顶部图片
var getLastTopicBanner			  = hostConf + "/getLastTopicBanner.html"
//在话题详情
var getTopic 			  		  = hostConf + "/getTopic.html"
// 获取topic回答及评论列表
var getTopicPageCommentList		  = hostConf + "/getTopicPageCommentList.html"
//话题回答
var postTopicAnswer				  = hostConf + "/postTopicAnswer.html"
//发表评论
var submitComment				  = hostConf + "/submitComment.html"
//免费听
var toListenTopic				  = hostConf + "/toListenTopic.html"
//获取推荐问答list
var getAdQa				  		  = hostConf + "/getAdQa.html"
//获取专栏数据
var getMyAllContents              = hostConf + "/getMyAllContents.html";
//获取楼盘专栏数据
var getLouPanMyAllContents        = hostConf + "/getLouPanMyAllContents.html";
//获取专栏数据
var submitMessage              	  = hostConf + "/submitMessage.html";
//获取用户动态
var getPageTraces              	  = hostConf + "/getPageTraces.html";
//获取楼盘行家list
var getLoupanExpertPageList       = hostConf + "/getLoupanExpertPageList.html"
//行家加入解除楼盘
var doJoinLoupan       			  = hostConf + "/doJoinLoupan.html"
var getChildrenContentCommentList = hostConf + "/getChildrenContentCommentList.html";
// 获取楼盘ID 的 数据
var getAllLoupanId             = hostConf + "/getAllLoupanId.html";
//获取话题界面的评论
var getPageTopicAnswerCommentList   = hostConf +"/getPageTopicAnswerCommentList.html"
//获取话题列表
var getTopicPageList   				= hostConf +"/getTopicPageList.html"
//获取广场list
var getSquarePageList   			= hostConf +"/getSquarePageList.html"
//获取房产圈
var getUserContentTracePageList     = hostConf +"/getUserContentTracePageList.html"
//发表文章-短消息
var submitVoiceMessage     			= hostConf +"/submitVoiceMessage.html"
//发表文章-短消息+视频
var submitVideoMessage     			= hostConf +"/submitVideoMessage.html"
//广场语音播放
var playMessageVoice     			= hostConf +"/playMessageVoice.html"
//广场视频播放
var playMessageVideo     			= hostConf +"/playMessageVideo.html"
//生成红包
var postRedPacket     				= hostConf +"/postRedPacket.html"
//拆红包
var splitRedPacket     				= hostConf +"/splitRedPacket.html"
//红包记录
var getRedPacketInfo     			= hostConf +"/getRedPacketInfo.html"
// 收到红包接口:getUserGainRedPacketList
var getUserGainRedPacketList     	= hostConf +"/getUserGainRedPacketList.html"
// 发出红包接口:sendOutRedPacketList
var sendOutRedPacketList     		= hostConf +"/sendOutRedPacketList.html"

//创建圈子
var createQz     					= hostConf +"/createQz.html"
//我的圈子
var getMyQz     					= hostConf +"/getMyQz.html"
//根据用户编号得到圈子信息
var getMyQzByUserId                 = hostConf +"/getMyQzByUserId.html";
//圈子主页
var getQz     						= hostConf +"/getQz.html"
//圈子内容
var getQzContentPageList     	    = hostConf +"/getQzContentPageList.html"
//用户主页
var getUserHomePageData     	    = hostConf +"/getUserHomePageData.html"
//获取圈子详情
var getQzDetailUrl                     = hostConf +"/getQzDetail.html"
//加入圈子
var joinQzUrl                          = hostConf +"/joinQz.html"
//用户进入圈子log记录
var addQzEnterLogUrl				   = hostConf + "/addQzEnterLog.html"
var getQzMemberCountUrl                = hostConf + "/getQzMemberCount.html";
var getQzMemberListUrl                = hostConf + "/getQzMemberList.html";
var updateQzUserInfoUrl        = hostConf + "/updateQzUserInfo.html";
var exitMemberURL        = hostConf + "/exitMember.html";
var updateMemberFeeURL   = hostConf + "/updateMemberFee.html";
var updateQzInfoURL		 = hostConf + "/updateQzInfo.html";
var getQzURL		 = hostConf + "/getQz.html";
var getRecommendQzListUrl		 = hostConf + "/getRecommendQzList.html";
//设置精华贴
var setQzContentPriorLvlURL = hostConf + "/setQzContentPriorLvl.html";


//转译字符
// &quot;
//测试临时添加
// var user = {"id":2,"nikeName":"红年年2","headPic":"../data/pic/photo/user_1.jpg"};
// writeClientSession("user1",user);

/*文章数据收集链接*/
var doGrabArticleByTypeUrl           = hostConf + "/doGrabArticleByType.html";
var doAddPublicToListUrl           = hostConf + "/addPublicToList.html";
var getPublicNameListUrl           = hostConf + "/getPublicNameList.html";
var getGrabArticlePageByTypeUrl           = hostConf + "/getGrabArticlePageByType.html";
var getDoGrabArticleStatus         = hostConf + "/getDoGrabArticleStatus.html";
var getGrabArticleContentByIdUrl           = hostConf + "/getGrabArticleContentById.html";
var publishGrabArticleUrl           = hostConf + "/publishGrabArticle.html";

var doSetCategorySortIdUrl           = hostConf + "/doSetCategorySortId.html";
var publishCategoryListUrl           = hostConf + "/publishCategoryList.html";
var grabArticleCancelUrl             = hostConf + "/grabArticleCancel.html";
var addCouponsSubmitlUrl             = hostConf + "/addCouponsSubmit.html";
var editCouponsSubmitUrl             = hostConf + "/editCouponsSubmit.html";

var manage_updateUserUrl             = hostConf + "/manage_updateUser.html";
var manage_letUserThroughUrl         = hostConf + "/manage_letUserThrough.html";
var updateSystemConfigUrl            = hostConf + "/updateSystemConfig.html";
var manage_addCouponsUrl             = hostConf + "/manage_addCoupons.html";
var manage_addQaLabelUrl             = hostConf + "/manage_addQaLabel.html";
// 提现接口
var userCash              = hostConf + "/userCash.html";

// SP 定义
// 是否是 活动期间 0：平常时间 1：活动时间
var isActivity = 0;

//返回按钮 1普通参数返回 2 返回数组
var isNormalBackBool = 1;

//聊天室，上传图片
var getImgUrl                     = hostConf + "/getImgUrl.html";

//得到打赏记录
var getAwaredListUrl              = hostConf + "/getAwaredList.html";

//全局图片设置
var publicImg = 'http://imgs.emifo.top/attachment';

//app定义的一些全局变量;
var isApp = "isApp";
//app版本号
// var appVersions = "app_android_1.0.0";
//获取token
var getTokenKey = 			hostConf + "/getTokenKey.html";
//上传appinfo
var sendAppDeviceInfo = hostConf + "/sendAppDeviceInfo.html";