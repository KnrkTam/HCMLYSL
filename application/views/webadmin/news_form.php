<?php
$GLOBALS["datetimepicker"] = 1;
$GLOBALS["tinymce"] = 1;
$GLOBALS["elfinder"] = 1;
$GLOBALS["fileinput"] = 1;

$page_setting = array(
    'controller' => current_controller(),
    'scope' => __('News'),
    'permission' => array(
        'view_news'
    )
);

validate_user_access($page_setting['permission'], 0);

if (!empty($id)) {
    $form_action = admin_url($page_setting['controller'] . '/submit_form/' . $id);
    $action = __('Update');
} else {
    $form_action = admin_url($page_setting['controller'] . '/submit_form');
    $action = __('Create');
}
?>
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
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="row col-md-2">
                                <div class="btn-group" data-spy="affix" data-offset-top="2" style="z-index: 20;">
                                    <a href="<?= admin_url($page_setting['controller']) ?>" class="btn btn-default"><i class="fa fa-chevron-left"
                                                                                                                       aria-hidden="true"></i> <?= __('Cancel') ?>
                                    </a>

                                    <?php if (validate_user_access(['create_news', 'update_news'])) { ?>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i> <?= __('Save') ?>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">

                            <?php
                            if (validation_errors()) {
                                echo '<div id="signupalert" class="alert alert-danger margin_bottom_20">';
                                echo validation_errors();
                                echo '</div>';
                            }
                            ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= __('Cover Image') ?></label>

                                <div class="col-sm-10">
                                    <?php if (!empty($cover_img)) { ?>
                                        <img src="<?= assets_url($cover_img) ?>" style="width: 200px;"><br>
                                        <input type="text" name="cover_img" value="<?= set_value('cover_img', $cover_img) ?>" class="elfinder_btn form-control"
                                               placeholder="<?= __('Please click here to upload file.') ?>" readonly>
                                        <label>
                                            <input type="checkbox" name="del_img" value="1" class="checkbox_position_fix" style="margin-top: 10px;"> <?= __('Delete File?') ?>
                                        </label>

                                    <?php }else{ ?>
                                        <div class="input-group">
                                            <input type="text" name="cover_img" value="<?= set_value('cover_img', $cover_img) ?>" class="elfinder_btn form-control"
                                                   placeholder="<?= __('Please click here to upload file.') ?>" readonly>

                                                <span class="input-group-btn">
                                                    <button class="btn btn-danger elfinder_btn_remove" type="button"><?=__('Clear')?></button>
                                                </span>
                                        </div><!-- /input-group -->
                                    <?php } ?>

                                </div>
                            </div>


                            <!-- Bootstrap single upload plugin example -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= __('Single Image Upload') ?></label>

                                <div class="col-sm-10">

                                    <?php if (!empty($single_upload)) { ?>
                                        <img src="<?= assets_url('files/'.$single_upload) ?>" class="img-responsive img-thumbnail"><br>
                                        <label>
                                            <input type="checkbox" name="del_single_upload" value="1" class="checkbox_position_fix" style="margin-top: 10px;"> <?= __('Delete File?') ?>
                                        </label>
                                    <?php } ?>

                                    <div class="file-loading">
                                        <input class="file" name="single_upload" type="file"
                                               data-language="<?=get_wlocale()?>"
                                               data-show-upload="false"
                                               data-max-file-size="2048"
                                               data-max-image-height="678"
                                               data-max-image-width="1980"
                                               data-allowed-file-extensions='["jpg", "jpeg", "gif", "png"]'
                                               data-el-error-container="#errorBlock"
                                               accept="image/*">
                                    </div>
                                    <div id="errorBlock" class="help-block"></div>
                                    <div class="help-block text-red"><?=__('Image format');?>: gif,jpg,png | <?=__('Resolution');?>:<?=__('Max-width');?>: 1980px; <?=__('Max-height');?>: 678px | <?=__('File Size');?>: < 2MB</div>

                                </div>
                            </div>
                            <!-- End of Bootstrap upload plugin example -->

                            <!-- Bootstrap multiple upload plugin example -->
                            <!-- REMEMBER TO COPY JAVASCRIPT CODE ON THE END OF THIS PAGE (LINE: 237) -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= __('Multiple Image Upload') ?></label>

                                <div class="col-sm-10">
                                    <div class="file-loading">
                                        <input class="multiple_upload" name="multiple_upload[]" type="file"
                                               accept="image/*"
                                               multiple="multiple">
                                    </div>
                                    <div class="help-block text-red"><?=__('Image format');?>: gif,jpg,png | <?=__('Resolution');?>:<?=__('Width');?>: 780px; <?=__('Height');?>: 424px | <?=__('File Size');?>: < 2MB</div>

                                </div>
                            </div>
                            <!-- End of Bootstrap multiple upload plugin example -->


                            <div class="form-group">
                                <label class="col-sm-2 control-label required"><?= __('Title') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" name="title" value="<?= set_value('title', $title) ?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label required"><?= __('Short Content') ?></label>

                                <div class="col-sm-10">
                                    <textarea name="short_content" class="form-control" rows="3"><?= set_value('title', $short_content) ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label required"><?= __('Content') ?></label>

                                <div class="col-sm-10">
                                    <textarea name="content" class="form-control tinymce"><?= set_value('content', $content) ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label required"><?= __('News Date') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" name="date" value="<?= set_value('date', $date) ?>" class="form-control datepicker">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label required"><?= __('Start Date') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" name="start_date" value="<?= set_value('start_date', $start_date) ?>" class="form-control datetimepicker">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label required"><?= __('End Date') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" name="end_date" value="<?= set_value('end_date', $end_date) ?>" class="form-control datetimepicker">
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
</script>

</body>
</html>

