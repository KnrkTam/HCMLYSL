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
                                        <div class="form-group ">
                                            <label class="text-nowrap"><span class="text-red">*</span>科目： </label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="語文1234">語文1234</option>
                                                <option value="語文1234">語文1234</option>
                                                <option value="語文1234">語文1234</option>
                                                <option value="語文1234">語文1234</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>年度學習單元：</label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="聆聽">聆聽</option>
                                                <option value="聆聽">聆聽</option>
                                                <option value="聆聽">聆聽</option>
                                                <option value="聆聽">聆聽</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">範疇:</label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="全部/聆聽">全部/聆聽</option>
                                                <option value="聆聽">聆聽</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">備註：</label>
                                            <select class="form-control">
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




                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='../webadmin/Bk_setting_subject_outline/create';">新 增</button>


                                <div class="tableWrap hidenWrap">

                                    <ul class="colorMapList inlinelist mb-4">
                                        <li class="text-aqua bold">非華語</li>
                                        <li class="text-green bold">新生入學評估</li>

                                    </ul>


                                    <table class="table table-bordered table-striped dataTable" id="dataTable">

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

            $('[data-toggle="tooltip"]').tooltip();

            var data = [{
                    "id": "1",
                    "subjct": "語文1234",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "初組、中組",
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (1)",
                    "unit": "1.1 我的學校 <br/> 2.2 交通工具",
                    "remarkstip1": "show",
                    "remarkstip2": "show",
                    "remarks": "非華語",
                },
                {
                    "id": "1",
                    "subjct": "語文1234",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "初組、中組",
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (2)",
                    "unit": "1.1 我的學校 <br/>2.2 交通工具",
                    "remarkstip1": "show",
                    "remarkstip2": "show",
                    "remarks": "非華語",
                },
                {
                    "id": "2",
                    "subjct": "自理",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "初組、中組",
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (1)",
                    "unit": "1.1 我的學校 <br/>2.2 交通工具",
                    "remarkstip1": "hide",
                    "remarkstip2": "show",
                    "remarks": "非華語",
                },
                {
                    "id": "2",
                    "subjct": "自理",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "初組、中組",
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (2)",
                    "unit": "1.1 我的學校 <br/>2.2 交通工具",
                    "remarkstip1": "hide",
                    "remarkstip2": "show",
                    "remarks": "非華語",
                },
                {
                    "id": "2",
                    "subjct": "自理",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "初組、中組",
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (3)",
                    "unit": "1.1 我的學校 <br/>2.2 交通工具",
                    "remarkstip1": "hide",
                    "remarkstip2": "show",
                    "remarks": "非華語",
                },
                {
                    "id": "3",
                    "subjct": "生活常規",
                    "course": "語文",
                    "category": "聆聽",
                    "coursepoint": "聽力訓練",
                    "element": "技能",
                    "group": "初組、中組",
                    "lpfl": "I2",
                    "lpfh": "I2",
                    "poas": "IB.3",
                    "keyskill": "IB.3",
                    "studyresults": "能注意聲音的來源，對聲音作出反應",
                    "performance": "有意識地留意及回應聲音 (1)",
                    "unit": "1.1 我的學校 <br/>2.2 交通工具",
                    "remarkstip1": "hide",
                    "remarkstip2": "hide",
                    "remarks": "非華語",
                }
            ];



            var columnDefs = [{

                    name: 'first',
                    data: "subjct",
                    title: "科目",
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

                    render: function(data, type, row) {
                        var result = row.studyresults + ' <span class="aqua-tooltip text-aqua ' + row.remarkstip1 + '" data-toggle="tooltip" title="非華語"><i class="fa fa-stop"></i></span> <span class="green-tooltip text-green ' + row.remarkstip2 + '" data-toggle="tooltip" title="新生入學評估"><i class="fa fa-stop"></i></span>';
                        return result;
                    },
                    name: 'first',
                    data: "studyresults",
                    title: "預期學習成果",
                    class: ""
                },
                {

                    name: 'first',
                    data: "unit",
                    title: "單元",
                    class: "w-90px",

                },
                {
                    data: "performance",
                    title: "關鍵表現項目",
                    class: ""
                },
                {
                    name: 'first',
                    data: "remarks",
                    title: "備註",
                    class: ""
                }
            ];
            $('#dataTable').DataTable({
                data: data,
                columns: columnDefs,


                rowsGroup: [
                    'first:name',
                ],
                scrollX: true,
                scrollCollapse: true,
                drawCallback: function(settings) {
                    $('[data-toggle="tooltip"]').tooltip();

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