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
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">科目： </label>
                                            <p>語文科1234</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group ">
                                            <label class="text-nowrap">施教組別名稱： </label>
                                            <select class="form-control select2" multiple="" data-placeholder="請選擇...">
                                                <option hidden>請選擇...</option>
                                                <option value="忠班">忠班</option>
                                                <option value="信班">信班</option>


                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 d-flex">

                                        <div class="form-group w-100">
                                            <label class="text-nowrap">年度學習單元: </label>
                                            <select class="form-control subjectSelect">
                                                <option hidden>請選擇...</option>
                                                <option value="認識自己">認識自己</option>
                                                <option value="認識自己">認識自己</option>
                                                <option value="認識自己">認識自己</option>
                                                <option value="認識自己">認識自己</option>
                                            </select>
                                        </div>
                                        <a href="#" class="link nowrap mt-30 ml-2 controlSearchBtn">檢視各級單元及備註內容</a>

                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元： </label>
                                            <p class="mt-2">單元一</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">週次： </label>
                                            <p class="mt-2">1 至 10</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h4 class="bold">搜尋單元：</h4>
                                        <ul class="nav nav-tabs tabselector">
                                            <li class="active">
                                                <div class="nav-item dropdown">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#tab01" class="nav-link dropdown-toggle d-flex align-items-center" role="tab" data-toggle="tab">
                                                            <i class="fa fa-fw fa-circle-o"></i>
                                                        </a>

                                                        <select class="form-control tabSelect" name="Company">
                                                            <option value="認識自己" selected hidden>1.1 認識自己</option>
                                                            <option value="我的學校">1.2 我的學校</option>
                                                            <option value="可愛的小動物">5.1 可愛的小動物</option>
                                                            <option value="我的家">5.5 我的家</option>
                                                            <option value="xxx">5.6 xxx</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="nav-item dropdown">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#tab02" class="nav-link dropdown-toggle d-flex align-items-center" role="tab" data-toggle="tab">
                                                            <i class="fa fa-fw fa-circle-o"></i>
                                                        </a>
                                                        <select class="form-control tabSelect" name="Company">
                                                            <option value="認識自己" selected hidden>1.1 認識自己</option>
                                                            <option value="我的學校">1.2 我的學校</option>
                                                            <option value="可愛的小動物">5.1 可愛的小動物</option>
                                                            <option value="我的家">5.5 我的家</option>
                                                            <option value="xxx">5.6 xxx</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </li>
                                            <li>
                                                <div class="nav-item dropdown">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#tab03" class="nav-link dropdown-toggle" role="tab" data-toggle="tab">
                                                            <i class="fa fa-fw fa-circle-o"></i>
                                                        </a>
                                                        <select class="form-control tabSelect" name="Company">
                                                            <option value="認識自己" selected hidden>1.1 認識自己</option>
                                                            <option value="我的學校">1.2 我的學校</option>
                                                            <option value="可愛的小動物">5.1 可愛的小動物</option>
                                                            <option value="我的家">5.5 我的家</option>
                                                            <option value="xxx">5.6 xxx</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </li>
                                            <li>
                                                <div class="nav-item dropdown">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#tab04" class="nav-link dropdown-toggle d-flex align-items-center" role="tab" data-toggle="tab">
                                                            <i class="fa fa-fw fa-circle-o"></i>
                                                        </a>
                                                        <select class="form-control tabSelect" name="Company">
                                                            <option value="認識自己" selected hidden>1.1 認識自己</option>
                                                            <option value="我的學校">1.2 我的學校</option>
                                                            <option value="可愛的小動物">5.1 可愛的小動物</option>
                                                            <option value="我的家">5.5 我的家</option>
                                                            <option value="xxx">5.6 xxx</option>
                                                        </select>

                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="nav-item dropdown">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#tab05" class="nav-link dropdown-toggle d-flex align-items-center" role="tab" data-toggle="tab">
                                                            <i class="fa fa-fw fa-circle-o"></i>
                                                        </a>
                                                        <select class="form-control tabSelect" name="Company">
                                                            <option value="認識自己" selected hidden>1.1 認識自己</option>
                                                            <option value="我的學校">1.2 我的學校</option>
                                                            <option value="可愛的小動物">5.1 可愛的小動物</option>
                                                            <option value="我的家">5.5 我的家</option>
                                                            <option value="xxx">5.6 xxx</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active in" id="tab01">

                                                <table class="table table-bordered table-striped outlineSelectedTable1">

                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="tab02">

                                                <table class="table table-bordered table-striped outlineSelectedTable2">

                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="tab03">

                                                <table class="table table-bordered table-striped outlineSelectedTable3">

                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="tab04">

                                                <table class="table table-bordered table-striped outlineSelectedTable4">

                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="tab05">

                                                <table class="table table-bordered table-striped outlineSelectedTable5">

                                                </table>
                                            </div>
                                        </div>

                                        <h4 class="bold pt-4">共通能力/價值觀</h4>

                                        <table class="table table-bordered table-striped skillSelectedTable">

                                        </table>

                                        <hr>
                                        <div class="mt-4 d-flex justify-content-end">
                                            <button type="button" class="btn bg-orange mw-100 mb-4 mr-4" onclick="location.href='../Bk_teach_outline/preview';">確 定</button>

                                            <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">返 回</button>

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

        <?php include_once("footer.php"); ?>




        <div class="modal fade in" tabindex="-1" role="dialog" id="editDetail">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">補充內容 修改
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h3>

                    </div>
                    <div class="modal-body">

                        <div class="row mb-4">
                            <div class="col-lg-4">
                                <div class="form-group mb-0">
                                    <label class="text-nowrap">科目：</label>
                                    <p>語文科1234</p>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-0">
                                    <label class="text-nowrap">範疇：</label>
                                    <p>聆聽</p>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-0">
                                    <label class="text-nowrap">校本課程學習重點：</label>
                                    <p>聽力訓練</p>

                                </div>
                            </div>

                        </div>
                        <hr>

                        <div class="row mb-4">
                            <div class="col-lg-4">
                                <div class="form-group ">
                                    <label class="text-nowrap">預期學習成果：</label>
                                    <p>聽懂初階單元動詞及形容詞</p>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <p class="bold">關鍵表現項目：</p>
                                <p>有意識地留意及回應聲音 (1)</p>
                                <p>有意識地留意及回應聲音 (2)</p>
                                <p>有意識地留意及回應聲音 (3)</p>
                                <p>有意識地留意及回應聲音 (4)</p>
                            </div>

                        </div>
                        <div class="row d-flex list-row-header mb-2">
                            <div class="col-3 bold">
                                組別：
                            </div>
                            <div class="col-3 bold">
                                初組
                            </div>
                            <div class="col-3 bold">
                                中組
                            </div>
                            <div class="col-3 bold">
                                高組
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-3 bold">
                                <p class="mt-2">1.1 我的學校</p>

                            </div>
                            <div class="col-lg-3 bold lowLevel d-flex nowrap align-items-center">
                                <input type="text" class="form-control" value="初 - 去、坐">

                            </div>
                            <div class="col-lg-3 bold middleLevel d-flex nowrap align-items-center">
                                <input type="text" class="form-control" value="中 - 去、坐">
                            </div>
                            <div class="col-lg-3 bold hightLevel d-flex nowrap align-items-center">
                                <input type="text" class="form-control" value="高 - 去、坐">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-3 bold">
                                <p class="mt-2">1.3 我的家</p>

                            </div>
                            <div class="col-lg-3 bold lowLevel d-flex nowrap align-items-center">
                                <input type="text" class="form-control">

                            </div>
                            <div class="col-lg-3 bold middleLevel d-flex nowrap align-items-center">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-lg-3 bold hightLevel d-flex nowrap align-items-center">
                                <input type="text" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">確 定</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>


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

                render: function(data, type, row) {

                    var result = row.addon + '<br/> <a href="#" class="link" data-toggle="modal" data-target="#editDetail">修改</a>';
                    return result;

                },
                name: 'first',
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
                name: 'first',
                data: "coursenum",
                title: "課程編號",
                class: ""
            }, {
                name: 'first',
                data: "courserelatenum",
                title: "相關課程編號",
                class: ""
            }, {
                name: 'first',
                data: "projectnum",
                title: "相關項目編號",
                class: ""
            }, {
                name: 'first',
                data: "remarks",
                title: "備註",
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

            }).columns.adjust();

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

            $('.skillSelectedTable').DataTable({
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