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
                    <li><a href="<?= admin_url('') ?>"><?= __('Home') ?></a></li>
                    <li class="active"><a href="<?=admin_url($page_setting['controller'])?>"><?= ($page_setting['scope']) ?></a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- column -->
                    <div class="col-md-12">
                        <!-- form start -->
                        <?= form_open_multipart($form_action, 'class="form-horizontal"'); ?>
                        <!-- general form elements 
                    <input type="hidden" name="id" value="<?= $id ?>"/>-->
                        <div class="box box-primary">
                            <!-- <div class="box-header">
                            <div class="row col-md-2">
                                <div class="btn-group" data-spy="affix" data-offset-top="2" style="z-index: 20;">
                                    <a href="<?= admin_url($page_setting['controller']) ?>" class="btn btn-default">
                                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                        <?= __('Cancel') ?>
                                    </a>

                                    <?php if (validate_user_access(['create_news', 'update_news'])) { ?>
                                        <button type="button" class="btn btn-primary" onclick="submit_form(this);">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i> <?= __('Save') ?>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div> -->
                            <!-- /.box-header -->

                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>


                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">?????????</label>
                                            <?php form_list_type('year_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '?????????...', 'value' => $year_id, 'enable_value' => $years_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?>
                                            <input type="hidden" name="year_id" value="<?=$year_id?>"> </input>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">?????????</label>
                                            <?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '?????????...', 'value' => $subject_id, 'enable_value' => $subjects_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?>
                                            <input type="hidden" name="subject_id" value="<?=$subject_id?>"> </input>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">?????????</label>
                                            <?php form_list_type('monitor_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '?????????...', 'value' => $monitor_id, 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">????????????</label>
                                            <?php form_list_type('deputy_monitor_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '?????????...', 'value' => $deputy_monitor_id, 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="submit"  class="btn bg-orange mw-100 mb-4 mr-4">??? ???</button>
                                    <input type="hidden" name="action" value="edit"/>
                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">??? ???</button>

                                </div>

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
    <script>
        $(document).ready(function() {

            //  table.columns.adjust();
            $(".searchBtn").click(function() {

                $(".tableWrap").fadeIn();

                $('#settingTable').DataTable({
                    scrollX: true,
                    scrollCollapse: true,
                    bFilter: false,
                    bInfo: true,
                    sScrollXInner: "100%",
                    bLengthChange: true,
                    columnDefs: [{
                        targets: 'no-sort',
                        orderable: false,

                    }]


                }).columns.adjust();

            });

        });




    </script>

</body>

</html>