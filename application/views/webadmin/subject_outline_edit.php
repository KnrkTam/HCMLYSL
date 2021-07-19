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
                    <small class="text-purple"><?= $subject ?></small>

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
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">科目範疇 : </label>
                                            <div style="flex: 1"><?php form_list_type('subject_cat_id', ['type' => 'select', 'class'=> 'form-control subjectSelect select2' , 'value' => $subject_cat_id ,  'data-placeholder' => '請選擇...', 'enable_value' => $subject_cat_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>課程編號：</label>
                                            <div style="width:100%"><?php form_list_type('lesson_id', ['type' => 'select', 'class'=> 'inputCourseNumber select2 form-control' , 'value' => $lesson_id,  'enable_value' => $lessons_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="remarks">備註:</label>
                                            <div style="width:100%"><?php form_list_type('remark_id[]', ['type' => 'select', 'class'=> 'inputCourseNumber select2 form-control' , 'value' => $remark_id,  'enable_value' => $remarks_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="studyresults">預期學習成果:</label>
                                            <textarea class="form-control" type="text" row="2" readonly><?= $expected_outcome?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="required">關鍵表現項目：</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><span class="text-green required">建議評估模式 </span></label>
                                    </div>
                                    <div class="col-lg-4">
                                    </div>
                            
                                    <div class="col-lg-12">
                                        <div class="row align-items-center key_performance_item">
                                            <?php if ($performance_arr) { ?>
                                                <? foreach ($performance_arr as $key => $foo) { ?>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-3 w-100">
                                                            <input type="text" class="form-control" id="key_performance" name="performance[<?= $key?>]" value="<?= $foo['performance']?>" required>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-4 d-flex mt-3">
                                                        <?php foreach ($assessments_list as $i => $row) { ?>
                                                            <div class="form-check nowrap mr-3">
                                                                <label class="form-check-label" <?= $row['mode']?>><input class="form-check-input" type="radio" name="assessment_id[<?= $key?>]" id="ass_<?= $key?>" value="<?= $i?>" required><?= $row['mode']?></label>
                                                            </div>
                                                        <?}?>
                                                        </div>
                                                        <div class="col-lg-3">
                                                        <div class="form-check w-100  d-flex align-items-center mb-3">
                                                            <label class="form-check-label nowrap mr-4"> 
                                                                <input class="form-check-input radio" type="radio" name="assessment_id[<?= $key?>]" value="0" id="ass_<?= $key?>" required>
                                                                其他
                                                            </label>
                                                            <?php if ($foo['assessment'] == 0) { ?>
                                                                <input type="text" class="form-control" name="assessment_other_field[<?= $key?>]" id="other_<?= $key?>" value="<?= $foo['other'] ?>" required></input>
                                                            <? } else {?>
                                                                <input type="text" class="form-control" name="assessment_other_field[<?= $key?>]" id="other_<?= $key?>"></input>
                                                            <? }?>
                                                        </div>
                                                        </div>
                                                        <div class="col-lg-1"> <button type="button" class="btn bg-navy deleteBtn w-100" disabled><i class="fa fa-trash-o"></i></button></div>
                                                <? } ?>
                                            <? } else { ?>
                                                <div class="col-lg-4">
                                                <div class="form-group mb-3 w-100">
                                                    <input type="text" class="form-control" id="key_performance" name="performance[0]" value="有意識地留意及回應聲音 (0)" required>
                                                </div>
                                                </div>
                                                <div class="col-lg-4 d-flex mt-3">

                                                <?php foreach ($assessments_list as $i => $row) { ?>
                                                    <div class="form-check nowrap mr-3">
                                                        <label class="form-check-label" <?= $row['mode']?>><input class="form-check-input" type="radio" name="assessment_id[0]" id="ass_0" value="<?= $i?>" required><?= $row['mode']?></label>
                                                    </div>
                                                <?}?>
                                                </div>
                                                <div class="col-lg-3">
                                                <div class="form-check w-100  d-flex align-items-center mb-3">
                                                    <label class="form-check-label nowrap mr-4"> 
                                                        <input class="form-check-input radio" type="radio" name="assessment_id[0]" value="0" id="ass_0" required>
                                                        其他
                                                    </label>
                                                    <input type="text" class="form-control" name="assessment_other_field[0]" id="other_0">
                                                </div>
                                                </div>
                                                <div class="col-lg-1"> <button type="button" class="btn bg-navy deleteBtn w-100" disabled><i class="fa fa-trash-o"></i></button></div>
                                            <? } ?>
                                            
                                        </div>

                                        <button type="button" class="btn btn-info addBtn"><i class="fa fa-fw fa-plus"></i>增加關鍵表現項目</button>

                                    </div>

                                </div>
                                <hr />
                                <div class="mt-4 d-flex justify-content-end">
                                    <input type="hidden" name="action" value="edit"/>
                                    <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4" >下一步</button>

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

        <?php include_once "footer.php"; ?>





    </div>







    <!-- ./wrapper -->
    <?php include_once "script.php"; ?>





    <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        
        <?php if ($performance_arr) { ?>
            let countRow = <?= count($performance_arr)?> - 1;

            <?php foreach ($performance_arr as $key => $row) { ?>
                $('input[type=radio][id=ass_<?= $key?>][value=<?= $row['assessment']?>]').prop('checked', true);
                $('input[type=radio][id=ass_<?= $key?>]').change(function () {
                    console.log(this)
                    $('#other_<?= $key?>').attr('required', this.value == "0" ? true: false);
                })
            <? } ?>
        

        <? } else { ?>
            let countRow = 0;
        <? } ?> 

        $('.addBtn').click(function() {

            countRow++;
            $('.key_performance_item:first').before(`
            <div class="row align-items-center key_performance_item">
                <div class="col-lg-4">

                    <div class="form-group mb-3 w-100">
                        <input type="text" class="form-control" id="key_performance" name="performance[${countRow}]" value="有意識地留意及回應聲音 (${countRow})" required>
                    </div>
                </div>
                <div class="col-lg-4 d-flex mt-3">

                    <?php foreach ($assessments_list as $i => $row) { ?>
                        <div class="form-check nowrap mr-3">
                            <label class="form-check-label" <?= $row['mode']?>><input class="form-check-input" id="ass_${countRow}" data-set="${countRow}" type="radio"  name="assessment_id[${countRow}]"  value="<?= $i?>" required><?= $row['mode']?></label>
                        </div>
                    <?}?>
                </div>
                <div class="col-lg-3">
                    <div class="form-check w-100  d-flex align-items-center mb-3">
                        <label class="form-check-label nowrap mr-4"> 
                            <input class="form-check-input radio" type="radio" name="assessment_id[${countRow}]" value="0" data-set="${countRow}" id="ass_${countRow}">
                            其他
                        </label>
                        <input type="text" class="form-control" name="assessment_other_field[${countRow}]" id="other_${countRow}">

                    </div>
                </div>
                <div class="col-lg-1"> <button type="button" class="btn bg-navy deleteBtn w-100"><i class="fa fa-trash-o"></i></button></div>
            </div>`
            );
        
            $(`input[type=radio][id=ass_${countRow}]`).change(function () {
                $(`#other_${this.dataset.set}`).attr('required', this.value == "0" ? true : false);
            })
        });

        // remove row
        $(document).on('click', '.deleteBtn', function() {
            $(this).closest('.key_performance_item').remove();
        });

    });

    </script>

</body>

</html>