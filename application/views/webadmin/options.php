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
                    <!-- form start -->
                    <?= form_open_multipart($form_action, 'class="form-horizontal" id="'.$page_setting['scope_code'].'_form"'); ?>
                    <input type="hidden" name="backend" value="1" >
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="row col-md-6">
                                <div class="btn-group" data-spy="affix" data-offset-top="115" style="z-index: 25;">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> <?= __('save') ?>
                                    </button>
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
								<div class="col-sm-8"><?php form_list_type('courses_id', ['type' => 'select', 'class'=> 'form-control' , 'value' =>'',  'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
								<div class="col-sm-2"><button type="button" class="btn createBtn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#editDetail" data-title="課程">新 增</button></div>
							</div>
							<div class="form-group">
								<label class="text-nowrap required col-sm-2"><span>範疇：</span> </label>
								<div class="col-sm-8"><?php form_list_type('categories_id', ['type' => 'select', 'class'=> 'form-control' , 'value' =>'',  'enable_value' => $categories_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
								<div class="col-sm-2"><button type="button" class="btn createBtn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#editDetail" data-title="範疇">新 增</button></div>
							</div>
							<div class="form-group">
								<label class="text-nowrap required col-sm-2"><span>中央課程學習重點：</span> </label>
								<div class="col-sm-8"><?php form_list_type('central_obj_id', ['type' => 'select', 'class'=> 'form-control' , 'value' =>'',  'enable_value' => $central_obj_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
								<div class="col-sm-2"><button type="button" class="btn createBtn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#editDetail" data-title="中央課程學習重點">新 增</button></div>
							</div>
							<div class="form-group">
								<label class="text-nowrap required col-sm-2"><span>校本課程學習重點：</span> </label>
								<div class="col-sm-8"><?php form_list_type('sb_obj_id', ['type' => 'select', 'class'=> 'form-control' , 'value' =>'',  'enable_value' => $sb_obj_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
								<div class="col-sm-2"><button type="button" class="btn createBtn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#editDetail" data-title="校本課程學習重點">新 增</button></div>
							</div>
                            <div class="form-group">
								<label class="text-nowrap required col-sm-2"><span>科目：</span> </label>
								<div class="col-sm-8"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control' , 'value' =>'',  'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
								<div class="col-sm-2"><button type="button" class="btn createBtn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#editDetail" data-title="科目">新 增</button></div>
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

	 <!-- Edit modal box -->
	 <div class="modal fade in" tabindex="-1" role="dialog" id="editDetail">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">新增 <span id="title"></span> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">

                  

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="edit-btn" class="btn btn-primary">確 定</button>
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

        content = "";
        
        $(document).on("click", ".createBtn", function () {
            let title = $(this).data('title');
            $(".modal-header #title").html(title);

            switch (title) {
                case '課程':
                content = "";
                content += `
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
                        </div>`
                        $(".modal-body").html(content);
                break;
                case '範疇':
                content = "";

                content += `<h1>this is categories</h1>`;
                        $(".modal-body").html(content);
                break;
                case '中央課程學習重點':
                content = "";

                content += `<h1>this is CENTRAL_OBJ</h1>`;
                        $(".modal-body").html(content);
                        break;

                case '校本課程學習重點':
                content = "";

                content += `<h1>this is SB_OBJ</h1>`;
                        $(".modal-body").html(content);
                        break;

                case '科目':
                content = "";

                content += `<h1>this is SUBJECT</h1>`;
                        $(".modal-body").html(content);
                        break;

                default: 
                
            }
        });

</script>
</body>
</html>

