
//付费类型 0免费,1年付,2永久
var feeType = 0;
//加入圈子支付的费用
var joinPrice=0;
//图片
var pics = $('input[name="pics"]').val();

var maxInputLength = 150;

var from = "";

var user = null;
var $image;
$(document).ready(function() {
    loadEvent();

});
function loadEvent(){
    doInitCropper("#image");


	$('.circle-photo-edit').click(function(e) {
		$("#editphoto").css('display','block');
        $("#container").css('display','none');
        $("#circleContainer1").css('display','none');
        $("#circleContainer2").css('display','none');

	});

	$('#payType>a').each(function(index, element) {
		$(this).click(function(e) {
			$('#payType>a').removeClass('on');
			$(this).addClass('on');
			$('#amountInput>li').hide();
			$('#amountInput'+index).show();
		});
	});

	$('.amount').each(function(index, element) {
		$(this).bind('input propertychange', function() {
	    	if($(this).val() != '' || $(this).val().length != 0){
				$(this).addClass('on');
			}
			else{
				$(this).removeClass('on');
			}

		});
	});
	//免费按钮
	$('#freeId').click(function(e) {
        $('#circleContainer2').hide();
		$('#circleContainer1').show().animate({'left':'0'},'300');
		feeType = 0;
	});
	//收费按钮
	$('#payId').click(function(e) {
        $('#circleContainer1').hide();
        $('#circleContainer2').show().animate({'left':'0'},'300');
		feeType = 1;
	});

	//按年付
	$('#yearId').click(function(e){
		feeType = 1;

	});
	//永久有效
	$("#everId").click(function(e){
		feeType = 2;
		console.log(feeType);
	});


	$('#closeFreebtn').click(function(e){
		//如果是收费则显示收费界面
		// $('#circleContainer1').animate({'left':'120%'},'300');

	});

	$('#chargeNext').click(function(e){

		var reg = /^[1-9]\d*$/;//正整数
		var amount = 0;
		if(feeType==1){
			amount = $('#amount0').val();
		}else if(feeType==2){
			amount = $('#amount1').val();
		}

		if (!reg.test(amount)||amount<20||amount>3000) {
			dataLoadedError("请输入一个20-3000的正整数！");
    	}else{
    		$('#circleContainer1').show().animate({'left':'0'},'300');
    	}
	});
	//后退收费按钮
	$('#closeChargebtn').click(function(e){
		$('#circleContainer2').animate({'left':'120%'},'300');
	});

	$('#creatFinish').click(function(e){
		createQzRequestFuntion();
	});

	$("#circleLogo").change(function(){
		uploadImgFuntion($(this).get(0).files[0]);
	});

	$("#upload-back").click(function(){
        $("#circleContainer1").css('display','block');
        $("#circleContainer2").css('display','block');
        $(".toview").css('display','block');

    });

    // $('#changeImg').click(function(e) {
    //
    // });

    $('.sure-btn').click(function(e) {
        dataLoading("图片上传中...");
        var result = $image.cropper("getCroppedCanvas",{width: 640, height: 640});
        var imgData = result.toDataURL('image/png');
        var csrf = $('input[name="csrf"]').val();

        $.ajax({
            url:'/circle/upload.html',
            data:{file:imgData,  _csrf:csrf},
            type:"post",
            dataType:'json',
            success:function(data,status){
                clearToastDialog();
                if(data.result == "success"){

                    $("#circleContainer1").css('display','block');
                    $("#circleContainer2").css('display','block');
                    $(".toview").css('display','none');
                    $('.upload-container').css({'visibility':'hidden','z-index':'9'},500);
                    $('#circleLogoImg').attr("src",publicImg+data.img);
                    $('input[name="pics"]').val(data.img);

                }else{
                    dataLoadedError(result.message);
                }
            },

        });
    });

	monitorCount();

    initOs.setCallBack({
        app: function(){
            $("#picSelectBtn").remove();
            $("#changeImg").click(function(){
                cordova.exec(callAppsSuccessFunction,callAppsFailFunction, "SelectPhotoPlugin", "selectPhoto",[1]);
                cordova.exec(callAppsSuccessFunction,callAppsFailFunction, "SpeechOFFSynthesize", "selecterImg",[1]);
            });

            $('#closeBtn').click(function(e) {
                $('.upload-container').css({'visibility':'hidden','z-index':'-1'},500);
                $('#changeImg').hide().next('a').hide();
                $('#changeImg').show();
                $('#upload-back').show();
                $('#closeBtn').hide();
                $('#identity_card1').val();
                $('#picSelectBtn').remove();
            });
        },
		h5: function(){
            $('#closeBtn').click(function(e) {
                $('.upload-container').css({'visibility':'hidden','z-index':'-1'},500);
                $('#changeImg').hide().next('a').hide();
                $('#changeImg').show();
                $('#upload-back').show();
                $('#closeBtn').hide();
                $('#identity_card1').val();
                $('#picSelectBtn').remove();
                $('#changeImg').append('<input id="picSelectBtn" class="filehidden" accept="image/*" type="file" name="picSelectBtn" onchange="cardChange(\'picSelectBtn\');">');
            });
        }
    });
}

function selectImgSuccess(urlStr){
    $image.one('built.cropper', function () {
        $('.upload-container').css({'visibility':'visible','z-index':'9'},500);
        $('.toview').css('z-index','999');
        $('#sure-btn').show();
        $('#changeImg').hide();
        $('#upload-back').hide();
        $('#closeBtn').show();
        clearToastDialog();
    }).cropper('reset', true).cropper('replace', urlStr);
    $('#upload-back').hide();
}

function monitorCount(){
    $('#textarea').bind('propertychange input', function () {
        var counter = $('#textarea').val().length;
        $('#length').text(counter);   //每次减去字符长度
        if (counter>maxInputLength) {
             $('#length').text(maxInputLength);
             this.value = this.value.substring(0, 150);
             if ($('.toastDialog').length<=0) {
                dataLoadedError("您已经超过最大输入个数");
             }
             return false;
        };
    });
}

function createQzRequestFuntion(){
    var pics = $('input[name="pics"]').val();
	if(feeType==0){
		joinPrice = 0;
	}else if(feeType==1){
		joinPrice = $("#amount0").val();
	}else if(feeType==2){
		joinPrice = $("#amount1").val();
	}
	var name = $('#circleName').val();
	var summary = $('#textarea').val();
    if(pics == ''){
        dataLoadedError("圈子头像不能为空");
        return;
    }else if(name==""){
		dataLoadedError("圈子名称不能为空");
		$('#circleName').focus();
		return;
	}else if (name.length>15) {
		dataLoadedError("圈子名称应该在十五字以内");
		return;
	}
    var csrf = $('input[name="csrf"]').val();
	dataLoading("数据加载中...");
	$.ajax({
		url: '/circle/circle_creat.html',
		type: 'post',
		dataType: 'json',
		data:{"name":name,"summary":summary,"logo":$('input[name="pics"]').val(),"feeType":feeType,"joinPrice":joinPrice,"notes":"", _csrf:csrf},
		success: function(result){
			clearToastDialog();
			if (result.result == "success") {
				window.location.replace("circle_page.html?id="+result.id+"&from=create");
			}else{
				dataLoadedError(result.message);
			}
		}
	});

}


//上传图片
function uploadImgFuntion(file){
	// var file = $(this).get(0).files[i];
	// var imageNameStr = $(this).get(0).value;
	console.log(file.size);
	var rFilter = /^(image\/jpeg|image\/png)$/i; // 检查图片格式
	if (!rFilter.test(file.type) && file.type.indexOf("image")<0) {
        dataLoadedError("请选择jpeg、png格式的图片文件。");
        $("#filehidden").val("");
        return false;
    }else{

    	EXIF.getData(file,function(){
			jiaodu=EXIF.getTag(this,'Orientation');
			//alert("onchange orientation="+jiaodu);
		});
		if (typeof FileReader === 'undefined') {
			alert('Your browser does not support FileReader...');
			return false;
		}
		var reader = new FileReader();
		reader.onload = function(e) {
			console.log("2-:"+this.result.length);
		    getImgData(this.result,jiaodu,function(data,srcWidth,srcHight){
		    	console.log("data:"+data.length);
				pics=data;
				$('#circleLogoImg').show();
				$('#circleLogoImg').attr("src",'www.baidu');
		    });
		}
		reader.readAsDataURL(file);
    }
}

// @param {string} img 图片的base64
// @param {int} dir exif获取的方向信息
// @param {function} next 回调方法，返回校正方向后的base64
function getImgData(img,dir,next){
	var image=new Image();
	image.onload=function(){
		var degree=0,drawWidth,drawHeight,width,height;
		drawWidth=this.naturalWidth;
		drawHeight=this.naturalHeight;
	    //以下改变一下图片大小
	    var maxSide = Math.max(drawWidth, drawHeight);
	    /**if (maxSide > 1024) {
	    	var minSide = Math.min(drawWidth, drawHeight);
	    	minSide = minSide / maxSide * 1024;
	    	maxSide = 1024;
	    	if (drawWidth > drawHeight) {
	    		drawWidth = maxSide;
	    		drawHeight = minSide;
	    	} else {
	    		drawWidth = minSide;
	    		drawHeight = maxSide;
	    	}
	    }*/
	    var canvas=document.createElement('canvas');
	    canvas.width=width=drawWidth;
	    canvas.height=height=drawHeight;
	    var context=canvas.getContext('2d');
	    //判断图片方向，重置canvas大小，确定旋转角度，iphone默认的是home键在右方的横屏拍摄方式
	    switch(dir){
	       //iphone横屏拍摄，此时home键在左侧
	       case 3:
	       degree=180;
	       drawWidth=-width;
	       drawHeight=-height;
	       break;
	        //iphone竖屏拍摄，此时home键在下方(正常拿手机的方向)
	        case 6:
	        canvas.width=height;
	        canvas.height=width;
	        degree=90;
	        drawWidth=width;
	        drawHeight=-height;
	        break;
	        //iphone竖屏拍摄，此时home键在上方
	        case 8:
	        canvas.width=height;
	        canvas.height=width;
	        degree=270;
	        drawWidth=-width;
	        drawHeight=height;
	        break;
				}
	    //使用canvas旋转校正
	    context.rotate(degree*Math.PI/180);
	    context.drawImage(this,0,0,drawWidth,drawHeight);
	    //返回校正图片
	    next(canvas.toDataURL("image/jpeg",0.8),Math.abs(canvas.width),Math.abs(canvas.height));
			}
		image.src=img;
}
function SetPicData(data){
	pics = data;
	$("#circleLogoImg").attr("src",data);
	// $("#editphoto").hide();
}

function myClose(){

}function cardChange(inputFileId){
    var file=$("#"+inputFileId).get(0).files[0];
	var rFilter = /^(image\/jpeg|image\/png)$/i; // 检查图片格式
	if (file.type.indexOf("image") == 0) {
		//if (file.type.indexOf("image") == 0) {
		dataLoading("图像加载中...");
		var URL = window.URL || window.webkitURL;
		var blobURL;
		blobURL = URL.createObjectURL(file);

		$image.one('built.cropper', function () {
			URL.revokeObjectURL(blobURL); // Revoke when load complete
			$('.upload-container').css({'visibility':'visible','z-index':'9'},500);
            $('.toview').css('z-index','999');
			$('#sure-btn').show();
			$('#changeImg').hide();
			clearToastDialog();
		}).cropper('reset', true).cropper('replace', blobURL);
		$('#upload-back').hide();
		$('#closeBtn').show();
	}else{
		alert('文件"' + file.name + '"不是图片。');
	}
}

function doInitCropper(ids){
    $image = $(ids);
    var options = {
        restore : false,
        cropBoxMovable: false,
        cropBoxResizable: false,
        dragMode: 'move',
        aspectRatio: 43/ 43,
        background: false,
        crop: function (e) {
        }
    };
    $image.cropper(options);
}