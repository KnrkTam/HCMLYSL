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
                <?= ($page_setting['scope']) ?>
                <small><?= ($action) ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url() ?>"><?= __('首頁') ?></a></li>
                <li class="active"><a href="<?=admin_url($page_setting['controller'])?>"><?= ($page_setting['scope']) ?></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <!-- form start -->
                    <?= form_open_multipart($form_action, 'class="form-horizontal" id="' . $page_setting['scope_code'] . '_form"'); ?>
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="row col-md-6">
                                <div class="btn-group" data-spy="affix" data-offset-top="2" style="z-index: 20;">
                                    <a href="<?= admin_url('bk_' . $page_setting['scope_code']) ?>" class="btn btn-default">
                                        <i class="fa fa-chevron-left" aria-hidden="true"></i> <?= __('取消') ?>
                                    </a>

                                    <?php if (validate_user_access(['update_' . $page_setting['scope_code']])) { ?>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i> <?= __('保存') ?>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
                            if (validation_errors()) {
                                echo '<div id="signupalert" class="alert alert-danger margin_bottom_20">';
                                echo validation_errors();
                                echo '</div>';
                            }

                            if (!empty($_SESSION["message"])) {
                                echo '<div id="signupalert" class="alert alert-danger margin_bottom_20">';
                                echo $_SESSION["message"];
                                echo '</div>';

                                unset($_SESSION["message"]);
                            }

                            foreach ($form_list as $key => $row) {
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label nowarp <?= strpos($row['attr'], "required") !== false || strpos($row['label_class'], "required") !== false ? "required" : "" ?>"
                                           for=""><?= $row["label"] ?>
                                        : </label>

                                    <div class="col-sm-<?= $key == 'content_tc' || $key == 'content_en' ? '10' : '8' ?>">
                                        <?php form_list_type($key, $row); ?>
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

