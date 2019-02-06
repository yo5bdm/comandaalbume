<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'userType') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'authKey') ?>

    <?php // echo $form->field($model, 'numeComplet') ?>

    <?php // echo $form->field($model, 'numeFirma') ?>

    <?php // echo $form->field($model, 'adresaFacturare') ?>

    <?php // echo $form->field($model, 'oras') ?>

    <?php // echo $form->field($model, 'judet') ?>

    <?php // echo $form->field($model, 'CUI') ?>

    <?php // echo $form->field($model, 'nrRegCom') ?>

    <?php // echo $form->field($model, 'banca') ?>

    <?php // echo $form->field($model, 'contBancar') ?>

    <?php // echo $form->field($model, 'telefon') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
