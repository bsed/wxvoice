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

$this->title = '提现列表';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>提现列表</h5>
                </div>
                <div class="ibox-content">
                    <!--搜索框-->
<!--                    <div class="search-form">-->
<!--                        <form action="--><?//=Url::toRoute('tixian/index')?><!--" method="post">-->
<!--                            <div class="input-group">-->
<!--                                <input type="text" placeholder="会员名称" name="search" class="form-control input-lg">-->
<!--                                <div class="input-group-btn">-->
<!--                                    <button class="btn btn-lg btn-primary" type="submit">搜索</button>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        </form>-->
<!--                    </div>-->
                    <!--搜索框-->
                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>

                            <?php foreach($list as $k=>$v):?>
                                <tr>
                                    <td class="project-status">
                                            <span class="label label-primary"><?=$k+1?>
                                    </td>
                                    <td class="project-title">
                                        <a>用户名：<?=$v['user']['nickname'];?></a>
                                    </td>
                                    <td class="project-title">
                                        <a href="">提现：<?=$v['price']?></a>
                                    </td>
                                    <td class="project-title">
                                        <a href="">状态：<?php if($v['status'] == 1):?>已打款<?php else:?>未打款<?php endif;?></a>
                                    </td>
                                    <td class="project-title">
                                        <a href="">申请时间：<?=date('Y-m-d H:i:s',$v['created'])?></a>
                                    </td>
                                    <td class="project-title">
                                        <a href="">打款时间：<?=date('Y-m-d H:i:s',$v['updated'])?></a>
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

