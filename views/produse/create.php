<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Produse */

$this->title = 'Create Produse';
$this->params['breadcrumbs'][] = ['label' => 'Produses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produse-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
