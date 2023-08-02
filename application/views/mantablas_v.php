<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Guardias">
    <meta name="author" content="JML">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>Guardias</title>

    <!-- Bootstrap Core CSS -->
    <link href="<? echo base_url(); ?>assets/bs/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<? echo base_url(); ?>assets/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<? echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<? echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- bootstrap Select CSS -->
    <link href="<? echo base_url(); ?>assets/css/bootstrap-select.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
    <?php endforeach; 
?>
    <!-- Bootstrap Core JavaScript -->
    <script src="<? echo base_url(); ?>assets/bs/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<? echo base_url(); ?>assets/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<? echo base_url(); ?>assets/js/sb-admin-2.js"></script>

    <!-- Custom Bootstrap Select  -->
    <script src="<? echo base_url(); ?>assets/js/bootstrap-select.min.js"></script>
    <!-- Custom Bootstrap Select  -->
    <script src="<? echo base_url(); ?>assets/js/i18n/defaults-es_ES.js"></script>
    <?php
$this->load->view("plantilla/menu");
?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <h2><?php echo $titulo;?></h2>
            <div>
                <?php echo $output; ?>
            </div>
        </div>
    </div>
    <?php
    if (isset($cargar)){
        $this->load->view($cargar);
    }
$this->load->view("plantilla/pie");