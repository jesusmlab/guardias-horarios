<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <!-- Contenido del panel -->
            <div class="panel-heading">Crear Turnos</div>
            <div class="panel-body">

                <div class="col-xs-10">
                    <div class="control-group">
                        <label for="cmbactividad" class="col-xs-3">Actividad de Guardia:</label>
                        <div class="col-xs-7">
                            <select id="cmbactividad" class="form-control">
                                <?php
                                $cadena = "";
                                foreach ($actividades as $actividad) {
                                    $cadena .= "<option value='" . $actividad['Codigo'] . "'>" . $actividad['Descripcion'] . "</option>";
                                }
                                echo $cadena;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="control-group">
                    <div class="col-xs-2">
                        <button id="btncrearturnos" class="btn btn-primary">Crear</button>
                    </div>
                </div>

            </div>
            <div class="alert alert-danger">
                <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
                <strong>OJO. ESTA OPCION SOLO SE USARÁ A COMIENZO DE CURSO PARA CONFORMAR LOS TURNOS DE
                    GUARDIA</strong>.
            </div>
        </div>
    </div>
</div>
</div>
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
                <p>Lo que se dispone a hacer borrará todos los registros de turnos de guardia y volverá a cargarlos de
                    los horarios
                    de cada profesor. ¿Está seguro de hacer esto?&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Detener</button>
                <button id="btnconfcrear" type="button" class="btn btn-primary">Seguir</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $("#btncrearturnos").on("click", function(evento) {
        $('#pregunta').modal('show');
    });
    $("#btnconfcrear").on("click", function(evento) {
        $codg = $("#cmbactividad").val();
        $('#pregunta').modal('hide');
        mostrarTrabajando("Creando Turnos");
        location.href = "<? echo base_url(); ?>turnos/crear_turnos/" + $codg;
    });
</script>