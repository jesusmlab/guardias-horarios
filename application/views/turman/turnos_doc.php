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
        <h2>Turnos List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Profesor</th>
		<th>Dia</th>
		<th>Tramo</th>
		<th>Turno</th>
		
            </tr><?php
            foreach ($turman_data as $turman)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $turman->profesor ?></td>
		      <td><?php echo $turman->dia ?></td>
		      <td><?php echo $turman->tramo ?></td>
		      <td><?php echo $turman->turno ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>