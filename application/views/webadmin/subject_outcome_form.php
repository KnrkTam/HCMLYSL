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
                        <?= form_open_multipart($form_action, 'id="myForm" class="form-horizontal"'); ?>
                        <!-- general form elements
                    <input type="hidden" name="id" value="<?= $id ?>"/>-->
                        <div class="box box-primary">
                 
                            <!-- /.box-header -->

                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <div class="row">
                                <div class="col-lg-12">
                                            <h5 class="text-red"><b>新增科目：</b></h5>
                                        </div>
                                    <div class="col-lg-5 d-flex">
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">選擇科目 : </label>
                                            <div style="flex: 1"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control subjectSelect select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 d-flex">
                                        <div class="form-group w-100">

                                            <label class="text-nowrap">選擇科目範疇: </label>
                                            <div style="flex: 1"><?php form_list_type('sub_category_id', ['type' => 'select', 'class'=> 'form-control subjectSelect select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $sub_categories_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h5 class="text-red"><b>搜尋項目：</b></h5>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group ">
                                                <label class="text-nowrap">課程 : </label>
                                                <div style="flex: 1"><?php form_list_type('courses_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="text-nowrap">課程範疇 : </label>
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
                                            <div class="alert alert-info alert-dismissible fade in" role="alert" id="alert-add-item" style="display:none">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <p> 已選擇 <strong id="item-count"></strong> 個項目</p>
                                            </div>
                                            <h5 class="text-purple"><b>選擇項目：</b></h5>
                                            <table class="table table-bordered table-striped" id="subjectTable">
                                                <!-- <thead> -->
                                                    <!-- <tr class="bg-light-blue color-palette">
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
                                                    </tr> -->
                                                <!-- </thead> -->
                                                <tbody>
                                                </tbody>
                                            </table>

                                           
                                            <hr>
                                        </div>
                                        <div class="col-lg-12">
                                            <h5 class="text-yellow"><b>已選項目：</b></h5>
                                            <table class="table table-bordered table-striped" id="subjectSelectedTable">
                                                <!-- <thead> -->
                                                    <!-- <tr class="bg-light-blue color-palette">
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
                                                    </tr> -->
                                                <!-- </thead> -->
                                                <tbody>
                                                </tbody>
                                            </table> 

                                            <div class="mt-4 d-flex justify-content-end">
                                                <input type="hidden" id="subject_lessons" name="subject_lessons[]" value=""></input>
                                                <input type="hidden" value=<?= $function?> name="action"> </input>

                                                <button type="submit" class="btn bg-maroon mw-100 mr-4">下一步</button>
                                                <button type="button" class="btn btn-default mw-100" onclick="location.href='<?= (admin_url($page_setting['controller'])) ?>';">返 回</button>
                                            </div>
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
                Subject_dataTable.draw()
            });

            let added_ids = new Set();

            <?php if ($_SESSION['post_data']){ ?>
                let session_data = <?= json_encode($_SESSION['post_data'])?>;
                $('#subject_id').val(session_data['subject_id']).select2();    
                ajax_choose(session_data['subject_id']);
                setTimeout(() => {
                    $('#sub_category_id').val(session_data['sub_category_id']).select2();
                }, 500);
                for (i = 0; i < session_data['added_ids'].length; i++) {
                    added_ids.add(session_data['added_ids'][i]);
                };
            <?}?>

            let columnDefs = [{
                width: '10px',
                data: "edit",
                name: 'first',
                class: 'no-sort',
            },     
            {
                width: '60px',
                data: "category",
                title: "課程範疇",
                name: 'first',
            },               
            {
                class: 'col',
                data: "course",
                title: "課程",
                name: 'first',
            },               
            {
                class: 'col',
                data: "sb_obj",
                title: "校本課程學習重點",
                name: 'first',
            },        
            {
                width: '100px',
                data: "element",
                title: "學習元素",
                name: 'first',
            },              
            {
                class: 'col',
                data: "groups",
                title: "組別",
                name: 'first',
            },                
            {
                class: 'big-col',
                data: "expected_outcome",
                title: "預期學習成果",
                name: 'first',
            },        
            {
                class: 'col',
                data: "pre-skills",
                title: "前備技能",
                name: 'first',

            },  
            {
                class: 'col',
                data: "lpf_basic",
                title: "LPF(基礎)",
                name: 'first',
            },                
            {
                class: 'col',
                data: "lpf_advanced",
                title: "LPF(高中)",
                name: 'first',
            },                
            {
                class: 'col',
                data: "poas",
                title: "POAS",
                name: 'first',
            },                
            {
                class: 'col',
                data: "skills",
                title: "Key Skill",
                name: 'first',
            },                                  
            {
                class: 'col',
                data: "rel_les",
                title: "相關項目編號",
                name: 'first',
            },              
        ];
            
            $('input[id=subject_lessons]').val(Array.from(added_ids));

            var  Subject_dataTable = $('#subjectTable').DataTable({
                // scrollY: '500px',
                scrollX: true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bInfo": true,
                // "bSort": false,
                "bPaginate": true,
                // "paging": true,
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "columns": columnDefs,   

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
                    },
                    "complete": function(e){
                        $('[data-toggle="tooltip"]').tooltip();
                        $(".addLesson").change(function(e) {
                            if ($(this).is(':checked')) {
                                added_ids.add(this.value)
                                e.stopPropagation();
                                $(".tableWrap").fadeIn();

                                $('#subjectSelectedTable').DataTable().draw();
                            } else {
                                added_ids.delete(this.value)
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
                   "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
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
                "columns": columnDefs,   

                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/select_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        d.added_ids = Array.from(added_ids)
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
                            $('#subjectSelectedTable').DataTable().draw();
                            $('#subjectTable').DataTable().draw();

                        });
                        $('input[id=subject_lessons]').val(Array.from(added_ids));
                        show_status();

                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });
            
            // ajax_choose(1)

            function ajax_choose(subject_id) {
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/select_subject' ?>',
                method:'POST',
                data:{subject_id:subject_id},
                dataType:'json',
                beforeSend:function(){
                    $('#sub_category_id').empty();
                    },
                success:function(d){
                    $('#sub_category_id').select2({
                        data: d
                    });
                    },
                })
            }

            function show_status () {
                let count = added_ids.size;
                $('#item-count').html(count);
                $('#alert-add-item').fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
            }

            $("#subject_id").change(function() {
                // alertify.error(this.value);
                ajax_choose(this.value)
            })
        });

    </script>

</body>

</html>