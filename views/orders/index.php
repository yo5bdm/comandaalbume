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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Comanda noua', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [            
            'id',
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
            ['attribute' => 'dataPlasat',
                'header' => 'Data comenzii',
                'value' => function( $data ) {
                    return Yii::$app->formatter->asDate($data->dataPlasat);
                },
            ],
            'pretTotal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
