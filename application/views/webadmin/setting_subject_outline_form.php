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
                                            <label class="text-nowrap"><span class="text-red">*</span>科目： </label>
                                            <select class="form-control subjectSelect">
                                                <option value="" hidden>請選擇...</option>
                                                <option value="a">語文1234</option>
                                                <option value="b">語文1234</option>
                                                <option value="c">語文1234</option>
                                                <option value="d">語文1234</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="d-flex">
                                            <div class="form-group w-100">
                                                <label class="text-nowrap"><span class="text-red">*</span>年度學習單元：</label>
                                                <select class="form-control ">
                                                    <option hidden>請選擇...</option>
                                                    <option value="聆聽">聆聽</option>
                                                    <option value="聆聽">聆聽</option>
                                                    <option value="聆聽">聆聽</option>
                                                    <option value="聆聽">聆聽</option>

                                                </select>
                                            </div>
                                            <div style="margin-top:25px" class="ml-4">
                                                <button type="button" class="btn bg-orange mb-4" data-toggle="modal" data-target="#editDetail">新增單元名稱</button>
                                            </div>
                                            <a href="#" class="link nowrap mt-30 ml-2 controlSearchBtn">隱藏搜尋</a>
                                        </div>
                                    </div>

                                </div>
                                <hr>



                                <div class="subject_achievementNew">

                                    <div class="row mb-4">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="text-nowrap">範疇:</label>
                                                <select class="form-control select2" multiple="" data-placeholder="請選擇...">
                                                    <option hidden>請選擇...</option>
                                                    <option value="全部/聆聽">全部/聆聽</option>
                                                    <option value="聆聽">聆聽</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-nowrap">校本課程學習重點:</label>
                                                <select class="form-control select2" multiple="" data-placeholder="請選擇...">
                                                    <option hidden>請選擇...</option>
                                                    <option value="全部/非華語/新生入學評估">全部/非華語/新生入學評估</option>
                                                    <option value="全部/非華語">全部/非華語</option>
                                                    <option value="全部/新生入學評估">全部/新生入學評估</option>
                                                    <option value="全部">全部</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-1">
                                            <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                        </div>

                                    </div>
                                </div>


                                <div class="tableWrap hidenWrap">
                                    <h5 class="text-purple"><b>選擇項目：</b></h5>
                                    <table class="table table-bordered table-striped dataTable" id="subjectTable">

                                    </table>
                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="button" class="btn bg-maroon mw-100 mr-4" onclick="location.href='../Bk_setting_subject_outline/preview';">下一步</button>
                                        <button type="button" class="btn btn-default mw-100">返 回</button>
                                    </div>
                                    <hr>
                                    <div class="col-lg-12">
                                        <h5 class="text-yellow"><b>已選項目：</b></h5>

                                        <table class="table table-bordered table-striped" id="subjectSelectedTable">

                                        </table>

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

    </div>
    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>



    <div class="modal fade in" tabindex="-1" role="dialog" id="editDetail">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title bold">新增單元名稱
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h3>

                </div>
                <div class="modal-body">

                    <div class="row mb-4">



                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-nowrap">單元名稱： </label>
                                <input type="text" class="form-control" value="">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-orange">確 定</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip();

            var data = [{
                    "id": "1",
                    "subjct": "語文1234",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "初組",
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
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
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
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
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
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
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
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
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
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
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
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

                        var getId = $("table").attr("id");

                        if (getId == "subjectTable") {
                            var result = '<input type="checkbox" name="subjectCheck" class="subjectCheck" />';
                            return result;
                        } else {
                            var result = '<a class="editLinkBtn text-red" href="#"><i class="fa fa-fw fa-trash-o"></i></a>';
                            return result;

                        }
                        // alert(row.id);
                        // data: null,
                        // title: "操作",
                        // defaultContent:
                        // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-lg">Delete</a>'
                        // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-lg">Edit Btn</a>'

                    },
                    data: "id",
                    name: 'zore',
                    title: "",
                    class: "no-sort"
                },
                {
                    name: 'first',
                    data: "subjct",
                    title: "課程",
                    class: ""
                },
                {
                    name: 'first',
                    data: "course",
                    title: "課程",
                    class: "",
                },
                {
                    name: 'first',
                    data: "category",
                    title: "範疇",
                    class: ""
                },
                {
                    name: 'first',
                    data: "coursepoint",
                    title: "校本課程學習重點",
                    class: ""
                },
                {
                    name: 'first',
                    data: "element",
                    title: "學習元素",
                    class: ""
                },
                {
                    name: 'first',
                    data: "group",
                    title: "組別",
                    class: ""
                },
                {
                    name: 'first',
                    data: "lpfl",
                    title: "LPF(基礎)",
                    class: ""
                },
                {
                    name: 'first',
                    data: "lpfh",
                    title: "LPF(高中)",
                    class: ""
                },
                {

                    render: function(data, type, row) {
                        var result = row.poas + ' <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                        return result;
                    },

                    name: 'first',
                    data: "poas",
                    title: "POAS",
                    class: ""
                },
                {
                    render: function(data, type, row) {
                        var result = row.poas + ' <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span>';
                        return result;
                    },

                    name: 'first',
                    data: "keyskill",
                    title: "Key Skill",
                    class: ""
                },
                {


                    name: 'first',
                    data: "studyresults",
                    title: "預期學習成果",
                    class: ""
                },
                {
                    data: "performance",
                    title: "關鍵表現項目",
                    class: ""
                },
                {
                    data: "evaluation",
                    title: "評估模式",
                    class: ""
                },
                {
                    name: 'first',
                    data: "coursenum",
                    title: "課程編號",
                    class: ""
                },
                {
                    name: 'first',
                    data: "courserelatenum",
                    title: "相關課程編號",
                    class: ""
                },
                {
                    name: 'first',
                    data: "projectnum",
                    title: "相關項目編號",
                    class: ""
                },
                {
                    name: 'first',
                    data: "remarks",
                    title: "備註",
                    class: ""
                }
            ];




            $(".searchBtn").click(function() {

                $(".tableWrap").fadeIn();

                $('#subjectTable').DataTable({
                    data: data,
                    columns: columnDefs,

                    scrollY: "400px",
                    rowsGroup: [
                        'zore:name',
                        'first:name',
                    ],
                    scrollX: true,
                    scrollCollapse: true,
                    drawCallback: function(settings) {
                        $('[data-toggle="tooltip"]').tooltip();

                    }

                });


                $('#subjectSelectedTable').DataTable({
                    data: data,
                    columns: columnDefs,
                    rowsGroup: [
                        'zore:name',
                        'first:name',

                    ],
                    scrollX: true,
                    scrollCollapse: true,
                    drawCallback: function(settings) {
                        $('[data-toggle="tooltip"]').tooltip();

                    }

                });
            });





            $(".controlSearchBtn").click(function() {


                // $(".subject_achievementNew").slideToggle("active");

                // Animation complete.

                $(".subject_achievementNew").slideToggle('slow', function() {
                    $('.controlSearchBtn').toggleClass('active', $(this).is(':visible'));
                    if ($('.controlSearchBtn').hasClass("active")) {
                        $(".controlSearchBtn").text("隱藏搜尋");
                    } else {
                        $(".controlSearchBtn").text("顯示搜尋");
                    }
                });


            });
            $(".subjectSelect").change(function() {
                if ($(this).val() != "") {
                    $(".subject_achievementNew").fadeIn();
                    $(".controlSearchBtn").fadeIn();
                    $(".controlSearchBtn").text("隱藏搜尋");
                } else {
                    $(".subject_achievementNew").hide();
                }

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