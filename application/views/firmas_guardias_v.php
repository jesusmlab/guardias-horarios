<style>
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
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <!-- Contenido del panel -->
            <?php
                $fechasel= $this->uri->segment(3, "");
                if ($fechasel==""){
                    $fecha=date("Y-m-d");
                } else {
                    $fecha = new DateTime($fechasel);
                }

               ?>
            <div class="panel-heading">Parte de firmas de Guardias del día <?php echo $fecha->format('d-m-Y'); ?>

                <button type="button" class="btn btn-default" onclick="window.print();"> Imprimir</button>

            </div>
            <div class="panel-body">
                <div class="col-xs-12">
                    <table class="table peque table-bordered">
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
                                $tabla.= "<span>".$profesores[$indice]['Nombre']." ".$profesores[$indice]['Apellido1']."  </span><input type='checkbox'><br/>";
                            } else {
                                $tabla.= "<span>".$profesores[$indice]['Sustituto']."  </span><input type='checkbox'><br/>";    
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
                    <div class="textoenf">* Solo deben firmar los profesores que hayan hecho guardia</div>
                </div>
            </div>
        </div>
    </div>
</div>