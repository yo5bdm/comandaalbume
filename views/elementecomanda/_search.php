<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ElementecomandaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elementecomanda-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'produsID') ?>

    <?= $form->field($model, 'descriere') ?>

    <?= $form->field($model, 'tipDeBaza') ?>

    <?= $form->field($model, 'maiMulteBucatiIdentice') ?>

    <?php // echo $form->field($model, 'maiMulteBucatiNeidentice') ?>

    <?php // echo $form->field($model, 'minBucati') ?>

    <?php // echo $form->field($model, 'maxBucati') ?>

    <?php // echo $form->field($model, 'observatii') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
