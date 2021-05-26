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
                                            <label class="text-nowrap">課程 : </label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="語文">語文</option>
                                                <option value="音">音</option>
                                                <option value="科技">科技</option>
                                                <option value="STEM">STEM</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">範疇 : </label>
                                            <select class="form-control">
                                                <option hidden>請選擇...</option>
                                                <option value="聆聽">聆聽</option>
                                                <option value="聆聽">聆聽</option>
                                                <option value="聆聽">聆聽</option>
                                                <option value="聆聽">聆聽</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">


                                        <div class="form-group w-100">
                                            <label class="text-nowrap">校本課程學習重點 : (多項選擇) </label>
                                            <select class="form-control select2" multiple="" data-placeholder="請選擇...">
                                                <option value="聽力訓練">聽力訓練</option>
                                                <option value="理解語意:把握重心">理解語意:把握重心</option>
                                                <option value="聽力訓練">聽力訓練</option>
                                                <option value="理解語意:把握重心">理解語意:把握重心</option>
                                            </select>
                                        </div>
                                        <span class="ml-2 mr-2 mt-2">或</span>
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">課程編號 : (多項選擇) </label>
                                            <select class="form-control select2" multiple="" data-placeholder="請選擇...">

                                                <option value="MN0155">MN0155</option>
                                                <option value="MN0158">MN0158</option>
                                                <option value="MN0160">MN0160</option>
                                                <option value="MN0162">MN0162</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>

                                </div>




                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='../webadmin/Bk_course_outline/create';">新 增</button>


                                <div class="tableWrap hidenWrap">
                                    <table class="table table-bordered table-striped dataTable" id="courseOutlineTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">
                                                <th class="no-sort" style="min-width: 4px;"></th>
                                                <th class="nowrap">課程</th>
                                                <th class="nowrap">範疇</th>
                                                <th class="nowrap">中央課程學習重點</th>
                                                <th class="nowrap">校本課程學習重點</th>
                                                <th class="nowrap">學習元素</th>
                                                <th class="nowrap">組別</th>
                                                <th class="nowrap">LPF(基礎)</th>
                                                <th class="nowrap">LPF(高中) P</th>
                                                <th class="nowrap">POAS</th>
                                                <th class="nowrap">Key Skill</th>
                                                <th class="nowrap">前備技能</th>
                                                <th class="nowrap">預期學習成果</th>
                                                <th class="nowrap">課程編號</th>
                                                <th class="nowrap">預期學習成果</th>
                                                <th class="nowrap">相關項目編號</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td><a class="editLinkBtn" href="../webadmin/Bk_course_outline/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>語文</td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>聽力訓練</td>
                                                <td>技能</td>
                                                <td>初組、中組</td>
                                                <td>I2</td>
                                                <td>I2</td>
                                                <td class="nowrap">IB.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                                <td class="nowrap">IC.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                                <td><span class="text-green"><i class="fa fa-check"></i></span></td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td>MN0155</td>
                                                <td>MN0449,MS0002</td>

                                                <td></td>
                                            </tr>
                                            <tr>

                                                <td><a class="editLinkBtn" href="../webadmin/Bk_course_outline/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>語文</td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>聽力訓練</td>
                                                <td>技能</td>
                                                <td>初組、中組</td>
                                                <td>I2</td>
                                                <td>I2</td>
                                                <td class="nowrap">IB.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                                <td class="nowrap">IC.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                                <td><span class="text-red"><i class="fa fa-remove"></i></span></td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td>MN0155</td>
                                                <td>MN0449,MS0002</td>

                                                <td></td>
                                            </tr>
                                            <tr>

                                                <td><a class="editLinkBtn" href="../webadmin/Bk_course_outline/edit"><i class="fa fa-edit"></i></a></td>
                                                <td>語文</td>
                                                <td>聆聽</td>
                                                <td>聽力訓練</td>
                                                <td>聽力訓練</td>
                                                <td>技能</td>
                                                <td>初組、中組</td>
                                                <td>I2</td>
                                                <td>I2</td>
                                                <td class="nowrap">IB.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                                <td class="nowrap">IC.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                                <td><span class="text-red"><i class="fa fa-remove"></i></span></td>
                                                <td>能注意聲音的來源，對聲音作出反應</td>
                                                <td>MN0155</td>
                                                <td>MN0449,MS0002</td>

                                                <td></td>
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

    </div>
    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>



    <script>
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip();
            $('#courseOutlineTable').DataTable({

                scrollX: true,
                scrollCollapse: true,
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