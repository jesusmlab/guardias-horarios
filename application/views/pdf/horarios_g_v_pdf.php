<style>
    .cabecera-tabla {

        font-size: 1.2em;
        text-align: center;
    }

    table {
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
    }

    /* Texto enfatizado para la Materia */
    .textoenf {
        background-color: #000;
        color: #FFF;
        font-size: 1.2em;
        border-radius: 5px;
    }
</style>

<!-- Contenido -->

<div style="font-size:1.2em; font-weight: bold;">Horario del Grupo <?php echo $grupo_corr."<br>"; ?></div>

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

<table>
    <thead>
        <tr>
            <th style="font-size: 1.2em;text-align: center;width:10%">Tramo</th>
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
            for ($tramo=$dTramo;$tramo<=$hTramo;$tramo++){
                $tabla.="<tr>";
                //$tabla.="<th>".$tramosHorarios[$tramo]['Inicio']." - ".$tramosHorarios[$tramo]['Fin']."</th>";
                $hora="";
                for ($fi=1;$fi<6;$fi++){
                        if (!empty($casillas[$fi][$tramo][0]['Inicio'])) {
                        $hora=$casillas[$fi][$tramo][0]['Inicio']." - ".$casillas[$fi][$tramo][0]['Fin'];
                        break; 
                    }  
                }
                
                $tabla.="<th style=\"text-align: center;width:10%\">".$hora."</th>";
                
                for ($fila=1;$fila<6;$fila++){
                    $tabla.="<td class='celda-horario'>";
                    $nfilas=count($casillas[$fila][$tramo]);
                    for ($ind=0;$ind<$nfilas;$ind++){
                        if (is_array($casillas[$fila][$tramo][$ind])) {
                            if ($casillas[$fila][$tramo][$ind]['Actividad']!="Docencia"){
                                $tabla.="<strong>Actividad:</strong>".$casillas[$fila][$tramo][$ind]['Actividad']."<br/>";
                            } 
                            
                            if ($casillas[$fila][$tramo][$ind]['Materia']!=""){
                                $tabla.="<span style=\"background-color: #000;color: #FFF;font-size: 1.2em;padding:5px;border-radius: 5px;\">".$casillas[$fila][$tramo][$ind]['Materia']."</span><br/>";
                            }
                            if ($casillas[$fila][$tramo][$ind]['Apenom']!=""){
                                $tabla.=$casillas[$fila][$tramo][$ind]['Apenom']."<br/>";
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
<? 
}
?>
<table id="tablaM">
    <thead>
        <tr>
            <th
                style="text-align: center;width:25%; background-color: #000;color: #FFF;padding: 5px;border-radius: 5px;">
                Materias de <?php echo $grupo_corr; ?> </th>
            <th
                style="text-align: center;width:10%; background-color: #000;color: #FFF;padding: 5px;border-radius: 5px;">
                Nº Sesiones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $tabla="";
                foreach ($estadisM as $item){
                    if ($item['Materia']!=null) {
                        $tabla.="<tr>";
                        $tabla.="<td style=\"text-align: center;width:25%\">".$item['Materia']."</td>";
                        $tabla.="<td style=\"text-align: center;width:10%\">".$item['numero']."</td>";
                        $tabla.="</tr>";
                    } 
                }
            echo $tabla;
        ?>
    </tbody>
</table>