<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Profesores List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>TomaPosesion</th>
		<th>Puesto</th>
		<th>Apellido1</th>
		<th>Apellido2</th>
		<th>Nombre</th>
		<th>Sustituto</th>
		
            </tr><?php
            foreach ($profman_data as $profman)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $profman->TomaPosesion ?></td>
		      <td><?php echo $profman->Puesto ?></td>
		      <td><?php echo $profman->Apellido1 ?></td>
		      <td><?php echo $profman->Apellido2 ?></td>
		      <td><?php echo $profman->Nombre ?></td>
		      <td><?php echo $profman->Sustituto ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>