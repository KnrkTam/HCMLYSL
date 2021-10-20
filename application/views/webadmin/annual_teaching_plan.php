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
                        <!-- general form elements  -->
                        <!-- <input type="hidden" name="id" value="<?= $id ?>"/> -->
                        <div class="box box-primary">
                            <!-- /.box-header -->

                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>


                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">年度： </label>
                                            <?php form_list_type('year_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $year_id, 'data-placeholder' => '請選擇...', 'enable_value' => $years_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">科目： </label>
                                            <?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_id, 'data-placeholder' => '請選擇...', 'enable_value' => $subjects_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">教職員：
                                            </label>
                                            <?php form_list_type('staff_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $staff_id, 'data-placeholder' => '請選擇...', 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元： </label>
                                            <?php form_list_type('module_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $module_id, 'data-placeholder' => '請選擇...', 'enable_value' => $module_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">教案狀態：
                                            </label>
                                            <?php form_list_type('status_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $status_id, 'data-placeholder' => '請選擇...', 'enable_value' => $status_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="submit" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>
                                </div>




                                <div class="">
                                    <table class="table table-bordered table-striped w-100" id="mainTable">
                                    </table>
                                    <!-- <table class="table table-bordered table-striped w-100" id="outlineTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">

                                                <th class="nowrap">年度</th>
                                                <th class="nowrap">科目</th>
                                                <th class="nowrap">施教組別名稱</th>
                                                <th class="nowrap">單元(一/二/三/四)
                                                </th>
                                                <th class="nowrap">主要任教</th>
                                                <th class="nowrap">編寫教案</th>
                                                <th class="nowrap">年度學習單元</th>
                                                <th class="nowrap">年度教學大鋼</th>
                                                <th class="nowrap">教學計劃(教案)</th>
                                                <th class="nowrap">下載Word</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>2019/2020</td>
                                                <td>語文科1234</td>
                                                <td>忠 1</td>
                                                <td>單元一</td>
                                                <td>XXX, XXX</td>
                                                <td>XXX</td>
                                                <td>1.1 認識自己
                                                </td>
                                                <td><a class="link" href="../webadmin/Bk_teach_outline">查閱</a></td>
                                                <td><a class="link" href="../webadmin/Bk_teach_file/approve">查閱<span class="text-orange">(未提交)</span></a></td>
                                                <td><a class="link" href="#">下載</a></td>
                                            </tr>
                                            <tr>
                                                <td>2019/2020</td>
                                                <td>語文科1234</td>
                                                <td>忠 1</td>
                                                <td>單元一</td>
                                                <td>XXX, XXX</td>
                                                <td>XXX</td>
                                                <td>1.1 認識自己
                                                </td>
                                                <td><a class="link" href="../webadmin/Bk_teach_outline">查閱</a></td>
                                                <td><a class="link" href="../webadmin/Bk_teach_file/preview">查閱<span class="text-green">(已審批)</span></a></td>
                                                <td><a class="link" href="#">下載</a></td>
                                            </tr>
                                            <tr>
                                                <td>2019/2020</td>
                                                <td>語文科1234</td>
                                                <td>忠 1</td>
                                                <td>單元一</td>
                                                <td>XXX, XXX</td>
                                                <td>XXX</td>
                                                <td>1.1 認識自己
                                                </td>
                                                <td><a class="link" href="../webadmin/Bk_teach_file/create01">新增</a></td>
                                                <td><a class="link" href="../webadmin/Bk_teach_file/create01">新增</a></td>
                                                <td><a class="link" href="#">下載</a></td>

                                            </tr>

                                            <tr>

                                                <td>2019/2020</td>
                                                <td>語文科1234</td>
                                                <td>忠 1</td>
                                                <td>單元一</td>
                                                <td>XXX, XXX</td>
                                                <td>XXX</td>
                                                <td>1.1 認識自己
                                                </td>
                                                <td><a class="link" href="../webadmin/Bk_teach_outline">查閱</a></td>
                                                <td><a class="link" href="../webadmin/Bk_teach_file/edit">查閱<span class="text-red">(已拒絕)</span></a></td>
                                                <td><a class="link" href="#" data-toggle="modal" data-target="#view">下載</a></td>

                                            </tr>

                                        </tbody>
                                    </table> -->
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

            let columnDefs = [
                {
                    data: "year",
                    title: "年度",
                    name: 'first',
                },               
                {
                    width: 100,
                    // class: 'col',
                    data: "subject",
                    title: "科目",
                    name: 'first',
                },         
                {
                    // width: '60px',
                    data: "group",
                    title: "施教組別名稱",
                    name: 'first',
                },  
                {
                    width: '60px',
                    data: "module",
                    title: "單元",
                    name: 'first',
                },         
                {
                    // width: '60px',
                    data: "staff",
                    title: "主要任教",
                    name: 'first',
                },    
                {
                    // width: '60px',
                    data: "created_by",
                    title: "編寫教案",
                    name: 'first',
                },    
                {
                    // width: '60px',
                    data: "annual_module",
                    title: "年度學習單元",
                    name: 'first',
                },         
                {
                    // width: '60px',
                    data: "annual_teaching_outline",
                    title: "年度教學大綱",
                    name: 'first',
                },   
                {
                    // width: '60px',
                    data: "annual_teaching_plan",
                    title: "教學計劃(教案)",
                    name: 'first',
                },       
                {
                    // width: '60px',
                    data: "file",
                    title: "下載Word",
                    name: 'first',
                },               
            ]

            let mainTable = $('#mainTable').DataTable({
            scrollX: true,
            "language": {
                "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
            },
            dom: '<"row"<"col-sm-10"B><"col-sm-2"l>>"tifrp',
            "buttons": [{
                extend: 'colvis',
                stateSave: true,
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
            "pageLength": 50,
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
                    let subject_id = $('#subject_id').val();
                    let module_id = $('#module_id').val();
                    let staff_id = $('#staff_id').val();

                    d.subject_id = subject_id;
                    d.module_id = module_id;
                    d.year_id = year_id;
                    d.staff_id = staff_id;
                },

            },
            // 'completed': function(e){
            //     columns.adjust()
            // },
            }); 

        })
    </script>

</body>

</html>