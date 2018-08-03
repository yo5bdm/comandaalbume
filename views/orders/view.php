<?php

use app\models\Orders;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this View */
/* @var $model Orders */

$this->title = "Comanda #".$model->id.' / '.Yii::$app->formatter->asDate($model->dataPlasat);
$this->params['breadcrumbs'][] = ['label' => 'Comenzi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" ng-app="myApp" ng-controller="myCtrl">
    <div class="col-lg-9">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php if(Yii::$app->user->identity->userType != 2) { 
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                ['attribute' => 'clientID',
                    'label' => 'Nume Client',
                    'value' => function( $data ) {
                        if($data->client === null) {
                            return '';
                        } else {
                            return $data->client->numeComplet; 
                        }
                    },
                ],
                ['attribute' => 'workerID',
                    'label' => 'Nume Lucrator',
                    'value' => function( $data ) {
                        if($data->worker === null) {
                            return '';
                        } else {
                            return $data->worker->numeComplet; 
                        }
                    },
                ],
                ['attribute' => 'status',
                    'label' => 'Starea comenzii',
                    'value' => function( $data ) {
                        if($data->status === null) {
                            return '';
                        } else {
                            return $data->statuses->denumire; 
                        }
                    },
                ],
                ['attribute' => 'pretTotal',
                    'label' => 'Pret total comanda'
                ],
            ],
        ]); } else {
            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    ['attribute' => 'status',
                        'header' => 'Starea comenzii',
                        'value' => function( $data ) {
                            if($data->status === null) {
                                return '';
                            } else {
                                return $data->statuses->denumire; 
                            }
                        },
                    ],
                    'pretTotal'
                ],
            ]);
        } ?>
    <h3>Lista de produse din comanda curenta</h3>
    <?php //Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $produse,
        'columns' => [
            [
                'attribute' => 'descriere',
                'format' => 'text',
                'label' => 'Descriere',
                'format' => 'raw',
                'value' =>function($data) {
                    $json = json_decode($data->descriere);
                    $ret ="<h4>Produsul comandat: <strong>".ucfirst($json->produs)."</strong></h4>";
                    $ret .= "<p>Pret: <strong>".$json->pretTotal." Lei</strong></p>";
                    $ret .= "<p>Obs: <strong>'".$json->observatii."'</strong></p>";
                    return $ret;
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actiuni',
                'template'=>'{leadView} {leadUpdate} {leadDelete}',
                'buttons' => [
                    'leadView'   => function ($url, $model) { //view
                        return Html::a('<span class="glyphicon glyphicon-search"></span>', ['produse/view', 'id' => $model->id], ['title' => 'view']);
                    },
                    'leadUpdate' => function ($url, $model) { //edit
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['produse/update', 'id' => $model->id], ['title' => 'update']);
                    },
                    'leadDelete' => function ($url, $model) { //delete
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['produse/delete', 'id' => $model->id], [
                            'title'        => 'delete',
                            'data-confirm' => Yii::t('yii', 'Sigur vrei sa stergi?'),
                            'data-method'  => 'post',
                        ]);
                    },
                ]
            ],
        ],
    ]) ?>
    <?php //Pjax::end() ?>
    
    </div>
    <div class="col-lg-3">
        <div ng-hide="isWorker()">
        <h3 class="text-center">Adauga in comanda:</h3>
        <?php 
        //http://blog.neattutorials.com/yii2-pjax-tutorial/
        echo Html::a('Adauga Album',['orders/adaugaalbum','id'=>1],['class' => 'btn btn-primary btn-block']);
        //echo Html::a('Adauga Cutie Album Lux',['orders/adaugacutie','id'=>1],['class' => 'btn btn-primary btn-block']);
        echo Html::a('Adauga Mape DVD',['orders/adaugamapadvd','id'=>1],['class' => 'btn btn-primary btn-block']);
        //echo Html::a('Adauga Print foto',['orders/adaugaprint','id'=>1],['class' => 'btn btn-primary btn-block']);
        echo Html::a('Adauga Cutie Stick',['orders/adaugacutiestick','id'=>1],['class' => 'btn btn-primary btn-block']);
        ?>
        </div>
        <h3>Actiuni</h3>
        <?php 
        foreach($status as $stat) {
            if(Yii::$app->user->identity->userType == $stat->userType || Yii::$app->user->identity->userType == 0){
                echo Html::a('Marcheaza ca '.$stat->denumire, ['modifica', 'id' => $model->id,'status'=>$stat->id], ['class' => 'btn btn-primary btn-block']);
            }
        }
        if(Yii::$app->user->identity->userType == 0) echo Html::a('Sterge Comanda', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-block',
            'data' => [
                'confirm' => 'Esti sigur ca vrei sa stergi comanda?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    
</div>
<script type="text/javascript">
    var app = angular.module("myApp", []);
    app.controller("myCtrl", ['$scope', function($scope) {
        $scope.userType = <?=Yii::$app->user->identity->userType?>;
        $scope.isWorker = function() {
            console.log($scope.userType);
            if($scope.userType==1) return true;
        };
    }]);
</script>
<?php 
//https://bootsnipp.com/snippets/featured/clean-modal-login-form
$this->registerCss(".loginmodal-container {
  padding: 30px;
  width: 100% !important;
  background-color: #F7F7F7;
  margin: 0 auto;
  border-radius: 2px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  overflow: hidden;
  font-family: roboto;
}

.loginmodal-container input[type=text], input[type=password] {
  height: 44px;
  font-size: 16px;
  width: 100%;
  margin-bottom: 10px;
  -webkit-appearance: none;
  background: #fff;
  border: 1px solid #d9d9d9;
  border-top: 1px solid #c0c0c0;
  /* border-radius: 2px; */
  padding: 0 8px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.loginmodal-container input[type=text]:hover {
  border: 1px solid #b9b9b9;
  border-top: 1px solid #a0a0a0;
  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
}

.loginmodal {
  text-align: center;
  font-size: 14px;
  font-family: 'Arial', sans-serif;
  font-weight: 700;
  height: 36px;
  padding: 0 8px;
/* border-radius: 3px; */
/* -webkit-user-select: none;
  user-select: none; */
}

.loginmodal-submit {
  /* border: 1px solid #3079ed; */
  border: 0px;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.1); 
  background-color: #4d90fe;
  padding: 17px 0px;
  font-family: roboto;
  font-size: 14px;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
}

.loginmodal-submit:hover {
  /* border: 1px solid #2f5bb7; */
  border: 0px;
  text-shadow: 0 1px rgba(0,0,0,0.3);
  background-color: #357ae8;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
}

.loginmodal-container a {
  text-decoration: none;
  color: #666;
  font-weight: 400;
  text-align: center;
  display: inline-block;
  opacity: 0.6;
  transition: opacity ease 0.5s;
} 

.login-help{
  font-size: 12px;
}");
?>