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
                        <div class="box box-primary">
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <div class="row mb-4">
                                <div class="col-lg-12">
                                            <h5 class="text-red"><b>選擇科目及年度學習單元：</b></h5>
                                        </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap"><span class="text-red">*</span>科目： </label>
                                            <div style="flex: 1"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_id,  'data-placeholder' => '請選擇...', 'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="d-flex">
                                            <div class="form-group w-100">
                                                <label class="text-nowrap"><span class="text-red">*</span>年度學習單元：</label>
                                                <div style="flex: 1"><?php form_list_type('module_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $module_id,  'data-placeholder' => '請選擇...', 'enable_value' => $annual_modules_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                            </div>
                                            <div style="margin-top:25px" class="ml-4">
                                                <button type="button" class="btn bg-orange mb-4" data-toggle="modal" data-target="#editDetail">新增單元名稱</button>
                                            </div>
                                            <a href="#" class="link nowrap mt-30 ml-2 controlSearchBtn">隱藏搜尋</a>
                                        </div>
                                    </div>

                                </div>
                                <hr>

                                <div class="">
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <h5 class="text-red"><b>搜尋課程學習重點：</b></h5>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="text-nowrap">科目範疇:</label>
                                                <div style="flex: 1"><?php form_list_type('subject_category_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_category_id, 'enable_value' => $subject_categories_list,  'data-placeholder' => '請選擇...', 'form_validation_rules' => 'trim|required']) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-nowrap">校本課程學習重點:</label>
                                                <div style="flex: 1"><?php form_list_type('sb_obj_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => '', 'enable_value' => $sb_obj_list, 'data-placeholder' => '請選擇...', 'form_validation_rules' => 'trim|required']) ?></div>

                                            </div>
                                        </div>

                                        <div class="col-lg-1">
                                            <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tableWrap">
                                    <h5 class="text-purple"><b>選擇教學大綱項目：</b></h5>
                                    <table class="table table-bordered table-striped dataTable" id="subjectTable">

                                    </table>

                                    <hr>
                                    <h5 class="text-yellow"><b>已選項目：</b></h5>

                                    <table class="table table-bordered table-striped" id="subjectSelectedTable">

                                    </table>
                                    <div class="mt-4 d-flex justify-content-end">
                                    <input type="hidden" name="action" value="create"/>
                                    <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4">下一步</button>
                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">返 回</button>
                                    <input type="hidden" id="subject_lessons" name="subject_lessons[]" value=""></input>

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



    <div class="modal fade in" tabindex="-1" role="dialog" id="editDetail">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title bold">新增單元名稱
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h3>

                </div>
                <div class="modal-body">

                    <div class="row mb-4">



                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-nowrap">單元名稱： </label>
                                <input type="text" class="form-control" value="">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-orange">確 定</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip();
            let columnDefs = [{
                    name: 'zore',
                    title: "",
                    class: "no-sort"
                },
                {
                    data: "1",
                    title: "科目",
                    name: 'first',
                },         
                {
                    data: "2",
                    title: "科目範疇",
                    name: 'first',
                },    
                {
                    data: "3",
                    title: "課程編號",
                    name: 'first',
                },        
                {
                    data: "4",
                    title: "課程",
                    name: 'first',
                },                
                {
                    data: "5",
                    title: "範疇",
                    name: 'first',
                },                
                {
                    data: "6",
                    title: "校本課程學習重點",
                    name: 'first',
                },                
                {
                    data: "7",
                    title: "學習元素",
                    name: 'first',
                },                
                {
                    data: "8",
                    title: "組別",
                    name: 'first',
                },                
                {
                    data: "9",
                    title: "LPF(基礎)",
                    name: 'first',
                },                
                {
                    data: "10",
                    title: "LPF(高中)",
                    name: 'first',
                },                
                {
                    data: "11",
                    title: "POAS",
                    name: 'first',
                },                
                {
                    data: "12",
                    title: "Key Skill",
                    name: 'first',
                },                
                {
                    data: "13",
                    title: "預期學習成果",
                    name: 'first',
                },                
                {
                    data: "14",
                    title: "關鍵表現項目",
                    name: 'double',
                },                
                {
                    data: "15",
                    title: "評估模式",
                    name: 'double',
                },                
                {
                    data: "16",
                    title: "相關課程編號",
                    name: 'first',
                },                
                {
                    data: "17",
                    title: "相關項目編號",
                    name: 'first',
                },                
                {
                    data: "18",
                    title: "備註",
                    name: 'first',
                },              
            ];


            $(".searchBtn").click(function() {
                $(".tableWrap").fadeIn();
                Subject_dataTable.draw()

            });
            let added_ids = new Set();

            $('input[id=subject_lessons]').val(Array.from(added_ids));

            var  Subject_dataTable = $('#subjectTable').DataTable({
                scrollX: true,
                rowsGroup: [
                    'zore:name',
                    'first:name',
                ],
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
                "searchDelay": 0,
                "columns": columnDefs,            

                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/search_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        let subject_id = $('#subject_id').val();
                        let annual_module_id = $('#annual_module_id').val();
                        let category_id = $('#subject_category_id').val();
                        let sb_obj_id = $('#sb_obj_id').val();

                        d.annual_module_search = annual_module_id;
                        d.subject_category_search = category_id;
                        d.sb_obj_search = sb_obj_id;
                        d.subject_search = subject_id;
                    },
                    "complete": function(e){
                        console.log(e);  
                        $('[data-toggle="tooltip"]').tooltip();
                        $(".addLesson").change(function(e) {
                            console.log('clicked', this.value)
                            if ($(this).is(':checked')) {
                                added_ids.add(this.value)

                                e.stopPropagation();
                                $(".tableWrap").fadeIn();

                                subjectSelectedTable.draw();
                            } else {
                                added_ids.delete(this.value)
                                $(".tableWrap").fadeIn();

                                subjectSelectedTable.draw();

                            }
                            console.log(added_ids);

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
                rowsGroup: [
                    'zore:name',
                    'first:name',
                ],
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
                "columns": columnDefs,            
                "bPaginate": true,
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


            $(".controlSearchBtn").click(function() {

                $(".subject_outcomeNew").slideToggle('slow', function() {
                    $('.controlSearchBtn').toggleClass('active', $(this).is(':visible'));
                    if ($('.controlSearchBtn').hasClass("active")) {
                        $(".controlSearchBtn").text("隱藏搜尋");
                    } else {
                        $(".controlSearchBtn").text("顯示搜尋");
                    }
                });


            });
        

            
            function ajax_choose(subject_id) {
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/select_subject' ?>',
                method:'POST',
                data:{subject_id:subject_id},
                dataType:'json',
                beforeSend:function(){
                    $('#subject_category_id').empty();
                    },
                success:function(d){
                    $('#subject_category_id').select2({
                        data: d
                    });
                    $('#subejct_category_id').val(<?= $_POST['subject_category_id']?>)
                    console.log(<?= $_POST['subject_category_id']?>)
                    },
                })
            }

            $("#subject_id").change(function() {
                ajax_choose(this.value)
                $(".controlSearchBtn").fadeIn();
                $(".controlSearchBtn").text("隱藏搜尋");
            })

            <?php if ($_SESSION['post_data']['subject_id']) { ?>
                ajax_choose(<?= $_SESSION['post_data']['subject_id'] ?>)

            <? } ?>
        });

        
    </script>

</body>

</html>