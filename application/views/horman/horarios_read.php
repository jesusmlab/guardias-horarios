<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bs/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Horarios Read</h2>
        <table class="table">
	    <tr><td>CodigoProf</td><td><?php echo $CodigoProf; ?></td></tr>
	    <tr><td>DiaSem</td><td><?php echo $DiaSem; ?></td></tr>
	    <tr><td>Tramo</td><td><?php echo $Tramo; ?></td></tr>
	    <tr><td>Aula</td><td><?php echo $Aula; ?></td></tr>
	    <tr><td>Unidad</td><td><?php echo $Unidad; ?></td></tr>
	    <tr><td>Curso</td><td><?php echo $Curso; ?></td></tr>
	    <tr><td>Materia</td><td><?php echo $Materia; ?></td></tr>
	    <tr><td>Hinicio</td><td><?php echo $Hinicio; ?></td></tr>
	    <tr><td>Hfin</td><td><?php echo $Hfin; ?></td></tr>
	    <tr><td>Actividad</td><td><?php echo $Actividad; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('horman') ?>" class="btn btn-default">Cancelar</a></td></tr>
	</table>
        </body>
</html>