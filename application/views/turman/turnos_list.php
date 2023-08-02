<style>
    .peque {
        font-size: 0.9em;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1">
                <?php echo anchor(site_url('turman/create'),'Crear', 'class="btn btn-primary"'); ?>

            </div>
            <div class="col-md-3">
                <h4>Mantenimiento de Turnos</h4>
            </div>
            <div class="col-md-3">
                <!-- <div style="margin-top: 8px" id="message">
                         <?php //echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div> -->

                <div class="row">
                    <div class="col-xs-12">
                        <form id="frmfiltro" action="<?php echo site_url('turman/index'); ?>" class="form-inline"
                            method="post">
                            <?php 
                                $diasSemana=['1'=>'Lun','2'=>'Mar','3'=>'Mie','4'=>'Jue','5'=>'Vie'];
                                $tramos=['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7']
                                ?>
                            <div class="form-group">
                                <label for="varchar">Dia</label>
                                <select class="form-control" name="di" id="di">
                                    <?php
                                    $cadena="";
                                    foreach ($diasSemana as $clave=>$d){
                                        if ($di==$clave){
                                        $cadena.="<option selected value='".$clave."'>".$d."</option>";
                                        } else {
                                        $cadena.="<option value='".$clave."'>".$d."</option>";
                                        } 
                                    }
                                    echo $cadena;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="varchar">Tramo</label>
                                <select class="form-control" name="tr" id="tr">
                                    <?php
                                    $cadena="";
                                    foreach ($tramos as $clave=>$t){
                                        if ($ti==$clave){
                                        $cadena.="<option selected value='".$clave."'>".$t."</option>";
                                        } else {
                                        $cadena.="<option value='".$clave."'>".$t."</option>";
                                        } 
                                    }
                                    echo $cadena;
                                    ?>
                                </select>
                                <button class="btn btn-primary" type="submit">Filtro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <a href="<?php echo site_url('turnos/renumerarTurnos'); ?>" class="btn btn-default">Renumerar Turnos</a>
            </div>
            <div class="col-md-3 text-right">
                <form id="frmbusqueda" action="<?php echo site_url('turman/index'); ?>" class="form-inline"
                    method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                            <a href="<?php echo site_url('turman'); ?>" id="btnreset" class="btn btn-default">Reset</a>
                            <?php
                                }
                            ?>
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-condensed table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>Dia</th>
                <th>Tramo</th>
                <th>Turno</th>
                <th>Profesor</th>
                <th>Cambiar</th>
                <th>Comando</th>
            </tr>
            <?php
            $diasSemana=['1'=>'Lunes','2'=>'Martes','3'=>'Miércoles','4'=>'Jueves','5'=>'Viernes'];
            foreach ($turman_data as $turman)
            {
                ?>
            <tr>
                <td>
                    <?php echo $diasSemana[$turman->dia] ?>
                </td>
                <td>
                    <?php echo $turman->tramo ?>
                </td>
                <td>
                    <?php echo $turman->turno ?>
                </td>
                <td>
                    <?php 
             $indice = array_search($turman->profesor, array_column($profesores, 'Codigo'));
             if (empty($profesores[$indice]['Sustituto'])) {
             $n=$profesores[$indice]['Apellido1']." ".$profesores[$indice]['Apellido2'].",".$profesores[$indice]['Nombre'];
             } else {
                $n=$profesores[$indice]['Sustituto'];  
             }
             echo $indice === FALSE ? "" : $n;  
            ?>

                </td>
                <td style="text-align:center">
                    <a id="subir"
                        href="<?php echo base_url(); ?>turman/subir/<?php echo $turman->id.'/'.$turman->turno ?>">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                    <a id="bajar"
                        href="<?php echo base_url(); ?>turman/bajar/<?php echo $turman->id.'/'.$turman->turno ?>">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                </td>
                <td style="text-align:center" width="20%">
                    <?php
				echo anchor(site_url('turman/update/'.$turman->id),'Actualizar'); 
				echo ' | '; 
				echo anchor(site_url('turman/delete/'.$turman->id),'Borrar','onclick="javasciprt: return confirm(\'Estas seguro ?\')"'); 
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
                <?php echo anchor(site_url('turman/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('turman/word'), 'Word', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
</div>
<script>
    $("#btnreset").on("click", function (evento) {
        evento.preventDefault();
        $("input[name='q'").val("");
        $("#frmbusqueda").submit();
    })
</script>