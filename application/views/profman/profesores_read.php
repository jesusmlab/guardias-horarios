<!doctype html>
<html>

<head>
    <title>harviacode.com - codeigniter crud generator</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
    <style>
        body {
            padding: 15px;
        }
    </style>
</head>

<body>
    <h2 style="margin-top:0px">Profesores Read</h2>
    <table class="table">
        <tr>
            <td>TomaPosesion</td>
            <td><?php echo $TomaPosesion; ?></td>
        </tr>
        <tr>
            <td>Puesto</td>
            <td><?php echo $Puesto; ?></td>
        </tr>
        <tr>
            <td>Apellido1</td>
            <td><?php echo $Apellido1; ?></td>
        </tr>
        <tr>
            <td>Apellido2</td>
            <td><?php echo $Apellido2; ?></td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><?php echo $Nombre; ?></td>
        </tr>
        <tr>
            <td>Sustituto</td>
            <td><?php echo $Sustituto; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $Email; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><a href="<?php echo site_url('profman/index/'.$_SESSION['start']) ?>" class="btn btn-default">Cancelar</a></td>
        </tr>
    </table>
</body>

</html>