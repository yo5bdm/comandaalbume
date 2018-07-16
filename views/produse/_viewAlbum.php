<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Produse */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
var idCd = <?=$model->comandaID?>;
var idProdus = <?=$id?>;
var csrfP = "<?=Yii::$app->request->csrfParam?>";
var csrfT = "<?=Yii::$app->request->csrfToken?>";
var home = "<?php echo Yii::$app->homeUrl; ?>";
</script>
<?php
    $this->registerJsFile("@web/js/viewAlbum.js");
    $this->registerCss('container.select{}');
?>
<div class="container" ng-app="myApp" ng-controller="myCtrl">

    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">{{ucfirst(client.produs)}}</h4>
                
            </div>
            <div class="panel-body">
                <h4>Total de plata: <strong>{{calculeaza()}} lei</strong></h4>
                <h4>Blocul interior:</h4>
                <p>Dimensiune bloc interior: <strong>{{view.blocInterior()}}</strong>; Nr Colaje: <strong>{{client.nrMontaje}}</strong>; Design pentru colaje: <strong>{{(client.designColajeSel==2)?"Da":"Nu"}}</strong>; Lipire: <strong>{{view.lipire()}}</strong></p>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Coperta</h4>
            </div>
            <div class="panel-body">
                <p>Coperta buretata: <strong>{{(client.copertaBuretataSel==2)?"Da":"Nu"}}</strong></p>
                <p>Coperta din: <strong>{{view.copertaBuc()}}</strong></p>
                <p>Cod coperta <span ng-show="client.bucCopertaSel!=1">fata</span>: <strong>{{view.codCopertaFata()}}</strong></p>
                <p ng-show="client.bucCopertaSel!=1">Cod coperta spate: <strong>{{view.codCopertaSpate()}}</strong></p>
                <p ng-show="client.bucCopertaSel!=1 && client.bucCopertaSel!=2">Cod cotor: <strong>{{view.codCopertaCotor()}}</strong></p>
                <p>Coperta fata: <strong>{{view.tipCopertaFata()}}</strong></p>
                <p ng-show="laminareVizibil()">Laminare: <strong>{{view.laminare()}}</strong></p>
                <p ng-show="pozitiePaspartuVizibil()">Pozitie paspartu: <strong>{{view.pozitiePaspartuCoperta()}}</strong>
                    <br/>Dimensiuni: <strong>{{view.dimensiunePaspartuCopertaAlbum()}}</strong>
                </p>
                <p ng-show="codPaspartuVizibil()">Cod material rama paspartu: <strong>{{view.codMaterialRamaPaspartuAlbum()}}</strong></p>

                <p ng-show="tipCanvasVizibil()">Tip canvas: <strong>{{view.tipCanvas()}}</strong></p>
                <p ng-show="pozitiePlexiglasuVizibil()">Pozitie plexiglas: <strong>{{view.pozitiePlexiglasCoperta()}}</strong></p>
            </div>
        </div>
        <div class="panel panel-default" ng-hide="client.tipInscriptionareSel == 1">
            <div class="panel-heading">
                <h4 class="card-title text-center">Inscriptionare / logo pe coperta</h4>
            </div>
            <div class="panel-body">
                <p>Tip inscriptionare: <strong>{{view.tipInscriptionare()}}</strong></p>
                <hr>
                <div ng-show="client.tipInscriptionareSel!=1">
                    <div ng-show="textPeCopertaFataVizibil()">
                        <p>Pe coperta fata: <strong>{{view.optiuneInscriptionareCopertaFata()}}</strong></p>
                        <div ng-show="client.optiuniInscriptionareFata==2">
                            <p>Textul <strong>{{client.textCopertaFata}}</strong>; Fontul: <strong>{{view.fontCopertaFata()}}</strong></p>
                        </div>
                        <p ng-show="client.optiuniInscriptionareFata!=1">Pozitia: <strong>{{view.pozitieTextCopertaFata()}}</strong></p>
                    </div>
                    <hr/>
                    
                    <div>
                        <p>Pe coperta spate: <strong>{{view.optiuneInscriptionareCopertaSpate()}}</strong></p>
                        <div ng-show="client.optiuniInscriptionareSpate==2">
                            <p>Text pe coperta spate <strong>{{client.textCopertaSpate}}</strong>; Fontul:<strong>{{view.fontCopertaSpate()}}</strong></p>
                        </div>
                        <p ng-show="client.optiuniInscriptionareSpate!=1">Pozitia: <strong>{{view.pozitieTextCopertaSpate()}}</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Optionale</h4>
            </div>
            <div class="panel-body">
                <p>Coltare: <strong>{{view.coltare()}}</strong>; 
                Face-off: <strong>{{view.faceOff()}}</strong>; 
                Cutie de carton: <strong>{{view.cutieCarton()}}</strong></p>
            </div>
        </div>
        
        <div class="panel panel-default" ng-show="client.cutieLux.da == 1">
            <div class="panel-heading">
                <h4 class="card-title text-center">Cutie de lux</h4>
            </div>
            <div class="panel-body">
                <p>Cutie de lux: <strong>{{(client.cutieLux.da==1)?"Da":"Nu"}}</strong></p>
                <div ng-show="client.cutieLux.da == 1">
                    <p>Coltare: <strong>{{view.cutieLux.coltare()}}</strong>; 
                    Coperta: <strong>{{view.cutieLux.coperta()}}</strong></p>
                    <p ng-show="client.cutieLux.coperta == 4">Dimensiuni plexiglas: <strong>{{view.cutieLux.dimPlexiglas()}}</strong></p>
                    <p>Inscriptionare: <strong>{{view.cutieLux.inscriptionare()}}</strong></p>
                    <div ng-show="client.cutieLux.inscriptionare==2">
                        <p>Textul: <strong>{{client.cutieLux.text}}</strong>; 
                        Fontul: <strong>{{view.cutieLux.font()}}</strong>; 
                        Pozitia: <strong>{{view.cutieLux.pozitie()}}</strong></p>
                    </div>
                    <p>Panglica: <strong>{{view.cutieLux.panglica()}}</strong>; 
                    Material cadru: <strong>{{view.cutieLux.materialCadru()}}</strong></p>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default" ng-show="client.replici.length>0">
            <div class="panel-heading">
                <h4 class="text-center">Replici</h4>
            </div>
            <div class="panel-body">
                    <p ng-repeat="x in client.replici">Replica {{replica(x.id)}}cm, {{x.bucati}} buc.</p>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Observatii</h4>
            </div>
            <div class="panel-body">
                <p><strong>{{client.observatii}}</strong></p>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Fisierele</h4>
            </div>
            <div class="panel-body">                
                <h2 class="text-center"><a href="{{client.linkFisiere}}">Link descarcare fisiere</a></h2>
            </div>
        </div>        
    </div>
    </div>
</div>
