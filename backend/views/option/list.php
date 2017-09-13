<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>所有项目</h5>
                    <div class="ibox-tools">
                        <a href="" class="btn btn-primary btn-xs">创建新项目</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-1">
                            <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> 刷新</button>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <input type="text" placeholder="请输入项目名称" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                    </div>

                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <?php foreach($list as $v):?>
                                <tr>
                                    <td class="project-status">
                                            <span class="label label-primary">启用
                                    </td>
                                    <td class="project-title">
                                        <a href=""><?=$v['name']?></a>
                                        <br/>
                                        <small>这里是模型介绍</small>
                                    </td>
                                    <td class="project-completion">
                                        <small>当前进度： <?=$v['id']?>%</small>
                                        <div class="progress progress-mini">
                                            <div style="width: <?=$v['id']?>%;" class="progress-bar"></div>
                                        </div>
                                    </td>

                                    <td class="project-actions">
                                        <a href="<?=Url::toRoute(['option/edit','id'=>$v['id']])?>" class="btn btn-white btn-sm">
                                            <i class="fa fa-folder"></i> 查看 </a>
                                        <a href="<?=Url::toRoute(['option/del','id'=>$v['id']])?>" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 删除 </a>
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

