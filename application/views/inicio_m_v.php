<style>
table {
  table-layout: fixed;
   
}
    .colprofe {
        width: 50%;

    }

    .coltramo {
        width:50%;
        text-align: center;
    }

    .horaActiva {
        background-color: #F3E4C9;
    }

    .anotacion {
        font-style: italic;
    }

    .peque {
        font-size: 0.9em;
    }

    .circulo {

        height: 50px;
        width: 50px;
        display: table-cell;
        font-size: 1.5em;
        vertical-align: middle;
        border-radius: 50%;
        background: #8CC657;
    }

    /* Texto enfatizado para la Materia */
    .textoenf {
        background-color: black;
        color: white;
        font-size: 1.2em;
        padding: 2px;
        border-radius: 5px;

    }

    /*.btnImprimir {
        padding-top:0;
        padding-bottom:0;
        margin-bottom:10px;
    }
    #aviso1 {
        float: left;
    }

    #aviso2 {
        float: right;
    } */
    .profguardia {
        /* text-transform: lowercase; */
        /*text-transform: capitalize;*/
    }
</style>
<?php
$fechasel = $this->uri->segment(3, "");
if ($fechasel == "") {
    $fechasel = date("Y-m-d");
}

function dateIsBetween($from, $to, $date = 'now')
{
    $date = is_int($date) ? $date : strtotime($date); // convert non timestamps
    $from = is_int($from) ? $from : strtotime($from); // ..
    $to = is_int($to) ? $to : strtotime($to); // ..
    return ($date >= $from) && ($date <= $to); // extra parens for clarity
}
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <!-- Contenido del panel -->
            <div class="panel-heading">

                <div class="input-group">
                    <span class="input-group-addon">Profesores que faltan el dia</span>

                    <input type="text" readonly class="form-control" id="fecha" name="fecha" value="<?php echo date('d-m-Y'); ?>" placeholder="Fecha">
                </div>

            </div>
			<div class="panel-heading text-center">
                <button id="btnretro" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span></button>
                Tramo Horario
                <button id="btnavant" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></button>
            </div>
            <div class="panel-body">

                <?
                // faltasDia dataset
                // nfaltasDia numero de profesores que faltan
                // Inicializar Matriz casillas

                for ($fila = 1; $fila <= $nfaltasDia[0]['nfaltas']; $fila++) {
                    for ($tramo = 0; $tramo <= 6; $tramo++) {
                        $casillas[$fila][$tramo] = "";
                    }
                }
                $profback = "";
                $fila = 0;
                if ($faltasDia) {
                    foreach ($faltasDia as $item) {
                        if ($profback != $item['CodigoProf']) {
                            $profback = $item['CodigoProf'];
                            $fila++;
                            $casillas[$fila][0] = $item;
                            $casillas[$fila][$item['Tramo']] = $item;
                        } else {
                            $casillas[$fila][$item['Tramo']] = $item;
                        }
                    }
                }
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered'>";
                echo "<th class='colprofe'>Profesor</th>";
                // ver hora activa
                $hoy = getdate();
                $ahora = $hoy['hours'] . ":" . $hoy['minutes'];
				$tramoAct=0; // Tramo actual
				
				 $tramoAct = $this->uri->segment(3, "");
				if ($tramoAct == "") {
					for ($th = 1; $th <= 6; $th++) {
						if (dateIsBetween($tramosHorarios[$th - 1]['Inicio'], $tramosHorarios[$th - 1]['Fin'], $ahora)) {
							$tramoAct=$th; //$horaActiva = "horaActiva"; 
						}
					}	
				}
				
				if ($tramoAct==0) {
					$tramoAct=1;
				}
				echo "<script>let tramoAct=" . $tramoAct . ";</script>";
				echo  "<th class='coltramo'>" . $tramosHorarios[$tramoAct - 1]['Inicio'] . " - " . $tramosHorarios[$tramoAct - 1]['Fin'] . "</th>";
                
                for ($fila = 1; $fila <= $nfaltasDia[0]['nfaltas']; $fila++) {
                    if (!empty($casillas[$fila][0]['Apenom'])){
					echo "<tr><td>";
                    
					if (isset($casillas[$fila][0]['Apenom'])) $apenom=explode(",",$casillas[$fila][0]['Apenom']);
                    if (isset($casillas[$fila][0]['Sustituto'])) {
                        echo $casillas[$fila][0]['Sustituto'] != "" ? $casillas[$fila][0]['Sustituto'] : $apenom[0]."<br>".$apenom[1];
                    }
					
                    echo "</td>";
                    
					//for ($tramo = 1; $tramo <= 6; $tramo++) {
                    
                        if (!empty($casillas[$fila][$tramoAct])) {
                            echo "<td style='text-align:center;vertical-align: middle;'>";
                            // sacar solo si existe en los tramos
                            $ind = strpos($casillas[$fila][$tramoAct]['tramos'], $casillas[$fila][$tramoAct]['Tramo']);
                            if ($ind !== FALSE) {
                                if ($casillas[$fila][$tramoAct]['Actividad'] == "Docencia") {
                                    $pos = strpos($casillas[$fila][$tramoAct]['Aula'], " ");
                                    $aula = substr($casillas[$fila][$tramoAct]['Aula'], 0, $pos);
                                    if ($casillas[$fila][$tramoAct]['Materia'] != "") {
                                        echo "<span class='textoenf'>" . $casillas[$fila][$tramoAct]['Materia'] . "</span><br/>";
                                    }
                                    echo "<strong>Grupo:</strong>" . $casillas[$fila][$tramoAct]['Unidad'] . " <strong>Aula:</strong>" . $aula . "</br>";
                                    if ($casillas[$fila][$tramoAct]['anotacion' . $tramoAct] != "") {
                                        echo "<span class='anotacion'>(" . $casillas[$fila][$tramoAct]['anotacion' . $tramoAct] . ")</span>";
                                    }
                                } else {
                                    $porciones = explode(" ", $casillas[$fila][$tramoAct]['Actividad']);
                                    $iniciales = "";
                                    $bucle = 0;
                                    foreach ($porciones as $palabras) {
                                        $iniciales .= substr($palabras, 0, 1);
                                        $bucle++;
                                        if ($bucle > 3) {
                                            break;
                                        }
                                    }
                                    echo "<div title='" . $casillas[$fila][$tramoAct]['Actividad'] . "' class='circulo'>" . $iniciales . "</div>";
                                    //echo "".substr($casillas[$fila][$tramoAct]['Actividad'],0,20)."</br>";
                                }
                            }
                            //echo $casillas[$fila][$tramoAct]['Unidad'];
                            echo  "</td>";
                        } else {
                            echo "<td>";
                            echo "";
                            echo "</td>";
                        }
                    //}
                    echo "</tr>";
					}
                }
                // Poner los profesores de guardia de cada tramo    
                echo "<tr class='peque'><td>Profesores de Guardia</td>";

                $tramo = 0;
                $diasem = date("w", strtotime($fechasel));
                echo "<td>";
				foreach ($profGuardias as $prof) {

                    /* if ($tramo != $prof['tramo']) {
                        $tramo = $prof['tramo'];
                        echo "</td><td>";
                    }*/
					
                    if ($prof['tramo'] == $tramoAct) {
                        // ver si el profesor de guardia falta

                        $indice = array_search($prof['profesor'], array_column($profesores, 'Codigo'));
                        if (empty($profesores[$indice]['Sustituto'])) {
                            echo "<span class='profguardia' data-toggle='tooltip' title='Click para indicar que ha hecho guardia' data-tramo='" . $prof['tramo'] . "' data-diasem='" . $diasem . "' data-codigoprof='" . $prof['profesor'] . "'><strong>(" . $prof['nguardias'] . ")</strong>" . $profesores[$indice]['Nombre'] . " " . $profesores[$indice]['Apellido1'] . "</span></br>";
                        } else {
                            echo "<span class='profguardia' data-toggle='tooltip' title='Click para indicar que ha hecho guardia' data-tramo='" . $prof['tramo'] . "' data-diasem='" . $diasem . "' data-codigoprof='" . $prof['profesor'] . "'><strong>(" . $prof['nguardias'] . ")</strong>" . $profesores[$indice]['Sustituto'] . "</span></br>";
                        }
                    }
                }
                echo "</td></tr>";

                // Poner los profesores de guardia de cada tramo    
                echo "<tr class='peque'><td>Profesores que han hecho <br>Guardia";
                $tramo = 0;
				echo "<td>";
                foreach ($registro as $profg) {

                    /* if ($tramo != $profg['Tramo']) {
                        $numt = intval($profg['Tramo']) - intval($tramo);
                        for ($ind = 1; $ind <= $numt; $ind++) {
                            $tramo = $profg['Tramo'];
                            echo "</td><td>";
                        }
                    } */
                    if ($profg['Tramo'] == $tramoAct) {
                        $indice = array_search($profg['Profesor'], array_column($profesores, 'Codigo'));
                        if (empty($profesores[$indice]['Sustituto'])) {
                            echo "" . $profesores[$indice]['Nombre'] . " " . $profesores[$indice]['Apellido1'] . "</br>";
                        } else {
                            echo "" . $profesores[$indice]['Sustituto'] . "</br>";
                        }
                    }
                }
                echo "</td></tr>";
                echo "</table>";
                echo "</div>";
                if (isset($_SESSION['logueado']) && $_SESSION['roll']=="admin") {
                ?>
                <div>
                    <div id="aviso1"><b>* Haz click sobre los profesores que hayan hecho guardia para
                            registrarla</b></div>
                    <div id="aviso2"><b>* El número entre paréntesis son las guardias
                            que ha efectuado el profesor</b></div>
                </div>
                <?
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    $("#btnretro").on("click", function(evento) {
        $(this).attr("disabled", true);
        if (tramoAct > 1) {
            tramoAct--;
            location.href = "<? echo base_url(); ?>inicio/index_m/" + tramoAct;
        }

    });
    $("#btnavant").on("click", function(evento) {
        $(this).attr("disabled", true);
        if (tramoAct < 6) {
            tramoAct++;
            location.href = "<? echo base_url(); ?>inicio/index_m/" + tramoAct;
        }

    });
</script>