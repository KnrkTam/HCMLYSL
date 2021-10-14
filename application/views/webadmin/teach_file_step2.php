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
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">施教組別名稱： </label>
                                            <P>忠班,信班</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex">

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
                                            <label class="text-nowrap">節數： </label>
                                            <input type="text" class="form-control" value="">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">主教老師： </label>
                                            <p class="mt-2">陳老師, XXX</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">編寫教師：</label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="全部">全部</option>
                                                <option value="已提交">已提交</option>
                                                <option value="未提交">未提交</option>
                                                <option value="已審批">已審批</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="text-nowrap">課題： </label>
                                            <input type="text" class="form-control" value="家居清潔及美化家居">
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
                                                    <select class="form-control">
                                                        <option hidden>請選擇...</option>
                                                        <option value="學生B" selected>學生B</option>
                                                        <option value="學生B">學生B</option>
                                                        <option value="學生B">學生B</option>
                                                        <option value="學生B">學生B</option>
                                                    </select><br />
                                                    能力程度<br />
                                                    <select class="form-control">
                                                        <option hidden>請選擇...</option>
                                                        <option value="H">H</option>
                                                        <option value="HM">HM</option>
                                                        <option value="M">M</option>
                                                        <option value="ML">ML</option>
                                                        <option value="L">L</option>
                                                    </select>
                                                </th>
                                                <th class="accept"> <select class="form-control">
                                                        <option hidden>請選擇...</option>
                                                        <option value="學生B" selected>學生B</option>
                                                        <option value="學生B">學生B</option>
                                                        <option value="學生B">學生B</option>
                                                        <option value="學生B">學生B</option>
                                                    </select><br />
                                                    能力程度<br />
                                                    <select class="form-control">
                                                        <option hidden>請選擇...</option>
                                                        <option value="H">H</option>
                                                        <option value="HM">HM</option>
                                                        <option value="M">M</option>
                                                        <option value="ML">ML</option>
                                                        <option value="L">L</option>
                                                    </select>
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
                                                <td> <input type="text" class="form-control" value="去、坐"></td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td> <select class="form-control">
                                                        <option hidden>請選擇...</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>

                                                    </select></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" checked /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" checked /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" checked /></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>技能</td>
                                                <td>初組</td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td> <input type="text" class="form-control" value="去、坐"></td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td> <select class="form-control">
                                                        <option hidden>請選擇...</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>

                                                    </select></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" checked /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" checked /></td>
                                            </tr>
                                            <tr>

                                                <td>1</td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>技能</td>
                                                <td>初組</td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td> <input type="text" class="form-control" value="去、坐"></td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td> <select class="form-control">
                                                        <option hidden>請選擇...</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>

                                                    </select></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" /></td>
                                                <td class=""><input type="checkbox" class="searchCourseNumberCheck" /></td>
                                            </tr>

                                        </tbody>


                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mt-4">
                                            <label for="remark">備註：</label>
                                            <textarea class="form-control" id="remark" rows="3"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <p class="bold pt-4">學習活動 :</p>

                                        <table class="table table-bordered table-striped w-100 eventTable">
                                            <thead>
                                                <tr class="bg-light-blue color-palette">

                                                    <th class="nowrap">項目#</th>
                                                    <th class="nowrap">活動名稱</th>
                                                    <th class="nowrap">教材/教具</th>
                                                    <th class="nowrap">學習活動
                                                    </th>
                                                    <th class="nowrap">圖片</th>
                                                    <th class="nowrap">動作</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>1,2,4</td>
                                                    <td>xxxxxxxx</td>
                                                    <td>xxx, xxx, xxx</td>
                                                    <td>xxxxxx<br />xxxxxx<br />xxxxxx</td>

                                                    <td>xxx, xxx, xxx</td>
                                                    <td> <a class="link" href="../Bk_teach_file/editEvent">修改</a></td>
                                                </tr>
                                                <tr>
                                                    <td>1,2,4</td>
                                                    <td>xxxxxxxx</td>
                                                    <td>xxx, xxx, xxx</td>
                                                    <td>xxxxxx<br />xxxxxx<br />xxxxxx</td>

                                                    <td>xxx, xxx, xxx</td>
                                                    <td> <a class="link" href="../Bk_teach_file/editEvent">修改</a></td>
                                                </tr>
                                                <tr>
                                                    <td>1,2,4</td>
                                                    <td>xxxxxxxx</td>
                                                    <td>xxx, xxx, xxx</td>
                                                    <td>xxxxxx<br />xxxxxx<br />xxxxxx</td>

                                                    <td>xxx, xxx, xxx</td>
                                                    <td> <a class="link" href="../Bk_teach_file/editEvent">修改</a></td>

                                                </tr>

                                                <tr>

                                                    <td>1,2,4</td>
                                                    <td>xxxxxxxx</td>
                                                    <td>xxx, xxx, xxx</td>
                                                    <td>xxxxxx<br />xxxxxx<br />xxxxxx</td>

                                                    <td>xxx, xxx, xxx</td>
                                                    <td> <a class="link" href="../Bk_teach_file/editEvent">修改</a></td>

                                                </tr>

                                            </tbody>
                                        </table>

                                        <button type="button" class="btn btn-info mw-100 mb-4" onclick="location.href='../Bk_teach_file/create03';"><i class="fa fa-fw fa-plus"></i> 增加學習活動</button>


                                    </div>

                                </div>





                                <hr>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn bg-orange mw-100 mb-4 mr-4" onclick="location.href='../Bk_teach_file/preview';">下 一 步</button>

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


        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

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