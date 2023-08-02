<!DOCTYPE html>
<style type='text/css'>
    body {
        font-family: Arial;
        font-size: 14px;
    }

    a {
        color: blue;
        text-decoration: none;
        font-size: 14px;
    }

    a:hover {
        text-decoration: underline;
    }

    .header img {
        float: left;
        width: 70px;
    }

    .header h1 {
        position: relative;
        top: 18px;
        left: 10px;
    }

    .form-horizontal .control-label {
        text-align: left !important;
    }

    .verde {
        color: forestgreen;
    }

    .rojo {
        color: orangered;
    }

    .table td,
    .table th {
        text-align: center;
    }

    .izda {
        float: left;
    }

    .dcha {
        float: right;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-xs-12 col-md-offset-3 col-md-6 col-md-offset-3">

                <div class="well">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#perfil" data-toggle="tab">Perfil</a>
                        </li>
                        <li>
                            <a href="#clave" data-toggle="tab">Cambiar Clave</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="perfil">
                            <form class="form-horizontal" id="tab" action="<? echo base_url(); ?>login/cambiar_perfil" method="post">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Usuario:</label>
                                    <div class="col-sm-8">
                                        <input name="usuario" type="text" value="<? echo $usuario->usuario; ?>" class="form-control" readonly maxlength="100"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Apellidos y Nombre:</label>
                                    <div class="col-sm-8">
                                        <input name="apenom" type="text" value="<? echo $usuario->apenom; ?>" autofocus class="form-control" maxlength="45"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Movil:</label>
                                    <div class="col-sm-8">
                                        <input name="movil" type="text" value="<? echo $usuario->movil; ?>" class="form-control" maxlength="12"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email:</label>
                                    <div class="col-sm-8">
                                        <input name="email" type="email" value="<? echo $usuario->email; ?>" class="form-control" maxlength="240"> </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="clave">
                            <form class="form-horizontal" id="tab2" action="<? echo base_url(); ?>login/cambiar_clave" method="post">
                                <input name="usuario" type="hidden" value="<? echo $usuario->usuario; ?>">
                                <div class="form-group <?php if(form_error('clave')){echo 'has-error';} ?>">
                                    <label class="col-sm-3 control-label">Nueva Clave</label>
                                    <div class="col-sm-8">
                                        <input name="clave" type="password" class="form-control" maxlength="32"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Repetir</label>
                                    <div class="col-sm-8">
                                        <input name="claverep" type="password" class="form-control" maxlength="32"> </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>