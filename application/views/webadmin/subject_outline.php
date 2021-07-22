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
                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">科目 : </label>
                                            <div style="flex: 1"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">科目範疇 : </label>
                                            <div style="flex: 1"><?php form_list_type('subject_category_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $sub_categories_list, 'form_validation_rules' => 'trim|required']) ?></div>

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
                                        <button type="submit" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>

                                </div>
                                <div id="newBtn"> </div>



                                <div class="tableWrap">
                                    <table class="table table-bordered table-striped" id="subjectCourseTable">
             


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

        <?php include_once "footer.php"; ?>

    </div>




    <!-- ./wrapper -->
    <?php include_once "script.php"; ?>





    <script>
        $(document).ready(function() {


            $('#subject_id').change(function() {
            ajax_choose(this.value)
            function ajax_choose(subject_id) {
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/select_subject' ?>',
                method:'POST',
                data:{subject_id:subject_id},
                dataType:'json',
                success:function(data){
                    $('#newBtn').fadeIn("slow", function() {});
                    $('#newBtn').html(`<button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller'] . '/create/') ?>${data.id}'">加入關建表現項目至新科目課程</button>`)
                    // $('#expected_outcome').val(data.expected_outcome);
                    // $('#expected_outcome_text').html(data.expected_outcome);
                    // console.log(data)
                }
                })
            }
        })
            $('[data-toggle="tooltip"]').tooltip();


            let columnDefs = [{
                    name: 'zore',
                    title: "",
                    class: "no-sort"
                },
                {
                    data: "1",
                    title: "科目範疇",
                    name: 'first',
                },          
                {
                    data: "2",
                    title: "課程編號",
                    name: 'first',
                },        
                {
                    data: "3",
                    title: "課程",
                    name: 'first',
                },                
                {
                    data: "4",
                    title: "範疇",
                    name: 'first',
                },                
                {
                    data: "5",
                    title: "校本課程學習重點",
                    name: 'first',
                },                
                {
                    data: "6",
                    title: "學習元素",
                    name: 'first',
                },                
                {
                    data: "7",
                    title: "組別",
                    name: 'first',
                },                
                {
                    data: "8",
                    title: "LPF(基礎)",
                    name: 'first',
                },                
                {
                    data: "9",
                    title: "LPF(高中)",
                    name: 'first',
                },                
                {
                    data: "10",
                    title: "POAS",
                    name: 'first',
                },                
                {
                    data: "11",
                    title: "Key Skill",
                    name: 'first',
                },                
                {
                    data: "12",
                    title: "預期學習成果",
                    name: 'first',
                },                
                {
                    data: "13",
                    title: "關鍵表現項目",
                    name: 'double',
                },                
                {
                    data: "14",
                    title: "評估模式",
                    name: 'double',
                },                
                {
                    data: "15",
                    title: "相關課程編號",
                    name: 'first',
                },                
                {
                    data: "16",
                    title: "相關項目編號",
                    name: 'first',
                },                
                {
                    data: "17",
                    title: "備註",
                    name: 'first',
                },              
            ];

  

            let Main_table = $('#subjectCourseTable').DataTable({
                // scrollY: '300px',
                scrollX: true,
                rowsGroup: [
                        'zore:name',
                        'first:name',
                    ],
                // 'rowsGroup': [],
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                // "order": [],
                "bSort": false,
                "bPaginate": false,
                "pageLength": 50,
                "pagingType": "input",
                //"sDom": '<"wrapper"lfptip>',
                "processing": true,
                "serverSide": false,
                "ordering": true,
                // "searching": true,
                // "drawType": 'none',
                "searchDelay": 0,     
                "columns": columnDefs,            
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
                    "method": "post",
                    "timeout": "30000",
                    "data": function(d) {

                        <?php if ($sb_obj_id) {?>
                            $('#sb_obj_id').val(<?= json_encode($sb_obj_id)?>).change();
                        <?}?>

                        <?php if ($lesson_id) {?>
                            $('#lesson_id').val(<?= json_encode($lesson_id) ?>).change();
                            $('#sb_obj_id').val(null).trigger('change');
                            $('#subject_id').val(0).trigger('change');
                            $('#subject_category_id').val(0).trigger('change');

                        <?}?>

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
                    
                    if (d.subject_search) {
                        $('#newBtn').fadeIn("slow", function() {});
                        $('#newBtn').html(`<button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller'] . '/create/') ?>${d.subject_search}'">新 增</button>`)    
                    }

                    },
                
                    "complete" : function(){
                        $('[data-toggle="tooltip"]').tooltip();

                    },
                    "error": function(e) {
                        console.log(e);
                    },
                    drawCallback: function(settings) {
                        console.log(data)

                        $('[data-toggle="tooltip"]').tooltip();

                    },
                },
                });
                
            $(".searchBtn").click(function() {

                $(".tableWrap").fadeIn();
                Main_table.draw();
            });

            let data =  <?php echo $sub_categories_list?>;
            let sub_id = <?php echo $subject_categories_id ?  $subject_categories_id : 0?>;
            let sb_obj_id = <?php echo $sb_obj_id ?  $sb_obj_id : 0?>;
            let lesson_id = <?php echo $lesson_id ?  $lesson_id : 0?>;

            $('#subject_category_id').select2({
                data: data
            })
            $("#sb_obj_id").val(sb_obj_id);
            $("#subject_category_id").val(sub_id);
            $("#lesson_id").val(lesson_id);
            $("#lesson_id").trigger('change');
            $(".select2").trigger('change');


        });
    </script>

</body>

</html>