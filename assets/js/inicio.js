$(inicio);

function inicio() {
    $("#cmbprofesor").on("change", function (evento) {
        location.href = "horarios_c/mostrar/" + this.value;
    })
}