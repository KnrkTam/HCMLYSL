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
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">年度： </label>
                                            <P>2019/2020</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">年度： </label>
                                            <p>陳大文</p>

                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">班別： </label>
                                            <p>忠</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元名稱： </label>
                                            <P>1.1 認識自己</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">日期： </label>
                                            <p>11/11/2019 至 21/1/2020</p>

                                        </div>
                                    </div>



                                </div>


                                <div class="tableWrap">
                                    <h4 class="bold">科目：語文科1234</h4>
                                    <table class="table table-bordered table-striped w-100">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">
                                                <th class="nowrap no-sort"></th>
                                                <th class="nowrap">範疇</th>
                                                <th class="nowrap">校本課程學習重點</th>
                                                <th class="nowrap">預期學習成果</th>
                                                <th class="nowrap">平均分數</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>


                                                <td><input type="checkbox" name="subjectCheck" class="subjectCheck" checked /></td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>
                                                    <p>能注意聲音的來源，對聲音作出反應</p>
                                                    <input type="text" class="form-control" value="（梳、揀、派）">
                                                </td>
                                                <td>
                                                    1
                                                </td>

                                            </tr>
                                            <tr>


                                                <td><input type="checkbox" name="subjectCheck" class="subjectCheck" checked /></td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>
                                                    <p>能對名稱有反應</p>

                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>
                                            <tr>

                                                <td><input type="checkbox" name="subjectCheck" class="subjectCheck" checked /></td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>
                                                    <p>把握詞語的重心</p>

                                                </td>
                                                <td>
                                                    4
                                                </td>
                                            </tr>



                                        </tbody>
                                    </table>

                                    <h4 class="bold">科目：通識教育科</h4>
                                    <table class="table table-bordered table-striped w-100">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">
                                                <th class="nowrap no-sort"></th>
                                                <th class="nowrap">範疇</th>
                                                <th class="nowrap">校本課程學習重點</th>
                                                <th class="nowrap">預期學習成果</th>
                                                <th class="nowrap">平均分數</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>


                                                <td><input type="checkbox" name="subjectCheck" class="subjectCheck" checked /></td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>
                                                    <p>能注意聲音的來源，對聲音作出反應</p>
                                                    <input type="text" class="form-control" value="（梳、揀、派）">
                                                </td>
                                                <td>
                                                    1
                                                </td>

                                            </tr>
                                            <tr>


                                                <td><input type="checkbox" name="subjectCheck" class="subjectCheck" checked /></td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>
                                                    <p>能對名稱有反應</p>

                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>
                                            <tr>

                                                <td><input type="checkbox" name="subjectCheck" class="subjectCheck" checked /></td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>
                                                    <p>把握詞語的重心</p>

                                                </td>
                                                <td>
                                                    4
                                                </td>
                                            </tr>



                                        </tbody>
                                    </table>

                                    <p class="mt-4">備註：</p>
                                    <p>《4》代表完全(總是)掌握......
                                    </p>
                                    <p>《3》代表
                                    </p>
                                    <p>《2》代表
                                    </p>
                                    <p>《1》代表
                                    </p>
                                    <p>《0》代表
                                    </p>
                                    <hr>
                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="button" class="btn bg-purple mw-100 mr-4" onclick="window.open('../Bk_unit_eva/printpreview')">預 覽</button>
                                        <button type="button" class="btn bg-maroon mw-100 mr-4" onclick="location.href='../Bk_unit_eva';">鎖 定</button>
                                        <button type="button" class="btn btn-default mw-100">返 回</button>
                                    </div>



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
            $('.table').DataTable({
                scrollX: true,
                scrollCollapse: false,
                bFilter: false,
                bInfo: false,
                paging: false,
                sScrollXInner: "100%",
                bLengthChange: false,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,

                }]


            }).columns.adjust();
            //  table.columns.adjust();


        });



        function submit_form(_this) {
            //form checking
            var valid_data = true;
            //.form checking
            if (!valid_data) {
                //alert('Invalid Data.');
            } else {
                ajax_submit_form(_this);
            }
        }

        <?php /*
    //multiple image upload
    $("input.multiple_upload").fileinput({
        language: '<?=get_wlocale()?>',
        previewFileType: "image",
        showCaption: false,
        showUpload: false,
        maxFileSize: 2048,
        maxFileCount: 30,
        maxImageHeight: 2000,
        maxImageWidth: 2000,
        overwriteInitial: false,
        allowedFileExtensions: ['jpg','jpeg','png'],
        initialPreview: <?=isset($photos_preview) ? $photos_preview : "{}"?>,
        initialPreviewAsData: true,
        initialPreviewConfig: <?=isset($photos_json) ? $photos_json : "{}"?>,
        deleteUrl: "<?=admin_url('bk_news/delete_multiple_upload')?>",
        // hiddenThumbnailContent: true,
        // initialPreviewShowDelete: true,
        // removeFromPreviewOnError: true,
    }).on('filedeleted', function(event, key, jqXHR, data) {
        alertify.success("<?=__('Deleted successfully!')?>");
    });
 */ ?>
    </script>

</body>

</html>