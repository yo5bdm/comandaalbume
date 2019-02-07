<?php
/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
use yii\web\View;
$this->title = "Actualizeaza album";
$this->params['breadcrumbs'][] = ['label' => 'Comenzi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Comanda #'.$id, 'url' => ['orders/view/'.$id]];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs('
    var homeUrl = "'.Yii::$app->homeUrl.'";
    ',View::POS_HEAD);
?>
<div ng-app="myApp" ng-controller="myCtrl" class="container">
    <div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Blocul interior</h4>
            </div>
            <div class="panel-body">
                <p>Dimensiune bloc interior: <select class="form-control" ng-model="client.albumSelectat">
                    <option ng-repeat="x in albume" value="{{x.id}}">{{x.text}}</option>
                </select></p>
                <p>Nr Colaje (10-30): <input type="number" class="form-control" ng-model="client.nrMontaje"></p>
                <p>Doresti design pentru colaje? <select class="form-control" ng-model="client.designColajeSel">
                    <option ng-repeat="x in designColaje" value="{{x.id}}">{{x.text}} +{{x.pret}} lei/colaj</option>
                </select></p>
                <p>Lipire: <select class="form-control" ng-model="client.lipireSel">
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
                    <select class="form-control" ng-model="client.copertaBuretataSel">
                        <option ng-repeat="x in copertaBuretata" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <p>Coperta din: 
                    <select class="form-control" ng-model="client.bucCopertaSel">
                        <option ng-repeat="x in bucCoperta" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <div><p>Cod coperta <span ng-show="client.bucCopertaSel!=1">fata</span>: </p>
                    <select class="form-control" ng-model="client.codCopFata">
                        <option ng-repeat="x in coduriCoperta" value="{{x.cod}}">{{x.cod}} - {{x.material}} {{x.culoare}}</option>
                    </select>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8">
                            <p style="margin-top: 10px; margin-bottom: 10px;">
                                <img class="img-responsive" cond-src lnk="client.codCopFata"/>
                            </p>
                        </div>
                    </div>
                </div>
                <div ng-show="client.bucCopertaSel!=1"><p>Cod coperta spate: </p>
                    <select class="form-control" ng-model="client.codCopSpate">
                        <option ng-repeat="x in coduriCoperta" value="{{x.cod}}">{{x.cod}} - {{x.material}} {{x.culoare}}</option>
                    </select>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8">
                            <p style="margin-top: 10px; margin-bottom: 10px;">
                                <img class="img-responsive" cond-src lnk="client.codCopSpate"/>
                            </p>
                        </div>
                    </div>
                </div>
                <div ng-show="client.bucCopertaSel!=1 && client.bucCopertaSel!=2"><p>Cod cotor: </p>
                    <select class="form-control" ng-model="client.codCopCotor">
                        <option ng-repeat="x in coduriCoperta" value="{{x.cod}}">{{x.cod}} - {{x.material}} {{x.culoare}}</option>
                    </select>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8">
                            <p style="margin-top: 10px; margin-bottom: 10px;">
                                <img class="img-responsive" cond-src lnk="client.codCopCotor"/>
                            </p>
                        </div>
                    </div>
                </div>
                <p>Coperta fata: 
                    <select class="form-control" ng-model="client.copertaFataSel">
                        <optgroup ng-repeat="x in copertaFata" label="{{x.label}}">
                            <option ng-repeat="y in x.values" value="{{y.id}}">{{x.label}}: {{y.text}} +{{y.pret}} lei</option>
                        </optgroup>
                    </select>
                </p>
                <p ng-show="laminareVizibil()">Laminare: 
                    <select class="form-control" ng-model="client.laminareSel">
                        <option ng-repeat="x in laminare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <p ng-show="pozitiePaspartuVizibil()">Pozitie paspartu:
                    <select class="form-control" ng-model="client.pozitiePaspartuCoperta">
                        <option ng-repeat="x in pozitieElement" value="{{x.id}}">{{x.text}}</option>
                    </select>
                    Dimensiuni:
                    <select class="form-control" ng-model="client.dimensiunePaspartuSel">
                        <option ng-repeat="x in dimensiunePaspartu" value="{{x.id}}">{{x.text}}</option>
                    </select>
                                            </p>
                <p ng-show="codPaspartuVizibil()">
                Cod material rama paspartu
                    <select class="form-control" ng-model="client.codRamaPaspartuSel">
                        <option ng-repeat="x in coduriCoperta" value="{{x.id}}">{{x.text}}</option>
                    </select>
                </p>

                <p ng-show="tipCanvasVizibil()">Tip canvas: 
                    <select class="form-control" ng-model="client.tipCanvasSel">
                        <option ng-repeat="x in tipCanvas" value="{{x.id}}">{{x.text}}</option>
                    </select>
                </p>
                <p ng-show="pozitiePlexiglasuVizibil()">Pozitie plexiglas:
                    <select class="form-control" ng-model="client.pozitiePlexiglasCoperta">
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
                    <select class="form-control" ng-model="client.tipInscriptionareSel">
                        <option ng-repeat="x in inscriptionare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <hr>
                <div ng-show="client.tipInscriptionareSel!=1">
                    <div ng-show="textPeCopertaFataVizibil()">
                        <h4 class="text-center"><strong>Text/Logo pe coperta fata</strong></h4>
                        <select class="form-control" ng-model="client.optiuniInscriptionareFata">
                            <option ng-repeat="x in optiuniInscriptionare" value="{{x.id}}">{{x.text}}</option>
                        </select>
                        <div ng-show="client.optiuniInscriptionareFata==2">
                            <br>
                            <p>Textul</p>
                            <input class="form-control" type="text" ng-model="client.textCopertaFata"/>
                            <p>Fontul:
                                <select class="form-control" ng-model="client.fontTextCopertaFata">
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
                                <select class="form-control" ng-model="client.pozitieTextCopertaFata">
                                    <option ng-repeat="x in pozitieElement" value="{{x.id}}">{{x.text}}</option>
                                </select>
                            </p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-center"><strong>Text/Logo pe coperta spate</strong></h4>
                        <select class="form-control" ng-model="client.optiuniInscriptionareSpate">
                            <option ng-repeat="x in optiuniInscriptionare" value="{{x.id}}">{{x.text}}</option>
                        </select>
                        <div ng-show="client.optiuniInscriptionareSpate==2">
                            <br>
                            <p>Text pe coperta spate</p>
                            <input class="form-control" type="text" ng-model="client.textCopertaSpate"/>
                            <p>Fontul:
                                <select class="form-control" ng-model="client.fontTextCopertaSpate">
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
                                <select class="form-control" ng-model="client.pozitieTextCopertaSpate">
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
                    <select class="form-control" ng-model="client.coltareSel">
                        <option ng-repeat="x in coltare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <p>Face-off: 
                    <select class="form-control" ng-model="client.faceOffSel">
                        <option ng-repeat="x in faceOff" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                    </select>
                </p>
                <p>Cutie de carton: 
                    <select class="form-control" ng-model="client.cutieCartonSel">
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
                    <select class="form-control" ng-model="client.cutieLux.da">
                        <option value="0">Nu</option>
                        <option value="1">Da</option>
                    </select>
                </p>
                <div ng-show="client.cutieLux.da == 1">
                    <p>Coltare
                        <select class="form-control" ng-model="client.cutieLux.coltare">
                            <option ng-repeat="x in cutielux.coltare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    <p>Coperta
                        <select class="form-control" ng-model="client.cutieLux.coperta">
                            <option ng-repeat="x in cutielux.coperta" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    <p ng-show="client.cutieLux.coperta == 4">Dimensiuni plexiglas
                        <select class="form-control" ng-model="client.cutieLux.dimensiuniplexiglas">
                            <option ng-repeat="x in cutielux.dimensiuniplexiglas" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    <p>Inscriptionare
                        <select class="form-control" ng-model="client.cutieLux.inscriptionare">
                            <option ng-repeat="x in cutielux.inscriptionare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    
                    <div ng-show="client.cutieLux.inscriptionare==2">
                        <br>
                        <p>Textul</p>
                        <input class="form-control" type="text" ng-model="client.cutieLux.text"/>
                        <p>Fontul:
                            <select class="form-control" ng-model="client.cutieLux.font">
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
                            <select class="form-control" ng-model="client.cutieLux.pozitieText">
                                <option ng-repeat="x in pozitieElement" value="{{x.id}}">{{x.text}}</option>
                            </select>
                        </p>
                    </div>
                    <p>Panglica
                        <select class="form-control" ng-model="client.cutieLux.panglica">
                            <option ng-repeat="x in cutielux.panglica" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                        </select>
                    </p>
                    <p>Material cadru
                        <select class="form-control" ng-model="client.cutieLux.materialcadru">
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
                <p><button class="form-control btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Adauga replici</button></p>
                <p>Replici adaugate:</p>
                <hr>
                <ul class="list-group">
                    <li class="list-group-item" ng-repeat="x in client.replici">
                        Replica {{replica(x.id)}}cm, {{x.bucati}} buc 
                        <span class="glyphicon glyphicon-remove pull-right" title="Sterge selectia" ng-click="stergeReplica(x.id)"></span>
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
                <textarea class="form-control" ng-model="client.observatii"></textarea>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="card-title text-center">Fisierele</h4>
            </div>
            <div class="panel-body">
                <p>Pentru transmiterea colajelor/imaginilor, va rugam sa folositi unul din urmatoarele servicii de file sharing: <a href="wetransfer.com" target="_blank">WeTransfer</a>, <a href="ro.filemail.com" target="_blank">FileMail</a>. </p><p><small>Ambele ofera posibilitatea de-a trimite destinatarului un link de descarcare. Introduceti acest link in campul de mai jos:</small></p>
                <p>Link descarcare fisiere: <input type="text" class="form-control" ng-model="client.linkFisiere"/></p>
            </div>
        </div>        
    </div>
    <div class="col-md-4">
        <div data-spy="affix" data-offset-top="60" data-offset-bottom="200" class="affix text-center">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="text-center">Total album</h4>
                    <h3>{{calculeaza()}} lei </h3>
                    <button ng-click="salveazaComanda()" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>Actualizeaza produsul</button>
                    <div ng-show="laminareVizibil()">
                        <hr>
                        <h4 class="text-center">Dimensiunile pentru copertile laminate:</h4>
                        <p>Doar fata: <strong>{{getDimensiuniLaminareFata()}} H x L</strong></p>
                        <p>Integral: <strong>{{getDimensiuniLaminareIntegral()}} H x L </strong></p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="text-center">Incarca din template</h4>
                    <!-- Lista de template-uri -->
                        <!-- -->
                        <div class="dropdown" ng-repeat="x in templates">
                          <button class="btn form-control btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            {{x.titlu}}
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#" ng-click="template.incarca(x.id)">Incarca</a></li>
                            <li><a href="#" ng-click="template.sterge(x.id)">Sterge</a></li>
                          </ul>
                        </div>
                        <!--  -->
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Salveaza comanda curenta ca template</h4>
                    <!-- Buton de salvare comanda curenta ca template curent -->
                    <input ng-model="template.nume" class="form-control" type="text" placeholder="Nume, ex: {{template.autoname()}}"/>
                    <button ng-click="template.salveaza()" class="form-control">Salveaza template nou</button>
                </div>
            </div>
        </div>
    </div>
        <!-- MODAL START -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Adauga replici in comanda</h4>
                </div>
                <div class="modal-body">
                    <p>Dimensiune replici: 
                        <select class="form-control" ng-model="replicaSelectata">
                            <option ng-repeat="x in listaReplici()" value="{{x.id}}">{{x.text}} +{{x.pret*client.nrMontaje}} lei</option>
                        </select>
                    </p>
                    <p>Nr bucati:
                        <input type="number" class="form-control" ng-model="bucReplica">
                    </p>
                    <p>Total replici {{totalReplici()}} lei</p>
                    <button type="button" class="form-control btn btn-success" ng-click="adauga()">Adauga</button>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
        <!--  MODAL END  -->
</div>
<script>
var idProdus = <?=$id?>;
var idComanda = <?=$idCd?>;
var csrfP = "<?=Yii::$app->request->csrfParam?>";
var csrfT = "<?=Yii::$app->request->csrfToken?>";
var home = "<?=Yii::$app->homeUrl?>";
var userID = <?=Yii::$app->user->id?>;
</script>
<?php
    //$this->registerJsVar("idCd",$id);
    //$this->registerJsVar("csrfP",Yii::$app->request->csrfParam);
    //$this->registerJsVar("csrfT",Yii::$app->request->csrfToken);
    $this->registerJsFile("@web/js/editalbum.js");
?>
</div>