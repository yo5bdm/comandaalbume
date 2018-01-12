<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Produsedisponibile */

$this->title = 'Create Produsedisponibile';
$this->params['breadcrumbs'][] = ['label' => 'Produsedisponibiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produsedisponibile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
