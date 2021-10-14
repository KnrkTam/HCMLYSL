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


                                <div id="sortable">
                                    <div class="row mb-4 list-item">
                                        <div class="col-lg-11">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="text-nowrap">項目#： </label>
                                                        <select class="form-control select2" multiple="" data-placeholder="請選擇...">
                                                            <option value="1" selected>1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="text-nowrap" for="eventName">活動名稱：
                                                        </label>
                                                        <input type="text" class="form-control" id="eventName" placeholder="xxxxxxxxx">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="text-nowrap">教材/教具：
                                                        </label>
                                                        <select class="form-control select2" multiple="" data-placeholder="請選擇...">
                                                            <option value="IPad" selected>IPad</option>
                                                            <option value="Notebook" selected>Notebook</option>
                                                            <option value="PPT">PPT</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="text-nowrap">學習活動： </label>
                                                <textarea class="form-control" rows="3">asda s sad s  s dds</textarea>

                                            </div>
                                            <div class="form-group">
                                                <label>上載檔案：</label>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2">
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="col-lg-1 text-right">
                                            <button type="button" class="btn bg-navy deleteBtn" disabled><i class="fa fa-trash-o"></i></button>
                                        </div>

                                    </div>
                                    <div class="row mb-4 list-item">
                                        <div class="col-lg-11">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="text-nowrap">項目#： </label>
                                                        <select class="form-control select2" multiple="" data-placeholder="請選擇...">
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="text-nowrap" for="eventName">活動名稱：
                                                        </label>
                                                        <input type="text" class="form-control" id="eventName" placeholder="xxxxxxxxxx">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="text-nowrap">教材/教具：
                                                        </label>
                                                        <select class="form-control select2" multiple="" data-placeholder="請選擇...">
                                                            <option value="IPad" selected>IPad</option>
                                                            <option value="Notebook" selected>Notebook</option>
                                                            <option value="PPT">PPT</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="text-nowrap">學習活動： </label>
                                                <textarea class="form-control" rows="3">asdasdasdas asd sad sd s</textarea>

                                            </div>
                                            <div class="form-group">
                                                <label>上載檔案：</label>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2">
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="col-lg-1 text-right">
                                            <button type="button" class="btn bg-navy deleteBtn"><i class="fa fa-trash-o"></i></button>
                                        </div>

                                    </div>
                                </div>
                                <button type="button" class="btn btn-info mw-100 mb-4" onclick="location.href='../Bk_teach_file/create03';"><i class="fa fa-fw fa-plus"></i> 增加一欄
                                </button>
                                <hr>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn bg-orange mw-100 mb-4 mr-4" onclick="location.href='../Bk_teach_file/create02';">確 定</button>

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




            $('.teachTable').DataTable({
                scrollCollapse: true,


            });

            $('.eventTable').DataTable({
                scrollY: "400px",

                scrollX: true,
                sScrollXInner: "100%",
                scrollCollapse: true,


            });
            $('.teachTable').dragtable({
                dragaccept: '.accept'
            });

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