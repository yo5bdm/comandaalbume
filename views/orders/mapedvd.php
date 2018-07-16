<?php
/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>
<div ng-app="myApp" ng-controller="myCtrl" class="container">
    <div class="row text-center">
        <h3 class="">&nbsp;</h3>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="card-title text-center">Mape DVD/BluRay:</h4>
                </div>
                <div class="panel-body">
                    <p>Tipul: 
                        <select ng-model="client.tip" class="form-control">
                            <option value="Clasic">Clasic</option>
                            <option value="Premium">Premium</option>
                        </select>
                    </p>
                    <p>Numarul de mape dorite
                        <input type="number" class="form-control" ng-model="client.ambele.nrbucati" />
                    </p>
                    <div ng-show="client.tip == 'Premium'">
                        <p>Nr discuri:
                            <select ng-model="client.premium.nrdiscuri" class="form-control">
                                <option ng-repeat="x in preturi.premium.nrdiscuri" value="{{x.id}}">{{x.text}} {{x.pret}} lei</option>
                            </select>
                        </p>
                        <p>Magnet
                            <select ng-model="client.premium.magnet" class="form-control">
                                <option ng-repeat="x in preturi.premium.magnet" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                            </select>
                        </p>
                    </div>
                    <div ng-show="client.tip == 'Clasic'">
                        <p>Nr discuri:
                            <select ng-model="client.clasic.nrdiscuri" class="form-control">
                                <option ng-repeat="x in preturi.clasic.nrdiscuri" value="{{x.id}}">{{x.text}} {{x.pret}} lei</option>
                            </select>
                        </p>
                        <p>Laminare coperta fata
                            <select ng-model="client.clasic.laminare" class="form-control">
                                <option ng-repeat="x in preturi.clasic.laminare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                            </select>
                        </p>
                    </div>
                    <div ng-show="client.tip != ''">
                        <p>Coperta
                            <select ng-model="client.ambele.coperta" class="form-control">
                                <option ng-repeat="x in preturi.ambele.coperta" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                            </select>
                        </p>
                        <p ng-show="client.ambele.coperta!=1">Dimensiuni paspartu
                            <select ng-model="client.ambele.dimensiunipaspartu" class="form-control">
                                <option ng-repeat="x in preturi.ambele.dimensiunipaspartu" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                            </select>
                        </p>
                        <p>Inscriptionare
                            <select ng-model="client.ambele.inscriptionare" class="form-control">
                                <option ng-repeat="x in preturi.ambele.inscriptionare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                            </select>
                        </p>
                        
                        <div ng-show="client.ambele.inscriptionare==2">
                            <br>
                            <p>Textul</p>
                            <input class="form-control" type="text" ng-model="client.text"/>
                            <p>Fontul:
                                <select class="form-control" ng-model="client.ambele.font">
                                    <option ng-repeat="x in preturi.ambele.fonturi" value="{{x.id}}">{{x.text}}</option>
                                </select>
                            </p>
                            <div class="row">
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-8">
                                    <p><img class="img-responsive" alt="Fontul ales" ng-src="<?php echo Yii::$app->homeUrl; ?>include/fonturi/{{getFont()}}"/></p>
                                </div>
                            </div>
                            <p>Pozitia:
                                <select class="form-control" ng-model="client.ambele.pozitieText">
                                    <option ng-repeat="x in preturi.ambele.pozitieElement" value="{{x.id}}">{{x.text}}</option>
                                </select>
                            </p>
                        </div>
                        
                        <p>Coperta buretata
                            <select ng-model="client.ambele.copertaburetata" class="form-control">
                                <option ng-repeat="x in preturi.ambele.copertaburetata" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                            </select>
                        </p>
                        <p>Coltare
                            <select ng-model="client.ambele.coltare" class="form-control">
                                <option ng-repeat="x in preturi.ambele.coltare" value="{{x.id}}">{{x.text}} +{{x.pret}} lei</option>
                            </select>
                        </p>
                        <p>Observatii
                            <textarea class="form-control" ng-model="client.observatii"></textarea>
                        </p>
                    </div>
                    <hr/>
                    <h4 class="text-center">Total Mape</h4>
                    <h3 class="text-center">{{calculeaza()}} lei </h3>
                    <button ng-click="salveazaComanda()" class="btn btn-success form-control"><span class="glyphicon glyphicon-ok"></span> Salveaza produsul</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var app = angular.module("myApp", []);
app.controller("myCtrl", ['$scope', '$window','$http', function($scope,$window,$http) {
    var promise = $http.get('<?php echo Yii::$app->homeUrl; ?>produse/preturimape').then(function(response){
        $scope.preturi = response.data.records;
        console.log(response.data.records);
    });
    //metode
    promise.then(function(data){
        $scope.client={};
        $scope.client.produs="mapadvd";
        $scope.client.observatii='';
        $scope.client.idComanda = <?=$id?>;
        $scope.client.tip="Premium";
        
        $scope.client.premium={};
        $scope.client.premium.nrdiscuri="1";
        $scope.client.premium.magnet="1";
        
        $scope.client.clasic ={};
        $scope.client.clasic.nrdiscuri="1";
        $scope.client.clasic.laminare="1";
        
        $scope.client.ambele ={};
        $scope.client.ambele.nrbucati=1;
        $scope.client.ambele.coperta="1";
        $scope.client.ambele.dimensiunipaspartu="1";
        $scope.client.ambele.inscriptionare="1";
        $scope.client.ambele.text="";
        $scope.client.ambele.font='1';
        $scope.client.ambele.pozitieText='1';
        $scope.client.ambele.copertaburetata="1";
        $scope.client.ambele.coltare="1";
        $scope.client.pretTotal=0;
        
        $scope.getPremium = function(vari,ide) {
            var ret = null;
            var tab = $scope.preturi.premium;
            for(var i=0;i<tab[vari].length;i++) {
                if(Number(tab[vari][i].id) === Number(ide)) { 
                    ret=tab[vari][i];
                    break;
                }
            }
            return ret;
        };
        $scope.getClasic = function(vari,ide) {
            var ret = null;
            var tab = $scope.preturi.clasic;
            for(var i=0;i<tab[vari].length;i++) {
                if(Number(tab[vari][i].id) === Number(ide)) { 
                    ret=tab[vari][i];
                    break;
                }
            }
            return ret;
        };
        $scope.getAmbele = function(vari,ide) {
            var ret = null;
            var tab = $scope.preturi.ambele;
            for(var i=0;i<tab[vari].length;i++) {
                if(Number(tab[vari][i].id) === Number(ide)) { 
                    ret=tab[vari][i];
                    break;
                }
            }
            return ret;
        };
        
        $scope.getFont = function() {
            return $scope.getAmbele("fonturi",$scope.client.ambele.font).link;
        };
        
        $scope.calculeaza = function() {
            var ret=0;
            switch($scope.client.tip) {
                case "Premium":
                    ret += Number($scope.getPremium('nrdiscuri',$scope.client.premium.nrdiscuri).pret);
                    ret += Number($scope.getPremium('magnet',$scope.client.premium.magnet).pret);
                    break;
                case "Clasic":
                    ret += Number($scope.getClasic('nrdiscuri',$scope.client.clasic.nrdiscuri).pret);
                    ret += Number($scope.getClasic('laminare',$scope.client.clasic.laminare).pret);
                    break;
            }
            ret += Number($scope.getAmbele('coperta',$scope.client.ambele.coperta).pret);
            ret += Number($scope.getAmbele('dimensiunipaspartu',$scope.client.ambele.dimensiunipaspartu).pret);
            ret += Number($scope.getAmbele('inscriptionare',$scope.client.ambele.inscriptionare).pret);
            ret += Number($scope.getAmbele('copertaburetata',$scope.client.ambele.copertaburetata).pret);
            ret += Number($scope.getAmbele('coltare',$scope.client.ambele.coltare).pret);
            ret *= $scope.client.ambele.nrbucati;
            return ret;
        };
        
        $scope.salveazaComanda = function() {
            $scope.client.pretTotal = $scope.calculeaza();
            var parameter = {
                "<?=Yii::$app->request->csrfParam?>":"<?=Yii::$app->request->csrfToken?>",
                "descriere":JSON.stringify($scope.client)
            };
            var url = "<?php echo Yii::$app->homeUrl; ?>produse/create";
            $http.post(url, parameter).then(
                function(response) {
                    if(response.data == 1) { //salvare reusita
                        $window.location.href="<?php echo Yii::$app->homeUrl; ?>orders/view/<?=$id?>";
                    } else { //eroare din PHP
                        alert("Salvare nereusita! Te rog sa verifici datele si sa incerci din nou.");
                    }
                },
                function(response) { //eroare de comunicare
                     alert("Eroare de comunicare, va rugam incercati mai tarziu "+response);
                }
            );
        };
        
    });
}]);
</script>