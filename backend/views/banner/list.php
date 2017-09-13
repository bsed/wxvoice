<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\tools\htmls;

$this->title = '碎片列表';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>碎片</h5>
                    <div class="ibox-tools">
                        <a href="<?=Url::toRoute(['banner/add'])?>" class="btn btn-primary btn-xs">创建新碎片</a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="project-list">
                        <?php $form = ActiveForm::begin(); ?>
                        <?php $model->type = $type; ?>
                        <?= $form->field($model, 'type')->dropDownList($data)->label('筛选类型:') ?>
                        <?php ActiveForm::end(); ?>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $("#bannermodel-type").change(function(){
                                    var value=$("#bannermodel-type :selected").val();
                                    $('#w0').submit();
                                });
                            });
                        </script>
                        <table class="table table-hover">
                            <tbody>
                              <?php foreach($list as $v):?>
                                <tr>
                                    <td class="project-status">
                                            <span class="label label-primary"><?=$v['listorder']?>
                                    </td>
                                    <td class="project-title">
                                        <a href=""><?=$v['name']?></a>
                                        <br/>
                                        <small>显示位置：<?=htmls::BannerType($v['type'])?></small>
                                    </td>
                                    <td class="project-completion">
                                        <span class="label label-primary">
                                            <small style="margin-left: 20px">代码调用：<?=$v['type']?></small>
                                        </span>
                                    </td>
                                        <td class="project-actions">
                                            <a href="<?=Url::toRoute(['banner/edit','id'=>$v['id']])?>" class="btn btn-white btn-sm">
                                                <i class="fa fa-folder"></i> 查看 </a>
                                            <a href="<?=Url::toRoute(['banner/del','id'=>$v['id']])?>" class="btn btn-white btn-sm">
                                                <i class="fa fa-pencil"></i> 删除 </a>
                                        </td>
                                </tr>
                            <?php endforeach;?>


                            </tbody>
                        </table>
                        <!--分页-->
                        <div class="f-r">
                            <?= LinkPager::widget([
                                'pagination'=>$pages,
                                'firstPageLabel' => '首页',
                                'nextPageLabel' => '下一页',
                                'prevPageLabel' => '上一页',
                                'lastPageLabel' => '末页',
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

