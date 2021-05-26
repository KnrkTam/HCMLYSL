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

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>課程： </label>
                                            <p>語文</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>範疇：
                                            </label>
                                            <p>聆聽</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>課程編號： </label>
                                            <p>MS0002</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>中央課程學習重點： </label>
                                            <p>技能</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>校本課程學習重點：
                                            </label>
                                            <p>聽力訓練</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>相關課程編號： </label>
                                            <p>MN0155</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-2 bold"> <span class="text-red">*</span>學習元素：</p>
                                        <p>知識</p>


                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-2 bold"> <span class="text-red">*</span>組別：</p>
                                        <p>初組</p>


                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">相關項目編號： </label>
                                            <p>MS0002</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>LPF(基礎) <small>(2 層分類, 單項選擇)</small></label>
                                            <p> I2</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>LPF(高中) <small>(2 層分類, 單項選擇)</small></label>
                                            <p> I3</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>POAS： <small>(2 層分類, 單項選擇)</small></label>
                                            <p> I.B.3 - 學習及運用實用.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex">
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">Key Skills (2 層分類,可多項選擇)</label>
                                            <p>能注意聲音的來源，對聲音作出反應</p>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">

                                        <p class="mb-2 bold">前備技能</p>
                                        <p><span class="text-green"><i class="fa fa-check"></i></span></p>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><span class="text-red">*</span>預期學習成果：</label>
                                            <p>MN0449,MS0002</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn bg-maroon mw-100 mb-4 mr-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">確 定</button>

                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='../Bk_course_outline/create';">返 回</button>

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
            $('[data-toggle="tooltip"]').tooltip();

            $('#searchCourseNumberTable').DataTable({
                scrollX: true,
                scrollCollapse: true,
                bFilter: false,
                bInfo: true,
                bLengthChange: false,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                    width: 100
                }]

            });




            $(".comfirmSelectCourseNumber").click(function() {
                var courseNumberCount = new Array();
                $("input[name='searchCourseNumberCheck']:checked").each(function() {
                    courseNumberCount.push($(this).closest("tr").find(".courseNum").text());
                });

                $('.inputCourseNumber').val(courseNumberCount);
                $('#classNumber').modal('hide');
            });






            /*



                        $('.searchCourseNumberCheck').change(function() {
                            var values = [];
                                $('.searchCourseNumberCheck:checked').each(function() {
                                //if(values.indexOf($(this).val()) === -1){
                                 values=$(this).closest("tr").find(".courseNum").text();
                               
                                //  $('.inputCourseNumber').attr("value", values)
                                // }
                                });
                                console.log(values);
                        });
            */










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