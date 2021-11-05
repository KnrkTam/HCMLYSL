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
                    <li class="active"><a href="<?=admin_url($page_setting['controller'])?>"><?= ($page_setting['scope']) ?></a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- column -->
                    <div class="col-md-12">
                        <!-- form start -->
                        <?= form_open_multipart($form_action, 'class="form-horizontal" id="myForm"'); ?>
                        <!-- Modal box -->
                        <div class="modal fade in" tabindex="-1" role="dialog" id="studentModal">
                            <div class="modal-dialog modal-lg modal-dialog-centered w-25" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title bold">設定學生能力程度 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button></h3>
                                        </div>
                                    <div class="modal-body">
                                        <div class="row d-flex list-row-header mb-2" id="edit-groups">
                                            <div class="col-3 bold">

                                            </div>
                                        </div>
                                        <div class="row mb-4 ">
                                            <div class="col-md-12"  id="edit-body">
                                                <?php foreach ($student_list as $i =>  $row) {?>
                                                    <div class="col-6 bold mb-2"> 
                                                        <label style="white-space:nowrap">
                                                        <?= $row ?>: &nbsp</label>
                                                        <?php form_list_type('studentLevel['.$i.']', ['type' => 'select', 'class'=> 'form-control select2', 'enable_value' => $level_list ,'value' => 1, 'form_validation_rules' => 'trim|required']) ?>
                                                    </div> 
                                                <? } ?>
                                            </div> 

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                    <!-- <button type="submit" id="save-edit-btn" class="btn btn-success">儲 存</button> -->
                                        <button type="button" id="save-edit-btn" class="btn btn-success" data-dismiss="modal">儲 存</button>
                                        <input type="hidden" name="ato_id" value="<?= $id ?>"></input>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Ends -->
                        <div class="box box-primary">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <div class="row mb-4">
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <p><?= $year?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">科目： </label>
                                            <p><?= $subject?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">施教組別名稱： </label>
                                            <p><?= $group_name?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">

                                        <div class="form-group w-100">
                                            <label class="text-nowrap">狀態： </label>
                                            <p class="text-orange">未提交</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元： </label>
                                            <p><?= $module?></p>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex">
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">單元名稱: </label>
                                            <p><?= $annual_module?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元日期： </label>
                                            <p class="mt-2"><?= $date_from ? $date_from .' 至 '. $date_to : 'NA' ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap required">節數： </label>
                                            <input type="text" class="form-control" name="session_count" placeholder="e.g. 1-3" />

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">主教老師： </label>
                                            <p class="mt-2"><?= $staff ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">首次提交日期： </label>
                                            <p><?=$today?></p> 
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap required">編寫教師：</label>
                                            <?php form_list_type('created_by', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $_SESSION['sys_user_id'], 'data-placeholder' => '請選擇...', 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                    <h4 class="bold pt-4 required">課題:</h4>
                                    <input type="text" class="form-control" name="topic" placeholder="e.g. 家居清潔及美化家居 "/>
                                    <!-- <input type='file' id='testFile'>
                                    <img id="testImage" src="" alt="Preview" class="w-75"/> -->

                                    </div>
                                </div>
                                <hr>
                                <span class="text-red small">*可拖曳目標以變換項目次序</span>
                                <table class="table table-bordered table-striped width100p" id="mainTable">
                                </table> 
                                <div id="sortable">
                                    <div class="row mb-4 list-item activity">
                                        <div class="col-lg-11">
                                        <label class="content-nowrap text-green">活動 1： </label>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="text-nowrap required">項目#： </label>
                                                        <?php form_list_type('activity_event[0][]', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $event_count, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="text-nowrap required" for="eventName">活動名稱：
                                                        </label>
                                                        <input type="text" class="form-control" name="activity_name[0]" placeholder="請填寫活動名稱 ">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="text-nowrap">教材/教具：
                                                        </label>
                                                        <input type="text" class="form-control" name="materials[0]" placeholder="請填寫活動教材/教具 ">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="text-nowrap required" >學習活動： </label>
                                                <textarea class="form-control" name="activity_content[0]" rows="3" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>上載檔案：</label>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2" accept="image/*" name="photo[0][1]" onchange="loadFile(event, 0, 1)">
                                                        <img id="output[0][1]" class="w-75"/>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2" accept="image/*"  name="photo[0][2]" onchange="loadFile(event, 0, 2)">
                                                        <img id="output[0][2]" class="w-75"/>

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2" accept="image/*"  name="photo[0][3]" onchange="loadFile(event,0, 3)">
                                                        <img id="output[0][3]" class="w-75"/>
                                                    </div>
                                                </div>
                                                <hr/>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 text-right">
                                            <button type="button" class="btn bg-navy deleteBtn mt-4 mr-4" disabled><i class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    <button type="button" id="add-btn" class="btn btn-info mw-100 mb-4" ><i class="fa fa-fw fa-plus"></i> 增加一欄
                                    </button>
                                    <hr>
                                <div class="row mb-4">
                                    <div class="col-lg-6" style="display:flex">
                                    <h4 class="bold pt-4 mr-4" style="white-space:nowrap">備註:</h4>
                                        <textarea class="form-control" name="remark" rows="3"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-4 d-flex justify-content-end">

                                    <!-- <button type="button" class="btn bg-primary mw-100 mb-4 mr-4">下 載 至 Word</button> -->
                                    <button type="button" id="submitBtn" class="btn bg-purple mw-100 mb-4 mr-4">下 一 步</button>
                                    <!-- <button type="button" class="btn bg-maroon mw-100 mb-4 mr-4">提 交</button> -->
                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">返 回</button>
                                    <input class="hidden" name="asg_id" value=<?= $asg_id ?> />
                                    <input class="hidden" name="ato_id" value=<?= $id ?> />
                                    <input class="hidden" name="event_count" value=<?= json_encode($event_count) ?> />
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

        <!-- /.content-wrapper -->

        <?php include_once("footer.php"); ?>




    </div>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>



    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>


    <script>
        $(document).ready(function() {




            $('.teachTable').DataTable({
                scrollCollapse: true,


            });

            $('.eventTable').DataTable({
                scrollY: "400px",

                scrollX: true,
                sScrollXInner: "100%",
                scrollCollapse: true,


            });
            $('.teachTable').dragtable({
                dragaccept: '.accept'
            });

            //  table.columns.adjust();


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