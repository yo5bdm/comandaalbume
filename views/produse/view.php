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
?>
<div class="container" ng-app="myApp" ng-controller="myCtrl">

    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">{{ucfirst(client.produs)}}</h4>
                <h4 class="card-title text-center">Blocul interior</h4>
            </div>
            <div class="panel-body">
                <p>Dimensiune bloc interior: <select readonly class="form-control" ng-model="client.albumSelectat">
                    <option ng-repeat="x in albume" value="{{x.id}}">{{x.text}}</option>
                </select></p>
                <p>Nr Colaje (10-30): <input readonly type="number" class="form-control" ng-model="client.nrMontaje"></p>
                <p>Doresti design pentru colaje? <select disabled="disabled"  disabled="disabled"  class="form-control" ng-model="client.designColajeSel">
                    <option ng-repeat="x in designColaje" value="{{x.id}}">{{x.text}} +{{x.pret}} lei/colaj</option>
                </select></p>
                <p>Lipire: <select disabled="disabled"  disabled="disabled"  class="form-control" ng-model="client.lipireSel">
                    <option ng-repeat="x in lipire" value="{{x.id}}">{{x.text}} +{{x.pret}} lei/colaj</option>
                </select></p>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Coperta</h4>
            </div>
            <div class="panel-body">
                <p>Coperta buretata: 
                    <select disabled="disabled"  class="form-control" ng-model="client.copertaBuretataSel">
                        <option ng-repeat="x in copertaBuretata" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <p>Coperta din: 
                    <select disabled="disabled"  class="form-control" ng-model="client.bucCopertaSel">
                        <option ng-repeat="x in bucCoperta" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <p>Cod coperta <span ng-show="client.bucCopertaSel!=1">fata</span>: 
                    <select disabled="disabled"  class="form-control" ng-model="client.codCopFata">
                        <option ng-repeat="x in coduriCoperta" value="{{x.id}}">{{x.text}}</option>
                    </select>
                </p>
                <p ng-show="client.bucCopertaSel!=1">Cod coperta spate: 
                    <select disabled="disabled"  class="form-control" ng-model="client.codCopSpate">
                        <option ng-repeat="x in coduriCoperta" value="{{x.id}}">{{x.text}}</option>
                    </select>
                </p>
                <p ng-show="client.bucCopertaSel!=1 && client.bucCopertaSel!=2">Cod cotor: 
                    <select disabled="disabled"  class="form-control" ng-model="client.codCopCotor">
                        <option ng-repeat="x in coduriCoperta" value="{{x.id}}">{{x.text}}</option>
                    </select>
                </p>
                <p>Coperta fata: 
                    <select disabled="disabled"  class="form-control" ng-model="client.copertaFataSel">
                        <optgroup ng-repeat="x in copertaFata" label="{{x.label}}">
                            <option ng-repeat="y in x.values" value="{{y.id}}">{{x.label}}: {{y.text}} +{{y.pret}} lei</option>
                        </optgroup>
                    </select>
                </p>
                <p ng-show="laminareVizibil()">Laminare: 
                    <select disabled="disabled"  class="form-control" ng-model="client.laminareSel">
                        <option ng-repeat="x in laminare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <p ng-show="pozitiePaspartuVizibil()">Pozitie paspartu:
                    <select disabled="disabled"  class="form-control" ng-model="client.pozitiePaspartuCoperta">
                        <option ng-repeat="x in pozitieElement" value="{{x.id}}">{{x.text}}</option>
                    </select>
                    Dimensiuni:
                    <select disabled="disabled"  class="form-control" ng-model="client.dimensiunePaspartuSel">
                        <option ng-repeat="x in dimensiunePaspartu" value="{{x.id}}">{{x.text}}</option>
                    </select>
                                            </p>
                <p ng-show="codPaspartuVizibil()">
                Cod material rama paspartu
                    <select disabled="disabled"  class="form-control" ng-model="client.codRamaPaspartuSel">
                        <option ng-repeat="x in coduriCoperta" value="{{x.id}}">{{x.text}}</option>
                    </select>
                </p>

                <p ng-show="tipCanvasVizibil()">Tip canvas: 
                    <select disabled="disabled"  class="form-control" ng-model="client.tipCanvasSel">
                        <option ng-repeat="x in tipCanvas" value="{{x.id}}">{{x.text}}</option>
                    </select>
                </p>
                <p ng-show="pozitiePlexiglasuVizibil()">Pozitie plexiglas:
                    <select disabled="disabled"  class="form-control" ng-model="client.pozitiePlexiglasCoperta">
                        <option ng-repeat="x in pozitieElement" value="{{x.id}}">{{x.text}}</option>
                    </select>
                                            </p>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Inscriptionare / logo pe coperta</h4>
            </div>
            <div class="panel-body">
                <p>Tip inscriptionare:
                    <select disabled="disabled"  class="form-control" ng-model="client.tipInscriptionareSel">
                        <option ng-repeat="x in inscriptionare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <hr>
                <div ng-show="client.tipInscriptionareSel!=1">
                    <div ng-show="textPeCopertaFataVizibil()">
                        <h4 class="text-center"><strong>Text/Logo pe coperta fata</strong></h4>
                        <select disabled="disabled"  class="form-control" ng-model="client.optiuniInscriptionareFata">
                            <option ng-repeat="x in optiuniInscriptionare" value="{{x.id}}">{{x.text}}</option>
                        </select>
                        <div ng-show="client.optiuniInscriptionareFata==2">
                            <br>
                            <p>Textul</p>
                            <input disabled="disabled" class="form-control" type="text" ng-model="client.textCopertaFata"/>
                            <p>Fontul:
                                <select disabled="disabled"  class="form-control" ng-model="client.fontTextCopertaFata">
                                    <option ng-repeat="x in fonturi" value="{{x.id}}">{{x.text}}</option>
                                </select>
                            </p>
                            <div class="row">
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-8">
                                    <p><img class="img-responsive" alt="Fontul ales" ng-src="<?php echo Yii::$app->homeUrl; ?>include/fonturi/{{getFontFata()}}"/></p>
                                </div>
                            </div>
                        </div>
                        <div ng-show="client.optiuniInscriptionareFata!=1">
                            <p>Pozitia:
                                <select disabled="disabled"  class="form-control" ng-model="client.pozitieTextCopertaFata">
                                    <option ng-repeat="x in pozitieElement" value="{{x.id}}">{{x.text}}</option>
                                </select>
                            </p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-center"><strong>Text/Logo pe coperta spate</strong></h4>
                        <select disabled="disabled"  class="form-control" ng-model="client.optiuniInscriptionareSpate">
                            <option ng-repeat="x in optiuniInscriptionare" value="{{x.id}}">{{x.text}}</option>
                        </select>
                        <div ng-show="client.optiuniInscriptionareSpate==2">
                            <br>
                            <p>Text pe coperta spate</p>
                            <input disabled="disabled" class="form-control" type="text" ng-model="client.textCopertaSpate"/>
                            <p>Fontul:
                                <select disabled="disabled"  class="form-control" ng-model="client.fontTextCopertaSpate">
                                    <option ng-repeat="x in fonturi" value="{{x.id}}">{{x.text}}</option>
                                </select>
                            </p>
                            <div class="row">
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-8">
                                    <p><img class="img-responsive" alt="Fontul ales" ng-src="<?php echo Yii::$app->homeUrl; ?>include/fonturi/{{getFontSpate()}}"/></p>
                                </div>
                            </div>
                        </div>
                        <div ng-show="client.optiuniInscriptionareSpate!=1">
                            <p>Pozitia:
                                <select disabled="disabled"  class="form-control" ng-model="client.pozitieTextCopertaSpate">
                                    <option ng-repeat="x in pozitieElement" value="{{x.id}}">{{x.text}}</option>
                                </select>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Optionale</h4>
            </div>
            <div class="panel-body">
                <p>Coltare: 
                    <select disabled="disabled"  class="form-control" ng-model="client.coltareSel">
                        <option ng-repeat="x in coltare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <p>Face-off: 
                    <select disabled="disabled"  class="form-control" ng-model="client.faceOffSel">
                        <option ng-repeat="x in faceOff" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <p>Cutie de carton: 
                    <select disabled="disabled"  class="form-control" ng-model="client.cutieCartonSel">
                        <option ng-repeat="x in cutieCarton" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Cutie de lux</h4>
            </div>
            <div class="panel-body">
                <p>Cutie de lux
                    <select disabled="disabled"  class="form-control" ng-model="client.cutieLux.da">
                        <option value="0">Nu</option>
                        <option value="1">Da</option>
                    </select>
                </p>
                <div ng-show="client.cutieLux.da == 1">
                    <p>Coltare
                        <select disabled="disabled"  class="form-control" ng-model="client.cutieLux.coltare">
                            <option ng-repeat="x in cutielux.coltare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    <p>Coperta
                        <select disabled="disabled"  class="form-control" ng-model="client.cutieLux.coperta">
                            <option ng-repeat="x in cutielux.coperta" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    <p ng-show="client.cutieLux.coperta == 4">Dimensiuni plexiglas
                        <select disabled="disabled"  class="form-control" ng-model="client.cutieLux.dimensiuniplexiglas">
                            <option ng-repeat="x in cutielux.dimensiuniplexiglas" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    <p>Inscriptionare
                        <select disabled="disabled"  class="form-control" ng-model="client.cutieLux.inscriptionare">
                            <option ng-repeat="x in cutielux.inscriptionare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    
                    <div ng-show="client.cutieLux.inscriptionare==2">
                        <br>
                        <p>Textul</p>
                        <input disabled="disabled" class="form-control" type="text" ng-model="client.cutieLux.text"/>
                        <p>Fontul:
                            <select disabled="disabled"  class="form-control" ng-model="client.cutieLux.font">
                                <option ng-repeat="x in fonturi" value="{{x.id}}">{{x.text}}</option>
                            </select>
                        </p>
                        <div class="row">
                            <div class="col-md-2">&nbsp;</div>
                            <div class="col-md-8">
                                <p><img class="img-responsive" alt="Fontul ales" ng-src="<?php echo Yii::$app->homeUrl; ?>include/fonturi/{{getFontCutie()}}"/></p>
                            </div>
                        </div>
                        <p>Pozitia:
                            <select disabled="disabled"  class="form-control" ng-model="client.cutieLux.pozitieText">
                                <option ng-repeat="x in pozitieElement" value="{{x.id}}">{{x.text}}</option>
                            </select>
                        </p>
                    </div>
                    <p>Panglica
                        <select disabled="disabled"  class="form-control" ng-model="client.cutieLux.panglica">
                            <option ng-repeat="x in cutielux.panglica" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    <p>Material cadru
                        <select disabled="disabled"  class="form-control" ng-model="client.cutieLux.materialcadru">
                            <option ng-repeat="x in cutielux.materialcadru" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    <hr/>
                    <h4>Total cutie Lux {{totalCutieLux()}} lei</h4>
                </div>
                
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="text-center">Replici</h4>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item" ng-repeat="x in client.replici">
                        Replica {{replica(x.id)}}cm, {{x.bucati}} buc    
                    </li>
                </ul>                
                <hr>
                <h4>Total replici {{totalReplici()}} lei</h4>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Observatii</h4>
            </div>
            <div class="panel-body">
                <textarea disabled="disabled" class="form-control" ng-model="client.observatii"></textarea>
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
