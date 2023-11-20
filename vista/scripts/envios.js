var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });


    //Cargamos los items al select pais
    $.post("../ajax/ajax_tasas.php?op=selectPaises", function(r) {
        $("#pais_destino").html(r);
        $('#pais_destino').selectpicker('refresh');
        //alert(r);

    });


}

//Función limpiar
function limpiar() {

    $("#idtransaccion").val("");
    $("#idreceptor").val("");
    $("#nombreremitente").val("");
    $("#nombrereceptor").val("");
    $("#telefonorem").val("");
    $("#telefonorec").val("");
    $("#dirremitente").val("");
    $("#dirreceptor").val("");
    $("#DNIremitente").val("");
    $("#DNIremitente").attr('readonly', true);
    $("#monto").val("");
    $("#comision").val("");
    $("#descripcion").val("");
    $("#existeR").val("");
    $("#existeC").val("");
    $("#codigo").val("");
    $("#secreto").val("");
    $("#comi_remi").val("");
    $("#aCobrar").val("");
    $("#monto").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        // $("#listadoregistros").hide();
        // $("#formularioregistros").show();
        var t = document.querySelector("#add-new-record");
        (offCanvasEl = new bootstrap.Offcanvas(t)),
        offCanvasEl.show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#DNIremitente").attr('readonly', false);
        $("#monto").attr('readonly', false);
    } else {
        // $("#listadoregistros").show();
        // $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

//Función Listar, se llama arriba de este mismo archivo en la funcion init
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor 
        columnDefs: [
            {
                className: "control",
                orderable: !1,
                searchable: !1,
                responsivePriority: 2,
                targets: 0,
                render: function (e, t, a, s) {
                    return "";
                },
            },
        ],
        dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 5,
        lengthMenu: [5, 10, 25, 50, 75, 100],
        buttons: [
            {
                extend: "collection",
                className: "btn btn-label-primary dropdown-toggle me-2",
                text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                buttons: [
                    {
                    extend: "print",
                    text: '<i class="ti ti-printer me-1" ></i>Print',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                        format: {
                        body: function (e, t, a) {
                            var s;
                            return e.length <= 0
                            ? e
                            : ((e = $.parseHTML(e)),
                                (s = ""),
                                $.each(e, function (e, t) {
                                void 0 !== t.classList &&
                                t.classList.contains("user-name")
                                    ? (s += t.lastChild.firstChild.textContent)
                                    : void 0 === t.innerText
                                    ? (s += t.textContent)
                                    : (s += t.innerText);
                                }),
                                s);
                        },
                        },
                    },
                    customize: function (e) {
                        $(e.document.body)
                        .css("color", config.colors.headingColor)
                        .css("border-color", config.colors.borderColor)
                        .css("background-color", config.colors.bodyBg),
                        $(e.document.body)
                            .find("table")
                            .addClass("compact")
                            .css("color", "inherit")
                            .css("border-color", "inherit")
                            .css("background-color", "inherit");
                    },
                    },
                    {
                    extend: "csv",
                    text: '<i class="ti ti-file-text me-1" ></i>Csv',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                        format: {
                        body: function (e, t, a) {
                            var s;
                            return e.length <= 0
                            ? e
                            : ((e = $.parseHTML(e)),
                                (s = ""),
                                $.each(e, function (e, t) {
                                void 0 !== t.classList &&
                                t.classList.contains("user-name")
                                    ? (s += t.lastChild.firstChild.textContent)
                                    : void 0 === t.innerText
                                    ? (s += t.textContent)
                                    : (s += t.innerText);
                                }),
                                s);
                        },
                        },
                    },
                    },
                    {
                    extend: "excel",
                    text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                        format: {
                        body: function (e, t, a) {
                            var s;
                            return e.length <= 0
                            ? e
                            : ((e = $.parseHTML(e)),
                                (s = ""),
                                $.each(e, function (e, t) {
                                void 0 !== t.classList &&
                                t.classList.contains("user-name")
                                    ? (s += t.lastChild.firstChild.textContent)
                                    : void 0 === t.innerText
                                    ? (s += t.textContent)
                                    : (s += t.innerText);
                                }),
                                s);
                        },
                        },
                    },
                    },
                    {
                    extend: "pdf",
                    text: '<i class="ti ti-file-description me-1"></i>Pdf',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                        format: {
                        body: function (e, t, a) {
                            var s;
                            return e.length <= 0
                            ? e
                            : ((e = $.parseHTML(e)),
                                (s = ""),
                                $.each(e, function (e, t) {
                                void 0 !== t.classList &&
                                t.classList.contains("user-name")
                                    ? (s += t.lastChild.firstChild.textContent)
                                    : void 0 === t.innerText
                                    ? (s += t.textContent)
                                    : (s += t.innerText);
                                }),
                                s);
                        },
                        },
                    },
                    },
                    {
                    extend: "copy",
                    text: '<i class="ti ti-copy me-1" ></i>Copy',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                        format: {
                        body: function (e, t, a) {
                            var s;
                            return e.length <= 0
                            ? e
                            : ((e = $.parseHTML(e)),
                                (s = ""),
                                $.each(e, function (e, t) {
                                void 0 !== t.classList &&
                                t.classList.contains("user-name")
                                    ? (s += t.lastChild.firstChild.textContent)
                                    : void 0 === t.innerText
                                    ? (s += t.textContent)
                                    : (s += t.innerText);
                                }),
                                s);
                        },
                        },
                    },
                    },
                ],
            },
            {
                text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Agregar</span>',
                className: "create-new btn btn-primary waves-effect waves-light",
            },
        ],
        "ajax": {
            url: '../ajax/ajax_persona.php?op=listarEnvios',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "initComplete": function(settings, json) {
            var aaData = json.aaData;
            var enviosMontosum = 0;
            var enviosCobrarsum = 0;
            var enviosComisionsum = 0;
            for (var i = 0; i < aaData.length; i++) {
                enviosMontosum += parseInt(aaData[i][3].replace(/,/g, ''), 10);
                enviosCobrarsum += parseInt(aaData[i][4].replace(/,/g, ''), 10);
                enviosComisionsum += parseInt(aaData[i][5].replace(/,/g, ''), 10);
                // console.log("After sum: " + sum);
            }
            $("#envios-monto").text(enviosMontosum.toLocaleString());
            $("#envios-cobrar").text(enviosCobrarsum.toLocaleString());
            $("#envios-comision").text(enviosComisionsum.toLocaleString());
            console.log("Total Sum: " + enviosComisionsum);
        },
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (e) {
                    return "Enviar efectivo";
                    // return "Details of " + e.data().full_name;
                    },
                }),
                type: "column",
                renderer: function (e, t, a) {
                    a = $.map(a, function (e, t) {
                    return "" !== e.title
                        ? '<tr data-dt-row="' +
                            e.rowIndex +
                            '" data-dt-column="' +
                            e.columnIndex +
                            '"><td>' +
                            e.title +
                            ":</td> <td>" +
                            e.data +
                            "</td></tr>"
                        : "";
                    }).join("");
                    return !!a && $('<table class="table"/><tbody />').append(a);
                },
            },
        },
        // "bDestroy": true,
        // "iDisplayLength": 10, //Paginación
        // "order": [
        //         [9, "desc"]
        //     ] //Ordenar (columna,orden)
    }).DataTable();
    $("div.head-label").html(
        '<h5 class="card-title mb-0">Enviar efectivo</h5>'
    );
}


//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ajax_persona.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}


/*/////////////////// INSERCION COPIA SOLO ENVIO /////////////////////////
function insertarCopia() 
{ 
	//alert("Hola");
   $("#btnGuardarcopiaE").prop("disabled",true);
   var formData = new FormData($("#formulario")[0]);

	var igual = $("#idreceptor").val();
	var igual = $("#nombreremitente").val();
	var igual = $("#nombrereceptor").val();
	var igual = $("#telefonorem").val();
	var igual = $("#telefonorec").val();
	var igual = $("#dirremitente").val();
	var igual = $("#dirreceptor").val();
	var igual = $("#DNIremitente").val();
	var igual = $("#DNIreceptor").val();
	var igual = $("#monto").val();
	var igual = $("#comision").val();
	var igual = $("#descripcion").val();
	var agenciaA = $("select#agenciaA").val();
	var agenciaB = $("select#agenciaB").val();

     $.ajax({ 
        type: "POST", 
        dataType: 'html', 
       url: "../ajax/ajax_persona.php?op=guardarcopia",
       data:formData,
       contentType: false,
	   processData: false,
       //data: "cuenta="+plaCuent+"&FD="+plaFD+"&analista="+plaAnalis+"&FIni="+plaFIni+"&FVA="+plaFVA+"&FVRes="+plaFVRes+"&FCDCC="+plaFCDCC+"&NumDCC="+plaNumDCC+"&FNotif="+plaFNotif+"&FEchea="+plaFEchea+"&ValFin="+plaValFin+"&operador="+plaOperador+"&comenta="+plaComentario,
        success: function(resp){
	          bootbox.alert(resp);	          
	          mostrarform(false);
	          tabla.ajax.reload();
        } 
    }); 
  limpiar();
}
*/


function mostrar(idtransaccion) {
    $.post("../ajax/ajax_persona.php?op=mostrar", { idtransaccion: idtransaccion }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombreremitente").val(data.nombreremitente);
        $("#nombrereceptor").val(data.nombrereceptor);
        $("#telefonorem").val(data.telefonorem);
        $("#telefonorec").val(data.telefonorec);
        $("#dirremitente").val(data.dirremitente);
        $("#dirreceptor").val(data.dirreceptor);
        $("#DNIremitente").val(data.DNIremitente);
        $("#DNIremitente").attr('readonly', true);
        $("#tipo").val(data.tipo);
        $("#tipo").selectpicker('refresh');
        $("#monto").val(data.monto);
        $("#monto").attr('readonly', true);
        $("#comision").val(data.comision);
        $("#aCobrar").val(data.cobrar);
        $("#comi_remi").val(data.comi_remi);
        $("#descripcion").val(data.descripcion);
        $("#idtransaccion").val(data.idtransaccion);
        $("#idreceptor").val(data.idreceptor);
        $("#referenciaAc").val(data.referencia);
        $("#codigoAc").val(data.codigo);
        $("#secreto").val(data.secreto);
        $("#nombreRSINO").html(''); // En el buscador de nombres
        $("#nombreSINO").html(''); // En el buscador
        $("#btnGuardar").innerText = 'Solicitar modificacion';


        if (data.estadot == "Recibido" || data.estadot == "Cancelado" || data.estadot == "Revalidar") {
            $("#btnGuardar").innerText = 'Solicitud enviada';
            $("#btnGuardar").prop("disabled", true);
        } else {
            $("#btnGuardar").prop("disabled", false);
        }
    })
}

// Ponerle la comision recibida en el input directamente en tiempo real
function comisiones() {
    pais_destino = $("#pais_destino").val();
    monto = $("#monto").val();
    $.post("../ajax/ajax_persona.php?op=ponerComisiones", { monto: monto, pais_destino: pais_destino }, function(data, status) {
        data = JSON.parse(data);
        $("#comision").val(data.comisiont);
        IVA = (data.comisiont * data.IVA) / 100;
        restoLibre = (data.comisiont - IVA);
        comisionCajaEnvio = (restoLibre * data.porcenENVIO) / 100;
        $("#comi_remi").val(comisionCajaEnvio);
        $("#aCobrar").val(monto - data.comisiont);
        $("#IVA").val(IVA);


    })


}

// Traer el saldo actual de la cuenta del ususraio a  realizar el envio
function traerSaldoActual(ap) {

    $.post("../ajax/ajax_persona.php?op=traerSaldoActual", { ap: ap }, function(data, status) {

        if (data != "null" & DNIremitente != "" & DNIremitente != " ") {
            data = JSON.parse(data);
            var saldoRestante = $("#saldo").val(data.saldo);
        }
    })

}

// Verificar saldo
function verficarSaldo(monto) {
    var saldoRestante = $("#saldo").val();

    if (monto > saldoRestante) {
        bootbox.alert('No puede enviar un monto superior al saldo');
        $("#monto").val("");
    }

}



// Ponerle la comision recibida en el input directamente en tiempo real // nomcompleto,tel,direccion,DNIremitente
function buscarRemitenteRellenarNuevo(DNIremitente) {

    $.post("../ajax/ajax_persona.php?op=buscarRemitenteRellenarNuevo", { DNIremitente: DNIremitente }, function(data, status) {

        if (data != "null" & DNIremitente != "" & DNIremitente != " ") {
            data = JSON.parse(data);
            $("#telefonorem").val(data.tel);
            $("#dirremitente").val(data.direccion);
            $("#DNIremitente").val(data.DNIremitente);
            //$("#DNIremitente").attr('readonly', true);
            $("#nombreSINO").html(data.nomcompleto);
            $("#nombreremitente").val(data.nomcompleto);
            $("#existeR").val("1");
        } else {
            data = JSON.parse(data);
            $("#telefonorem").val("");
            $("#dirremitente").val("");
            $("#DNIremitente").attr('readonly', false);
            $("#nombreremitente").val("");
            $("#nombreSINO").html('<i class="label label-danger">No existe</i>');
            $("#existeR").val("");

        }
    })


}

// Poner datos receptor directamente en tiempo real // nomcompler,tel,direccion,DNIremitente
function buscarReceptorRellenarNuevo(telr) {

    $.post("../ajax/ajax_persona.php?op=buscarReceptorRellenarNuevo", { telr: telr }, function(data, status) {

        if (data != "null" & telr != "" & telr != " ") {
            data = JSON.parse(data);
            $("#telefonorec").val(data.telr);
            $("#idreceptor").val(data.idreceptor);
            $("#dirreceptor").val(data.direccionr);
            $("#nombrereceptor").val(data.nomcompler);
            $("#nombreRSINO").html(data.nomcompler);
            $("#existeC").val("1");
        } else {
            data = JSON.parse(data);
            $("#nombrereceptor").val("");
            $("#dirreceptor").val("");
            $("#nombreRSINO").html('<i class="label label-danger">No existe</i>');
            $("#existeC").val("");

        }
    })


}


//Función para eliminar registros
/*function eliminar(idtransaccion)
{
	bootbox.confirm("¿Está Seguro de eliminar o cancelar el envio?", function(result){
		if(result)
        {
        	$.post("../ajax/ajax_persona.php?op=eliminar", {idtransaccion : idtransaccion}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}*/

//Función limpiar sms modal
function limpiarsms() {

    $("#mensaje").val("");
    $("#descripcionsms").val("");
    $("#idsolicitud").val("");
    $("#monantes").val("");
    $("#idtransaccionsms").val("");
}


//Función para verificar numeros de DNI a que no sean iguales
function verificarDNI() {

    var DNIreceptor = $("#DNIreceptor").val();
    var DNIremitente = $("#DNIremitente").val();

    if (DNIremitente == DNIreceptor) {
        bootbox.alert("El DNI del remitente no puede ser igual al del receptor");
        $("#DNIreceptor").val("");
    }

}

//Función para guardar o editar
/*function smsSolicitudValidacion()
{

	var formData = new FormData($("#formulariosms")[0]);
	$.ajax({
		url: "../ajax/ajax_persona.php?op=smsSolicitudValidar",
	    type: "POST",
	    data:formData,
	    //data: "mensaje="+mensaje+"&descripcionsms="+descripcionsms+"&idtransaccion="+idtransaccion,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);
	          limpiarsms();
	          $("#myModal").modal('hide');
	          tabla.ajax.reload();
	    }

	});

}*/


// Enviar mensaje de solicitud al administrador de modificar envio
/*function enviarsms(idtransaccion,monantes) {
		$("#idtransaccionsms").val(idtransaccion);
		$("#monantes").val(monantes);
		//$("#myModal").modal(true);

}*/

init();