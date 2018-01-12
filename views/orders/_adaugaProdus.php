<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>
<?php //echo '<pre>';print_r($response); echo '</pre>'; ?>
<?php 
    $form = ActiveForm::begin();
    foreach($response as $el) {
        if($el->tipDeBaza == 2) { 
            echo $form->field($model, 'descriere')->textInput()->label($el->descriere); //lista 
        } else {
            echo $form->field($model, 'descriere')->dropDownList([
                'Unu' => 'Unu',
                'Doi' => 'Doi'
            ])->label($el->descriere); //lista
        }
    }
    echo Html::submitButton('Adauga', ['class' => 'btn btn-success']);
    ActiveForm::end();
?>