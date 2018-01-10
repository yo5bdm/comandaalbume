<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AdreseLivrare */

$this->title = 'Create Adrese Livrare';
$this->params['breadcrumbs'][] = ['label' => 'Adrese Livrares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adrese-livrare-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
