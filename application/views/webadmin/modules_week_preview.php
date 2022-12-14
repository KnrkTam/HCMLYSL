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
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">????????? </label>
                                            <p><?= $annual?></p>

                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="text-nowrap">????????? </label>
                                            <p><?= $level ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-flex list-row-header mb-2">
                                    <div class="col-4 bold">
                                        ?????????
                                    </div>
                                    <div class="col-2 bold">
                                        ?????????
                                    </div>
                                    <div class="col-3 bold">
                                        ???????????? 1???
                                    </div>
                                    <div class="col-3 bold">
                                        ???????????? 2???
                                    </div>
                                </div>
                                <?php foreach ($modules_list as $i => $row) {?>
                                <div class="row mb-2">
                                    <div class="col-md-4 bold">
                                        <div class="form-group">
                                            <div class="d-flex flex-lg-row flex-column ">
                                                <label class="text-nowrap mr-2 mb-0 bold w-100"><?=$row ?> </label>
                                                <div class="d-flex align-items-center w-100">
                                                    <div class="input-group date">
                                                        <p class="mb-0"><?= $moduleFrom[$i] ?></p>
                                                    </div>

                                                    <span class="ml-2 mr-2">???</span>
                                                    <div class="input-group date">
                                                        <p class="mb-0"><?= $moduleTo[$i] ?></p>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 bold">
                                        <div class="form-group">
                                            <div class="d-flex flex-md-row flex-column ">

                                                <div class="d-flex align-items-center w-100 ">
                                                    <p class="mb-0 mobileShow bold">?????????</p>
                                                    <p class="mb-0"><?= $weekNumFrom[$i] ?></p>
                                                    <span class="ml-2 mr-2">???</span>
                                                    <p class="mb-0"><?= $weekNumTo[$i] ?></p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3 bold">
                                        <div class="input-group date mb-3 d-flex">
                                            <p class="mb-0 mobileShow bold">???????????? 1???</p>
                                            <p class="mb-0"><?= $assessment1[$i]?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 bold">
                                        <div class="input-group date mb-3  d-flex">
                                            <p class="mb-0 mobileShow bold">???????????? 2???</p>
                                            <p class="mb-0"><?= $assessment2[$i]?></p>
                                        </div>
                                    </div>
                                </div>
                                <? } ?>
                                
                                <!-- <div class="row mb-2">
                                    <div class="col-md-4 bold">
                                        <div class="form-group">
                                            <div class="d-flex flex-md-row flex-column ">
                                                <label class="text-nowrap mr-2 mb-0 bold w-100">????????? </label>
                                                <div class="d-flex align-items-center w-100">
                                                    <div class="input-group date">
                                                        <p class="mb-0"><?= $moduleFrom[2] ?></p>
                                                    </div>

                                                    <span class="ml-2 mr-2">???</span>
                                                    <div class="input-group date">
                                                        <p class="mb-0">8/11/2019</p>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 bold">
                                        <div class="form-group">
                                            <div class="d-flex flex-md-row flex-column ">

                                                <div class="d-flex align-items-center w-100 ">
                                                    <p class="mb-0 mobileShow bold">?????????</p>
                                                    <p class="mb-0">1</p>
                                                    <span class="ml-2 mr-2">???</span>
                                                    <p class="mb-0">10</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3 bold">
                                        <div class="input-group date mb-3 d-flex">
                                            <p class="mb-0 mobileShow bold">???????????? 1???</p>
                                            <p class="mb-0">8/11/2019</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 bold">
                                        <div class="input-group date mb-3  d-flex">
                                            <p class="mb-0 mobileShow bold">???????????? 2???</p>
                                            <p class="mb-0">8/11/2019</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 bold">
                                        <div class="form-group">
                                            <div class="d-flex flex-md-row flex-column ">
                                                <label class="text-nowrap mr-2 mb-0 bold w-100">????????? </label>
                                                <div class="d-flex align-items-center w-100">
                                                    <div class="input-group date">
                                                        <p class="mb-0"><?= $moduleFrom[3] ?></p>
                                                    </div>

                                                    <span class="ml-2 mr-2">???</span>
                                                    <div class="input-group date">
                                                        <p class="mb-0">8/11/2019</p>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 bold">
                                        <div class="form-group">
                                            <div class="d-flex flex-md-row flex-column ">

                                                <div class="d-flex align-items-center w-100 ">
                                                    <p class="mb-0 mobileShow bold">?????????</p>
                                                    <p class="mb-0">1</p>
                                                    <span class="ml-2 mr-2">???</span>
                                                    <p class="mb-0">10</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3 bold">
                                        <div class="input-group date mb-3 d-flex">
                                            <p class="mb-0 mobileShow bold">???????????? 1???</p>
                                            <p class="mb-0">8/11/2019</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 bold">
                                        <div class="input-group date mb-3  d-flex">
                                            <p class="mb-0 mobileShow bold">???????????? 2???</p>
                                            <p class="mb-0">8/11/2019</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 bold">
                                        <div class="form-group">
                                            <div class="d-flex flex-md-row flex-column ">
                                                <label class="text-nowrap mr-2 mb-0 bold w-100">????????? </label>
                                                <div class="d-flex align-items-center w-100">
                                                    <div class="input-group date">
                                                        <p class="mb-0"><?= $moduleFrom[4] ?></p>
                                                    </div>

                                                    <span class="ml-2 mr-2">???</span>
                                                    <div class="input-group date">
                                                        <p class="mb-0"><?= $moduleTo[4] ?></p>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 bold">
                                        <div class="form-group">
                                            <div class="d-flex flex-md-row flex-column ">

                                                <div class="d-flex align-items-center w-100 ">
                                                    <p class="mb-0 mobileShow bold">?????????</p>
                                                    <p class="mb-0">1</p>
                                                    <span class="ml-2 mr-2">???</span>
                                                    <p class="mb-0">10</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3 bold">
                                        <div class="input-group date mb-3 d-flex">
                                            <p class="mb-0 mobileShow bold">???????????? 1???</p>
                                            <p class="mb-0">8/11/2019</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 bold">
                                        <div class="input-group date mb-3  d-flex">
                                            <p class="mb-0 mobileShow bold">???????????? 2???</p>
                                            <p class="mb-0">8/11/2019</p>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="mt-4 d-flex justify-content-end">
                                <textarea name="post_data" class="hidden" ><?= json_encode($postData)?></textarea>

                                    <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4">??? ???</button>

                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']. '/'. $previous. '/'. $id) ?>';">??? ???</button>

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



            function loopWeek() {

                for (var i = 1; i < 23; i++) {
                    $('<option  value="' + i + '">').append(i).appendTo(".weekNum");
                }

            }
            loopWeek();
            $('.datepicker').datepicker({
                autoclose: true
            })

            var data = [{
                    "id": "1",
                    "year": "19/20",
                    "degree": "?????????",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                },
                {
                    "id": "1",
                    "year": "19/20",
                    "degree": "?????????",
                    "date": "11/11/2019 - 7/2/2020",
                    "week": "11-23",
                    "evaluation01": "15/11/2019",
                    "evaluation02": "5/1/2020",
                }, {
                    "id": "1",
                    "year": "19/20",
                    "degree": "?????????",
                    "date": "10/2/2020 - 24/4/2020",
                    "week": "1-11",
                    "evaluation01": "1/3/2020",
                    "evaluation02": "1/4/2020",
                },
                {
                    "id": "1",
                    "year": "19/20",
                    "degree": "?????????",
                    "date": "27/4/2020 - 17/11/2020",
                    "week": "12-23",
                    "evaluation01": "1/5/2020",
                    "evaluation02": "1/7/2020",
                },
                {
                    "id": "2",
                    "year": "19/20",
                    "degree": "?????????",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                },
                {
                    "id": "2",
                    "year": "19/20",
                    "degree": "?????????",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                }, {
                    "id": "3",
                    "year": "19/20",
                    "degree": "?????????",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                }, {
                    "id": "3",
                    "year": "19/20",
                    "degree": "?????????",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                }, {
                    "id": "3",
                    "year": "19/20",
                    "degree": "?????????",
                    "date": "2/9/2019 - 8/11/2019",
                    "week": "1-10",
                    "evaluation01": "9/10/2019",
                    "evaluation02": "9/11/2019",
                }, {
                    "id": "4",
                    "year": "19/20",
                    "degree": "?????????",
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
                        // title: "??????",
                        // defaultContent:
                        // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-md">Delete</a>'
                        // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-md">Edit Btn</a>'
                        var result = '<a class="editLinkBtn" href="../webadmin/Bk_subject_outline/edit" data-id="' + row
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
                    title: "??????",
                    class: ""
                },
                {
                    name: 'first',
                    data: "degree",
                    title: "??????",
                    class: "",
                },
                {

                    data: "date",
                    title: "??????",
                    class: ""
                },
                {

                    data: "week",
                    title: "??????",
                    class: ""
                },
                {

                    data: "evaluation01",
                    title: "????????????1",
                    class: ""
                },
                {

                    data: "evaluation02",
                    title: "????????????2",
                    class: ""
                }
            ];






            $(".searchBtn").click(function() {

                $(".tableWrap").fadeIn();
                $('#studyUnitTable').DataTable({
                    data: data,
                    columns: columnDefs,
                    rowsGroup: [
                        'zore:name',
                        'first:name',


                    ],
                    select: {
                        style: 'os',
                        selector: 'td:not(:first-child)'
                    },

                    scrollX: true,
                    scrollCollapse: true,
                    drawCallback: function(settings) {
                        $('[data-toggle="tooltip"]').tooltip();

                    }

                });

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