<?php
$GLOBALS["datatable"] = 1;

$page_setting = array(
    'controller' => current_controller(),
    'scope' => __('News'),
    'permission' => array(
        'view_news'
    )
);

validate_user_access($page_setting['permission'], 0);

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
    <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><?= ($page_setting['scope']) ?>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= admin_url(''); ?>"><?= __('Home') ?></a></li>
                <li class="active"><a href="<?=admin_url($page_setting['controller'])?>"><?= ($page_setting['scope']) ?></a></li>
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

                                        <?= form_open(admin_url($page_setting['controller'] . '/sort'), 'class="form-horizontal form-label-left"'); ?>

                                        <?php if (validate_user_access(['create_news'])) { ?>
                                            <a href="<?= admin_url($page_setting['controller'] . '/create') ?>">
                                                <button type="button" class="btn btn-primary pull-right" style="margin-bottom: 10px;">
                                                    <?= __('Create') ?>
                                                </button>
                                            </a>
                                        <?php } ?>

                                        <?php if (validate_user_access(['update_news'])) { ?>
                                            <button type="submit" class="btn btn-default pull-right" style="margin-bottom: 10px;">
                                                <?= __('Update Sort') ?>
                                            </button>
                                        <?php } ?>

                                        <div class="clearfix"></div>

                                        <table class="datatable width100p">
                                            <thead>
                                            <tr>
                                                <th style="width: 70px;"><?= __('Sort') ?></th>
                                                <th style="width: 120px;"><?= __('Date') ?></th>
                                                <th><?= __('Title') ?></th>
                                                <th class="tr width1px"><?= __('Action') ?></th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php if (!empty($news_index)) {
                                                foreach ($news_index as $row) { ?>
                                                    <tr>
                                                        <td>
                                                            <input type="number" name="sort[<?= $row["id"] ?>]" value="<?= $row["sort"] ?>" style="width: 50px;"/>
                                                        </td>

                                                        <td>
                                                            <?= $row["date"] ?>
                                                        </td>

                                                        <td>
                                                            <a href="<?= admin_url($page_setting['controller'] . '/modify/' . $row["id"]) ?>"><?= $row["title"] ?></a>
                                                        </td>

                                                        <td class="tr nowrap">
                                                            <?php if ($row["status"] == 1) { ?>
                                                                <a href="<?= admin_url($page_setting['controller'] . '/status/' . $row["id"] . "/0") ?>">
                                                                    <button type="button" class="btn btn-success"><?= __('Active') ?>
                                                                    </button>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="<?= admin_url($page_setting['controller'] . '/status/' . $row["id"] . "/1") ?>">
                                                                    <button type="button" class="btn btn-warning"><?= __('Inactive') ?>
                                                                    </button>
                                                                </a>
                                                            <?php } ?>

                                                            <a href="<?= admin_url($page_setting['controller'] . '/modify/' . $row["id"]) ?>">
                                                                <button type="button" class="btn btn-warning"><?= __('Modify') ?>
                                                                </button>
                                                            </a>

                                                            <?php if (validate_user_access(['delete_news'])) { ?>
                                                                <button type="button" class="btn btn-danger"
                                                                        onclick="confirm_delete('<?= admin_url($page_setting['controller'] . '/delete/' . $row["id"]); ?>');">
                                                                    <?= _('Delete') ?>
                                                                </button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                        <?= form_close() ?>
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
