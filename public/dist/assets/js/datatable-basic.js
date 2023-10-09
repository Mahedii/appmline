"use strict";
let fv, offCanvasEl;

$(function () {
var l,
    t,
    e = $(".datatables-basic"),
    r =
    (e.length &&
        ((l = e.DataTable({
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
        order: [[2, "desc"]],
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
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
                    columns: [3, 4, 5, 6, 7],
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
                    columns: [3, 4, 5, 6, 7],
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
                    columns: [3, 4, 5, 6, 7],
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
                    columns: [3, 4, 5, 6, 7],
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
            text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New Record</span>',
            className: "create-new btn btn-primary",
            },
        ],
        responsive: {
            details: {
            display: $.fn.dataTable.Responsive.display.modal({
                header: function (e) {
                return "Details of " + e.data().full_name;
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
        })),
        $("div.head-label").html(
        '<h5 class="card-title mb-0">DataTable with Buttons</h5>'
        )),
    101);
    setTimeout(() => {
    $(".dataTables_filter .form-control").removeClass("form-control-sm"),
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
});
