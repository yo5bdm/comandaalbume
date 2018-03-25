/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var app = angular.module("myApp", []);
app.controller("myCtrl", ['$scope', '$window','$http', function($scope,$window,$http) {
    var promise = $http.get(home+'produse/listapreturi').then(function(response){
        console.log(response);
        var json = response.data.records;
        for(key in json) {
            $scope[key] = json[key];
        }
    });
    //metode
    promise.then(function(data){
        //metode retrieve
        $scope.getCopFata = function(ide) {
            var ret = null;
            var cop = $scope.copertaFata;
            for(var i=0;i<cop.length;i++) {
                for(var j=0;j<cop[i].values.length;j++){
                    if(Number(cop[i].values[j].id) === Number(ide)) { 
                        ret=cop[i].values[j];
                        break;
                    }
                }
                if(ret!=null) break;
            }
            return ret;
        };
        $scope.get = function(vari,ide) {
            var ret = null;
            for(var i=0;i<$scope[vari].length;i++) {
                if(Number($scope[vari][i].id) === Number(ide)) { 
                    ret=$scope[vari][i];
                    break;
                }
            }
            return ret;
        };
        $scope.getDimensiuniLaminareFata = function() {
            return $scope.get("dimensiuniLaminare",$scope.client.albumSelectat).fata;
        }
        $scope.getDimensiuniLaminareIntegral = function() {
            return $scope.get("dimensiuniLaminare",$scope.client.albumSelectat).integral;
        }
        $scope.getFontFata = function() {
            return $scope.get("fonturi",$scope.client.fontTextCopertaFata).link;
        }
        $scope.getFontSpate = function() {
            return $scope.get("fonturi",$scope.client.fontTextCopertaSpate).link;
        }
        //control vizibilitate
        $scope.laminareVizibil = function() {
            if($scope.getCopFata($scope.client.copertaFataSel).optiune === 1) {
                return true;
            } else {
                return false;
            }
        };
        $scope.textPeCopertaFataVizibil = function() {
            var array1 = [1,4,5,6,7,8,9,12,13];
            if(array1.includes($scope.getCopFata($scope.client.copertaFataSel).id)) {
                return true;
            } else {
                return false;
            }
        };
        $scope.tipCanvasVizibil = function() {
            if($scope.getCopFata($scope.client.copertaFataSel).optiune === 2) {
                return true;
            } else {
                return false;
            }
        };
        $scope.pozitiePaspartuVizibil = function() {
            var array1 = [4, 5];
            if(array1.includes($scope.getCopFata($scope.client.copertaFataSel).id)) {
                return true;
            } else {
                return false;
            }
        };
        $scope.codPaspartuVizibil = function() {
            var array1 = [5];
            if(array1.includes($scope.getCopFata($scope.client.copertaFataSel).id)) {
                return true;
            } else {
                return false;
            }
        }; 
        $scope.pozitiePlexiglasuVizibil = function() {
            var array1 = [6,7,8,9];
            if(array1.includes($scope.getCopFata($scope.client.copertaFataSel).id)) {
                return true;
            } else {
                return false;
            }
        };
        $scope.listaReplici = function() {
            var cod = $scope.get('albume',$scope.client.albumSelectat).grupa;
            var repl = $scope.replici;
            var ret = null;
            for(var i=0;i<repl.length;i++) {
                if(Number(repl[i].grupa) === Number(cod)) { 
                    ret=repl[i].elemente;
                    break;
                }
            }
            return ret;
        };
        $scope.adauga = function() {
            $scope.client.replici.push({
                id:$scope.replicaSelectata,
                bucati:$scope.bucReplica
            });
        };
        $scope.replica = function(ide) {
            var repl = $scope.replici;
            for(var i=0;i<repl.length;i++) {
                for(var j=0;j<repl[i].elemente.length;j++) {
                    if(Number(repl[i].elemente[j].id) === Number(ide)) {
                        return repl[i].elemente[j].text;
                    }
                }
            }
        };
        $scope.pretReplica = function(ide) {
            var repl = $scope.replici;
            for(var i=0;i<repl.length;i++) {
                for(var j=0;j<repl[i].elemente.length;j++) {
                    if(Number(repl[i].elemente[j].id) === Number(ide)) {
                        return repl[i].elemente[j].pret;
                    }
                }
            }
        };
        $scope.stergeReplica = function(ide) {
            for(var i=0;i<$scope.client.replici.length;i++) {
                if($scope.client.replici[i].id === ide) {
                    $scope.client.replici.splice(i,1);
                    break;
                }
            }
        };
        
        $scope.totalReplici = function() {
            var tot=0;
            var repl = $scope.client.replici;
            for(var i=0;i<repl.length;i++) {
                tot += $scope.client.nrMontaje * $scope.pretReplica(repl[i].id) * repl[i].bucati;
            }
            return tot;
        };
        //ce selecteaza userul
        $scope.bucReplica=1;
        $scope.replicaSelectata;
        $scope.client = {};
        $scope.client.replici = [];
        $scope.client.produs="album";
        $scope.client.idComanda = idCd;
        $scope.client.nrMontaje=20; //https://docs.angularjs.org/api/ng/input/input%5Brange%5D
        $scope.client.albumSelectat='15'; //id-ul blocului interior selectat
        $scope.client.designColajeSel='1';
        $scope.client.copertaBuretataSel='1';
        $scope.client.codCopFata='1';
        $scope.client.codCopSpate='1';
        $scope.client.codCopCotor='1';
        $scope.client.bucCopertaSel='1';
        $scope.client.coltareSel='1';
        $scope.client.cutieCartonSel='1';
        $scope.client.faceOffSel='1';
        $scope.client.copertaFataSel='1';
        $scope.client.lipireSel='1';
        $scope.client.laminareSel = '1';
        $scope.client.tipCanvasSel = '1';
        
        $scope.client.pozitiePaspartuCoperta='1';
        $scope.client.dimensiunePaspartuSel = '1';
        $scope.client.codRamaPaspartuSel = '1';
        $scope.client.pozitiePlexiglasCoperta = '1';
        //text coperta
        $scope.client.tipInscriptionareSel='1';
        $scope.client.optiuniInscriptionareFata='1';
        $scope.client.fontTextCopertaFata = '1';
        $scope.client.textCopertaFata='';
        $scope.client.pozitieTextCopertaFata='1';
        $scope.client.optiuniInscriptionareSpate='1';
        $scope.client.fontTextCopertaSpate = '1';
        $scope.client.textCopertaSpate='';
        $scope.client.pozitieTextCopertaSpate='1';
        //fisiere
        $scope.client.linkFisiere='';
        //observatii
        $scope.client.observatii='';
        $scope.client.pretTotal=0;
        
        $scope.client.cutieLux ={};
        $scope.client.cutieLux.da='0';
        $scope.client.cutieLux.coltare='1';
        $scope.client.cutieLux.coperta='1';
        $scope.client.cutieLux.dimensiuniplexiglas='1';
        $scope.client.cutieLux.inscriptionare='1';
        $scope.client.cutieLux.text="";
        $scope.client.cutieLux.font='1';
        $scope.client.cutieLux.pozitieText='1';
        $scope.client.cutieLux.panglica='1';
        $scope.client.cutieLux.materialcadru='1';
        
        $scope.getFontCutie = function() {
            return $scope.get("fonturi",$scope.client.cutieLux.font).link;
        };
        $scope.getCutieLux = function(vari,ide) {
            var ret = null;
            var v = $scope.cutielux;
            for(var i=0;i<v[vari].length;i++) {
                if(Number(v[vari][i].id) === Number(ide)) { 
                    ret=v[vari][i];
                    break;
                }
            }
            return ret;
        };
        $scope.totalCutieLux = function() {
            var ret = 0;
            var v = $scope.client.cutieLux;
            if(v.da==1) ret = $scope.cutielux.pretunitar;
            ret += $scope.getCutieLux('coltare',v.coltare).pret;
            ret += $scope.getCutieLux('coperta',v.coperta).pret;
            ret += $scope.getCutieLux('dimensiuniplexiglas',v.dimensiuniplexiglas).pret;
            ret += $scope.getCutieLux('inscriptionare',v.inscriptionare).pret;
            ret += $scope.getCutieLux('panglica',v.panglica).pret;
            ret += $scope.getCutieLux('materialcadru',v.materialcadru).pret;
            return ret;
        };
        
        //metoda calcul pret total
        $scope.calculeaza = function() {
            var ret = Number($scope.coperta);
            ret += (Number($scope.get('albume',$scope.client.albumSelectat).pret) * Number($scope.client.nrMontaje));
            ret += (Number($scope.get('designColaje',$scope.client.designColajeSel).pret) * Number($scope.client.nrMontaje));
            ret += Number($scope.get('copertaBuretata',$scope.client.copertaBuretataSel).pret);
            ret += Number($scope.get('inscriptionare',$scope.client.tipInscriptionareSel).pret);
            ret += Number($scope.get('coltare',$scope.client.coltareSel).pret);
            ret += Number($scope.get('cutieCarton',$scope.client.cutieCartonSel).pret);
            ret += Number($scope.get('faceOff',$scope.client.faceOffSel).pret);
            ret += Number($scope.getCopFata($scope.client.copertaFataSel).pret);
            ret += (Number($scope.get('lipire',$scope.client.lipireSel).pret)*Number($scope.client.nrMontaje));
            ret += $scope.totalReplici();
            ret += $scope.totalCutieLux();
            return ret;        
        };
        $scope.salveazaComanda = function() {
            $scope.client.pretTotal = $scope.calculeaza();
            var parameter = {
                "_csrf":csrfT,
                "descriere":JSON.stringify($scope.client)
            };
            console.log(parameter);
            var url = home + "produse/create";
            $http.post(url, parameter).then(
                function(response) {
                    if(response.data === 1) { //salvare reusita
                        $window.location.href= home+"orders/view/"+idCd;
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