var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    $("#btnDebitar").hide(); // MANEJAR COMISIONES OCULTO AL INCIAR
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    $("#formularioOperarBanco").on("submit", function(e) {
        CrearSaldoUV(e);
    });


    //Cargamos los items al select pais
    $.post("../ajax/ajax_agencias.php?op=selectPaises", function(r) {
        $("#pais").html(r);
        $('#pais').selectpicker('refresh');

    });

    //Cargamos los items al select empleados de clientes
    $.post("../ajax/ajax_agencias.php?op=selectEmpleado", function(r) {
        $("#responsable").html(r);
        $('#responsable').selectpicker('refresh');

    });

    //Cargamos los items al select cliente
    $.post("../ajax/ajax_cliente.php?op=selectClientes", function(r) {
        $("#nombreBeneficiario").html(r);
        $('#nombreBeneficiario').selectpicker('refresh');

    });




}



// Traer el saldo actual de la cuenta seleccionada del cliente
function traerSaldoActual() {
    let numerocuenta = $("#ncp").val();

    $.post("../ajax/ajax_cuentas.php?op=traerSaldoActual", { numerocuenta: numerocuenta }, function(data, status) {

        data = JSON.parse(data);
        $("#saldoCapital").val(data.saldo);
        $("#nombreBeneficiario").val(data.cliente);
        $('#nombreBeneficiario').selectpicker('refresh');


    })

}





//Función para Operar en la CAJA
function CrearSaldoUV(e) {

    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardarOpeBanco").prop("disabled", true);
    var formData = new FormData($("#formularioOperarBanco")[0]);
    //for (var value of formData.values()) { console.log(value); }
    $.ajax({
        url: "../ajax/ajax_banco.php?op=CrearSaldoUV",
        type: "POST",
        data: formData,
        //data: "mensaje="+mensaje+"&descripcionsms="+descripcionsms+"&idtransaccion="+idtransaccion,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            $("#MODALOperarBanco").modal('hide');
            tabla.ajax.reload();
            limpiarOpeBanco();
        }

    });

}

//Función limpiar
function limpiarOpeBanco() {

    $("#idBancoOP").val("");
    $("#monto").val("");
    $("#descripcion").val("");
    $("#banco").val("");
    $("#nombreBeneficiario").val("");
    $("#ncpCREDITAR").val("");
}

/* 
function TestNom() {
    alert($("#nombreBeneficiario").val());
} */

// Enviar mensaje de solicitud al administrador de modificar envio
function MODALOperarBanco() {
    var idbancoOP = $("#idbanco").val();
    var nombreOP = $("#nombre").val();
    var ncpOP = $("#ncp").val();
    $("#idbancoOP").val(idbancoOP);
    $("#banco").val(nombreOP);
    $("#ncpCREDITAR").val(ncpOP);
    $("#nombreBeneficiario").attr('readonly', true);
    $("#MODALOperarBanco").modal(true);

}





//Función generar CUENTA AGENCIA
function generarNCPCreaBanco(responsable) {
    $.post("../ajax/ajax_banco.php?op=generarNCPCreaBanco", { responsable: responsable }, function(data, status) {
        data = JSON.parse(data);

        const ncpCAPITAL = '999' + data.DNI + '01';
        const ncpCOMISIONES = '999' + data.DNI + '02';
        const ncpIVA = '999' + data.DNI + '03';

        $("#ncp").val(ncpCAPITAL);
        $("#ncpComisiones").val(ncpCOMISIONES);
        $("#ncpIVA").val(ncpIVA);



    });

}

//Función limpiar
function limpiar() {

    $("#idbanco").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#max_agencias").val("");
    $("#ncp").val("");
    $("#ncpComisiones").val("");
    $("#ncpIVA").val("");

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
        $("#btnDebitar").hide();
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
            {
                targets: 5,
                className: "saldo-cuenta-capital"
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
            // {
            //     text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Agregar</span>',
            //     className: "create-new btn btn-primary waves-effect waves-light",
            // },
        ],
        "ajax": {
            url: '../ajax/ajax_banco.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "initComplete": function(settings, json) {
            var aaData = json.aaData;
            var sum = 0;
            for (var i = 0; i < aaData.length; i++) {
                sum += parseInt(aaData[i][5].replace(/,/g, ''), 10);
                // console.log("After sum: " + sum);
            }
            $("#saldo-cuenta-capital").text(sum.toLocaleString());
            console.log("Total Sum: " + sum);
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
        //         [1, "desc"]
        //     ] //Ordenar (columna,orden)
    }).DataTable();
    $("div.head-label").html(
        '<h5 class="card-title mb-0"><i class="fa fa-bank"> </i> Banco</h5>'
    );
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ajax_banco.php?op=guardaryeditar",
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




function mostrar(idbanco) {
    var rolConnect = $("#rolConnect").val(); // captamos el rol conectado ESTA EN EL HEadeR

    $.post("../ajax/ajax_banco.php?op=mostrar", { idbanco: idbanco }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#btnDebitar").show();

        $("#idbanco").val(data.idbanco);
        $("#pais").val(data.idbanco);
        $("#pais").selectpicker('refresh');
        $("#ncp").val(data.ncp);
        $("#ncpComisiones").val(data.ncpComisiones);
        $("#ncpIVA").val(data.ncpIVA);
        $("#responsable").val(data.responsable);
        $("#responsable").selectpicker('refresh');
        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);
        $("#max_agencias").val(data.max_agencias);

        // Aqui mandamos el saldo actaul al campo del modal


        if (rolConnect == 'Agencia' || rolConnect == 'CajeroUV') {
            $("#btnGuardar").hide();

        }

    });
}


//Función para eliminar registros
function eliminar(idbanco) {
    bootbox.confirm("¿Está Seguro de eliminar la banco?", function(result) {
        if (result) {
            $.post("../ajax/ajax_banco.php?op=eliminar", { idbanco: idbanco }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();