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

$this->title = '流水列表';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>流水列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>

                            <?php foreach($list as $k=>$v):?>
                                <tr>
                                    <td class="project-status">
                                            <span class="label label-gray"><?=$k+1?>
                                    </td>
                                    <td class="project-title">
                                            <span class="label label-primary"><?=$v['users']['nickname'];?>
                                    </td>
                                    <td class="project-title">
                                        <?php if($v['status'] == 1):?>
                                        <span class="label label-primary">已支付</span>
                                        <?php else:?>
                                            <span class="label label-gray">未支付</span>
                                        <?php endif;?>
                                    </td>
                                    <td class="project-title">
                                        <span class="label label-primary"><?=$v['price'];?></span>
                                    </td>
                                    <td class="project-title">
                                        <?php if($v['pay_type'] == 'feeuser'):?>
                                            <span class="label label-gray">会员收入</span>
                                                <?php elseif($v['pay_type'] == 'circle'):?>
                                                    <span class="label label-gray">圈子收入</span>
                                        <?php endif;?>
                                    </td>
                                    <td class="project-title">
                                            <span class="label label-primary"><?=date('Y-m-d H:i:s',$v['created']);?>
                                    </td>
                                    <td class="project-title">

                                    </td>
                                    <td class="project-title">

                                    </td>
                                    <td class="project-title">

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

