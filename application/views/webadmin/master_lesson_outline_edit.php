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

        .modal-dialog,
        .modal-content {
            /* 80% of window height */
            height: 90%;
        }

        .modal-body {
            /* 100% = dialog height, 120px = header + footer */
            max-height: calc(100% - 120px);
            overflow-y: scroll;
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
                            <input type="hidden" value=<?= $function?> name="action"> </input>
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required"><span>課程：</span> </label>
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
                                    </div>

                                    <div class="row">
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
                                                <label class="required text-nowrap">相關課程編號： <a class="link small" id="searchTag*" data-toggle="modal" data-target="#classNumber" >搜尋編號 </a></label>
                                                <div style="width:100%"><?php form_list_type('rel_lessons[]', ['type' => 'select', 'class'=> 'inputCourseNumber select2 form-control' , 'value' =>$rel_lessons, 'data-placeholder' => 'e.g.: #SC557, #BD003',  'enable_value' => $lessons_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="mb-4 required">學習元素：</p>
                                            <?php foreach ($elements_list as $i => $row) { ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="element_id" value="<?= $i?>" id="<?= $row['nickname']?>">
                                                <label class="form-check-label" for="<?= $row['nickname']?>"><?= $row['name']?></label>
                                            </div>
                                            <? } ?>
                                        </div>
                                        <div class="col-lg-4">
                                            <p class="mb-4 required"> 組別：</p>
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
                                                <input type="text" class="form-control" placeholder="自訂輸入" name="rel_code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
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
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 d-flex">
                                            <div class="form-group w-100">
                                                <label class="text-nowrap">Key Skills <small>(2 層分類,可多項選擇)</small> </label>
                                                <div style="flex: 1"><?php form_list_type('skills_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $skills_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1, 'disable_please_select' => 1]) ?></div>
                                            </div>
                                            <div class="form-check form-check-inline mt-3">
                                                <input class="form-check-input" type="checkbox" value="<?=$preliminary_skills?>" id="preliminary_skills">
                                                <input type='hidden' value="0" id ="skillhidden" name='preliminary_skills'>             
                                                <label class="form-check-label text-nowrap" for="frontSkill">前備技能</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="required">預期學習成果：</label>
                                            <textarea class="form-control" name="expected_outcome" rows="3" placeholder="" ><?= $expected_outcome?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
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
                                <div style="flex: 1"><?php form_list_type('course_search', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>"", 'data-placeholder' => '選擇課程', 'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required']) ?></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div style="flex: 1"><?php form_list_type('category_search', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>"", 'data-placeholder' => '選擇範疇', 'enable_value' => $categories_list, 'form_validation_rules' => 'trim|required']) ?></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                            <div style="flex: 1"><?php form_list_type('sb_obj_search', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>"", 'data-placeholder' => '選擇校本課程學習重點', 'enable_value' => $sb_obj_list, 'form_validation_rules' => 'trim|required']) ?></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                        <button type="button" class="btn btn-success mt-25 w-100 mb-4" id="searchBtn">搜 尋</button>
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
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary confirmSelectCourseNumber">選擇課程編號</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('select.select2').select2();
            $('[data-toggle="tooltip"]').tooltip();
            

            // $('#searchCourseNumberTable').DataTable({
            //     scrollX: true,
            //     // scrollY: "30vw",
            //     scrollCollapse: true,
            //     bFilter: false,
            //     bInfo: true,
            //     bLengthChange: false,
            //     columnDefs: [{
            //         targets: 'no-sort',
            //         orderable: false,
            //         width: 100
            //     }],
                
            // });
            // $("#rel_lessons").change(function() {
            //     let old_arr = $('#rel_lessons').val();
            //     for (let i = 0; i < old_arr.length; i++) {
            //         $(`input[type=checkbox][name=rel_lesson_check][value=${old_arr[i]}]`).prop('checked', true)
            //     }
            //     $('#searchCourseNumberTable').DataTable().draw();
            // })

            $('#searchBtn').click(function(){
                $('#searchCourseNumberTable').DataTable().draw();
            })

            $('#searchTag').click(function(){
                $('#searchCourseNumberTable').DataTable().draw();
            })


            var Ajax_datatable = $('#searchCourseNumberTable').DataTable({
                scrollX: true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/' . get_wlocale() . '.json') ?>"
                },
                "order": [],
                "bSort": false,
                "pageLength": 50,
                "pagingType": "input",
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "searching": true,
                "searchDelay": 0,
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/search_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        let course_id = $('#course_search').val();
                        let category_id = $('#category_search').val();
                        let sb_obj_id = $('#sb_obj_search').val();
                        let lesson_id = $('#lesson_search').val();
                        d.course_search = course_id;
                        d.category_search = category_id;
                        d.sb_obj_search = sb_obj_id;
                        d.lesson_search = lesson_id;
                    },
                    "error": function(e) {
                        console.log(e);
                    },
                    "complete": function(e) {
                        let old_arr = $('#rel_lessons').val();
                        for (let i = 0; i < old_arr.length; i++) {
                            $(`input[type=checkbox][name=rel_lesson_check][value=${old_arr[i]}]`).prop('checked', true)
                        }
                        $("input[type=checkbox][name=rel_lesson_check]").change(function() {
                            if ($(this).is(':checked')) {
                            let old_arr = $('#rel_lessons').val();
                            old_arr.push(this.value);
                            $('#rel_lessons').val(old_arr);
                            $('#rel_lessons').trigger('change');
                            } else {
                                old_arr.shift(this.value);
                            $('#rel_lessons').val(old_arr);
                            $('#rel_lessons').trigger('change');
                            }
                        })
                        $("input[type=checkbox][name=rel_lesson_check][value=<?= $id?>]").click(function() {
                            alertify.error('請選擇其他課程')

                        })

                    },

                },
            });

            $('#lesson_code').inputmask("********",{"placeholder":""}); 
            
            $('#rel_lessons').change(function(){
                $('#searchCourseNumberTable').DataTable().draw();

            })




            $(".confirmSelectCourseNumber").click(function() {
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






        })






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