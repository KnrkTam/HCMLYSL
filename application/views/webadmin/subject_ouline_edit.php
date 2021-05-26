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

                                        <div class="form-group w-100">
                                            <label class="text-nowrap">科目 : </label>
                                            <select class="form-control subjectSelect">

                                                <option value="語文1234" selected>語文1234</option>
                                                <option value="自理">自理</option>
                                                <option value="生活常規">生活常規</option>
                                                <option value="音1234">音1234</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="col-lg-4">

                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>相關課程編號： <a class="link small" href="#" data-toggle="modal" data-target="#classNumber">更改搜尋編號</a></label>
                                            <input type="text" class="form-control inputCourseNumber" value="#SC557, #BD003" readonly>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="remarks">備註:</label>
                                            <select class="form-control remarks" disabled>
                                                <option value="非華語" selected>非華語</option>
                                                <option value="非華語">非華語</option>
                                                <option value="非華語">非華語</option>
                                                <option value="非華語">非華語</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="studyresults">預期學習成果:</label>
                                            <textarea class="form-control" id="studyresults" rows="3" disabled>能注意聲音的來源，對聲音作出反應</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>關鍵表現項目：</label>

                                        <div class="row align-items-center performanceItem">
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3 w-100">
                                                    <input type="text" class="form-control" id="performanceItemDetail" value="有意識地留意及回應聲音 (1)">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 d-flex mt-3">
                                                <div class="form-check nowrap mr-3">
                                                    <input class="form-check-input" type="radio" name="performanceItemGard" id="gradeA" value="A"><label class="form-check-label" for="gradeA">A</label>
                                                </div>
                                                <div class="form-check nowrap mr-3 mb-3">
                                                    <input class="form-check-input" type="radio" name="performanceItemGard" id="gradeB" value="B"><label class="form-check-label" for="gradeB">B</label>
                                                </div>
                                                <div class="form-check nowrap mr-3">
                                                    <input class="form-check-input" type="radio" name="performanceItemGard" id="gradeC" value="C"><label class="form-check-label" for="gradeC">C</label>
                                                </div>
                                                <div class="form-check nowrap mr-3">
                                                    <input class="form-check-input" type="radio" name="performanceItemGard" id="gradeD" value="D"><label class="form-check-label" for="gradeD">D</label>
                                                </div>
                                                <div class="form-check nowrap mr-3">
                                                    <input class="form-check-input" type="radio" name="performanceItemGard" id="gradeE" value="E"><label class="form-check-label" for="gradeE">E</label>
                                                </div>
                                                <div class="form-check nowrap mr-3">
                                                    <input class="form-check-input" type="radio" name="performanceItemGard" id="gradeF" value="F"><label class="form-check-label" for="gradeF">F</label>
                                                </div>
                                                <div class="form-check nowrap mr-3">
                                                    <input class="form-check-input" type="radio" name="performanceItemGard" id="gradeG" value="G"><label class="form-check-label" for="gradeG">G</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-check w-100  d-flex align-items-center mb-3">
                                                    <input class="form-check-input" type="radio" name="performanceItemGard" id="performanceItemGardOther" checked value="other">
                                                    <label class="form-check-label nowrap mr-4" for="performanceItemGardOther">
                                                        其他
                                                    </label>
                                                    <input type="text" class="form-control" id="performanceItemGardOtherInput" value="ss">

                                                </div>
                                            </div>
                                            <div class="col-lg-1"> <button type="button" class="btn bg-navy deleteBtn w-100" disabled><i class="fa fa-trash-o"></i></button></div>


                                        </div>

                                        <button type="button" class="btn btn-info addBtn"><i class="fa fa-fw fa-plus"></i>增加關鍵表現項目</button>

                                    </div>

                                </div>
                                <hr />
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn bg-maroon mw-100 mb-4 mr-4" onclick="location.href='../Bk_subject_outline/preview';">下一步</button>

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

        <?php include_once "footer.php"; ?>





    </div>







    <!-- ./wrapper -->
    <?php include_once "script.php"; ?>





    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();




            $(".comfirmSelectCourseNumber").click(function() {
                var courseNumberCount = new Array();
                $("input[name='searchCourseNumberCheck']:checked").each(function() {
                    courseNumberCount.push($(this).closest("tr").find(".courseNum").text());
                });

                $('.inputCourseNumber').val(courseNumberCount);
                $('#classNumber').modal('hide');
            });






        });

        var countRow = 0;
        $('.addBtn').click(function() {

            countRow++;
            $('.performanceItem:last').before('<div class="row align-items-center performanceItem"><div class="col-lg-4"><div class="form-group mb-3 w-100"><input type="text" class="form-control" id="addRow' + countRow + '"></div></div><div class="col-lg-4 d-flex mt-3"><div class="form-check nowrap mr-3"><input class="form-check-input" type="radio" name="performanceItemGard' + countRow + '" id="gradeA' + countRow + '" value="A"><label class="form-check-label" for="gradeA' + countRow + '">A</label></div><div class="form-check nowrap mr-3 mb-3"><input class="form-check-input" type="radio" name="performanceItemGard' + countRow + '" id="gradeB' + countRow + '" value="B"><label class="form-check-label" for="gradeB' + countRow + '">B</label></div><div class="form-check nowrap mr-3"><input class="form-check-input" type="radio" name="performanceItemGard' + countRow + '" id="gradeC' + countRow + '" value="C"><label class="form-check-label" for="gradeC' + countRow + '">C</label></div><div class="form-check nowrap mr-3"><input class="form-check-input" type="radio" name="performanceItemGard' + countRow + '" id="gradeD' + countRow + '" value="D"><label class="form-check-label" for="gradeD' + countRow + '">D</label></div><div class="form-check nowrap mr-3"><input class="form-check-input" type="radio" name="performanceItemGard' + countRow + '" id="gradeE' + countRow + '" value="E"><label class="form-check-label" for="gradeE' + countRow + '">E</label></div><div class="form-check nowrap mr-3"><input class="form-check-input" type="radio" name="performanceItemGard' + countRow + '" id="gradeF' + countRow + '" value="F"><label class="form-check-label" for="gradeF' + countRow + '">F</label></div><div class="form-check nowrap mr-3"><input class="form-check-input" type="radio" name="performanceItemGard' + countRow + '" id="gradeG' + countRow + '" value="G"><label class="form-check-label" for="gradeG' + countRow + '">G</label></div></div><div class="col-lg-3"><div class="form-check w-100  d-flex align-items-center mb-3"><input class="form-check-input" type="radio" name="performanceItemGard' + countRow + '" id="performanceItemGardOther' + countRow + '" value="other"><label class="form-check-label nowrap mr-4" for="performanceItemGardOther' + countRow + '">其他</label><input type="text" class="form-control" id="performanceItemGardOtherDetail' + countRow + '" value=""></div></div><div class="col-lg-1"> <button type="button" class="btn bg-navy deleteBtn w-100"><i class="fa fa-trash-o"></i></button></div></div>');


        });



        // remove row
        $(document).on('click', '.deleteBtn', function() {
            $(this).closest('.performanceItem').remove();
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