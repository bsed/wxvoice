<?php

namespace common\widgets\multi_uploader\assets;

use Yii;
use yii\web\AssetBundle;


class FileUploadAsset extends AssetBundle
{
    public $css = [
        
    ];
    
    public $js = [

    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
 
  
    /**
     * 初始化：sourcePath赋值
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        $sourcePath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR . 'statics';
    }
}