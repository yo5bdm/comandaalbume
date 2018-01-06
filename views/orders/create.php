<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Plaseasa o comanda';
$this->params['breadcrumbs'][] = ['label' => 'Comenzi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="orders-form">
        <p>Prin plasarea unei comenzi esti de acord cu termenii si conditiile aplicatiei. Bla bla bla...</p>
        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <?= Html::submitButton('Continua', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
