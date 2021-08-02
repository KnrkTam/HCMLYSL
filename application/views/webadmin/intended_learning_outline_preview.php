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
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">科目：</label>
                                            <h3 class="text-blue"><b><?= $subject?></b></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-nowrap">年度學習單元： </label>
                                        <h3 class="text-blue"><b><?= $annual_module ?></b></h3>
                                    </div>
                                    <div class="col-lg-12">
                                        <hr>

                                        <h5 class="text-yellow"><b>已選項目：</b></h5>

                                        <table class="table table-bordered table-striped" id="previewTable">

                                        </table>
                                        <div class="mt-4 d-flex justify-content-end">
                                            <input type="hidden" name="subject_id" value="<?= $subject_id ?>"></input>
                                            <input type="hidden" name="module_id" value="<?= $module_id?>"></input>
                                            <input type="hidden" name="year_id" value="<?= $year_id ?>"></input>
                                            <input type="hidden" name="lessons_id[]" value=<?= json_encode($added_ids, true)?>></input>
                                            <button type="submit" class="btn bg-maroon mr-4 mw-100">確 定</button>
                                            <button type="button" class="btn btn-default mw-100" onclick="location.href='<?= (admin_url($page_setting['controller'])) . '/'. $previous. '/'. $subject_lesson_id?>';">返 回</button>
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

            let columnDefs = [{
                    data: "0",
                    title: "科目",
                    name: 'first',
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

            var subjectTable = $('#previewTable').DataTable({
                scrollX: true,
                rowsGroup: [
                    'first:name',
                ],
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bSort": false,
                "pageLength": 10,
                "pagingType": "simple",
                "processing": false,
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
                        // console.log(typeof(added_arr))
                        d.added_ids = added_arr;
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