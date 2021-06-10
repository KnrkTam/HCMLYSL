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
                                        <?= form_open(admin_url($page_setting['controller'] . '/sort'), 'class="form-horizontal form-label-left"'); ?>

                                        <div id="filter_container" class="pull-left col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-3" style="padding: 0;">
                                                    <?= __('Filter') ?> :

                                                    <select name="filter_type" id="filter_type" class="form-control" onchange="select_filter_type(this.value)">
                                                        <?= $filter_type_list ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-4" id="filter_para_container">
                                                    <div>
                                                        <select name="filter_2_para" id="filter_2_para"
                                                                class="form-control filter_para select2"><?= $filter_2_para_list ?></select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <button type="button" class="btn btn-primary" onclick="submit_filter();"
                                                            style="margin-left: 20px;"><i class="fa fa-fw fa-search"></i> <?= __('Search') ?></button>
                                                </div>

                                            </div>
                                        </div>

                                        <?php if (validate_user_access(['create_news'])) { ?>
                                            <a href="<?= admin_url($page_setting['controller'] . '/create') ?>">
                                                <button type="button" class="btn btn-primary pull-right" style="margin-bottom: 10px;">
                                                    <?= __('Create') ?>
                                                </button>
                                            </a>
                                        <?php } ?>

                                        <?php if (validate_user_access(['update_news'])) { ?>
                                            <button type="button" class="btn btn-default pull-right" style="margin-bottom: 10px;" onclick="ajax_update_sort(this);">
                                                <?= __('Update Sort') ?>
                                            </button>
                                        <?php } ?>

                                        <div class="clearfix"></div>

                                        <table class="table table-bordered table-hover width100p" id="Ajax_datatable">
                                            <thead>
                                            <tr>
                                                <th style="width: 70px;"><?= __('Sort') ?></th>
                                                <th style="width: 120px;"><?= __('Date') ?></th>
                                                <th><?= __('Title') ?></th>
                                                <th class="tr width1px"><?= __('Action') ?></th>
                                            </tr>
                                            </thead>

                                            <tbody></tbody>
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
    /*function update_sort(_this){
        //form checking
        var valid_data = true;
        //.form checking
        if(!valid_data){
            alert('Invalid Data.');
        }else{
            ajax_update_sort(_this);
        }
    }*/

    // function select_filter_type(filter_type) {
    //     $('#filter_para_container').show();

    //     $('.filter_para').prop('disabled', true).hide();
    //     $(document).find('.filter_para').parent().find('.select2-container').hide();
    //     $('#filter_' + filter_type + '_para').prop('disabled', false).show();
    //     if(filter_type == 6){
    //         $('#filter_6_container').show();
    //         $('#filter_' + filter_type + '_para2').prop('disabled', false).show();
    //     }else{
    //         $('#filter_6_container').hide();
    //     }
    //     $(document).find('#filter_' + filter_type + '_para').parent('div').find('.select2-container').show();
    // }

    // function submit_filter() {
    //     var filter_type = $('#filter_type').val();
    //     if (!filter_type) {
    //         alert('<?=__('Please select filter type.')?>');
    //     } else {
    //         var filter_para = $('#filter_' + filter_type + '_para').val();
    //         var filter_para2 = $('#filter_' + filter_type + '_para2').val();

    //         if (filter_type == 1) {
    //             filter_para = '';
    //             location.href = '<?= admin_url($page_setting['controller'] . '/index/'); ?>' + filter_type + '/' + filter_para;
    //         } else if ((filter_type == 2) && !filter_para) {
    //             alert('<?=__('Please fill filter parameters.')?>');
    //         }else{
    //             /*location.href = '<//?= admin_url($page_setting['controller'] . '/index/'); ?>' + filter_type + '/' + filter_para + '/' + filter_para2; */
    //             filter_data();
    //         }
    //     }
    // }

    function filter_data() {
        $('#Ajax_datatable').DataTable().draw();
    }

    $(function () {
        select_filter_type(<?=$filter_type?>);
    });
</script>
</body>
</html>
