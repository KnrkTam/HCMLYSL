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
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="19/20">2019/2020</option>
                                                <option value="20/21">2021/2022</option>


                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group ">
                                            <label class="text-nowrap">科目： </label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="語文科1234">語文科1234</option>
                                                <option value="語文科1234">語文科1234</option>


                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>

                                </div>


                                <div class="tableWrap hidenWrap">
                                    <table class="table table-bordered table-striped w-100" id="outlineTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">

                                                <th class="nowrap">年度</th>
                                                <th class="nowrap">科目</th>
                                                <th class="nowrap">施教組別名稱</th>
                                                <th class="nowrap">單元(一/二/三/四)
                                                </th>
                                                <th class="nowrap">年度學習單元</th>
                                                <th class="nowrap">年度教學大鋼</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>2019/2020</td>
                                                <td>語文科1234</td>
                                                <td>忠 1</td>
                                                <td>單元一</td>
                                                <td>1.1 認識自己
                                                </td>
                                                <td><a class="link" href="#" data-toggle="modal" data-target="#view">查閱</a></td>
                                            </tr>
                                            <tr>
                                                <td>2019/2020</td>
                                                <td>語文科1234</td>
                                                <td>忠 1</td>
                                                <td>單元一</td>
                                                <td>1.1 認識自己
                                                </td>
                                                <td><a class="link" href="#" data-toggle="modal" data-target="#view">查閱</a></td>
                                            </tr>
                                            <tr>
                                                <td>2019/2020</td>
                                                <td>語文科1234</td>
                                                <td>忠 1</td>
                                                <td>單元三</td>
                                                <td>不適用
                                                </td>
                                                <td><a class="link" href="../webadmin/Bk_teach_outline/create">新增</a></td>

                                            </tr>

                                            <tr>

                                                <td>2019/2020</td>
                                                <td>語文科1234</td>
                                                <td>忠 1</td>
                                                <td>單元一</td>
                                                <td>1.2 我的學校
                                                </td>
                                                <td><a class="link" href="../webadmin/Bk_teach_outline/create">新增</a></td>

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



        <div class="modal fade in" tabindex="-1" role="dialog" id="view">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">年度教學大鋼 查閱
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
                    "year": "19/20",
                    "degree": "學階一",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                },
                {
                    "id": "1",
                    "year": "19/20",
                    "degree": "學階一",
                    "date": "11/11/2019 - 7/2/2020",
                    "week": "11-23",
                    "evaluation01": "15/11/2019",
                    "evaluation02": "5/1/2020",
                }, {
                    "id": "1",
                    "year": "19/20",
                    "degree": "學階一",
                    "date": "10/2/2020 - 24/4/2020",
                    "week": "1-11",
                    "evaluation01": "1/3/2020",
                    "evaluation02": "1/4/2020",
                },
                {
                    "id": "1",
                    "year": "19/20",
                    "degree": "學階一",
                    "date": "27/4/2020 - 17/11/2020",
                    "week": "12-23",
                    "evaluation01": "1/5/2020",
                    "evaluation02": "1/7/2020",
                },
                {
                    "id": "2",
                    "year": "19/20",
                    "degree": "學階二",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                },
                {
                    "id": "2",
                    "year": "19/20",
                    "degree": "學階二",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                }, {
                    "id": "3",
                    "year": "19/20",
                    "degree": "學階二",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                }, {
                    "id": "3",
                    "year": "19/20",
                    "degree": "學階二",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                }, {
                    "id": "3",
                    "year": "19/20",
                    "degree": "學階二",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                }, {
                    "id": "4",
                    "year": "19/20",
                    "degree": "學階二",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                },
            ];



            var columnDefs = [{
                    render: function(data, type, row) {
                        // alert(row.id);
                        // data: null,
                        // title: "操作",
                        // defaultContent:
                        // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-lg">Delete</a>'
                        // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-lg">Edit Btn</a>'
                        var result = '<a class="editLinkBtn" href="../webadmin/Bk_study_unit/edit" data-id="' + row
                            .id + '"><i class="fa fa-edit"></i></a>';
                        return result;

                    },
                    data: "id",
                    name: 'zore',
                    title: "",
                    class: "no-sort"
                },
                {
                    name: 'first',
                    data: "year",
                    title: "年度",
                    class: ""
                },
                {
                    name: 'first',
                    data: "degree",
                    title: "學階",
                    class: "",
                },
                {

                    data: "date",
                    title: "日期",
                    class: ""
                },
                {

                    data: "week",
                    title: "週次",
                    class: ""
                },
                {

                    data: "evaluation01",
                    title: "評估日期1",
                    class: ""
                },
                {

                    data: "evaluation02",
                    title: "評估日期2",
                    class: ""
                }
            ];







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