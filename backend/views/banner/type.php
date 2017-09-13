<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '自定义字段';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
<link href="css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
<link href="css/animate.min.css" rel="stylesheet">
<link href="css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
<link href="css/style.min862f.css?v=4.1.0" rel="stylesheet">

<style>
    .names{
        height:32px;margin-top:-5px;text-align:center;border:1px solid #e5e6e7;width:80%
    }
    .droppable-active{background-color:#ffe!important}.tools a{cursor:pointer;font-size:80%}.form-body .col-md-6,.form-body .col-md-12{min-height:400px}.draggable{cursor:move}
</style>
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-sm-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>碎片</h5>
                </div>

                <div class="ibox-content">
                    <div class="alert alert-info">
                        拖拽左侧的表单元素到右侧区域，即可生成相应的HTML代码，表单代码，轻松搞定！
                    </div>
                    <div role="form" class="form-horizontal m-t">
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">
                                <input type="text" class="names" name="type[mingzi][]" value="碎片名">
                            </label>
                            <div class="col-sm-9">
                                <input type="text"  class="form-control" name="type[text][]" value="suipian">
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <!--        左侧-->

        <div class="col-sm-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>拖拽左侧碎片到此区域</h5>
                </div>

                <div class="ibox-content">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row form-body form-horizontal m-t">
                    <?php if($mingzi):?>
                            <?php for($i=0;$i<=$count;$i++):?>
                            <div class="col-md-12" style="min-height:0">
                                <div class="form-group draggable ui-draggable dropped" style="position: static;">
                                    <label class="col-sm-3 control-label">
                                        <input type="text" class="names" name="type[mingzi][]" value="<?=$mingzi[$i]?>">
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="type[text][]" value="<?=$text[$i]?>">
                                    </div>
                                    <p class="tools col-sm-12 col-sm-offset-3">
                                        <a class="edit-link">编辑HTML</a><a> |
                                        </a><a class="remove-link">移除</a></p>
                                </div>
                            </div>
                            <?php endfor;?>
                        <?php endif;?>



                        <div class="col-md-12 droppable sortable">
                        </div>
                        <div class="col-md-6 droppable sortable" style="display: none;">
                        </div>
                        <div class="col-md-6 droppable sortable" style="display: none;">
                        </div>
                    </div>


                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script src="js/jquery.min.js?v=2.1.4"></script>
<script src="js/jquery-ui-1.10.4.min.js"></script>
<script src="js/plugins/beautifyhtml/beautifyhtml.js"></script>
<script>
    $(document).ready(function(){setup_draggable();$("#n-columns").on("change",function(){var v=$(this).val();if(v==="1"){var $col=$(".form-body .col-md-12").toggle(true);$(".form-body .col-md-6 .draggable").each(function(i,el){$(this).remove().appendTo($col)});$(".form-body .col-md-6").toggle(false)}else{var $col=$(".form-body .col-md-6").toggle(true);$(".form-body .col-md-12 .draggable").each(function(i,el){$(this).remove().appendTo(i%2?$col[1]:$col[0])});$(".form-body .col-md-12").toggle(false)}});$("#copy-to-clipboard").on("click",function(){var $copy=$(".form-body").clone().appendTo(document.body);$copy.find(".tools, :hidden").remove();$.each(["draggable","droppable","sortable","dropped","ui-sortable","ui-draggable","ui-droppable","form-body"],function(i,c){$copy.find("."+c).removeClass(c).removeAttr("style")});var html=html_beautify($copy.html());$copy.remove();$modal=get_modal(html).modal("show");$modal.find(".btn").remove();$modal.find(".modal-title").html("复制HTML代码");$modal.find(":input:first").select().focus();return false})});var setup_draggable=function(){$(".draggable").draggable({appendTo:"body",helper:"clone"});$(".droppable").droppable({accept:".draggable",helper:"clone",hoverClass:"droppable-active",drop:function(event,ui){$(".empty-form").remove();var $orig=$(ui.draggable);if(!$(ui.draggable).hasClass("dropped")){var $el=$orig.clone().addClass("dropped").css({"position":"static","left":null,"right":null}).appendTo(this);var id=$orig.find(":input").attr("id");if(id){id=id.split("-").slice(0,-1).join("-")+"-"+(parseInt(id.split("-").slice(-1)[0])+1);$orig.find(":input").attr("id",id);$orig.find("label").attr("for",id)}$('<p class="tools col-sm-12 col-sm-offset-3">						<a class="edit-link">编辑HTML<a> | 						<a class="remove-link">移除</a></p>').appendTo($el)}else{if($(this)[0]!=$orig.parent()[0]){var $el=$orig.clone().css({"position":"static","left":null,"right":null}).appendTo(this);$orig.remove()}}}}).sortable()};var get_modal=function(content){var modal=$('<div class="modal" style="overflow: auto;" tabindex="-1">	<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><a type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</a><h4 class="modal-title">编辑HTML</h4></div><div class="modal-body ui-front">	<textarea class="form-control" 	style="min-height: 200px; margin-bottom: 10px;font-family: Monaco, Fixed">'+content+'</textarea><button class="btn btn-success">更新HTML</button></div>				</div></div></div>').appendTo(document.body);return modal};$(document).on("click",".edit-link",function(ev){var $el=$(this).parent().parent();var $el_copy=$el.clone();var $edit_btn=$el_copy.find(".edit-link").parent().remove();var $modal=get_modal(html_beautify($el_copy.html())).modal("show");$modal.find(":input:first").focus();$modal.find(".btn-success").click(function(ev2){var html=$modal.find("textarea").val();if(!html){$el.remove()}else{$el.html(html);$edit_btn.appendTo($el)}$modal.modal("hide");return false})});$(document).on("click",".remove-link",function(ev){$(this).parent().parent().remove()});
</script>

