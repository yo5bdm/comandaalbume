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
                    <p>Tipul: {{client.tip}}</p>
                    <p>Numarul de mape dorite: {{client.ambele.nrbucati}}</p>
                    <div ng-show="client.tip == 'Premium'">
                        <p>Nr discuri: {{getPremium('nrdiscuri',client.premium.nrdiscuri).text}}</p>
                        <p>Magnet {{view.magnetPremium()}}</p>
                    </div>
                    <div ng-show="client.tip == 'Clasic'">
                        <p>Nr discuri: {{getClasic('nrdiscuri',client.clasic.nrdiscuri).text}}</p>
                        <p>Laminare coperta fata: {{getClasic('laminare',client.clasic.laminare).text}}</p>
                    </div>
                    <div ng-show="client.tip != ''">
                        <p>Coperta: {{getAmbele('coperta',client.ambele.coperta).text}}</p>
                        <p ng-show="client.ambele.coperta!=1">Dimensiuni paspartu: {{getAmbele('dimensiunipaspartu',client.ambele.dimensiunipaspartu).text}}</p>
                        <p>Inscriptionare: {{getAmbele('inscriptionare',client.ambele.inscriptionare).text}}</p>
                        
                        <div ng-show="client.ambele.inscriptionare==2">
                            <br>
                            <p>Textul: <b>{{client.text}}</b></p>
                            <p>Fontul: {{getAmbele('fonturi',client.ambele.font).text}}</p>                            
                            <p>Pozitia: {{getAmbele('pozitieElement',client.ambele.pozitieText).text}}</p>
                        </div>
                        
                        <p>Coperta buretata: {{getAmbele('copertaburetata',client.ambele.copertaburetata).text}}</p>
                        <p>Coltare: {{getAmbele('coltare',client.ambele.coltare).text}}</p>
                        <p>Observatii: <b>{{client.observatii}}</b></p>
                    </div>
                    <hr/>
                    <h4 class="text-center">Total Mape</h4>
                    <h3 class="text-center">{{client.pretTotal}} lei </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var idCd = <?=$model->comandaID?>;
var idProdus = <?=$id?>;

var app = angular.module("myApp", []);
app.controller("myCtrl", ['$scope', '$window','$http', function($scope,$window,$http) {
    $scope.listaPreturi = function(){ 
        return $http.get('<?php echo Yii::$app->homeUrl; ?>produse/preturimape').then(function(response){
            $scope.preturi = response.data.records;
        }); 
    };
    $scope.incarcaComanda = function() {
        return $http.get('<?php echo Yii::$app->homeUrl; ?>produse/produs/'+idProdus).then(function(response){
                var json2 = response.data;
                $scope.client = json2;
        });
    };
    //metode
    Promise.all([
        $scope.listaPreturi(),
        $scope.incarcaComanda()
    ]).then(function(data){
        
        $scope.getPremium = function(vari,ide) {
            console.log(vari+' '+ide);
            var ret = null;
            var tab = $scope.preturi.premium;
            for(var i=0;i<tab[vari].length;i++) {
                if(Number(tab[vari][i].id) === Number(ide)) { 
                    ret=tab[vari][i];
                    break;
                }
            }
            console.log(ret);
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
        //functiile pentru preturi
        $scope.view={
            magnetPremium: function(){
                console.log('intrat');
                return $scope.getPremium('magnet',$scope.client.premium.magnet).text;
            }
        };

        //end functii pentru preturi
        $scope.getFont = function() {
            return $scope.getAmbele("fonturi",$scope.client.ambele.font).link;
        };
        $scope.$apply(function(){
            $scope.view.magnetPremium();
        });
    });
}]);
</script>