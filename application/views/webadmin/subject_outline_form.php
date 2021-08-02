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
                                <div class="row">
                                <div class="col-lg-12">
                                    <label class="text-nowrap">科目 : </label>
                                    <h4 class="text-purple"><?= $subject ?></h4>
                                    <input type="hidden" name="subject_id" value=<?= $subject_id?> />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group w-100">
                                        <label class="text-nowrap">科目範疇 : </label>
                                            <div style="flex: 1"><?php form_list_type('subject_cat_id', ['type' => 'select', 'class'=> 'form-control subjectSelect select2' , 'value' => $subject_cat_id ,  'data-placeholder' => '請選擇...', 'enable_value' => $subject_cat_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                            <input type="hidden" name="subject_id" value=<?= $subject_id?> />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">課程編號：</label>
                                            <div style="width:100%"><?php form_list_type('lesson_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'data-placeholder' => 'e.g.: #SC557, #BD003', 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="remarks">備註:</label>
                                            <div style="flex: 1"><?php form_list_type('remark_id[]', ['type' => 'select', 'class'=> 'form-control subjectSelect select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $remarks_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="bold required">預期學習成果：</label>
                                            <input type="hidden" id="expected_outcome" name="expected_outcome"></input>
                                            <h4 rowspan="5" id="expected_outcome_text" class="text-green"></h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <hr />
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="required">關鍵表現項目：</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label><span class="text-green required">建議評估模式 </span></label>
                                    </div>
                                    <div class="col-lg-4">
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="key_performance_item_group ">
                                        <div class="row align-items-center key_performance_item">
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3 w-100">
                                                <input type="text" class="form-control" id="key_performance" name="performance[0]" placeholder="輸入關鍵表現項目" value="" required data-required-message="請填寫此資料">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 d-flex mt-3">
                                            <?php foreach ($assessments_list as $i => $row) { ?>
                                                <div class="form-check nowrap mr-3">
                                                    <label class="form-check-label" <?= $row['mode']?>><input class="form-check-input" type="radio" name="assessment_id[0]" id="ass_0"  data-set="0" value="<?= $i?>" required data-required-message="請填寫此資料"><?= $row['mode']?></label>
                                                </div>
                                            <?}?>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-check w-100  d-flex align-items-center mb-3">
                                                <label class="form-check-label nowrap mr-4"> 
                                                    <input class="form-check-input radio" type="radio" name="assessment_id[0]" value="0"  id="ass_0" data-set="0" required >
                                                    其他
                                                </label>
                                                <input type="text" class="form-control" name="assessment_other_field[0]" id="other_0" data-required-message="請填寫此資料">
                                            </div>
                                        </div>
                                        <div class="col-lg-1"> <button type="button" style="margin-top: 25%" class="btn bg-navy deleteBtn w-100" disabled><i class="fa fa-trash-o"></i></button></div>
                                        </div >
                                        </div >

                                        <button type="button" class="btn btn-info addBtn"><i class="fa fa-fw fa-plus"></i>增加關鍵表現項目</button>
                                    </div>

                                </div>
                                <hr />
                                <div class="mt-4 d-flex justify-content-end">
                                    <input type="hidden" name="action" value="create"/>
                                    <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4">下一步</button>
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



    <?php include_once("footer.php"); ?>



    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>



    <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();


        $('input[required]').on('change invalid', function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity($(this).data("required-message"));
            }
        });

        <?php if ($_SESSION['post_data']){ ?>
            let session_data = <?= json_encode($_SESSION['post_data'])?>;
            $('#subject_cat_id').val(session_data['subject_cat_id']).select2();   
            subject_cat_change(session_data['subject_cat_id'])
 
            setTimeout(() => {
                lesson_change(session_data['lesson_id'])
                $('#lesson_id').val(session_data['lesson_id']).select2();   

            }, 500);
            console.log('asdf', session_data['performance'][0]);
            let loop_data = '';

            for (i = 0; i < Object.keys(session_data['assessment_id']).length ; i++) {
                loop_data += `
                    <div class="row align-items-center key_performance_item">
                    <div class="col-lg-4">

                        <div class="form-group mb-3 w-100">
                            <input type="text" class="form-control" id="key_performance" name="performance[${i}]" value="${session_data['performance'][i]}" required data-required-message="請填寫此資料">
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex mt-3">
                        <?php foreach ($assessments_list as $i => $row) { ?>
                            <div class="form-check nowrap mr-3">
                                <label class="form-check-label" <?= $row['mode']?>><input class="form-check-input" id="ass_${i}" data-set="${i}" type="radio"  name="assessment_id[${i}]"  value="<?= $i?>" required data-required-message="請填寫此資料"><?= $row['mode']?></label>
                            </div>
                        <?}?>
                    </div>
                        <div class="col-lg-3">
                            <div class="form-check w-100  d-flex align-items-center mb-3">
                                <label class="form-check-label nowrap mr-4"> 
                                    <input class="form-check-input radio" type="radio" name="assessment_id[${i}]" value="0" data-set="${i}" id="ass_${i}">
                                    其他
                                </label>
                                <input type="text" class="form-control" name="assessment_other_field[${i}]" id="other_${i}" data-required-message="請填寫此資料">

                            </div>
                        </div>
                        <div class="col-lg-1"> <button type="button" style="margin-top: 8px" class="btn bg-navy deleteBtn w-100"><i class="fa fa-trash-o"></i></button></div>
                    </div>`
                $('.key_performance_item_group').html(loop_data);         
            }

            let countRow = Object.keys(session_data['assessment_id']).length;
        <?} else {?>
            let countRow = 0;

        <? } ?>



        $('input[type=radio][id=ass_0]').change(function () {
                $('#other_0').attr('required', this.value == "0" ? true: false);
                $('input[required]').on('change invalid', function() {
                    this.setCustomValidity('');
                    if (!this.validity.valid) {
                        this.setCustomValidity($(this).data("required-message"));
                    }
                });
            })

        function lesson_change(lesson_id = null) {
            $.ajax({
            url: '<?= (admin_url($page_setting['controller'])) . '/select_lesson' ?>',
            method:'POST',
            data:{lesson_id:lesson_id},
            dataType:'json',
            success:function(data){
                if (!lesson_id) {
                    data.expected_outcome = null;
                } 
                $('#expected_outcome').val(data.expected_outcome);
                $('#expected_outcome_text').html(data.expected_outcome);
            
            
           

            },
            error: function(e){
                console.log(error)
            }
            })
        }
         $('#lesson_id').change(function() {
            lesson_change(this.value)
        })


        $('.addBtn').click(function() {
            countRow++;
            $('.key_performance_item:first').before(`
                <div class="row align-items-center key_performance_item">
                <div class="col-lg-4">

                    <div class="form-group mb-3 w-100">
                        <input type="text" class="form-control" id="key_performance" name="performance[${countRow}]" value="e.g. 有意識地留意及回應聲音 (${countRow})" required data-required-message="請填寫此資料">
                    </div>
                </div>
                <div class="col-lg-4 d-flex mt-3">
                    <?php foreach ($assessments_list as $i => $row) { ?>
                        <div class="form-check nowrap mr-3">
                            <label class="form-check-label" <?= $row['mode']?>><input class="form-check-input" id="ass_${countRow}" data-set="${countRow}" type="radio"  name="assessment_id[${countRow}]"  value="<?= $i?>" required data-required-message="請填寫此資料"><?= $row['mode']?></label>
                        </div>
                    <?}?>
                </div>
                    <div class="col-lg-3">
                        <div class="form-check w-100  d-flex align-items-center mb-3">
                            <label class="form-check-label nowrap mr-4"> 
                                <input class="form-check-input radio" type="radio" name="assessment_id[${countRow}]" value="0" data-set="${countRow}" id="ass_${countRow}">
                                其他
                            </label>
                            <input type="text" class="form-control" name="assessment_other_field[${countRow}]" id="other_${countRow}" data-required-message="請填寫此資料">

                        </div>
                    </div>
                    <div class="col-lg-1"> <button type="button" class="btn bg-navy deleteBtn w-100"><i class="fa fa-trash-o"></i></button></div>
                </div>`
            );


                $(`input[type=radio][id=ass_${countRow}]`).change(function () {
                    $(`#other_${this.dataset.set}`).attr('required', this.value == "0" ? true : false);
                    $('input[required]').on('change invalid', function() {
                        this.setCustomValidity('');
                        if (!this.validity.valid) {
                            this.setCustomValidity($(this).data("required-message"));
                        }
                    });
                })

        })

        // remove row
        $(document).on('click', '.deleteBtn', function() {
            $(this).closest('.key_performance_item').remove();
        });

        function subject_cat_change(subject_cat_id) {
            $.ajax({
            url: '<?= (admin_url($page_setting['controller'])) . '/select_subject_cat' ?>',
            method:'POST',
            data:{subject_cat_id:subject_cat_id},
            dataType:'json',
            beforeSend:function(){
                $('#lesson_id').empty();
            },
            success:function(d){
                $('#lesson_id').select2({
                    data: d
                });
                console.log(d.length)
                if (d.length > 0) {
                    lesson_change(d[0].id)
                } else {
                    lesson_change(null)

                }
            },
            })
        }
        $("#subject_cat_id").change(function() {
            subject_cat_change(this.value)
        })

    });

    

    </script>

</body>

</html>