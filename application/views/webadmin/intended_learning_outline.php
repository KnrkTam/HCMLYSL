<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("head.php"); ?>
    <style>
        .big-col {
            width: 400px !important;
            position: relative;
        }
        .col {
            width: 100px;
            position: relative;

        }
        table {
            table-layout:fixed;
        } 
        .highlight{
            position:absolute;
            right: 5%;
            bottom: 5%;
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
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap"><span class="text-red">*</span>科目： </label>
                                            <div style="flex: 1"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_id,  'data-placeholder' => '請選擇...', 'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>年度學習單元：</label>
                                            <div style="flex: 1"><?php form_list_type('annual_module_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $annual_module_id,  'data-placeholder' => '請選擇...', 'enable_value' => $annual_modules_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">科目範疇:</label>
                                            <div style="flex: 1"><?php form_list_type('subject_category_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_category_id, 'enable_value' => $subject_categories_list,  'data-placeholder' => '請選擇...', 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">備註：</label>
                                            <div style="flex: 1"><?php form_list_type('remark_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $remark_id, 'enable_value' => $remarks_list, 'data-placeholder' => '請選擇...', 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>

                                </div>




                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller'].'/create')?>';">新 增</button>


                                <div class="">
                                    <ul class="colorMapList inlinelist mb-4">
                                        <li class="text-aqua bold">非華語</li>
                                        <li class="text-green bold">新生入學評估</li>
                                    </ul>
                                    <table class="table table-bordered table-striped" id="mainTable">

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

            $('[data-toggle="tooltip"]').tooltip();
            let columnDefs = [{
                    width: '10px',
                    data: "0",
                    name: 'first',
                    class: 'no-sort',
                },     
                {
                    width: '60px',
                    data: "1",
                    title: "科目",
                    name: 'first',
                },               
                {
                    class: 'col',
                    data: "2",
                    title: "科目範疇",
                    name: 'first',
                },               
                {
                    class: 'col',
                    data: "3",
                    title: "課程編號",
                    name: 'first',
                },        
                {
                    class: 'col',

                    data: "4",
                    title: "課程",
                    name: 'first',
                },                
                {
                    class: 'col',

                    data: "5",
                    title: "範疇",
                    name: 'first',
                },                
                {
                    width: '120px',
                    data: "6",
                    title: "校本課程學習重點",
                    name: 'first',
                },                
                {
                    width: '100px',
                    data: "7",
                    title: "學習元素",
                    name: 'first',
                },                
                {
                    class: 'col',
                    data: "8",
                    title: "組別",
                    name: 'first',
                },                
                {
                    class: 'col',
                    data: "9",
                    title: "LPF(基礎)",
                    name: 'first',
                },                
                {
                    class: 'col',

                    data: "10",
                    title: "LPF(高中)",
                    name: 'first',
                },                
                {
                    class: 'col',

                    data: "11",
                    title: "POAS",
                    name: 'first',
                },                
                {
                    class: 'col',
                    data: "12",
                    title: "Key Skill",
                    name: 'first',
                },                
                {
                    class: 'big-col',
                    data: "13",
                    title: "預期學習成果",
                    name: 'first',
                },        
                {
                    class: 'col',
                    data: "14",
                    title: "單元",
                    name: 'first',

                },          
                {
                    class: 'big-col',
                    data: "15",
                    title: "關鍵表現項目",
                    name: 'double',
                },                
                // {
                //     data: "16",
                //     title: "相關課程編號",
                //     name: 'first',
                // },                
                // {

                //     data: "17",
                //     title: "相關項目編號",
                //     name: 'first',
                // },                
                {
                    
                    class: 'col',
                    data: "16",
                    title: "備註",
                    name: 'first',
                },              
            ];


            let mainTable = $('#mainTable').DataTable({
            rowsGroup: [
                'first:name',
            ],
            scrollX: true,
            "language": {
                "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
            },
            "order": [],
            'autoWidth': false,
            // "sScrollX": "100%",
            // "sScrollXInner": "110%",
            // "bScrollCollapse": true,
            // "colReorder": true
            "bSort": false,
            "bPaginate": false,
            "pageLength": 10,
            "pagingType": "input",
            "bProcessing": true,
            "processing": true,
            "serverSide": true,
            'searching': false,
            "ordering": false,
            "columns": columnDefs,   
            "ajax": {
                "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
                "method": "get",
                "timeout": "30000",
                "data": function(d) {
                    let subject_id = $('#subject_id').val();
                    let category_id = $('#subject_category_id').val();
                    let module_id = $('#annual_module_id').val();
                    let remark_id = $('#remark_id').val();

                    d.subject_search = subject_id
                    d.category_search = category_id;
                    d.module_search = module_id;
                    d.remark_search = remark_id;
                    console.log(d);
                },
                "complete" : function(){
                    $('[data-toggle="tooltip"]').tooltip();

                    // setTimeout(() => {
                    // $($.fn.dataTable.tables(true)).DataTable()
                    //     .columns.adjust()
                    // }, 500);
                },
            },
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
                    $('#subject_category_id').val(<?= $_POST['subject_category_id']?>)
                    },
                })
            }

            $("#subject_id").change(function() {
                ajax_choose(this.value)
            })


            $(".searchBtn").click(function() {
                mainTable.draw();

            });
        });
    
    </script>

</body>

</html>