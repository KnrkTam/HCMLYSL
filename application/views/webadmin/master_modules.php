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

                                <button type="button" class="btn mw-100 bg-orange mb-4" data-toggle="modal" data-target="#newDetail">新 增</button>



                                <table class="table table-bordered table-hover width100p">
                                    <thead>
                                        <tr class="bg-light-blue color-palette">
                                            <? foreach ($level_list as $row)  {?>
                                            <th><?= $row ?></th>
                                            <? } ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i> 1.1 我的學校</a></td>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 2.1 認識自己</td>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 3.1 我的家</td>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 4.1 可愛的小動物</td>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 5.1 我的學校</td>
                                        </tr>
                                        <tr>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 1.2 常用的電器</td>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 2.2 交通工具</td>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 3.2 常見的衣服</td>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 4.2 常吃的食物</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 1.4 幫助我們的人</td>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 2.3 我們的社區</td>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 3.3 喜愛的活動</td>
                                            <td><a class="editLinkBtn" href="#" data-toggle="modal" data-target="#editDetail"><i class="fa fa-edit"></i></a> 4.3 奇妙的天氣</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>

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



    <!-- Edit modal box -->
        <div class="modal fade in" tabindex="-1" role="dialog" id="editDetail">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">修改 單元名稱 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-nowrap">學階： </label>
                                    <div style="flex: 1"><?php form_list_type('level_id', ['type' => 'select', 'class'=> 'form-control' , 'value' =>'',  'enable_value' => $level_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1]) ?></div>
                                    <!-- <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="學階一" selected>學階一</option>
                                        <option value="學階二">學階二</option>
                                        <option value="學階三">學階三</option>
                                        <option value="學階四">學階四</option>
                                        <option value="所有學階">所有學階</option>
                                    </select> -->
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-nowrap">單元編號： </label>
                                    <input type="text" class="form-control" placeholder="1.1" name="module_code">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap">單元名稱： </label>
                                    <input type="text" class="form-control" placeholder="我的學校" name="module_name">
                                </div>
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
<!-- Edit modal box end -->

        <div class="modal fade in" tabindex="-1" role="dialog" id="newDetail">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">新增 單元名稱 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-nowrap">學階： </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="學階一">學階一</option>
                                        <option value="學階二">學階二</option>
                                        <option value="學階三">學階三</option>
                                        <option value="學階四">學階四</option>
                                        <option value="所有學階">所有學階</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-nowrap">單元編號： </label>
                                    <input type="text" class="form-control" placeholder="請輸入...">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap">單元名稱： </label>
                                    <input type="text" class="form-control" placeholder="請輸入...">
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-orange ">新 增</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>
    <script>
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