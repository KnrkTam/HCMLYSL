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
                    <li class="active"><?= ($page_setting['scope']) ?></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- column -->
                    <div class="col-md-12">
                        <!-- form start -->
                        <?= form_open_multipart($form_action, 'class="form-horizontal"'); ?>
                        <div class="box box-primary">
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <?php form_list_type('year_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $year_id , 'data-placeholder' => '請選擇...', 'enable_value' => $years_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?>
                                            <input type="hidden" name="year_id" value="<?= $year_id?> " />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">學階： </label>
                                            <?php form_list_type('level_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'value' => $level_id, 'enable_value' => $levels_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?>
                                            <input type="hidden" name="level_id" value="<?= $level_id?> " />

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">班別： </label>
                                            <?php form_list_type('class_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'value' => $class_id, 'enable_value' => $classes_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?>
                                            <input type="hidden" name="class_id" value="<?= $class_id?> " />

                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元一 </label>
                                            <?php form_list_type('module_id1', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'value' => $module1_id, 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <input type="text" class="form-control" name="remark1" value="<?= $remark1?>" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元二 </label>
                                            <?php form_list_type('module_id2', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'value' => $module2_id, 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <input type="text" class="form-control" name="remark2" value="<?= $remark2?>" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元三 </label>
                                            <?php form_list_type('module_id3', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'value' => $module3_id, 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <input type="text" class="form-control" name="remark3" value="<?= $remark3?>" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元四 </label>
                                            <?php form_list_type('module_id4', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'value' => $module4_id, 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <input type="text" class="form-control" name="remark4" value="<?= $remark4?>" placeholder="">

                                        </div>
                                    </div>

                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn bg-orange mw-100 mb-4 mr-4">確 定</button>

                                <input type="hidden" name="action" value="edit"/>


                                <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">返 回</button>

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
 


        });

    </script>

</body>

</html>