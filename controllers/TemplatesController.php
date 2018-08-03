<?php
namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\models\Templates;
use yii\helpers\ArrayHelper;

class TemplatesController extends ActiveController
{
    public $modelClass = 'app\models\Templates';

    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
            [
               'class' => 'yii\filters\ContentNegotiator',
               'only' => ['index', 'view','create','update','search'],
               'formats' => ['application/json' =>Response::FORMAT_JSON]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'=>['get'],
                    'view'=>['get'],
                    'create'=>['post'],
                    'update'=>['PUT'],
                    'delete' => ['delete'],
                    'search'   => ['get']
                ]
            ]
        ]);
    }

    public function actionUser($type,$id) {
        return new ActiveDataProvider([
            'query' => Templates::find()->where(['clientID'=>$id,'tipProdus'=>$type])
        ]);
    }
}

/*
RESURSE:

https://www.yiiframework.com/doc/guide/2.0/en/rest-resources
*/