var app = angular.module("myApp", []);
app.controller("myCtrl", ['$scope', '$window','$http', function($scope,$window,$http) {
    $scope.listaPreturi = function() { 
        return $http.get(home+'produse/listapreturi').then(function(response){
            var json = response.data.records;
            for(var key in json) {
                $scope[key] = json[key];
            }
        });
    };
    $scope.incarcaComanda = function(data){
        return $http.get(home+'produse/produs/'+idProdus).then(function(response){
            var json2 = response.data;
            $scope.client = json2;
        });
    };
    
    //metode
    Promise.all([
        $scope.listaPreturi(),
        $scope.incarcaComanda()
    ]).then(function(data){  
        //metode view
        $scope.view = {
            blocInterior : function() {
                return $scope.albume.find(album => album.id == $scope.client.albumSelectat).text;
            },
            lipire: function() {
                return $scope.lipire.find(lip => lip.id == $scope.client.lipireSel).text;
            },
            copertaBuc: function() {
                return $scope.bucCoperta.find(cop => cop.id == $scope.client.bucCopertaSel).text;
            },
            codCopertaFata: function() {
                return $scope.coduriCoperta.find(cop=> cop.id == $scope.client.codCopFata).text;
            },
            codCopertaSpate: function() {
                return $scope.coduriCoperta.find(cop=> cop.id == $scope.client.codCopSpate).text;
            },
            codCopertaCotor: function() {
                return $scope.coduriCoperta.find(cop=> cop.id == $scope.client.codCopCotor).text;
            },
            tipCopertaFata: function() {
                var cop = $scope.copertaFata;
                for(var i=0;i<cop.length;i++) {
                    var c = cop[i];
                    for(var j=0;j<c.values.length;j++) {
                        if(c.values[j].id == $scope.client.copertaFataSel) {
                            return c.label+ ": " +c.values[j].text;
                        }
                    }
                }
            },
            laminare: function() {
                return $scope.laminare.find(lam => lam.id == $scope.client.laminareSel).text;
            },
            pozitiePaspartuCoperta: function() {
                return $scope.pozitieElement.find(poz => poz.id == $scope.client.pozitiePaspartuCoperta).text;
            },
            dimensiunePaspartuCopertaAlbum: function() {
                return $scope.dimensiunePaspartu.find(dim => dim.id == $scope.client.dimensiunePaspartuSel).text;
            },
            codMaterialRamaPaspartuAlbum: function() {
                return $scope.coduriCoperta.find(cop => cop.id == $scope.client.codRamaPaspartuSel).text;
            },
            tipCanvas: function() {
                return $scope.tipCanvas.find(cnv => cnv.id == $scope.client.tipCanvasSel).text;
            },
            pozitiePlexiglasCoperta: function() {
                return $scope.pozitieElement.find(poz => poz.id == $scope.client.pozitiePlexiglasCoperta).text;
            },
            
            tipInscriptionare: function() {
                return $scope.inscriptionare.find(ins => ins.id == $scope.client.tipInscriptionareSel).text;
            },
            optiuneInscriptionareCopertaFata: function() {
                return $scope.optiuniInscriptionare.find(opt => opt.id == $scope.client.optiuniInscriptionareFata).text;
            },
            fontCopertaFata: function() {
                return $scope.fonturi.find(f => f.id == $scope.client.fontTextCopertaFata).text;
            },
            pozitieTextCopertaFata: function() {
                return $scope.pozitieElement.find(p => p.id == $scope.client.pozitieTextCopertaFata).text;
            },
            optiuneInscriptionareCopertaSpate: function() {
                return $scope.optiuniInscriptionare.find(opt => opt.id == $scope.client.optiuniInscriptionareSpate).text;
            },
            fontCopertaSpate: function() {
                return $scope.fonturi.find(f => f.id == $scope.client.fontTextCopertaSpate).text;
            },
            pozitieTextCopertaSpate: function() {
                return $scope.pozitieElement.find(p => p.id == $scope.client.pozitieTextCopertaSpate).text;
            },
            coltare: function() {
                return $scope.coltare.find(c => c.id == $scope.client.coltareSel).text;
            },
            faceOff: function() {
                return $scope.faceOff.find(f=> f.id == $scope.client.faceOffSel).text;
            },
            cutieCarton: function() {
                return $scope.cutieCarton.find(c => c.id == $scope.client.cutieCartonSel).text;
            },
            cutieLux: {
                coltare: function() {
                    return $scope.cutielux.coltare.find(c=> c.id == $scope.client.cutieLux.coltare).text;
                },
                coperta: function() {
                    return $scope.cutielux.coperta.find(c => c.id == $scope.client.cutieLux.coperta).text;
                },
                dimPlexiglas: function() {
                    return $scope.cutielux.dimensiuniplexiglas.find(d => d.id == $scope.client.cutieLux.dimensiuniplexiglas).text;
                },
                inscriptionare: function() {
                    return $scope.cutielux.inscriptionare.find(i => i.id == $scope.client.cutieLux.inscriptionare).text;
                },
                font: function() {
                    return $scope.fonturi.find(f => f.id == $scope.client.cutieLux.font).text;
                },
                pozitie: function() {
                    return $scope.pozitieElement.find(p => p.id == $scope.client.cutieLux.pozitieText).text;
                },
                panglica: function() {
                    return $scope.cutielux.panglica.find(p => p.id == $scope.client.cutieLux.panglica).text;
                },
                materialCadru: function() {
                    return $scope.cutielux.materialcadru.find(m => m.id == $scope.client.cutieLux.materialcadru).text;
                }
            }
        };
        

        
        
        //metode retrieve
        $scope.ucfirst = function(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        };
        $scope.getCopFata = function(ide) {
            var ret = null;
            var cop = $scope.copertaFata;
            var label="";
            for(var i=0;i<cop.length;i++) {
                label = cop[i].label;
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
        $scope.$apply(function(){
            $scope.ucfirst("ana");
            $scope.viewBlocInterior();
        });
    });
}]);