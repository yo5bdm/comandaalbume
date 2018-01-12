<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Elementecomanda */

$this->title = 'Update Elementecomanda: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Elementecomandas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elementecomanda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
