<?php
/**
 * Created by PhpStorm.
 * User: yanli
 * Date: 2017/2/22
 * Time: 9:51
 */
namespace backend\controllers;

use Yii;
use backend\models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\models\ItemForm;
use yii\helpers\Json;

class ContentController extends Controller{

      public function actionIndex()
      {
          return $this->render('index');
      }


}