<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = '综合管理系统';
?>
<div class="wrapper wrapper-content">
    <?php if(\Yii::$app->user->can('/site/index')):?>
    <div class="row">
        <div class="col-md-12">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>登录IP</th>
                            <th>登录时间</th>
                            <th>备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($log as $vo):?>
                            <tr>
                                <td><?=$vo['id']?></td>
                                <td><?=$vo['username']?></td>
                                <td><?=$vo['ip']?></td>
                                <td><?= date('Y-m-d H:i:s',$vo['create_time'])?></td>
                                <td><?=str_replace('-','',$vo['data'])?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <!--分页-->
                    <div class="f-r">
                        <?= LinkPager::widget([
                            'pagination'=>$pages,
                            'firstPageLabel' => '首页',
                            'nextPageLabel' => '下页',
                            'prevPageLabel' => '上页',
                            'lastPageLabel' => '末页',
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <?php endif;?>


        <div class="col-sm-12">
            <div id="history"></div>
        </div>



<?=Html::jsFile('@web/js/plugins/Highcharts/4.1.7/js/highcharts.js')?>
<?=Html::jsFile('@web/js/plugins/Highcharts/4.1.7/js/modules/exporting.js')?>


<script type="text/javascript">
    $(function () {
        $('#history').highcharts({
            title: {
                text: '',
                x: -20 //center
            },
            credits: { enabled:false }, //屏蔽右下角
            exporting: { enabled:false }, //屏蔽右上角
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: [<?=$HistoryMonthStr?>]
            },
            yAxis: {

                title: {
                    text: '访客/人'
                },
                //min: 7.5, // 这个用来控制y轴的开始刻度（最小刻度），另外还有个表示最大刻度的max属性
                startOnTick: false, // y轴坐标是否从某刻度开始（这个设定与标题无关）
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '人',
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y:,.0f} 人</b><br/>',
                shared: true
            },
            /*legend: {
             layout: 'vertical',
             align: 'right',
             verticalAlign: 'middle',
             borderWidth: 0
             },*/
            series: [{
                name: '访客数',
                data: [<?=$HistoryMonthNum?>]
            }]
        });
    });
</script>
