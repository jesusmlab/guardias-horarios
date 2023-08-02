<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    <?php
                        $desdef = new DateTime($this->input->post('desdefecha'));
                        $hastaf = new DateTime($this->input->post('hastafecha'));
                        $profsel=$this->input->post('profesor');
                        if ($profsel=="%%"){
                            $profsel="";
                        }
                        
                    ?>
                    <div class="panel-title">Informe de Faltas desde <?php echo $desdef->format('d-m-Y')." hasta ".$hastaf->format('d-m-Y') ; ?>
                        <button type="button" class="btn btn-default" onclick="window.print();"> Imprimir</button>
                        <?php echo anchor(site_url('faltas/excel/'.$this->input->post('desdefecha')."/".$this->input->post('hastafecha')."/".$profsel), 'Excel', 'role="button" class="btn btn-default" style="color:black"'); ?>
                    </div>
                    </div>
                    <div class="panel-body">
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th class="cabecera-tabla">Fecha</th>
                                <th class="cabecera-tabla">Profesor</th>
                                <th class="cabecera-tabla">Horas</th>
                                <th class="cabecera-tabla">Causa</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (!empty($faltas)) {
                                $tabla="";
                                foreach ($faltas as $item_falta){
                                    $date = new DateTime($item_falta['fecha']);
                                    $tabla.="<tr>";
                                    $tabla.="<td>".$date->format('d-m-Y')."</td>";
                                    if ($item_falta['sustituto']==""){
                                        $tabla.="<td>".$item_falta['apenom']."</td>";
                                    } else {
                                        $tabla.="<td>".$item_falta['sustituto']."</td>";
                                    }
                                    $tabla.="<td>".$item_falta['tramos']."</td>";
                                    $tabla.="<td>".$item_falta['descripcion']."</td>";
                                    $tabla.="</tr>";
                                }
                                echo $tabla;
                            }
                            ?>
                        </tbody>
                    </table>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
   
</script>