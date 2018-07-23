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
                    <h4 class="card-title text-center">Cutii pentru stick-uri:</h4>
                </div>
                <div class="panel-body">
                    <p>Tipul: 
                        <select ng-model="client.tip" class="form-control">
                            <option ng-repeat="x in preturi.tip" value="{{x.id}}">{{x.text}} (<small>{{x.descriere}}</small>)</option>
                        </select>
                    </p>
                    <p>Numarul de cutii dorite
                        <input type="number" class="form-control" ng-model="client.nrBucati" />
                    </p>
                    <p>Numarul de stick-uri per cutie
                        <select ng-model="client.stickPerCutie" class="form-control">
                            <option ng-repeat="x in pret()" value="{{x.id}}">{{x.text}} - {{x.pret}} lei</option>
                        </select>
                    </p>
                    <p>Magnet (+ {{pretMagnet()}} lei)
                        <select ng-model="client.magnet" class="form-control">
                            <option value="0">Nu</option>
                            <option value="1">Da</option>
                        </select>
                    </p>
                    <p>Paspartu coperta (+ {{pretPaspartuCoperta()}} lei)
                        <select ng-model="client.paspartuCoperta" class="form-control">
                            <option value="0">Nu</option>
                            <option value="1">Da</option>
                        </select>
                    </p>
                    <div ng-show="isMaxi()">
                        <p>Paspartu cu rama (+ {{pretPaspartuCuRama()}} lei)
                            <select ng-model="client.maxi.paspartuCuRama" class="form-control">
                                <option value="0">Nu</option>
                                <option value="1">Da</option>
                            </select>
                        </p>
                        <p>Poza interioara (+ {{pretPozaInterioara()}} lei)
                            <select ng-model="client.maxi.pozaInterioara" class="form-control">
                                <option value="0">Nu</option>
                                <option value="1">Da</option>
                            </select>
                        </p>
                    </div>

                    <p>Coltare (+ {{pretColtare()}} lei)
                        <select ng-model="client.coltare" class="form-control">
                            <option value="0">Nu</option>
                            <option value="1">Da</option>
                        </select>
                    </p>
                    <p>Inscriptionare coperta (+ {{pretInscriptionareCoperta()}} lei)
                        <select ng-model="client.inscriptionareCoperta" class="form-control">
                            <option value="0">Nu</option>
                            <option value="1">Da</option>
                        </select>
                    </p>
                    <p>Coperta buretata (+ {{pretCopertaBuretata()}} lei)
                        <select ng-model="client.copertaBuretata" class="form-control">
                            <option value="0">Nu</option>
                            <option value="1">Da</option>
                        </select>
                    </p>


                    <p>Observatii
                        <textarea class="form-control" ng-model="client.observatii"></textarea>
                    </p>
                
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
var csrfP = "<?=Yii::$app->request->csrfParam?>";
var csrfT = "<?=Yii::$app->request->csrfToken?>";
var home = "<?=Yii::$app->homeUrl?>";
var app = angular.module("myApp", []);
app.controller("myCtrl", ['$scope', '$window','$http', function($scope,$window,$http) {
    var promise = $http.get('<?php echo Yii::$app->homeUrl; ?>produse/preturicutiutestick').then(function(response){
        $scope.preturi = response.data.records;
    });
    //metode
    promise.then(function(data){
        //obiectul client
        $scope.client={
            produs:"cutieStick",
            idComanda:<?=$id?>,
            tip:"1",
            nrBucati:1,
            stickPerCutie:"1",
            magnet:"0",
            paspartuCoperta:"0",
            maxi:{
                paspartuCuRama:"0",
                pozaInterioara:"0"
            },
            coltare:"0",
            inscriptionareCoperta:"0",
            copertaBuretata:"0",
            observatii:"",
            pretTotal:0
        };
        /*reseteaza numarul de stickuri cand se schimba tipul,
        pentru a preveni eroarea de id negasit */
        $scope.$watch('client.tip', function(newValue, oldValue){
            $scope.client.stickPerCutie = "1";
        });
        $scope.isMaxi = function() {
            var arr = ["3","4"];
            if(arr.includes($scope.client.tip)) {
                return true;
            } else {
                return false;
            }
        };
        $scope.pret = function(){
            var ret = $scope.preturi.preturi.find(m => m.id == $scope.client.tip);
            //$scope.client.stickPerCutie="1";
            return ret.val;
        };
        $scope.pretCutie = function(){
            var opts = $scope.pret();
            var perCutie = Number($scope.client.stickPerCutie)-1;
            return opts[perCutie].pret;
        };
        $scope.pretMagnet = function(){
            if($scope.client.magnet==0) return 0;
            if($scope.isMaxi()) {
                return $scope.preturi.magnet[1].pret;
            } else {
                return $scope.preturi.magnet[0].pret;
            }
        };
        $scope.pretPaspartuCoperta = function() {
            if($scope.client.paspartuCoperta==0) return 0;
            return $scope.preturi.PaspartuCoperta;
        };
        $scope.pretColtare = function() {
            if($scope.client.coltare==0) return 0;
            return $scope.preturi.Coltare;
        };
        $scope.pretInscriptionareCoperta = function() {
            if($scope.client.inscriptionareCoperta==0) return 0;
            return $scope.preturi.InscriptionareCoperta;
        };
        $scope.pretCopertaBuretata = function() {
            if($scope.client.copertaBuretata==0) return 0;
            return $scope.preturi.Copertaburetata;
        };
        $scope.pretPaspartuCuRama = function() {
            if($scope.client.maxi.paspartuCuRama==0) return 0;
            return $scope.preturi.maxi[0].pret;
        };
        $scope.pretPozaInterioara = function() {
            if($scope.client.maxi.pozaInterioara==0) return 0;
            return $scope.preturi.maxi[1].pret;
        };
        
        $scope.calculeaza = function() {
            let total = 0;
            total += Number($scope.pretCutie());
            total += Number($scope.pretMagnet());
            total += Number($scope.pretPaspartuCoperta());
            total += Number($scope.pretColtare());
            total += Number($scope.pretInscriptionareCoperta());
            total += Number($scope.pretCopertaBuretata());
            total += Number($scope.pretPaspartuCuRama());
            total += Number($scope.pretPozaInterioara());

            return total * Number($scope.client.nrBucati);
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
                     alert("Eroare de comunicare, te rugam sa incerci mai tarziu "+response);
                }
            );
        };        
    });
}]);
</script>