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

$this->title = '申请列表';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>申请列表</h5>
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
                                        <a href="">用户名：<?=$v['user']['nickname'];?></a>
                                    </td>
                                    <td class="project-title">
                                        <a href="">提现：<?=$v['price']?></a>
                                    </td>
                                    <td class="project-title">
                                        <a href="">状态：<?php if($v['status'] == 1):?>已打款<?php else:?>未打款<?php endif;?></a>
                                    </td>
                                    <td class="project-actions">
                                        <a href="<?=Url::toRoute(['tixian/pay','id'=>$v['id'], 'openid'=>$v['openid'], 'price'=>$v['price']])?>" class="btn btn-white btn-sm">
                                            <i class="fa fa-folder"></i>打款</a>
                                        <a href="<?=Url::toRoute(['tixian/update','id'=>$v['id']])?>" class="btn btn-white btn-sm">
                                            <i class="fa fa-folder"></i> 编辑 </a>
                                        <a href="<?=Url::toRoute(['tixian/delete','id'=>$v['id']])?>" class="btn btn-white btn-sm">
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

