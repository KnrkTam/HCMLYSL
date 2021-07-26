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
                        <?= form_open_multipart($form_action, 'id="myForm" class="form-horizontal"'); ?>
                        <div class="box box-primary">
                            <!-- /.box-header -->

                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>


                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <?php form_list_type('year_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $years_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">學階： </label>
                                            <?php form_list_type('level_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $levels_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">班別： </label>
                                            <?php form_list_type('class_id', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $classes_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元一 </label>
                                            <?php form_list_type('module_id[]', ['type' => 'select', 'class'=> 'form-control module_list select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <input type="text" class="form-control" name="remark[]" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元二 </label>
                                            <?php form_list_type('module_id[]', ['type' => 'select', 'class'=> 'form-control module_list select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <input type="text" class="form-control" name="remark[]" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元三 </label>
                                            <?php form_list_type('module_id[]', ['type' => 'select', 'class'=> 'form-control module_list select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <input type="text" class="form-control" name="remark[]" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元四 </label>
                                            <?php form_list_type('module_id[]', ['type' => 'select', 'class'=> 'form-control module_list select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <label class="text-nowrap">備註</label>
                                            <input type="text" class="form-control" name="remark[]" placeholder="">

                                        </div>
                                    </div>

                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <input type="hidden" name="action" value="create"/>

                                    <button type="button" id="createBtn" class="btn bg-orange mw-100 mb-4 mr-4">確 定</button>

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
    <script>
        $(document).ready(function() {
            $('#level_id').change(function(){
                let listData = []
                $('.module_list').select2("val", "")
                ajax_choose(this.value)
                function ajax_choose(level_id) {
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/select_level' ?>',
                method:'POST',
                data:{level_id:level_id},
                dataType:'json',
                success:function(d){
                    let listData = []
                    $('.module_list').empty()
                    for (const [key, value] of Object.entries(d)) {
                        let option = {
                            id: key,
                            text: `${value}`,
                        }; 
                        listData.push(option)
                    }

                    $('.module_list').select2({
                        data: listData
                    })
                    
                }
                })
            }
            })    



            let createBtn = document.querySelector('#createBtn');
            createBtn.addEventListener("click",function(){
                createModule(year_id.value, level_id.value, class_id.value);
                function createModule(year_id, level_id, class_id){
                    $.ajax({
                    url: '<?= (admin_url($page_setting['controller'])) . '/validate' ?>',
                    method:'POST',
                    data:{year_id:year_id,level_id: level_id, class_id: class_id},
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
                        // alert('duplicated');
                        // console.log(error);
                    }
                    });
                } 
            })        
        });




    </script>

</body>

</html>