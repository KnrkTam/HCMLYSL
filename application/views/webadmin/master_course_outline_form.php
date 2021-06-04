<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .required:after, .required_field:after {
            content: ' * ';
            color: red;
            left: 10px;
            position: absolute;
        }
    </style>
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
                        <?= form_open_multipart($form_action, 'class="form-horizontal"', 'id="form"'); ?>
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
                            <input type="hidden" value=<?= $function?> name="action"> </input>
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">課程： </label>
                                            <div style="flex: 1"><?php form_list_type('course_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>$course_id, 'data-placeholder' => '請選擇', 'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">範疇：
                                            </label>
                                            <div style="flex: 1"><?php form_list_type('categories_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>$categories_id, 'data-placeholder' => '請選擇', 'enable_value' => $categories_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">課程編號： <span class="text-red small">*課程編號不能重覆, 警告提示及不能儲存</span></label>
                                            <input type="text" class="form-control" id="lesson_code" name="lesson_code" value="<?=$lesson_code?>" placeholder="請輸入..." data-inputmask="'mask': ['*******']" data-mask>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">中央課程學習重點： </label>
                                            <div style="flex: 1"><?php form_list_type('central_obj_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>$central_obj_id, 'data-placeholder' => '請選擇',  'enable_value' => $central_obj_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">校本課程學習重點：
                                            </label>
                                            <div style="flex: 1"><?php form_list_type('sb_obj_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>$sb_obj_id, 'data-placeholder' => '請選擇',  'enable_value' => $sb_obj_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">相關課程編號： <a class="link small" href="#" data-toggle="modal" data-target="#classNumber">搜尋編號</a></label>
                                            <input type="text" class="form-control inputCourseNumber" placeholder="e.g.: #SC557, #BD003" Disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <p><label class="form-label required">學習元素：</label></p>
                                        <?php foreach ($elements_list as $i => $row) { ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="element_id" value="<?= $i?>" id="<?= $row['nickname']?>">
                                            <label class="form-check-label" for="<?= $row['nickname']?>"><?= $row['name']?></label>
                                        </div>
                                        <? } ?>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class=" "> <label class="form-label required">組別：</label></p>
                                        <?php foreach ($groups_list as $i => $row) { ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="group_id[<?=$i?>]" value="<?= $row['name']?>" id=<?= $row['nickname']?>>
                                                <label class="form-check-label" for="<?= $row['nickname']?>"><?= $row['name']?></label>
                                            </div>
                                        <? } ?>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">相關項目編號： </label>
                                            <input type="text" class="form-control" name="rel_code" placeholder="自訂輸入">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>LPF(基礎) <small>(2 層分類, 單項選擇)</small></label>
                                            <div style="flex: 1"><?php form_list_type('lpf_basic_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>$lpf_basic_id, 'data-placeholder' => '請選擇', 'enable_value' => $lpf_basic_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>LPF(高中) <small>(2 層分類, 單項選擇)</small></label>
                                            <div style="flex: 1"><?php form_list_type('lpf_advanced_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>$lpf_advanced_id, 'data-placeholder' => '請選擇', 'enable_value' => $lpf_advanced_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>POAS： <small>(2 層分類, 單項選擇)</small></label>
                                            <div style="flex: 1"><?php form_list_type('poas_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>$poas_id, 'data-placeholder' => '請選擇', 'enable_value' => $poas_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex">
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">Key Skills <small>(2 層分類,可多項選擇)</small> </label>
                                            <div style="flex: 1"><?php form_list_type('skills_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $skills_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1, 'disable_please_select' => 1]) ?></div>
                                        </div>
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input" type="checkbox" value="<?=$preliminary_skills?>" id="preliminary_skills">
                                            <input type='hidden' value="0" id ="skillhidden" name='preliminary_skills'>             

                                            <label class="form-check-label text-nowrap" for="preliminary_skills">前備技能</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="bold required">預期學習成果：</label>
                                            <textarea class="form-control" name="expected_outcome" rows="3" placeholder="" ><?= $expected_outcome?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <!-- <button type="button" class="btn bg-orange mw-100 mb-4 mr-4" id="save-btn">儲存</button> -->
                                    <button type="submit" class="btn bg-orange mw-100 mb-4 mr-4">儲存</button>

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
                                <div style="flex: 1"><?php form_list_type('course_search', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>'', 'data-placeholder' => '選擇課程', 'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required']) ?></div>
                            </div>


                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">

                                <div style="flex: 1"><?php form_list_type('categories_search', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>'', 'data-placeholder' => '選擇範疇', 'enable_value' => $categories_list, 'form_validation_rules' => 'trim|required']) ?></div>

                            </div>


                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <div style="flex: 1"><?php form_list_type('sb_obj_search', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>'', 'data-placeholder' => '校本課程學習重點搜尋', 'enable_value' => $sb_obj_list, 'form_validation_rules' => 'trim|required']) ?></div>
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

            $('#lesson_code').inputmask("********",{"placeholder":""}); 



            $(".comfirmSelectCourseNumber").click(function() {
                var courseNumberCount = new Array();
                $("input[name='searchCourseNumberCheck']:checked").each(function() {
                    courseNumberCount.push($(this).closest("tr").find(".courseNum").text());
                });

                $('.inputCourseNumber').val(courseNumberCount);
                $('#classNumber').modal('hide');
            });

            $('#preliminary_skills').on('change', function () {
                $("#skillhidden").val(this.checked ? 1 : 0);
            });

            <? foreach ($group_ids as $i => $row) {?>
            $("input[type='checkbox'][name='group_id[<?= $i?>]'").attr('checked', 'checked');
            <? } ?>

            $("input:radio[name=element_id][value="+ <?= $element_id?> + "]").attr('checked', 'checked');

            $('#skills_id').val(<?= json_encode($skills_ids)?>).select2();  

            $("input[type='checkbox'][id=preliminary_skills][value='1']").attr('checked', 'checked');
            <? if($preliminary_skills == 1) {?>
                $('#skillhidden').val(1);
                $('#preliminary_skills').on('change', function () {
                    $("#skillhidden").val(this.checked ? 1 : 0);
                });
            <? } ?>

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


            // let saveBtn = document.querySelector('#save-btn');
            //     saveBtn.addEventListener("click",function(){
            //     createLesson(course_id.value, categories_id.value, lesson_code.value, central_obj_id.value, sb_obj_id.value, newCode.value, newName.value);
            //     function createLesson(course_id, cat_id, code, ctr_id, sb_id, element, group, outcome){
            //         $.ajax({
            //         url: '<?= (admin_url($page_setting['controller'])) . '/check' ?>',
            //         method:'POST',
            //         data:{course_id:course_id, category_id:cat_id,code: code, ctr_id: ctr_id, sb_id:sb_id, element_id:element, group_id:group, outcome:outcome},
            //         dataType:'json',     
            //         success:function(data){
            //             if (data.status == 'success') {
            //                 window.location.reload();
            //             } else {
            //                 alertify.error(data.status)
            //             }
            //         },
            //         error: function(error){
            //             alert('error');
            //             // alert('duplicated');
            //             // console.log(error);
            //         }
            //         });
            //     } 
            // })









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