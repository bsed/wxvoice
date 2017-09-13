<input type="hidden" name="share_title" value="点灯祈福"/> 
<input type="hidden" name="share_image" value="http://www.emifo.top/static/images/logo.png"/>  
<input type="hidden" name="share_desc" value="2017年为自己、朋友、家人点灯祈福！虔诚供灯，无量功德！"/>   
<input type="hidden" name="share_link" value="http://www.emifo.top/paotui/index.html"/>
<script>
	wx.config({
		debug: false,
		appId: '<?=$this->params['appId']?>', 
		timestamp: '<?=$this->params['timestamp']?>', 
		nonceStr: '<?=$this->params['nonceStr']?>', 
		signature: '<?=$this->params['signature']?>',
		jsApiList: <?=$this->params['list']?>,
	});
	
	var title = $('input[name="share_title"]').val();
	var imgUrl = $('input[name="share_image"]').val();
	var desc = $('input[name="share_desc"]').val();
	var link = $('input[name="share_link"]').val();
	wx.ready(function(){
		wx.onMenuShareTimeline({
			title: title,
			link: link,
			imgUrl: imgUrl,
			success: function () {
			},
			cancel: function () {	
			}
		});
		wx.onMenuShareAppMessage({
			title: title, 
			desc: desc,
			link: link,
			imgUrl: imgUrl,
			type: '',
			dataUrl: '',
			success: function () {
			},
			cancel: function () {
			}
		});
	});
</script>