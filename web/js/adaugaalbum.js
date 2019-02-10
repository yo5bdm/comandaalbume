var app = angular.module("myApp", []);
app.directive('condSrc',function($http){
    return {
        restrict: 'A',
        scope: {
            lnk: '='
        },
        link: function(scope, elem, attrs) {
            scope.$watch('lnk', function() {
                if(typeof scope.lnk === 'undefined') {
                    elem.attr('src',homeUrl+'include/materiale/wide/1.jpg');
                    return;
                }
                var linkFinal = homeUrl+'include/materiale/wide/'+scope.lnk+'.jpg';
                $http.get(linkFinal).then(function(){
                    elem.attr('src',linkFinal);
                },function(){
                    elem.attr('src',homeUrl+'include/materiale/wide/1.jpg');
                });
            });
        },
    };
});
app.controller("myCtrl", ['$scope', '$window','$http', function($scope,$window,$http) {
    $scope.getProduse = function() {
        $http.get(home+'produse/listapreturi').then(function(response){
            var json = response.data.records;
            for(key in json) {
                $scope[key] = json[key];
            }
        });
    }; 
    $scope.getTemplates = function() {
        $http.get(home+'templates/user/album/'+userID).then(function(response){
            $scope.templates = response.data;
        });
    };
    $scope.getCoduriCoperti = function() {
        $http.get(home+'produse/coduricoperti').then(function(response){
            $scope.coduriCoperta = response.data;
        });
    }
    //metode
    Promise.all([
        $scope.getProduse(),
        $scope.getTemplates(),
        $scope.getCoduriCoperti()
    ]).then(function(data){
        //metode retrieve
        $scope.getCopFata = function(ide) {
            var ret = null;
            var cop = $scope.copertaFata;
            if(typeof cop === 'undefined') return [];
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
        };
        $scope.getDimensiuniLaminareIntegral = function() {
            return $scope.get("dimensiuniLaminare",$scope.client.albumSelectat).integral;
        };
        $scope.getFontFata = function() {
            return $scope.get("fonturi",$scope.client.fontTextCopertaFata).link;
        };
        $scope.getFontSpate = function() {
            return $scope.get("fonturi",$scope.client.fontTextCopertaSpate).link;
        };
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
        
        $scope.client = {
            produs:"album",
            replici:[],
            idComanda:idCd,
            nrMontaje:20, //https://docs.angularjs.org/api/ng/input/input%5Brange%5D
            albumSelectat:'15', //id-ul blocului interior selectat
            designColajeSel:'1',
            copertaBuretataSel:'1',
            codCopFata:'1',
            codCopSpate:'1',
            codCopCotor:'1',
            bucCopertaSel:'1',
            coltareSel:'1',
            cutieCartonSel:'1',
            faceOffSel:'1',
            copertaFataSel:'1',
            lipireSel:'1',
            laminareSel : '1',
            tipCanvasSel : '1',
            
            pozitiePaspartuCoperta:'1',
            dimensiunePaspartuSel : '1',
            codRamaPaspartuSel : '1',
            pozitiePlexiglasCoperta : '1',
            
            //text coperta
            tipInscriptionareSel:'1',
            optiuniInscriptionareFata:'1',
            fontTextCopertaFata : '1',
            textCopertaFata:'',
            pozitieTextCopertaFata:'1',
            optiuniInscriptionareSpate:'1',
            fontTextCopertaSpate : '1',
            textCopertaSpate:'',
            pozitieTextCopertaSpate:'1',
            
            //fisiere
            linkFisiere:'',
            
            //observatii
            observatii:'',
            pretTotal:0,
            
            //optiuni cutie lux
            cutieLux:{
                da:'0',
                coltare:'1',
                coperta:'1',
                dimensiuniplexiglas:'1',
                inscriptionare:'1',
                text:"",
                font:'1',
                pozitieText:'1',
                panglica:'1',
                materialcadru:'1'
            }            
        };

        $scope.template = {
            tipProdus:'album',
            comanda:{},
            nume:'',
            incarca: function(ids) {
                let selectat = JSON.parse($scope.templates.find(t=>t.id==ids).descriere);
                $scope.client.replici = []; //daca in template nu exista replici, resetul nu se executa in ramura aferenta
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
                return $scope.client.produs+' '+$scope.get('albume',$scope.client.albumSelectat).text+' '+$scope.client.nrMontaje+' colaje';
            },
            salveaza: function() {
                //copiem comanda
                this.comanda = JSON.parse(JSON.stringify($scope.client));
                //stergem campurile care nu trebuie sa apara in template
                delete this.comanda.idComanda;
                delete this.comanda.cutieLux.text;
                delete this.comanda.observatii;
                delete this.comanda.linkFisiere;
                delete this.comanda.textCopertaFata;
                delete this.comanda.textCopertaSpate;
                delete this.comanda.pretTotal;
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
                //-----------------------------------------
                //console.log(this.comanda);
            },
            sterge: function(ids) {
                var url = home + "templates/delete/";
                $http.delete(url+ids).then(function(response){
                    $scope.getTemplates();
                });
            }
        };
        
        
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
            if($scope.client.linkFisiere.length == 0) {
                alert("Nu ai pus linkul pentru fisiere!");
                return;
            }

            var parameter = {
                "_csrf":csrfT,
                "descriere":JSON.stringify($scope.client)
            };
            console.log(parameter);
            var url = home + "produse/create";
            $http.post(url, parameter).then(
                function(response) {
                    if(response.data == 1) { //salvare reusita
                        $window.location.href= home+"orders/view/"+idCd;
                    } else { //eroare din PHP
                        alert("Salvare nereusita! \nEroare: "+response.data);
                    }
                },
                function(response) { //eroare de comunicare
                     alert("Eroare de comunicare, va rugam incercati mai tarziu "+response);
                }
            );
        };
    });
}]);
