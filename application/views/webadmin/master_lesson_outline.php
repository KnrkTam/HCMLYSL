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
                    
                        <div class="box box-primary">
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>


                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">課程 : </label>
                                            <div style="flex: 1"><?php form_list_type('courses_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' => 0 , 'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">課程範疇 : </label>
                                            <div style="flex: 1"><?php form_list_type('categories_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' => $category_id ,  'form_validation_rules' => 'trim|required','disable_please_select' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">


                                        <div class="form-group w-100">
                                            <label class="text-nowrap">校本課程學習重點 : (多項選擇) </label>
                                            <div style="flex: 1"><?php form_list_type('sb_obj_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $sb_obj_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1, 'disable_please_select' => 1]) ?></div>

                                        </div>
                                        <span class="ml-2 mr-2 mt-2">或</span>
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">課程編號 : (多項選擇) </label>
                                            <div style="flex: 1"><?php form_list_type('lesson_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $lessons_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="submit" class="btn btn-success mt-25 w-100 mb-4 searchBtn" >搜 尋</button>
                                    </div>
                                </div>
                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= (admin_url($page_setting['controller'])) . '/create'?>';">新 增</button>
                                <div class="tableWrap">
                                    <table class="table table-bordered table-striped" id="Course_datatable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette" style="z-index: -1000;">
                                                <th class="no-sort" style="min-width: 4px;"></th>
                                                <th class="nowrap">課程</th>
                                                <th class="nowrap">課程範疇</th>
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
                                                <th class="nowrap">相關課程編號</th>
                                                <th class="nowrap">相關項目編號</th>
                                            </tr>
                                        </thead>
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

            let Course_datatable = $('#Course_datatable').DataTable({
                scrollX: true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bSort": false,
                "pageLength": 10,
                "pagingType": "input",
                //"sDom": '<"wrapper"lfptip>',
                "processing": true,
                "serverSide": false,
                "ordering": true,
                "searching": true,
                "searchDelay": 0,
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        <?php if ($sb_obj_id) {?>
                            $('#sb_obj_id').val(<?= json_encode($sb_obj_id)?>).change();
                        <?}?>

                        <?php if ($lesson_id) {?>
                            $('#lesson_id').val(<?= json_encode($lesson_id) ?>).change();
                            $('#sb_obj_id').val(null).trigger('change');
                            $('#courses_id').val(0).trigger('change');
                            $('#categories_id').val(0).trigger('change');

                        <?}?>

                        let course_id = $('#courses_id').val();
                        let category_id = $('#categories_id').val();
                        let sb_obj_id = $('#sb_obj_id').val();
                        let lesson_id = $('#lesson_id').val();
                        d.course_search = course_id;
                        d.category_search = category_id;
                        d.sb_obj_search = sb_obj_id;
                        d.lesson_search = lesson_id;

                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });



            $(".searchBtn").click(function() {
                Course_datatable.draw();

            });

            let data = <?php echo json_encode($categories_list)?>

            $('#categories_id').select2({
                data: data,
            })

            $("#categories_id").val(<?php echo $category_id ?>);
            $("#categories_id").trigger('change');
            $('#categories_id').change(function() {
                $('#courses_id').val(0).trigger('change');
            })

            // $('#categories_id').change(function() {
            //     $('#categories_id').trigger('change');
            // })

        });

    </script>

</body>

</html>