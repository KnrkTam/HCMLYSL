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
                                    <!-- <table class="table table-bordered table-striped w-100" id="settingTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">
                                                <th class="no-sort" style="min-width: 4px;  max-width:15px"></th>
                                                <th class="nowrap">服務</th>
                                                <th class="nowrap">負責人</th>
                                                <th class="nowrap">其他人員</th>
                                                <th class="nowrap">單元</th>
                                                <th class="nowrap">施教組別名稱</th>
                                                <th class="nowrap">學生名單</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td><a class="editLinkBtn" href="../webadmin/Bk_group_service/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>個別化學習計劃及支援性教學</td>
                                                <td>xxx, xxx</td>
                                                <td></td>
                                                <td>單元一</td>
                                                <td>忠1</td>
                                                <td>陳xx(善), 陳xx(善),</td>
                                            </tr>
                                            <tr>

                                                <td><a class="editLinkBtn" href="../webadmin/Bk_group_service/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>言語治療</td>
                                                <td>xxx, xxx</td>
                                                <td>xxx, xxx</td>
                                                <td>單元三</td>
                                                <td>忠1</td>
                                                <td>陳xx(善), 陳xx(德),</td>

                                            </tr>
                                            <tr>

                                                <td><a class="editLinkBtn" href="../webadmin/Bk_group_service/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>個別化學習計劃及支援性教學</td>
                                                <td>xxx, xxx</td>
                                                <td>xxx, xxx</td>
                                                <td>單元一</td>
                                                <td>仁</td>
                                                <td>陳xx(信), 陳xx(德),</td>


                                            </tr>

                                            <tr>

                                                <td><a class="editLinkBtn" href="../webadmin/Bk_group_service/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>言語治療</td>
                                                <td>xxx, xxx</td>
                                                <td>xxx, xxx</td>
                                                <td>單元二</td>
                                                <td>仁</td>
                                                <td>陳xx(信), 陳xx(德),</td>



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
            let columnDefs = [{
                    width: '10px',
                    data: "edit",
                    name: 'first',
                    class: 'no-sort noVis',
                },     
                {
                    // width: '60px',
                    data: "subject",
                    title: "服務",
                    name: 'first',
                    class: 'col',

                },               
                {
                    class: 'col',
                    data: "staff",
                    title: "負責人",
                    name: 'first',
                },               
                {
                    class: 'col',
                    data: "other_staff",
                    title: "其他人員",
                    name: 'first',
                },        
                {
                    width: '60px',
                    data: "module",
                    title: "單元",
                    name: 'first',
                },                
                {
                    // class: 'col',
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