<style>
    .cabecera-tabla {
        width: 60%;
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
            $prof_corr = $this->uri->segment(3, "");
            $diasel = $this->uri->segment(4, "");
            if ($diasel == "") {
                $diasel = date("w");
            }
            if ($diasel > 5) {
                $diasel = 1;
            }
            echo "<script>let diasel=" . $diasel . ";let prof_corr='" . $prof_corr . "';</script>";
            if ($prof_corr != "") {
                $indice = array_search($prof_corr, array_column($profesores, 'Codigo'));
                if (empty($profesores[$indice]['Sustituto'])) {
                    $profsel = $profesores[$indice]['Apellido1'] . " " . $profesores[$indice]['Apellido2'] . "," . $profesores[$indice]['Nombre'];
                } else {
                    $profsel = $profesores[$indice]['Sustituto'];
                }
            } else {
                $profsel = "";
            }
            ?>
            <div class="panel-heading text-center">
                <button id="btnretro" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span></button>
                Horario
                <button id="btnavant" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></button>
            </div>
            <div class="panel-body">

                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="cmbprofesor">Profesor/a</label>

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
            if ($prof_corr!=""){
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
            $diasSemana=['1'=>'Lunes','2'=>'Martes','3'=>'Miercoles','4'=>'Jueves','5'=>'Viernes'];
            //$diasel=0; 
            ?>

            <table class="table peque table-bordered">
                <thead>
                    <tr>
                        <th class="cabecera-tramo">Tramo</th>
                        <th class="cabecera-tabla">
                            <? echo $diasSemana[$diasel]; ?>
                        </th>
                        <!-- <th class="cabecera-tabla">Martes</th>
                            <th class="cabecera-tabla">Miercoles</th>
                            <th class="cabecera-tabla">Jueves</th>
                            <th class="cabecera-tabla">Viernes</th> -->
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
                                //$tramo_budge += 1;
								$tramo_budge=$tramo;
                                break;
                            }
                        }

                        $tabla .= "<th>" . $hora . "  <span class='badge'>" . $tramo_budge . "ª</span></th>";
                        $fila = $diasel;
                        // Si es sabado pasar al lunes

                        $tabla .= "<td class='celda-horario'>";
                        if (is_array($casillas[$fila][$tramo][0])) {
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
                                $tabla .= "<strong>Grupo&nbsp&nbsp:</strong>" . $casillas[$fila][$tramo][0]['Unidad'] . "<br/>";
                            }

                            if ($casillas[$fila][$tramo][0]['Aula'] != "") {
                                $tabla .= "<strong>Aula&nbsp&nbsp&nbsp&nbsp&nbsp:</strong>" . $casillas[$fila][$tramo][0]['Aula'] . "<br/>";
                            }
                        } else {
                            $tabla .= " ";
                        }
                        $tabla .= "</td>";

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
    $("#cmbprofesor").on("change", function(evento) {
        location.href = "<? echo base_url(); ?>horarios/movil/" + this.value;
    });
    $("#btnretro").on("click", function(evento) {
        $(this).attr("disabled", true);
        if (diasel > 1) {
            diasel--;
            location.href = "<? echo base_url(); ?>horarios/movil/" + prof_corr + "/" + diasel;
        }

    });
    $("#btnavant").on("click", function(evento) {
        $(this).attr("disabled", true);
        if (diasel < 5) {
            diasel++;
            location.href = "<? echo base_url(); ?>horarios/movil/" + prof_corr + "/" + diasel;
        }

    });
</script>