<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<div class="Inregistrare">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <h1 style="text-align: center;">Va rugam sa va introduceti datele pentru inregistrare:</h1>
            
        </div>
    </div><div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-4">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'numeComplet') ?>
            <?= $form->field($model, 'numeFirma') ?>
            <?= $form->field($model, 'adresaFacturare') ?>
            <?= $form->field($model, 'oras') ?>
        </div> <div class="col-lg-4">
            <?= $form->field($model, 'judet') ?>
            <?= $form->field($model, 'CUI') ?>
            <?= $form->field($model, 'nrRegCom') ?>
            <?= $form->field($model, 'banca') ?>
            <?= $form->field($model, 'contBancar') ?>
            <?= $form->field($model, 'telefon') ?>
            <div class="form-group">
                <?= Html::submitButton('Creeaza contul', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <p>Aplicatia este destinata clientilor Carpatic Studio. Ne rezervam dreptul de-a ne selecta clientii.</p>
            <p>Accesul pe aplicatia Carpatic Studio se face doar de catre utilizatori inregistrati si aprobati. 
                Te rugam sa intelegi ca aprobarea se face in 24-48 de ore, timp in care 
                cel mai probabil vei fi sunat pentru confirmarea datelor.</p>
        </div>
    </div>
</div><!-- Inregistrare -->
