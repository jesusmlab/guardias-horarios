        </div>
        <!-- /#wrapper -->

        <script>
            function mostrarTrabajando(mensaje) {
                let cadena = `<div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Trabajando...</h3>
                                    <span class="pull-right clickable">
                                        <i class="glyphicon glyphicon-chevron-up"></i>
                                    </span>
                                </div>
                                <div class="panel-body">
                                    <p>` + mensaje + `</p>
                                    <img class="img-responsive" src="<? echo base_url(); ?>/assets/img/trabajando.gif">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
                $("#page-wrapper").html(cadena);
            }
        </script>
        </body>

        </html>