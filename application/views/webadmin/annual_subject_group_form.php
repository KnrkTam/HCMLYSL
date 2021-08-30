<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("head.php"); ?>
    <style>
        input[type="checkbox"]{
            cursor: pointer;
        }

        input[type="radio"]{
            cursor: pointer;
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
                        <?= form_open_multipart($form_action, 'id="myForm" class="form-horizontal"'); ?>
                        <div class="box box-primary">
                            <!-- /.box-header -->

                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度：</label>
                                            <?php form_list_type('year_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $year_id, 'data-placeholder' => '請選擇...', 'enable_value' => $years_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-nowrap">科目：</label>
                                            <div style="flex: 1"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_id,  'data-placeholder' => '請選擇...', 'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">主教老師：</label>
                                            <div class="d-flex">
                                            <div style="flex: 1"><?php form_list_type('staff1_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_id,  'data-placeholder' => '請選擇...', 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                            <div style="flex: 1"><?php form_list_type('staff2_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_id,  'data-placeholder' => '請選擇...', 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">其他任教：</label>
                                            <div style="flex: 1"><?php form_list_type('other_staff_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_id,  'data-placeholder' => '請選擇...', 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>

                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元：</label>
                                            <label style="cursor: pointer" href="#"><input type="checkbox" id="selectAll" >全選</input></label>
                                            <div style="flex: 1"><?php form_list_type('module_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_id, 'disable_please_select' => 1, 'data-placeholder' => '請選擇...', 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">施教組別名稱：</label>

                                            <div class="d-flex align-items-center">
                                                <div class="form-check d-flex align-items-center w-100 mr-4">
                                                    <input class="form-check-input" type="radio" name="group_name" value="option1" id="group_name_class">
                                                    <div style="flex: 1"><?php form_list_type('class_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $classes_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                                </div>


                                                <div class="form-check w-100">
                                                    <label class="form-check-label" for="group_name_other"> 
                                                        <input class="form-check-input" type="radio" name="group_name" id="group_name_other" value="other">
                                                        其他
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 custom_group" style="display:none">
                                        <hr>
                                        <p class="bold">選擇學生名單</p>
                                        <div class="form-group w-50">
                                            <label class="text-nowrap">班別：</label>
                                            <div style="flex: 1"><?php form_list_type('select_class_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $classes_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                        <div id="transfer1" class="transfer-demo"></div>
                                    </div>
                                </div>

                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" id="submit-btn" class="btn bg-orange mw-100 mb-4 mr-4">確 定</button>

                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">返 回</button>

                                </div>


                                <div class="tableWrap hidenWrap">
                                    <table class="table table-bordered table-striped w-100" id="settingTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">
                                                <th class="no-sort" style="min-width: 4px;  max-width:15px"></th>
                                                <th class="nowrap">科目/服務</th>
                                                <th class="nowrap">主要任教</th>
                                                <th class="nowrap">其他任教</th>
                                                <th class="nowrap">單元</th>
                                                <th class="nowrap">施教組別名稱</th>
                                                <th class="nowrap">學生名單</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td><a class="editLinkBtn" href="../webadmin/Bk_group_subject/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>語文科1234</td>
                                                <td>xxx, xxx</td>
                                                <td></td>
                                                <td>單元一</td>
                                                <td>忠1</td>
                                                <td>陳xx(善), 陳xx(善),</td>
                                            </tr>
                                            <tr>

                                                <td><a class="editLinkBtn" href="../webadmin/Bk_group_subject/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>語文科1234</td>
                                                <td>xxx, xxx</td>
                                                <td>xxx, xxx</td>
                                                <td>單元三</td>
                                                <td>忠1</td>
                                                <td>陳xx(善), 陳xx(德),</td>

                                            </tr>
                                            <tr>

                                                <td><a class="editLinkBtn" href="../webadmin/Bk_group_subject/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>語文科1234</td>
                                                <td>xxx, xxx</td>
                                                <td>xxx, xxx</td>
                                                <td>單元一</td>
                                                <td>仁</td>
                                                <td>陳xx(信), 陳xx(德),</td>


                                            </tr>

                                            <tr>

                                                <td><a class="editLinkBtn" href="../webadmin/Bk_group_subject/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>語文科1234</td>
                                                <td>xxx, xxx</td>
                                                <td>xxx, xxx</td>
                                                <td>單元二</td>
                                                <td>仁</td>
                                                <td>陳xx(信), 陳xx(德),</td>



                                            </tr>

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

        <?php include_once("footer.php"); ?>





    </div>
    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>

    <script src="<?= assets_url('webadmin/js/jquery.transfer.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $("#other_staff_id").select2({
                maximumSelectionLength: 2
            });

            $("#class_id").change(function(){
                $("#group_name_class").prop("checked", true);
                $(".custom_group").hide();

            })
            
            $('input[type=radio][name=group_name]').change(function() {
                if (this.value == 'other') {
                    $(".custom_group").fadeIn();
                    $(".custom_group_select").val("");
                    $(".custom_group_select").prop("disabled", true);
                } else {
                    $(".custom_group").hide();
                    $(".custom_group_select").prop("disabled", false);
                }
            });


            var dataArray1 = [{
                    "name": "關 xx",
                    "value": 132
                },
                {
                    "name": "方 xx",
                    "value": 422
                },
                {
                    "name": "楊 x",
                    "value": 232
                },
                {
                    "name": "黎 xx",
                    "value": 765
                },
                {
                    "name": "張 xx",
                    "value": 876
                },
                {
                    "name": "黃 xx",
                    "value": 453
                }
            ];

            var settings1 = {
                "dataArray": dataArray1,
                "itemName": "name",
                "valueName": "value",
                "callable": function(items) {
                    console.dir(items)
                }
            };

            $("#transfer1").transfer(settings1);

            $(".transfer-double-content-left .param-item").text("學生姓名");

            $(".transfer-double-content-right .param-item").text("已選擇學生名單");

            //  table.columns.adjust();
            $(".searchBtn").click(function() {

                $(".tableWrap").fadeIn();

                $('#settingTable').DataTable({
                    scrollX: true,
                    scrollCollapse: true,
                    bFilter: false,
                    bInfo: true,
                    sScrollXInner: "100%",
                    bLengthChange: true,
                    columnDefs: [{
                        targets: 'no-sort',
                        orderable: false,

                    }]


                }).columns.adjust();

            });

        });

    

        $("#selectAll").click(function(){
            if($("#selectAll").is(':checked') ){
                $("#module_id > option").prop("selected","selected");
                $("#module_id").trigger("change");
            }else{
                $("#module_id").val(null).trigger("change");
            }
        });

        // form validation
        let submitBtn = document.querySelector('#submit-btn');
        submitBtn.addEventListener("click",function(){
            validateForm(year_id.value, subject_id.value, $("#module_id").select2("val"), staff1_id.value, staff2_id.value, $("#other_staff_id").select2("val"));
            function validateForm(year_id, subject_id, module_id, staff1_id, staff2_id, other_staff_id){
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/validate' ?>',
                method:'POST',
                data:{year_id:year_id, subject_id:subject_id, module_id:module_id, staff1_id:staff1_id, staff2_id:staff2_id, other_staff_id:other_staff_id},
                dataType:'json',     
                success:function(data){
                    if (data.status == 'success') {
                        document.getElementById('myForm').submit();
                    } else {
                        alertify.error(data.status)
                    }
                },
                error: function(error){
                    alert('error');
                }
                });
            } 
        })      
    </script>

</body>

</html>