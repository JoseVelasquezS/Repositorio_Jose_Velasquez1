//**************************//
//Author: Cristian malaver
//Date: 24/11/2020
//Description : Class Table for amortization method
//************CLASS TABLE**************//

class TableAmortization {
    Bank_id;
    amortization_type_id;
    credit_type_id;
    cuotes_number;
    desembolso_date;
    dtf;
    dtf_points;
    fixed_rate;
    ibr;
    ibr_points;
    initial_value;
    interesting_type_id;
    residual_number;

    constructor(id, jSon) {
        this.id = id;
        this.jSon = jSon;
    }

    getdatajson() {

        this.Bank_id = this.jSon[0].Bank_id;
        this.amortization_type_id = this.jSon[0].amortization_type_id;
        this.credit_type_id = this.jSon[0].credit_type_id;
        this.cuotes_number = this.jSon[0].cuotes_number;
        this.desembolso_date = this.jSon[0].desembolso_date;
        this.dtf = this.jSon[0].dtf;
        this.dtf_points = this.jSon[0].dtf_points;
        this.fixed_rate = this.jSon[0].fixed_rate;
        this.ibr = this.jSon[0].ibr;
        this.ibr_points = this.jSon[0].ibr_points;
        this.initial_value = this.jSon[0].initial_value;
        this.interesting_type_id = this.jSon[0].interesting_type_id;
        this.residual_number = this.jSon[0].residual_number;


        const txtMonto = this.initial_value;
        const txtTiempo = this.cuotes_number;
        const txtDTF = this.dtf;
        const txtIBR = this.ibr;
        const txtPuntosDTF =  this.dtf_points;
        const txtTasaFija = this.fixed_rate;
        const txtPuntosIBR =  this.ibr_points;
        const txtOpcion = this.residual_number;
        const fechaDesembolso =  this.desembolso_date;
        const CuerpoTabla = document.querySelector('#lista-tabla tbody');
        const amortization = this.amortization_type_id;

        const ListaInteres =  this.interesting_type_id;
        const ABONO_A_CUOTA = 1;
        const ABONO_A_CAPITAL = 2;


    if (ListaInteres == 1){
            calcularCuotaDtf(txtMonto, txtTiempo, txtDTF, txtPuntosDTF, txtOpcion, amortization, fechaDesembolso);

    }else if(ListaInteres == 2){

            calcularCuotaIbr(txtMonto, txtTiempo, txtIBR, txtPuntosIBR, txtOpcion, amortization, fechaDesembolso);

        

    }else if (ListaInteres == 3){
            calcularCuotaFija(txtMonto, txtTiempo, txtOpcion, amortization, fechaDesembolso, txtTasaFija);
        
            } 
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function ValidarNumeros(valor, nombreVariable) {
    if (isNaN(valor)) {
        alert("Valor no valido para : " + nombreVariable);
        return false;
    }
    else {
        return true;
    }
}

function ValidarCampos(monto, tiempo, dtf, ibr, puntosDtf, puntosIbr, opcion) {


    /*console.log("monto:"+monto);
    console.log("tiempo:"+tiempo);
    console.log("dtf:"+dtf);
    console.log("ibr:"+ibr);
    console.log("puntosDtf:"+puntosDtf);
    console.log("puntosIbr:"+puntosIbr);
    console.log("Opcion:"+opcion);
*/

    let valoresValidosMonto = ValidarNumeros(monto, "monto");
    let valoresValidosTiempo = ValidarNumeros(tiempo, "tiempo");
    let valoresValidosDTF = ValidarNumeros(dtf, "DTF");
    let valoresValidosIBR = ValidarNumeros(ibr, "IBR");
    let valoresValidospuntosDtf = ValidarNumeros(puntosDtf, "puntosDtf");
    let valoresValidospuntosIbr = ValidarNumeros(puntosIbr, "puntosIbr");
    let valoresValidosopcion = ValidarNumeros(opcion, "opcion");
    if (Number(monto) < Number(opcion)) {
        alert("no se hace calculo por que la opcion es mayor al monto");
        valoresValidosopcion = false;
    }
    if (valoresValidosTiempo) {
        if (tiempo >= 200) {
            alert("no se hace calculo por que el tiempo supero 200 meses");
            valoresValidosTiempo = false;
        }
    }
    if (valoresValidosMonto && valoresValidosTiempo && valoresValidosDTF && valoresValidosIBR && valoresValidospuntosDtf && valoresValidospuntosIbr && valoresValidosopcion) {

        return true;
    }
    else {
        return false;
    }



}

function CalcularPagoCuotaDtf(dtfmensual, tiempo, opcion, monto) {
    //formula de pago
    //calculo de A 
    let nuevoa = (1 + dtfmensual);
    //console.log(nuevoa);
    let nuevoa1 = Math.pow(nuevoa, -tiempo);
    let nuevoa2 = 1 - nuevoa1;
    let A = (nuevoa2 / dtfmensual);
    //calculo de B
    let vfutu = 1 + dtfmensual;
    // console.log(vfutu);
    let vfutur = Math.pow(vfutu, -tiempo);
    let B = (opcion * vfutur);
    //Calculo de componente financiero 
    let comp = monto - B;
    return comp / A;
}
function CalcularPagoCuotaIbr(ibrmensual, tiempo, opcion, monto) {
    //formula de pago
    //calculo de A 
    let nuevoa = (1 + ibrmensual);
    //console.log(nuevoa);
    let nuevoa1 = Math.pow(nuevoa, -tiempo);
    let nuevoa2 = 1 - nuevoa1;
    let A = (nuevoa2 / ibrmensual);
    //calculo de B
    let vfutu = 1 + ibrmensual;
    // console.log(vfutu);
    let vfutur = Math.pow(vfutu, -tiempo);
    let B = (opcion * vfutur);
    //Calculo de componente financiero 
    let comp = monto - B;
    return comp / A;
}function CalcularPagoCuotaFijo(dtfmensual, tiempo, opcion, monto) {
    //formula de pago
    //calculo de A 
    let nuevoa = (1 + dtfmensual);
    //console.log(nuevoa);
    let nuevoa1 = Math.pow(nuevoa, -tiempo);
    let nuevoa2 = 1 - nuevoa1;
    let A = (nuevoa2 / dtfmensual);
    //calculo de B
    let vfutu = 1 + dtfmensual;
    // console.log(vfutu);
    let vfutur = Math.pow(vfutu, -tiempo);
    let B = (opcion * vfutur);
    //Calculo de componente financiero 
    let comp = monto - B;
    return comp / A;
}
function DividirPor100(numero) {
    return numero / 100;
}
function CalculoTasaEfctivaAnual(tasa, puntos) {
    // return (1 + tasa) * (1 + puntos) - 1;  //tasa.efectiva     
    return tasa + puntos;               //tasa nominal 
}

function calcularCuotaDtf(monto, tiempo, dtf, puntosDtf, opcion, metodo, fechaDesembolso) {

    LimpiarCuerpoTabla();
    let camposValidos = true;//ValidarCampos(monto, tiempo, dtf, ibr, puntosDtf, puntosIbr, opcion);
    if (camposValidos) {
        let fechas = [];
        let fechaActual = fechaDesembolso;
        let mes_actual = moment(fechaActual);
        mes_actual.add(1, 'month');

        dtf = DividirPor100(dtf);
        puntosDtf = DividirPor100(puntosDtf);
        //ibr = DividirPor100(ibr);
        //puntosIbr = DividirPor100(puntosIbr);

        let pagoInteres = 0, pagoCapital = 0, cuota = 0;

        let dtf1 = CalculoTasaEfctivaAnual(dtf, puntosDtf);
        //let ibr1 = CalculoTasaEfctivaAnual(ibr, puntosIbr);
        let meses = 12;
        //let dtfmensual = Math.pow(1 + dtf1, 1 / meses) - 1; //efectiva
        let dtfmensual = Math.pow(1 + dtf1, 1 / meses) - 1; //nominal
        if (metodo == ABONO_A_CUOTA) {
            cuota = CalcularPagoCuotaDtf(dtfmensual, tiempo, opcion, monto);

        } else if (metodo == ABONO_A_CAPITAL) {
            pagoCapital = (monto - opcion) / tiempo;


        }

        for (let i = 1; i <= tiempo; i++) {

            //Formato fechas
            fechas[i] = mes_actual.format('DD-MM-YYYY');
            mes_actual.add(1, 'month');
            if (metodo == ABONO_A_CUOTA) {
                pagoInteres = parseFloat(monto * (dtfmensual));
                pagoCapital = cuota - pagoInteres;
                monto = parseFloat(monto - pagoCapital);
            } else if (metodo == ABONO_A_CAPITAL) {
                pagoInteres = parseFloat(monto * (dtfmensual));
                cuota = pagoCapital + pagoInteres;
                monto = parseFloat(monto - pagoCapital);
            }
            PintarFilas(i, fechas[i], cuota, pagoCapital, pagoInteres, monto);
        }
    } else {
        alert("No se pueden realizar calculos");
    }
}
function calcularCuotaIbr(monto, tiempo, ibr, puntosIbr, opcion, metodo, fechaDesembolso) {

    LimpiarCuerpoTabla();
    let camposValidos = true;// ValidarCampos(monto, tiempo, dtf, ibr, puntosDtf, puntosIbr, opcion);
    if (camposValidos) {
        let fechas = [];
        let fechaActual = fechaDesembolso;
        let mes_actual = moment(fechaActual);
        mes_actual.add(1, 'month');

        ibr = DividirPor100(ibr);
        puntosIbr = DividirPor100(puntosIbr);

        let pagoInteres = 0, pagoCapital = 0, cuota = 0;

        let ibr1 = CalculoTasaEfctivaAnual(ibr, puntosIbr);
        let meses = 12;
  
        let ibrmensual = Math.pow(1 + ibr1, 1 / meses) - 1; //nominal
        if (metodo == ABONO_A_CUOTA) {
            cuota = CalcularPagoCuotaIbr(ibrmensual, tiempo, opcion, monto);

        } else if (metodo == ABONO_A_CAPITAL) {
            pagoCapital = (monto - opcion) / tiempo;


        }

        for (let i = 1; i <= tiempo; i++) {

            //Formato fechas
            fechas[i] = mes_actual.format('DD-MM-YYYY');
            mes_actual.add(1, 'month');
            if (metodo == ABONO_A_CUOTA) {
                pagoInteres = parseFloat(monto * (ibrmensual));
                pagoCapital = cuota - pagoInteres;
                monto = parseFloat(monto - pagoCapital);
            } else if (metodo == ABONO_A_CAPITAL) {
                pagoInteres = parseFloat(monto * (ibrmensual));
                cuota = pagoCapital + pagoInteres;
                monto = parseFloat(monto - pagoCapital);
            }
            PintarFilas(i, fechas[i], cuota, pagoCapital, pagoInteres, monto);
        }
    } else {
        alert("No se pueden realizar calculos");
    }
}
function calcularCuotaFija(monto, tiempo, opcion, metodo, fechaDesembolso1, InteresFijo) {

    
    LimpiarCuerpoTabla();
    let camposValidos = true;//ValidarCampos(monto, tiempo, dtf, ibr, puntosDtf, puntosIbr, opcion);
    if (camposValidos) {
        let fechas = [];
        let fechaActual = fechaDesembolso1;
        let mes_actual = moment(fechaActual);
        mes_actual.add(1, 'month');

        InteresFijo = DividirPor100(InteresFijo);

        let pagoInteres = 0, pagoCapital = 0, cuota = 0;
        let meses = 12;
        let InteresFijo1 = InteresFijo/meses;
     
        if (metodo == ABONO_A_CUOTA) {
            cuota = CalcularPagoCuotaFijo(InteresFijo1, tiempo, opcion, monto);

        } else if (metodo == ABONO_A_CAPITAL) {
            pagoCapital = (monto - opcion) / tiempo;


        }

        for (let i = 1; i <= tiempo; i++) {

            //Formato fechas
            fechas[i] = mes_actual.format('DD-MM-YYYY');
            mes_actual.add(1, 'month');
            if (metodo == ABONO_A_CUOTA) {
                pagoInteres = parseFloat(monto * (InteresFijo1));
                pagoCapital = cuota - pagoInteres;
                monto = parseFloat(monto - pagoCapital);
            } else if (metodo == ABONO_A_CAPITAL) {
                pagoInteres = parseFloat(monto * (InteresFijo1));
                cuota = pagoCapital + pagoInteres;
                monto = parseFloat(monto - pagoCapital);
            }
            PintarFilas(i, fechas[i], cuota, pagoCapital, pagoInteres, monto);
        }
    } else {
        alert("No se pueden realizar calculos");
    }
}
function PintarFilas(indice, fecha, cuota, pagoCapital, pagoInteres, monto) {
    const row = document.createElement('tr');
    row.innerHTML = `
            <td>${indice}</td>
            <td>${fecha}</td>
            <td>${cuota.toFixed(4)}</td>
            <td>${pagoCapital.toFixed(4)}</td>
            <td>${pagoInteres.toFixed(4)}</td>
            <td>${monto.toFixed(4)}</td>
        `;
    CuerpoTabla.appendChild(row)
};

function LimpiarCuerpoTabla() {
    CuerpoTabla.innerHTML = "";
}


    }
}