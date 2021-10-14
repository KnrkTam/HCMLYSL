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
                                            <?php form_list_type('year_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $year_id, 'data-placeholder' => '請選擇...','value' => $year_id, 'enable_value' => $years_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="text-nowrap">學階： </label>
                                            <?php form_list_type('level_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $levels_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="submit" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>

                                </div>


                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller'].'/create')?>';">新 增</button>


                                <div class="tableWrap ">
                                   <table class="table table-bordered table-striped w-100" id="moduleWeekTable">
                                         <!-- <thead>
                                            <tr class="bg-light-blue color-palette">
                                                <th class="no-sort" style="min-width: 4px;  max-width:15px"></th>
                                                <th class="nowrap">年度</th>
                                                <th class="nowrap">學階</th>
                                                <th class="nowrap">日期</th>
                                                <th class="nowrap">週次</th>
                                                <th class="nowrap">評估日期一</th>
                                                <th class="nowrap">評估日期二</th>

                                            </tr>
                                        </thead>

                                        <tbody>
        
                                        </tbody> -->
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
                    name: 'zore',
                    title: "",
                    class: "no-sort"
                },
                {
                    name: 'first',
                    data: "1",
                    title: "年度",
                    class: "",
                },
                {
                    name: 'first',
                    data: "2",
                    title: "學階",
                    class: "",

                },
                {

                    data: "3",
                    title: "日期",
                    class: ""
                },
                {

                    data: "4",
                    title: "週次",
                    class: ""
                },
                {

                    data: "5",
                    title: "評估日期1",
                    class: ""
                },
                {

                    data: "6",
                    title: "評估日期2",
                    class: ""
                }
            ];


            let ModuleWeekTable = $('#moduleWeekTable').DataTable({
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
                "bPaginate": false,
                "pageLength": 50,
                "pagingType": "input",
                "processing": true,
                "serverSide": false,
                "ordering": true,
                "searching": false,
                dom: "rtiS",
                deferRender: true,
                "columns": columnDefs,            
                "searchDelay": 0,     
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
                    "method": "post",
                    "timeout": "30000",
                    "data": function(d) {
                        let year_id = $('#year_id').val();
                        let level_id = $('#level_id').val();

                        d.level_search = level_id;
                        d.year_search = year_id;
                        console.log(d)
                    },
                    "complete" : function(){
                        
                    },
                    "error": function(e) {
                        // console.log(e);
                    },    
                },
            });

            
            $(".searchBtn").click(function() {
                ModuleWeekTable.draw();
                console.log('clicked')
            });

        });            


    </script>

</body>

</html>