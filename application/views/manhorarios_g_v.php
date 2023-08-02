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
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary principal">
            <!-- Contenido del panel -->
            <?php
            $grupo_corr= $this->uri->segment(3, "");
            ?>

            <div class="panel-body">

                <div class="col-xs-8">
                    <div class="form-group">
                        <label for="cmbgrupo" class="col-xs-2">Grupo:</label>
                        <div class="col-xs-8">
                            <select id="cmbgrupo" data-live-search="true" class="form-control selectpicker">
                                <?php
                                    // Si hay seleccionado uno ponerle por defecto en el select
                                    
                                    $cadena="";
                                    $cadena.="<option value=''></option>";  
                                    foreach ($grupos as $grupo){
                                        if ($grupo_corr==$grupo['Descripcion']){
                                            
                                                $cadena.="<option selected value='".$grupo['Descripcion']."'>".$grupo['Descripcion']."</option>";    
                        
                                        } else {
                                            
                                            $cadena.="<option value='".$grupo['Descripcion']."'>".$grupo['Descripcion']."</option>";   
                                        }
                                    }
                                    echo $cadena;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <a href="<? echo base_url() ?>" class="btn btn-info" role="button">Ir a Inicio</a>
                </div>
            </div>

            <?
            if ($grupo_corr!=""){
                //print_r($horario);
                $dTramo=8;
                $hTramo=0;
                foreach ($horario as $horas){
                    if ($horas['Tramo']<$dTramo){
                        $dTramo=$horas['Tramo'];
                    }
                    if ($horas['Tramo']>$hTramo){
                        $hTramo=$horas['Tramo'];
                    }
                }
                //echo "Desde: ".$dTramo." Hasta: ".$hTramo;
                // Inicializar Matriz casillas
                for ($fila=1;$fila<6;$fila++){
                for ($tramo=$dTramo;$tramo<=$hTramo;$tramo++){
                    $casillas[$fila][$tramo][0]="";        
                }
            }
            // Igualar casillas a contenido del horario
            foreach ($horario as $horas){
                if ($casillas[$horas['DiaSem']][$horas['Tramo']][0]=="") {
                    $casillas[$horas['DiaSem']][$horas['Tramo']][0]=$horas;
                } else {
                    $casillas[$horas['DiaSem']][$horas['Tramo']][1]=$horas;
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
                  
                        $tabla="";$tramo_budge=0;
                            for ($tramo=$dTramo;$tramo<=$hTramo;$tramo++){
                                $tabla.="<tr>";
                                //$tabla.="<th>".$tramosHorarios[$tramo]['Inicio']." - ".$tramosHorarios[$tramo]['Fin']."</th>";
                                $hora="";
                                for ($fi=1;$fi<6;$fi++){
                                     if (!empty($casillas[$fi][$tramo][0]['Inicio'])) {
                                        $hora=$casillas[$fi][$tramo][0]['Inicio']." - ".$casillas[$fi][$tramo][0]['Fin'];
                                        $tramo_budge+=1;
                                        break; 
                                    }  
                                }
                               
                                $tabla.="<th>".$hora."  <span class='badge'>".$tramo_budge."</span></th>";
                                
                                for ($fila=1;$fila<6;$fila++){
                                    // Poner clase para colorear celda
                                    if (is_array($casillas[$fila][$tramo][0])) {
                                        if ($casillas[$fila][$tramo][0]['Actividad']=="Docencia"){
                                            $classcelda="actdoc";
                                        } else {
                                            $classcelda="actnodoc";
                                        }
                                    } else {
                                        $classcelda="";
                                    }
                                    // Obtener el codigo del grupo para trabajar con el, no con la descripcion
                                    $indice = array_search($grupo_corr, array_column($grupos, 'Descripcion'));
                                    error_log($indice);
                                    $grupoCod=$grupos[$indice]['Codigo'].
                                    $tabla.="<td class='celda-horario ".$classcelda."' data-grupo=".$grupo_correxplo." data-diasem=".$fila." data-tramo=".$tramo.">";
                                    $nfilas=count($casillas[$fila][$tramo]);
                                    for ($ind=0;$ind<$nfilas;$ind++){
                                        if (is_array($casillas[$fila][$tramo][$ind])) {
                                            if ($casillas[$fila][$tramo][$ind]['Actividad']!="Docencia"){
                                                $tabla.="<strong>Actividad:</strong>".$casillas[$fila][$tramo][$ind]['Actividad']."<br/>";
                                            } 
                                            
                                            if ($casillas[$fila][$tramo][$ind]['Materia']!=""){
                                                $tabla.="<strong>Materia:</strong><span class='textoenf'>".$casillas[$fila][$tramo][$ind]['Materia']."</span><br/>";
                                            }
                                            if ($casillas[$fila][$tramo][$ind]['Apenom']!=""){
                                                $tabla.="<span class='peque'>".$casillas[$fila][$tramo][$ind]['Apenom']."</span><br/>";
                                            }
                                        
                                            if ($casillas[$fila][$tramo][$ind]['Aula']!=""){
                                                $tabla.="<strong>Aula:</strong>".$casillas[$fila][$tramo][$ind]['Aula']."";
                                                if (isset($casillas[$fila][$tramo][$ind+1]['Aula'])) {
                                                    $tabla.="<br/>";
                                                }
                                            }
                                        } else {
                                            $tabla.=" ";
                                        }
                                    }
                                    $tabla.="</td>";
                                    }
                                $tabla.="</tr>";
                            }
                            echo $tabla; 
                        ?>

                </tbody>
            </table>
        </div>
        <div id="panelabajo">
            <div class="panel panel-primary col-xs-3">
                <div class="panel-heading">Actividades</div>
                <div class="panel-body fixed-panel">
                    <ul class="list-group">
                        <?
                        foreach ($actividades as $actividad) {
                        ?>
                        <li draggable="true" class="list-group-item" data-tipo="Actividad"
                            data-actividad="<? echo $actividad['Codigo'] ?>">
                            <? echo $actividad['Descripcion'] ?>
                        </li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary col-xs-2">
                <div class="panel-heading">Materias</div>
                <div class="panel-body fixed-panel">
                    <ul class="list-group">
                        <?
                        foreach ($materias as $materia) {
                        ?>
                        <li draggable="true" class="list-group-item" data-tipo="Materia"
                            data-actividad="<? echo $materia['Codigo'] ?>">
                            <? echo $materia['Descripcion'] ?>
                        </li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary col-xs-3">
                <div class="panel-heading">Profesores</div>
                <div class="panel-body fixed-panel">
                    <ul class="list-group">
                        <?
                        foreach ($profesores as $profe) {
                        ?>
                        <li draggable="true" class="list-group-item" data-tipo="Profesor"
                            data-actividad="<? echo $profe['Codigo'] ?>">
                            <? echo $profe['Apellido1']." ".$profe['Apellido2'].",".$profe['Nombre'] ?>
                        </li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary col-xs-2">
                <div class="panel-heading">Aulas</div>
                <div class="panel-body fixed-panel">
                    <ul class="list-group">
                        <?
                        foreach ($aulas as $aula) {
                        ?>
                        <li draggable="true" class="list-group-item" data-tipo="Aula"
                            data-actividad="<? echo $aula['Codigo'] ?>">
                            <? echo $aula['Descripcion'] ?>
                        </li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary col-xs-2">
                <div class="panel-heading">Cursos</div>
                <div class="panel-body fixed-panel">
                    <ul class="list-group">
                        <?
                        foreach ($cursos as $curso) {
                        ?>
                        <li draggable="true" class="list-group-item" data-tipo="Curso"
                            data-actividad="<? echo $curso['Codigo'] ?>">
                            <? echo $curso['Descripcion'] ?>
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
                    <h4 class="modal-title">Generar Horario</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="varchar">Actividad</label>
                        <select name="Actividad" id="Actividad" class="form-control">
                            <?php
                    $cadena="";
                    foreach ($actividades as $item){
                            $cadena.="<option value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                    }
                    echo $cadena;
                    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Curso</label>
                        <select name="Curso" id="Curso" class="form-control">
                            <?php
                    $cadena="";
                    foreach ($cursos as $item){
                            $cadena.="<option value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                    }
                    echo $cadena;
                    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Grupo</label>
                        <select name="Unidad" id="Unidad" class="form-control">
                            <?php
                    $cadena="";
                    foreach ($grupos as $item){
                            $cadena.="<option value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                    }
                    echo $cadena;
                    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Materia</label>
                        <select name="Materia" id="Materia" class="form-control">
                            <?php
                    $cadena="";
                    foreach ($materias as $item){
                            $cadena.="<option value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                    }
                    echo $cadena;
                    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Aula</label>
                        <select name="Aula" id="Aula" class="form-control">
                            <?php
                    $cadena="";
                    foreach ($aulas as $item){
                        $cadena.="<option value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                    }
                    echo $cadena;
                    ?>
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
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            location.href = "<? echo base_url(); ?>horarios/index_m";
        }
        $("#cmbgrupo").on("change", function (evento) {
            location.href = "<? echo base_url(); ?>horarios/mostrarman_g/" + this.value;
        })
        // Eventos de drag and drop
        // Al empezar guardar el codigo del elemento arrastrado
        $(".list-group > li").on("dragstart", function (evento) {
            evento.originalEvent.dataTransfer.setData('codigo', this.dataset.actividad);
            evento.originalEvent.dataTransfer.setData('tipo', this.dataset.tipo);
        });
        // Al soltar poner datos y enviar con AJAX al controlador horarios/manhorarios
        $(".celda-horario").on("drop", function (evento) {
            let datos = new Object();
            datos.grupo = this.dataset.grupo;
            datos.tipo = evento.originalEvent.dataTransfer.getData('tipo');
            datos.codigo = evento.originalEvent.dataTransfer.getData('codigo');
            datos.diasem = this.dataset.diasem;
            datos.tramo = this.dataset.tramo;
            $.post("<? echo base_url(); ?>horarios/manhorarios_g", "datos=" + JSON.stringify(datos), function (
                data) {
                if (data == 'ok') {
                    // refrescar
                    location.reload(true);
                } else {
                    alert(data);
                }
            });

        });
        // El entrar o estar o salir poner icono
        $(".celda-horario").on("dragenter", function (evento) {
            evento.preventDefault();
            this.classList.add('hovering');

        });
        $(".celda-horario").on("dragover", function (evento) {
            evento.preventDefault();
            this.classList.add('hovering');

        });
        $(".celda-horario").on("dragleave", function (evento) {
            evento.preventDefault();
            this.classList.remove('hovering');

        });
        $("#btnborrarcelda>span").on("click", function (evento) {
            let datos = new Object();
            celda = $(this).parent().parent().get(0);
            datos.grupo = celda.dataset.grupo;
            datos.diasem = celda.dataset.diasem;
            datos.tramo = celda.dataset.tramo;
            $.post("<? echo base_url(); ?>horarios/vaciarcelda_g", datos, function (data) {
                if (data == 'ok') {
                    // refrescar
                    location.reload(true);
                }
            });

        });

        $("#btnvaciarh").on("click", function (evento) {
            if (confirm("Esta opción borrará todo el horario de este profesor.Esta seguro?")) {
                let datos = new Object();
                datos.profesor = $("#cmbprofesor").val();
                datos.actividad = $("#Actividad").val();
                datos.curso = $("#Curso").val();
                datos.unidad = $("#Unidad").val();
                datos.materia = $("#Materia").val();
                datos.aula = $("#Aula").val();


                $.post("<? echo base_url(); ?>horarios/generarhorario", datos,
                    function (
                        data) {
                        if (data == 'ok') {
                            // refrescar
                            location.reload(true);
                        }
                    });
            }
        });
    </script>