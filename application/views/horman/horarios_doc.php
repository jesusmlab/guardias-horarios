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
        <h2>Horarios List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>CodigoProf</th>
		<th>DiaSem</th>
		<th>Tramo</th>
		<th>Aula</th>
		<th>Unidad</th>
		<th>Curso</th>
		<th>Materia</th>
		<th>Hinicio</th>
		<th>Hfin</th>
		<th>Actividad</th>
		
            </tr><?php
            foreach ($horman_data as $horman)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $horman->CodigoProf ?></td>
		      <td><?php echo $horman->DiaSem ?></td>
		      <td><?php echo $horman->Tramo ?></td>
		      <td><?php echo $horman->Aula ?></td>
		      <td><?php echo $horman->Unidad ?></td>
		      <td><?php echo $horman->Curso ?></td>
		      <td><?php echo $horman->Materia ?></td>
		      <td><?php echo $horman->Hinicio ?></td>
		      <td><?php echo $horman->Hfin ?></td>
		      <td><?php echo $horman->Actividad ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>