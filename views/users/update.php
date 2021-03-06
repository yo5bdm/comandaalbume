<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Contul meu: '.$model->numeComplet;
$this->params['breadcrumbs'][] = ['label' => 'Contul meu', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $model->numeComplet];
?>
<div class="users-update">

    <h1><?= Html::encode('Contul meu') ?></h1>

    
    <?php $form = ActiveForm::begin(); ?>
<div class="users-form col-lg-4">
    <?php if(Yii::$app->user->identity->userType === 0) { echo $form->field($model, 'userType')->dropDownList([
        0 => 'Admin',
        1 => 'Lucrator',
        2 => 'Client'
    ]); } ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'disabled' => 'disabled','title'=>'Numele de utilizator nu se poate modifica']) ?>

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
        <?= Html::submitButton('Salveaza modificarile', ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
<div class="users-form col-lg-4">
    <h2>Template-urile mele</h2>
    <p>[de implementat]</p>
    <h2>Adrese de livrare</h2>
    <?= GridView::widget([
        'dataProvider' => $adrese,
        'columns' => [
            'numeDestinatar',
            'oras',
        ],
    ]) ?>
    <p>
        <?= Html::a('Adresa de livrare noua',
                ['adreselivrare/create','id'=>Yii::$app->user->identity->id],
                ['class'=>'btn btn-primary']) ?>
    </p>
    <?php if (Yii::$app->user->identity->userType === 0):?>
    <h2>Administrare utilizatori</h2>
    <?= Html::a('Lista de utilizatori', ['/users/index'], ['class'=>'btn btn-primary']) ?>
    <?php endif ?>
</div>


</div>
