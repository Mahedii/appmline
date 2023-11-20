var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    // Etiqueta y ejecucion del Formulario comun
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });


    //Cargamos los items al select cliente
    $.post("../ajax/ajax_cliente.php?op=selectClientes", function(r) {
        $("#cliente").html(r);
        $('#cliente').selectpicker('refresh');


    });

    //Cargamos los items al select Agencia 
    $.post("../ajax/ajax_persona.php?op=selectAgencia", function(r) {
        $("#agencialigada").html(r);
        $('#agencialigada').selectpicker('refresh');

    });

    //Cargamos los items al select empleados de clientes
    $.post("../ajax/ajax_cuentas.php?op=selectEmpleado", function(r) {
        $("#gestor").html(r);
        $('#gestor').selectpicker('refresh');

    });

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

    $("#modif").val("");
    $("#numerocuenta").val("");
    $("#saldo").val("");

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
            url: '../ajax/ajax_cuentas.php?op=listar',
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
                sum += parseInt(aaData[i][5].replace(/,/g, ''), 10);
                // console.log("After sum: " + sum);
            }
            $("#saldo").text(sum.toLocaleString());
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
        //         [2, "desc"]
        //     ] //Ordenar (columna,orden)
    }).DataTable();
    $("div.head-label").html(
        '<h5 class="card-title mb-0">Cuentas</h5>'
    );
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../ajax/ajax_cuentas.php?op=guardaryeditar",
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

function mostrar(numerocuenta) {
    var rolConnect = $("#rolConnect").val(); // captamos el rol conectado

    $.post("../ajax/ajax_cuentas.php?op=mostrar", { numerocuenta: numerocuenta }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#modif").val('1');
        $("#cliente").val(data.cliente);
        $("#cliente").attr('disabled', true);
        $("#cliente").selectpicker('refresh');
        $("#tipo_cuenta").val(data.tipo_cuenta);
        $("#tipo_cuenta").attr('disabled', true);
        $("#tipo_cuenta").selectpicker('refresh');
        $("#numerocuenta").val(data.numerocuenta);
        $("#agencialigada").val(data.agencialigada);
        $("#agencialigada").selectpicker('refresh');
        $("#gestor").val(data.gestor);
        $("#gestor").selectpicker('refresh');
        $("#saldo").val(data.saldo);
        $("#cuenta_cerrada").val(data.cuenta_cerrada);
        $("#cuenta_cerrada").selectpicker('refresh');

        if (rolConnect == 'Agencia' || rolConnect == 'CajeroUV') {
            $("#btnGuardar").hide();
        }

    });
}


//Función para eliminar registros
function eliminar(numerocuenta) {
    bootbox.confirm("¿Está Seguro de eliminar la cuenta?", function(result) {
        if (result) {
            $.post("../ajax/ajax_cuentas.php?op=eliminar", { numerocuenta: numerocuenta }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();