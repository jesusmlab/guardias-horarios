<style>
    .mi_checkbox {
        width: 2vw;
        height: 2vh;
    }

    .form-group {
        margin-bottom: 8px !important;
    }

    hr {
        margin-top: 10px !important;
        margin-bottom: 10px !important;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <!-- Contenido del panel -->
            <div class="panel-heading">Faltas </div>
            <div class="panel-body">
                <div class="col-xs-12">
                    <form id="frmfaltas" class="form-horizontal" action="<? echo base_url(); ?>faltas/insertar" method="post">
                        <div class="form-group">
                            <label for="fecha" class="col-xs-2">Fecha:</label>
                            <div class="col-xs-3">
                                <input type="date" autofocus class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cmbprofesor" class="col-xs-2">Profesor:</label>
                            <div class="col-xs-6">
                                <select id="cmbprofesor" data-live-search="true" class="form-control selectpicker" name="profesor">
                                    <?php

                                    $cadena = "";
                                    foreach ($profesores as $profe) {
                                        if (empty($profe['Sustituto'])) {
                                            $cadena .= "<option value='" . $profe['Codigo'] . "'>" . $profe['Apellido1'] . " " . $profe['Apellido2'] . "," . $profe['Nombre'] . "</option>";
                                        } else {
                                            $cadena .= "<option value='" . $profe['Codigo'] . "'>" . $profe['Sustituto'] . "</option>";
                                        }
                                    }
                                    echo $cadena;
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-1">
                                <button type="button" id="btnVerHorario" class="btn btn-primary">
                                    Ver Horario
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-2 text-left">Horas: (se pueden poner anotaciones una vez activada la
                                casilla)</label>
                            <div class="col-xs-10">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="input-group-text">1 </span>
                                                <input type="checkbox" id="tramo1" name="tramos[]" value="1" aria-label="">
                                            </span>
                                            <input disabled type="text" class="form-control" id="anotacion1" name="anotacion1" maxlength="25" aria-label="..." placeholder="Anotación">
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="input-group-text">2 </span>
                                                <input type="checkbox" id="tramo2" name="tramos[]" value="2" aria-label="...">
                                            </span>
                                            <input disabled type="text" class="form-control" id="anotacion2" name="anotacion2" maxlength="25" aria-label="..." placeholder="Anotación">
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="input-group-text">3 </span>
                                                <input type="checkbox" id="tramo3" name="tramos[]" value="3" aria-label="...">
                                            </span>
                                            <input disabled type="text" class="form-control" id="anotacion3" name="anotacion3" maxlength="25" aria-label="..." placeholder="Anotación">
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="input-group-text">4 </span>
                                                <input type="checkbox" id="tramo4" name="tramos[]" value="4" aria-label="...">
                                            </span>
                                            <input disabled type="text" class="form-control" id="anotacion4" name="anotacion4" maxlength="25" aria-label="..." placeholder="Anotación">
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="input-group-text">5 </span>
                                                <input type="checkbox" id="tramo5" name="tramos[]" value="5" aria-label="...">
                                            </span>
                                            <input disabled type="text" class="form-control" id="anotacion5" name="anotacion5" maxlength="25" aria-label="..." placeholder="Anotación">
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="input-group-text">6 </span>
                                                <input type="checkbox" id="tramo6" name="tramos[]" value="6" aria-label="...">
                                            </span>
                                            <input disabled type="text" class="form-control" id="anotacion6" name="anotacion6" maxlength="25" aria-label="..." placeholder="Anotación">
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="input-group-text">7 </span>
                                                <input type="checkbox" id="tramo7" name="tramos[]" value="7" aria-label="...">
                                            </span>
                                            <input disabled type="text" class="form-control" id="anotacion7" name="anotacion7" maxlength="25" aria-label="..." placeholder="Anotación">
                                        </div>
                                    </div>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="tramo0" value="todas">
                                        <strong>Todas</strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="guardiaSN" value="0">
                        <div class="form-group">
                            <label for="guardiaSN" class="col-xs-2">Guardia(S/N)</label>
                            <div class="col-xs-10">
                                <input type="checkbox" id="guardiaSN" name="guardiaSN" value="1" aria-label="...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cmbcausa" class="col-xs-2">Causa:</label>
                            <div class="col-xs-6">
                                <select id="cmbcausa" class="form-control" name="causa">
                                    <?php
                                    $cadena = "";
                                    foreach ($causas as $causa) {
                                        $cadena .= "<option value='" . $causa['codigo'] . "'>" . $causa['descripcion'] . "</option>";
                                    }
                                    echo $cadena;
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary">Insertar</button>
                            </div>
                        </div>
                    </form>
                    <hr style="background-color:black;">
                    <form id="frmfiltro" name="frmfiltro" class="form-horizontal" action="<? echo base_url(); ?>faltas/index" method="get">
                        <div class="form-group">
                            <label for="cmbfiltro" class="col-xs-2">Filtrar por:</label>
                            <div class="col-xs-3">

                                <select id="cmbfiltro" data-live-search="true" class="form-control selectpicker" name="cmbfiltro">
                                    <?php
                                    $cadena = "<option value=''>Todos</option>";
                                    foreach ($profesores as $profe) {

                                        if (isset($_SESSION['cmbfiltro'])) {
                                            if ($profe['Codigo'] == $_SESSION['cmbfiltro']) {
                                                $sel = "selected";
                                            } else {
                                                $sel = "";
                                            }
                                        }
                                        if (empty($profe['Sustituto'])) {
                                            $cadena .= "<option $sel value='" . $profe['Codigo'] . "'>" . $profe['Apellido1'] . " " . $profe['Apellido2'] . "," . $profe['Nombre'] . "</option>";
                                        } else {
                                            $cadena .= "<option $sel value='" . $profe['Codigo'] . "'>" . $profe['Sustituto'] . "</option>";
                                        }
                                    }
                                    echo $cadena;
                                    ?>
                                </select>
                            </div>

                            <label for="cmbcausaex" class="col-xs-2">Ocultar:</label>
                            <div class="col-xs-3">
                                <select id="cmbcausaex" class="form-control" name="cmbcausaex">
                                    <?php
                                    $cadena = "<option value=''>Ninguna</option>";
                                    foreach ($causas as $causa) {
                                        if (isset($_SESSION['cmbcausaex'])) {
                                            if ($causa['codigo'] == $_SESSION['cmbcausaex']) {
                                                $sel = "selected";
                                            } else {
                                                $sel = "";
                                            }
                                        }
                                        $cadena .= "<option $sel value='" . $causa['codigo'] . "'>" . $causa['descripcion'] . "</option>";
                                    }
                                    echo $cadena;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered table-hover table-responsive table-condensed">
                <thead>
                    <tr>
                        <th class="cabecera-tabla">Fecha</th>
                        <th class="cabecera-tabla">Profesor</th>
                        <th class="cabecera-tabla">Horas</th>
                        <th class="cabecera-tabla">Causa</th>
                        <th class="cabecera-tabla">Comando</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    if ($faltas) {
                        $tabla = "";
                        foreach ($faltas as $item_falta) {
                            $date = new DateTime($item_falta['fecha']);
                            $tabla .= "<tr>";
                            $tabla .= "<td>" . $date->format('d-m-Y') . "</td>";
                            $indice = array_search($item_falta['profesor'], array_column($profesores, 'Codigo'));
                            if (empty($profesores[$indice]['Sustituto'])) {
                                $tabla .= "<td>" . $profesores[$indice]['Apellido1'] . " " . $profesores[$indice]['Apellido2'] . "," . $profesores[$indice]['Nombre'] . "</td>";
                            } else {
                                $tabla .= "<td>" . $profesores[$indice]['Sustituto'] . "</td>";
                            }
                            $tabla .= "<td>" . $item_falta['tramos'] . "</td>";
                            $indice = array_search($item_falta['causa'], array_column($causas, 'codigo'));
                            $tabla .= "<td>" . $causas[$indice]['descripcion'] . "</td>";
                            $tabla .= "<td style='text-align:center' width='15%'><button data-fecha='" . $item_falta['fecha'] . "' data-id='" . $item_falta['id'] . "' data-guardiaSN='" . $item_falta['guardiaSN'] . "' data-profesor='" . $item_falta['profesor'] . "' data-tramos='" . $item_falta['tramos'] . "' data-causa='" . $item_falta['causa'] . "' data-anotacion1='" . $item_falta['anotacion1'] . "' data-anotacion2='" . $item_falta['anotacion2'] . "' data-anotacion3='" . $item_falta['anotacion3'] . "' data-anotacion4='" . $item_falta['anotacion4'] . "' data-anotacion5='" . $item_falta['anotacion5'] . "' data-anotacion6='" . $item_falta['anotacion6'] . "' data-anotacion7='" . $item_falta['anotacion7'] . "' class='btn btn-default btn-xs btneditar' role='button'>Editar</button> | <a class='btn btn-danger btn-xs btnBorrar' href='" . base_url() . "faltas/borrar/" . $item_falta['id'] . "' role='button'>Borrar</a></td>";
                            $tabla .= "</tr>";
                        }
                        echo $tabla;
                    }
                    ?>
                </tbody>
            </table>
            <div class="col-xs-offset-3 col-xs-6 col-xs-offset-3">
                <ul class="pagination">
                    <?php
                    /* Se imprimen los números de página */
                    echo $this->pagination->create_links();
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="VerHorario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Horario</h4>
            </div>
            <div class="modal-body">
                Aqui saldrá el horario del profesor
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Editar Falta
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form name="frmeditar" class="form-horizontal" action="<? echo base_url(); ?>faltas/editar" method="post">
                    <div class="form-group">
                        <label for="fecha" class="col-xs-2">Fecha:</label>
                        <div class="col-xs-4">
                            <input type="date" class="form-control" id="fecha" name="fecha" value="" placeholder="Fecha">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cmbprofesor" class="col-xs-2">Profesor:</label>
                        <div class="col-xs-6">
                            <select id="cmbprofesor" class="form-control" name="profesor">
                                <?php

                                $cadena = "";
                                foreach ($profesores as $profe) {
                                    if (empty($profe['Sustituto'])) {
                                        $cadena .= "<option value='" . $profe['Codigo'] . "'>" . $profe['Apellido1'] . " " . $profe['Apellido2'] . "," . $profe['Nombre'] . "</option>";
                                    } else {
                                        $cadena .= "<option value='" . $profe['Codigo'] . "'>" . $profe['Sustituto'] . "</option>";
                                    }
                                }
                                echo $cadena;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 text-left">Horas:</label>
                        <div class="col-xs-10">
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="input-group-text">1 </span>
                                            <input type="checkbox" id="mtramo1" name="tramos[]" value="1" aria-label="">
                                        </span>
                                        <input disabled type="text" class="form-control" id="manotacion1" name="anotacion1" maxlength="25" aria-label="...">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="input-group-text">2 </span>
                                            <input type="checkbox" id="mtramo2" name="tramos[]" value="2" aria-label="...">
                                        </span>
                                        <input disabled type="text" class="form-control" id="manotacion2" name="anotacion2" maxlength="25" aria-label="...">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="input-group-text">3 </span>
                                            <input type="checkbox" id="mtramo3" name="tramos[]" value="3" aria-label="...">
                                        </span>
                                        <input disabled type="text" class="form-control" id="manotacion3" name="anotacion3" maxlength="25" aria-label="...">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="input-group-text">4 </span>
                                            <input type="checkbox" id="mtramo4" name="tramos[]" value="4" aria-label="...">
                                        </span>
                                        <input disabled type="text" class="form-control" id="manotacion4" name="anotacion4" maxlength="25" aria-label="...">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="input-group-text">5 </span>
                                            <input type="checkbox" id="mtramo5" name="tramos[]" value="5" aria-label="...">
                                        </span>
                                        <input disabled type="text" class="form-control" id="manotacion5" name="anotacion5" maxlength="25" aria-label="...">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="input-group-text">6 </span>
                                            <input type="checkbox" id="mtramo6" name="tramos[]" value="6" aria-label="...">
                                        </span>
                                        <input disabled type="text" class="form-control" id="manotacion6" name="anotacion6" maxlength="25" aria-label="...">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="input-group-text">7 </span>
                                            <input type="checkbox" id="mtramo7" name="tramos[]" value="7" aria-label="...">
                                        </span>
                                        <input disabled type="text" class="form-control" id="manotacion7" name="anotacion7" maxlength="25" aria-label="...">
                                    </div>
                                </div>
                                <input name="id" type="hidden">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="tramo0" value="todas">
                                    <strong>Todas</strong>
                                </label>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" name="guardiaSN" value="0">
                    <div class="form-group">
                        <label for="guardiaSN" class="col-xs-2">Guardia(S/N)</label>
                        <div class="col-xs-10">
                            <input type="checkbox" id="mguardiaSN" name="guardiaSN" value="1" aria-label="...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cmbcausa" class="col-xs-2">Causa:</label>
                        <div class="col-xs-6">
                            <select id="cmbcausa" class="form-control" name="causa">
                                <?php
                                $cadena = "";
                                foreach ($causas as $causa) {
                                    $cadena .= "<option value='" . $causa['codigo'] . "'>" . $causa['descripcion'] . "</option>";
                                }
                                echo $cadena;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <!-- <button type="button" class="btn btn-primary">
                    Save changes
                </button> -->
            </div>
        </div>
    </div>
</div>
<script>
    $(".btnBorrar").on("click", function(evento) {
        evento.preventDefault();
        let that = this;
        swal
            .fire({
                title: "¿Está seguro de borrar el registro?",
                text: "¡Si no lo está puede cancelar la acción!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Si, borrar!",
            })
            .then(function(result) {
                if (result.value) {
                    location.assign(that.href);
                }
            });
    })
    $("#cmbfiltro").on("change", function(evento) {
        document.frmfiltro.submit();
    })
    $("#cmbcausaex").on("change", function(evento) {
        document.frmfiltro.submit();
    })
    $("#tramo0").on("click", function(evento) {
        if ($(this).is(':checked')) {
            $("#frmfaltas input[type=checkbox]").prop('checked', true);
            $("#frmfaltas input[type=text][name^='anotacion']").prop('disabled', false);

        } else {
            $("#frmfaltas input[type=checkbox]").prop('checked', false);
            $("#frmfaltas input[type=text][name^='anotacion']").prop('disabled', true);
        }
    })
    $("#frmfaltas").on("submit", function(evento) {
        evento.preventDefault();
        let chequeados = $("#frmfaltas input[type=checkbox]:checked");
        if (chequeados.length == 0) {
            alert("Tiene que seleccionar algun tramo horario");
        } else {
            this.submit();
        }

    });
    for (let i = 1; i <= 7; i++) {
        $("#tramo" + i).on("click", function(evento) {
            if ($(this).is(':checked')) {
                $("#anotacion" + i).prop('disabled', false);
            } else {
                $("#anotacion" + i).prop('disabled', true);
            }
        });
    }

    for (let i = 1; i <= 7; i++) {
        $("#mtramo" + i).on("click", function(evento) {
            if ($(this).is(':checked')) {
                $("#manotacion" + i).prop('disabled', false);
            } else {
                $("#manotacion" + i).prop('disabled', true);
            }
        });
    }

    $("#btnVerHorario").on("click", function(evento) {
        let prof = $("#cmbprofesor").val();
        window.open("<?php echo base_url(); ?>horarios/mostrar_ventana/" + prof, "",
            "scrollbars=yes,resizable=yes,top=0,left=200,width=1000,height=800");

    });


    $(".btneditar").on("click", function(evento) {
        $("#editar").modal("show");
        document.frmeditar.id.value = $(this).data("id");
        document.frmeditar.fecha.value = $(this).data("fecha");
        document.frmeditar.profesor.value = $(this).data("profesor");
        document.frmeditar.causa.value = $(this).data("causa");
        let mistramos = $(this).data("tramos").split(",");
        // poner todos a false
        for (let ind = 0; ind <= 6; ind++) {
            $("#mtramo" + mistramos[ind]).prop("checked", false);
        }
        for (let ind = 0; ind < mistramos.length; ind++) {
            $("#mtramo" + mistramos[ind]).prop("checked", true);
            $("#manotacion" + mistramos[ind]).prop('disabled', false);
        }
        // poner anotaciones
        for (let ind = 1; ind <= 7; ind++) {
            $("#manotacion" + ind).val($(this).data("anotacion" + ind));
        }
        $("#mguardiaSN").prop("checked", $(this).data("guardiasn"));

    });
</script>