<div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-md-8 col-md-offset-2">
            <h3>
                <? echo $titulo; ?>
            </h3>
            <form name="subirf" method="POST" action="<?=base_url("ficheros/subir/".$tipo)?>"
                enctype="multipart/form-data">
                <!-- COMPONENT START -->
                <div class="form-group">
                    <div class="input-group input-file">
                        <input type="file" name="fichero" id="fichero" class="form-control" accept=".xml" />
                    </div>
                </div>
                <?php 
                if ($tipo=="H") {
                    ?>
                <div class="form-group">
                <input type="hidden" name="aniadir" value="0" />
                    <div class="input-group">
                        Añadir?
                        <input type="checkbox" name="aniadir" id="aniadir" class="form-control" value="1" />
                    </div>
                </div>
                <? } ?>
                <!-- COMPONENT END -->
                <div class="form-group">
                    <button id="enviar" type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>

            <?php
            if(isset($error)){
                echo "<strong style='color:red;'>".$error."</strong>";
            }
            
            if(isset($correcto)){
                echo "<strong style='color:green;'>".$correcto["orig_name"]." subido satisfactoriamente </strong>";
            }
            ?>
        </div>
    </div>
</div>
<script>
    $("#enviar").on("click", function (evento) {
        evento.preventDefault();
        if ($('#fichero').get(0).files.length === 0) {
            alert("No has seleccionado fichero");
        } else {

            document.subirf.submit();
            mostrarTrabajando('Importando Datos');
        }
    })
</script>