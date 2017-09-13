<?php

namespace  common\tools;

use backend\models\adds\banner\BannerModel;
use backend\models\ArticleModel;
use backend\models\options\OptionsModel;
use backend\models\PageModel;
use backend\models\TermModel;
use Yii;
use yii\data\Pagination;
use mobile\models\Dianzan;


class htmls
{
    /*
     * 网站设置信息
     * */
    public static function site()
    {
        $info = OptionsModel::find()->where(['type'=>'website'])->asArray()->one();
        $value = json_decode($info['value'], true);

        return $value;
    }
    /*
     * 显示导航
     * */
    public static function nav($pid)
    {
      $info = TermModel::find()->where(['pid'=>$pid])->asArray()->all();
      return $info;
    }
    /*
     * 显示碎片类别
     * $name string
     * return string
     * */
    public static function BannerType($name)
    {
            $info = OptionsModel::find()->where(['type' => 'bannertype'])->one();
            $value = json_decode($info['value'], true);
            $flip = array_flip($value['mingzi']);
            $infos = $value['text'][$flip[$name]];
        return $infos;
    }

    /*
     * 前台碎片化调用
     * @tablename = 'banner'
     * @ return array
     * */
    public static function getPiece($type)
    {
        $info = BannerModel::find()->where(['type' => $type])->asArray()->all();
        return $info;
    }
    /*
     * 获取文章相关信息，推荐，置顶，分页等
     * @type : rec, status, stick
     * @limit : int
     * @order : DESC or ASC
     * */
    public static function getAr($where=[], $size='', $orderBy = ['listorder' => SORT_DESC] )
    {
        $data = ArticleModel::find()->where($where);
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => $size]);
        $list = $data
                ->asArray()
                ->orderBy($orderBy)
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
       return ['list' =>$list, 'pages'=>$pages];
    }

    /*
     * 获取指定id文章内容
     * */

    public static  function ar()
    {
        $id = $_GET['id'];
        $model =ArticleModel::findOne($id);
        $hits = $model['hits'];
        $model-> hits = $hits + 1;
        $model->save();
        $info =  ArticleModel::find()->where(['id'=>$id])->one();
        return $info;
    }
    /*
     * 面包屑
     * */
    public static  function getBread($id)
    {
        $arr = TermModel::find()->asArray()->all();
        $info = self::bread($arr, $id);
        $list = [];
        for($i=0;$i<=count($info)-1;$i++){
            $list[] = $info[$i]['text'];
        }
        $array = array_reverse($list);
        return $array;

    }
      public static  function bread($arr,$id){
            static $list;
            foreach($arr as $v){
                if($v['id'] == $id){
                    $list[] =$v;
                    self::bread($arr,$v['pid']);
                }
            }
            return $list;
        }

        public static function page($pid)
        {
          $info = PageModel::find()->asArray()->where(['pid'=>$pid])->one();
          return $info;
        }
      //截取字符串
    public static function substr($string, $length, $etc = '...')
    {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)
        {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
            {
                if ($length < 1.0)
                {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            }
            else
            {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen)
        {
            $result .= $etc;
        }
        return $result;
    }
    //友好的显示距离发布文章时间已经过去多长时间
    public static function formatTime($time){
        $now=time();
        $day=date('Y-m-d',$time);
        $today=date('Y-m-d');
        $dayArr=explode('-',$day);
        $todayArr=explode('-',$today);
        //距离的天数，这种方法超过30天则不一定准确，但是30天内是准确的，因为一个月可能是30天也可能是31天
        $days=($todayArr[0]-$dayArr[0])*365+(($todayArr[1]-$dayArr[1])*30)+($todayArr[2]-$dayArr[2]);
        //距离的秒数
        $secs=$now-$time;
        if($todayArr[0]-$dayArr[0]>0 && $days>3){//跨年且超过3天
            return date('Y-m-d',$time);
        }else{
            if($days<1){//今天
                if($secs<60)return $secs.'秒前';
                elseif($secs<3600)return floor($secs/60)."分钟前";
                else return floor($secs/3600)."小时前";
            }else if($days<2){//昨天
                $hour=date('h',$time);
                return "昨天".$hour.'点';
            }elseif($days<3){//前天
                $hour=date('h',$time);
                return "前天".$hour.'点';
            }else{//三天前
                return date('m月d号',$time);
            }
        }
    }
    /*
     * 是否给搜索中的文搭点赞
     */
    public static function dianzan($qid){
        $mid = Yii::$app->session['member_id'];
        $list = Dianzan::find()->asarray()->where(['member_id' => $mid, 'question_id' => $qid])->count();
        return $list;
    }



}