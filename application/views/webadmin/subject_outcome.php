<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("head.php"); ?>
    <style>
        .big-col {
            width: 400px !important;
            position: relative;
        }
        .col {
            width: 100px;
            position: relative;

        }
        table {
            table-layout:fixed;
        } 
        .highlight{
            position:absolute;
            right: 5%;
            bottom: 5%;
        }
        span.select2-selection__choice__remove {
            display: none;
        }
        .select2-selection__choice__remove {
            display: none;
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
                        <div class="box box-primary">
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <!-- <div class="col-lg-12">  -->
                                <div class="alert alert-info alert-dismissible fade in" role="alert" id="subject-select-notice">
                                    <button type="button" id="close-btn" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p> 請先選擇科目</p>
                                </div>
                                <h5 class="text-purple"><b>搜尋科目：</b></h5>
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="form-group ">
                                            <label class="text-nowrap required">科目 : </label>
                                            <div style="flex: 1"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control subjectSelect  select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="text-nowrap">科目範疇 : </label>
                                                <div style="flex: 1"><?php form_list_type('subject_category_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_categories_id,  'data-placeholder' => '請選擇...', 'form_validation_rules' => 'trim|required']) ?></div>
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
                                            <button type="submit" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller'] . '/create') ?>'">加入課程至新科目範疇</button>
                                <hr />
                                    <h5 class="text-red"><b>搜尋結果：</b></h5>
                                <!-- </div> -->
                                <div class="tableWrap">
                                    <table class="table table-bordered table-striped dataTable" id="courseOutlineTable">
                                        <tbody>
                                        </tbody>
                                    </table>
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
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });


        $(".searchBtn").click(function() {
            Course_table.draw();
        })

        let columnDefs = [{
                width: '10px',
                data: "edit",
                name: 'first',
                class: 'no-sort',
            },     
            {
                width: '60px',
                data: "sub_cat",
                title: "科目",
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

        let Course_table = $('#courseOutlineTable').DataTable({
        'rowsGroup': [0, 1],
        scrollX: true,
        "language": {
            "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
        },
        "order": [],
        "bSort": false,
        "bPaginate": false,
        "pageLength": 50,
        "pagingType": "input",
        "processing": true,
        "serverSide": false,
        "ordering": true,
        "searching": true,
        "columns": columnDefs,   
        "searchDelay": 0,                    
        "ajax": {
            "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
            "method": "get",
            "timeout": "30000",
            "data": function(d) {
                let course_id = $('#courses_id').val();
                let category_id = $('#subject_category_id').val();
                let sb_obj_id = $('#sb_obj_id').val();
                let lesson_id = $('#lesson_id').val();
                let subject_id = $('#subject_id').val();

                d.subject_search = subject_id
                d.course_search = course_id;
                d.category_search = category_id;
                d.sb_obj_search = sb_obj_id;
                d.lesson_search = lesson_id;
                console.log(d);
            },
            "complete" : function(){
                $('[data-toggle="tooltip"]').tooltip();

            },
            "error": function(e) {
                console.log(e);
            }
        },
        });


        let data =  <?php echo $subject_categories_list?>;

        $('#subject_category_id').select2({
            data: data
        })


        let sub_id = <?php echo $subject_categories_id ?  $subject_categories_id : 0?>;
        let sb_obj_id = <?php echo $sb_obj_id ?  $sb_obj_id : 0?>;
        let lesson_id = <?php echo $lesson_id ?  $lesson_id : 0?>;
        $("#subject_category_id").val(sub_id);
        $("#sb_obj_id").val(sb_obj_id);
        $("#lesson_id").val(lesson_id);
        
        $(".select2").trigger('change');
        });

        $('#subject_id').on('change', function(){
            if (this.value.length !== 0) {
                $('#subject-select-notice').fadeOut();
            }
        });



    </script>

</body>

</html>