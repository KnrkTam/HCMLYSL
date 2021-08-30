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

                                <button type="button" class="btn btn-info mw-100 mb-4" id="read-btn" data-toggle="modal" data-target="#cloneList">複製年度教職員</button>
                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller'].'/create')?>';">新 增</button>


                                <div class="tableWrap">
                                    <table class="table table-bordered table-striped w-100" id="mainTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">
                                                <th class="no-sort" style="min-width: 4px;  max-width:15px"></th>
                                                <th class="nowrap">年度</th>
                                                <th class="nowrap">職位</th>
                                                <th class="nowrap">姓名</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
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
        <div class="modal fade in" tabindex="-1" role="dialog" id="cloneList">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">複製本年度教職員 <span id="title"></span> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                    <table class="table table-bordered table-striped w-100" id="renderTable">
                                    </table>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="clone-btn" class="btn btn-success">確 定</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>


        <?php include_once("footer.php"); ?>





    </div>
    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>
    <script>
        $(document).ready(function() {

            $(".searchBtn").click(function() {
                $('#mainTable').DataTable.draw();
            });

            let AnnualStaffTable = $('#mainTable').DataTable({
                scrollX: true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
          
                "order": [],
                "bSort": false,
                "bPaginate": true,
                "pageLength": 10,
                "pagingType": "input",
                // "columns": columnDefs,   
                "processing": true,
                "serverSide": false,
                "ordering": true,
                "searching": false,
                // dom: "rtiS",
                // deferRender: true,
                "searchDelay": 0,     
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        console.log('ajax')
                        let year_id = $('#year_id').val();
                        d.year_search = year_id;
                    },
                    "complete" : function(){
                        $('[data-toggle="tooltip"]').tooltip();

                    },
                    "error": function(e) {
                        alertify.error('error')
                    },
                },
            });

            var columnDefs = [
                // {
                //     render: function(data, type, row) {
                //         let result = '<input class="staff_id[]" value="' + row.id +'"></input>';
                //         return result;
                //     },
                //     name: 'first',
                //     data: "id",
                //     class: 'hidden',
                // },
                // {
                //     render: function(data, type, row) {
                //         let result = '<input class="position_id[]" value="' + row.position_id+'"></input>';
                //         console.log(row);
                //         return result;
                //     },
                //     name: 'first',
                //     data: "position_id",
                //     class: 'hidden',
                // },
                {
                    name: 'first',
                    data: "year",
                    title: "年度",
                    class: 'col',
                },
                {
                    name: 'first',
                    data: "position",
                    title: "職位",
                    width: '100px',
                },
                {
                    name: 'first',
                    data: "name",
                    title: "姓名",
                    class: 'col',
                },
            ]

            let renderTable = $('#renderTable').DataTable({
                scrollX: true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bSort": false,
                "bPaginate": true,
                "pageLength": 10,
                "pagingType": "input",
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                }] ,
                "autoWidth": true,

                "processing": true,
                "serverSide": false,
                "ordering": true,
                "searching": false,
                "columns": columnDefs,   
                "searchDelay": 0,     
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/render_staff') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
        

                    },
                    "complete" : function(){
                        $('[data-toggle="tooltip"]').tooltip();
                        console.log('rendered');

                    },
                    "error": function(e) {
                        alertify.error('error')
                    },
                },
            });

            
            let jsonData = {};

            let cloneBtn = document.querySelector('#clone-btn');
            cloneBtn.addEventListener("click",function(){
                // let staff_id = [];
                // let position_id =[];
                createModule();
                function createModule(){
                    $.ajax({
                    url: '<?= (admin_url($page_setting['controller'])) . '/cloneAPI' ?>',
                    method:'POST',
                    data: jsonData,
                    dataType:'json',     
                    success:function(data){
                        alertify.success(data.msg)
                        location.reload();

                    },
                    error: function(error){
                        alertify.error(error);

                        
                    }
                    });
                } 
            })

            function checkClone(year_id) {
                let this_year = <?= $year_id?>;                
                if (year_id == this_year){
                    $('#read-btn').show();
                } else if (year_id !== this_year) {
                    $('#read-btn').hide();
                };
            }
            checkClone($('#year_id').val())

            $('#year_id').on('change', function () {
                checkClone(this.value)

            });

        });




    </script>

</body>

</html>