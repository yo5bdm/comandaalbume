<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Elementecomanda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elementecomanda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descriere')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipDeBaza')->dropDownList([
        1 => 'Lista',
        2 => 'Descriere text'
    ]) ?>

    <?= $form->field($model, 'maiMulteBucatiIdentice')->checkbox() ?>

    <?= $form->field($model, 'maiMulteBucatiNeidentice')->checkbox() ?>

    <?= $form->field($model, 'minBucati')->textInput() ?>

    <?= $form->field($model, 'maxBucati')->textInput() ?>

    <?= $form->field($model, 'observatii')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
