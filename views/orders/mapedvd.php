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
                <div class="panel-body">
                    <h4 class="text-center">Incarca din template</h4>
                    <p ng-show="templates.length==0">Nu ai salvat nici un template in aceasta categorie</p>
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
                    <h4>Salveaza comanda curenta ca template</h4>
                    <!-- Buton de salvare comanda curenta ca template curent -->
                    <input ng-model="template.nume" class="form-control" type="text" placeholder="Nume, ex: {{template.autoname()}}"/>
                    <button ng-click="template.salveaza()" class="form-control">Salveaza template nou</button>
                </div>
            </div>


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
    $scope.getPreturi = function() { $http.get('<?php echo Yii::$app->homeUrl; ?>produse/preturimape').then(function(response){
            $scope.preturi = response.data.records;
            console.log(response.data.records);
        }); 
    };
    $scope.getTemplates = function() {
        $http.get(home+'templates/user/mapedvd/'+userID).then(function(response){
            $scope.templates = response.data;
        });
    };
    //metode
    Promise.all([
        $scope.getPreturi(),
        $scope.getTemplates()
    ]).then(function(data){
        $scope.client={
            produs:"mapadvd",
            observatii:'',
            idComanda : <?:$id?>,
            tip:"Premium",
            premium:{
                nrdiscuri:"1",
                magnet:"1"
            },
            clasic :{
                nrdiscuri:"1",
                laminare:"1"
            },
            ambele :{
                nrbucati:1,
                coperta:"1",
                dimensiunipaspartu:"1",
                inscriptionare:"1",
                text:"",
                font:'1',
                pozitieText:'1',
                copertaburetata:"1",
                coltare:"1"
            },            
            pretTotal:0
        };
        
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

        $scope.template = {
            tipProdus:'mapedvd',
            comanda:{},
            nume:'',
            incarca: function(ids) {
                let selectat = JSON.parse($scope.templates.find(t=>t.id==ids).descriere);
                for(var key in selectat) {
                    if(typeof selectat[key] === "object") {//daca e obiect
                        for(var kkey in selectat[key]) {
                            $scope.client[key][kkey] = selectat[key][kkey];
                        }
                    } else if(Array.isArray(selectat[key])) { //daca e array
                        $scope.client[key] = selectat[key].slice();
                    } else { //daca nu e obiect sau array                        
                        $scope.client[key] = selectat[key];
                    }
                }
            },
            autoname: function() {
                return "Mapa DVD";
            },
            salveaza: function() {
                //copiem comanda
                this.comanda = JSON.parse(JSON.stringify($scope.client));
                //stergem campurile care nu trebuie sa apara in template
                delete this.comanda.idComanda;
                delete this.comanda.observatii;
                delete this.comanda.ambele.text;
                delete this.pretTotal;
                //verificam daca numele este setat corect
                if(this.nume.length==0) {
                    alert('Nu ai completat numele template-ului!');
                    return;
                }
                //-----------------------------------------
                var parameter = {
                    //"_csrf":csrfT,
                    "descriere":JSON.stringify(this.comanda),
                    "clientID":userID,
                    "titlu":this.nume,
                    "tipProdus":this.tipProdus
                };
                var url = home + "templates/create";
                $http.post(url, parameter).then(
                    function(response) {
                        if(response.data.titlu == parameter.titlu) { //salvare reusita
                            //refresh lista
                            $scope.getTemplates();
                        } else { //eroare din PHP
                            alert("Salvare nereusita! Te rog sa verifici datele/conexiunea si sa incerci din nou.");
                        }
                    },
                    function(response) { //eroare de comunicare
                         alert(response.data[0].message);
                    }
                );
            },
            sterge: function(ids) {
                var url = home + "templates/delete/";
                $http.delete(url+ids).then(function(response){
                    $scope.getTemplates();
                });
            }
        }; //end templates
        
    });
}]);
</script>