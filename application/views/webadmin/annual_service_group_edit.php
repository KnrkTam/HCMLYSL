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
        label {
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
                                            <!-- <?php form_list_type('year_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $year_id, 'data-placeholder' => '請選擇...', 'enable_value' => $years_list, 'form_validation_rules' => 'trim|required']) ?> -->
                                            <p><?= $year ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-nowrap">服務：</label>
                                            <!-- <div style="flex: 1"><?php form_list_type('service_id', ['type' => 'select', 'class'=> 'form-control select2' ,'value' => $service_id,  'data-placeholder' => '請選擇...', 'enable_value' => $services_list, 'form_validation_rules' => 'trim|required']) ?></div> -->
                                            <p><?= $subject ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">負責人：</label>
                                            <div class="d-flex">
                                            <div style="flex: 1"><?php form_list_type('staff1_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $staff1_id, 'data-placeholder' => '請選擇...', 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                            <div style="flex: 1"><?php form_list_type('staff2_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $staff2_id, 'data-placeholder' => '請選擇...', 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">其他人員：</label>
                                            <div style="flex: 1"><?php form_list_type('other_staff_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $other_staff_id ,'data-placeholder' => '請選擇...', 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>

                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元：</label>
                                            <p><?= $module_order?></p>
                                            <!-- <div style="flex: 1"><?php form_list_type('module_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'disable_please_select' => 1,'value' => $module_order, 'data-placeholder' => '請選擇...', 'enable_value' => $module_order_list, 'form_validation_rules' => 'trim|required']) ?></div> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">施教組別名稱：</label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check d-flex align-items-center w-100 mr-4">
                                                    <p><?= $group_name?></p>
                                                </div>

                                                <div class="form-check w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 custom_group" >
                                        <hr>
                                        <!-- <label class="form-check-label"> 
                                            自訂組別名稱
                                        <input class="form-control" type="text" name="custom_group_name" id="custom_group_name"> -->
                                        </label>
                                        <div class="row mb-4">
                                            <div class="col-lg-6">
                                                <p class="bold text-maroon">選擇學生名單</p>
                                                <div class="form-group w-50">
                                                    <label class="text-nowrap">班別：</label>
                                                    <div style="flex: 1"><?php form_list_type('select_class_id', ['type' => 'select', 'class'=> 'form-control select2' ,  'data-placeholder' => '請選擇...', 'enable_value' => $classes_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                                </div>
                                                <div class="form-group w-50">
                                                    <label class="text-nowrap">學生姓名：</label>
                                                    <div style="flex: 1"><?php form_list_type('select_student_id', ['type' => 'select', 'class'=> 'form-control select2' , 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group w-50">
                                                    <label class="text-nowrap text-green">學生名單：</label>
                                                    <div style="flex: 1"><?php form_list_type('student_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'enable_value' => $students_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" id="submit-btn" class="btn bg-orange mw-100 mb-4 mr-4">確 定</button>
                                    <input type="hidden" id="class_id" value=<?= $function?> name="action"> </input>
                                    <input type="hidden" id="class_id" value=<?= $class_id?> name="class_id"> </input>
                                    <input type="hidden" id="group_name" value=<?= $group_name_option?> name="group_name"> </input>
                                    <input type="hidden" id="custom_group_name" value=<?= $group_name?> name="custom_group_name"> </input>

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

    <script src="<?= assets_url('webadmin/js/jquery.transfer.js') ?>"></script>

    <script>
    $(document).ready(function() {
        $("#other_staff_id").select2({
            maximumSelectionLength: 2
        });

        // $("#class_id").change(function(){
        //     $("#group_name_class").prop("checked", true);
        //     $(".custom_group").hide();

        // })
        
        // $('input[type=radio][name=group_name]').change(function() {
        //     if (this.value == 'other') {
        //         $(".custom_group").fadeIn();
        //         $(".custom_group_select").val("");
        //         $(".custom_group_select").prop("disabled", true);
        //         $("#class_id").val(null)
        //     } else {
        //         $(".custom_group").hide();
        //         $(".custom_group_select").prop("disabled", false);
        //     }
        // });
        // let c  = <?= $class_id?>;
        // if (c) {
        //     $("input[type=radio][name=group_name][value=class]").prop("checked", true);
        // }
   

        // $("#selectAll").click(function(){
        //     if($("#selectAll").is(':checked') ){
        //         $("#module_id > option").prop("selected","selected");
        //         $("#module_id").trigger("change");
        //     }else{
        //         $("#module_id").val(null).trigger("change");
        //     }
        // });

        // form validation
        let submitBtn = document.querySelector('#submit-btn');
        submitBtn.addEventListener("click",function(){
            validateForm( staff1_id.value, staff2_id.value, $("#other_staff_id").select2("val"),group_name.value, class_id.value, custom_group_name.value,$("#student_id").select2("val"),);
            function validateForm(staff1_id, staff2_id, other_staff_id, group_name, class_id, custom_group_name, student_id){
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/validate/'. $id ?>',
                method:'POST',
                data:{
                    staff1_id:staff1_id, 
                    staff2_id:staff2_id, 
                    other_staff_id:other_staff_id, 
                    group_name:group_name, 
                    class_id: class_id, 
                    custom_group_name:custom_group_name, 
                    student_id:student_id
                },
                dataType:'json',     
                success:function(data){
                    console.log(data)
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

        let added_ids = new Set();
        let sid = <?= $student_id ?>;
        let oid = <?= $other_staff_id?>;
        if (sid) {
            sid.forEach(v => added_ids.add(v));
            $('#student_id').val(Array.from(added_ids)).trigger('change');
        }

        if (oid) {
            $('#other_staff_id').val(oid).trigger('change');

        }

        function render_class_student(class_id) {
            $.ajax({
            url: '<?= (admin_url($page_setting['controller'])) . '/select_student/' ?>' + class_id,
            method:'GET',
            dataType:'json',
            beforeSend:function(){
                $('#select_student_id').empty();
            }, 
            success:function(d){
                $('#select_student_id').select2({
                    data: d
                })
                $('#select_student_id').val(Array.from(added_ids)).trigger('change');

            },
            })
        }

        $("#select_class_id").change(function() {
            render_class_student(this.value)
        })

        $("#select_student_id").change(function() {
            $("#select_student_id").on("select2:unselect", function (e) { 
                added_ids.delete(e.params.data.id)
                $('#student_id').val(Array.from(added_ids)).trigger('change');
            });

            $("#select_student_id").on("select2:select", function (e) { 
                added_ids.add(e.params.data.id)
                $('#student_id').val(Array.from(added_ids)).trigger('change');
            });
        })


        $("#student_id").change(function() {
            $("#student_id").on("select2:unselect", function (e) { 
                added_ids.delete(e.params.data.id)
                $('#select_student_id').val(Array.from(added_ids)).trigger('change');
            });

            $("#student_id").on("select2:select", function (e) { 
                added_ids.add(e.params.data.id)
                $('#select_student_id').val(Array.from(added_ids)).trigger('change');
            });
        })
    })
    </script>

</body>

</html>