<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Produsedisponibile */

$this->title = 'Update Produsedisponibile: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Produsedisponibiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produsedisponibile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
