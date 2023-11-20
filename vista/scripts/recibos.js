var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardarRecibir(e);
    });

    //Cargamos los items al select Agencia Emisora
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agenciaA").html(r);
        $('#agenciaA').selectpicker('refresh');

    });
    //Cargamos los items al select Agencia Receptora
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agenciaB").html(r);
        $('#agenciaB').selectpicker('refresh');
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
    $("#DNIreceptor").val("");
    $("#monto").val("");
    $("#descripcion").val("");
    $("#codigo").val("");
    $("#cobrar").val("");
    $("#comi_benef").val("");
    $("#comision").val("");
    $("#idbkhis").val("");


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
                text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Buscar codigo</span>',
                className: "create-new btn btn-primary waves-effect waves-light",
            },
        ],
        "ajax": {
            url: '../ajax/ajax_persona.php?op=listarRecibos',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "initComplete": function(settings, json) {
            var aaData = json.aaData;
            var recibosMontosum = 0;
            var recibosCobrarsum = 0;
            for (var i = 0; i < aaData.length; i++) {
                recibosMontosum += parseInt(aaData[i][3].replace(/,/g, ''), 10);
                recibosCobrarsum += parseInt(aaData[i][4].replace(/,/g, ''), 10);
                // console.log("After sum: " + sum);
            }
            $("#recibos-monto").text(recibosMontosum.toLocaleString());
            $("#recibos-cobrar").text(recibosCobrarsum.toLocaleString());
            console.log("Total Sum: " + recibosCobrarsum);
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
        //         [8, "desc"]
        //     ] //Ordenar (columna,orden)
    }).DataTable();
    $("div.head-label").html(
        '<h5 class="card-title mb-0">Retirar efectivo</h5>'
    );
}
//Función para guardar o editar

function guardarRecibir(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ajax_persona.php?op=guardarRecibir",
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

function mostrar(idtransaccion, numero) {
    $.post("../ajax/ajax_persona.php?op=mostrarRecibo", { idtransaccion: idtransaccion }, function(data, status) {
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
        $("#DNIreceptor").val(data.DNIreceptor);
        $("#tipo").val(data.tipo);
        $("#tipo").selectpicker('refresh');
        $("#agenciaA").val(data.agenciaA);
        $("#agenciaA").selectpicker('refresh');
        $("#comi_benef").val(data.comi_benef);
        $("#cobrar").val(data.cobrar);
        $("#monto").val(data.monto);
        $("#comision").val(data.comision);
        $("#descripcion").val(data.descripcion);
        $("#idtransaccion").val(data.idtransaccion);
        $("#idreceptor").val(data.idreceptor);
        $("#idbkhis").val(data.idbkhis);

        if (numero == 0) {
            $("#btnGuardar").prop("disabled", true);
            $("#DNIreceptor").attr('disabled', true);
        } else {
            //btnGuardar
        }



    });
}


// Buscar el codigo de un envio y rellenar el formulario mostrando el boton de Cobrar
function buscarEnvioClas() {
    var codigo = $("#codigo").val();
    $.post("../ajax/ajax_persona.php?op=buscarEnvio", { codigo: codigo }, function(data, status) {

        if (data != "null" & codigo != "" & codigo != " ") {
            data = JSON.parse(data);
            // console.log(data);
            $("#nombreremitente").val(data.nombreremitente);
            $("#nombrereceptor").val(data.nombrereceptor);
            $("#telefonorem").val(data.telefonorem);
            $("#telefonorec").val(data.telefonorec);
            $("#dirremitente").val(data.dirremitente);
            $("#dirreceptor").val(data.dirreceptor);
            $("#DNIremitente").val(data.DNIremitente);
            $("#DNIremitente").attr('readonly', true);
            $("#DNIreceptor").val(data.DNIreceptor);
            $("#tipo").val(data.tipo);
            $("#tipo").selectpicker('refresh');
            $("#agenciaA").val(data.agenciaA);
            $("#agenciaA").selectpicker('refresh');
            //$("#comi_benef").val(data.comi_benef);
            //$("#cobrar").val(data.cobrar);
            //$("#monto").val(data.monto);
            //$("#comision").val(data.comision);
            $("#descripcion").val(data.descripcion);
            $("#idtransaccion").val(data.idtransaccion);
            $("#idreceptor").val(data.idreceptor);
            $("#idbkhis").val(data.idbkhis);
            $("#btnGuardar").prop("disabled", true);

            //$("#DNIremitente").attr('readonly', true)
        } else {
            limpiar();
            bootbox.alert('Codigo inexistente');
            $("#btnGuardar").prop("disabled", true);

        }
    })


}


// Buscar el MONTO A COBRAR y rellenar el formulario: monto, comision, comi_benef, cobrar
function verificarMontoCOBRAR() {
    var codigo = $("#codigo").val();
    var cobrar = $("#cobrar").val();

    $.post("../ajax/ajax_persona.php?op=verificarMontoCOBRAR", { codigo: codigo, cobrar: cobrar }, function(data, status) {

        if (data != "null" & codigo != "" & codigo != " ") {
            data = JSON.parse(data);
            $("#comi_benef").val(data.comi_benef);
            $("#cobrar").val(data.cobrar);
            $("#monto").val(data.monto);
            $("#comision").val(data.comision);
            $("#btnGuardar").prop("disabled", false);


            //$("#DNIremitente").attr('readonly', true)
        } else {
            //limpiar();
            $("#cobrar").val("");
            bootbox.alert('Monto no coincide, quedan 3 intentos posible bloqueo al fallar');
            $("#btnGuardar").prop("disabled", true);

        }
    })


}

// Buscar el codigo SECRETO de un envio y rellenar el formulario mostrando el boton de Cobrar
function verificarCodigoSECRETO() {
    var codigo = $("#codigo").val();
    var secreto = $("#secreto").val();

    $.post("../ajax/ajax_persona.php?op=verificarCodigoSECRETO", { codigo: codigo, secreto: secreto }, function(data, status) {

        if (data != "null" & codigo != "" & codigo != " ") {
            data = JSON.parse(data);
            $("#secretoOK").val(data.secreto);
            $("#btnGuardar").prop("disabled", false);

            //$("#DNIremitente").attr('readonly', true)
        } else {
            //limpiar();
            $("#secreto").val("");
            bootbox.alert('Codigo secreto invalido, quedan 3 intentos posible bloqueo al fallar');

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
	});
}
*/

init();