<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Profesores</h3>
            </div>
            <div class="panel-body">
                <div class="col-xs-offset-3 col-xs-6 col-xs-offset-3">
                    <h2 style="margin-top:0px">Turnos
                        <?php echo $button ?>
                    </h2>
                    <form action="<?php echo $action; ?>" method="post">
                        <?php 
                    $diasSemana=['1'=>'Lun','2'=>'Mar','3'=>'Mie','4'=>'Jue','5'=>'Vie'];
                    $tramos=['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7']
                    ?>
                        <div class="form-group">
                            <label for="varchar">Dia
                                <?php echo form_error('dia') ?>
                            </label>
                            <select class="form-control" name="dia" id="dia">
                                <?php
                            $cadena="";
                            foreach ($diasSemana as $clave=>$d){
                                if ($dia==$clave){
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
                            <label for="varchar">Tramo
                                <?php echo form_error('tramo') ?>
                            </label>
                            <select class="form-control" name="tramo" id="tramo">
                                <?php
                            $cadena="";
                            foreach ($tramos as $clave=>$t){
                                if ($tramo==$clave){
                                $cadena.="<option selected value='".$clave."'>".$clave."</option>";
                                } else {
                                $cadena.="<option value='".$clave."'>".$clave."</option>";
                                } 
                            }
                            echo $cadena;
                        ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="int">Turno
                                <?php echo form_error('turno') ?>
                            </label>
                            <input type="number" class="form-control" name="turno" id="turno" placeholder="Turno" value="<?php echo $turno; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Profesor
                                <?php echo form_error('profesor') ?>
                            </label>
                            <select id="cmbprofesor" class="form-control" name="profesor">
                                <?php
                                       
                                        $cadena="";
                                        foreach ($profesores as $profe){
                                           if ($profesor==$profe['Codigo']){
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
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <button type="submit" class="btn btn-primary">
                            <?php echo $button ?>
                        </button>
                        <a href="<?php echo site_url('turman/index/'.$_SESSION['start']) ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div