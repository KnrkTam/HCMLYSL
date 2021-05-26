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
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">年度： </label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="2019/2020">2019/2020</option>
                                                <option value="2021/2022">2021/2022</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">學生姓名： </label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="陳大文">陳大文</option>
                                                <option value="李兼一">李兼一</option>
                                                <option value="王小虎">王小虎</option>
                                                <option value="陳美麗">陳美麗</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>
                                </div>


                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='../webadmin/Bk_awards/create';">新 增</button>


                                <div class="tableWrap hidenWrap">
                                    <table class="table table-bordered table-striped w-100" id="settingTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">

                                                <th class="nowrap">年度</th>
                                                <th class="nowrap">學生姓名</th>
                                                <th class="nowrap">活動內容</th>
                                                <th class="nowrap">詳細資料</th>


                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>2019/2020</td>
                                                <td>陳大文</td>
                                                <td>
                                                    <p>2021-03-10 屈臣氏集團香港學生運動員獎
                                                    </p>
                                                    <p>2021-02-03 明日之星上游獎學金
                                                    </p>
                                                    <p>2000-01-01 xxxxx
                                                    </p>

                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_awards/edit">詳細內容</span></a>
                                                </td>


                                            </tr>
                                            <tr>

                                                <td>2019/2020</td>
                                                <td>陳大文</td>
                                                <td>
                                                    <p>2021-03-10 屈臣氏集團香港學生運動員獎
                                                    </p>
                                                    <p>2021-02-03 明日之星上游獎學金
                                                    </p>
                                                    <p>2000-01-01 xxxxx
                                                    </p>

                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_awards/edit">詳細內容</span></a>
                                                </td>

                                            </tr>
                                            <tr>

                                                <td>2019/2020</td>
                                                <td>陳大文</td>
                                                <td>
                                                    <p>2021-03-10 屈臣氏集團香港學生運動員獎
                                                    </p>
                                                    <p>2021-02-03 明日之星上游獎學金
                                                    </p>
                                                    <p>2000-01-01 xxxxx
                                                    </p>

                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_awards/edit">詳細內容</span></a>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>2019/2020</td>
                                                <td>陳大文</td>
                                                <td>
                                                    <p>2021-03-10 屈臣氏集團香港學生運動員獎
                                                    </p>
                                                    <p>2021-02-03 明日之星上游獎學金
                                                    </p>
                                                    <p>2000-01-01 xxxxx
                                                    </p>

                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_awards/edit">詳細內容</span></a>
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

        <!-- Modal -->
        <div class="modal fade in" tabindex="-1" role="dialog" id="view">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">查閱<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">

                        <p class="d-flex"><span class="bold" style="width:100px">年度：</span><span>2019/2020</span></p>
                        <p class="d-flex"><span class="bold" style="width:100px">學生名稱：</span><span>學生A</span></p>
                        <hr>
                        <h4 class="bold">行為表現</h4>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">禮貌:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="courtesy" id="courtesyBest" value="優異">
                                    <label class="form-check-label" for="courtesyBest">優異</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="courtesy" id="courtesyNoral" value="良好">
                                    <label class="form-check-label" for="courtesyNoral">良好</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="courtesy" id="courtesyOK" value="尚可">
                                    <label class="form-check-label" for="courtesyOK">尚可</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="courtesy" id="courtesyBad" value="欠佳">
                                    <label class="form-check-label" for="courtesyBad">欠佳</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">整潔:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="clean" id="cleanBest" value="優異">
                                    <label class="form-check-label" for="cleanBest">優異</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="clean" id="cleanNoral" value="良好">
                                    <label class="form-check-label" for="cleanNoral">良好</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="clean" id="cleanOK" value="尚可">
                                    <label class="form-check-label" for="cleanOK">尚可</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="clean" id="cleanBad" value="欠佳">
                                    <label class="form-check-label" for="cleanBad">欠佳</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">紀律:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discipline" id="disciplineBest" value="優異">
                                    <label class="form-check-label" for="disciplineBest">優異</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discipline" id="disciplineNoral" value="良好">
                                    <label class="form-check-label" for="disciplineNoral">良好</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discipline" id="disciplineOK" value="尚可">
                                    <label class="form-check-label" for="disciplineOK">尚可</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discipline" id="disciplineBad" value="欠佳">
                                    <label class="form-check-label" for="disciplineBad">欠佳</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">勤學:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diligent" id="diligentBest" value="優異">
                                    <label class="form-check-label" for="diligentBest">優異</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diligent" id="diligentNoral" value="良好">
                                    <label class="form-check-label" for="diligentNoral">良好</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diligent" id="diligentOK" value="尚可">
                                    <label class="form-check-label" for="diligentOK">尚可</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diligent" id="diligentBad" value="欠佳">
                                    <label class="form-check-label" for="diligentBad">欠佳</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">服務:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service" id="serviceBest" value="優異">
                                    <label class="form-check-label" for="serviceBest">優異</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service" id="serviceNoral" value="良好">
                                    <label class="form-check-label" for="serviceNoral">良好</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service" id="serviceOK" value="尚可">
                                    <label class="form-check-label" for="serviceOK">尚可</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service" id="serviceBad" value="欠佳">
                                    <label class="form-check-label" for="serviceBad">欠佳</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">與人相處:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="getalong" id="getalongBest" value="優異">
                                    <label class="form-check-label" for="getalongBest">優異</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="getalong" id="getalongNoral" value="良好">
                                    <label class="form-check-label" for="getalongNoral">良好</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="getalong" id="getalongOK" value="尚可">
                                    <label class="form-check-label" for="getalongOK">尚可</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="getalong" id="getalongBad" value="欠佳">
                                    <label class="form-check-label" for="getalongBad">欠佳</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">愛護公物:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="care" id="careBest" value="優異">
                                    <label class="form-check-label" for="careBest">優異</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="care" id="careNoral" value="良好">
                                    <label class="form-check-label" for="careNoral">良好</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="care" id="careOK" value="尚可">
                                    <label class="form-check-label" for="careOK">尚可</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="care" id="careBad" value="欠佳">
                                    <label class="form-check-label" for="careBad">欠佳</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-purple">儲 存</button>
                        <button type="button" class="btn btn-primary">鎖 定</button>
                    </div>
                </div>
            </div>
        </div>




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