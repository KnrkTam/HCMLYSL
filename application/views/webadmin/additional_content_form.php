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
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="text-nowrap">?????????</label>
                                            <p>?????????1234</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="text-nowrap">?????????</label>
                                            <p>??????</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="text-nowrap">???????????????????????????</label>
                                            <p>????????????</p>

                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <h4 class="bold">???????????????</h4>
                                <div class="row mb-4">
                                    <div class="col-lg-4">
                                        <div class="form-group ">
                                            <label class="text-nowrap">?????????????????????</label>
                                            <select class="form-control">
                                                <option hidden>?????????...</option>
                                                <option value="????????????????????????????????????">????????????????????????????????????</option>
                                                <option value="????????????????????????????????????">????????????????????????????????????</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="bold">?????????????????????</p>
                                        <p>????????????????????????????????? (1)</p>
                                        <p>????????????????????????????????? (2)</p>
                                        <p>????????????????????????????????? (3)</p>
                                        <p>????????????????????????????????? (4)</p>
                                    </div>

                                </div>
                                <div class="row d-flex list-row-header mb-2">
                                    <div class="col-3 bold">
                                        ?????????
                                    </div>
                                    <div class="col-3 bold">
                                        ??????
                                    </div>
                                    <div class="col-3 bold">
                                        ??????
                                    </div>
                                    <div class="col-3 bold">
                                        ??????
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-3 bold">
                                        <p class="mt-2">1.1 ????????????</p>

                                    </div>
                                    <div class="col-lg-3 bold lowLevel d-flex nowrap align-items-center">
                                        <input type="text" class="form-control" value="??? - ?????????">

                                    </div>
                                    <div class="col-lg-3 bold middleLevel d-flex nowrap align-items-center">
                                        <input type="text" class="form-control" value="??? - ?????????">
                                    </div>
                                    <div class="col-lg-3 bold hightLevel d-flex nowrap align-items-center">
                                        <input type="text" class="form-control" value="??? - ?????????">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-3 bold">
                                        <p class="mt-2">1.3 ?????????</p>

                                    </div>
                                    <div class="col-lg-3 bold lowLevel d-flex nowrap align-items-center">
                                        <input type="text" class="form-control">

                                    </div>
                                    <div class="col-lg-3 bold middleLevel d-flex nowrap align-items-center">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-lg-3 bold hightLevel d-flex nowrap align-items-center">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn bg-orange mw-100 mb-4 mr-4" onclick="location.href='../Bk_addon/preview';">??? ???</button>

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