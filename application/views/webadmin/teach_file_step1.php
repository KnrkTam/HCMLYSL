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
                                            <label class="text-nowrap">年度： </label>
                                            <p>2019/2020</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">科目： </label>
                                            <p>語文科1234</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">施教組別名稱： </label>
                                            <P>忠班,信班</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex">

                                        <div class="form-group w-100">
                                            <label class="text-nowrap">年度學習單元: </label>
                                            <p>1.1 認識自己</p>

                                        </div>


                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元： </label>
                                            <p class="mt-2">單元一</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元日期 : </label>
                                            <p class="mt-2">2/9/2019 至 8/11/2019</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">週次： </label>
                                            <p class="mt-2">1 至 10</p>

                                        </div>
                                    </div>
                                </div>


                                <table class="table table-bordered table-striped w-100 teachTable">



                                </table>

                                <h4 class="bold pt-4">共通能力/價值觀</h4>

                                <table class="table table-bordered table-striped skillSelectedTable">

                                </table>


                                <hr>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn bg-orange mw-100 mb-4 mr-4" onclick="location.href='../Bk_teach_file/create02';">下 一 步</button>

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



            var data = [{
                    "id": "1",
                    "subjct": "語文1234",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "初組",
                    "addon": "1.1 認識自己：去、坐",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (1)",
                    "evaluation": "A",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "非華語",
                },
                {
                    "id": "1",
                    "subjct": "語文1234",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "初組",
                    "addon": "1.1 認識自己：去、坐",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (2)",
                    "evaluation": "B",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "非華語",
                },
                {
                    "id": "2",
                    "subjct": "自理",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "中組",
                    "addon": "1.1 認識自己：去、坐",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (1)",
                    "evaluation": "A",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "非華語",
                },
                {
                    "id": "2",
                    "subjct": "自理",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "中組",
                    "addon": "1.1 認識自己：去、坐",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (2)",
                    "evaluation": "B",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "非華語",
                },
                {
                    "id": "2",
                    "subjct": "自理",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "中組",
                    "addon": "1.3 我的家：爸爸、媽媽",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (3)",
                    "evaluation": "c",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "非華語",
                },
                {
                    "id": "3",
                    "subjct": "生活常規",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "初組",
                    "addon": "1.3 我的家：爸爸、媽媽",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (1)",
                    "evaluation": "A",
                    "coursenum": "MN0155",
                    "courserelatenum": "MN0449, MS0002",
                    "projectnum": "",
                    "remarks": "非華語",
                }
            ];



            var columnDefs = [{
                render: function(data, type, row) {

                    var result = '<input type="checkbox" name="subjectCheck" class="subjectCheck" />';
                    return result;
                    // alert(row.id);
                    // data: null,
                    // title: "操作",
                    // defaultContent:
                    // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-lg">Delete</a>'
                    // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-lg">Edit Btn</a>'

                },
                data: "id",
                title: "",
                class: "no-sort w-10px"
            }, {

                data: "subjct",
                title: "科目",
                class: ""
            }, {

                data: "course",
                title: "課程",
                class: "",
            }, {

                data: "category",
                title: "範疇",
                class: ""
            }, {

                data: "coursepoint",
                title: "校本課程學習重點",
                class: ""
            }, {

                data: "element",
                title: "學習元素",
                class: ""
            }, {

                data: "group",
                title: "組別",
                class: ""
            }, {

                data: "studyresults",
                title: "預期學習成果",
                class: ""
            }, {
                data: "addon",
                title: "補充內容",
                class: "w-90px"
            }, {
                data: "performance",
                title: "關鍵表現項目",
                class: ""
            }, {
                data: "evaluation",
                title: "評估模式",
                class: ""
            }, {

                data: "coursenum",
                title: "課程編號",
                class: ""
            }, {

                data: "courserelatenum",
                title: "相關課程編號",
                class: ""
            }, {

                data: "projectnum",
                title: "相關項目編號",
                class: ""
            }, {

                data: "remarks",
                title: "備註",
                class: ""
            }];



            $('.teachTable').DataTable({
                data: data,
                columns: columnDefs,

                scrollY: "400px",

                scrollX: true,
                sScrollXInner: "100%",
                scrollCollapse: true,
                columnDefs: [{
                    targets: 0,
                    orderable: false,

                }]

            }).columns.adjust();

            $('.skillSelectedTable').DataTable({
                data: data,
                columns: columnDefs,

                scrollY: "400px",

                scrollX: true,
                sScrollXInner: "100%",
                scrollCollapse: true,
                columnDefs: [{
                    targets: 0,
                    orderable: false,

                }]

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