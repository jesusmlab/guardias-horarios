<style>
    .peque {
        font-size: 0.9em;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1">
                <?php echo anchor(site_url('horman/create'),'Crear', 'class="btn btn-primary" title="Para crear una nueva entrada, buscar antes el profesor" data-toggle="tooltip"'); ?>

            </div>
            <div class="col-md-4">
                <h4>Mantenimiento de Horarios</h4>
            </div>
            <div class="col-md-3 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>

            <div class="col-md-4 text-right">
                <form id="frmbusqeda" action="<?php echo site_url('horman/index'); ?>" class="form-inline" method="post">
                    <div class="input-group">
                        <select id="q" name="q" data-live-search="true" class="form-control selectpicker">
                            <?php
                                    // Si hay seleccionado uno ponerle por defecto en el select
                                    $cadena="";
                                    $cadena.="<option value=''>Todos</option>";
                                    foreach ($profesores as $profe){
                                        if ($q==$profe['Codigo']){
                                            if (empty($profe['Sustituto'])) {
                                            $cadena.="<option selected value='".$profe['Codigo']."'>".$profe['Apellido1']." ".$profe['Apellido2'].",".$profe['Nombre']."</option>";
                                            } else {
                                                $cadena.="<option selected value='".$profe['Codigo']."'>".$profe['Sustituto']."</option>";    
                                            }
                                        } else {
                                            if (empty($profe['Sustituto'])) {
                                            $cadena.="<option value='".$profe['Codigo']."'>".$profe['Apellido1']." ".$profe['Apellido2'].",".$profe['Nombre']."</option>";
                                            } else {
                                            $cadena.="<option value='".$profe['Codigo']."'>".$profe['Sustituto']."</option>";    
                                        }
                                        }
                                    }
                                    echo $cadena;
                                ?>
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table peque table-bordered" style="margin-bottom: 10px">
            <tr>
                <!-- <th>No</th> -->
                <th>Profesor</th>
                <th>DiaSem</th>
                <th>Tramo</th>
                <th>Actividad</th>
                <th>Aula</th>
                <th>Grupo</th>
                <th>Curso</th>
                <th>Materia</th>
                <th>Comando</th>
            </tr>
            <?php
            $diasSemana=['1'=>'Lun','2'=>'Mar','3'=>'Mie','4'=>'Jue','5'=>'Vie'];
            foreach ($horman_data as $horman)
            {
                ?>
                <!-- <tr>
			<td width="80px"><?php // echo ++$start ?></td> -->
                <td>
                    <?php 
            $indice = array_search($horman->CodigoProf, array_column($profesores, 'Codigo'));
            echo $indice === FALSE ? "" : $profesores[$indice]['Apellido1']." ".$profesores[$indice]['Apellido2'].",".$profesores[$indice]['Nombre'];    //$horman->CodigoProf 
            ?>
                </td>
                <td>
                    <?php 
            echo $diasSemana[$horman->DiaSem]; // $horman->DiaSem ?>
                </td>
                <td>
                    <?php 
            $indice = array_search($horman->Tramo, array_column($tramos_horarios, 'Codigo'));
            echo $indice === FALSE ? "" : $tramos_horarios[$indice]['Tramo']; //$horman->Tramo 
            ?>
                </td>
                <td>
                    <?php
            $indice = array_search($horman->Actividad, array_column($actividades, 'Codigo'));
            echo $indice === FALSE ? "" : $actividades[$indice]['Descripcion']; // $horman->Actividad 
            ?>
                </td>
                <td>
                    <?php 
            $indice = array_search($horman->Aula, array_column($aulas, 'Codigo'));
            $pos = strpos($aulas[$indice]['Descripcion'], " ");
            $au=substr($aulas[$indice]['Descripcion'], 0, $pos);
            echo $indice === FALSE ? "" : $au; //$horman->Aula 
            ?>
                </td>
                <td>
                    <?php
            $indice = array_search($horman->Unidad, array_column($grupos, 'Codigo'));
            echo $indice === FALSE ? "" : $grupos[$indice]['Descripcion']; // $horman->Unidad 
            ?>
                </td>
                <td>
                    <?php
            $indice = array_search($horman->Curso, array_column($cursos, 'Codigo'));
            echo $indice === FALSE ? "" : $cursos[$indice]['Descripcion']; // $horman->Curso 
            ?>
                </td>
                <td>
                    <?php
            $indice = array_search($horman->Materia, array_column($materias, 'Codigo'));
            echo $indice === FALSE ? "" : $materias[$indice]['Descripcion']; //$horman->Materia 
            ?>
                </td>
                <td style="text-align:center" width="10%">
                    <?php 
				/* echo anchor(site_url('horman/read/'.$horman->Id),'Leer'); 
				echo ' | ';  */
				echo anchor(site_url('horman/update/'.$horman->Id),'Actualizar'); 
				echo ' | '; 
				echo anchor(site_url('horman/delete/'.$horman->Id),'Borrar','onclick="javasciprt: return confirm(\'Estas seguro/a ?\')"'); 
				?>
                </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Registros:
                    <?php echo $total_rows ?>
                </a>
                <?php echo anchor(site_url('horman/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('horman/word'), 'Word', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        <script>
            $("#q").on("change", function (evento) {
                $("#frmbusqeda").submit();
            });
        </script>
    </div>
</div>