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
                                <?php if (validate_user_access(['create_'.$scope_code])) { ?>
                                    <button type="button" class="btn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#newDetail">新 增</button>
                                <?php } ?>



                                <table class="table table-bordered table-hover width100p">
                                    <thead>
                                        <tr class="bg-light-blue color-palette">
                                            <? foreach ($level_list as $row)  {?>
                                            <th><?= $row ?></th>
                                            <? } ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php  for ($i = 0; $i < $module_count; $i++){ ?>
                                            <tr>
                                                <td><?= $module_row0[$i] ? '<a class="editLinkBtn" data-id="'.$module_row0[$i]->id.'" data-code="'.$module_row0[$i]->code.'" data-name="'.$module_row0[$i]->name.'" data-level="'.$module_row0[$i]->level_id.'" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i>'. $module_row0[$i]->code.' '.$module_row0[$i]->name.'</a>' : '' ?></td>
                                                <td><?= $module_row1[$i] ? '<a class="editLinkBtn" data-id="'.$module_row1[$i]->id.'" data-code="'.$module_row1[$i]->code.'" data-name="'.$module_row1[$i]->name.'" data-level="'.$module_row1[$i]->level_id.'" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i>'. $module_row1[$i]->code.' '.$module_row1[$i]->name.'</a>' : '' ?></td>
                                                <td><?= $module_row2[$i] ? '<a class="editLinkBtn" data-id="'.$module_row2[$i]->id.'" data-code="'.$module_row2[$i]->code.'" data-name="'.$module_row2[$i]->name.'" data-level="'.$module_row2[$i]->level_id.'" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i>'. $module_row2[$i]->code.' '.$module_row2[$i]->name.'</a>' : '' ?></td>
                                                <td><?= $module_row3[$i] ? '<a class="editLinkBtn" data-id="'.$module_row3[$i]->id.'" data-code="'.$module_row3[$i]->code.'" data-name="'.$module_row3[$i]->name.'" data-level="'.$module_row3[$i]->level_id.'" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i>'. $module_row3[$i]->code.' '.$module_row3[$i]->name.'</a>' : '' ?></td>
                                                <td><?= $module_row4[$i] ? '<a class="editLinkBtn" data-id="'.$module_row4[$i]->id.'" data-code="'.$module_row4[$i]->code.'" data-name="'.$module_row4[$i]->name.'" data-level="'.$module_row4[$i]->level_id.'" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i>'. $module_row4[$i]->code.' '.$module_row4[$i]->name.'</a>' : '' ?></td>
                                            </tr>
                                    <? } ?>
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.box-body -->
                        </div>
                 

                    </div>
                    <!--/.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->

        <?php include_once("footer.php"); ?>


   <!-- form start -->
   <!-- <?= form_open_multipart($form_action, 'class="form-horizontal"'); ?> -->
    <!-- Edit modal box -->
        <div class="modal fade in" tabindex="-1" role="dialog" id="editDetail">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">修改 單元名稱 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>
                        </div>
                    <div class="modal-body">

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-nowrap">學階： </label>
                                    <div style="flex: 1"><?php form_list_type('level_id', ['type' => 'select', 'class'=> 'form-control' , 'value' =>'',  'enable_value' => $level_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
                                    <input type="text" class="form-control hidden"  id="modalId" value="">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-nowrap">單元編號： </label>
                                    <input type="text" class="form-control" placeholder="e.g. 1.1" name="module_code" id="modalCode" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap">單元名稱： </label>
                                    <input type="text" class="form-control" placeholder="e.g. 我的學校" name="module_name" id="modalName" value="">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="edit-btn" class="btn btn-primary">確 定</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit modal box end -->
        <div class="modal fade in" tabindex="-1" role="dialog" id="newDetail">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">新增 單元名稱 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-nowrap">學階： </label>
                                    <div style="flex: 1"><?php form_list_type('level_id', ['type' => 'select', 'class'=> 'form-control' , 'value' =>'',  'enable_value' => $level_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-nowrap">單元編號： </label>
                                    <input type="text" class="form-control" placeholder="e.g. 1.1" name="module_code" id="newCode">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap">單元名稱： </label>
                                    <input type="text" class="form-control" placeholder="e.g. 我的學校" name="module_name" id="newName">
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" id="create-btn" class="btn bg-orange ">新 增</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
       <!-- /.box -->
       <!-- <?= form_close() ?> -->


    </div>
    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>
    <script>
        $(document).on("click", ".editLinkBtn", function () {
            let myId = $(this).data('id');
            let myCode = $(this).data('code');
            let myName = $(this).data('name');
            let myLevel = $(this).data('level');
            $(".modal-body #modalCode").val( myCode );
            $(".modal-body #modalName").val( myName );
            $(".modal-body #level_id").val( myLevel );
            $(".modal-body #modalId").val( myId );
        });


        let createBtn = document.querySelector('#create-btn');
        createBtn.addEventListener("click",function(){
            createModule(level_id.level_id.value, newCode.value, newName.value);
            function createModule(level_id, code, name){
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/create' ?>',
                method:'POST',
                data:{level_id:level_id,code: code, name: name},
                dataType:'json',     
                success:function(data){
                    if (data.status == 'success') {
                        window.location.reload();
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

        let editBtn = document.querySelector('#edit-btn');
        editBtn.addEventListener("click",function(){
            // let confirmCreate = confirm(`Are you sure edit ${level_id.level_id.value}, ${modalCode.value}, ${modalName.value}, ${modalId.value}`);
            editModule(level_id.level_id.value, modalCode.value, modalName.value, modalId.value);
            function editModule(level_id, code, name, id){
                $.ajax({
                url: `<?= (admin_url($page_setting['controller'])) . '/edit/'?>${id}`,
                method:'POST',
                data:{level_id:level_id,code: code, name: name, id: id},
                dataType:'json',     
                success:function(data){
                    if (data.status == 'success') {
                        window.location.reload();
                    } else if (data.status == 'no_change') {
                        $('#editDetail').modal('hide');
                    }else {
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