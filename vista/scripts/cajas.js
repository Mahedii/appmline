var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    $("#btnDebitar").hide();
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    $("#formularioOperarCaja").on("submit", function(e) {
        debitarCreditarCaja(e);
    });

    $('input[name="rangofechas"]').daterangepicker();

    //Cargamos los items al select cliente
    $.post("../ajax/ajax_cliente.php?op=selectClientes", function(r) {
        $("#cliente").html(r);
        $('#cliente').selectpicker('refresh');
        $("#clienteremitente").html(r);
        $('#clienteremitente').selectpicker('refresh');
        $("#clientebeneficiario").html(r);
        $('#clientebeneficiario').selectpicker('refresh');

    });


    //Cargamos los items al select Agencia 
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agencia").html(r);
        $('#agencia').selectpicker('refresh');
        $("#agenciaremitente").html(r);
        $('#agenciaremitente').selectpicker('refresh');
        $("#agenciabeneficiaria").html(r);
        $('#agenciabeneficiaria').selectpicker('refresh');
        //alert(r);

    });

    //Cargamos los items al select empleados de clientes
    $.post("../ajax/ajax_cuentas.php?op=selectEmpleado", function(r) {
        $("#cajero").html(r);
        $('#cajero').selectpicker('refresh');


    });

}

// Poner agencia del cliente selecionado
function ponerAgenciaCliente() {
    var cliente = $("#cliente").val();
    $.post("../ajax/ajax_cajas.php?op=ponerAgenciaCliente", { cliente: cliente }, function(data, status) {
        data = JSON.parse(data);
        console.log(data);

        if (data) {
            $('#agencia').val(data.agencia_em);
            $('#agencia').selectpicker('refresh');
        }

    });
}


function ponerNCPclienteRemitente() {
    var clienteremitente = $("#clienteremitente").val();
    var tipo = $("#tipo").val();
    $.post("../ajax/ajax_cajas.php?op=ponerNCPclienteRemitente", { clienteremitente: clienteremitente, tipo: tipo }, function(data, status) {
        data = JSON.parse(data);
        $("#ncpremitente").val(data.numerocuenta);
        $("#ncpremitente").attr('readonly', true);
        $("#paisorigen").val(data.pais);
        $("#saldoremitente").val(data.saldo);

    });
}



function ponerNCPclienteBeneficiario() {
    var clientebeneficiario = $("#clientebeneficiario").val();
    var tipo = $("#tipo").val();
    $.post("../ajax/ajax_cajas.php?op=ponerNCPclienteBeneficiario", { clientebeneficiario: clientebeneficiario, tipo: tipo }, function(data, status) {
        data = JSON.parse(data);
        $("#ncpbeneficiaria").val(data.numerocuenta);
        $("#ncpbeneficiaria").attr('readonly', true);
        $("#paisdestino").val(data.pais);

    });
}

//Función para verificar numeros de DNI a que no sean iguales
function verificarNCP() {

    var ncpremitente = $("#ncpremitente").val();
    var ncpbeneficiaria = $("#ncpbeneficiaria").val();
    var saldoremitente = $("#saldoremitente").val();
    var monto = $("#monto").val();

    if (ncpremitente == ncpbeneficiaria) {
        bootbox.alert("El beneficiario no puede ser el remitente");
    }

    if (parseInt(monto) > parseInt(saldoremitente)) {
        bootbox.alert("Saldo insuficiente");
    }

}


// Funcion para poner las cuentas del cajero creado a la hora de asignarle
function ponerNCPCajero() {
    var cajero = $("#cajero").val();
    $.post("../ajax/ajax_cajas.php?op=ponerNCPCajero", { cajero: cajero }, function(data, status) {
        data = JSON.parse(data);
        console.log(data);
        if (data != null) {
            $("#ncpCorriente").val(data.ncpCorriente);
            $("#ncpCorriente").attr('readonly', true);
            $("#ncpComisiones").val(data.ncpComisiones);
            $("#ncpComisiones").attr('readonly', true);

        } else {
            bootbox.alert('No es un cajero o falta de cuentas generadas');
            $("#cajero").val("");
            $('#cajero').selectpicker('refresh');
        }


        // Revisamos que el Gerente no debe ser cajero a la vez
        var cliente = $("#cliente").val();
        var cajero = data.DNI;
        if (cliente == cajero) {
            bootbox.alert('No es un cajero o falta de cuentas generadas');
            $("#cajero").val("");
            $('#cajero').selectpicker('refresh');

        }

    });
}


//Función para Operar en la CAJA
function debitarCreditarCaja(e) {

    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardarOpeCaja").prop("disabled", true);
    var formData = new FormData($("#formularioOperarCaja")[0]);
    //for (var value of formData.values()) { console.log(value); }
    $.ajax({
        url: "../ajax/ajax_cajas.php?op=debitarCreditarCaja",
        type: "POST",
        data: formData,
        //data: "mensaje="+mensaje+"&descripcionsms="+descripcionsms+"&idtransaccion="+idtransaccion,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            $("#MODALOperarCaja").modal('hide');
            //tabla.ajax.reload();
            limpiarOpeCaja();
        }

    });

}

//Función limpiar
function limpiarOpeCaja() {

    $("#idCajaOP").val("");
    $("#ncpremitente").val("");
    $("#saldoremitente").val("");
    $("#ncpbeneficiaria").val("");
    $("#monto").val("");
    $("#descripcion").val("");

}



// Enviar mensaje de solicitud al administrador de modificar envio
function MODALOperarCaja() {
    var idCajaOP = $("#idCaja").val();
    $("#idCajaOP").val(idCajaOP);
    $("#MODALOperarCaja").modal(true);

}

//Función generar CUENTA CLIENTE
function generarCuentaClienteNCP(tipo_cuenta) {

    var cliente = $("#cliente").val();

    switch (tipo_cuenta) {
        case "CUENTA_CORRIENTE":
            ncp = '372' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_AHORRO":
            ncp = '373' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_COMISIONES":
            ncp = '999' + cliente + '02';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_AGENCIA":
            ncp = '371' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_IVA":
            ncp = '155' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_GASTOS":
            ncp = '888' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_CAPITAL":
            ncp = '999' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;
        case "CUENTA_PERDIDAS":
            ncp = '555' + cliente + '01';
            $("#numerocuenta").val(ncp.replace(/[^\w]/gi, ''));
            break;

    }

}



//Función limpiar
function limpiar() {

    $("#idCaja").val("");
    $("#nombre").val("");
    $("#ncpCorriente").val("");
    $("#ncpComisiones").val("");
    $("#montoMaxEnvio").val("");

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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
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
            url: '../ajax/ajax_cajas.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "initComplete": function(settings, json) {
            var aaData = json.aaData;
            var sum = 0;
            // console.log(aaData);
            for (var i = 0; i < aaData.length; i++) {
                sum += parseInt(aaData[i][6].replace(/,/g, ''), 10);
                // console.log("After sum: " + sum);
            }
            $("#saldo-corriente").text(sum.toLocaleString());
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
        //         [1, "asc"]
        //     ] //Ordenar (columna,orden)
    }).DataTable();
    $("div.head-label").html(
        '<h5 class="card-title mb-0">Cajas</h5>'
    );
}


//Función para guardar o editar
function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    //for (var value of formData.values()) { console.log(value); }
    $.ajax({
        url: "../ajax/ajax_cajas.php?op=guardaryeditar",
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

function mostrar(idCaja) {
    var rolConnect = $("#rolConnect").val(); // captamos el rol conectado

    $.post("../ajax/ajax_cajas.php?op=mostrar", { idCaja: idCaja }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#btnDebitar").show();

        $("#idCaja").val(data.idCaja);
        $("#cliente").val(data.cliente);
        $("#cliente").attr('disabled', true);
        $("#cliente").selectpicker('refresh');
        $("#tipo_cuenta").val(data.tipo_cuenta);
        $("#tipo_cuenta").attr('disabled', true);
        $("#tipo_cuenta").selectpicker('refresh');
        $("#numerocuenta").val(data.numerocuenta);
        $("#agencia").val(data.agencia);
        $("#agencia").selectpicker('refresh');
        $("#cajero").val(data.cajero);
        $("#cajero").selectpicker('refresh');
        $("#saldo").val(data.saldo);
        $("#montoMaxEnvio").val(data.montoMaxEnvio);
        $("#nombre").val(data.nombre);
        $("#ncpCorriente").val(data.ncpCorriente);
        $("#ncpComisiones").val(data.ncpComisiones);
        $("#cajacerrada").val(data.cajacerrada);
        $("#cajacerrada").selectpicker('refresh');

        if (rolConnect == 'Agencia' || rolConnect == 'CajeroUV') {
            $("#btnGuardar").hide();
        }

    });
}


//Función para eliminar registros
function eliminar(numerocuenta) {
    bootbox.confirm("¿Está Seguro de eliminar la caja?", function(result) {
        if (result) {
            $.post("../ajax/ajax_cajas.php?op=eliminar", { numerocuenta: numerocuenta }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();