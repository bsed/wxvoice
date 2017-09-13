// qanda_certify.js
var indexID = 0;
var targetId = "";
var currentPage = 1;
var totalPage = "";
var isMaster = 0;
var jiaodu=0;
var fromIndex = null;

var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数

var isBackBool = 0;
$(document).ready(function() {
    //判断是否认证了手机号
    ifBindMobile();
	$('body').height($(window).height());
  $("#helptext1 span").html(10);
    var csrf = $('input[name="csrf"]').val();
	targetId = request("id");
    monitorCount();
    doInitCropper("#image");
  $('#sure-btn').click(function(e) {
    dataLoading("图像上传中...");
    var result = $image.cropper("getCroppedCanvas");
    var imgData = result.toDataURL('image/png');
      $.ajax({
        url:'/members/upload.html',
        data:{"content":imgData,"orientation":jiaodu,"_csrf":csrf},
        type:"post",
        dataType:'json',
        success:function(data,status){
          clearToastDialog();
          if(data.result == "success"){
            dataLoadedSuccess("上传认证图片成功");
            // var certifiedPic = data.data.certifiedPic;
            var certifiedPic = data.file+data.img;
            if(certifiedPic == null || certifiedPic.length==0){
                $("#uploadCertifiedPic").show();
                $("#certifiedPic").hide();
            }else{
                $("#certifiedPicTips").html("当前名片<span class='fs28 fc-orange'>（点击可重新上传名片）</span>");
                $("#uploadCertifiedPic").hide();
                $("#certifiedPic").show();
                $("#certifiedPic img").attr("src",certifiedPic);
                $('input[name="uploadCertifiedPic"]').val(data.img);
            }
           $('.upload-container').css({'visibility':'hidden','z-index':'-1'},500);
            $("#sure-btn").hide();
            $("#modifyPicPage").hide();
            $("#certifyHome").show();
            
          }else{
            dataLoadedError(result.message);
          }
        },
        error:function(data,status,e){
          clearToastDialog();
          alert(e);
        }
      });
  });
});
//查看是否绑定了手机
function ifBindMobile(){
    var csrf = $('input[name="csrf"]').val();
    $.ajax({
        url: '/members/ifbindmobile.html',
        type: 'post',
        dataType: 'json',
        data: {"_csrf":csrf},
        success: function (data){
            if(data.result == 'success'){
                if(!data.info.phone){
                    dataLoading("请绑定手机");
                    setTimeout("goBindPhone()",3000);
                }
            }
        }
    })
}
function goBindPhone(){
    window.location.href="/members/myset_bind_phone.html?type=expert";
}
function backToPrePage(){
  $('.upload-container').css({'visibility':'hidden','z-index':'0'},500);
  $("#sure-btn").hide();
  $("#modifyPicPage").hide();
  $("#certifyHome").show();
}

function configqa(config) {
    var placeholderText = "￥0-"+config.maxQaPrice;
    var freeListenText = "回答"+parseInt(config.answerFreeTime)/60+"分钟内免费听";
    $('#askPrice').attr("placeholder",placeholderText);
    // $('#freeListen').text(freeListenText);  
    $('#freeListen').text("回答前10次免费听");  
}
function configUserDataUI(user) {
    isMaster = user.masterLvl;
    var lableStr2 = "";
    var lableStr = "";
    var lableArr = new Array();
    if (isMaster>=1) {
        $('#protocolLabel').hide();
        $('.qanda-certify-postbtn').text("保存资料");
    };
    if (user.headPic.length>0&&user.headPic!=null){
        $('#headPic img').attr("src",user.headPic);
    };
    $('.qanda-certify-info span').text(user.nickname);
    if (user.lable!=null&&user.lable!=0) {
        lableArr = user.lable.split(',');
        for (var i = 0; i < lableArr.length; i++) {
            lableStr +=  '<i>'+lableArr[i]+'</i>&nbsp;';
        };
        $('#label').html(lableStr);
    }
    if (user.locationLable!=null&&user.locationLable!=0) {
        var lableArr2 = user.locationLable.split(',');
        for (var i = 0; i < lableArr2.length; i++) {
            lableStr2 += '<span>'+lableArr2[i]+'</span>&nbsp;'
        }
        $('#label').append(lableStr2);
        $('#labelCount').text(lableArr.length+lableArr2.length);
    }
    $('#label').click(function(){
				saveDataSession();
        setElementClickStyle($(this).parents(".qanda-certify-item")[0]);
         window.location.href = "personal_data_label_edit.html?nid="+1;
    });

		if(user.certifiedPic == null || user.certifiedPic.length==0){
				$("#uploadCertifiedPic").show();
				$("#certifiedPic").hide();
		}else{
				$("#certifiedPicTips").html("当前名片<span class='fs28 fc-orange'>（点击可重新上传名片）</span>");
				$("#uploadCertifiedPic").hide();
				$("#certifiedPic").show();
				$("#certifiedPic img").attr("src",user.certifiedPic);
		}

		var sessionUser = readClientSession("sessionUser");
		if (sessionUser!=null) {
			  user = sessionUser;
    }
		var masterTitle = user.title;
		$("#masterTitle").val(masterTitle);
		$("#masterTitleCount").text(masterTitle.length);
		var masterInfo = user.masterInfo;
		$('#masterInfo').text(masterInfo);
		$('#masterInfoCount').text(masterInfo.length);

    if (isMaster>0) {
        $('#askPrice').val(user.askPrice);
    };
    // if (user.feeAddAsk==0) {
    //     $('#feeAddAsk span').removeClass("appui_cell__switch-on");
    // };
    // if (user.joinFreeFristIntv==0) {
    //     $('#joinFreeFristIntv span').removeClass("appui_cell__switch-on");
    // };
    // if (user.joinKnowledgeShare==0) {
    //     $('#joinKnowledgeShare span').removeClass("appui_cell__switch-on");
    // };

    }



function configBindPhoneUI(){
    $('.phone_dialog').show();
    $("#btnSendCode").click(function(){
        var phoneNumber = $("#phoneInput").val();
        if (isPhone(phoneNumber)==true) {
          getPhoneCode(phoneNumber);
        }else{
          dataLoadedError("请输入正确的电话格式");
        }
    });
    $("#closeID").click(function(){
      $('.phone_dialog').hide();
    });
    $("#verify").click(function(){
        var codeStr = $("#codeInput").val();
        var phoneNumber = $("#phoneInput").val();
        if (isPhone(phoneNumber)!=true) {
          dataLoadedError(isPhone(phoneNumber));
          return;
        }
        if (codeStr.length!=6||codeStr=="") {
          dataLoadedError("请输入正确的验证码");
          return;
        }

        $.ajax({
            url: bindPhoneCode,
            type: 'post',
            dataType: 'json',
            data: {"phone": phoneNumber,"code":$("#codeInput").val()},
            success: function (result){
                if (result.result == "success") {
                    $('.phone_dialog').hide();
        qrcodeDialogOfPhone('images/qrcodebg1.png' , '申请成功' , '关注问房吧后，系统会通过公众号向您<br />推送收到新提问的微信消息。' , 'success-apply' );
                    // successBack();
                }else{
                    dataLoadedError(result.message); 
                }
            }
        });

    });
}

function gotoUser_center_html(){
    $('#qrcodeDialog').remove();
    window.location.href = "user_center.html";
}

function callBack(){
    gotoUser_center_html();
}

function successBack(){
      //  var refreshBool = readClientSession("refreshBool");
    //if(getNeedNextSHowQr()&&refreshBool==0){
     //   $(".js_dialog").show();
//        var refreshBool = readClientSession("refreshBool");
//        if (refreshBool==0) {
        //更改新的申请成功弹框
      //      qrcodeDialog('images/qrcodebg1.png' , '申请成功' , '关注问房吧后，系统会通过公众号向您<br />推送收到新提问的微信消息。' , 'success-apply',callBack);
        // $("#scanMe").show();
			//			writeClientStorage("nextShowQr",(new Date()).getTime());
//    	}
        
         //         }else{
        // if (fromIndex==0) {
        //     window.location.href = "index.html";
        // }else if(fromIndex==1){
                window.location.href = "user_center.html";
        // }else{
        //     window.location.href = "index.html";
        // }
       //     }
        }


//绑定手机号
function getPhoneCode(phoneNumber) {
    curCount = count;
	//设置button效果，开始计时
    $("#btnSendCode").attr("disabled", "true");
    $("#btnSendCode").val("重新发送(" + curCount + ")");
    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
				//向后台发送处理数据
    // data:{"phone":"手机号","type":"1-注册，2-登录，3-找回密码，4-绑定手机，5-解绑手机"}
    $.ajax({
        type: "post",
        url: sendPhoneCode,
        dataType: "json",
        async: true,
        data:{"phone":phoneNumber,"type":4},
        success: function(result) {
        }
    });
}
//timer处理函数
function SetRemainTime() {
    if (curCount == 0) {                
        window.clearInterval(InterValObj);//停止计时器
        $("#btnSendCode").removeAttr("disabled");//启用按钮
        $("#btnSendCode").val("重新发送验证码");
    }
    else {
        curCount--;
        $("#btnSendCode").val("重新发送(" + curCount + ")");
    }
}

function num(obj){
    obj.value = obj.value.replace(/[^\d.]/g,""); //清除"数字"和"."以外的字符
    obj.value = obj.value.replace(/^\./g,""); //验证第一个字符是数字
    obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个, 清除多余的
    obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
    obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3'); //只能输入两个小数
}

var reg = /^[0-9]+.?[0-9]*$/;//用来验证数字，包括小数的正则
function applyMasterMethods(){
    var askPrice   = $('#askPrice').val();
    var masterInfo = $('#masterInfo').val();
    var masterTitle = $('#masterTitle').val();
    // var feeAddAsk  = hasSwitchOnClass("feeAddAsk");
    // var joinFreeFristIntv = hasSwitchOnClass("joinFreeFristIntv");
    // var joinKnowledgeShare = hasSwitchOnClass("joinKnowledgeShare");
    var aggreStatus = $('#aggre').prop("checked");
    if (!reg.test(askPrice)) {
        dataLoadedError("请输入正确的金额数字格式！");
    }else if (parseFloat(askPrice)<0||parseFloat(askPrice)>1000) {
        dataLoadedError("您输入的金额应该在0-1000之间");
    }else if (isMaster==0&&aggreStatus==false) {
        dataLoadedError("您需要同意本软件的使用协议");
    }else if (masterTitle==null||masterTitle.length==0 || masterTitle.trim()=="") {
        dataLoadedError("名片抬头不能为空");
    }else if (masterInfo==null||masterInfo.length==0 || masterInfo.trim()=="") {
        dataLoadedError("行家描述不能为空");
    }else if (Number(askPrice)!=0&&Number(askPrice)<1){
        dataLoadedError("您的金额应大于等于1或者为 0");
    }else{
        //提交资料
        sendInfosForExpert(askPrice, masterInfo, masterTitle);
    }
}
//提交资料审核
function sendInfosForExpert(askPrice, masterInfo, masterTitle){
    var csrf = $('input[name="csrf"]').val();
    var certifiedPic = $('input[name="uploadCertifiedPic"]').val();
    dataLoading("正在提交...");
    $.ajax({
        type: "POST",
        url: "/members/apply.html",
        data: {
            "honor":masterTitle,
            "des":masterInfo,
            "price":askPrice,
            "card":certifiedPic,
            "_csrf":csrf
        },
        dataType: "json",
        success: function(data){
           if(data.result == 'success'){
               dataLoadedSuccess("提交成功,请等待审核");
               window.location.href = "/members/index.html";
           }
        }
    });

}
function hasSwitchOnClass(cell){
    var hasSwitchOn = "";
     if ($('#'+cell+' span').attr("class").indexOf("appui_cell__switch-on")>0) {
        hasSwitchOn = 1;
    }else{
        hasSwitchOn = 0;
    }
    return hasSwitchOn;
}
function monitorCount(){
    $('#masterInfo').bind('onpropertychange input', function () {  
        var counter = $('#masterInfo').val().length;
        $('#masterInfoCount').text(counter);   //每次减去字符长度
        if (counter>100) {
            $('#masterInfoCount').text(100);
            this.value = this.value.substring(0, 100);
            if ($('.toastDialog').length<=0) {
                dataLoadedError("您已经超过最大输入个数");
            }
            return false;
        };
    });
    $('#masterTitle').bind('onpropertychange input', function () {  
        var counter = $('#masterTitle').val().length;
        $('#masterTitleCount').text(counter);   //每次减去字符长度
        if (counter>18) {
            $('#masterTitleCount').text(18);
            this.value = this.value.substring(0, 18);
            if ($('.toastDialog').length<=0) {
                dataLoadedError("您已经超过最大输入个数");
            }
            return false;
        };
    });
}


 function doInitCropper(ids){
  $image = $(ids);
  //image.crossOrigin = "anonymous";

  var options = {
           cropBoxMovable: false,
           // Enable to resize the crop box
           cropBoxResizable: false,
           dragMode: 'move',
           aspectRatio: 43/ 27,
           background: false,
          /** 
       movable: false,
       resizable: false, 
       dragCrop: false,
       aspectRatio: 1,
       background: false,
       aspectRatio: 43/ 27,
       //minCropBoxWidth: 215,
       //minCropBoxHeight: 129,
       strict: false,
       autoCropArea: 0.9,*/
        crop: function (e) {
          
        }
      };

  // Cropper
  $image.cropper(options);
}


function dataURLtoBlob(dataurl) {
    var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], {type:mime});
}

function cardChange(inputFileId){
        //var files = e.target.files || e.dataTransfer.files;
        var file=$("#"+inputFileId).get(0).files[0];
         if (file.type.indexOf("image") == 0) {
                if (file.size >= 5120000) {
                    alert('您这张"'+ file.name +'"图片大小过大，应小于5000k');   
                } else {
                  //$('.waitLoad').show();
                  var URL = window.URL || window.webkitURL;
                  var blobURL;
                  blobURL = URL.createObjectURL(file);
                  $image.one('built.cropper', function () {
                           URL.revokeObjectURL(blobURL); // Revoke when load complete
                           //$('.waitLoad').hide();
                           //$('.photo-show').fadeIn(500);
                            $('.upload-container').css({'visibility':'visible','z-index':'1'},500);
                            $('.upload-container .row').css({'height':$('.upload-container .row').width(),'margin-top':-$('.upload-container .row').width()/2});
                            $("#sure-btn").show();
                            $("#certifyHome").hide();
                            $("#modifyPicPage").show();
                  }).cropper('reset', true).cropper('replace', blobURL);
                                  

                  //$('.photo-show').fadeIn(300);
                  //$('.container').fadeIn(300);
                  //$('.container').css("z-index",100);
                }                  
          } else {
                alert('文件"' + file.name + '"不是图片。');    
          }

}

function myClose(){
	if (isBackBool==1) {
	 	removeClientSession("sessionUser");
	};
}
