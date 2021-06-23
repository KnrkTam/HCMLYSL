<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "head.php"; ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include_once "header.php"; ?>

        <?php include_once "menu.php"; ?>

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

                                <div class="tableWrap">
                                    <div class="row">
                                    <div class="col-lg-12">
                                            <h3 class="text-blue"><b><?= $subject?></b></h5>
                                    </div>
                                        <div class="col-lg-12">
                                            <h5 class="text-purple"><b>已選項目：</b></h5>

                                            <table class="table table-bordered table-striped" id="subjectTable">
                                                <thead>
                                                    <tr class="bg-light-blue color-palette">
                                                        <th class="nowrap">課程</th>
                                                        <th class="nowrap">範疇</th>
                                                        <th class="nowrap">中央課程學習重點</th>
                                                        <th class="nowrap">校本課程學習重點</th>
                                                        <th class="nowrap">學習元素</th>
                                                        <th class="nowrap">組別</th>
                                                        <th class="nowrap">LPF(基礎)</th>
                                                        <th class="nowrap">LPF(高中)</th>
                                                        <th class="nowrap">POAS</th>
                                                        <th class="nowrap">Key Skill</th>
                                                        <th class="nowrap">前備技能</th>
                                                        <th class="nowrap">預期學習成果</th>
                                                        <th class="nowrap">課程編號</th>
                                                        <th class="nowrap">相關項目編號</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>

                                            <div class="mt-4 d-flex justify-content-end">
                                                <input type="hidden" name="subject_id" value="<?= $id?>"></input>
                                                <input type="hidden" name="lessons_id[]" value=<?= json_encode($added_ids, true)?>></input>

                                                <button type="submit" class="btn bg-maroon mr-4 mw-100">確 定</button>
                                                <button type="button" class="btn btn-default mw-100" onclick="location.href='<?= (admin_url($page_setting['controller'])) . '/'. $previous. '/'. $id?>';">返 回</button>
                                            </div>
                                            <hr>
                                        </div>

                                    </div>


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
            var subjectTable = $('#subjectTable').DataTable({
                // data: <?php echo $table?>, 
                // scrollX: true,
                // scrollCollapse: true,
                // bFilter: false,
                // bInfo: true,
                // bLengthChange: false,
                scrollX: true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/' . get_wlocale() . '.json') ?>"
                },
                "order": [],
                "bSort": false,
                "pageLength": 50,
                "pagingType": "input",
                //"sDom": '<"wrapper"lfptip>',
                "processing": false,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/preview_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        let added_arr = <?= json_encode($added_ids)?>;
                        // console.log(typeof(added_arr))
                        d.added_ids = added_arr;
                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
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