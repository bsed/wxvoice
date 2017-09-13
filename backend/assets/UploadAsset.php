<?php
namespace backend\assets;

use yii\web\AssetBundle;

class UploadAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/upload.js'
    ];
    public $depends = [
        'backend\assets\PluploadAsset',
    ];
}