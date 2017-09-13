<?php

/**
 * Created by PhpStorm.
 * User: yanli
 * Date: 2017/2/26
 * Time: 14:41
 */
namespace  common\tools;

use backend\models\adds\banner\BannerModel;
use backend\models\ArticleModel;
use backend\models\options\OptionsModel;
use backend\models\PageModel;
use backend\models\TermModel;
use Yii;
use yii\data\Pagination;

class Alidayu
{
    public $appkey;
    public $secretKey;
    public $gatewayUrl = "http://gw.api.taobao.com/router/rest";

    public $format = "json";
    protected $signMethod = "md5";
    protected $apiVersion = "2.0";
    protected $sdkVersion = "top-sdk-php-20151012";

    public function __construct($appkey = "",$secretKey = ""){
        $this->appkey = $appkey;
        $this->secretKey = $secretKey ;
    }

    protected function generateSign($params)
    {
        ksort($params);
        $stringToBeSigned = $this->secretKey;
        foreach ($params as $k => $v){
            if(is_string($v) && "@" != substr($v, 0, 1)){
                $stringToBeSigned .= "$k$v";
            }
        }
        $stringToBeSigned .= $this->secretKey;
        return strtoupper(md5($stringToBeSigned));
    }

    public function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        $reponse = curl_exec($ch);
        curl_close($ch);
        return $reponse;
    }

    public function execute($requestMethod, $apiParams)
    {
        $sysParams["app_key"] = $this->appkey;
        $sysParams["v"] = $this->apiVersion;
        $sysParams["format"] = $this->format;
        $sysParams["sign_method"] = $this->signMethod;
        $sysParams["method"] = $requestMethod;
        $sysParams["timestamp"] = date("Y-m-d H:i:s");
        $sysParams["partner_id"] = $this->sdkVersion;
        $sysParams["sign"] = $this->generateSign(array_merge($apiParams, $sysParams));

        $requestUrl = $this->gatewayUrl."?";
        foreach ($sysParams as $sysParamKey => $sysParamValue)
        {
            $requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
        }
        $requestUrl = substr($requestUrl, 0, -1);
        $resp = $this->curl($requestUrl, $apiParams);
        $respObject = json_decode($resp, true);
        return $respObject;
    }
}
