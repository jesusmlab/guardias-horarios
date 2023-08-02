<style>
    table {
        border-collapse: collapse;
        font-size: 1.2em;
        text-align: center;
        margin-left: 10px;
    }

    table,
    th,
    td {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
    }

    .tramo {
        width: 5%;
    }

    .colprofe {
        width: 20%;
    }

    .colgrupo {
        width: 15%;
    }

    .colobserv {
        width: 40%;
    }

    .colfirma {
        width: 20%;
    }

    /* Texto enfatizado para la Materia */
    .textoenf {
        font-weight: 600;
        font-size: 1.2em;
        margin: 3px;

    }
</style>
<?php
$fechasel= $this->uri->segment(3, "");
if ($fechasel==""){
    $fecha=date("Y-m-d");
} else {
    $fecha = new DateTime($fechasel);
}

?>
<br /><br />
<div class="textoenf">Parte de firmas de Guardias del día <?php echo $fecha->format('d-m-Y'); ?></div>
<br />
<table>
    <thead>
        <tr>
            <th class="coltramo">Tramo</th>
            <th class="colprofe">Profesor</th>
            <th class="colgrupo">Grupo y Aula</th>
            <th class="colobserv">Observaciones</th>
            <th class="colfirma">Firma</th>
        </tr>

    </thead>
    <tbody>
        <?
$tabla="";			
$tramo=1;  
$tabla.= "<tr><td>".$tramo."</td><td>";
foreach ($profGuardias as $prof){
    if ($prof['tramo']!=$tramo){
        $tramo=$prof['tramo'];
        $tabla.= "</td><td></td><td></td><td></td><tr><td>".$tramo."</td><td>";   
    }
    $indice = array_search($prof['profesor'], array_column($profesores, 'Codigo'));
    if (empty($profesores[$indice]['Sustituto'])){
        $tabla.= "<span>".$profesores[$indice]['Nombre']." ".$profesores[$indice]['Apellido1']."</span><br/>";
    } else {
        $tabla.= "<span>".$profesores[$indice]['Sustituto']."</span><br/>";    
    }   
}
echo $tabla;
?>
        </td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
    </tbody>
</table>