<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\tools\htmls;

$this->title = '服务';
$this->params['breadcrumbs'][] = $this->title;

?>
<html><head><link rel="stylesheet" type="text/css" href="http://webapi.amap.com/theme/v1.3/style1.3.25.6.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="MobileOptimized" content="320">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta name="HandheldFriendly" content="true">
<title>博睿天诚</title> 
<link rel="stylesheet" href="http://www.lamaxiaochu.com/templates/m7/public/wxsite/css/public1.css"> 
<link rel="stylesheet" type="text/css" href="http://www.lamaxiaochu.com/templates/m7/public/wxsite/css/newweixin.css"> 
  <link rel="stylesheet" href="http://www.lamaxiaochu.com/templates/m7/public/wxsite/newcss/index.css">
  <link rel="stylesheet" href="http://www.lamaxiaochu.com/templates/m7/public/wxsite/newcss/font-awesome.min.css">
    <link rel="stylesheet" href="http://www.lamaxiaochu.com/templates/m7/public/wxsite/css/scrllo_function.css">

    
 <link rel="stylesheet" type="text/css" href="http://www.lamaxiaochu.com/templates/m7/public/wxsite/css/wmr_new_paotui.css">

<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>


  <script src="http://www.lamaxiaochu.com/templates/m7/public/wxsite/js/public.js"></script>  
  <script src="http://www.lamaxiaochu.com/templates/adminpage/public/js/allj.js"></script>  
   <script src="http://www.lamaxiaochu.com/templates/m7/public/wxsite/js/swipe.js"></script> 
  <script src="http://www.lamaxiaochu.com/templates/m7/public/wxsite/js/iscroll.js"></script> 
    <script src="http://www.lamaxiaochu.com/templates/m7/public/wxsite/js/newiscroll.js"></script>  
	    <script src="http://www.lamaxiaochu.com/templates/m7/public/wxsite/js/scrllo_function.js"></script>  
<script src="http://www.lamaxiaochu.com/templates/m7/public/wxsite/js/jquery.cookie.js"></script>
<script src="http://www.lamaxiaochu.com/templates/m7/public/js/jquery.lazyload.min.js" type="text/javascript" language="javascript"></script> 

	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> 


<link rel="stylesheet" href="http://www.lamaxiaochu.com/templates/m7/public/wxsite/css/gaodecss.css">
  <script src="http://webapi.amap.com/maps?v=1.3&amp;key=3feb4758e80885c392dbea7242649a67"></script><style type="text/css">.amap-container{cursor:url(http://webapi.amap.com/theme/v1.3/openhand.cur),default;}.amap-drag{cursor:url(http://webapi.amap.com/theme/v1.3/closedhand.cur),default;}</style>
<script> 
		var myScroll;
function loaded() {
	myScroll = new iScroll('wrapper', {
		useTransform: false,
		onBeforeScrollStart: function (e) {
			var target = e.target;
			while (target.nodeType != 1) target = target.parentNode;

			if (target.tagName != 'SELECT' && target.tagName != 'INPUT' && target.tagName != 'TEXTAREA')
				e.preventDefault();
		}
	});
}
document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false); 
document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);
 
</script>
  

 
 
 
</head>


<body> 
<style>
.page-app{ background:#f0f0f0;}
body{background:#f0f0f0;}
 #loading{text-align:center; wdith:80px; height:90px; margin-left:-40px; margin-top:-45px;  position:absolute;top:50%;left:50%;z-index:99999999; }
#loading .refuImg{  padding: 0px; margin: 0px;  height: 56px;}
#loading .refuImg img{    width: 50px; height: 50px;  margin-top: 3px;}
#loading .refuFang{width: 80px;font-size: 12px; height: 20px; line-height: 20px; padding: 0px;  margin: 0px auto; 
   margin-bottom:3px; color:#323233; text-align: center;}
</style>

<!-- jssdk -->
 <?=$this->render('_shareAll')?>
<!-- jssdk -->


 
	
<div id="mapaddressboxs" style="display:none;position:absolute; width:100%;height:100%;background:#fff;">

</div>

<div class="toptitCon">
<!-- 默认跑腿标题 -->
 <div class="toptitBox addressbox">
  <div class="toptitL"><i></i></div>
  <div class="toptitC"><h3>帮我送</h3></div>
 </div>

  <!-- 选择地图搜索标题 -->

 <!-- 补充详细地址标题 -->
<div class="toptitBox paotititlebox" style="display:none;">
  <div class="toptitL buchongdizhiadd"><i></i></div>
  <div class="toptitC"><h3>补充地址</h3></div>
 </div>

</div>
<!-- 补充详细地址部分 -->
<div class="bcdetailaddress" style="display:none;">
	<div style="width:100%;background:#fff;">
		<div class="hemebuinfobox">
			<ul>

				<li style=" line-height:40px;"><span style="color:#ff6e6e; font-size;16px;" id="detailaddtitle">您的地址是:</span></li>
				<li style=" line-height:25px; font-size;16px;font-weight:bold;"><span id="detailaddress"></span></li>

				<li><input style="width:100%;font-size;15px;" type="text" id="detaddressval" value="" placeholder="请补充楼号，小区号等详细信息"></li>

			</ul>
		</div>
	</div>
	<div class="intexchabutt"><input type="button" onclick="suredetailaddress();" value="确定" class="intexbg1"></div>
</div>

	
	

  <div id="wrapper" style="top: 40px; overflow: hidden;">
	<div id="scroller" style="transform-origin: 0px 0px 0px; position: absolute; top: 0px; left: 0px;">
	<div class="addressbox">
<!--------收货地址-------->
<div class="helpmepickCon">
 <ul>
  <li>
   <div class="helpmepick">
   <i class="icon_qu"></i>
   <span style="width:78%;" lng="113.662157" lat="34.754928" lnglat="" address="马拉丁(万象城)" detaddress="" onclick="getmapaddress(2);" class="newinp2">马拉丁(万象城)</span>
   </div>
  </li>
  <li class="borno">
   <div class="helpmepick">
	<i class="icon_shou"></i>
	<span style="width:78%;" lng="" lat="" address="" detaddress="" lnglat="" onclick="getmapaddress(1);" class="newinp1">点击获取您的收货地址</span>
</div>
  </li>
 </ul>
</div>
<!--------取货时间-------->
<div class="helpmepickCon">
 <ul>
  <li>
   <div class="helpmepick">
		<span>取货时间：</span>
		<select name="timeid" id="timeid"> 
		<option value="0">立即取货</option>  
        <option value="676800">2017-03-24 20:00-22:00</option> 
 </select>
	
	</div>
  </li>
 </ul>
</div>

<!------寄货收货电话------>
<div class="helpmepickCon">
 <ul>
   <li>
   <div class="helpmepick"><span>取货人电话：</span>
   <input type="text" id="getphone" name="getphone" value="" placeholder="请填写取货人电话"></div>
  </li>
    <li class="borno">
   <div class="helpmepick"><span>收货人电话：</span>
   <input type="text" id="shouphone" name="shouphone" value="" placeholder="请填写收货人电话"></div>
  </li>
 </ul>
</div>
<!--------备注信息-------->
<div class="helpmepickCon">
 <ul>
  <li>
   <div class="helpmepick"><span>备注信息：</span>
   <input name="demandcontent" id="demandcontent" value="" type="text" placeholder="如另有需求请填写备注信息"></div>
  </li>
 </ul>
</div>
</div>
 
 
<div style="clear:both;"></div>

<style>
.kgbox{ width:60%;  margin:0 auto; background:#fff; height:35px; line-height:35px; margin-top:20px; border:1px solid #cdcdcd;border-radius:50px;}
.kgjian{width:20%; text-align:center; color:#b3b3b3; font-size:36px;height:35px;  line-height:35px; margin-top:-3px;}
.kgmid{width:60%; text-align:center; color:#191919; font-weight:bold;}
  .dibubox{ background:#fff;}
 .kmleft{width:50%;text-align:center;}
.kmright{width:50%;text-align:center;}
.kmleft p,.kmright p{ height:30px; line-height:30px;}
.kmleft p span,.kmright p span{ color:#3f3f3f; font-size:24px; font-weight:bold; }
.kmleft p span.showdetcost{ color:#cbcbcb; font-size:20px;  margin-left:5px;  }
.minborder{ position:absolute;background:#d4d4d4;width:2px; height:60px; left:50%; top:0px; margin-left:-1px;}
</style>
<div class="dibubox">
<div style="height:10px;background:#f0f0f0;"></div>

<!--------配送重量-------->
<div class="helpmedisweiCon">
 <div class="helpmedisweiput">
	 <i onclick="getweightkg(0);" class="helpmebutL but_01"></i>
		 <span>
		 <b id="kgnumber">5</b>
		 <b class="kgchushizhi">公斤以下</b>
		 </span>
	  <i onclick="getweightkg(1);" class="helpmebutR but_03"></i>
 </div>
 
 <div class="helpmediswei costbox" style="display:none;">
 <input type="hidden" value="" id="allkgcost">
<input type="hidden" value="" id="allkmcost">
<input type="hidden" value="" id="farecost">
  <ul>
   <li><span>总价（元）</span><b class="fonCol01" id="allcost"></b></li>
   <li class="backno"><span>距离（千米）</span><b class="fonCol02" id="julikmnum"></b></li>
  </ul>
 </div> 
</div>

<div style="height:10px;background:#f0f0f0;"></div>
<!--------我要加价-------->
<div class="helpmeFareCon" style="margin-top:0px;">
 <div class="helpmeFareChe"><input type="checkbox"><span>我要加价</span>
 <span style="color:#cccccc;">加价有助于更快被接单</span></div>
 <div class="helpmeFareBox">
  <ul>
   <li fare="5">+5元</li>
   <li fare="10">+10元</li>
   <li fare="15">+15元</li>
   <li fare="20">+20元</li>
  </ul>
 </div>
</div>


 </div>

<div class="intexchabutt" style="margin-top:20px;">
<input type="button" onclick="fabupaotuiorder();" value="确认支付" class="intexbg1">
</div>

</div>
<!-----------------------跑腿服务------------------------->

 

	
<!-- 折线地图，取货地址与收货地址坐标之间的 直接地图显示 -->
<div id="huimap" style="width:100%;height:400px;display:none; ">
	
</div>

	<div style="height:20px;"></div>
	 
	
  </div>
<!--</div>-->
<script>
$(function(){
 checkOpenCity('410100','113.662157','34.754928','马拉丁(万象城)');
});

var cityname = '郑州市';
var cityId = '410100';
var map,market;
var biaoqianval = false;
var addtype = 1;
var km = '1';
var kmcost = '2.50';
var addkm = '2';
var addkmcost = '10.00';
var kg = '5';
var kgcost = '10.00';
var addkg = '2';
var addkgcost = '2.00';
var name = '';
var lnglat = '';
var back = 1;

var click_button = false;
function scorllerfreach(scoller_name,elements_name){

	if(typeof(scoller_name) != 'undefined'){
		scoller_name.destroy();
	}
	scoller_name = new iScroll(''+elements_name +'', {
		hScroll:false,hScrollbar:false, vScrollbar:false
	});
	return scoller_name;
}
function doubleclick(){
	click_button = false;
}
function lockclick(){
	 if(click_button == false){
			click_button = true;
			setTimeout("doubleclick()", 300); 
			return true;
	 }else{
		 return false;
	 }
}

function bqzhi(){
	biaoqianval  = false;
}
 $(function(){ 
 $('.toptitBox .toptitL').unbind();
			$('.toptitBox .toptitL').bind("click", function() {    
				history.back();
		   });
			$('.toptitBox .sousuodizhi').bind("click", function() {    
				$(".mapaddressbox").hide();
				$(".addressbox").show();
				myScroll.refresh();
			});
	 
			$('.toptitBox .buchongdizhiadd').bind("click", function() {    
				$(".paotititlebox").hide();
				$(".mapaddressbox").show();
				myScroll.refresh();
			});
  
	
  });

function getmapaddress(type){
	addtype = type;
	$(".addressbox").hide();
	$("#wrapper").hide();
	getscraddress(type);
}
var selectSendAddress;
function getscraddress(){
	back = 1;
	$("#mapaddressboxs").show();
	var content = htmlback(siteurl + '/index.php?ctrl=wxsite&action=gaodewebapi', {});
	if (content.flag == false) {
 		$("#mapaddressboxs").html(content.content);
		 
		window.addEventListener("message", function (e) {
					$("#mapaddressboxs").hide();
					$(".bcdetailaddress").show();
					$(".hemebuinfobox").show();
					$(".addressbox").show();
					jtdata(e.data);
			}, false);

	}
	
	 $("#searchKeywordss").bind('click',function(){
						    back = 2;
 							$('#searchAddresslist').show();
							 $('#searchAddresslist').css({'position':'absolute','top':'0px','marginTop':'42px','width':'100%','background':'#FFF','zIndex':'99999999999999','height':($(window).height()-42)+'px'}); 
							 selectSendAddress = scorllerfreach(selectSendAddress,'searchAddresslist');
							 bindsearchclick();
				 });
	
	$("#houtuiimg").bind('click',function(){ 
 				 if(back == 1){
						$("#mapaddressboxs").hide();
						$("#wrapper").show();
						 $(".addressbox").show(); 
				  }else{
						 back = 1;
						 $("#searchAddresslist").hide();
						 $('#selectadd').show();
				  } 
		  });
	
	
	$("#searchKeywordss").bind('keyup', function (e) {
		if (biaoqianval == false) {
			biaoqianval = true;
			setTimeout("bqzhi()", 500);
			var searchval = $("#searchKeywordss").val();
			if (searchval != '' && searchval != undefined) {
				var addresslist = 'http://restapi.amap.com/v3/place/text?&keywords=' + searchval + '&city=' + cityname + '&output=json&offset=20&page=1&key=97fc10d8c9cc63e265f81e244db39dee&extensions=all&callback=showaddresslist';
				$.getScript(addresslist);
			}
		}
	});
}
function jtdata(data){
	if (data.name != '' && data.lnglat != '') {
		$('.newinp'+addtype).text(data.name);
		$('#detailaddress').text(data.name);
		$('.newinp'+addtype).attr('address',data.name);
		$('.newinp'+addtype).attr('lnglat',data.location);
	} else {
		Tmsg('数据获取失败');
	}
}
function showaddresslist(data){
	$("#searchAddresslist").show();
	var datas = eval(data);
	if(datas.info == "OK"  && datas.status == 1  && datas.pois.length > 0 ){
		$('#searchAddresslist div').html('');
		var addresslist = datas.pois;

		var showhtmls = '';
		$.each(addresslist, function(i, newobj) {
			showhtmls += '<div class="selADditem J_returnLng" data-lng-lat="'+newobj.location+'"  ><div class="txt"><div class="poicard-name">'+newobj.name+'</div> <div class="poicard-addr">'+newobj.address+'</div></div></div>';
		});
		$('#searchAddresslist div').append(showhtmls);
		selectSendAddress.refresh();
		bindsearchclick();
	}
}
function bindsearchclick(){
	$('#searchAddresslist .selADditem').bind('click',function(){
//		var name = $(this).find('.poicard-name').text();
		$("#mapaddressboxs").hide();
		$(".bcdetailaddress").show();
		$(".hemebuinfobox").show();
		$(".addressbox").show();
		var name = $(this).find('.poicard-name').text();
		var lnglat = $(this).attr('data-lng-lat');
		choiceaddress(name,lnglat);
	});
}

function choiceaddress(name,lnglat){   //选择地址列表之后 -> 进入补充地址
	$('.newinp'+addtype).text(name);
	$('#detailaddress').text(name);
	$('.newinp'+addtype).attr('address',name);
	$('.newinp'+addtype).attr('lnglat',lnglat);
	myScroll.refresh();
}
function suredetailaddress(){	   // 确认补充地址按钮后 - > 进入主页面，并且如果符合条货 计算跑腿费用
	$(".paotititlebox").hide();
	$(".bcdetailaddress").hide();
	$("#wrapper").show();
	$(".addressbox").show();
	var detaddressval = $("#detaddressval").val();
	$(".newinp"+addtype).append(detaddressval);
	$(".newinp"+addtype).attr('detaddress',detaddressval);
	lnglatstr = $(".newinp"+addtype).attr('lnglat');
	lnglatarr = lnglatstr.split(',');
	$(".newinp"+addtype).attr('lng',lnglatarr[0]);
	$(".newinp"+addtype).attr('lat',lnglatarr[1]);
	jisuanptcost(); 
	myScroll.refresh();
}
function jisuanptcost(){   // 调用计算KM	
	/* 取货地址 */

	var getaddress = $(".newinp2").text();
	var getlng = $(".newinp2").attr('lng');
	var getlat = $(".newinp2").attr('lat');
	/* 收货地址 */
	var shouaddress = $(".newinp1").text();
	var shoulng = $(".newinp1").attr('lng');
	var shoulat = $(".newinp1").attr('lat');
	if( getaddress != '' &&  getlng != '' &&  getlat != '' &&  shouaddress != '' &&  shoulng != '' &&  shoulat != ''   ){
		$(".costbox").show(); 
			setTimeout("dojulist("+getlng+","+getlat+","+shoulng+","+shoulat+")",500 ); 
	}
	myScroll.refresh();
}
function dojulist(getlng,getlat,shoulng,shoulat){   // 计算2地址距离公里
	var map = new AMap.Map("huimap", {resizeEnable: true, zoom: 13});
	new AMap.Marker({map: map, position: [getlng, getlat]});
	new AMap.Marker({map: map, position: [shoulng, shoulat]});
	map.setFitView();
	var lnglat = new AMap.LngLat(getlng, getlat);
	var julikm  = (lnglat.distance([shoulng,shoulat])/1000).toFixed(1);
	dotongyijssuan(julikm);
}
function dotongyijssuan(julikm){   //最后 同意调用 计算费用等
		dopaotuikmcost(julikm);
		dopaotuikgcost();
		var allkgcost = $("#allkgcost").val();
		var allkmcost = $("#allkmcost").val();		 
		var allcost   = Number(allkgcost)+Number(allkmcost);
 		if( $('.helpmeFareChe').hasClass('.fainpaA') ){
			var fare = $('#farecost').val();
			var allcost = Number($('#allkgcost').val())+Number($('#allkmcost').val())+Number($('#farecost').val());
		}
		$("#allcost").text(allcost);
		$("#julikmnum").text(julikm);
}
function dopaotuikmcost(julikm){  // 根据距离公里计算跑腿金额
	$("#julikmnum").text(julikm);
	var allkmcost =  0;
 	if( julikm <= km  ){
		allkmcost = kmcost;
	}else{
		var addjuli = julikm-km;
		var addnum = Math.floor(addjuli/addkm);
		var addcost = addnum*addkmcost;
 		allkmcost = Number(kmcost)+Number(addcost);
	}
	$("#allkmcost").val(allkmcost); 
}
function dopaotuikgcost(){  // 根据重量公斤计算跑腿金额
	var weightkg = $("#kgnumber").text();
	 
 	var allkgcost =  0;
 	if( weightkg <= kg  ){
		allkgcost = kgcost;
	}else{
		var addweight = weightkg-kg;
		var addweightkg = Math.floor(addweight/addkg);
		var addweightkgcost = addweightkg*addkgcost;
 		allkgcost = Number(kgcost)+Number(addweightkgcost);
	}
	$("#allkgcost").val(allkgcost); 
	 
	
}
function getweightkg(type){  // 加减 重量公斤 数量 type 0为减 1为加

	var gweightkg = $("#kgnumber").text();
	 
	if( type == 0 ){
  		if(lockclick()){
	 
				if( Number(gweightkg) <= Number(kg) ){
			 
					$(".helpmebutL").addClass('but_01');
					$(".helpmebutL").removeClass('but_02');
 					$(".kgchushizhi").show();
				}else{
					 var jiankg = gweightkg-1;
					 $("#kgnumber").text(jiankg); 
				
					if( jiankg == kg ){
						$(".helpmebutL").addClass('but_01');
					$(".helpmebutL").removeClass('but_02');
						$(".kgchushizhi").show();
					}			
				}
		}
	}
	if( type == 1 ){
		if(lockclick()){
			$(".helpmebutL").removeClass('but_01');
			$(".helpmebutL").addClass('but_02');
			$(".kgchushizhi").hide();
			 $("#kgnumber").text(Number(gweightkg)+1);		
			 
			 gweightkg = $("#kgnumber").text();
		}
	}
	var julikm = $("#julikmnum").text();
	dotongyijssuan(julikm);
}

function saveaddress(){ 
		$('#loading').show();
		var sex = $("input[name='sex']:checked").val();
		var bigadr = $(".newinp1").text();
		var detailadr = $(".newinp2").val();
		var lng = $(".newinp1").attr('lng');
		var lat = $(".newinp1").attr('lat');
		var lnglatstr = $(".newinp1").attr('lnglat');

		var tempaddress = $(".newinp1").text()+$(".newinp2").val();
        var info = {'contactname':$('#contactname').val(),'sex':sex,'lng':lng,'lat':lat,'phone':$('#mobile').val(),'bigadr':bigadr,'detailadr':detailadr,'add_new':tempaddress,'addressid':0}; 
	  	var url = 'http://www.lamaxiaochu.com/index.php?ctrl=area&action=saveaddress&random=@random@&datatype=json';
	 
 }
</script>

<script>

function getLocation(){
     if (navigator.geolocation)
    { 
       navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
   else{
 	 setTimeout('goChoiceAdr()',1000);
    }
}  
function showPosition(position)
{  
	gpstolng(position.coords.latitude,position.coords.longitude);
}
function gpstolng(lat,lng){ 
 	var changelnglaturl = 'http://restapi.amap.com/v3/assistant/coordinate/convert?locations='+lng+','+lat+'&coordsys=gps&output=json&key=97fc10d8c9cc63e265f81e244db39dee&callback=changelnglat';
      $.getScript(changelnglaturl); 
} 
function changelnglat(datas){
	console.log(datas);
 	if(datas.status == 1   && datas.info == 'ok' ) {
		var locations = datas.locations;
  		 var getaddurl = 'http://restapi.amap.com/v3/geocode/regeo?output=json&location='+locations+'&key=97fc10d8c9cc63e265f81e244db39dee&radius=1000&extensions=all&callback=newrenderReverse';
		$.getScript(getaddurl);
	}
} 
function newrenderReverse(datas){
 	if(datas.status == 1   && datas.info == 'OK' ) {
	
		 var lnglat = '';
		var adcode = datas.regeocode.addressComponent.adcode;
		var aois = datas.regeocode.aois;
		var pois = datas.regeocode.pois;
		var roads = datas.regeocode.roads;
		if( aois.length > 0 ){ 
			var lnglat  = aois[0].location; 
			var formatted_address = aois[0].name;
		}else if( pois.length > 0 ){
			var lnglat  = pois[0].location; 
			var formatted_address = pois[0].address;
		}else if( roads.length > 0 ){
			var lnglat  = roads[0].location; 
			var formatted_address = roads[0].name;
		} 
		if( lnglat != '' ){
				var lnglatarr = lnglat.split(',');
				lng = lnglatarr[0];
				lat = lnglatarr[1];
		}  
		$("#showareainfo").attr('lng',lng);
		$("#showareainfo").attr('lat',lat);
		$("#showareainfo").text(formatted_address);  
 
		checkOpenCity(adcode,lng,lat,formatted_address);
	
	}else{
		setTimeout('goChoiceAdr()',1000);
 	 }
}

  
 
function goChoiceAdr(){
 	 var winHeight = $(window).height()-41-48-3;
 	var allHeight = 115+25+50+38;
 	var paddHeight = (winHeight-allHeight)/2;
  	$('#nearnoshopshowBox').css({'height':(winHeight-paddHeight)+'px','paddingTop':paddHeight+'px','width':'100%','position':'absolute','zIndex':'9999999999'});
 	$('#nearnoshop').show();
}


function showError(error)
  { 
 
   switch(error.code) 
    { 
    case error.PERMISSION_DENIED:
      break;
    case error.POSITION_UNAVAILABLE:
      $('#showareainfo').text("Location information is unavailable.");
      break;
    case error.TIMEOUT:
      break;
    case error.UNKNOWN_ERROR:
      break;
    } 
	setTimeout('goChoiceAdr()',1000);
     
  } 

</script>

<script>
$(".helpmeFareChe").click(function(){
		$(".helpmeFareChe input").toggleClass("fainpaA");
		$(".helpmeFareBox").toggle();
		myScroll.refresh();
});
$('.helpmeFareBox li').bind('click',function(){
	if(lockclick()){
		$('.helpmeFareBox li').removeClass('farebgaA');
		$(this).addClass('farebgaA');
		var fare = $(this).attr('fare');
		$('#farecost').val(fare);
		var allcost = Number($('#allkgcost').val())+Number($('#allkmcost').val())+Number($('#farecost').val());
		$('#allcost').text(allcost);
	}
});
function  fabupaotuiorder(){
	 $('#loading').show();
	var demandcontent = $("#demandcontent").val();
    /* 取货地址 */
	var getaddress = $(".newinp2").attr('address');
	var getdetaddress = $(".newinp2").attr('detaddress');
	var getlng = $(".newinp2").attr('lng');
	var getlat = $(".newinp2").attr('lat');

	/* 收货地址 */
	var shouaddress = $(".newinp1").attr('address');
	var shouetaddress = $(".newinp1").attr('detaddress');
	var shoulng = $(".newinp1").attr('lng');
	var shoulat = $(".newinp1").attr('lat');

 	var getphone = $("#getphone").val();
 	var shouphone = $("#shouphone").val();
 	var minit = $("#timeid").find("option:selected").val();
	var pttype = '1';
	var ptkg = $("#kgnumber").text();
	var ptkm = $("#julikmnum").text();
	var allkgcost = $("#allkgcost").val();
	var allkmcost = $("#allkmcost").val();
	var farecost = $("#farecost").val();
	var allcost = $("#allcost").text();
	wx.ready(function(){
			$.post("http://www.emifo.top/paotui/wxpay.html",{
				prise:1,
			    '_csrf':'<?php echo Yii::$app->request->csrfToken; ?>',
				},function(data){
					alert(data.timeStamp);
						wx.chooseWXPay({
							timestamp: data.timeStamp,
							nonceStr: data.nonceStr,
							package: data.package,
							signType: data.signType,
							paySign: data.paySign,
							success: function (res) {
								if(res.errMsg == 'chooseWXPay:ok') {
									$.post("",{prise:1},function(p){},'json');								 
								}
							}
						});             
			},'json');
	});
 
	 
}
</script>

 
 
 
     <div class="bottom-bar-warp">
        <div class="bottom-bar" id="bottom-bar">
            <div class="bbar-btn tap-click" onclick="dolink('http://www.lamaxiaochu.com/index.php?ctrl=wxsite&amp;action=index');"><i class="icon icon_home"></i><div class="text" style="margin-top:-8px;">首页</div></div>
            <div class="bbar-btn tap-click" onclick="dolink('http://www.lamaxiaochu.com/index.php?ctrl=wxsite&amp;action=order');"><i class="icon icon_user"></i><div class="text" style="margin-top:-8px;">我的订单</div></div>
     
            <div class="bbar-btn tap-click" onclick="dolink('http://www.lamaxiaochu.com/index.php?ctrl=wxsite&amp;action=togethersay');"><i class="icon icon_order"></i><div class="text" style="margin-top:-8px;">一起说</div></div>
            <div class="bbar-btn" onclick="dolink('http://www.lamaxiaochu.com/index.php?ctrl=wxsite&amp;action=member');"><i class="icon icon_phone" style="margin-top: 8px;"></i><a class="text" style="margin-top:-10px;">个人中心</a></div><a class="text" style="margin-top:-10px;">
        </a></div><a class="text" style="margin-top:-10px;">
    </a></div>