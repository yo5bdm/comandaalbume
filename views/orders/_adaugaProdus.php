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
        switch ($el->tipDeBaza) {
            case 1: //lista
                echo $form->field($model, 'descriere')->dropDownList([
                    'Unu' => 'Unu',
                    'Doi' => 'Doi'
                ])->label($el->descriere); //lista
                break;
            case 2: //text input
                echo $form->field($model, 'descriere')->textInput()->label($el->descriere); //text input 
                break;
            default: //orice altceva
                break;
        }
        if($el->maiMulteBucatiIdentice === 1) {
            echo $form->field($model,'descriere')->textInput(['type'=>'number'])->label($el->descriere);
        }
        echo '<hr/>';
    }
    echo Html::submitButton('Adauga', ['class' => 'btn btn-success']);
    ActiveForm::end();
?>