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


                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <?php form_list_type('year_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $year_id, 'data-placeholder' => '請選擇...', 'enable_value' => $years_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?>
                                            <input type="hidden" name="year_id" value="<?= $year_id?> " />
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="text-nowrap">學階： </label>
                                            <?php form_list_type('level_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $level_id, 'data-placeholder' => '請選擇...', 'enable_value' => $levels_list, 'form_validation_rules' => 'trim|required', 'disabled' => 1]) ?>
                                            <input type="hidden" name="level_id" value="<?= $level_id?> " />
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-flex list-row-header mb-2">
                                    <div class="col-5 bold">
                                        日期：
                                    </div>
                                    <div class="col-3 bold">
                                        週次：
                                    </div>
                                    <div class="col-2 bold">
                                        評估日期 1：
                                    </div>
                                    <div class="col-2 bold">
                                        評估日期 2：
                                    </div>
                                </div>
                                <? foreach ($modules_list as $i => $row) { ?>

                                <div class="row mb-2">
                                    <div class="col-md-5 bold">
                                        <div class="form-group">
                                            <div class="d-flex flex-md-row flex-column ">
                                                <label class="text-nowrap mr-2 mt-3"><?= $row ?> </label>
                                                <div class="d-flex align-items-center w-100">
                                                    <div class="input-group date w-100">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right datepicker" value="<?= date('d/m/Y', strtotime($data['module_from_'.$i.'']))?>" name="moduleFrom[<?=$i?>]">
                                                    </div>

                                                    <span class="ml-2 mr-2">至</span>
                                                    <div class="input-group date w-100">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right datepicker" value="<?= date('d/m/Y', strtotime($data['module_to_'.$i.'']))?>" name="moduleTo[<?=$i?>]">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 bold">
                                        <div class="form-group">
                                            <div class="d-flex flex-md-row flex-column ">

                                                <div class="d-flex align-items-center w-100">
                                                    <?php form_list_type('weekNumFrom['.$i.']', ['type' => 'select', 'class'=> 'form-control select2 weekNumFrom','value' => $data['week_from_'.$i.''], 'data-placeholder' => '請選擇...', 'enable_value' => $week_count, 'form_validation_rules' => 'trim|required']) ?>       
                                                    <span class="ml-2 mr-2">至</span>
                                                    <?php form_list_type('weekNumTo['.$i.']', ['type' => 'select', 'class'=> 'form-control select2 WeekNumTo','value' => $data['week_to_'.$i.''] , 'data-placeholder' => '請選擇...', 'enable_value' => $week_count, 'form_validation_rules' => 'trim|required']) ?>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-2 bold">
                                        <div class="input-group date mb-3">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" name="assessment1[<?=$i?>]" value="<?= date('d/m/Y', strtotime($data['first_assessment_'.$i.'']))?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 bold">
                                        <div class="input-group date mb-3">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" name="assessment2[<?=$i?>]" value="<?= date('d/m/Y', strtotime($data['second_assessment_'.$i.'']))?>">
                                        </div>
                                    </div>
                                </div>
                                <? } ?>

                                <div class="mt-4 d-flex justify-content-end">
                                    <input type="hidden" name="action" value="edit"/>

                                    <button type="submit" class="btn bg-orange mw-100 mb-4 mr-4">確 定</button>

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



            function loopWeek() {

                for (var i = 1; i < 23; i++) {
                    $('<option  value="' + i + '">').append(i).appendTo(".weekNum");
                }

            }
            loopWeek();
            $('.datepicker').datepicker({
                autoclose: true
            })

            $('.WeekNumTo').change(function(){
                
                let changedId = this.id.slice(-2,-1);
                let newId = parseInt(changedId);
                let num = $(".weekNumFrom");
                $(num[newId]).val(parseInt(this.value)+1).select2();

            })



            var columnDefs = [{
                    render: function(data, type, row) {
                        // alert(row.id);
                        // data: null,
                        // title: "操作",
                        // defaultContent:
                        // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-md">Delete</a>'
                        // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-md">Edit Btn</a>'
                        var result = '<a class="editLinkBtn" href="../webadmin/Bk_subject_outline/edit" data-id="' + row
                            .id + '"><i class="fa fa-edit"></i></a>';
                        return result;

                    },
                    data: "id",
                    name: 'zore',
                    title: "",
                    class: "no-sort"
                },
                {
                    name: 'first',
                    data: "year",
                    title: "年度",
                    class: ""
                },
                {
                    name: 'first',
                    data: "degree",
                    title: "學階",
                    class: "",
                },
                {

                    data: "date",
                    title: "日期",
                    class: ""
                },
                {

                    data: "week",
                    title: "週次",
                    class: ""
                },
                {

                    data: "evaluation01",
                    title: "評估日期1",
                    class: ""
                },
                {

                    data: "evaluation02",
                    title: "評估日期2",
                    class: ""
                }
            ];






            $(".searchBtn").click(function() {

                $(".tableWrap").fadeIn();
                $('#studyUnitTable').DataTable({
                    data: data,
                    columns: columnDefs,
                    rowsGroup: [
                        'zore:name',
                        'first:name',


                    ],
                    select: {
                        style: 'os',
                        selector: 'td:not(:first-child)'
                    },

                    scrollX: true,
                    scrollCollapse: true,
                    drawCallback: function(settings) {
                        $('[data-toggle="tooltip"]').tooltip();

                    }

                });

            });

        });



        function submit_form(_this) {
            //form checking
            var valid_data = true;
            //.form checking
            if (!valid_data) {
                //alert('Invalid Data.');
            } else {
                ajax_submit_form(_this);
            }
        }

        <?php /*
    //multiple image upload
    $("input.multiple_upload").fileinput({
        language: '<?=get_wlocale()?>',
        previewFileType: "image",
        showCaption: false,
        showUpload: false,
        maxFileSize: 2048,
        maxFileCount: 30,
        maxImageHeight: 2000,
        maxImageWidth: 2000,
        overwriteInitial: false,
        allowedFileExtensions: ['jpg','jpeg','png'],
        initialPreview: <?=isset($photos_preview) ? $photos_preview : "{}"?>,
        initialPreviewAsData: true,
        initialPreviewConfig: <?=isset($photos_json) ? $photos_json : "{}"?>,
        deleteUrl: "<?=admin_url('bk_news/delete_multiple_upload')?>",
        // hiddenThumbnailContent: true,
        // initialPreviewShowDelete: true,
        // removeFromPreviewOnError: true,
    }).on('filedeleted', function(event, key, jqXHR, data) {
        alertify.success("<?=__('Deleted successfully!')?>");
    });
 */ ?>
    </script>

</body>

</html>