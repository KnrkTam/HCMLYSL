<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("head.php"); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include_once("header.php"); ?>
        <link href="<?= assets_url('webadmin/css/jquery.transfer.css') ?>" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="<?= assets_url('webadmin/icon_font/css/icon_font.css') ?>" />

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
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度：</label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="19/20" selected>2019/2020</option>
                                                <option value="20/21">2021/2022</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-nowrap">服務：</label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="個別化學習計劃及支援性教學" selected>個別化學習計劃及支援性教學</option>
                                                <option value="個別化學習計劃及支援性教學">個別化學習計劃及支援性教學</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">負責人：</label>
                                            <div class="d-flex">
                                                <select class="form-control">
                                                    <option hidden>請選擇...</option>
                                                    <option value="xxx" selected>xxx</option>
                                                    <option value="xxx">xxx</option>
                                                </select>
                                                <select class="form-control">
                                                    <option hidden>請選擇...</option>
                                                    <option value="xxx" selected>xxx</option>
                                                    <option value="xxx">xxx</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">其他人員：</label>
                                            <select class="form-control select2" multiple="" data-placeholder="請選擇...">
                                                <option hidden>請選擇...</option>
                                                <option value="xxx" selected>xxx</option>
                                                <option value="xxx">xxx</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元：</label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="全部/單元一/單元二/單元三/單元四" selected>全部/單元一/單元二/單元三/單元四</option>
                                                <option value="全部/單元一/單元二/單元三/單元四">全部/單元一/單元二/單元三/單元四</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-nowrap">支援服務名稱： </label>

                                            <div class="d-flex align-items-center">
                                                <div class="form-check d-flex align-items-center w-100 mr-4">
                                                    <input class="form-check-input" type="radio" name="teahGroup" value="option1" checked>
                                                    <select class="form-control teahGroupSelect">
                                                        <option hidden>請選擇...</option>
                                                        <option value="語文科1234" selected>忠</option>
                                                        <option value="語文科1234">忠</option>
                                                    </select>
                                                </div>


                                                <div class="form-check w-100">
                                                    <input class="form-check-input" type="radio" name="teahGroup" id="teahOther" value="other">
                                                    <label class="form-check-label" for="teahOther">
                                                        其他
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 teachGorupControl">
                                        <hr>
                                        <p class="bold">選擇學生名單</p>
                                        <div class="form-group w-50">
                                            <label class="text-nowrap">班名：</label>
                                            <select class="form-control">
                                                <option hidden value="">請選擇...</option>
                                                <option value="忠">忠</option>
                                                <option value="忠">忠</option>
                                            </select>
                                        </div>
                                        <div id="transfer1" class="transfer-demo"></div>
                                    </div>
                                </div>


                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary mw-100 mb-4 mr-4" onclick="location.href='../Bk_group_service/preview';">確 定</button>

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

    <script src="<?= assets_url('webadmin/js/jquery.transfer.js') ?>"></script>

    <script>
        $(document).ready(function() {


            $('input[type=radio][name=teahGroup]').change(function() {
                if (this.value == 'other') {
                    $(".teachGorupControl").fadeIn();
                    $(".teahGroupSelect").val("");
                    $(".teahGroupSelect").prop("disabled", true);
                } else {
                    $(".teachGorupControl").hide();
                    $(".teahGroupSelect").prop("disabled", false);
                }
            });


            var dataArray1 = [{
                    "name": "關 xx",
                    "value": 132
                },
                {
                    "name": "方 xx",
                    "value": 422
                },
                {
                    "name": "楊 x",
                    "value": 232
                },
                {
                    "name": "黎 xx",
                    "value": 765
                },
                {
                    "name": "張 xx",
                    "value": 876
                },
                {
                    "name": "黃 xx",
                    "value": 453
                }
            ];

            var settings1 = {
                "dataArray": dataArray1,
                "itemName": "name",
                "valueName": "value",
                "callable": function(items) {
                    console.dir(items)
                }
            };

            $("#transfer1").transfer(settings1);

            $(".transfer-double-content-left .param-item").text("學生姓名");

            $(".transfer-double-content-right .param-item").text("已選擇學生名單");

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