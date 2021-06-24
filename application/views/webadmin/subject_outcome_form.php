<!DOCTYPE html>
<html lang="en">

<head>
<?php include_once("head.php"); ?>
<style>
    .removeRow {
        z-index: 5;
        opacity: 1;
        cursor: pointer;
    }

    .removeRow i {
        z-index: -1;
        opacity: 1;
        cursor: pointer;
    }
</style>
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

                                    <?php if (validate_user_access(['create_'.$page_setting['scope_code'], 'update_'.$page_setting['scope_code']])) { ?>
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
                                    <div class="col-lg-5 d-flex">
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">選擇科目 : </label>
                                            <div style="flex: 1"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control subjectSelect select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                        <!-- <a href="#" class="link nowrap mt-30 ml-2 controlSearchBtn">隱藏搜尋</a> -->
                                    </div>
                                </div>
                                <hr>
                                <div class="">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="form-group ">
                                                <label class="text-nowrap">課程 : </label>
                                                <div style="flex: 1"><?php form_list_type('courses_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="text-nowrap">範疇 : </label>
                                                <div style="flex: 1"><?php form_list_type('categories_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $categories_list, 'form_validation_rules' => 'trim|required']) ?></div>                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-6 d-flex align-items-start">
                                            <div class="form-group w-100">
                                                <label class="text-nowrap">校本課程學習重點 : (多項選擇) </label>
                                                <div style="flex: 1"><?php form_list_type('sb_obj_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $sb_obj_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                            </div>
                                            <span class="ml-2 mr-2 mt-30">或</span>
                                            <div class="form-group w-100">
                                                <label class="text-nowrap">課程編號 : (多項選擇) </label>
                                                <div style="flex: 1"><?php form_list_type('lesson_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $lessons_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                        </div>

                                    </div>
                                </div>

                                <div class="tableWrap">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <h5 class="text-purple"><b>選擇項目：</b></h5>
                                            <table class="table table-bordered table-striped" id="subjectTable">
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
                                                        <th class="nowrap">前備技能</th>
                                                        <th class="nowrap">課程編號</th>
                                                        <th class="nowrap">預期學習成果</th>
                                                        <th class="nowrap">相關項目編號</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>

                                            <div class="mt-4 d-flex justify-content-end">
                                                <input type="hidden" id="subject_lessons" name="subject_lessons[]" value=""></input>
                                                <input type="hidden" value=<?= $function?> name="action"> </input>

                                                <button type="submit" class="btn bg-maroon mw-100 mr-4">下一步</button>
                                                <button type="button" class="btn btn-default mw-100" onclick="location.href='<?= (admin_url($page_setting['controller'])) ?>';">返 回</button>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="col-lg-12">
                                            <h5 class="text-yellow"><b>已選項目：</b></h5>
                                            <table class="table table-bordered table-striped" id="subjectSelectedTable">
                                                <thead>
                                                    <tr class="bg-light-blue color-palette">
                                                        <th class="no-sort" style="min-width: 10px;"></th>
                                                        <th class="nowrap">課程</th>
                                                        <th class="nowrap">範疇</th>
                                                        <th class="nowrap">中央課程學習重點</th>
                                                        <th class="nowrap">校本課程學習重點</th>
                                                        <th class="nowrap">學習元素</th>
                                                        <th class="nowrap">組別</th>
                                                        <th class="nowrap">LPF(基礎)</th>
                                                        <th class="nowrap">LPF(高中) </th>
                                                        <th class="nowrap">POAS</th>
                                                        <th class="nowrap">Key Skill</th>
                                                        <th class="nowrap">前備技能</th>
                                                        <th class="nowrap">預期學習成果</th>
                                                        <th class="nowrap">課程編號</th>
                                                        <th class="nowrap">相關項目編號</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table> 
                                        </div>
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
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            // $(".tableWrap").hide();

            $(".searchBtn").click(function() {
            //     // $(".tableWrap").fadeIn();
                $('#subjectTable').DataTable().draw();
            });

            let added_ids = new Set();

            <?php if ($_SESSION['post_data']){ ?>
                let session_data = <?= json_encode($_SESSION['post_data'])?>;
                $('#subject_id').val(session_data['subject_id']).select2();
                for (i = 0; i < session_data['added_ids'].length; i++) {
                    added_ids.add(session_data['added_ids'][i]);
                };
            <?}?>
            
            $('input[id=subject_lessons]').val(Array.from(added_ids));

            var  Course_datatable = $('#subjectTable').DataTable({
                // scrollY: '300px',
                scrollX: true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/' . get_wlocale() . '.json') ?>"
                },
                "order": [],
                "bSort": false,
                "bPaginate": false,
                "pageLength": 50,
                "pagingType": "input",
                //"sDom": '<"wrapper"lfptip>',
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/search_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        let course_id = $('#courses_id').val();
                        let category_id = $('#categories_id').val();
                        let sb_obj_id = $('#sb_obj_id').val();
                        let lesson_id = $('#lesson_id').val();
                        let subject_id = $('#subject_id').val();

                        d.course_search = course_id;
                        d.category_search = category_id;
                        d.sb_obj_search = sb_obj_id;
                        d.lesson_search = lesson_id;
                        d.subject_search = subject_id;
                        console.log('data',d);
                        // var filter_type = $('#filter_type').val();
                        // d.search_filter_type = filter_type;
                        // d.search_filter_para = $('#filter_' + filter_type + '_para').val();
                    },
                    "complete": function(e){
                                                $('[data-toggle="tooltip"]').tooltip();

                        $(".addLesson").change(function(e) {
                            if ($(this).is(':checked')) {
                                added_ids.add(this.value)
                                console.log(Array.from(added_ids));
                                e.stopPropagation();
                                $(".tableWrap").fadeIn();

                                $('#subjectSelectedTable').DataTable().draw();
                            } else {
                                added_ids.delete(this.value)
                                console.log(Array.from(added_ids));
                                $(".tableWrap").fadeIn();

                                $('#subjectSelectedTable').DataTable().draw();

                            }
                        });
                        let old_arr = Array.from(added_ids)
                        for (let i = 0; i < old_arr.length; i++) {
                            $(`input[type=checkbox][class=addLesson][value=${old_arr[i]}]`).prop('checked', true)
                        }

                        $(".removeRow").click(function() {
                            added_ids.delete(this.attributes.value.value);

                            console.log(Array.from(added_ids))
                            
                            $('#subjectSelectedTable').DataTable().draw();
                            $('#subjectTable').DataTable().draw();

                        });
                        $('input[id=subject_lessons]').val(Array.from(added_ids));

                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });





                let subjectSelectedTable = $('#subjectSelectedTable').DataTable({
                scrollX: true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/' . get_wlocale() . '.json') ?>"
                },
                "order": [],
                "bSort": false,
                "pageLength": 50,
                "pagingType": "input",
                //"sDom": '<"wrapper"lfptip>',
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "searchDelay": 0, 
                "bPaginate": false,
                "bAutoWidth": false,
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/select_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        d.added_ids = Array.from(added_ids)
                        console.log('data',d);
                    },
                    "complete": function(e){
                        $(".addLesson").change(function() {
                            if ($(this).is(':checked')) {
                                added_ids.add(this.value)
                                // console.log(Array.from(added_ids));
                            } else {
                                added_ids.delete(this.value)
                                // console.log(Array.from(added_ids));
                            }
                        });

                        
                        $(".removeRow").click(function() {
                            added_ids.delete(this.attributes.value.value);

                            console.log(Array.from(added_ids))
                            // console.log(JSON.stringify(this));
                            // console.log(this.attributes.value.value)


                            $('#subjectSelectedTable').DataTable().draw();
                            $('#subjectTable').DataTable().draw();

                        });
                        $('input[id=subject_lessons]').val(Array.from(added_ids));

                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });
            
        });




    </script>

</body>

</html>