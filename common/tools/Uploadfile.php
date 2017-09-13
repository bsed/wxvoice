<?php
namespace  common\tools;

use Yii;
use yii\data\Pagination;

class Uploadfile
{
    public $image_file;
    /*
     * 测试将base64转为图片
     */
    public function base64_images($base64,$path){
        $base64_image = str_replace(' ', '+', $base64);
        $rep = "/^(data:\s*image\/(\w+);base64,)/";
          if (preg_match($rep, $base64_image, $result)){
            //得到文件重新生成的名字
            $file_name = $this->fileFullName($path);
            //文件所在的目录
            $fullname = $file_name.".".$result[2];
            $image_file = $path.$fullname;
            if (file_put_contents($image_file, base64_decode(str_replace($result[1], '', $base64_image)))){
                return $fullname;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function base64_videos($base64,$path){
        $base64_image = str_replace(' ', '+', $base64);
        $rep = "/^(data:\s*video\/(\w+);base64,)/";
        if (preg_match($rep, $base64_image, $result)){
            //得到文件重新生成的名字
            $file_name = $this->fileFullName($path);
            //文件所在的目录
            //$fullname = $file_name.".".$result[2];
            $fullname = $file_name.".mp4";
            $image_file = $path.$fullname;
            if (file_put_contents($image_file, base64_decode(str_replace($result[1], '', $base64_image)))){
                return $fullname;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function fileFullName($path){
        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = "超出上传限制";
            return;
        }
        //创建目录失败
        if (!file_exists($path) && !mkdir($path, 0777, true)) {
            $this->stateInfo = "创建目录失败";
            return;
        } else if (!is_writeable($path)) {
            $this->stateInfo = "系统权限不足";
            return;
        }

        $file_name = rand(13,909) . time() . rand(1,899);
        return $file_name;
    }


    /**
     * 文件大小检测
     * @return bool
     */
    private function  checkSize()
    {
        return $this->fileSize = '529849';
    }










}