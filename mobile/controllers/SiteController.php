<?php
namespace mobile\controllers;


use Yii;
use mobile\controllers\BaseController;
use common\tools\htmls;
use mobile\models\Questions;
use mobile\models\Articles;
use mobile\models\Products;
use mobile\models\Banners;
use mobile\models\Members;
use mobile\models\Experts;
use mobile\models\Circles;
use mobile\models\Dianzan;




class SiteController extends BaseController
{


    /*
     * 首页
     */
    public function actionIndex()
    {
        $mid = Yii::$app->session['member_id'];
        //轮播图
        $banner = htmls::getPiece('hdp');

        //问题，包括语音问答
        $questionModel = new Questions();
        $questions = $questionModel->find()->where(['rec'=>1])->with('expert')->limit(3)->all();
        //楼盘推荐
        $model = new Products();
        $recLoupan = $model->find()->asarray()->where(['rec'=>1])->limit(3)->all();




        return $this->render('index',[
            'questions'=>$questions,
            'banner'=>$banner,
            'recLoupan'=>$recLoupan,
        ]);
    }
    /*
     * 搜索
     */
    public function actionSearch(){

        $mid = Yii::$app->session['member_id'];
        //关键词
        $keys = $_GET['keys'];
        //行家 expert
        $expertModel = new Members();
        $expert = $expertModel->find()->asarray()->where(['like','nickname',$keys])->with('expert')->andwhere(['vip'=>1])->all();
        //圈子 circle
        $circleModel = new Circles();
        $circle = $circleModel->find()->asarray()->where(['like','name',$keys])->with('user','incircle')->all();
        //问答 ask
        $questionModel = new Questions();
        $ask = $questionModel->find()->asarray()->where(['like','question',$keys])->andwhere(['status'=>2])->with('expert','dianzan','comment')->all();
        //论坛
        $articlesModel = new Articles();
        $articles = $articlesModel->find()->asarray()->where(['like','title',$keys])->andwhere(['from'=>'index'])->with('user','dianzan','comment','redpocket')->all();

        return $this->render('search',[
            "expert"=>$expert,
            "circle"=>$circle,
            "ask"=>$ask,
            "mid"=>$mid,
            "articles"=>$articles,
        ]);
    }





}
