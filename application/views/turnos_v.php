<style>
    .cabecera-tabla {
        width: 20%;
    }

    .peque {
        font-size: 0.9em;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <?
        
            // Inicializar Matriz casillas
            for ($columna=1;$columna<6;$columna++){
                for ($tramo=1;$tramo<=6;$tramo++){
                    $casillas[$columna][$tramo][0]="";        
                }
            }
            // Igualar casillas a contenido del horario

            foreach ($turnos as $turno){
                // echo "dia:".$turno['dia']." tramo:".$turno['tramo']." turno:".$turno['turno']."<br>";
                $casillas[$turno['dia']][$turno['tramo']][$turno['turno']]=$turno;
            }  
            
            ?>
            <div class="panel panel-primary">
                <!-- Contenido del panel -->
                <div class="panel-heading">Turnos de Guardia semana <?php echo date("W"); ?>
                    <button type="button" class="btn btn-default" onclick="window.print();"> Imprimir</button>
                </div>

                <div class="panel-body">
                    <table class="table peque table-bordered table-responsive">
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
                                $tabla="";
                                    for ($tramo=1;$tramo<=6;$tramo++){
                                        $tabla.="<tr>";
                                        $tabla.="<th>".$tramosHorarios[$tramo-1]['Inicio']." - ".$tramosHorarios[$tramo-1]['Fin']."</th>";
                                        for ($columna=1;$columna<6;$columna++){
                                            $tabla.="<td class='celda-horario'>";
                                            if (isset($casillas[$columna][$tramo][1])) {
                                            for ($contador=1;$contador<=6;$contador++){
                                                    if (isset($casillas[$columna][$tramo][$contador])) {
                                                        $indice = array_search($casillas[$columna][$tramo][$contador]['profesor'], array_column($profesores, 'Codigo'));
                                                        if (empty($profesores[$indice]['Sustituto'])){
                                                        $tabla.="<strong>(".$casillas[$columna][$tramo][$contador]['turno'].")</strong>".$profesores[$indice]['Nombre']." ".$profesores[$indice]['Apellido1']."<br/>"; //." ".$profesores[$indice]['Apellido2']."<br/>";
                                                    }else {
                                                        $tabla.="<strong>(".$casillas[$columna][$tramo][$contador]['turno'].")</strong>".$profesores[$indice]['Sustituto']."<br/>";    
                                                    }
                                                }  
                                                }
                                            } else {
                                                $tabla.="Nada";
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
            </div>

    </div>
</div>
<script>
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        location.href = "<? echo base_url(); ?>turnos/index_m";
    }
</script>