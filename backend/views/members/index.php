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

$this->title = '会员列表';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>会员列表</h5>
                    <div class="ibox-tools">
                        <a href="<?=Url::toRoute(['members/create'])?>" class="btn btn-primary btn-xs">创建会员</a>
                    </div>
                </div>

                <div class="ibox-content">
                <!--搜索框-->
                    <div class="search-form">
                        <form action="<?=Url::toRoute('members/index')?>" method="post">
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
                            <?php foreach($list as $k=>$v):?>
                                <tr>
                                    <td class="project-status">
                                            <span class="label label-primary"><?=$k+1?>
                                    </td>
                                    <td class="project-title">
                                        <a href=""><?=$v['nickname']?></a>
                                    </td>
                                    <td class="project-completion">
                                        <?php if($v['vip'] == 1):?>
                                            <span class="label label-primary">专家</span>
                                        <?php else:?>
                                                <span class="label label-defaul">专家</span>
                                        <?php endif;?>


                                    </td>
                                    <td class="project-completion">
                                        <?php if(!empty($v['wxpayrecord'])):?>
                                            <?php if($v['wxpayrecord'][0]['status'] == 1):?>
                                      <span class="label label-defaul">会员有效期：<?=date('Y-m-d H:i:s',$v['wxpayrecord'][0]['created'])?>至<?=date('Y-m-d',strtotime('+1 year'));?></span>
                                                <?php endif;?>
                                        <?php endif;?>
                                    </td>
                                    <td class="project-actions">
                                        <a href="<?=Url::toRoute(['members/update','id'=>$v['id']])?>" class="btn btn-white btn-sm">
                                            <i class="fa fa-folder"></i> 查看 </a>
                                        <a href="<?=Url::toRoute(['members/delete','id'=>$v['id']])?>" class="btn btn-white btn-sm">
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

