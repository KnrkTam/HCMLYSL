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
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">年度： </label>
                                            <p>2019/2020</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">學生名稱：
                                            </label>
                                            <p>學生A</p>

                                        </div>
                                    </div>

                                </div>


                                <div class="tableWrap">
                                    <table class="table table-bordered table-striped w-100" id="table">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">
                                                <th class="nowrap">科目/服務</th>
                                                <th class="nowrap">教師/負責人</th>
                                                <th class="nowrap">評語</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>語文科1234</td>
                                                <td>陳老師</td>

                                                <td>
                                                    <a class="link" data-toggle="modal" data-target="#view" href="#">查閱</span></a>
                                                </td>


                                            </tr>
                                            <tr>

                                                <td>語文科1234</td>
                                                <td>陳老師</td>

                                                <td>
                                                    <a class="link" data-toggle="modal" data-target="#save" href="#">鎖定</span></a>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>語文科1234</td>
                                                <td>陳老師</td>

                                                <td>
                                                    <a class="link" data-toggle="modal" data-target="#lock" href="#">鎖定</span></a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>總結</td>
                                                <td>班主任</td>

                                                <td>
                                                    <a class="link" data-toggle="modal" data-target="#save" href="#">儲存</span></a>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>成果展示</td>
                                                <td>班主任</td>

                                                <td>
                                                    <a class="link" data-toggle="modal" data-target="#lock" href="#">鎖定</span></a>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
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

        <!-- Modal -->
        <div class="modal fade in" tabindex="-1" role="dialog" id="view">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">查閱<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">

                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label for="year">年度：</label>
                            </div>
                            <div class="col-md-10">
                                19/20
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label for="year">學生名稱：</label>
                            </div>
                            <div class="col-md-10">
                                學生A
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label for="year">科目/支援服務：</label>
                            </div>
                            <div class="col-md-10">
                                語文科1234
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="comments">評語:</label>
                            <textarea class="form-control" id="comments" rows="3"></textarea>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-purple">儲 存</button>
                        <button type="button" class="btn btn-primary">鎖 定</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" tabindex="-1" role="dialog" id="save">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">儲存<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">

                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label for="year">年度：</label>
                            </div>
                            <div class="col-md-10">
                                2019/2020
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label for="year">學生名稱：</label>
                            </div>
                            <div class="col-md-10">
                                學生A
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="summary">總結 :</label>
                            <textarea class="form-control" id="summary" rows="3"></textarea>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-purple">儲 存</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" tabindex="-1" role="dialog" id="lock">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">鎖定<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">

                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label for="year">年度：</label>
                            </div>
                            <div class="col-md-10">
                                2019/2020
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label for="year">學生名稱：</label>
                            </div>
                            <div class="col-md-10">
                                學生A
                            </div>

                        </div>


                        <p class="bold mb-4">成果展示:</p>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">

                                    <input type="file" class="form-control-file" id="file01">
                                </div>

                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" placeholder="描述....">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">

                                    <input type="file" class="form-control-file" id="file01">
                                </div>

                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" placeholder="描述....">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">

                                    <input type="file" class="form-control-file" id="file01">
                                </div>

                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" placeholder="描述....">
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">鎖 定</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>
    <script>
        $(document).ready(function() {


            $('#table').DataTable({
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