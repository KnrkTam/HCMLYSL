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
                        <div class="box box-primary">
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>


                                <div class="row mb-4">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="text-nowrap">科目：</label>
                                            <p><?= $subject->name?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="text-nowrap">科目範疇：</label>
                                            <p><?= $sub_category ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="text-nowrap">校本課程學習重點：</label>
                                            <p><?= $sb_obj ?></p>

                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <h3>搜尋結果：</h3>
                                <div class="row mb-4">
                                    <div class="col-lg-4">
                                        <div class="form-group ">
                                            <label class="text-nowrap">預期學習成果：</label>
                                            <p><?= $lesson->expected_outcome?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="bold">關鍵表現項目：</p>
                                        <?php foreach ($key_performance as $i => $row) {?>
                                            <p value="<?= $i?>" > <?= $row->performance ?></p>
                                        <? } ?>
                                    </div>

                                </div>
                                <div class="row d-flex list-row-header mb-2">
                                    <div class="col-3 bold">
                                        組別：
                                    </div>
                                    <? foreach ($groups as $group) {?>
                                        <div class="col-3 bold">
                                        <?= Groups_model::name($group) ?>
                                    </div>
                                    <? } ?>
                                </div>
                                <? foreach ($modules as $i => $module) {?>
                                <div class="row mb-4">
                                    <div class="col-lg-3 bold">
                                        <p class="mt-2"><?= $module?> </p>
                                    </div>
                                    <? foreach ($groups as $group) {?>
                                    <div class="col-lg-3 bold lowLevel d-flex nowrap align-items-center">
                                        <input type="text" class="form-control" name="content[]" value="<?= $add_content[$num]?>" placeholder="e.g. 去，坐">
                                        <input type="hidden" name="group[]" value="<?= $group?>"></input>
                                        <input type="hidden" name="module[]" value="<?= $i?>"></input>
                                    </div>
                                    <? $num++?>

                                    <?}?>
                                </div>
                                <? } ?>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mw-100 mb-4 mr-4">確 定</button>

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