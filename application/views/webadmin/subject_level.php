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
                                        <div class="form-group">
                                            <label class="text-nowrap">????????? </label>
                                            <select class="form-control">
                                                <option hidden>?????????...</option>
                                                <option value="2019/2020">2019/2020</option>
                                                <option value="2021/2022">2021/2022</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">????????? </label>
                                            <select class="form-control">
                                                <option hidden>?????????...</option>
                                                <option value="?????????1234">?????????1234</option>
                                                <option value="?????????1234">?????????1234</option>
                                                <option value="?????????1234">?????????1234</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">????????? </label>
                                            <select class="form-control">
                                                <option hidden>?????????...</option>
                                                <option value="?????????">?????????</option>
                                                <option value="?????????">?????????</option>
                                                <option value="?????????">?????????</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">????????? </label>
                                            <select class="form-control">
                                                <option hidden>?????????...</option>
                                                <option value="???">???</option>
                                                <option value="???">???</option>
                                                <option value="???">???</option>
                                                <option value="???">???</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">??? ???</button>
                                    </div>
                                </div>


                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='../webadmin/Bk_subject_level/create';">??? ???</button>


                                <div class="tableWrap hidenWrap">
                                    <table class="table table-bordered table-striped w-100" id="settingTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">

                                                <th class="nowrap">??????</th>
                                                <th class="nowrap">??????</th>
                                                <th class="nowrap">??????</th>
                                                <th class="nowrap">????????????</th>
                                                <th class="nowrap">????????????????????????</th>
                                                <th class="nowrap">?????????????????????</th>
                                                <th class="no-sort"></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>2019/2020</td>
                                                <td>?????????1234</td>
                                                <td>
                                                    ???
                                                </td>
                                                <td>
                                                    xxx, xxx, xxxx
                                                </td>
                                                <td>
                                                    L1
                                                </td>
                                                <td>
                                                    L2
                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_subject_level/edit">??????</span></a>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>2019/2020</td>
                                                <td>?????????1234</td>
                                                <td>
                                                    ???
                                                </td>
                                                <td>
                                                    xxx, xxx, xxxx
                                                </td>
                                                <td>
                                                    L1
                                                </td>
                                                <td>
                                                    L2
                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_subject_level/edit">??????</span></a>
                                                </td>

                                            </tr>
                                            <tr>

                                                <td>2019/2020</td>
                                                <td>?????????1234</td>
                                                <td>
                                                    ???
                                                </td>
                                                <td>
                                                    xxx, xxx, xxxx
                                                </td>
                                                <td>
                                                    L1
                                                </td>
                                                <td>
                                                    L2
                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_subject_level/edit">??????</span></a>
                                                </td>


                                            </tr>

                                            <tr>
                                                <td>2019/2020</td>
                                                <td>?????????1234</td>
                                                <td>
                                                    ???
                                                </td>
                                                <td>
                                                    xxx, xxx, xxxx
                                                </td>
                                                <td>
                                                    L1
                                                </td>
                                                <td>
                                                    L2
                                                </td>
                                                <td>
                                                    <a class="link" href="../webadmin/Bk_subject_level/edit">??????</span></a>
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
                        <h3 class="modal-title bold">??????<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">

                        <p class="d-flex"><span class="bold" style="width:100px">?????????</span><span>2019/2020</span></p>
                        <p class="d-flex"><span class="bold" style="width:100px">???????????????</span><span>??????A</span></p>
                        <hr>
                        <h4 class="bold">????????????</h4>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">??????:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="courtesy" id="courtesyBest" value="??????">
                                    <label class="form-check-label" for="courtesyBest">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="courtesy" id="courtesyNoral" value="??????">
                                    <label class="form-check-label" for="courtesyNoral">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="courtesy" id="courtesyOK" value="??????">
                                    <label class="form-check-label" for="courtesyOK">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="courtesy" id="courtesyBad" value="??????">
                                    <label class="form-check-label" for="courtesyBad">??????</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">??????:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="clean" id="cleanBest" value="??????">
                                    <label class="form-check-label" for="cleanBest">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="clean" id="cleanNoral" value="??????">
                                    <label class="form-check-label" for="cleanNoral">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="clean" id="cleanOK" value="??????">
                                    <label class="form-check-label" for="cleanOK">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="clean" id="cleanBad" value="??????">
                                    <label class="form-check-label" for="cleanBad">??????</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">??????:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discipline" id="disciplineBest" value="??????">
                                    <label class="form-check-label" for="disciplineBest">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discipline" id="disciplineNoral" value="??????">
                                    <label class="form-check-label" for="disciplineNoral">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discipline" id="disciplineOK" value="??????">
                                    <label class="form-check-label" for="disciplineOK">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discipline" id="disciplineBad" value="??????">
                                    <label class="form-check-label" for="disciplineBad">??????</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">??????:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diligent" id="diligentBest" value="??????">
                                    <label class="form-check-label" for="diligentBest">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diligent" id="diligentNoral" value="??????">
                                    <label class="form-check-label" for="diligentNoral">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diligent" id="diligentOK" value="??????">
                                    <label class="form-check-label" for="diligentOK">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diligent" id="diligentBad" value="??????">
                                    <label class="form-check-label" for="diligentBad">??????</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">??????:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service" id="serviceBest" value="??????">
                                    <label class="form-check-label" for="serviceBest">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service" id="serviceNoral" value="??????">
                                    <label class="form-check-label" for="serviceNoral">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service" id="serviceOK" value="??????">
                                    <label class="form-check-label" for="serviceOK">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="service" id="serviceBad" value="??????">
                                    <label class="form-check-label" for="serviceBad">??????</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">????????????:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="getalong" id="getalongBest" value="??????">
                                    <label class="form-check-label" for="getalongBest">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="getalong" id="getalongNoral" value="??????">
                                    <label class="form-check-label" for="getalongNoral">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="getalong" id="getalongOK" value="??????">
                                    <label class="form-check-label" for="getalongOK">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="getalong" id="getalongBad" value="??????">
                                    <label class="form-check-label" for="getalongBad">??????</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="bold">????????????:</p>
                            </div>
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="care" id="careBest" value="??????">
                                    <label class="form-check-label" for="careBest">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="care" id="careNoral" value="??????">
                                    <label class="form-check-label" for="careNoral">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="care" id="careOK" value="??????">
                                    <label class="form-check-label" for="careOK">??????</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="care" id="careBad" value="??????">
                                    <label class="form-check-label" for="careBad">??????</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-purple">??? ???</button>
                        <button type="button" class="btn btn-primary">??? ???</button>
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