<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Produsedisponibile */

$this->title = $model->descriere;
$this->params['breadcrumbs'][] = ['label' => 'Produse Disponibile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizeaza', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Sterge', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Adauga caracteristici',['#insert'],['class' => 'btn btn-primary', 'data-toggle'=>'modal','data-target'=>'#add-modal']) ?>
    </p>
    <h4>Caracteristici</h4>
    <?= GridView::widget([
        'dataProvider' => $listaElement,
        'columns' => [
            ['attribute' => 'descriere',
                'label' => 'Descriere',
                'format' => 'raw',
                'value' => function( $data ) {
                    return Html::a($data->descriere,['elementecomanda/view','id'=>$data->id]);
                    //var_dump($data);
                },
            ],
            ['attribute' => 'tipDeBaza',
                'label' => 'Tip de baza',
                'value' => function( $data ) {
                    switch($data->tipDeBaza) {
                        case 1: return 'Lista';
                        case 2: return 'Descriere text';
                        default: return 'Fara';
                    }
                },
            ],
            ['attribute' => 'maiMulteBucatiIdentice',
                'label' => 'Mai multe bucati identice',
                'value' => function( $data ) {
                    if($data->maiMulteBucatiIdentice === 1){
                        return 'Da';
                    } else {
                        return 'Nu';
                    }
                },
            ],
            ['attribute' => 'maiMulteBucatiNeidentice',
                'label' => 'Mai multe bucati neidentice',
                'value' => function( $data ) {
                    if($data->maiMulteBucatiNeidentice === 1){
                        return 'Da';
                    } else {
                        return 'Nu';
                    }
                },
            ],
            'minBucati',
            'maxBucati',
            'observatii:ntext',
        ],
    ]); ?>
    
    </div>
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="loginmodal-container">
                <h3>Adauga Caracteristici produsului tau</h3>
                <?= $this->render('..\elementecomanda\_form', [
                    'model' => $modelElement,
                ]) ?>
            </div>
        </div>
    </div>

</div>
<?php 
//https://bootsnipp.com/snippets/featured/clean-modal-login-form
$this->registerCss(".loginmodal-container {
  padding: 30px;
  width: 100% !important;
  background-color: #F7F7F7;
  margin: 0 auto;
  border-radius: 2px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  overflow: hidden;
  font-family: roboto;
}

.loginmodal-container input[type=text], input[type=password] {
  height: 44px;
  font-size: 16px;
  width: 100%;
  margin-bottom: 10px;
  -webkit-appearance: none;
  background: #fff;
  border: 1px solid #d9d9d9;
  border-top: 1px solid #c0c0c0;
  /* border-radius: 2px; */
  padding: 0 8px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.loginmodal-container input[type=text]:hover {
  border: 1px solid #b9b9b9;
  border-top: 1px solid #a0a0a0;
  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
}

.loginmodal {
  text-align: center;
  font-size: 14px;
  font-family: 'Arial', sans-serif;
  font-weight: 700;
  height: 36px;
  padding: 0 8px;
/* border-radius: 3px; */
/* -webkit-user-select: none;
  user-select: none; */
}

.loginmodal-submit {
  /* border: 1px solid #3079ed; */
  border: 0px;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.1); 
  background-color: #4d90fe;
  padding: 17px 0px;
  font-family: roboto;
  font-size: 14px;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
}

.loginmodal-submit:hover {
  /* border: 1px solid #2f5bb7; */
  border: 0px;
  text-shadow: 0 1px rgba(0,0,0,0.3);
  background-color: #357ae8;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
}

.loginmodal-container a {
  text-decoration: none;
  color: #666;
  font-weight: 400;
  text-align: center;
  display: inline-block;
  opacity: 0.6;
  transition: opacity ease 0.5s;
} 

.login-help{
  font-size: 12px;
}");
?>