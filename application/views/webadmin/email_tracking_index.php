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
    <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><?= ($page_setting['scope']) ?>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url(); ?>"><?= __('首頁') ?></a></li>
                <li class="active"><?= ($page_setting['scope']) ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!--<div class="box-header">
                            <h3 class="box-title">Hover Data Table</h3>
                        </div>-->
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php if (validate_user_access(['create_' . $page_setting['scope_code']])) { ?>
                                            <a href="<?= admin_url($page_setting['controller'] . '/create') ?>">
                                                <button type="button" class="btn btn-primary pull-right" style="margin-bottom: 10px;">
                                                    <?= __('新增') ?>
                                                </button>
                                            </a>
                                        <?php } ?>

                                        <div class="clearfix"></div>

                                        <div style="margin-bottom: 20px;">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <?= __('電郵推廣') ?>:
                                                </div>
                                                <div class="col-sm-6">
                                                    <select name="edm_id" class="form-control select2"
                                                            onchange="location.href='<?= admin_url($page_setting['controller'] . '/index/edm/') ?>'+this.value;"><?= $edm_options ?></select>
                                                </div>
                                                <div class="col-sm-5">
                                                    <?=__('電郵總數').': '.$total_email?> &nbsp;&nbsp;&nbsp;
                                                    <?=__('已開啟電郵總數').': '.$opened_email?>&nbsp;&nbsp;&nbsp;
                                                    <?=__('開啟電郵百分比').': '.$opened_percentage?>
                                                </div>
                                            </div>
                                        </div>

                                        <table class="datatable width100p">
                                            <thead>
                                            <tr>
                                                <th><?= __('類別') ?></th>
                                                <th><?= __('描述') ?></th>
                                                <th><?= __('收件者電郵') ?></th>
                                                <th><?= __('已開啟?') ?></th>
                                                <th><?= __('發送日期') ?></th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php if (!empty($email_tracking_index)) {
                                                foreach ($email_tracking_index as $row) { ?>
                                                    <tr>
                                                        <td>
                                                            <?= $row["type"] ?>
                                                        </td>

                                                        <td>
                                                            <?= $row["desc"] ?>
                                                        </td>

                                                        <td>
                                                            <?= $row["email"] ?>
                                                        </td>

                                                        <td>
                                                            <?= $row["open"] ?>
                                                        </td>

                                                        <td>
                                                            <?= $row["send_date"] ?>
                                                        </td>

                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
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

<script type="text/javascript">
    $(function () {

    });
</script>
</body>
</html>
