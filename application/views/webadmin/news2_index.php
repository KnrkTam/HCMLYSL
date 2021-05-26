<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("head.php"); ?>

    <style>
        #Ajax_datatable td:nth-child(6){
            white-space: nowrap;
        }
    </style>



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
                <li><a href="<?= admin_url(); ?>"><?= __('Home') ?></a></li>
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
                                    <div class="col-sm-12" style="overflow-y: auto;">
                                        <?php if (validate_user_access(['create_' . $page_setting['scope_code']])) { ?>
                                            <a href="<?= admin_url($page_setting['controller'] . '/create') ?>">
                                                <button type="button" class="btn btn-primary pull-right" style="margin-bottom: 10px;">
                                                    <?= __('Create') ?>
                                                </button>
                                            </a>
                                        <?php } ?>

                                        <div class="clearfix"></div>

                                        <table class="table table-bordered table-hover width100p" id="Ajax_datatable">
                                            <thead>
                                            <tr>
                                                <th style="width: 60px;"><?= __('Date') ?></th>
                                                <th style="width: 20%;"><?= __('Title (TC)') ?></th>
                                                <th style="width: 20%;"><?= __('Title (EN)') ?></th>
                                                <th style="width: 15%;"><?= __('Cover Img (TC)') ?></th>
                                                <th style="width: 15%;"><?= __('Cover Img (EN)') ?></th>
                                                <th class="tr width1px"><?= __('Actions') ?></th>
                                            </tr>
                                            </thead>

                                            <tbody></tbody>
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

    var Ajax_datatable = $('#Ajax_datatable').DataTable({
        "language": {
            "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/' . get_wlocale() . '.json') ?>"
        },
        "order": [],
        "bSort": false,
        "pageLength": 50,
        "pagingType": "input",
        //"sDom": '<"wrapper"lfptip>',
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "searching": true,
        "searchDelay": 0,
        "ajax": {
            "url": "<?=admin_url($page_setting['controller'] . '/ajax')?>",
            "method" : "get",
            "timeout": "30000",
            "data": function (d) {
                //var filter_type = $('#filter_type').val();
                //d.search_filter_type = filter_type;
                //d.search_filter_para = $('#filter_'+filter_type+'_para').val();
                console.log(d);
            },
            "error": function (e) {
                console.log(e);
            }
        },
    });

</script>
</body>
</html>
