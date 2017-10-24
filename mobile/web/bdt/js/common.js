$(document).ready(function(e) {
    var hChat ;
    //关闭优惠券提示
    $("#coupon_count_close").on('click', function() {
        $("#coupon_count_div").hide();
        $("#hasCouponSpace").hide();
        $("#noneCouponSpace").show();
        $('#page__bd').css('padding-top','3em');
    });

	//----------------------判断实时的验证是否是付费会员-----------------------//
    var isFee = $.session.get('feeuser');
        isFeeUser();

	//----------------------首页热门回答-保证语音控件和用户姓名能和头像同行显示-----------------------//
	var wLeft = $('.qanda-module').width();
	$('.qanda-right').width(wLeft-51);//51是减去左侧头像40和间距10，并且保证右浮动减少一像素，所以是减少51像素

	
	//----------------------内容页面TAB导航点击滑动效果-----------------------//
	$('.page__tab a').each(function(index, element) {
        $(this).click(function(e) {
			var wTab = $('.page__tab a').width();
			$('.movebg').stop().animate({'left':wTab*index},300)
			$('.page__tab a').stop().removeClass('fc-blue').addClass('fc-grey678');
			$(this).stop().removeClass('fc-grey678').addClass('fc-blue');
        });
    });
	$('.page__tab a').click(function(e) {
		$('.page__tab a').each(function(index, element) {
        	$(this).removeClass('fc-blue').addClass('fc-grey678');
		});
		$(this).removeClass('fc-grey678').addClass('fc-blue');
    });

	
	
	//----------------------朋友圈评论点赞点踩按钮弹出操作按钮-----------------------//
	$('.comment-act').click(function(e) {
        $(this).find('.act-module').fadeIn(100);
    });


	
	//----------------------好友主页-发布与问答-按钮点击切换效果-----------------------//
	$('.userpage-container .pandq-tab a').each(function(index, element) {
        $(this).click(function(e) {
			var wTab = $('.userpage-container .pandq-tab a').width();
			$('.userpage-container .pandq-tab .movebg').stop().animate({'left':wTab*index},300)
			$('.pandq-con>div').stop().fadeOut();
			$('#pandq'+(index+1)).stop().fadeIn();
			$('.userpage-container .pandq-tab a').stop().removeClass('fc-blue').addClass('fc-black');
			$(this).stop().removeClass('fc-black').addClass('fc-blue');
        });
	
    });
	
	
	//----------------------朋友圈-发布按钮点击后弹出发布内容样式选择----------------------//
	$('#page-act , .comment-act-btn').stop().click(function(e) {
		//alert('ok');
		$('body').css({'height':'100%','overflow':'hidden'},300);
		$('#js-bg').fadeIn();
       $('#js-page').animate({'bottom':'0' , 'opacity':'1'},300)
		//$('#container').animate({'opacity':'0.3'},300)
    });
	$('#appiu_js_page-cancel').stop().click(function(e) {
		//alert('ok');
		$('body').css({'height':'auto','overflow':'auto'},300);
		$('#js-bg').fadeOut();
		$('#js-page').animate({'bottom':'-30rem' , 'opacity':'0'},300)
		//$('#container').animate({'opacity':'1'},300)
    });
	
	//----------------------朋友圈-点击展开更多评论按钮弹出页面隐藏的评论层----------------------//
	$('.appui-c-showmore').stop().click(function(e) {
		//alert('ok');
		//$('#js-bg').css({'display':'block','opacity':'1'},300);
		$('body').css({'height':'100%','overflow':'hidden'},300);
		$('#js-page-comment').animate({'bottom':'0' , 'opacity':'1'},300)
    });
	$('.appui_js_page-comment-close').stop().click(function(e) {
		//alert('ok');
		//$('#js-bg').css({'display':'none','opacity':'0'},300);
		$('body').css({'height':'auto','overflow':'auto'},300);
       $('#js-page-comment').animate({'bottom':'-22rem' , 'opacity':'0.5'},300)
    });
	
	
	$('#js-bg').click(function(e) {
		$('#js-face').hide();
		// 当发布长文页面执行此事件时不执行body样式重置,如设置会导致输入区域不可见
		if(location.pathname.indexOf('article_edit') == -1){
        $('body').css({'height':'auto','overflow':'auto'});
        }
		$('#js-bg').fadeOut();
		$('#js-comment-input').animate({'bottom':'-2.05rem','opacity':'0'},300)
		$('#js-page').animate({'bottom':'-30rem' , 'opacity':'0'},300)
		$('#js-recommend').fadeOut();
    });
	

	
	//隐私模块点击开关效果
	$('.appui_cell__switch').each(function(index, element) {
        $(this).click(function(e) {
			$(this).toggleClass('appui_cell__switch-on');
        });
    });
	
	//登录和注册切换效果
	/*$('#regist-mark').click(function(e) {
        $('.login-module').animate({'margin-top':-$('.login-module').height(),'opacity':'0'},300);
        $('.regist-module').animate({'opacity':'1'},300)
		
    });
	$('#login-mark').click(function(e) {
        $('.regist-module').animate({'opacity':'0'},300)
        $('.login-module').animate({'margin-top':'0','opacity':'1'},300);
    });*/
	
	
	//聊天详情页面的高度计算
	$('#face-insert').click(function(e) {
		$('#js-face').slideToggle(300,function(){
			hChat = $('#js-comment-input').innerHeight() + 20 ;
			//alert(hChat);
			$('.chat-interface').animate({'margin-bottom':hChat},300);
		});
});

	
	//头像
	var photoW = $('.photo-edit-box>i').width();
	$('.photo-edit-box>i').css({'height':photoW,'margin-top':-photoW/2});
	$('.upload-container .row').css({'height':photoW,'margin-top':-photoW/2});
	
});


//侧滑删除
	$(function(){
		$('.appui-delete-list').each(function(index, element) {
			$('.appui-delete-list').css('width',$('body').width());
		});
		$('span.appui-delete-btn').each(function(index, element) {
			$(this).css('margin-top',-$(this).height()/2);
		});
		$('.appui-delete-item').on('swipeleft',function(){
			$(this).addClass('selected').parents('.appui-delete-touch').siblings().find('.appui-delete-item').removeClass('selected');
			$(this).find('span.appui-delete-btn').on('click',function(){
				//执行删除效果
				$(this).parents('.appui-delete-touch').css('border','0');
				$(this).parents('.appui-delete-touch').stop().animate({height:'0',margin:'0'},300,function(){$(this).remove();})
			})
		}).on('swiperight',function(){
			$(this).parents('.appui-delete-touch').find('.appui-delete-item').removeClass('selected');
		})
	})
//是否是付费会员
function isFeeUser(){
    var csrf = $('input[name="csrf"]').val();
    $.ajax({
        type: "POST",
        url: "/members/isfeeuser.html",
        data: {
            "_csrf":csrf
        },
        dataType: "json",
        success: function(data){
            if(data.result == 'success'){
                $.session.set('feeuser', 1);
            }else{
                $.session.set('feeuser', 0);
            }

        }
    });
}
function goBack(){
    if ((navigator.userAgent.indexOf('MSIE') >= 0) && (navigator.userAgent.indexOf('Opera') < 0)){ // IE
        if(history.length > 0){
            window.history.go( -1 );
        }else{
            window.location.href = "/";
            // window.opener=null;window.close();
        }
    }else{ //非IE浏览器
        if (navigator.userAgent.indexOf('Firefox') >= 0 ||
            navigator.userAgent.indexOf('Opera') >= 0 ||
            navigator.userAgent.indexOf('Safari') >= 0 ||
            navigator.userAgent.indexOf('Chrome') >= 0 ||
            navigator.userAgent.indexOf('WebKit') >= 0){

            if(window.history.length > 1){
                window.history.go( -1 );
            }else{
                window.location.href = "/";
                // window.opener=null;window.close();
            }
        }else{ //未知的浏览器
            window.history.go( -1 );
        }
    }
}

//格式化时间戳
function getDateDiff(time){
    //将PHP的时间戳转成js的时间戳
    dateTimeStamp = new Date(parseInt(time) * 1000);
    var minute = 1000 * 60;
    var hour = minute * 60;
    var day = hour * 24;
    var halfamonth = day * 15;
    var month = day * 30;
    var now = new Date().getTime();
    var diffValue = now - dateTimeStamp;
    if(diffValue < 0){return;}
    var monthC =diffValue/month;
    var weekC =diffValue/(7*day);
    var dayC =diffValue/day;
    var hourC =diffValue/hour;
    var minC =diffValue/minute;
    //超过三天就直接显示日期
    if(parseInt(dayC) <= 3){
        if(dayC>=1){
            result=""+ parseInt(dayC) +"天前";
        }else if(hourC>=1){
            result=""+ parseInt(hourC) +"小时前";
        }else if(minC>=1){
            result=""+ parseInt(minC) +"分钟前";
        }else{
            result="刚刚";
        }
    }else{
        result= formatDateTime(time);
    }

    return result;
}
//将时间戳转换成可读性的日期
function formatDateTime(timeStamp) {
    var date = new Date();
    date.setTime(timeStamp * 1000);
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    m = m < 10 ? ('0' + m) : m;
    var d = date.getDate();
    d = d < 10 ? ('0' + d) : d;
    var h = date.getHours();
    h = h < 10 ? ('0' + h) : h;
    var minute = date.getMinutes();
    var second = date.getSeconds();
    minute = minute < 10 ? ('0' + minute) : minute;
    second = second < 10 ? ('0' + second) : second;
    return y + '-' + m + '-' + d;
    // return y + '-' + m + '-' + d+' '+h+':'+minute+':'+second;
};

//压缩图片
function convertImgToBase64(url, callback, outputFormat){
    var canvas = document.createElement('CANVAS');
    var ctx = canvas.getContext('2d');
    var img = new Image;
    img.crossOrigin = 'Anonymous';
    img.onload = function(){
        var width = img.width;
        var height = img.height;
        // 按比例压缩2倍
        var rate = (width<height ? width/height : height/width)/1.8;
        canvas.width = width*rate;
        canvas.height = height*rate;
        ctx.drawImage(img,0,0,width,height,0,0,width*rate,height*rate);
        var dataURL = canvas.toDataURL(outputFormat || 'image/png');
        callback.call(this, dataURL);
        canvas = null;
    };
    img.src = url;
}

// function getDateDiff(time){
//     //将PHP的时间戳转成js的时间戳
//     dateTimeStamp = new Date(parseInt(time) * 1000);
//     var minute = 1000 * 60;
//     var hour = minute * 60;
//     var day = hour * 24;
//     var halfamonth = day * 15;
//     var month = day * 30;
//     var now = new Date().getTime();
//     var diffValue = now - dateTimeStamp;
//     if(diffValue < 0){return;}
//     var monthC =diffValue/month;
//     var weekC =diffValue/(7*day);
//     var dayC =diffValue/day;
//     var hourC =diffValue/hour;
//     var minC =diffValue/minute;
//     if(dayC>=1){
//         result=""+ parseInt(dayC) +"天前";
//     }
//     else if(hourC>=1){
//         result=""+ parseInt(hourC) +"小时前";
//     }
//     else if(minC>=1){
//         result=""+ parseInt(minC) +"分钟前";
//     }else if(monthC>=1){
//         result="" + parseInt(monthC) + "月前";
//     }
//     else if(weekC>=1){
//         result="" + parseInt(weekC) + "周前";
//     }
//     else else
//     result="刚刚";
//     return result;
// }
//END

// });