<?php
//enable encryption
$GLOBALS['aes_js'] = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("head.php"); ?>
</head>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?= front_url() ?>"><b><?= $site_info['name_' . get_wlang()] ?></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <p class="login-box-msg"><?=__('Sign in to start your session')?></p>
        <?php

        if (validation_errors()) {
            echo '<div id="signupalert" class="alert alert-danger" style="margin-left: -15px; margin-right: -15px;">';
            echo validation_errors();
            echo '</div>';
        }

        if (!empty($_SESSION['error_msg'])) {
            echo '<div id="signupalert" class="alert alert-danger" style="margin-left: -15px; margin-right: -15px;">';
            echo $_SESSION['error_msg'];
            echo '</div>';
            unset($_SESSION['error_msg']);
        }
        ?>

        <?= form_open(admin_url('bk_admin/auth'), 'class="form-horizontal form-label-left"'); ?>
        <div class="form-group has-feedback">
            <input type="text" name="login_id" value="<?= set_value('login_id', $login_id) ?>" class="form-control" placeholder="<?= __('Login ID') ?>">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="login_pw" class="form-control aesjs" placeholder="<?= __('Login Password') ?>">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-4 fr">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><?= __('Sign In') ?></button>
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-xs-12">
                <small>
                    <?= $site_info['copyright'] ?>
                </small>
            </div>
        </div>
        <?= form_close() ?>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php include_once("script.php"); ?>
</body>
</html>
