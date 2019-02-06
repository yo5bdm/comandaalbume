<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de comenzi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <p>
        <?= Html::a('Comanda noua', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [            
            ['attribute' => 'id',
                'label'=>'Nr Comanda',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a('#'.$data->id.' / '.Yii::$app->formatter->asDate($data->dataPlasat),['orders/view','id'=>$data->id]);
                },
                
            ],
            ['attribute' => 'clientID',
                'label' => 'Plasat de',
                'format' => 'raw',
                'value' => function( $data ) {
                    if($data->client === null) {
                        return '[invalid user]';
                    } else {
                        if(Yii::$app->user->identity->userType == 0 || Yii::$app->user->identity->userType == 1) { 
                            return Html::a($data->client->numeComplet,['users/view','id'=>$data->client->id]); 
                        }
                        else { 
                            return $data->client->numeComplet; 
                        }
                    }
                },
            ],
            ['attribute' => 'workerID',
                'label' => 'Preluat de',
                'value' => function( $data ) {
                    if($data->worker === null) {
                        return '[nepreluat]';
                    } else {
                        return $data->worker->numeComplet; 
                    }
                },
            ],
            ['attribute' => 'status',
                'label' => 'Starea comenzii',
                'value' => function( $data ) {
                    if($data->status === null) {
                        return '[invalid status]';
                    } else {
                        return $data->statuses->denumire; 
                    }
                },
            ],
            ['attribute' =>'pretTotal',
                'label' => 'Pret Total',
                'value' => function( $data ) {
                    return $data->pretTotal." lei";
                },
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
