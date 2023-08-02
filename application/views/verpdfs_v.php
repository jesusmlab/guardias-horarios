<?php
include(dirname( __FILE__ ) ."/../../assets/php_file_tree/php_file_tree.php");
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ficheros PDF</h3>
                        <span class="pull-right clickable">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <p>PDFs Generados</p>
                        <?php        
                            echo php_file_tree("pdf", base_url()."[link]");
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<? echo base_url(); ?>/assets/js/php_file_tree.js"></script>