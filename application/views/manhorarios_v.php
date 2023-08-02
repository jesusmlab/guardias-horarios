<style>
    /* Cabecera de la tabla centrar y agrandar */
    .cabecera-tabla {
        width: 18%;
        font-size: 1.2em;
        text-align: center;
    }

    /* Colorear celda actividad docente */
    .actdoc {
        background-color: hsla(120, 60%, 70%, 0.3);
    }

    /* Colorear celda actividad no docente */
    .actnodoc {}

    .peque {
        font-size: 0.9em;
    }

    /* Texto enfatizado para la Materia */
    .textoenf {
        background-color: black;
        color: white;
        font-size: 1.2em;
        padding: 2px;
        border-radius: 5px;

    }

    /* Colocar bote de la basura para borrar celda*/
    #btnborrarcelda {
        text-align: right;
        vertical-align: text-bottom;

    }

    /* Quitarle a los paneles el padding para ganar espacio */
    .panel {
        padding: 0 !important;
    }

    /* achicar el padding al los bodys de los paneles */
    .panel-body {
        padding: 5 !important;
    }

    /* Poner panel fijo en la parte de abajo de la pantalla para las listas */
    .fixed-panel {
        min-height: 20vh;
        max-height: 20vh;
        overflow-y: scroll;
        padding: 0px !important;
    }

    /* Ajustar tamaño y scroll de la parte de la tabla */
    .principal {
        min-height: 70vh;
        max-height: 70vh;
        overflow-y: scroll;
        margin-bottom: 0px !important;
    }

    /* Ajustar elementos de las listas */
    .list-group-item {
        padding: 2px 5px !important;
    }

    .list-group>li:nth-child(odd) {
        background-color: lightgray;
    }

    .searchclear {
        position: absolute;
        right: 5px;
        top: 0;
        bottom: 0;
        height: 14px;
        margin: auto;
        font-size: 14px;
        cursor: pointer;
        color: #ccc;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary principal">
            <!-- Contenido del panel -->
            <?php
            $prof_corr = $this->uri->segment(3, "");
            ?>

            <div class="panel-body">

                <div class="col-xs-5">
                    <div class="form-group">
                        <label for="cmbprofesor" class="col-xs-2">Profesor:</label>
                        <div class="col-xs-8">
                            <select id="cmbprofesor" data-live-search="true" class="form-control selectpicker">
                                <?php
                                // Si hay seleccionado uno ponerle por defecto en el select

                                $cadena = "";
                                $cadena .= "<option value=''></option>";
                                foreach ($profesores as $profe) {
                                    if ($prof_corr == $profe['Codigo']) {
                                        if (empty($profe['Sustituto'])) {
                                            $cadena .= "<option selected value='" . $profe['Codigo'] . "'>" . $profe['Apellido1'] . " " . $profe['Apellido2'] . "," . $profe['Nombre'] . "</option>";
                                        } else {
                                            $cadena .= "<option selected value='" . $profe['Codigo'] . "'>" . $profe['Sustituto'] . "</option>";
                                        }
                                    } else {
                                        if (empty($profe['Sustituto'])) {
                                            $cadena .= "<option value='" . $profe['Codigo'] . "'>" . $profe['Apellido1'] . " " . $profe['Apellido2'] . "," . $profe['Nombre'] . "</option>";
                                        } else {
                                            $cadena .= "<option value='" . $profe['Codigo'] . "'>" . $profe['Sustituto'] . "</option>";
                                        }
                                    }
                                }
                                echo $cadena;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?
                if ($prof_corr != "") {
                ?>
                    <div class="col-xs-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#genhorario"> Generar
                            Horario</button>
                    </div>
                <?
                }
                ?>
                <div class="col-xs-1">
                    <a href="<? echo base_url() ?>" class="btn btn-info" role="button">Ir a Inicio</a>
                </div>
                <div class="col-xs-4">
                    <div>Si el horario estña vacio, puede crear uno nuevo con Generar Horario</div>
                    <div>Puede arrastrar y soltar los datos sobre las celdas horarias</div>
                </div>
            </div>

            <?
            if ($prof_corr != "") {
                //print_r($horario);
                $dTramo = 8;
                $hTramo = 0;
                foreach ($horario as $horas) {
                    if ($horas['Tramo'] < $dTramo) {
                        $dTramo = $horas['Tramo'];
                    }
                    if ($horas['Tramo'] > $hTramo) {
                        $hTramo = $horas['Tramo'];
                    }
                }
                //echo "Desde: ".$dTramo." Hasta: ".$hTramo;
                // Inicializar Matriz casillas
                for ($fila = 1; $fila < 6; $fila++) {
                    for ($tramo = $dTramo; $tramo <= $hTramo; $tramo++) {
                        $casillas[$fila][$tramo][0] = "";
                    }
                }
                // Igualar casillas a contenido del horario
                foreach ($horario as $horas) {
                    if ($casillas[$horas['DiaSem']][$horas['Tramo']][0] == "") {
                        $casillas[$horas['DiaSem']][$horas['Tramo']][0] = $horas;
                    } else {
                        $casillas[$horas['DiaSem']][$horas['Tramo']][1] = $horas;
                    }
                }
            ?>
                <table class="table peque table-bordered">
                    <thead>
                        <tr>
                            <th style="font-size:1.2em">Tramo</th>
                            <th class="cabecera-tabla">Lunes</th>
                            <th class="cabecera-tabla">Martes</th>
                            <th class="cabecera-tabla">Miercoles</th>
                            <th class="cabecera-tabla">Jueves</th>
                            <th class="cabecera-tabla">Viernes</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php

                        $tabla = "";
                        $tramo_budge = 0;
                        for ($tramo = $dTramo; $tramo <= $hTramo; $tramo++) {
                            $tabla .= "<tr>";
                            //$tabla.="<th>".$tramosHorarios[$tramo]['Inicio']." - ".$tramosHorarios[$tramo]['Fin']."</th>";
                            $hora = "";
                            for ($fi = 1; $fi < 6; $fi++) {
                                if (!empty($casillas[$fi][$tramo][0]['Inicio'])) {
                                    $hora = $casillas[$fi][$tramo][0]['Inicio'] . " - " . $casillas[$fi][$tramo][0]['Fin'];
                                    $tramo_budge += 1;
                                    break;
                                }
                            }

                            $tabla .= "<th>" . $hora . "  <span class='badge'>" . $tramo_budge . "</span></th>";

                            for ($fila = 1; $fila < 6; $fila++) {
                                // Poner clase para colorear celda
                                if (is_array($casillas[$fila][$tramo][0])) {
                                    if ($casillas[$fila][$tramo][0]['Actividad'] == "Docencia") {
                                        $classcelda = "actdoc";
                                    } else {
                                        $classcelda = "actnodoc";
                                    }
                                } else {
                                    $classcelda = "";
                                }
                                if (isset($casillas[$fila][$tramo][0]['Id'])) {
                                    $idcelda = $casillas[$fila][$tramo][0]['Id'];
                                } else {
                                    $idcelda = '';
                                }
                                if (isset($casillas[$fila][$tramo][0]['CodTramo'])) {
                                    $codtramo = $casillas[$fila][$tramo][0]['CodTramo'];
                                } else {
                                    //$codtramo='';
                                    //$codtramo=str_pad($tramo,2,"0",STR_PAD_LEFT);
                                    $codtramo = $tramosHorarios[$tramo - 1]['Codigo'];
                                }
                                $tabla .= "<td draggable='true' class='celda-horario " . $classcelda . "' data-id='" . $idcelda . "' data-prof=" . $prof_corr . " data-diasem=" . $fila . " data-tramo=" . $tramo . " data-codtramo=" . $codtramo . ">";
                                if (is_array($casillas[$fila][$tramo][0])) {
                                    // if ($casillas[$fila][$tramo][0]['Curso']!=""){
                                    // $tabla.="<strong>Curso:</strong>".substr($casillas[$fila][$tramo][0]['Curso'],0,15)."<br/>";
                                    // }
                                    if ($casillas[$fila][$tramo][0]['Actividad'] != "Docencia") {
                                        $tabla .= "<strong>Actividad:</strong>" . $casillas[$fila][$tramo][0]['Actividad'] . "<br/>";
                                    }

                                    if ($casillas[$fila][$tramo][0]['Materia'] != "") {
                                        $tabla .= "<strong>Materia:</strong><span class='textoenf'>" . $casillas[$fila][$tramo][0]['Materia'] . "</span><br/>";
                                    }
                                    /* if (isset($casillas[$fila][$tramo][0])) {  
                                            if ($casillas[$fila][$tramo][0]['Curso']!=""){
                                                $tabla.="<strong>Curso&nbsp&nbsp:</strong>".$casillas[$fila][$tramo][0]['Curso']."<br/>";
                                            }    
                                        } */
                                    if ($casillas[$fila][$tramo][0]['Unidad'] != "") {
                                        $tabla .= "<strong>Grupo&nbsp&nbsp:<a target='_blank' href='" . base_url() . "horarios/mostrar_grupo/" . $casillas[$fila][$tramo][0]['Unidad'] . "'>" . $casillas[$fila][$tramo][0]['Unidad'] . "</a></strong><br/>";
                                    }

                                    if ($casillas[$fila][$tramo][0]['Aula'] != "") {
                                        $tabla .= "<strong>Aula&nbsp&nbsp&nbsp&nbsp&nbsp:<a target='_blank' href='" . base_url() . "horarios/mostrar_aula/" . $casillas[$fila][$tramo][0]['Aula'] . "'>" . $casillas[$fila][$tramo][0]['Aula'] . "</a></strong>";
                                        //$tabla.="<strong>Aula&nbsp&nbsp&nbsp&nbsp&nbsp:</strong>".$casillas[$fila][$tramo][0]['Aula']."<br/>";
                                    }
                                    if ($casillas[$fila][$tramo][0]['Actividad'] != "") {
                                        $tabla .= "<div id='btnborrarcelda'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></div>";
                                    }
                                } else {
                                    $tabla .= " ";
                                }
                                $tabla .= "</td>";
                            }
                            $tabla .= "</tr>";
                        }
                        echo $tabla;
                        ?>

                    </tbody>
                </table>
        </div>
        <div id="panelabajo">
            <div class="panel panel-primary col-xs-3">
                <div class="panel-heading clearfix">
                    <h4 title="Puede arrastrar y soltar la actividad sobre la celda horaria" class="panel-title pull-left" style="padding-top: 7.5px;">Actividades</h4>
                    <div class="btn-group pull-right">
                        <input id="filtroActividad" type="search" class="form-control filtro" placeholder="Filtrar">
                        <span class="searchclear glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <div class="panel-body fixed-panel">
                    <ul class="list-group">
                        <?
                        foreach ($actividades as $actividad) {
                        ?>
                            <li draggable="true" class="list-group-item" data-tipo="Actividad" data-actividad="<? echo $actividad['Codigo'] ?>">
                                <? echo $actividad['Descripcion'] ?>
                            </li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary col-xs-3">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Grupos </h4>
                    <div class="btn-group pull-right">
                        <input id="filtroGrupo" type="search" class="form-control filtro" placeholder="Filtrar">
                        <span class="searchclear glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <div class="panel-body fixed-panel">
                    <ul class="list-group">
                        <?
                        foreach ($grupos as $grupo) {
                        ?>
                            <li draggable="true" class="list-group-item" data-tipo="Unidad" data-actividad="<? echo $grupo['Codigo'] ?>">
                                <? echo $grupo['Descripcion'] ?>
                            </li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary col-xs-3">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Materias </h4>
                    <div class="btn-group pull-right">
                        <input id="filtroMateria" type="search" class="form-control filtro" placeholder="Filtrar">
                        <span class="searchclear glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <div class="panel-body fixed-panel">
                    <ul class="list-group">
                        <?
                        foreach ($materias as $materia) {
                        ?>
                            <li draggable="true" class="list-group-item" data-tipo="Materia" data-actividad="<? echo $materia['Codigo'] ?>">
                                <? echo $materia['Descripcion'] ?>
                            </li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary col-xs-3">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Aulas </h4>
                    <div class="btn-group pull-right">
                        <input id="filtroAula" type="search" class="form-control filtro" placeholder="Filtrar">
                        <span class="searchclear glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <div class="panel-body fixed-panel">
                    <ul class="list-group">
                        <?
                        foreach ($aulas as $aula) {
                        ?>
                            <li draggable="true" class="list-group-item" data-tipo="Aula" data-actividad="<? echo $aula['Codigo'] ?>">
                                <? echo $aula['Descripcion'] ?>
                            </li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    <?
            }
    ?>
    </div>
    <!-- Ventana de popup para preguntar datos generar horario -->

    <div id="genhorario" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Generar Horario Profesor</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Actividad">Actividad</label>
                        <select name="Actividad" id="Actividad" class="form-control">
                            <?php
                            $cadena = "";
                            foreach ($actividades as $item) {
                                $cadena .= "<option value='" . $item['Codigo'] . "'>" . $item['Descripcion'] . "</option>";
                            }
                            echo $cadena;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Curso">Curso</label>
                        <select name="Curso" id="Curso" class="form-control">
                            <?php
                            $cadena = "";
                            foreach ($cursos as $item) {
                                $cadena .= "<option value='" . $item['Codigo'] . "'>" . $item['Descripcion'] . "</option>";
                            }
                            echo $cadena;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Unidad">Grupo</label>
                        <select name="Unidad" id="Unidad" class="form-control">
                            <?php
                            $cadena = "";
                            foreach ($grupos as $item) {
                                $cadena .= "<option value='" . $item['Codigo'] . "'>" . $item['Descripcion'] . "</option>";
                            }
                            echo $cadena;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Materia">Materia</label>
                        <select name="Materia" id="Materia" class="form-control">
                            <?php
                            $cadena = "";
                            foreach ($materias as $item) {
                                $cadena .= "<option value='" . $item['Codigo'] . "'>" . $item['Descripcion'] . "</option>";
                            }
                            echo $cadena;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Aula">Aula</label>
                        <select name="Aula" id="Aula" class="form-control">
                            <?php
                            $cadena = "";
                            foreach ($aulas as $item) {
                                $cadena .= "<option value='" . $item['Codigo'] . "'>" . $item['Descripcion'] . "</option>";
                            }
                            echo $cadena;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Jornada">Jornada</label>
                        <select name="Jornada" id="Jornada" class="form-control">
                            <option value="M">Mañana</option>
                            <option value="V">Vespertino</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnvaciarh">Generar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
    <script>
        $("document").ready(function() {
            leerFiltros();
        })
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            location.href = "<? echo base_url(); ?>horarios/index_m";
        }
        $(".searchclear").click(function() {
            $(this).prev("input").val("");
            $(this).parent().parent().next("div").find("li").show();
        });
        $('.filtro').keyup(function() {

            filtrar(this);
            guardarFiltros();
        })

        function filtrar(objeto) {
            var rex = new RegExp($(objeto).val(), 'i');
            $(objeto).parent().parent().next("div").find("li").hide();
            $(objeto).parent().parent().next("div").find("li").filter(function() {
                return rex.test($(this).text());
            }).show();
        }

        // Guardar filtros 
        function guardarFiltros() {
            let datos = new Object();
            $(".filtro").each((indice, valor) => {
                datos[valor.id] = valor.value;
            });
            localStorage.setItem("filtros", JSON.stringify(datos));
        }
        // Leer Filtros
        function leerFiltros() {
            let datos = JSON.parse(localStorage.getItem("filtros"));
            let filtro = "";
            for (let ind in datos) {
                filtro = $("#" + ind);
                filtro.val(datos[ind]);
                filtrar(filtro.get(0));
            }
        }
        // Si cambia profesor
        $("#cmbprofesor").on("change", function(evento) {
            location.href = "<? echo base_url(); ?>horarios/mostrarman/" + this.value;
        })
        // Eventos de drag and drop
        // Al empezar guardar el codigo del elemento arrastrado
        $(".list-group > li").on("dragstart", function(evento) {
            evento.originalEvent.dataTransfer.setData('codigo', this.dataset.actividad);
            evento.originalEvent.dataTransfer.setData('tipo', this.dataset.tipo);
        });
        $(".celda-horario").on("dragstart", function(evento) {
            if (this.dataset.id != "") {
                evento.originalEvent.dataTransfer.setData('id', this.dataset.id);
            } else {
                evento.preventDefault();
            }
        });
        // Al soltar poner datos y enviar con AJAX al controlador horarios/manhorarios
        $(".celda-horario").on("drop", function(evento) {
            if (!evento.originalEvent.dataTransfer.getData('id')) {
                let datos = new Object();
                datos.prof = this.dataset.prof;
                datos.tipo = evento.originalEvent.dataTransfer.getData('tipo');
                datos.codigo = evento.originalEvent.dataTransfer.getData('codigo');
                datos.diasem = this.dataset.diasem;
                datos.tramo = this.dataset.codtramo;
                $.post("<? echo base_url(); ?>horarios/manhorarios", "datos=" + JSON.stringify(datos),
                    function(
                        data) {
                        if (data == 'ok') {
                            // refrescar
                            location.reload(true);
                        } else {
                            alert(data);
                        }
                    });
            } else {

                // Poner IDOrigen y destino para enviar por AJAX
                let idOrigen = evento.originalEvent.dataTransfer.getData('id');
                let idDestino = this.dataset.id;
                if (idOrigen != idDestino && idDestino != "") {
                    $.post("<? echo base_url(); ?>horarios/cambiocelda", "idorigen=" + idOrigen +
                        "&iddestino=" +
                        idDestino,
                        function(data) {
                            if (data == 'ok') {
                                // refrescar
                                location.reload(true);
                            } else {
                                alert(data);
                            }
                        });
                }
            }
        });
        // El entrar o estar o salir poner icono
        $(".celda-horario").on("dragenter", function(evento) {
            evento.preventDefault();
            this.classList.add('hovering');

        });
        $(".celda-horario").on("dragover", function(evento) {
            evento.preventDefault();
            this.classList.add('hovering');

        });
        $(".celda-horario").on("dragleave", function(evento) {
            evento.preventDefault();
            this.classList.remove('hovering');

        });
        $("#btnborrarcelda>span").on("click", function(evento) {
            let datos = new Object();
            celda = $(this).parent().parent().get(0);
            datos.prof = celda.dataset.prof;
            datos.diasem = celda.dataset.diasem;
            datos.tramo = celda.dataset.codtramo;
            swal
                .fire({
                    title: "¿Está seguro de borrar la celda?",
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

                        $.post("<? echo base_url(); ?>horarios/vaciarcelda", datos, function(data) {
                            if (data == 'ok') {
                                // refrescar
                                location.reload(true);
                            }
                        });
                    }
                });
        });

        $("#btnvaciarh").on("click", function(evento) {
            if (confirm("Esta opción borrará todo el horario de este profesor.Esta seguro?")) {
                let datos = new Object();
                datos.profesor = $("#cmbprofesor").val();
                datos.actividad = $("#Actividad").val();
                datos.curso = $("#Curso").val();
                datos.unidad = $("#Unidad").val();
                datos.materia = $("#Materia").val();
                datos.aula = $("#Aula").val();
                datos.jornada = $("#Jornada").val();

                $.post("<? echo base_url(); ?>horarios/generarhorario", datos,
                    function(
                        data) {
                        if (data == 'ok') {
                            // refrescar
                            location.reload(true);
                        }
                    });
            }
        });
    </script>