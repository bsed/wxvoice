<input type="hidden" name="share_title" value="点灯祈福"/> 
<input type="hidden" name="share_image" value="http://www.emifo.top/static/images/logo.png"/>  
<input type="hidden" name="share_desc" value="2017年为自己、朋友、家人点灯祈福！虔诚供灯，无量功德！"/>   
<input type="hidden" name="share_link" value="http://www.emifo.top/paotui/index.html"/>
<script>
	wx.config({
		debug: true,
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
			wx.hideMenuItems({
				menuList: ["menuItem:share:appMessage","menuItem:share:timeline","menuItem:share:qq", "menuItem:copyUrl","menuItem:openWithQQBrowser","menuItem:openWithSafari"] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
			});
	});
</script>