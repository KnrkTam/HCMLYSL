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
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <p><?= $annual?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">學階： </label>
                                            <p><?= $level ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">班別： </label>
                                            <p> <?= $class ?> </p>

                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元一 </label>
                                            <p><?= $module1 ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <p><?= $remark1 ? $remark1 : "&nbsp"?></p>


                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元二 </label>
                                            <p><?= $module2 ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <p><?= $remark2 ? $remark2 : "&nbsp" ?></p>


                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元三 </label>
                                            <p><?= $module3 ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <p><?= $remark3 ? $remark3 : "&nbsp"?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元四 </label>
                                            <p><?= $module4 ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <p><?= $remark4 ? $remark4 : "&nbsp"?></p>

                                        </div>
                                    </div>

                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                <textarea name="post_data" class="hidden" ><?= json_encode($postData)?></textarea>
                                <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4">確 定</button>

                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']. '/'. $previous. '/'. $id) ?>';">返 回</button>

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