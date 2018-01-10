<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AdreseLivrareSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adrese Livrares';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adrese-livrare-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Adrese Livrare', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'clientID',
            'numeDestinatar',
            'persoanaContact',
            'telefon',
            //'adresa',
            //'oras',
            //'judet',
            //'codPostal',
            //'def',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
