<?php
namespace common\widgets\front_file_upload;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\web\View;
use common\widgets\front_file_upload\assets\FileUploadAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class FileUpload extends InputWidget
{
    public $config = [];
    
    public $value = '';
    
    public function init()
    {
        $_config = [
            'serverUrl' => Url::to(['upload','action'=>'uploadimage']),  //上传服务器地址
            'fileName' => 'upfile',                                      //提交的图片表单名称 
            'domain_url' => Yii::$app->params['getimg'],                  //图片域名 不填为当前域名
            'imgUrl' => Yii::$app->params['imgurl'],
        ];
        $this->config = ArrayHelper::merge($_config, $this->config);
    }
    
    public function run()
    {
        $this->registerClientScript();        
        if ($this->hasModel()) {
            $inputName = Html::getInputName($this->model, $this->attribute);
            $inputValue = Html::getAttributeValue($this->model, $this->attribute);
            return $this->render('index',[
                'config'=>$this->config,
                'inputName' => $inputName,
                'inputValue' => $inputValue,
                'attribute' => $this->attribute,
            ]);
        } else {
            return $this->render('index',[
                'config'=>$this->config,
                'inputName' => 'file-upload',
                'inputValue'=> $this->value,
                'attribute' => 'photo',
            ]);
        }
    }
    
    public function registerClientScript()
    {
        FileUploadAsset::register($this->view);
    }
}