<?php
/**
 * Created by PhpStorm.
 * User: huamai
 * Date: 2017/6/8
 * Time: 下午3:25
 */

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\tools\htmls;

$this->title = '问题列表';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>收听列表</h5>
                </div>
                <div class="ibox-content">

                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <?php foreach($list as $k=>$v):?>
                                <tr>
                                    <td class="project-status">
                                            <span class="label label-primary"><?=$k+1?>
                                    </td>
                                    <td class="project-title">
                                        <a href=""><?=$v['user']['nickname']?></a>
                                    </td>
                                    <td class="project-title">
                                        <span class="label label-default">收听了</span>
                                    </td>
                                    <td class="project-completion">
                                        <a href="<?=Url::toRoute(['questions/update','id'=>$v['id']])?>">
                                        <span class="label label-primary"><?=htmls::substr($v["question"]["question"],50)?></span>
                                        </a>
                                    </td>
                                    <td class="project-completion">


                                    </td>
                                    <td class="project-actions">
                                        <a href="<?=Url::toRoute(['listens/delete','id'=>$v['id']])?>" class="btn btn-white btn-sm">
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

