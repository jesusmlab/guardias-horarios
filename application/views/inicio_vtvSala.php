<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Guardias">
    <meta name="author" content="JML">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <title>Guardias</title>

    <!-- Bootstrap Core CSS -->
    <link href="<? echo base_url(); ?>assets/bs/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<? echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- bootstrap Select CSS -->
    <link href="<? echo base_url(); ?>assets/css/bootstrap-select.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<? echo base_url(); ?>assets/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<? echo base_url(); ?>assets/bs/js/bootstrap.min.js"></script>

    <!-- Custom Bootstrap Select  -->
    <script src="<? echo base_url(); ?>assets/js/bootstrap-select.min.js"></script>
    <!-- Custom Bootstrap Select  -->
    <script src="<? echo base_url(); ?>assets/js/i18n/defaults-es_ES.js"></script>
    <style>
        body {
            font-size: 1.5em;
        }

        .colprofe {
            width: 20%;
        }

        .horaActiva {
            background-color: #F3E4C9;
        }

        .coltramo {
            width: 13.3%;
            text-align: center;
        }

        .anotacion {
            font-style: italic;
        }

        .peque {
            font-size: 0.9em;
        }

        .circulo {

            height: 30px;
            width: 50px;
            display: table-cell;
            font-size: 1.2em;
            vertical-align: middle;
            border-radius: 50%;
            background: #8CC657;
            text-align: center;
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
    }*/
    </style>
</head>

<body>

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

                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fechasel; ?>" placeholder="Fecha">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" onclick="window.print();"> Imprimir</button>
                            <button type="button" class="btn btn-default" onclick="window.location.href='<? echo base_url() ?>';"> Inicio</button>
                        </span>
                    </div>

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
                    //echo "<input type='checkbox' id='chkcarousel'> Noticias";
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-bordered'>";
                    echo "<th class='colprofe'>Profesor</th>";

                    // ver hora activa
                    $hoy = getdate();
                    $ahora = $hoy['hours'] . ":" . $hoy['minutes'];
                    $tramoActivo = -1;

                    for ($th = 1; $th <= 6; $th++) {

                        if (dateIsBetween($tramosHorarios[$th - 1]['Inicio'], $tramosHorarios[$th - 1]['Fin'], $ahora)) {
                            $horaActiva = "horaActiva";
                            $tramoActivo = $th;
                        } else {
                            $horaActiva = "";
                        }
                        echo  "<th class='coltramo " . $horaActiva . "'>" . $tramosHorarios[$th - 1]['Inicio'] . " - " . $tramosHorarios[$th - 1]['Fin'] . "</th>";
                    }
                    for ($fila = 1; $fila <= $nfaltasDia[0]['nfaltas']; $fila++) {
                        if (!empty($casillas[$fila][0]['Apenom'])) {
                            echo "<tr><td>";
                            if (isset($casillas[$fila][0]['Sustituto'])) {
                                echo "<strong>";
                                echo $casillas[$fila][0]['Sustituto'] != "" ? $casillas[$fila][0]['Sustituto'] : $casillas[$fila][0]['Apenom'];
                                echo "</strong>";
                            }

                            echo "</td>";
                            for ($tramo = 1; $tramo <= 6; $tramo++) {
                                if (dateIsBetween($tramosHorarios[$tramo - 1]['Inicio'], $tramosHorarios[$tramo - 1]['Fin'], $ahora)) {
                                    $horaActiva = "horaActiva";
                                } else {
                                    $horaActiva = "";
                                }
                                if (!empty($casillas[$fila][$tramo])) {
                                    echo "<td class='" . $horaActiva . "' style='text-align:center;vertical-align: middle;'>";
                                    // sacar solo si existe en los tramos
                                    $ind = strpos($casillas[$fila][$tramo]['tramos'], $casillas[$fila][$tramo]['Tramo']);
                                    if ($ind !== FALSE) {
                                        if ($casillas[$fila][$tramo]['Actividad'] == "Docencia") {
                                            $pos = strpos($casillas[$fila][$tramo]['Aula'], " ");
                                            /* if (is_numeric($pos)) {
                                                $aula = substr($casillas[$fila][$tramo]['Aula'], 0, $pos);
                                            } else {
                                                $aula = $casillas[$fila][$tramo]['Aula'];
                                            } */
                                            $aula = $casillas[$fila][$tramo]['Aula'];
                                            /* if ($casillas[$fila][$tramo]['Materia']!=""){
                                        echo "<span class='textoenf'>".$casillas[$fila][$tramo]['Materia']."</span><br/>";
                                    } */
                                            echo "<strong>Grupo:</strong>" . $casillas[$fila][$tramo]['Unidad'] . " <strong>Aula:</strong>" . $aula . "</br>";
                                            if ($casillas[$fila][$tramo]['anotacion' . $tramo] != "") {
                                                echo "<span class='anotacion'>(" . $casillas[$fila][$tramo]['anotacion' . $tramo] . ")</span>";
                                            }
                                            // Sacar las horas de entrada y salida en los tramos 3 y 4

                                        } else {
                                            $porciones = explode(" ", $casillas[$fila][$tramo]['Actividad']);
                                            $iniciales = "";
                                            $bucle = 0;
                                            foreach ($porciones as $palabras) {
                                                $iniciales .= substr($palabras, 0, 1);
                                                $bucle++;
                                                if ($bucle > 3) {
                                                    break;
                                                }
                                            }
                                            echo "<div title='" . $casillas[$fila][$tramo]['Actividad'] . "' class='circulo'>" . $iniciales . "</div>";
                                            //echo "".substr($casillas[$fila][$tramo]['Actividad'],0,20)."</br>";
                                        }
                                    }
                                    //echo $casillas[$fila][$tramo]['Unidad'];
                                    echo  "</td>";
                                } else {
                                    echo "<td>";
                                    echo "";
                                    echo "</td>";
                                }
                            }
                            echo "</tr>";
                        }
                    }
                    // Poner los profesores de guardia de cada tramo    
                    echo "<tr class='peque'><td>Profesores de Guardia</br>(Orden de actuación)";

                    $tramo = 0;
                    foreach ($profGuardias as $prof) {
                        if ($tramo != $prof['tramo']) {
                            $tramo = $prof['tramo'];

                            if ($tramo == $tramoActivo) {
                                $horaActiva = "horaActiva";
                            } else {
                                $horaActiva = "";
                            }
                            echo "</td><td class='" . $horaActiva . "'>";
                        }
                        if ($prof['tramo'] == $tramo) {
                            $indice = array_search($prof['profesor'], array_column($profesores, 'Codigo'));
                            if (empty($profesores[$indice]['Sustituto'])) {
                                echo "<strong>(" . $prof['nguardias'] . ")</strong>" . $profesores[$indice]['Nombre'] . " " . $profesores[$indice]['Apellido1'] . "</br>";
                            } else {
                                echo "<strong>(" . $prof['nguardias'] . ")</strong>" . $profesores[$indice]['Sustituto'] . "</br>";
                            }
                        }
                    }
                    echo "</td></tr>";
                    // Poner los profesores de guardia de cada tramo    
                    echo "<tr class='peque'><td>Profesores que han hecho Guardia";
                    $tramo = 0;
                    foreach ($registro as $profg) {

                        if ($tramo != $profg['Tramo']) {
                            $numt = intval($profg['Tramo']) - intval($tramo);
                            for ($ind = 1; $ind <= $numt; $ind++) {
                                $tramo = $profg['Tramo'];
                                echo "</td><td>";
                            }
                        }
                        if ($profg['Tramo'] == $tramo) {
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
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('html, body').animate({
            scrollTop: $('#page-wrapper').get(0).scrollHeight
        }, 10000, );


        $("#fecha").on("change", function(evento) {

            location.href = "<? echo base_url(); ?>inicio/tvSala_dia/" + this.value;

        });
    </script>

</body>

</html>