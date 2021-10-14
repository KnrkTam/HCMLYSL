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
                    <!-- general form elements -->
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <div class="box box-primary">
                        <div class="box-header">
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
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label nowarp required" for="">Title: </label>

                                <div class="col-sm-8" style="">
                                    <input type="text" id="title" name="title" value="" placeholder="Title" class="form-control " required="" style=""></div>
                            </div>

                            <div class="form-group">
                                <label
                                        class="col-sm-2 control-label nowarp "
                                        for="">Content: </label>

                                <div class="col-sm-8"
                                     style="">
                                    <textarea id="content" name="content" placeholder="" class="form-control tinymce tinymce_field"  style="" rows="5" ></textarea>                                    </div>
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

