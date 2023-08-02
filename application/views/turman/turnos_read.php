<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Turnos Read</h2>
        <table class="table">
	    <tr><td>Profesor</td><td><?php echo $profesor; ?></td></tr>
	    <tr><td>Dia</td><td><?php echo $dia; ?></td></tr>
	    <tr><td>Tramo</td><td><?php echo $tramo; ?></td></tr>
	    <tr><td>Turno</td><td><?php echo $turno; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('turman') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>