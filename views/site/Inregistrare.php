<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
$this->registerCss("body{
    background: #eee !important;
}
.main-login{
 	background-color: #fff;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

}
.main-center{
    margin-top: 30px;
    margin: 0 auto;
 	
    padding: 40px 40px;

}
");
?>
<div class="Inregistrare">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <h1 style="text-align: center;">Va rugam sa va introduceti datele pentru inregistrare:</h1>
            
        </div>
    </div><div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 main-center main-login">
            <div class="row">
                <div class="col-lg-6">
                    <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($model, 'username') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <?= $form->field($model, 'numeComplet') ?>
                        <?= $form->field($model, 'numeFirma') ?>
                        <?= $form->field($model, 'adresaFacturare') ?>
                        <?= $form->field($model, 'oras') ?>
                    </div> <div class="col-lg-6">
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
                <div class="col-lg-12">
                    <p>Aplicatia este destinata clientilor <strong>Carpatic Studio</strong>. Ne rezervam dreptul de-a ne selecta clientii.</p>
                    <p>Accesul pe aplicatia <strong>Carpatic Studio</strong> se face doar de catre utilizatori inregistrati si aprobati. 
                        Te rugam sa intelegi ca aprobarea se face in 24-48 de ore, timp in care 
                        cel mai probabil vei fi sunat pentru confirmarea datelor.</p>
                    <p>Datele din acest formular sunt necesare pentru procesul de comandare, facturare, livrare.
                        Datele nu se folosesc in nici un alt fel. 
                        <strong>Carpatic Studio</strong> nu este operator de date cu caracter personal.
                    </p>
                </div>
            </div>
        </div>
        
    </div>
    
</div><!-- Inregistrare -->
