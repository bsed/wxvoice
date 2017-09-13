var userTest = "";
var getSysParams = "";
$(document).ready(function() {
	//webApp
    var appType = readClientSession("appType");
    if (appType==isApp) {
    	$('#getCashTbtn').show();
    }
	userTest = getSessionUser();
	wxUserCenterShare(userTest.nickname);
	getWallet();

	getSysParams = getSystemParams();
	var touListenPrice = getSysParams.touListenPrice;

	$("#touListenFee").html(getSysParams.touListenFeeShareRate*touListenPrice);
	$("#touListenFee1").html(getSysParams.touListenFeeShareRate*touListenPrice);

	$("#shareListenShare").html(getSysParams.shareListenShareRate*touListenPrice);
	$("#shareListenQA").html(getSysParams.shareListenQaRate*touListenPrice);
	
	$("#lv2ShareListenShare").html(getSysParams.lv2ShareListenShareRate*touListenPrice);
	$("#lv2ShareListenQA").html(getSysParams.lv2ShareListenQaRate*touListenPrice);

	$("#qaFeeRate").html(getSysParams.qaFeeRate*100+"%");
	$("#minPayCash").html(getSysParams.minPayCash/100);
});


function getWallet(){
	$.ajax({
		url: getMyWallet,
		type: 'post',
		dataType: 'json',
		data: {},
		success: function (result){
			if (result.result == "success") {

				var walletTol = result.data.wallet;
				$("#myAnswer").html((walletTol.answerTot/100).toFixed(2));
				$("#myAsk").html((walletTol.askTot/100).toFixed(2));
				$("#myShare").html((walletTol.shareTot/100).toFixed(2));
				$("#myRedpacket").html((walletTol.redPacketTot/100).toFixed(2));
				$("#myReward").html((walletTol.rewardTot/100).toFixed(2));
				$("#myCircle").html((walletTol.qzTot/100).toFixed(2));
				$("#my_wallet h2").html((walletTol.balance/100).toFixed(2));
				$(".youhuiquan span").html(walletTol.couponsCnt+"张");
				// var starter = $("#my_wallet h2").html();
				// var num1 = walletTol.tot;
				// if (String(num1).indexOf('.')>0) {
				// 	var nowStr = String(num1).split(".");
				// 	setInterval(function(){
				// 		if (starter<nowStr[0]) {
				// 			starter++;
				// 		}
				// 		$("#my_wallet h2").html(starter+"."+nowStr[1]);
				// 	},1)
				// }else{
				// 	setInterval(function(){
				// 		if (starter<num1) {
				// 			starter++;
				// 		}
				// 		$("#my_wallet h2").html(starter);
				// 	},1)
				// }
				
			}else{
				dataLoadedError(result.message);
			}
		}
	})
}
