<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = "Comanda #".$model->id.' / '.Yii::$app->formatter->asDate($model->dataPlasat);
$this->params['breadcrumbs'][] = ['label' => 'Comenzi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
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
    ]) ?>
    <p>
        <?= Html::a('Marcheaza ca ...', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
