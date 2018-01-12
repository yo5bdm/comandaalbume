<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Elementecomanda */

$this->title = 'Create Elementecomanda';
$this->params['breadcrumbs'][] = ['label' => 'Elementecomandas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elementecomanda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
