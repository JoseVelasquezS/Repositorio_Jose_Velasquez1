//**************************//
//Author: DIEGO CASALLAS
//Date: 24/08/2019
//Description : funtions data Client
//************GET DATA FORM**************//

//**Function add Obligation **/
//Author: DIEGO CASALLAS
//Date: 18/11/2020
//Description : send data create obligation
function setDataObligation(dataSetObligation) {
    try {
        loadPageView();
        dataSetObligation = '{"POST":"POST",' + dataSetObligation + '}';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../../php/bo/bo_obligation.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                if (xhttp.responseText != 0) {
                    enableScroll();
                    viewModal("customerModal", 1);
                    createModalAlert("Operación realizada con éxito", 1, 3000);
                    loadView();
                } else {
                    enableScroll();
                    createModalAlert("Valide la información", 3, 4000);
                }
            }
        }
        xhttp.send(dataSetObligation);
    } catch (error) {
        enableScroll();
        console.error(error);

    }
}
//Description : function load view page 
function loadView() {

    loadPageView();
    getLocationCode();;
    getActionStorage();
}
//**Function get Obligation **/
//Author: DIEGO CASALLAS
//Date: 21/11/2020
//Description : get location url,and read the code of the obligation
function getLocationCode() {
    var getUrl = window.location.href;
    var getCode = getUrl.indexOf("?");
    var arrayJson = getUrl.substring(getCode + 1, getUrl.length).split(":");

    getDataPayObligation("tablePayObligation", '"' + arrayJson[0] + '":"' + arrayJson[1] + '"', 0);
}
//**Function get Obligation **/
//Author: DIEGO CASALLAS
//Date: 21/11/2020
//Description : send data get table  pay obligation
function getDataPayObligation(table, dataSetObligation, typeSend) {
    try {
        loadPageView();
        var xhttp = new XMLHttpRequest();
        var arrayPayObli = new Array("Código", "Valor Ini", "# Cuotas", "# Cuota", "# C Faltantes", "Fecha Pago", "Valor Pago", "Acciones");
        var JsonData;
        xhttp.open("POST", "../../php/bo/bo_payObligation.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");

        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {

                if (xhttp.responseText != "") {
                    var jsonObj = JSON.parse(xhttp.responseText);

                    if (jsonObj.length != 0) {
                        enableScroll();
                        console.log(jsonObj);
                        if (typeSend == 0) {

                            tableObligation = new Table(table, arrayPayObli, jsonObj);
                            tableObligation.createTablePayObligations();

                            /*else if (typeSend == 1) {
                                                           //console.log(jsonObj);
                                                           setDataForm(jsonObj);
                                                           viewModal('customerModal', 0);
                                                       } else if (typeSend == 3) {
                                                           console.log(jsonObj);
                                                           tablePayObligation = new Table(table, arrayPayObli, jsonObj);
                                                           tablePayObligation.createTablePayObligations();
                                                       }*/
                        } else {
                            enableScroll();
                        }
                    }
                }
            };


        }
        if (typeSend == 0) {

            JsonData = '{"GET":"GET_PAY_OBLIGATION",' + dataSetObligation + '}';

        }

        xhttp.send(JsonData);
    } catch (error) {
        console.error(error);
        enableScroll();
    }
}
//**********************GED EDIT****************************//
function getDataEdit(code) {

    getDataObligation("", code, 0);

}
//**********************END CLIENT****************************//
//**********************GED DELETE****************************//
function getDelete(code) {

    getDataObligation("", code, 0);

}
//**********************END CLIENT****************************//
//**********************GED EDIT****************************//
function getPay(code) {

    location.href = "../../pages/payObligation/obligation.php";
    //alert(code);
    getDataObligation("", code, 3);

}
//**********************END CLIENT****************************//


//************ LOAD VIEW STORAGE ******************/
function getActionStorage() {
    let obj = new StoragePage();
    let json = JSON.parse(obj.getStorageLogin());
    0
    if (json !== null) {
        getDataUserId(json[0]["User_id"]);
    } else {
        locationLogin();
    }
}
//************GET DATA FORM**************//
function sendData(idForm, e) {
    let jSon = "";

    if (validatorForm(idForm)) {
        jSon = getDataForm(idForm);
        setDataObligation(jSon);
    } else {
        createModalAlert("Error al realizar el registro", 4, 4000);
    }
    e.preventDefault();
}
//************ Search Obligations ******************/
function searchObligation(e) {
    try {

        var objForm = document.getElementById('formSearchObligation');
        let intLogForm = objForm.querySelectorAll('input').length;
        let jsonData = '';

        for (let i = 0; i < intLogForm; i++) {
            jsonData = objForm[i].value;

        }
        getDataObligation("tablePayObligation", jsonData, 1);
    } catch (error) {
        console.error(error);
    }
    e.preventDefault();
}

function newObligation() {
    document.getElementById('obligation_id').value = "0";
}
//**Function get List Bank **/
function getListBank(idSelect) {
    try {
        var xhttp = new XMLHttpRequest();
        var JsonData;
        xhttp.open("POST", "../../php/bo/bo_obligation.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var jsonObj = JSON.parse(xhttp.responseText);
                if (jsonObj.length != 0) {
                    selectStatus = new SelectList(idSelect, jsonObj);
                    selectStatus.createListBank();
                }
            }
        };
        JsonData = '{"GET":"GET_LIST_BANK"}';
        xhttp.send(JsonData);
    } catch (error) {
        console.error(error);
    }
}
//**********************END BANK****************************//
//**Function get List Client maximo **/
function getClientMaximo(idSelect) {
    try {
        var xhttp = new XMLHttpRequest();
        var JsonData;
        xhttp.open("POST", "../../php/bo/bo_obligation.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var jsonObj = JSON.parse(xhttp.responseText);
                if (jsonObj.length != 0) {
                    selectStatus = new SelectList(idSelect, jsonObj);
                    selectStatus.createListMaximo();
                }

            }
        };
        JsonData = '{"GET":"GET_CLIENT_MAXIMO"}';
        xhttp.send(JsonData);
    } catch (error) {
        console.error(error);
    }
}
//**Function cath value Client maximo **/
function getSelectContract(id) {
    try {
        var objSelect = document.getElementById(id);
        let idNit = objSelect.value;
        let nameClient = objSelect.options.item(objSelect.selectedIndex).text;
        document.getElementById('client_name').value = nameClient.substring(nameClient.indexOf("|") + 1, nameClient.length);
        sendClientContractMaximo("client_contract", idNit);
    } catch (error) {
        console.error(error);
    }
}
//**********************END BANK****************************//
//**Function get List Client Contract maximo **/
function sendClientContractMaximo(idSelect, idClient) {
    try {
        var xhttp = new XMLHttpRequest();
        var JsonData;
        xhttp.open("POST", "../../php/bo/bo_obligation.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var jsonObj = JSON.parse(xhttp.responseText);
                if (jsonObj.length != 0) {
                    selectStatus = new SelectList(idSelect, jsonObj);
                    selectStatus.createListContractMaximo();
                }

            }
        };
        JsonData = '{"GET":"GET_CLIENT_CONTRACT_MAXIMO","nit":"' + idClient + '"}';
        xhttp.send(JsonData);
    } catch (error) {
        console.error(error);
    }
}
//**********************END BANK****************************// 
//**Function get List type_credit **/
function getListTypeCredit(idSelect) {
    try {
        var xhttp = new XMLHttpRequest();
        var JsonData;
        xhttp.open("POST", "../../php/bo/bo_obligation.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var jsonObj = JSON.parse(xhttp.responseText);
                if (jsonObj.length != 0) {
                    selectStatus = new SelectList(idSelect, jsonObj);
                    selectStatus.createListTypeCredit();
                }

            }
        };
        JsonData = '{"GET":"GET_TYPE_OBLIGATION"}';
        xhttp.send(JsonData);
    } catch (error) {
        console.error(error);
    }
}
//**********************END BANK****************************//
//**Function get List type_interes **/
function getListTypeInteres(idSelect) {
    try {
        var xhttp = new XMLHttpRequest();
        var JsonData;
        xhttp.open("POST", "../../php/bo/bo_obligation.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var jsonObj = JSON.parse(xhttp.responseText);
                if (jsonObj.length != 0) {
                    selectStatus = new SelectList(idSelect, jsonObj);
                    selectStatus.createListTypeInteres();
                }

            }
        };
        JsonData = '{"GET":"GET_TYPE_INTERES"}';
        xhttp.send(JsonData);
    } catch (error) {
        console.error(error);
    }
}
//**********************END BANK****************************//
//**Function get List amortization_method **/
function getListMethodAmortization(idSelect) {
    try {
        var xhttp = new XMLHttpRequest();
        var JsonData;
        xhttp.open("POST", "../../php/bo/bo_obligation.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var jsonObj = JSON.parse(xhttp.responseText);
                if (jsonObj.length != 0) {
                    selectStatus = new SelectList(idSelect, jsonObj);
                    selectStatus.createListMethodAmortization();
                }
            }
        };
        JsonData = '{"GET":"GET_METHOD_AMORTIZATION"}';
        xhttp.send(JsonData);
    } catch (error) {
        console.error(error);
    }
}
//**********************END BANK****************************//