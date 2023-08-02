<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Profesor:
                    <?php 
                    if ($button=='Crear'){
                        $CodigoProf=$_SESSION['q'];
                    } 
                       
                        $indice = array_search($CodigoProf, array_column($profesores, 'Codigo'));
                        if (empty($profesores[$indice]['Sustituto'])) {
                        echo $indice === FALSE ? "" : $profesores[$indice]['Apellido1']." ".$profesores[$indice]['Apellido2'].",".$profesores[$indice]['Nombre'];
                        } else {
                            echo $indice === FALSE ? "" : $profesores[$indice]['Sustituto'];    
                        }
                    
                    ?>
                </h3>
            </div>
            <div class="panel-body">
                <div class="col-xs-offset-3 col-xs-6 col-xs-offset-3">
                    <form action="<?php echo $action; ?>" method="post">
                        <input type="hidden" name="CodigoProf" value="<?php echo $CodigoProf; ?>" />
                        <div class="form-group">
                            <label for="varchar">Dia de la Semana
                                <?php echo form_error('DiaSem') ?>
                            </label>
                            <select name="DiaSem" id="DiaSem" class="form-control">
                                <?php
                            $diasSemana=['1'=>'Lunes','2'=>'Martes','3'=>'Miercoles','4'=>'Jueves','5'=>'Viernes'];
                            $cadena="";
                            foreach ($diasSemana as $clave=>$dia){
                                if ($DiaSem==$clave){
                                    $cadena.="<option selected value='".$clave."'>".$dia."</option>";
                                } else {
                                    $cadena.="<option value='".$clave."'>".$dia."</option>";
                                }
                            }
                            echo $cadena;
                        ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="varchar">Tramo Horario
                                <?php echo form_error('Tramo') ?>
                            </label>
                            <select name="Tramo" id="Tramo" class="form-control">
                                <?php

                            $cadena="";
                            foreach ($tramos_horarios as $item){
                                $horaIni=intval($item['Inicio']/60);
                                $minutosIni=$item['Inicio'] - ($horaIni*60);
                                
                                $horaIni=str_repeat("0",2-strlen(strval($horaIni))).strval($horaIni);
                                $minutosIni=str_repeat("0",2-strlen(strval($minutosIni))).strval($minutosIni);

                                $horaFin=intval($item['Fin']/60);
                                $minutosFin=$item['Fin'] - ($horaFin*60);
                                
                                $horaFin=str_repeat("0",2-strlen(strval($horaFin))).strval($horaFin);
                                $minutosFin=str_repeat("0",2-strlen(strval($minutosFin))).strval($minutosFin);

                                if ($Tramo==$item['Codigo']){
                                    $cadena.="<option selected value='".$item['Codigo']."'>".$item['Tramo']." ".$horaIni.":".$minutosIni." - ".$horaFin.":".$minutosFin."</option>";
                                } else {
                                    $cadena.="<option value='".$item['Codigo']."'>".$item['Tramo']." ".$horaIni.":".$minutosIni." - ".$horaFin.":".$minutosFin."</option>";
                                }
                            }
                            echo $cadena;
                        ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="varchar">Actividad
                                <?php echo form_error('Actividad') ?>
                            </label>
                            <select name="Actividad" id="Actividad" class="form-control">
                                <?php

                            $cadena="";
                            foreach ($actividades as $item){
                                if ($Actividad==$item['Codigo']){
                                    $cadena.="<option selected value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                                } else {
                                    $cadena.="<option value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                                }
                            }
                            echo $cadena;
                        ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="varchar">Aula
                                <?php echo form_error('Aula') ?>
                            </label>
                            <select name="Aula" id="Aula" class="form-control">
                                <?php

                            $cadena="";
                            foreach ($aulas as $item){
                                if ($Aula==$item['Codigo']){
                                    $cadena.="<option selected value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                                } else {
                                    $cadena.="<option value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                                }
                            }
                            echo $cadena;
                        ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="varchar">Grupo
                                <?php echo form_error('Unidad') ?>
                            </label>
                            <select name="Unidad" id="Unidad" class="form-control">
                                <?php

                            $cadena="";
                            foreach ($grupos as $item){
                                if ($Unidad==$item['Codigo']){
                                    $cadena.="<option selected value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                                } else {
                                    $cadena.="<option value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                                }
                            }
                            echo $cadena;
                        ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="varchar">Curso
                                <?php echo form_error('Curso') ?>
                            </label>
                            <select name="Curso" id="Curso" class="form-control">
                                <?php

                            $cadena="";
                            foreach ($cursos as $item){
                                if ($Curso==$item['Codigo']){
                                    $cadena.="<option selected value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                                } else {
                                    $cadena.="<option value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                                }
                            }
                            echo $cadena;
                        ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="varchar">Materia
                                <?php echo form_error('Materia') ?>
                            </label>
                            <select name="Materia" id="Materia" class="form-control">
                                <?php

                            $cadena="";
                            foreach ($materias as $item){
                                if ($Materia==$item['Codigo']){
                                    $cadena.="<option selected value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                                } else {
                                    $cadena.="<option value='".$item['Codigo']."'>".$item['Descripcion']."</option>";
                                }
                            }
                            echo $cadena;
                        ?>
                            </select>
                        </div>
                        <input type="hidden" name="Id" value="<?php echo $Id; ?>" />
                        <button type="submit" class="btn btn-primary">
                            <?php echo $button ?>
                        </button>
                        <a href="<?php echo site_url('horman/index/'.$_SESSION['start']) ?>" class="btn btn-default">Cancelar</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    let au = "";
    let un = "";
    let cu = "";
    let ma = "";

    $("#Actividad").on("change", function (evento) {
        if (this.value != 1) {
            // Salvar Campos que solo son de Docencia
            au = $("#Aula").val();
            un = $("#Unidad").val();
            cu = $("#Curso").val();
            ma = $("#Materia").val();
            // Acerar Campos que solo son de Docencia
            $("#Aula").val("");
            $("#Unidad").val("");
            $("#Curso").val("");
            $("#Materia").val("");
            // Desabilitarlos
            $("#Aula").prop("disabled", "true");
            $("#Unidad").prop("disabled", "true");
            $("#Curso").prop("disabled", "true");
            $("#Materia").prop("disabled", "true");
        } else {
            // Restaurar Campos que solo son de Docencia
            $("#Aula").val(au);
            $("#Unidad").val(un);
            $("#Curso").val(cu);
            $("#Materia").val(ma);
            // Desabilitarlos
            $("#Aula").removeAttr("disabled");
            $("#Unidad").removeAttr("disabled");
            $("#Curso").removeAttr("disabled");
            $("#Materia").removeAttr("disabled");
        }
    });
</script>