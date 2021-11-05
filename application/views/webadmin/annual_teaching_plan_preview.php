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
               
                        <div class="box box-primary">
                            <!-- /.box-header -->

                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <div class="d-flex mt-2">
                                    <p class="mb-0 bold">審批狀態：</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" disabled>
                                        <label class="form-check-label" for="inlineRadio1">己確定</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1" disabled>
                                        <label class="form-check-label" for="inlineRadio2">已提交</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option1" checked >
                                        <label class="form-check-label" for="inlineRadio2">未提交</label>
                                    </div>
                                </div>
                                <hr>

                                <div class="row mb-4">
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <p><?= $year?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">科目： </label>
                                            <p><?= $subject?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">施教組別名稱： </label>
                                            <p><?= $group_name?></p>

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
                                            <p><?= $annual_module?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元日期： </label>
                                            <p class="mt-2"><?= $date_from ?> 至 <?= $date_to ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">節數： </label>
                                            <p><?= $session?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">主教老師： </label>
                                            <p class="mt-2"><?= $staff ?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">首次提交日期： </label>
                                            <p><?= $today ?></p> 

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">編寫教師：</label>
                                            <p><?= $created_by?></p> 

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="text-nowrap">課題： </label>
                                            <p><?= $topic ?></p> 

                                        </div>
                                    </div>
                                </div>



                                <div class="tableWrapOver">
                                    <table class="table table-bordered table-striped width100p viewTable">
                                    </table>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                    <h4 class="bold pt-4">學習活動 :</h4>
                                    <table class="table table-bordered table-striped width100p" id="eventTable">
                                    </table> 
                                    <button type="button" id="add-btn" class="btn btn-warning mw-100 mb-4 mr-4">增 加</button>
                                    </div>
                                </div> 
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn bg-maroon mw-100 mb-4 mr-4">提 交</button>
                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="goBack()">返 回</button>
                                    <input class="hidden" name="asg_id" value=<?= $asg_id ?> />
                                    <input class="hidden" name="ato_id" value=<?= $id ?> />
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
        let goBack = function goBack() {
            window.history.back();
        }
        let year_id = <?= $year_id ?>;
        let asg_id = <?= $asg_id?>; 
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
     

        let eventCol = [
                {
                    data: 'event',
                    title: "項目#",
                    name:"first",
                },
                {
                    data: "name",
                    title: "活動名稱",
                    name:"first",
                },
                {
                    data: "material",
                    title: "教材",
                    name:"first",
                },
                {
                    data: "activity",
                    title: "學習活動",
                    name:"first",
                }
            ]

            let data = <?php echo json_encode($table_data)?>;
            let eventTable = $('#eventTable').DataTable({
                scrollX: true,
                dom: 'frti',
   
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },

                "bSort": false,
                "pageLength": 10,
                "pagingType": "simple",
                "processing": true,
                "bProcessing": true,
                "serverSide": false,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "columns": eventCol,         
                data: data
            });  
    </script>

</body>

</html>