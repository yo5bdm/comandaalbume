<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdusedisponibileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produsedisponibiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produsedisponibile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Produsedisponibile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //'descriere',
            ['attribute' => 'descriere',
                'label'=>'Numele produsului',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->descriere,['produsedisponibile/view','id'=>$data->id]);
                },
                
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
