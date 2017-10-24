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

$this->title = '财务管理';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>财务管理</h5>
                </div>
                <div class="ibox-content">
                    <!--搜索框-->
                    <div class="search-form">
                        <form action="<?=Url::toRoute('tixian/caiwu')?>" method="post">
                            <div class="input-group">
                                <input type="text" placeholder="会员名称" name="search" class="form-control input-lg">
                                <div class="input-group-btn">
                                    <button class="btn btn-lg btn-primary" type="submit">搜索</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!--搜索框-->
                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td class="project-status">
                                    <span class="label label-primary">汇总
                                </td>
                                <td class="project-title">
                                    <span class="label label-primary">总金额：<?=$totalSum;?>
                                </td>
                                <td class="project-title">
                                     <span class="label label-primary">已提现金额：<?=$tixiansSum;?>
                                </td>
                                <td class="project-title">
                                    <span class="label label-primary">未提现总金额：<?=$totalSum - $tixiansSum;?>
                                </td>
                                <td class="project-title">

                                </td>
                                <td class="project-title">
                                </td>
                            </tr>
                            <?php foreach($list as $k=>$v):?>
                                <tr>
                                    <td class="project-status">
                                            <span class="label label-primary"><?=$k+1?>
                                    </td>
                                    <td class="project-title">
                                        <a href="">用户名：<?=$v['nickname']?></a>
                                    </td>
                                    <td class="project-title">
                                        <a href="">总金额：<?=$total[$k];?>元</a>
                                    </td>
                                    <td class="project-title">
                                        <a href="">已提现：<?=$tixian[$k];?>元</a>
                                    </td>
                                    <td class="project-title">
                                        <a href="">未提现：<?=number_format($total[$k] - $tixian[$k],2);?>元</a>
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

