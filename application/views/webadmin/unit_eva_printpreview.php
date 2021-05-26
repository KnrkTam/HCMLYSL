<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("head.php"); ?>
</head>

<body>
    <div class="wrapper">



        <page size="A4">
            <h1>單元評估表</h1>
            <div class="row mb-4">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="text-nowrap">年度： </label>
                        <P>2019/2020</p>

                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="text-nowrap">年度： </label>
                        <p>陳大文</p>

                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="form-group ">
                        <label class="text-nowrap">班別： </label>
                        <p>忠</p>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="text-nowrap">單元名稱： </label>
                        <P>1.1 認識自己</p>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="text-nowrap">日期： </label>
                        <p>11/11/2019 至 21/1/2020</p>

                    </div>
                </div>

            </div>
            <h4 class="bold">科目：語文科1234</h4>
            <table class="table table-bordered table-striped w-100">
                <thead>
                    <tr>

                        <th class="nowrap">範疇</th>
                        <th class="nowrap">校本課程學習重點</th>
                        <th class="nowrap">預期學習成果</th>
                        <th class="nowrap">平均分數</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>



                        <td>聆聽</td>
                        <td>聽力訓練</td>
                        <td>
                            <p>能注意聲音的來源，對聲音作出反應</p>
                            <input type="text" class="form-control" value="（梳、揀、派）">
                        </td>
                        <td>
                            1
                        </td>

                    </tr>
                    <tr>



                        <td>聆聽</td>
                        <td>聽力訓練</td>
                        <td>
                            <p>能對名稱有反應</p>

                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>


                        <td>聆聽</td>
                        <td>聽力訓練</td>
                        <td>
                            <p>把握詞語的重心</p>

                        </td>
                        <td>
                            4
                        </td>
                    </tr>



                </tbody>
            </table>
            <h4 class="bold">科目：通識教育科</h4>
            <table class="table table-bordered table-striped w-100">
                <thead>
                    <tr>

                        <th class="nowrap">範疇</th>
                        <th class="nowrap">校本課程學習重點</th>
                        <th class="nowrap">預期學習成果</th>
                        <th class="nowrap">平均分數</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>



                        <td>聆聽</td>
                        <td>聽力訓練</td>
                        <td>
                            <p>能注意聲音的來源，對聲音作出反應</p>
                            <input type="text" class="form-control" value="（梳、揀、派）">
                        </td>
                        <td>
                            1
                        </td>

                    </tr>
                    <tr>



                        <td>聆聽</td>
                        <td>聽力訓練</td>
                        <td>
                            <p>能對名稱有反應</p>

                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                    <tr>


                        <td>聆聽</td>
                        <td>聽力訓練</td>
                        <td>
                            <p>把握詞語的重心</p>

                        </td>
                        <td>
                            4
                        </td>
                    </tr>



                </tbody>
            </table>
            <p class="mt-4">備註：</p>
            <p>《4》代表完全(總是)掌握......
            </p>
            <p>《3》代表
            </p>
            <p>《2》代表
            </p>
            <p>《1》代表
            </p>
            <p>《0》代表
            </p>
            <hr>
        </page>
        <!-- Content Wrapper. Contains page content -->



        <!-- /.content-wrapper -->




    </div>
    <!-- ./wrapper -->

    <script>
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