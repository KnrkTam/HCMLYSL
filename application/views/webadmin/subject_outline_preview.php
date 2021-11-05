<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "head.php"; ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include_once "header.php"; ?>

        <?php include_once "menu.php"; ?>

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
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">科目 : </label>
                                            <p><?= $subject?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>課程編號： </label>
                                            <p><?= $lesson?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="remarks">科目範疇:</label>
                                                <p> 
                                                    <?= Subject_categories_model::name($_POST['subject_cat_id'] ? $_POST['subject_cat_id'] : $subject_cat_id) ?>
                                                </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="studyresults">預期學習成果:</label>
                                            <p><?= $_POST['expected_outcome']?> </p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="remarks">備註:</label>
                                                <p> 
                                                    <?= implode(', ', $remark) ?>
                                                </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>關鍵表現項目：</label>
                                        <?php foreach ($performance as $i => $row){ ?>
                                        <div class="row align-items-center performanceItem">
                                            <div class="col-lg-8">
                                                <p class="mr-4"><?= $row['performance']?></p>
                                            </div>
                                            <div class="col-lg-4">
                                                <?php if ($row['assessment'] == "0") { ?> 
                                                    <p class="text-red">評估模式: <?= $row['other'] ?></p>
                                                <? } else { ?>
                                                    <p class="text-red">評估模式: <?= $assessments_list[$row['assessment']]  ?></p>
                                                <? } ?>

                                            </div>
                                        </div>
                                        <? } ?>

                                    </div>
                                </div>
                                <hr />
                    
                                <div class="mt-4 d-flex justify-content-end">
                                    <textarea class="hidden" name="remark_id[]"><?php echo json_encode($remark_ids)?> </textarea>
                                    <textarea class="hidden" name="performance[]" id='performance'><?php echo json_encode($performance)?> </textarea>
                                    <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4">確 定</button>

                                    <?php if ($previous == "edit") { ?>
                                    <button type="button" class="btn btn-default mw-100 mb-4 mr-4" onclick="location.href='<?= (admin_url($page_setting['controller'])) . '/'. $previous. '/'. $id?>';">返 回</button>
                                    <? } else { ?>
                                    <button type="button" class="btn btn-default mw-100 mb-4 mr-4" onclick="location.href='<?= (admin_url($page_setting['controller'])) . '/'. $previous. '/'. $subject_id?>';">返 回</button>
                                    <? } ?>
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

        <?php include_once "footer.php"; ?>

    </div>

    <!-- ./wrapper -->
    <?php include_once "script.php"; ?>


    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>

</body>

</html>