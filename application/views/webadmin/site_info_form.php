<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("head.php"); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include_once("header.php"); ?>

    <?php include_once("menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper" style="min-height: 946px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?= $page_setting['scope'] ?>
                <small><?= ($action) ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url('') ?>"><?= __('Home') ?></a></li>
                <li class="active"><?= ($page_setting['scope']) ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <!-- form start -->
                    <?= form_open_multipart($form_action, 'class="form-horizontal" id="'.$page_setting['scope_code'].'_form"'); ?>
                    <input type="hidden" name="backend" value="1" >
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="row col-md-6">
                                <div class="btn-group" data-spy="affix" data-offset-top="115" style="z-index: 25;">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> <?= __('save') ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
                            if (!empty($_SESSION["message"])) {
                                echo '<div id="signupalert" class="alert alert-danger margin_bottom_20">';
                                echo $_SESSION["message"];
                                echo '</div>';
                                unset($_SESSION["message"]);
                            }

                            foreach ($form_list as $key => $row) {
                                ?>
                                <div class="form-group">
                                    <label
                                            class="col-sm-2 control-label nowarp <?= strpos($row['attr'], "required") !== FALSE || strpos($row['label_class'], "required") !== FALSE ? "required" : "" ?>"
                                            for=""><?= $row["label"] ?>: </label>

                                    <div class="col-sm-8"
                                        style="<?= $row['type'] == 'radio' ? 'margin-top: 7px;' : ($row['type'] == 'checkbox' ? 'margin-top: 3px;' : '') ?>">
                                        <?php
                                        form_list_type($key, $row);
                                        ?>
                                    </div>
                                </div>

                                <?php
                            } ?>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <?= form_close() ?>

                </div>
                <!--/.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

    <?php include_once("footer.php"); ?>

</div>
<!-- ./wrapper -->
<?php include_once("script.php"); ?>

</body>
</html>

