<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdreseLivrareSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adrese-livrare-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'clientID') ?>

    <?= $form->field($model, 'numeDestinatar') ?>

    <?= $form->field($model, 'persoanaContact') ?>

    <?= $form->field($model, 'telefon') ?>

    <?php // echo $form->field($model, 'adresa') ?>

    <?php // echo $form->field($model, 'oras') ?>

    <?php // echo $form->field($model, 'judet') ?>

    <?php // echo $form->field($model, 'codPostal') ?>

    <?php // echo $form->field($model, 'def') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
