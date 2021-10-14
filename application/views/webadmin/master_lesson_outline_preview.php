<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .required:after, .required_field:after {
            content: ' * ';
            color: red;
            left: 8px;
            position: absolute;
        }
    </style>
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
                    <li class="active"><a href="<?=admin_url($page_setting['controller'])?>"><?= ($page_setting['scope']) ?></a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- column -->
                    <div class="col-md-12">
                        <!-- form start -->
                        <?= form_open_multipart($form_action, 'class="form-horizontal"'); ?>
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

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">課程： </label>
                                            <p><?= $pv_course_id?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">範疇：
                                            </label>
                                            <p><?= $pv_categories_id?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">課程編號： </label>
                                            <p><?= $pv_lesson_code?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">中央課程學習重點： </label>
                                            <p><?= $pv_central_obj_id?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">校本課程學習重點：
                                            </label>
                                            <p><?= $pv_sb_obj_id?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap required">相關課程編號： </label>
                                            <p><?= $pv_rel_lessons?>&nbsp </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-2 bold required"> 學習元素：</p>
                                        <p><?= $pv_element_id?></p>


                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-2 bold required" > 組別：</p>
                                        <p> <?= $pv_group_id ?></p>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">相關項目編號： </label>
                                            <p><?= $pv_rel_code ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>LPF(基礎) <small>(2 層分類, 單項選擇)</small></label>
                                            <p> <?= $pv_lpf_basic_id?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>LPF(高中) <small>(2 層分類, 單項選擇)</small></label>
                                            <p><?= $pv_lpf_advanced_id?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>POAS： <small>(2 層分類, 單項選擇)</small></label>
                                            <p> <?= $pv_poas_id?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex">
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">Key Skills (2 層分類,可多項選擇)</label>
                                            <p><?= $pv_skills_id?></p>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-2 bold">前備技能</p>
                                        <? if ($pv_preliminary_skills == "1") { ?>
                                            <p><span class="text-green"><i class="fa fa-check"></i></span></p>
                                        <? } else {?>
                                            <p><span class="text-red"><i class="fa fa-close"></i></span></p>
                                        <? }?>
                                    </div>
                                    
                                  
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="required">預期學習成果：</label>
                                            <p><?= $pv_expected_outcome?></p>
                                        </div>
                                    </div> 
                                    <?php if ($pv_expected_outcome_eng) {?>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Expected Study Result：</label>
                                            <p><?= $pv_expected_outcome_eng?></p>
                                        </div>
                                    </div>
                                    <?}?>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                <? foreach ($postData as $i => $row) { ?>
                                    <input type="hidden" name="post_data[<?=$i?>]" value="<?= $row?>"></input>
                                <? } ?>
                                <? foreach ($postData['group_id'] as $i => $row) { ?>
                                    <input type="hidden" name="group_id[<?= $i ?>]" value="<?= $row ?>"></input>
                                <? } ?>

                                <? foreach ($postData['skills_id'] as $i => $row) { ?>
                                    <input type="hidden" name="skills_id[<?= $i ?>]" value="<?= $row ?>"></input>
                                <? } ?>

                                <? foreach ($postData['rel_lessons'] as $i => $row) { ?>
                                    <input type="hidden" name="rel_lessons[<?= $i ?>]" value="<?= $row ?>"></input>
                                <? } ?>


                                    <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4">確 定</button>
                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= (admin_url($page_setting['controller'])) . '/'. $previous. '/'. $id?>';">返 回</button>

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

            $('#searchCourseNumberTable').DataTable({
                scrollX: true,
                scrollCollapse: true,
                bFilter: false,
                bInfo: true,
                bLengthChange: false,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                    width: 100
                }]

            });




            $(".comfirmSelectCourseNumber").click(function() {
                var courseNumberCount = new Array();
                $("input[name='searchCourseNumberCheck']:checked").each(function() {
                    courseNumberCount.push($(this).closest("tr").find(".courseNum").text());
                });

                $('.inputCourseNumber').val(courseNumberCount);
                $('#classNumber').modal('hide');
            });

            /*
                $('.searchCourseNumberCheck').change(function() {
                    var values = [];
                        $('.searchCourseNumberCheck:checked').each(function() {
                        //if(values.indexOf($(this).val()) === -1){
                            values=$(this).closest("tr").find(".courseNum").text();
                        
                        //  $('.inputCourseNumber').attr("value", values)
                        // }
                        });
                        console.log(values);
                });
            */

        });

    </script>

</body>

</html>