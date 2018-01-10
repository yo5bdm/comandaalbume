<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdreseLivrare */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adrese-livrare-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clientID')->textInput() ?>

    <?= $form->field($model, 'numeDestinatar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'persoanaContact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adresa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oras')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'judet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codPostal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'def')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
