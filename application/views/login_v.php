<style>
    .bordeado {
        border: 1px solid black;
        border-radius: 5px;
        padding: 1em;
    }
</style>
<div id="container">
    <div class="col-xs-12 text-center">
        <h1>Guardias y Horarios</h1>
    </div>
    <div class="col-xs-1 col-sm-4">
    </div>
    <div class="col-xs-10 col-sm-4 bordeado">
        <form id="flogin" action="<? echo base_url(); ?>login/login" method="post">
            <div class="form-group <?php if(form_error('usuario')){echo 'has-error';} ?>">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" autofocus maxlength="20" name="usuario" placeholder="Entrar nombre de Usuario" value="<?php echo set_value('usuario'); ?>">
                <? echo form_error('usuario' ,'<div class="help-block">', '<span class="glyphicon glyphicon-exclamation-sign"></span></div>'); ?>
            </div>
            <div class="form-group <?php if(form_error('clave')){echo 'has-error';} ?>">
                <label for="clave">Clave</label>
                <input type="password" class="form-control" id="clave" name="clave" placeholder="Entrar la Clave">
                <? echo form_error('clave', '<div class="help-block">', '</div>'); ?>
            </div>
            <button type="submit" class="btn btn-default">Entrar</button>
        </form>
    </div>
    <div class="col-xs-1 col-sm-4">
    </div>
</div>
