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

$this->title = '红包列表';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>红包列表</h5>
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
                                    <td class="project-completion">
                                        <span class="label label-primary">发了<?=$v['pocket_nums']?>个</span>
                                    </td>
                                    <td class="project-completion">
                                        <span class="label label-primary">
                                            共<?=$v['total_money']?>元的红包给
                                        </span>
                                    </td>
                                    <td class="project-completion">
                                        <span class="label label-primary">
                                            <?php if($v['give_type'] == 1):?>粉丝<?php elseif($v['give_type'] ==0):?>新人<?php endif;?>
                                        </span>
                                    </td>
                                    <td class="project-completion">
                                        <span class="label label-primary">并写到：<?=$v['message']?></span>
                                    </td>

                                    <td class="project-actions">
                                        <a href="<?=Url::toRoute(['pocketcomment/delete','id'=>$v['id']])?>" class="btn btn-white btn-sm">
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

