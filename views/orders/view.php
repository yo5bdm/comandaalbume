<?php

use app\models\Orders;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $model Orders */

$this->title = "Comanda #".$model->id.' / '.Yii::$app->formatter->asDate($model->dataPlasat);
$this->params['breadcrumbs'][] = ['label' => 'Comenzi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-9">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?php //if(Yii::$app->user->identity->userType == 2) echo Html::a('Actualizeaza', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
            <?php if(Yii::$app->user->identity->userType == 0) echo Html::a('Sterge', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?php 
                foreach($status as $stat) {
                    if(Yii::$app->user->identity->userType == $stat->userType || Yii::$app->user->identity->userType == 0){
                        echo Html::a('Marcheaza ca '.$stat->denumire, ['modifica', 'id' => $model->id,'status'=>$stat->id], ['class' => 'btn btn-primary']);
                        echo "&nbsp";
                    }
                }
            ?>
        </p>
        <?php if(Yii::$app->user->identity->userType != 2) { 
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                ['attribute' => 'clientID',
                    'header' => 'Nume Client',
                    'value' => function( $data ) {
                        if($data->client === null) {
                            return '';
                        } else {
                            return $data->client->numeComplet; 
                        }
                    },
                ],
                ['attribute' => 'workerID',
                    'header' => 'Nume Lucrator',
                    'value' => function( $data ) {
                        if($data->worker === null) {
                            return '';
                        } else {
                            return $data->worker->numeComplet; 
                        }
                    },
                ],
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
                'pretTotal',
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
                    'pretTotal',
                ],
            ]);
        } ?>
    </div>
    <div class="col-lg-3">
        <h3 class="text-center">Adauga in comanda:</h3>
        <?php 
        //http://blog.neattutorials.com/yii2-pjax-tutorial/
        foreach($produseDisponibile as $produs) {
            $idul = 'id'.$produs->id;
            Modal::begin([
                'header' => '<h4>'.$produs->descriere.'</h4>',
                'closeButton' => [],
                'toggleButton' => ['label' => $produs->descriere, 'class' => 'btn btn-primary btn-block', 'id'=>$idul],
            ]); 
            $requestUrl = yii\helpers\Url::to(['orders/pjax','id'=>$produs->id]);
            $modalJs = "
            $('#$idul').on('click', function () {    
                $.get('$requestUrl', {},
                    function (data) {
                       $('.modal-body').html(data);
                    }  
                ); 
            });";
            $this->registerJs($modalJs );
            Modal::end();
            echo '&nbsp;';
        }?>
    </div>
    
</div>
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