<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <h4>Enviar Correo</h4>
            <div class="col-xs-10 col-md-9">
                <form id="email-form" method="" action="">
                    <div class="form-group">
                        <input type="text" id="asunto" class="form-control" placeholder="Asunto" required="required"></input>
                    </div>
                    <div class="form-group">
                        <textarea id="mensaje" class="form-control" rows="4" placeholder="Entra tu mensaje" required="required"></textarea>
                    </div>
                </form>
            </div>
            <div class="col-xs-2 col-md-3">
                <div class="panel panel-primary" style="height: 35vh; overflow:scroll;">
                    <div class="panel-heading">
                        Ficheros adjuntos
                    </div>
                    <div class="panel-body">
                    </div>
                </div>
            </div>
            <div class="col-xs-12" id="errores"></div>
        </div>
        <div class="panel panel-primary" style="height: 35vh; overflow:scroll;">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <tr>
                            <th>Profesor</th>
                            <th>Email</th>
                            <th class="text-center">Selecionar</th>
                            <th class="text-center">Acción</th>
                        </tr>
                        <?php
                        $count = 0;
                        foreach ($profesores as $row) {
                            if (!empty($row['Email'])) {
                                $count = $count + 1;
                                if (empty($row['Sustituto'])) {
                                    $profsel = $row['Apellido1'] . " " . $row['Apellido2'] . "," . $row['Nombre'];
                                } else {
                                    $profsel = $row['Sustituto'];
                                }
                                echo '
					<tr>
						<td>' . $profsel . '</td>
						<td><a href="https://mail.google.com/mail/?view=cm&fs=1&to=' . $row['Email'] . '" target="_blank">' . $row["Email"] . '</a></td>
						<td class="text-center">
							<input type="checkbox" name="single_select" class="single_select" data-email="' . $row["Email"] . '" data-name="' . $profsel . '" />
						</td>
						<td class="text-center">
						<button type="button" name="email_button" class="btn btn-info btn-xs email_button" id="' . $count . '" data-email="' . $row["Email"] . '" data-name="' . $profsel . '" data-action="single">Enviar este</button>
						</td>
					</tr>
                    ';
                            }
                        }
                        ?>

                    </table>
                </div> <!-- Table responsive -->
            </div> <!-- Panel body -->
        </div><!-- Panel  -->
        <div class="col-xs-4 col-md-4 col-md-offset-4">
            <button type="button" name="bulk_email" class="btn btn-info email_button" id="bulk_email" data-action="bulk">Enviar Seleccionados</button></td>
        </div>
    </div>
</div>
<script>
    let baseurl = "<? echo base_url(); ?>";
</script>
<script src="https://cdn.tiny.cloud/1/rz0uzx177migz8ydo7vs7gsr61vwg263063ozj2dtdy3bjqc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mensaje',
        language: 'es',
        language_url: baseurl + 'assets/js/tinymce_langs/es.js' // site absolute URL
    });
</script>
<script>
    $(document).ready(function() {
        $('.email_button').click(function() {
            // Obtener el contenido del richtext
            var contenido = tinymce.get("mensaje").getContent();
            if ($("#asunto").val() != "" && contenido != "") {
                $(this).attr('disabled', 'disabled');
                var id = $(this).attr("id");
                var action = $(this).data("action");
                var email_data = [];
                if (action == 'single') {
                    email_data.push({
                        email: $(this).data("email"),
                        nombre: $(this).data("name"),
                        asunto: $("#asunto").val(),
                        mensaje: contenido
                    });
                } else {
                    $('.single_select').each(function() {
                        if ($(this).prop("checked") == true) {
                            email_data.push({
                                email: $(this).data("email"),
                                nombre: $(this).data('name'),
                                asunto: $("#asunto").val(),
                                mensaje: contenido
                            });
                        }
                    });
                }
                $.ajax({
                    url: baseurl + "correo/enviar/",
                    method: "POST",
                    data: {
                        email_data: email_data
                    },
                    beforeSend: function() {
                        $('#' + id).html('Enviando...');
                        $('#' + id).addClass('btn-danger');
                    },
                    success: function(data) {
                        if (data == 'ok') {
                            $('#' + id).text('Envio correcto');
                            $('#' + id).removeClass('btn-danger');
                            $('#' + id).removeClass('btn-info');
                            $('#' + id).addClass('btn-success');
                        } else {
                            $('#errores').html(data);
                        }
                        $('#' + id).attr('disabled', false);
                    }
                })
            } else {
                window.alert("Debe rellenar Asunto y Mensaje");
            }
        });
    });
</script>