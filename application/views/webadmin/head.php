<?php

use DebugBar\StandardDebugBar;

if (DEBUG) {
    $debugbar = new StandardDebugBar();
    $debugbarRenderer = $debugbar->getJavascriptRenderer(assets_url('libraries/maximebf_debugbar/Resources'));
}

$site_info = Site_info_model::first();

$head_title = $site_info['name_' . get_wlang()];
$meta_keyword = $site_info['meta_keyword_' . get_wlang()];
// $favicon = assets_url() . 'images/favicon.ico';

$favicon = assets_url() . 'main/img/favicon.ico';
if (DEBUG && isset($debugbarRenderer)) {
    echo $debugbarRenderer->renderHead();
}
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title><?= $head_title ?></title>
<meta name="keywords" content="<?= $meta_keyword ?>">
<link rel="icon" href="<?= $favicon ?>" type="image/x-icon">

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/bower_components/bootstrap/dist/css/bootstrap.css') ?>">

<!-- Font Awesome -->
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/bower_components/font-awesome/css/font-awesome.min.css') ?>">

<!-- Ionicons -->
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/bower_components/Ionicons/css/ionicons.min.css') ?>">

<?php /*
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/dist/css/skins/_all-skins.min.css') ?>">
<!-- Morris chart -->
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/bower_components/morris.js/morris.css') ?>">
<!-- jvectormap -->
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/bower_components/jvectormap/jquery-jvectormap.css') ?>">
<!-- Date Picker -->
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/bower_components/bootstrap-daterangepicker/daterangepicker.css') ?>">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">
*/ ?>

<!-- alertify -->


<link href="<?= assets_url('webadmin/admin_lte/bower_components/boostrap-datatable/css/jquery.dataTables.min.css') ?>" rel="stylesheet">

<link href="<?= assets_url('webadmin/admin_lte/bower_components/boostrap-datatable/css/select.dataTables.min.css') ?>" rel="stylesheet">
<link href="<?= assets_url('libraries/alertify/alertify.core.css') ?>" rel="stylesheet">
<link href="<?= assets_url('libraries/alertify/alertify.bootstrap.css') ?>" rel="stylesheet">
<!-- jquery UI -->
<link rel="stylesheet" media="all" type="text/css" href="<?= assets_url('libraries/jquery-ui-1.12.1/jquery-ui.min.css') ?>"/>

<?php if ($GLOBALS["fileinput"] == 1) { ?>
    <link href="<?= assets_url('libraries/bootstrap-fileinput/css/fileinput.min.css') ?>" media="all" rel="stylesheet" type="text/css"/>
<?php } ?>

<?php if ($GLOBALS["fancybox"] == 1) { ?>
    <link href="<?= assets_url('libraries/fancybox2.0/jquery.fancybox.css') ?>" rel="stylesheet">

<?php } ?>

<?php if ($GLOBALS["datetimepicker"] == 1) { ?>
    <style>
        .ui-datepicker {
            z-index: 9999 !important;
        }
    </style>
    <link rel="stylesheet" media="all" type="text/css" href="<?= assets_url('libraries/datetimepicker/jquery-ui-timepicker-addon.css') ?>"/>
<?php } ?>

<?php if ($GLOBALS["select2"] == 1) { ?>
    <link href="<?= assets_url('webadmin/admin_lte/bower_components/select2/dist/css/select2.min.css') ?>" rel="stylesheet">
    <style>
        select.select2 {
            min-width: 300px;
        }
    </style>
<?php } ?>

<?php if ($GLOBALS["ionslider"] == 1) { ?>
    <!-- Ion Slider -->
    <link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/bower_components/ion.rangeSlider/css/ion.rangeSlider.css') ?>">
    <!-- ion slider Nice -->
    <link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/bower_components/ion.rangeSlider/css/ion.rangeSlider.skinNice.css') ?>">

<?php } ?>


<?php if ($GLOBALS["elfinder"] == 1) { ?>
    <link href="<?= assets_url('libraries/elFinder-2.1.32/css/elfinder.min.css') ?>" rel="stylesheet">
    <link href="<?= assets_url('libraries/elFinder-2.1.32/css/theme.css') ?>" rel="stylesheet">
    <style>
        .ui-dialog {
            z-index: 9999;
        }
    </style>
<?php } ?>

<?php if ($GLOBALS["datatable"] == 1) { ?>
    <link href="<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/js/input.css') ?>" rel="stylesheet">
<?php } ?>

<!-- Theme style -->
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/dist/css/AdminLTE.min.css') ?>">
<!-- AdminLTE Skins. Choose a skin from the css/skins
	 folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?= assets_url('webadmin/admin_lte/dist/css/skins/skin-blue.min.css') ?>">
<?php /*<link rel="stylesheet" href="<?= assets_url() ?>webadmin/admin_lte/dist/css/skins/_all-skins.min.css"> */ ?>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="<?= assets_url('webadmin/admin_lte/html5shiv.min.js') ?>"></script>
<script src="<?= assets_url('webadmin/admin_lte/respond.min.js') ?>"></script>
<![endif]-->

<!-- Google Font -->
<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->

<link href="<?= assets_url('webadmin/admin_lte/dist/css/google_fonts.css') ?>" rel="stylesheet">

<link href="<?= assets_url('webadmin/css/style.css') ?>" rel="stylesheet">
