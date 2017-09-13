<?php
use yii\helpers\Html;
?>
<div class="per_upload_con" data-url="<?=$config['serverUrl']?>">
    <div class="per_real_img <?=$attribute?>" domain-url = "<?=$config['domain_url']?>">
        <?=!empty($config['img'])?'<img src="'.$config['domain_url'].$config['img'].'">':''?>
    </div>
    <div class="per_upload_text">
        <p class="upbtn">
            <a id="<?=$attribute?>"  href="javascript:;" class="btn btn-success green choose_btn"></a>
        </p>
    </div>
    <input up-id="<?=$attribute?>" type="hidden" name="<?=$inputName?>" upname='<?=$config['fileName']?>' value="<?=isset($inputValue)?$inputValue:$config['public']?>" filetype="img" />
</div>
<script src="<?=$config['public']?>/js/jquery.form.js"></script>
<script src="<?=$config['public']?>/js/upload.js"></script>
<script src="<?=$config['public']?>/js/upload-input.js"></script>
