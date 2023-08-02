<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Correr Turnos de Guardia</h3>
                        <span class="pull-right clickable">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <p>La ultima fecha en la que corrió el turno fue:
                            <? 
                            $date = new DateTime($ultFecha);
                            echo $date->format('d-m-Y');?>
                        </p>
                        <button class="btn btn-large btn-primary" data-toggle="confirmation"
                            data-btn-ok-label="Continuar" data-btn-ok-icon="glyphicon glyphicon-share-alt"
                            data-btn-ok-class="btn-success" data-btn-cancel-label="Cancelar"
                            data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger"
                            data-title="Seguir?" data-content="Esta operación no se puede deshacer">
                            Confirmar
                        </button>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="<? echo base_url(); ?>/assets/bs/js/bootstrap-confirmation.min.js"></script>
<script>
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        onConfirm: function () {
            mostrarTrabajando("Corriendo Turnos");
            location.href = "<? echo base_url(); ?>turnos/correr_turnos";
        },
        onCancel: function () {
            location.href = "<? echo base_url(); ?>inicio";
        },
    });
</script>