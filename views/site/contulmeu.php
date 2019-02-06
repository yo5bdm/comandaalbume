<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<div class="contulmeu">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'userType') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'authKey') ?>
        <?= $form->field($model, 'numeComplet') ?>
        <?= $form->field($model, 'numeFirma') ?>
        <?= $form->field($model, 'adresaFacturare') ?>
        <?= $form->field($model, 'oras') ?>
        <?= $form->field($model, 'judet') ?>
        <?= $form->field($model, 'CUI') ?>
        <?= $form->field($model, 'nrRegCom') ?>
        <?= $form->field($model, 'banca') ?>
        <?= $form->field($model, 'contBancar') ?>
        <?= $form->field($model, 'telefon') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- contulmeu -->
