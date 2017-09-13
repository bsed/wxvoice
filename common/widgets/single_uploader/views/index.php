<?php
use yii\helpers\Html;
?>
<div id="webwrapper">
    <div id="container">
        <div id="uploader">
            <div class="queueList" style="margin-top:0px">
                <?php if($inputValue):?>
                <div id="dndArea" class="placeholder element-invisible">
                    <?php else:?>
                    <div id="dndArea" class="placeholder">
                    <?php endif;?>
                    <div id="filePicker"></div>
                </div>
            </div>
        <?php if($inputValue):?>
          <!--编辑的时候-->
            <ul class="filelist editfilelist" style="margin-left:10px";>
                <?php if($inputValue):?>
                    <li id="imgpath_0" class="state-complete">
                        <p class="title"></p>
                        <p class="imgWrap">
                            <img src="<?=$config["public"].'/attachment'.$inputValue;?>"></p>
                        <span class="success"></span>
                        <div class="file-panel" style="height: 30px;">
                            <span class="cancel" data-del="imgpath_0" data-url="../../public/attachment<?=$inputValue;?>">删除</span></div>
                    </li>
                <?php endif;?>


            </ul>

            <div class="statusBar editBar">
                <div class="btns">
                    <div id="filePicker2" class="webuploader-container">
                        <div class="webuploader-pick">继续添加</div>
                        <div id="rt_rt_1bivphvq04a0eh9bds1e5j1mr96" style="position: absolute; top: 0px; left: 10px; width: 94px; height: 42px; overflow: hidden; bottom: auto; right: auto;">
                            <input type="file" name="file" class="webuploader-element-invisible" multiple="multiple" accept="image/*">
                            <label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label>
                        </div></div>
                    <div class="uploadBtn state-ready">开始上传</div>
                </div>
            </div>
            <!--编辑的时候END-->
            <?php else:?>

            <div class="statusBar newBar" style="display:none;">
                <div class="btns">
                    <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
    <div id="filenames" style="display: none">
        <?php if($inputValue):?>
                <input type="hidden" name="filename[imgpath_0]" data-file="imgpath_0" value="<?=$inputValue;?>">
        <?php endif;?>
    </div>
    <input type="hidden" name="csrf" data-csrf="<?=Yii::$app->request->csrfParam;?>" value="<?=Yii::$app->request->csrfToken;?>"/>
</div>
<link rel="stylesheet" type="text/css" href="<?=$config['public']?>/webuploader/css/webuploader.css" />
<link rel="stylesheet" type="text/css" href="<?=$config['public']?>/webuploader/css/style.css" />
<script type="text/javascript" src="<?=$config['public']?>/webuploader/js/jquery.js"></script>
<script type="text/javascript" src="<?=$config['public']?>/webuploader/js/webuploader.js"></script>
<script type="text/javascript" src="<?=$config['public']?>/webuploader/js/upload.js"></script>
<script>
    $(document).delegate('.cancel',"click",function(){
        var del = $(this).data('del');
        var imgPath = $(this).data('url');
        var rmImg = $('#'+del).remove();
        var rmPath = $('input[name="filename['+del+']"]').remove();
        $.ajax({
            url: 'upload.html?action=del&del='+imgPath,
            type: 'POST',
            data: {delname:1},
            cache: false,
            processData: false,
            contentType: false
        });
    })
</script>













