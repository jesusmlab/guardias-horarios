<style>
    /* Cabecera de la tabla centrar y agrandar */
    .cabecera-tabla {
        width: 18%;
        font-size: 1.2em;
        text-align: center;
    }

    .peque {
        font-size: 0.9em;
    }

    @media print {

        /* Contenido del fichero print.css */
        a[href]:after {
            content: none !important;
        }

        /*Orientación apaisada*/
        @page {
            size: A4 landscape;
        }
    }

    /* Texto enfatizado para la Materia */
    .textoenf {
        background-color: black;
        color: white;
        font-size: 1.2em;
        padding: 2px;
        border-radius: 5px;

    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <!-- Contenido del panel -->
            <?php
            $aula_corr = urldecode($this->uri->segment(3, ""));
            ?>
            <div class="panel-heading">Horario del Aula <?php echo $aula_corr; ?>
                <?
                if ($aula_corr!=""){
                ?>
                <button type="button" class="btn btn-default" onclick="window.print();"> Imprimir</button>
                <?
                }
                ?>
            </div>
            <div class="panel-body">

                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="cmbaula" class="col-xs-2">Aula:</label>
                        <div class="col-xs-8">
                            <select id="cmbaula" autofocus data-live-search="true" class="form-control selectpicker">
                                <?php
                                // Si hay seleccionado uno ponerle por defecto en el select

                                $cadena = "";
                                $cadena .= "<option value=''></option>";
                                foreach ($aulas as $aula) {
                                    if ($aula_corr == $aula['Descripcion']) {

                                        $cadena .= "<option selected value='" . $aula['Descripcion'] . "'>" . $aula['Descripcion'] . "</option>";
                                    } else {

                                        $cadena .= "<option value='" . $aula['Descripcion'] . "'>" . $aula['Descripcion'] . "</option>";
                                    }
                                }
                                echo $cadena;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <?
            if ($aula_corr!=""){
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
                        <th>Tramo</th>
                        <th class="cabecera-tabla">Lunes</th>
                        <th class="cabecera-tabla">Martes</th>
                        <th class="cabecera-tabla">Miercoles</th>
                        <th class="cabecera-tabla">Jueves</th>
                        <th class="cabecera-tabla">Viernes</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $tabla = "";;
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

                        $tabla .= "<th>" . $hora . "  <span class='badge'>" . $tramo_budge . "ª</span></th>";

                        for ($fila = 1; $fila < 6; $fila++) {
                            $tabla .= "<td class='celda-horario'>";
                            $nfilas = count($casillas[$fila][$tramo]);
                            for ($ind = 0; $ind < $nfilas; $ind++) {
                                if (is_array($casillas[$fila][$tramo][$ind])) {
                                    if ($casillas[$fila][$tramo][$ind]['Actividad'] != "Docencia") {
                                        $tabla .= "<strong>Actividad:</strong>" . $casillas[$fila][$tramo][$ind]['Actividad'] . "<br/>";
                                    }

                                    if ($casillas[$fila][$tramo][$ind]['Materia'] != "") {
                                        $tabla .= "<strong>Materia:</strong><span class='textoenf'>" . $casillas[$fila][$tramo][$ind]['Materia'] . "</span><br/>";
                                    }
                                    if ($casillas[$fila][$tramo][$ind]['Apenom'] != "") {
                                        //$tabla.="<span class='peque'>".$casillas[$fila][$tramo][$ind]['Apenom']."</span><br/>";
                                        $tabla .= "<strong><a class='peque' target='_blank' href='" . base_url() . "horarios/mostrar/" . $casillas[$fila][$tramo][$ind]['CodigoProf'] . "'>" . $casillas[$fila][$tramo][$ind]['Apenom'] . "</a></strong><br/>";
                                    }

                                    if ($casillas[$fila][$tramo][$ind]['Unidad'] != "") {
                                        $tabla .= "<strong>Grupo&nbsp&nbsp:<a target='_blank' href='" . base_url() . "horarios/mostrar_grupo/" . $casillas[$fila][$tramo][$ind]['Unidad'] . "'>" . $casillas[$fila][$tramo][$ind]['Unidad'] . "</a></strong>";
                                        if (isset($casillas[$fila][$tramo][$ind + 1]['Unidad'])) {
                                            $tabla .= "<br/>";
                                        }
                                    }
                                } else {
                                    $tabla .= " ";
                                }
                            }
                            $tabla .= "</td>";
                        }
                        $tabla .= "</tr>";
                    }
                    echo $tabla;
                    ?>
                </tbody>
            </table>
            <? 
            }
            
            ?>
        </div>
    </div>
</div>
<script>
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        location.href = "<? echo base_url(); ?>horarios/index_m";
    }
    $("#cmbaula").on("change", function(evento) {
        location.href = "<? echo base_url(); ?>horarios/mostrar_aula/" + this.value;
    })
</script>