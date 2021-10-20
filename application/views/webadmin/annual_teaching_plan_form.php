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
                            <!-- /.box-header -->

                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>


                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <p><?= $year?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">科目： </label>
                                            <p><?= $subject?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">施教組別名稱： </label>
                                            <p><?= $group_name?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex">

                                        <div class="form-group w-100">
                                            <label class="text-nowrap">年度學習單元: </label>
                                            <p><?= $annual_module?></p>
                                        </div>


                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元： </label>
                                            <p><?= $module ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元日期 : </label>
                                            <p class="mt-2"><?= $date_from ?> 至 <?= $date_to ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">週次： </label>
                                            <p class="mt-2"><?= $week_from ?> 至 <?= $week_to ?></p>

                                        </div>
                                    </div>
                                </div>

                                <h4 class="bold pt-4">選擇加入至年度教案的課程：</h4>
                                <table class="table table-bordered table-striped dataTable" id="subjectTable">
                                </table>


                                <h4 class="bold pt-4">選擇共通能力/價值觀：</h4>
                                <table class="table table-bordered table-striped" id="commonTable">

                                </table>

                                <hr>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn bg-purple mw-100 mb-4 mr-4">下 一 步</button>
                                    <input class="hidden" name="asg_id" value=<?= $asg_id ?> />
                                    <input class="hidden" name="ato_id" value=<?= $id ?> />

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
    <script>
        $(document).ready(function() {

            var columnDefs = [{
                render: function(data, type, row) {
                    var result = `<input type="checkbox" name="subjectCheck[]" class="subjectCheck" value="${data}" />`;
                    return result;
                    // data: null,
                    // title: "操作",
                    // defaultContent:
                    // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-lg">Delete</a>'
                    // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-lg">Edit Btn</a>'
                },
                data: "id",
                title: "",
                class: "no-sort w-10px"
            }, {

                data: "subject",
                title: "科目",
                class: "",
                name:"first"

            }, {

                data: "course",
                title: "課程",
                class: "",
                name:"first"

            }, {

                data: "category",
                title: "範疇",
                class: "",
                name:"first"

            }, {

                data: "sb_obj",
                title: "校本課程學習重點",
                class: "",
                name:"first"

            }, {

                data: "element",
                title: "學習元素",
                class: "",
                name:"first"

            }, {

                data: "group",
                title: "組別",
                class: "",
                name:"first"

            }, {

                data: "expected_outcome",
                title: "預期學習成果",
                class: "",
                name:"first"

            }, {
                data: "addon",
                title: "補充內容",
                class: "w-90px",
                name:"first"

            }, {
                data: "performance",
                title: "關鍵表現項目",
                class: "",
                name:"first"

            }, {
                data: "assessment",
                title: "評估模式",
                class: ""
            }, {

                data: "code",
                title: "課程編號",
                class: "",
                name:"first"
            }, {
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
                data: "related_lesson",
                title: "相關課程編號",
                class: ""
            }, {

                data: "rel_code",
                title: "相關項目編號",
                class: ""
            }, {

                data: "remarks",
                title: "備註",
                class: ""
            }];


            let year_id = <?= $year_id ?>;
            let data = <?php echo json_encode($table_data)?>;

            let subjectTable = $('#subjectTable').DataTable({
                scrollX: true,
                rowsGroup: [
                    'first:name',
                ],
                dom: 'frtip',
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
            let common_data = <?php echo json_encode($common_data) ?>;

            let commonTable = $('#commonTable').DataTable({
                scrollX: true,
                data: common_data,
                rowsGroup: [
                    'first:name',
                ],
                dom: 'frtip',
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