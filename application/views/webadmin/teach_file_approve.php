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
                                <div class="d-flex mt-2">
                                    <p class="mb-0 bold">審批狀態：</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">確定</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
                                        <label class="form-check-label" for="inlineRadio2">拒絕</label>
                                    </div>
                                </div>
                                <hr>

                                <div class="row mb-4">
                                    <div class="col-lg-2">
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
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">施教組別名稱： </label>
                                            <P>忠班,信班</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">

                                        <div class="form-group w-100">
                                            <label class="text-nowrap">狀態： </label>
                                            <p class="text-orange">未提交</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元名稱： </label>
                                            <p class="mt-2">1.1 認識自己
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元日期： </label>
                                            <p class="mt-2">2/9/2019 至 8/11/2019
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">節數： </label>
                                            <p>11</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">主教老師： </label>
                                            <p class="mt-2">陳老師, XXX</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">首次提交日期： </label>
                                            <p class="mt-2">YYYY-MM-DD</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">編寫教師：</label>
                                            <p>XXX, xxx</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">課題： </label>
                                            <p>家居清潔及美化家居</p>

                                        </div>
                                    </div>
                                </div>



                                <div class="tableWrapOver">
                                    <table class="table table-bordered table-striped width100p teachTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">
                                                <th class="nowrap">次序項目#</th>

                                                <th class="nowrap ">範疇</th>
                                                <th class="nowrap ">校本課程學習重點</th>
                                                <th class="nowrap ">學習元素</th>

                                                <th class="nowrap ">組別</th>
                                                <th class="nowrap ">預期學習成果</th>
                                                <th class="nowrap ">補充內容</th>
                                                <th class="nowrap ">關鍵表現項目</th>
                                                <th class="nowrap ">評估模式</th>
                                                <th class="nowrap ">全選學生</th>
                                                <th class="accept ">
                                                    <span>學生B</span>
                                                    <br />
                                                    能力程度<br />
                                                    <span>H</span>

                                                </th>
                                                <th class="accept">
                                                    <span>學生B</span>

                                                    <br />
                                                    能力程度<br />
                                                    <span>H</span>

                                                </th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>技能</td>
                                                <td>初組</td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td>去、坐</td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td>
                                                    A

                                                </td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" checked disabled /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" checked disabled /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" checked disabled /></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>技能</td>
                                                <td>初組</td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td>去、坐</td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td> A</td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" checked disabled /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" disabled /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" checked disabled /></td>
                                            </tr>
                                            <tr>

                                                <td>1</td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>技能</td>
                                                <td>初組</td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td>去、坐</td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td> A</td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" disabled /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" disabled /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" disabled /></td>
                                            </tr>

                                        </tbody>


                                    </table>
                                </div>

                                <hr>
                                <div class="mt-4 d-flex justify-content-end">

                                    <button type="button" class="btn bg-maroon mw-100 mb-4 mr-4" onclick="location.href='../Bk_teach_file';">提 交</button>
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




            $('.teachTable').DataTable({
                scrollCollapse: true,


            });

            $('.eventTable').DataTable({
                scrollY: "400px",

                scrollX: true,
                sScrollXInner: "100%",
                scrollCollapse: true,


            });
            $('.teachTable').dragtable({
                dragaccept: '.accept'
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