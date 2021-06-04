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
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">課程 : </label>
                                            <div style="flex: 1"><?php form_list_type('courses_id', ['type' => 'select', 'class'=> 'form-control' , 'value' =>'',  'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">範疇 : </label>
                                            <div style="flex: 1"><?php form_list_type('categories_id', ['type' => 'select', 'class'=> 'form-control' , 'value' =>'',  'enable_value' => $categories_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">


                                        <div class="form-group w-100">
                                            <label class="text-nowrap">校本課程學習重點 : (多項選擇) </label>
                                            <div style="flex: 1"><?php form_list_type('sb_obj_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $sb_obj_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>

                                        </div>
                                        <span class="ml-2 mr-2 mt-2">或</span>
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">課程編號 : (多項選擇) </label>
                                            <div style="flex: 1"><?php form_list_type('lesson_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '請選擇...', 'enable_value' => $lessons_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>

                                </div>




                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= (admin_url($page_setting['controller'])) . '/create'?>';">新 增</button>


                                <div class="tableWrap hidenWrap">
                                    <table class="table table-bordered table-striped dataTable" id="courseOutlineTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette" style="z-index: -1000;">
                                                <th class="no-sort" style="min-width: 4px;"></th>
                                                <th class="nowrap">課程</th>
                                                <th class="nowrap">範疇</th>
                                                <th class="nowrap">中央課程學習重點</th>
                                                <th class="nowrap">校本課程學習重點</th>
                                                <th class="nowrap">學習元素</th>
                                                <th class="nowrap">組別</th>
                                                <th class="nowrap">LPF(基礎)</th>
                                                <th class="nowrap">LPF(高中) P</th>
                                                <th class="nowrap">POAS</th>
                                                <th class="nowrap">Key Skill</th>
                                                <th class="nowrap">前備技能</th>
                                                <th class="nowrap">課程編號</th>
                                                <th class="nowrap">預期學習成果</th>
                                                <th class="nowrap">相關項目編號</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($lessons as $row) {?>
                                                <tr>
                                                    <td><a class="editLinkBtn" href="<?= (admin_url($page_setting['controller'])) . '/edit/'. $row['id']?>"><i class="fa fa-edit"></i></a></td>
                                                    <td><?= $row['course']?></td>
                                                    <td><?= $row['category']?></td>
                                                    <td><?= $row['central_obj']?></td>
                                                    <td><?= $row['sb_obj']?></td>
                                                    <td><?= $row['element']?></td>
                                                    <td><?= $row['groups']?></td>
                                                    <td><?= $row['lpf_basic']?></td>
                                                    <td><?= $row['lpf_advanced']?></td>
                                                    <td class="nowrap"><?= $row['poas']?><span data-toggle="tooltip" title="顥示提示內容"><i class="fa fa-info-circle"></i></span></td>
                                                    <td class="nowrap"><?= $row['skills']?><span data-toggle="tooltip" title="顥示提示內容"><i class="fa fa-info-circle"></i></span></td>
                                                    <td><? if ($row['preliminary_skill'] == 1) { ?>
                                                        <span class="text-green"><i class="fa fa-check"></i></span>
                                                    <?} else {?>
                                                        <span class="text-red"><i class="fa fa-close"></i></span>
                                                    <?}?>
                                                    </td>
                                                    <td><?= $row['code']?></td>
                                                    <td><?= $row['expected_outcome']?></td>
                                                    <td>MN0449,MS0002</td>
                                                </tr>
                                            <?}?>

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



    <script>
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
            $('#courseOutlineTable').DataTable({
                scrollX: true,
                scrollCollapse: true,
                function(){ 
                    $(".dataTable").show() 
                    $($.fn.dataTable.tables(true)).DataTable()
                    // .tables( { visible: true, api: true } )
                    .columns.adjust()
                    // .fixedColumns().relayout()

                }
            });


            $(".searchBtn").click(function() {
                $(".tableWrap").fadeIn();
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
        });
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