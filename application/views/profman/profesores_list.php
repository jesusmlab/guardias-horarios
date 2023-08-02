<style>
    .peque {
        font-size: 0.9em;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1">
                <?php echo anchor(site_url('profman/create'), 'Crear', 'class="btn btn-primary"'); ?>

            </div>
            <div class="col-md-4">
                <h4>Mantenimiento de Profesores</h4>
            </div>
            <div class="col-md-3 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>

            <div class="col-md-4 text-right">
                <form id="frmbusqueda" action="<?php echo site_url('profman/index'); ?>" class="form-inline" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                            if ($q <> '') {
                            ?>
                                <a href="<?php echo site_url('profman'); ?>" id="btnreset" class="btn btn-default">Reset</a>
                            <?php
                            }
                            ?>
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>Codigo</th>
                <th>TomaPosesion</th>
                <th>Puesto</th>
                <th>Apellido1</th>
                <th>Apellido2</th>
                <th>Nombre</th>
                <th>Sustituto</th>
                <th>Email</th>
                <th>Comando</th>
            </tr><?php
                    foreach ($profman_data as $profman) {
                    ?>
                <tr>
                    <td><?php echo $profman->Codigo ?></td>
                    <td><?php echo $profman->TomaPosesion ?></td>
                    <td><?php echo $profman->Puesto ?></td>
                    <td><?php echo $profman->Apellido1 ?></td>
                    <td><?php echo $profman->Apellido2 ?></td>
                    <td><?php echo $profman->Nombre ?></td>
                    <td><?php echo $profman->Sustituto ?></td>
                    <td><?php echo $profman->Email ?></td>
                    <td style="text-align:center" width="10%">
                        <?php
                        echo anchor(site_url('profman/update/' . $profman->Codigo), 'Actualizar');
                        echo ' | ';
                        echo anchor(site_url('profman/delete/' . $profman->Codigo), 'Borrar', 'onclick="javasciprt: return confirm(\'Estas seguro ?\')"');
                        ?>
                    </td>
                </tr>
            <?php
                    }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Registros : <?php echo $total_rows ?></a>
                <?php echo anchor(site_url('profman/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('profman/word'), 'Word', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
</div>
<script>
    $("#btnreset").on("click", function(evento) {
        evento.preventDefault();
        $("input[name='q'").val("");
        $("#frmbusqueda").submit();
    })
</script>