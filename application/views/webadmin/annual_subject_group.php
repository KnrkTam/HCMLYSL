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
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <?php form_list_type('year_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $year_id, 'data-placeholder' => '請選擇...', 'enable_value' => $years_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                    <button type="submit" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>

                                </div>
                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller'].'/create')?>';">新 增</button>

                                <div class="">
                                    <table class="table table-bordered table-striped w-100" id="mainTable">
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
            let columnDefs = [{
                    width: '10px',
                    data: "edit",
                    name: 'first',
                    class: 'no-sort noVis',
                },     
                {
                    class: 'col',
                    data: "subject",
                    title: "科目/服務",
                    name: 'first',
                },               
                {
                    class: 'col',
                    data: "staff",
                    title: "主要任教",
                    name: 'first',
                },               
                {
                    class: 'col',
                    data: "other_staff",
                    title: "其他任教",
                    name: 'first',
                },        
                {
                    width: '60px',
                    data: "module",
                    title: "單元",
                    name: 'first',
                },                
                {
                    width: '60px',
                    data: "group",
                    title: "施教組別名稱",
                    name: 'first',
                },                
                {
                    class: 'col',
                    data: "students",
                    title: "學生名單",
                    name: 'first',
                },                
            ]
            //  table.columns.adjust();
            // $(".searchBtn").click(function() {

                // $(".tableWrap").fadeIn();

            let mainTable = $('#mainTable').DataTable({
            // rowsGroup: [
            //     'first:name',
            // ],
            scrollX: true,
            "language": {
                "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
            },
            dom: 'Bfrtip',
            "buttons": [{
                extend: 'colvis',
                text: '選擇顯示項目',
                columns: ':not(.noVis)',
                columnText: function ( dt, idx, title ) {
                    return title;
                }
            }],
            "order": [],
            'autoWidth': false,
            "bSort": true,
            "info": false,
            "bPaginate": true,
            "pageLength": 10,
            "pagingType": "input",
            "bProcessing": true,
            "processing": true,
            "serverSide": false,
            'searching': false,
            "ordering": true,
            "columns": columnDefs,   
            "ajax": {
                "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
                "method": "get",
                "timeout": "30000",
                "data": function(d) {
                    let year_id = $('#year_id').val();
                    d.year_id = year_id
                },

            },
            }); 


        });



    </script>

</body>

</html>