<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Informe de Faltas</h3>
                    </div>
                    <div class="panel-body">

                        <form name="frminforme" class="form-horizontal"
                            action="<?php echo base_url(); ?>faltas/informe_faltas" method="post">
                            <div class="form-group">
                                <label for="desdefecha" class="col-xs-2">Desde fecha:</label>
                                <div class="col-xs-4">
                                    <input type="date" class="form-control" id="desdefecha" name="desdefecha" value=""
                                        placeholder="Fecha">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="hastafecha" class="col-xs-2">Hasta fecha:</label>
                                <div class="col-xs-4">
                                    <input type="date" class="form-control" id="hastafecha" name="hastafecha" value=""
                                        placeholder="Fecha">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cmbprofesor" class="col-xs-2">Profesor:</label>
                                <div class="col-xs-6">
                                    <select id="cmbprofesor" data-live-search="true" class="form-control selectpicker"
                                        name="profesor">
                                        <?php
                                        
                                            $cadena="<option value='%%'>Todos</option>";
                                            foreach ($profesores as $profe){
                                            if (empty($profe['Sustituto'])){
                                                $cadena.="<option value='".$profe['Codigo']."'>".$profe['Apellido1']." ".$profe['Apellido2'].",".$profe['Nombre']."</option>";
                                            } else {
                                                $cadena.="<option value='".$profe['Codigo']."'>".$profe['Sustituto']."</option>";  
                                            }
                                                
                                            }
                                            echo $cadena;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="cmbcausa" class="col-xs-2">Causa:</label>
                            <div class="col-xs-6">
                                <select id="cmbcausa" class="form-control" name="causa">
                                    <?php
                                        
                                        $cadena="<option value='%%'>Todas</option>";
                                        foreach ($causas as $causa){
                                            $cadena.="<option value='".$causa['codigo']."'>".$causa['descripcion']."</option>";
                                        }
                                        echo $cadena;
                                    ?>
                                </select>
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    <button type="submit" class="btn btn-primary">Imprimir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <h4>Ranking de Faltas</h4>
                <table class="table table-bordered table-responsive table-condensed">
                    <thead>
                        <tr>
                            <th class="cabecera-tabla">Profesor</th>
                            <th class="cabecera-tabla">Apellidos y Nombre</th>
                            <th class="cabecera-tabla">Total Faltas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($clasiffaltas)){
                                if (count($clasiffaltas)>0){
                                    foreach ($clasiffaltas as $falta) {
                                        echo ' <tr>
                                            <td>'.$falta['profesor'].'</td>
                                            <td>'.$falta["apenom"].'</td>
                                            <td style="text-align:right">'.$falta["totalf"].'</td>
                                        </tr>';
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-6">
                <h4>Ranking de Guardias</h4>
                <table class="table table-bordered table-responsive table-condensed">
                    <thead>
                        <tr>
                            <th class="cabecera-tabla">Profesor</th>
                            <th class="cabecera-tabla">Apellidos y Nombre</th>
                            <th class="cabecera-tabla">Total Guardias</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($clasifguardias)){
                                if (count($clasifguardias)>0){
                                    foreach ($clasifguardias as $guardia) {
                                        echo ' <tr>
                                            <td>'.$guardia['Profesor'].'</td>
                                            <td>'.$guardia["apenom"].'</td>
                                            <td style="text-align:right">'.$guardia["totalg"].'</td>
                                        </tr>';
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

</script>