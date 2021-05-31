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

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>課程： </label>
                                            <div style="flex: 1"><?php form_list_type('course_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>'',  'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>範疇：
                                            </label>
                                            <div style="flex: 1"><?php form_list_type('categories_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>'',  'enable_value' => $categories_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>課程編號： <span class="text-red small">*課程編號不能重覆, 警告提示及不能儲存</span></label>
                                            <input type="text" class="form-control" placeholder="請輸入...">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>中央課程學習重點： </label>
                                            <div style="flex: 1"><?php form_list_type('central_obj_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>'',  'enable_value' => $central_obj_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>校本課程學習重點：
                                            </label>
                                            <div style="flex: 1"><?php form_list_type('sb_obj_id', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>'',  'enable_value' => $sb_obj_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>相關課程編號： <a class="link small" href="#" data-toggle="modal" data-target="#classNumber">搜尋編號</a></label>
                                            <input type="text" class="form-control inputCourseNumber" placeholder="e.g.: #SC557, #BD003" Disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-4 bold"> <span class="text-red">*</span>學習元素：</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="study" value="知識" id="knowledge">
                                            <label class="form-check-label" for="knowledge">知識</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="study" value="技能" id="skill">
                                            <label class="form-check-label" for="skill">技能</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="study" value="態度" id="attitude">
                                            <label class="form-check-label" for="attitude">態度</label>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-4 bold"> <span class="text-red">*</span>組別：</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="初組" id="lowLevel">
                                            <label class="form-check-label" for="lowLevel">初組</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="中組" id="middleLevel">
                                            <label class="form-check-label" for="middleLevel">中組</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="高組" id="heightLevel">
                                            <label class="form-check-label" for="heightLevel">高組</label>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">相關項目編號： </label>
                                            <input type="text" class="form-control" placeholder="自訂輸入">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>LPF(基礎) <small>(2 層分類, 單項選擇)</small></label>
                                            <select class="form-control">
                                                <option value="" hidden>請選擇</option>
                                                <option value="I2">I2</option>
                                                <option value="I3">I3</option>
                                                <option value="I4">I4</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>LPF(基礎) <small>(2 層分類, 單項選擇)</small></label>
                                            <select class="form-control">
                                                <option value="" hidden>請選擇</option>
                                                <option value="I2">I2</option>
                                                <option value="I3">I3</option>
                                                <option value="I4">I4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>POAS： <small>(2 層分類, 單項選擇)</small></label>
                                            <select class="form-control">
                                                <option value="" hidden>請選擇</option>
                                                <option value="IC.3">IC.3</option>
                                                <option value="IC.3">IC.3</option>
                                                <option value="IC.3">IC.3</option>
                                                <option value="IC.3">IC.3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex">
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">Key Skills <small>(2 層分類,可多項選擇)</small> </label>
                                            <select class="form-control">
                                                <option value="" hidden>請選擇</option>
                                                <option value="IC.3">IC.3</option>
                                                <option value="IC.3">IC.3</option>
                                                <option value="IC.3">IC.3</option>
                                                <option value="IC.3">IC.3</option>
                                            </select>
                                        </div>
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input" type="checkbox" value="前備技能" id="frontSkill">
                                            <label class="form-check-label text-nowrap" for="frontSkill">前備技能</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="bold"><span class="text-red">*</span>預期學習成果：</label>
                                            <textarea class="form-control" rows="3" placeholder=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn bg-orange mw-100 mb-4 mr-4" onclick="location.href='<?= (admin_url($page_setting['controller'])) . '/preview'?>';">確 定</button>

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



    <div class="modal fade in" tabindex="-1" role="dialog" id="classNumber">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><b>搜尋課程編號</b> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></h3>

                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-3">
                            <div class="form-group">

                                <select class="form-control">
                                    <option value="" hidden>選擇課程</option>
                                    <option value="語文">語文</option>
                                    <option value="音">音</option>
                                    <option value="科技">科技</option>
                                    <option value="STEM">STEM</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">

                                <select class="form-control">
                                    <option value="" hidden>選擇範疇</option>
                                    <option value="語文">語文</option>
                                    <option value="音">音</option>
                                    <option value="科技">科技</option>
                                    <option value="STEM">STEM</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">

                                <select class="form-control">
                                    <option value="" hidden>校本課程學習重點</option>
                                    <option value="語文">語文</option>
                                    <option value="音">音</option>
                                    <option value="科技">科技</option>
                                    <option value="STEM">STEM</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-success  mb-4">搜 尋</button>
                        </div>
                    </div>
                    <div class="">
                        <table class="table table-bordered table-striped width100p" id="searchCourseNumberTable">
                            <thead>
                                <tr class="bg-light-blue color-palette">
                                    <th class="no-sort"></th>
                                    <th class="nowrap">課程</th>
                                    <th class="nowrap">範疇</th>
                                    <th class="nowrap">中央課程學習重點</th>
                                    <th class="nowrap">校本課程學習重點</th>
                                    <th class="nowrap">學習元素</th>
                                    <th class="nowrap">組別</th>
                                    <th class="nowrap">LPF(基礎)</th>
                                    <th class="nowrap">LPF(高中)</th>
                                    <th class="nowrap">POAS</th>
                                    <th class="nowrap">Key Skill</th>
                                    <th class="nowrap">預期學習成果</th>
                                    <th class="nowrap">課程編號</th>
                                    <th class="nowrap">相關課程編號</th>
                                    <th class="nowrap">相關項目編號</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="searchCourseNumberCheck" class="searchCourseNumberCheck" /></td>
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

                                    <td>能注意聲音的來源，對聲音作出反應</td>
                                    <td class="courseNum">MN0155</td>
                                    <td>MN0449,MS0002</td>

                                    <td></td>
                                </tr>
                                <tr>

                                    <td><input type="checkbox" name="searchCourseNumberCheck" class="searchCourseNumberCheck" /></td>
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
                                    <td>能注意聲音的來源，對聲音作出反應</td>
                                    <td class="courseNum">MN0157</td>
                                    <td>MN0449,MS0002</td>

                                    <td></td>
                                </tr>
                                <tr>

                                    <td><input type="checkbox" name="searchCourseNumberCheck" class="searchCourseNumberCheck" /></td>
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

                                    <td>能注意聲音的來源，對聲音作出反應</td>
                                    <td class="courseNum">MN0156</td>
                                    <td>MN0449,MS0002</td>

                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary comfirmSelectCourseNumber">選擇課程編號</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $('#searchCourseNumberTable').DataTable({
                scrollX: true,
                scrollCollapse: true,
                bFilter: false,
                bInfo: true,
                bLengthChange: false,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                    width: 100
                }]

            });




            $(".comfirmSelectCourseNumber").click(function() {
                var courseNumberCount = new Array();
                $("input[name='searchCourseNumberCheck']:checked").each(function() {
                    courseNumberCount.push($(this).closest("tr").find(".courseNum").text());
                });

                $('.inputCourseNumber').val(courseNumberCount);
                $('#classNumber').modal('hide');
            });






            /*



                        $('.searchCourseNumberCheck').change(function() {
                            var values = [];
                                $('.searchCourseNumberCheck:checked').each(function() {
                                //if(values.indexOf($(this).val()) === -1){
                                 values=$(this).closest("tr").find(".courseNum").text();
                               
                                //  $('.inputCourseNumber').attr("value", values)
                                // }
                                });
                                console.log(values);
                        });
            */










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