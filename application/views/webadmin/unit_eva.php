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
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">年度： </label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="2019/2020">2019/2020</option>
                                                <option value="2021/2022">2021/2022</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">教師： </label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="全部">全部</option>
                                                <option value="xxx">xxx</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">班別：</label>
                                            <select class="form-control select2" multiple="" data-placeholder="請選擇...">

                                                <option value="全部">全部</option>
                                                <option value="忠">忠</option>
                                                <option value="仁">仁</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元： </label>
                                            <select class="form-control select2" multiple="" data-placeholder="請選擇...">

                                                <option value="19/20">全部</option>
                                                <option value="20/21">單元一</option>
                                                <option value="19/20">單元二</option>
                                                <option value="20/21">單元三</option>
                                                <option value="20/21">單元四
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">狀態： </label>
                                            <select class="form-control select2" multiple="" data-placeholder="請選擇...">

                                                <option value="19/20">全部</option>
                                                <option value="20/21">已提交</option>
                                                <option value="19/20">未提交</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>
                                </div>


                                <div class="tableWrap hidenWrap">
                                    <table class="table table-bordered table-striped w-100" id="settingTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">

                                                <th class="nowrap">年度</th>
                                                <th class="nowrap">班別</th>
                                                <th class="nowrap">學生名稱</th>
                                                <th class="nowrap">科目/服務</th>
                                                <th class="nowrap">單元(一/二/三/四)</th>
                                                <th class="nowrap">主要任教</th>
                                                <th class="nowrap">評分</th>
                                                <th class="nowrap">列印</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>

                                                <td>2019/2020</td>
                                                <td>忠</td>
                                                <td>XXX 1</td>
                                                <td>語文科1234</td>
                                                <td>單元一</td>
                                                <td>XXX</td>

                                                <td>
                                                    <a class="link" href="#">查閱<span class="text-orange">(未提交)</span></a>
                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_unit_eva/print">列印 (已鎖定)</a>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>2019/2020</td>
                                                <td>忠</td>
                                                <td>XXX 1</td>
                                                <td>語文科1234</td>
                                                <td>單元一</td>
                                                <td>XXX</td>

                                                <td>
                                                    <a class="link" href="#">查閱<span class="text-orange">(未提交)</span></a>
                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_unit_eva/print">列印 (已鎖定)</a>
                                                </td>

                                            </tr>
                                            <tr>

                                                <td>2019/2020</td>
                                                <td>忠</td>
                                                <td>XXX 1</td>
                                                <td>語文科1234</td>
                                                <td>單元一</td>
                                                <td>XXX</td>

                                                <td>
                                                    <a class="link" href="#">查閱<span class="text-green">(已提交)</span></a>
                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_unit_eva/print">列印 (已鎖定)</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>2019/2020</td>
                                                <td>忠</td>
                                                <td>XXX 1</td>
                                                <td>語文科1234</td>
                                                <td>單元一</td>
                                                <td>XXX</td>

                                                <td>
                                                    <a class="link" href="#">查閱<span class="text-orange">(未提交)</span></a>
                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_unit_eva/print">列印 (已鎖定)</a>
                                                </td>
                                            </tr>

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

            //  table.columns.adjust();
            $(".searchBtn").click(function() {

                $(".tableWrap").fadeIn();

                $('#settingTable').DataTable({
                    scrollX: true,
                    scrollCollapse: true,
                    bFilter: false,
                    bInfo: true,
                    sScrollXInner: "100%",
                    bLengthChange: true,
                    columnDefs: [{
                        targets: 'no-sort',
                        orderable: false,

                    }]


                }).columns.adjust();

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