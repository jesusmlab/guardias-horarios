<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Profesores</h3>
            </div>
            <div class="panel-body">
                <div class="col-xs-offset-3 col-xs-6 col-xs-offset-3">
                    <form action="<?php echo $action; ?>" method="post">
                        <div class="form-group">
                            <label for="varchar">Codigo <?php echo form_error('Codigo') ?></label>
                            <input type="text" <?php echo $button != "Crear" ? "readonly" : ""; ?> class="form-control" name="Codigo" id="Codigo" placeholder="Codigo" maxlength="9" value="<?php echo $Codigo; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">TomaPosesion <?php echo form_error('TomaPosesion') ?></label>
                            <input type="text" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])\/(0[1-9]|1[012])\/[0-9]{4}" class="form-control" name="TomaPosesion" maxlength="10" id="TomaPosesion" placeholder="dd/mm/aaaa" value="<?php echo $TomaPosesion; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Puesto <?php echo form_error('Puesto') ?></label>
                            <input type="text" maxlength="50" class="form-control" name="Puesto" id="Puesto" placeholder="Puesto que ocupa" value="<?php echo $Puesto; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Apellido1 <?php echo form_error('Apellido1') ?></label>
                            <input type="text" maxlength="25" class="form-control" name="Apellido1" id="Apellido1" placeholder="Primer apellido" value="<?php echo $Apellido1; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Apellido2 <?php echo form_error('Apellido2') ?></label>
                            <input type="text" maxlength="25" class="form-control" name="Apellido2" id="Apellido2" placeholder="Segundo apellido" value="<?php echo $Apellido2; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Nombre <?php echo form_error('Nombre') ?></label>
                            <input type="text" maxlength="25" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre" value="<?php echo $Nombre; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Sustituto <?php echo form_error('Sustituto') ?></label>
                            <input type="text" maxlength="50" class="form-control" name="Sustituto" id="Sustituto" placeholder="Sustituto" value="<?php echo $Sustituto; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Correo E. <?php echo form_error('Email') ?></label>
                            <input type="email" maxlength="300" class="form-control" name="Email" id="Email" placeholder="Correo Electrónico" value="<?php echo $Email; ?>" />
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                        <a href="<?php echo site_url('profman/index/'.$_SESSION['start']) ?>" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>