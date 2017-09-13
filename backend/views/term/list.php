<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '栏目管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>栏目管理</h5>
                    </div>
                    <div class="ibox-content">
                        <div id="tree"></div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="js/plugins/treeview/bootstrap-treeview.js"></script>
<script>
    $(function() {
        var json =<?=$json?>;
        $("#tree").treeview({
            levels:1,
            backColor: "#fff",
            enableLinks: true,
            showTags:true,
            data: json,
            highlightSelected:false
        })
    });

</script>
<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet"
<script src="js/jquery.min.js?v=2.1.4"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<script>
    $(document).delegate('.del',"click",function(){
         var id = $(this).data('id');
             $.post("<?=Url::toRoute(['term/del'])?>",
                 {   'id':id,
                     '_csrf-backend':'<?php echo Yii::$app->request->csrfToken; ?>'
                 },
                 function(s){
                 if(s.status == 1){
                   mess();
                 }else if(s.status == 2){
                     window.location.reload();
                 }

             },'json');
    })


</script>
<script>
    function mess()
    {
        toastr.info("包含子栏目，不能删除", "警告");
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "600",
            "hideDuration": "1000",
            "timeOut": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
</script>