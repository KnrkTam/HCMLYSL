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
                <?= $page_setting['scope'] ?>
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
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="row col-md-6">
                                <div class="btn-group" data-spy="affix" data-offset-top="115" style="z-index: 25;">
  
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
                            if (!empty($_SESSION["message"])) {
                                echo '<div id="signupalert" class="alert alert-danger margin_bottom_20">';
                                echo $_SESSION["message"];
                                echo '</div>';
                                unset($_SESSION["message"]);
                            }

                            foreach ($form_list as $key => $row) {
                                ?>
                                <div class="form-group">
                                    <label
                                            class="col-sm-2 control-label nowarp <?= strpos($row['attr'], "required") !== FALSE || strpos($row['label_class'], "required") !== FALSE ? "required" : "" ?>"
                                            for=""><?= $row["label"] ?>: </label>

                                    <div class="col-sm-8"
                                        style="<?= $row['type'] == 'radio' ? 'margin-top: 7px;' : ($row['type'] == 'checkbox' ? 'margin-top: 3px;' : '') ?>">
                                        <?php
                                        form_list_type($key, $row);
                                        ?>
                                    </div>
                                </div>

                                <?php
                            } ?>

							<div class="form-group">
								<label class="text-nowrap required col-sm-2"><span>課程：</span> </label>
								<div class="col-sm-8"><?php form_list_type('courses_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
								<div class="col-sm-2"><button type="button" class="btn createBtn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#addOption" data-title="課程">新 增</button></div>
							</div>
							<div class="form-group">
								<label class="text-nowrap required col-sm-2"><span>範疇：</span> </label>
								<div class="col-sm-8"><?php form_list_type('categories_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'enable_value' => $categories_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
								<div class="col-sm-2"><button type="button" class="btn createBtn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#addOption" data-title="範疇">新 增</button></div>
							</div>
							<div class="form-group">
								<label class="text-nowrap required col-sm-2"><span>中央課程學習重點：</span> </label>
								<div class="col-sm-8"><?php form_list_type('central_obj_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'enable_value' => $central_obj_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
								<div class="col-sm-2"><button type="button" class="btn createBtn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#addOption" data-title="中央課程學習重點">新 增</button></div>
							</div>
							<div class="form-group">
								<label class="text-nowrap required col-sm-2"><span>校本課程學習重點：</span> </label>
								<div class="col-sm-8"><?php form_list_type('sb_obj_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'enable_value' => $sb_obj_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
								<div class="col-sm-2"><button type="button" class="btn createBtn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#addOption" data-title="校本課程學習重點">新 增</button></div>
							</div>
                            <div class="form-group">
								<label class="text-nowrap required col-sm-2"><span>科目：</span> </label>
								<div class="col-sm-8"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'enable_value' => $subjects_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
								<div class="col-sm-2"><button type="button" class="btn createBtn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#addOption" data-title="科目">新 增</button></div>
							</div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!--/.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

	 <!-- Edit modal box -->
	 <div class="modal fade in" tabindex="-1" role="dialog" id="addOption">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">新增 <span id="title"></span> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group modal-core" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="add-btn" class="btn btn-primary">確 定</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit modal box end -->

    <!-- /.content-wrapper -->

    <?php include_once("footer.php"); ?>

</div>
<!-- ./wrapper -->
<?php include_once("script.php"); ?>
<script>
    $(document).ready(function() {
        $('select.select2').select2();

        content = "";
        
        $(document).on("click", ".createBtn", function () {
            let title = $(this).data('title');
            $(".modal-header #title").html(title);

            switch (title) {
                case '課程':
                content = "";
                content += `
                            <label class="text-nowrap">${title}名稱： </label>
                            <input type="hidden" id="modalTitle" value="${title}"></input>
                            <input type="text" class="form-control required" placeholder="輸入名稱"  id="modalName" value=""></input>
                            `;
                        $(".modal-core").html(content);
                        break;

                case '範疇':
                content = "";
                content += `
                            <label class="text-nowrap">${title}名稱： </label>
                            <input type="hidden" id="modalTitle" value="${title}"></input>
                            <input type="text" class="form-control required" placeholder="輸入名稱" id="modalName" value=""></input>
                            `;
                        $(".modal-core").html(content);
                        break;

                case '中央課程學習重點':
                content = "";
                content += `
                            <label class="text-nowrap">${title}名稱： </label>
                            <input type="hidden" id="modalTitle" value="${title}"></input>

                            <input type="text" class="form-control required" placeholder="輸入名稱" id="modalName" value=""></input>
                            `;
                        $(".modal-core").html(content);
                        break;

                case '校本課程學習重點':
                content = "";
                content += `
                            <label class="text-nowrap">${title}名稱： </label>
                            <input type="hidden" id="modalTitle" value="${title}"></input>
                            <input type="text" class="form-control required" placeholder="輸入名稱" id="modalName" value=""></input>
                            `;
                        $(".modal-core").html(content);
                        break;

                case '科目':
                content = "";
                content += `
                            <label class="text-nowrap">${title}名稱： </label>
                            <input type="hidden" id="modalTitle" value="${title}"></input>
                            <input type="text" class="form-control required" placeholder="輸入名稱" id="modalName" value=""></input>
                            `;
                        $(".modal-core").html(content);
                        break;
                default: 
                
            }
        });

        let addBtn = document.querySelector('#add-btn');
        addBtn.addEventListener("click",function(){
            // let  addOption = confirm(`Confirm to add "${modalName.value}" into ${modalTitle.value}?`);
            addFunction(modalTitle.value, modalName.value);
            function addFunction(type,name){
                $.ajax({
                url: `<?= (admin_url($page_setting['controller'])) . '/ajax' ?>`,
                method:'POST',
                data:{type:type, name: name},
                dataType:'json',     
                success:function(data){
                    if (data.status == 'success') {
                        window.location.reload();
                    } else if (data.status == 'no_change') {
                        $('#addOptions').modal('hide');
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
    })

</script>
</body>
</html>

