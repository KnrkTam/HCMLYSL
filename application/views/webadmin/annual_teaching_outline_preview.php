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
                                            <p class="mt-2"><?= $week_from ?> 至 <?= $week_to ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h4 class="bold">單元既定大綱內容</h4>
                                        <table class="table table-bordered table-striped" id="previewTable">

                                        </table>



                                        <h4 class="bold pt-4">共通能力/價值觀</h4>

                                        <table class="table table-bordered table-striped" id="previewCommonTable">

                                        </table>

                                        <hr>
                                        <div class="mt-4 d-flex justify-content-end">
                                            <textarea class="hidden" name="added_id[]"><?php echo json_encode($added_ids)?> </textarea>
                                            <textarea class="hidden" name="common_id[]"><?php echo json_encode($common_ids)?> </textarea>
                                            <textarea class="hidden" name="post_data"><?php echo json_encode($post_data)?> </textarea> 
                                            <input class="hidden" name="annual_module" value="<?= $annual_module?>"></input>
                                            <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4">確 定</button>
                                            <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) . '/'. $previous. '/'. $id?>';">返 回</button>
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
            let columnDefs = [
            {
                name: 'first',
                data: "code",
                title: "課程編號",
                class: ""   
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
            }, 
            {

                data: "course",
                title: "課程",
                class: "",
            },
            {

                data: "category",
                title: "範疇",
                class: ""
            }, 
            {

                data: "sb_obj",
                title: "校本課程學習重點",
                class: ""
            }, 
            {

                data: "element",
                title: "學習元素",
                class: ""
            }, 
            {

                data: "expected_outcome",
                title: "預期學習成果",
                class: ""
            }, 
            {
                // render: function(data, type, row) {
                //         if (row.addon == "" || !row.addon) {
                //             let result = '<p style="color:gray">暫無補充內容</p>';
                //             return result;
                //         } else {
                //             // console.log(row.addon);
                //             let result =  '<span class="addonRow">' + data + ' </span><span class="showMoreBtn"><a class="small showMoreText" style="cursor: pointer">顯示</a></span>';
                //             return result;
                //         }
                //     },
                
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
                name: 'first',
                data: "related_lesson",
                title: "相關課程編號",
                class: ""
            }, 
            {
                // render: function(data, type, row) {
                //     if (row.relcode == "" | !row.rel_code) {
                //         let result = '<p style="color:gray">暫無相關項目編號</p>';
                //         return result;
                //     } else {
                //         let result = data;
                //         return result;
                //     }
                // },
                name: 'first',
                data: "rel_code",
                title: "相關項目編號",
                class: ""
            }, 
            {
                name: 'first',
                data: "remarks",
                title: "備註",
                class: ""
            }];

            let subjectTable = $('#previewTable').DataTable({
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
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bSort": false,
                "pageLength": 10,
                "pagingType": "simple",
                "processing": true,
                "bProcessing": true,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "columns": columnDefs,            
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/preview_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        let added_arr = <?= json_encode($added_ids)?>;
                        let year_id = <?= $year_id ?>;
                        console.log('ajax')
                        d.year_id = year_id;
                        d.added_ids = added_arr;
                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });

            let commonTable = $('#previewCommonTable').DataTable({
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
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bSort": false,
                "pageLength": 10,
                "pagingType": "simple",
                "processing": true,
                "bProcessing": true,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "columns": columnDefs,            
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/preview_ajax/'. 'common') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        let common_arr = <?= json_encode($common_ids)?>;
                        let year_id = <?= $year_id ?>;
                        // console.log(typeof(common_arr))
                        d.common_ids = common_arr;
                        d.year_id = year_id;
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