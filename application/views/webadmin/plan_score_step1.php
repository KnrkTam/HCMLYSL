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
                                            <label class="text-nowrap">????????? </label>
                                            <p>2019/2020</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">????????? </label>
                                            <p>?????????1234</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">????????????????????? </label>
                                            <p>??? 1</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">?????????</label>
                                            <p>?????????</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">????????? </label>
                                            <p>11???22</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">?????????</label>
                                            <p>11/11/19 ??? 21/1/20</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">??????????????? </label>
                                            <p>1.1 ????????????</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">?????????</label>
                                            <p>???????????????????????????
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <h4 class="bold">?????????</h4>
                                <ul class="nav nav-tabs tabselector">
                                    <li class="active">
                                        <div class="nav-item dropdown">
                                            <a href="#tab01" class="nav-link dropdown-toggle d-flex align-items-center" role="tab" data-toggle="tab"> H???(3)</a>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="nav-item dropdown">
                                            <a href="#tab02" class="nav-link dropdown-toggle d-flex align-items-center" role="tab" data-toggle="tab"> HM???(0)</a>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="nav-item dropdown">
                                            <a href="#tab03" class="nav-link dropdown-toggle d-flex align-items-center" role="tab" data-toggle="tab"> M???(2)</a>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="nav-item dropdown">
                                            <a href="#tab04" class="nav-link dropdown-toggle d-flex align-items-center" role="tab" data-toggle="tab"> ML???(1)</a>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="nav-item dropdown">
                                            <a href="#tab05" class="nav-link dropdown-toggle d-flex align-items-center" role="tab" data-toggle="tab"> L???(2)</a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="tab01">
                                        <p class="bold mb-4">????????????: H????????? ??????: ??????A , ??????C , ??????F</p>

                                        <table class="table table-bordered table-striped outlineSelectedTable1">



                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab02">
                                        <p class="bold mb-4">????????????:HM????????? ??????: </p>
                                        <table class="table table-bordered table-striped outlineSelectedTable2">

                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab03">
                                        <p class="bold mb-4">????????????:M????????? ??????: ??????A , ??????C</p>
                                        <table class="table table-bordered table-striped outlineSelectedTable3">

                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab04">
                                        <p class="bold mb-4">????????????:ML????????? ??????: ??????A</p>
                                        <table class="table table-bordered table-striped outlineSelectedTable4">

                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab05">
                                        <p class="bold mb-4">????????????:L????????? ??????: ??????A , ??????C </p>
                                        <table class="table table-bordered table-striped outlineSelectedTable5">

                                        </table>
                                    </div>
                                </div>


                                <hr>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn bg-orange mw-100 mb-4 mr-4" onclick="location.href='../Bk_plan_score/create02';">??? ??? ???</button>

                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">??? ???</button>

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

            var data = [{
                    "id": "1",
                    "subjct": "??????1234",
                    "course": "??????",
                    "category": "??????",
                    "coursepoint": "????????????",
                    "element": "??????",
                    "group": "??????",
                    "addon": "1.1 ????????????????????????",
                    "studyresults": "????????????????????????????????????????????????",
                    "performance": "????????????????????????????????? (1)",
                    "evaluation": "A",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "?????????",
                },
                {
                    "id": "1",
                    "subjct": "??????1234",
                    "course": "??????",
                    "category": "??????",
                    "coursepoint": "????????????",
                    "element": "??????",
                    "group": "??????",
                    "addon": "1.1 ????????????????????????",
                    "studyresults": "????????????????????????????????????????????????",
                    "performance": "????????????????????????????????? (2)",
                    "evaluation": "B",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "?????????",
                },
                {
                    "id": "2",
                    "subjct": "??????",
                    "course": "??????",
                    "category": "??????",
                    "coursepoint": "????????????",
                    "element": "??????",
                    "group": "??????",
                    "addon": "1.1 ????????????????????????",
                    "studyresults": "????????????????????????????????????????????????",
                    "performance": "????????????????????????????????? (1)",
                    "evaluation": "A",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "?????????",
                },
                {
                    "id": "2",
                    "subjct": "??????",
                    "course": "??????",
                    "category": "??????",
                    "coursepoint": "????????????",
                    "element": "??????",
                    "group": "??????",
                    "addon": "1.1 ????????????????????????",
                    "studyresults": "????????????????????????????????????????????????",
                    "performance": "????????????????????????????????? (2)",
                    "evaluation": "B",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "?????????",
                },
                {
                    "id": "2",
                    "subjct": "??????",
                    "course": "??????",
                    "category": "??????",
                    "coursepoint": "?????????????????????",
                    "element": "??????",
                    "group": "??????",
                    "addon": "1.3 ???????????????????????????",
                    "studyresults": "????????????????????????????????????????????????",
                    "performance": "????????????????????????????????? (3)",
                    "evaluation": "c",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "?????????",
                },
                {
                    "id": "3",
                    "subjct": "????????????",
                    "course": "??????",
                    "category": "??????",
                    "coursepoint": "?????????????????????",
                    "element": "??????",
                    "group": "??????",
                    "addon": "1.3 ???????????????????????????",
                    "studyresults": "????????????????????????????????????????????????",
                    "performance": "????????????????????????????????? (1)",
                    "evaluation": "A",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "?????????",
                }
            ];



            var columnDefs = [{

                data: "category",
                title: "??????",
                class: ""
            }, {
                name: "first",
                data: "coursepoint",
                title: "????????????????????????",
                class: ""
            }, {
                name: "first",
                render: function(data, type, row) {

                    var result = row.studyresults + ' <input class="form-control" type="text" placeholder="">';
                    return result;

                },
                data: "studyresults",
                title: "??????????????????",
                class: ""
            }, {
                data: "performance",
                title: "??????????????????",
                class: ""
            }];



            $('.outlineSelectedTable1').DataTable({
                data: data,
                columns: columnDefs,

                scrollY: "400px",
                rowsGroup: [

                    'first:name'
                ],
                scrollX: true,
                sScrollXInner: "100%",
                scrollCollapse: true,
                columnDefs: [{
                    targets: 0,
                    orderable: false,

                }]

            });

            $('.outlineSelectedTable2').DataTable({
                data: data,
                columns: columnDefs,

                scrollY: "400px",
                rowsGroup: [

                    'first:name'
                ],
                scrollX: true,
                sScrollXInner: "100%",
                scrollCollapse: true,
                columnDefs: [{
                    targets: 0,
                    orderable: false,

                }]

            });

            $('.outlineSelectedTable3').DataTable({
                data: data,
                columns: columnDefs,

                scrollY: "400px",
                rowsGroup: [

                    'first:name'
                ],
                scrollX: true,
                sScrollXInner: "100%",
                scrollCollapse: true,
                columnDefs: [{
                    targets: 0,
                    orderable: false,

                }]

            });

            $('.outlineSelectedTable4').DataTable({
                data: data,
                columns: columnDefs,

                scrollY: "400px",
                rowsGroup: [

                    'first:name'
                ],
                scrollX: true,
                sScrollXInner: "100%",
                scrollCollapse: true,
                columnDefs: [{
                    targets: 0,
                    orderable: false,

                }]

            });

            $('.outlineSelectedTable5').DataTable({
                data: data,
                columns: columnDefs,

                scrollY: "400px",
                rowsGroup: [

                    'first:name'
                ],
                scrollX: true,
                sScrollXInner: "100%",
                scrollCollapse: true,
                columnDefs: [{
                    targets: 0,
                    orderable: false,

                }]

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