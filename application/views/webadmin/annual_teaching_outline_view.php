<!DOCTYPE html>
<html lang="en">

<head>
    <style> 
        .addonRow {
            display: none;
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
                    <li class="active"><a href="<?=admin_url($page_setting['controller'])?>"><?= ($page_setting['scope']) ?></a></li>
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
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <p><?= $year?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">科目： </label>
                                            <p><?= $subject?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">施教組別名稱： </label>
                                            <p><?= $group_name?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex">

                                        <div class="form-group w-100">
                                            <label class="text-nowrap">年度學習單元: </label>
                                            <p><?= $annual_module?></p>

                                        </div>


                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元： </label>
                                            <p><?= $module ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">週次： </label>
                                            <p class="mt-2"><?= $week_from ? $week_from .' 至 '. $week_to : 'NA' ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h4 class="bold">單元既定大綱內容</h4>
                                        <button type="submit" class="btn btn-warning mw-100 mb-4 mr-4"><i class="fa fa-edit"></i>修改補充內容</button>

                                        <table class="table table-bordered table-striped" id="viewTable">
                                        </table>



                                        <h4 class="bold pt-4">共通能力/價值觀</h4>

                                        <table class="table table-bordered table-striped" id="commonTable">

                                        </table>

                                        <hr>
                                        <div class="mt-4 d-flex justify-content-end">
                                            <textarea class="hidden" name="added_id[]"><?php echo json_encode($added_ids)?> </textarea>
                                            <textarea class="hidden" name="common_id[]"><?php echo json_encode($common_ids)?> </textarea>
                                            <textarea class="hidden" name="post_data"><?php echo json_encode($post_data)?> </textarea> 
                                            <input class="hidden" name="annual_module" value="<?= $annual_module?>"></input>
                                            <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4">確 定</button>
                                            <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">返 回</button>
                                            <!-- <button type="button" class="btn btn-default mw-100 mb-4" onclick="history.go(-1)">返 回</button> -->
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
            $(document).on("click", ".showMoreBtn", function() {
                $(this).parent().parent().find(".addonRow").slideToggle('slow', function() {
                    if ($(this).is(':visible')){
                        $(this).parent().parent().find(".showMoreText").text("隱藏");
                    } else {
                        $(this).parent().parent().find(".showMoreText").text("顯示");
                    }
                });
            });
            let data = <?php echo json_encode($table_data)?>;
            let common_data = <?php echo json_encode($common_data) ?>;
            console.log(common_data);
            let columnDefs = [
            {
                name: 'first',
                data: "code",
                title: "課程編號",
                class: ""   ,
            }, 
            {

                data: "group",
                title: "組別",
                class: "",
                name: 'first',

            },
            {
                data: "subject",
                title: "科目",
                class: "",
                width: "120px",
                name: 'first',

            }, 
            {

                data: "course",
                title: "課程",
                class: "",
                name: 'first',

            },
            {

                data: "category",
                title: "範疇",
                class: "",
                name: 'first',

            }, 
            {

                data: "sb_obj",
                title: "校本課程學習重點",
                class: "",
                name: 'first',

            }, 
            {

                data: "element",
                title: "學習元素",
                class: "",
                name: 'first',

            }, 
            {

                data: "expected_outcome",
                title: "預期學習成果",
                class: "",
                name: 'first',
            }, 
            {          
                data: "addon",
                title: "補充內容",
                class: "w-180px"
            }, 
            {
                data: "performance",
                title: "關鍵表現項目",
                class: "",
                name: 'first',
                
            }, 
            {
                data: "assessment",
                title: "評估模式",
                class: "",
                name: 'first',
            },  
            {
                render: function(data, type, row) {
                        if (row.related_lesson == "" || !row.related_lesson) {
                            let result = '<p style="color:gray">暫無相關課程編號</p>';
                            return result;
                        } else {
                            str_arr = data.split(',');
                            str = "";
                            for (i = 0; i < str_arr.length; i++) {
                                str += '<button type="button" class="btn-xs btn btn-primary badge">' + str_arr[i] + ' </button> ';
                            }
                            let result =  str;
                            return result;
                        }
                    },
                name: 'first',
                data: "related_lesson",
                title: "相關課程編號",
                class: ""

            }, 
            {

                name: 'first',
                data: "rel_code",
                title: "相關項目編號",
                class: ""
            }, 
            {
                render: function(data, type, row) {
                        if (row.remarks == "" || !row.remarks) {
                            let result = '<p style="color:gray">暫無任何備註</p>';
                            return result;
                        } else {
                            str_arr = data.split(',');
                            str = "";
                            for (i = 0; i < str_arr.length; i++) {
                                str += '<button type="button" class="btn-xs btn btn-primary badge">' + str_arr[i] + ' </button> ';
                            }
                            let result =  str;
                            return result;
                        }
                    },
                name: 'first',
                data: "remarks",
                title: "備註",
                class: ""
            }];

            let subjectTable = $('#viewTable').DataTable({
                scrollX: true,
                rowsGroup: [
                    'first:name',
                ],
                dom: 'Bfrtip',
                "buttons": [{
                    extend: 'colvis',
                    text: '選擇顯示項目',
                    columns: ':not(.noVis)',
                    columnText: function ( dt, idx, title ) {
                        return title;
                    }
                }],
                data: data,

                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bSort": false,
                "pageLength": 10,
                "pagingType": "simple",
                "processing": true,
                "bProcessing": true,
                "serverSide": false,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "columns": columnDefs,            
            });

            let commonTable = $('#commonTable').DataTable({
                scrollX: true,
                data: common_data,
                rowsGroup: [
                    'first:name',
                ],
                dom: 'Bfrtip',
                "buttons": [{
                    extend: 'colvis',
                    text: '選擇顯示項目',
                    columns: ':not(.noVis)',
                    columnText: function ( dt, idx, title ) {
                        return title;
                    }
                }],
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bSort": false,
                "pageLength": 10,
                "pagingType": "simple",
                "processing": true,
                "bProcessing": true,
                "serverSide": false,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "columns": columnDefs,            
        
            });
        });
    </script>

</body>

</html>