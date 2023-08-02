<div id="pregunta" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Se requiere confirmación</h4>
            </div>
            <div class="modal-body">
                <p>¿Quiere cambiar el aula <span id="aulaorigen"></span> por el aula <span id="auladestino"></span> en
                    todo el horario de este grupo?&hellip;</p>
            </div>
            <div class="modal-footer">
                <button id="btncambiar" type="button" class="btn btn-primary">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $("#btncambiar").on("click", function(evento) {
        let datos = new Object();
        datos.grupo = $("#field-Codigo").val();
        datos.origen = $("#aulaorigen").html();
        datos.destino = $("#auladestino").html();
        $('#pregunta').modal('hide');
        //mostrarTrabajando("Cambiando Aula");
        $.post("<? echo base_url(); ?>horarios/cambioAula", datos, function(data) {
            if (data == 'ok') {
                // refrescar
                $("#save-and-go-back-button").click();
            } else {

            }

        });
    });
    // valor anterior
    let valorAnt = "";
    $("#Aula_input_box").on('click', function(e) {
        valorAnt = $(this).children("select").val();
    })
    // interceptar que si cambia el aula, preguntar si quiere cambiarlo en todos los registro del horario
    $(document).on('change', 'select[name=Aula]', function(e) {
        $("#aulaorigen").html(valorAnt);
        $("#auladestino").html(this.value);
        $('#pregunta').modal('show');
    })
</script>