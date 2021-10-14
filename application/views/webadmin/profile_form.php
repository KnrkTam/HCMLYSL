<?php
$page_setting = array(
    'controller' => current_controller(),
    'scope' => __('Profile'),
    'permission' => array(
        ''
    )
);

$form_action = admin_url('bk_admin/profile_submit');
$action = __('Update');

$GLOBALS["aes_js"] = 1;
?>
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
                <small><?= $action ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url('') ?>"><?= __('Home') ?></a></li>
                <li class="active"><a href="<?=admin_url($page_setting['controller'])?>"><?= ($page_setting['scope']) ?></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header"></div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <?= form_open($form_action, 'class="form-horizontal" id="form1"'); ?>
                        <div class="box-body">

                            <div class="tr margin_bottom_20">
                                <div class="btn-group">
                                    <a href="<?= admin_url($page_setting['controller']) ?>" class="btn btn-default"><i class="fa fa-chevron-left"
                                                                                                                       aria-hidden="true"></i> <?= __('Cancel') ?>
                                    </a>

                                    <?php //if (validate_user_access(['update_sys_user'])) { ?>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> <?= __('Save') ?>
                                    </button>
                                    <?php //} ?>
                                </div>
                            </div>

                            <?php
                            if (validation_errors()) {
                                echo '<div id="signupalert" class="alert alert-danger margin_bottom_20">';
                                echo validation_errors();
                                echo '</div>';
                            }
                            ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= __('Login ID') ?></label>

                                <div class="col-sm-10">
                                    <div class="form_text_padding"><?= $login_id ?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= __('Login Role') ?></label>

                                <div class="col-sm-10">
                                    <div class="form_text_padding"><?= $login_role ?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label required"><?= __('Login Name') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" name="login_name" value="<?= set_value('login_name', $login_name) ?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= __('Login Password') ?></label>

                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control aesjs">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= __('Confirm Password') ?></label>

                                <div class="col-sm-10">
                                    <input type="password" name="password2" class="form-control aesjs">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <?= form_close() ?>
                    </div>
                    <!-- /.box -->

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

