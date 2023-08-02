<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <!-- Contenido del panel -->
            <div class="panel-heading">Calendario de Faltas del profesorado</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="control-group">
                            <label for="cmbactividad" class="col-xs-3">Causa de la Falta:</label>
                            <div class="col-xs-7">
                                <select id="cmbcausa" class="form-control">
                                    <?php
                                    $cadena = "<option value='%%'>Todas</option>";
                                    foreach ($causas as $causa) {
                                        $cadena .= "<option value='" . $causa['codigo'] . "'>" . $causa['descripcion'] . "</option>";
                                    }
                                    echo $cadena;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div id="calendario"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?= base_url(); ?>assets/fullcalendar/lib/main.min.css">
<script src="<?= base_url(); ?>assets/fullcalendar/lib/main.min.js"></script>
<script src='<?= base_url(); ?>assets/fullcalendar/lib/locales-all.js'></script>
<script>
    var calendarEl = document.getElementById("calendario");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'today next'
        },
        locale: "es",
        themeSystem: 'bootstrap5',
        editable: false,
        selectable: false,
        allDaySlot: false,
        firstDay: 1,
        height: 550,
        eventSources: [{
            startParam: "fdesde",
            endParam: "fhasta",
            url: "<?= base_url(); ?>faltas/leerTodasPorFecha",
            method: 'POST',
            extraParams: function() {
                return {
                    causa: $("#cmbcausa").val()
                }
            },
            error: function() {
                alert('Error leyendo datos!');
            }
        }],
        eventContent: function(arg) {
            var event = arg.event;
            var customHtml = '';
            customHtml += "<h5 class='text-center'><b>Faltas: <span class='badge bg-dark'>" + event.title + "</span></b></h5>";
            return {
                html: customHtml
            }
        }
    });
    calendar.render();
    $("#cmbcausa").on("change", function(evento) {
        calendar.refetchEvents();
    })
</script>