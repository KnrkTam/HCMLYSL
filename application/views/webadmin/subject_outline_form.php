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

                                        <div class="form-group w-100">
                                            <label class="text-nowrap">科目 : </label>
                                            <div style="flex: 1"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control subjectSelect select2' , 'value' => '' ,  'data-placeholder' => '請選擇...', 'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?></div>
                                        </div>


                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">課程編號： <a class="link small" id="searchTag" data-toggle="modal" data-target="#classNumber">搜尋編號</a></label>
                                            <div style="width:100%"><?php form_list_type('lesson_id', ['type' => 'select', 'class'=> 'inputCourseNumber select2 form-control' , 'value' =>$rel_lessons, 'data-placeholder' => 'e.g.: #SC557, #BD003',  'enable_value' => $lessons_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?></div>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="remarks">備註:</label>
                                            <div style="flex: 1"><?php form_list_type('remark_id', ['type' => 'select', 'class'=> 'form-control subjectSelect select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $remark_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="bold required">預期學習成果：</label>
                                            <textarea class="form-control" name="expected_outcome" rows="3" placeholder="" ><?= $expected_outcome?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-lg-4">
                                            <label>關鍵表現項目：</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label><span class="text-green">建議評估模式 </span></label>
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row align-items-center performanceItem">
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3 w-100">
                                                    <input type="text" class="form-control" id="key_performance" name="key_performance[]" value=""></input>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 d-flex mt-3">
                                                <?php foreach ($assessments_list as $row) { ?>
                                                    <div class="form-check nowrap mr-3">
                                                        <input class="form-check-input" type="radio" name="assessment_id[]" id="mode_<?= $row['mode']?>" value="<?= $row['id']?>"><label class="form-check-label" <?= $row['mode']?>><?= $row['mode']?></label>
                                                    </div>
                                                <?}?>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-check w-100  d-flex align-items-center mb-3">
                                                    <input class="form-check-input" type="radio" name="performanceItemGard" id="performanceItemGardOther" value="other">
                                                    <label class="form-check-label nowrap mr-4" for="performanceItemGardOther">
                                                        其他
                                                    </label>
                                                    <input type="text" class="form-control" id="other" name="other_assessment_id[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-1"> <button type="button" class="btn bg-navy deleteBtn w-100" disabled><i class="fa fa-trash-o"></i></button></div>
                                        </div>

                                        <button type="button" class="btn btn-info addBtn"><i class="fa fa-fw fa-plus"></i>增加關鍵表現項目</button>
                                    </div>

                                </div>
                                <hr />
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4">下一步</button>

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


    <div class="modal fade in" tabindex="-1" role="dialog" id="classNumber">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><b>搜尋課程編號</b> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></h3>

                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-3">
                            <div class="form-group">

                                <select class="form-control">
                                    <option value="" hidden>選擇課程</option>
                                    <option value="語文">語文</option>
                                    <option value="音">音</option>
                                    <option value="科技">科技</option>
                                    <option value="STEM">STEM</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">

                                <select class="form-control">
                                    <option value="" hidden>選擇範疇</option>
                                    <option value="語文">語文</option>
                                    <option value="音">音</option>
                                    <option value="科技">科技</option>
                                    <option value="STEM">STEM</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">

                                <select class="form-control">
                                    <option value="" hidden>校本課程學習重點</option>
                                    <option value="語文">語文</option>
                                    <option value="音">音</option>
                                    <option value="科技">科技</option>
                                    <option value="STEM">STEM</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-success  mb-4">搜 尋</button>
                        </div>
                    </div>
                    <div class="">
                        <table class="table table-bordered table-striped width100p" id="searchCourseNumberTable">
                            <thead>
                                <tr class="bg-light-blue color-palette">
                                    <th class="no-sort"></th>
                                    <th class="nowrap">課程</th>
                                    <th class="nowrap">範疇</th>
                                    <th class="nowrap">中央課程學習重點</th>
                                    <th class="nowrap">校本課程學習重點</th>
                                    <th class="nowrap">學習元素</th>
                                    <th class="nowrap">組別</th>
                                    <th class="nowrap">LPF(基礎)</th>
                                    <th class="nowrap">LPF(高中)</th>
                                    <th class="nowrap">POAS</th>
                                    <th class="nowrap">Key Skill</th>
                                    <th class="nowrap">預期學習成果</th>
                                    <th class="nowrap">課程編號</th>
                                    <th class="nowrap">相關課程編號</th>
                                    <th class="nowrap">相關項目編號</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="searchCourseNumberCheck" class="searchCourseNumberCheck" /></td>
                                    <td>語文</td>
                                    <td>聆聽</td>
                                    <td>聽力訓練</td>
                                    <td>聽力訓練</td>
                                    <td>技能</td>
                                    <td>初組、中組</td>
                                    <td>I2</td>
                                    <td>I2</td>
                                    <td class="nowrap">IB.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                    <td class="nowrap">IC.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>

                                    <td>能注意聲音的來源，對聲音作出反應</td>
                                    <td class="courseNum">MN0155</td>
                                    <td>MN0449,MS0002</td>

                                    <td></td>
                                </tr>
                                <tr>

                                    <td><input type="checkbox" name="searchCourseNumberCheck" class="searchCourseNumberCheck" /></td>
                                    <td>語文</td>
                                    <td>聆聽</td>
                                    <td>聽力訓練</td>
                                    <td>聽力訓練</td>
                                    <td>技能</td>
                                    <td>初組、中組</td>
                                    <td>I2</td>
                                    <td>I2</td>
                                    <td class="nowrap">IB.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                    <td class="nowrap">IC.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                    <td>能注意聲音的來源，對聲音作出反應</td>
                                    <td class="courseNum">MN0157</td>
                                    <td>MN0449,MS0002</td>

                                    <td></td>
                                </tr>
                                <tr>

                                    <td><input type="checkbox" name="searchCourseNumberCheck" class="searchCourseNumberCheck" /></td>
                                    <td>語文</td>
                                    <td>聆聽</td>
                                    <td>聽力訓練</td>
                                    <td>聽力訓練</td>
                                    <td>技能</td>
                                    <td>初組、中組</td>
                                    <td>I2</td>
                                    <td>I2</td>
                                    <td class="nowrap">IB.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                    <td class="nowrap">IC.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>

                                    <td>能注意聲音的來源，對聲音作出反應</td>
                                    <td class="courseNum">MN0156</td>
                                    <td>MN0449,MS0002</td>

                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary comfirmSelectCourseNumber">選擇課程編號</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                </div>
            </div>
        </div>
    </div>


    <?php include_once("footer.php"); ?>



    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>



    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();


            $('#subject_id').change(function() {
                $('#lesson_id').prop('disabled', false);
            })

            $('#searchCourseNumberTable').DataTable({
                scrollX: true,
                scrollCollapse: true,
                bFilter: false,
                bInfo: true,
                bLengthChange: false,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
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