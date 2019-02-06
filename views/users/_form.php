<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>
<div class="users-form col-lg-4">
    <?= $form->field($model, 'userType')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'disabled' => 'disabled']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numeComplet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numeFirma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adresaFacturare')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oras')->textInput(['maxlength' => true]) ?>
</div> <div class="users-form col-lg-4">
    <?= $form->field($model, 'judet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CUI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nrRegCom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'banca')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contBancar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefon')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
