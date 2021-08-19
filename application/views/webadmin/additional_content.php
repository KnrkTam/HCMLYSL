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
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">科目：</label>
                                            <div style="flex: 1"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_id,  'data-placeholder' => '請選擇...', 'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元(多項選擇)： </label>
                                            <div style="flex: 1"><?php form_list_type('module_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $module_id,  'data-placeholder' => '請選擇...', 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="submit" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>
                                </div>
                                <!-- <div class="tableWrap hidenWrap"> -->
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



            var columnDefs = [{
                    name: 'first',
                    data: "subject",
                    title: "科目",
                    width: "40px",
                    // class: 'col',
                },
                {
                    name: 'first',
                    data: "course",
                    title: "課程",
                    width: "40px",
                },
                {
                    name: 'first',
                    data: "sub_category",
                    title: "科目範疇",
                    width: "60px",
                },
                {
                    name: 'first',
                    data: "sb_obj",
                    title: "校本課程學習重點",
                    width: '130px',
                },
                {
                    name: 'first',
                    data: "element",
                    title: "學習元素",
                    class: 'col',
                },
                {
                    name: 'first',
                    data: "group",
                    title: "組別",
                    width: "40px",
                },
                {
                    name: 'first',
                    data: "lpf1",
                    title: "LPF(基礎)",
                    class: 'col',
                },
                {
                    name: 'first',
                    data: "lpf2",
                    title: "LPF(高中)",
                    class: 'col',
                },
                {
                    // render: function(data, type, row) {
                    //     var result = row.poas + ' <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                    //     return result;
                    // },
                    name: 'first',
                    data: "poas",
                    title: "POAS",
                    class: 'col',
                },
                {
                    render: function(data, type, row) {
                        var result = data + ' <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                        return result;
                    },
                    name: 'first',
                    data: "skill",
                    title: "Key Skill",
                    class: 'col',
                },
                {
                    name: 'first',
                    data: "expected_outcome",
                    title: "預期學習成果",
                    class: 'big-col',
                },
                {

                    render: function(data, type, row) {
                        if (row.add_content == "" || !row.add_content) {
                            let result =  '<a class="small addonNewBtn" href="<?= admin_url($page_setting['controller'].'/edit/')?>' + row.id + ' ">新增</a>';
                            return result;

                        } else {
                            console.log(row.add_content);
                            let result =  '<div class="d-flex justify-content-between addonRow"><a href="#" class="small addonDispalyBtn"><i class="fa fa-fw  fa-minus-square-o"></i><span>隱藏</span></a><a class="small addonEditBtn" href="<?= admin_url($page_setting['controller'].'/edit/')?>' + row.id + ' ">修改</a></div><div class="addonDetail">' + data + '</div>';
                            return result;
                        }
                    },
                    name: 'first',
                    data: "add_content",
                    title: "補充內容",
                    class: 'big-col',

                },
                {
                    data: "performance",
                    title: "關鍵表現項目",
                    class: "big-col"
                },
                {
                    name: 'first',
                    data: "module",
                    title: "單元",
                    class: 'col',
                }
            ];


            $(".searchBtn").click(function() {
                mainTable.draw();

            });

            
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
            "bSort": false,
            // "bPaginate": false,
            "info": false,
            "pageLength": 10,
            "pagingType": "input",
            "bPaginate": true,
            "bProcessing": true,
            "processing": true,
            "serverSide": false,
            'searching': false,
            "ordering": false,
            "columns": columnDefs,   
            "ajax": {
                "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
                "method": "get",
                "timeout": "30000",
                "data": function(d) {
                    let subject_id = $('#subject_id').val();
                    let module_id = $('#module_id').val();

                    d.subject_search = subject_id
                    d.module_search = module_id;
          
                },
                "complete" : function(){
                    $('[data-toggle="tooltip"]').tooltip();
                },
            },
        }); 


            $(document).on("click", ".addonDispalyBtn", function() {
                $(this).parent().parent().find(".addonDetail").slideToggle('slow', function() {
                    $(this).parent().find(".addonDispalyBtn").toggleClass('active', $(this).is(':visible'));
                    if ($(this).parent().find(".addonDispalyBtn").hasClass("active")) {
                        $(this).parent().find(".addonDispalyBtn span").text("隱藏");
                        $(this).parent().find(".addonDispalyBtn i").attr("class", "fa fa-fw fa-minus-square-o");
                    } else {
                        $(this).parent().find(".addonDispalyBtn span").text("顯示");
                        $(this).parent().find(".addonDispalyBtn i").attr("class", "fa fa-fw  fa-plus-square-o");
                    }
                });
            });
        });
        
    </script>

</body>

</html>