"use strict";
let offCanvasEl;
document.addEventListener("DOMContentLoaded", function (e) {
    var t;
    // (t = document.getElementById("form-add-new-record")),
    setTimeout(() => {
        const e = document.querySelector(".create-new");
        t = document.querySelector("#add-new-record");
        e &&
        e.addEventListener("click", function () {
            (offCanvasEl = new bootstrap.Offcanvas(t)),
            offCanvasEl.show();
        });
    }, 200);
});
