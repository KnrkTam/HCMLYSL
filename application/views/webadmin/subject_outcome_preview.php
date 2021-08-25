<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "head.php"; ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include_once "header.php"; ?>

        <?php include_once "menu.php"; ?>

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
                        <div class="box box-primary">
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>

                                <div class="tableWrap">
                                    <div class="row">
                                    <div class="col-lg-12">
                                            <h3 class="text-blue"><b><?= $subject?> - <?= $subject_category ?></b></h3>
                                    </div>
                                        <div class="col-lg-12">
                                            <h5 class="text-purple"><b>已選項目：</b></h5>

                                            <table class="table table-bordered table-striped" id="subjectTable">
                                                <!-- <thead>
                                                    <tr class="bg-light-blue color-palette">
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
                                                        <th class="nowrap">前備技能</th>
                                                        <th class="nowrap">預期學習成果</th>
                                                        <th class="nowrap">課程編號</th>
                                                        <th class="nowrap">相關項目編號</th>
                                                    </tr>
                                                </thead> -->
                                                <tbody>
                                                </tbody>
                                            </table>

                                            <div class="mt-4 d-flex justify-content-end">
                                                <input type="hidden" name="subject_lesson_id" value="<?= $subject_lesson_id?>"></input>
                                                <input type="hidden" name="subject_id" value="<?= $subject_id ?>"></input>
                                                <input type="hidden" name="subject_categories_id" value="<?= $subject_category_id ?> "></input>
                                                <input type="hidden" name="lessons_id[]" value=<?= json_encode($added_ids, true)?>></input>
                                                <button type="submit" class="btn bg-maroon mr-4 mw-100">確 定</button>
                                                <button type="button" class="btn btn-default mw-100" onclick="location.href='<?= (admin_url($page_setting['controller'])) . '/'. $previous. '/'. $subject_lesson_id?>';">返 回</button>
                                         
                                            </div>
                                            <hr>
                                        </div>

                                    </div>


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

        <?php include_once "footer.php"; ?>

    </div>
    <!-- ./wrapper -->
    <?php include_once "script.php"; ?>





    <script>
        $(document).ready(function() {
                let columnDefs = [{
                    width: '60px',
                    data: "category",
                    title: "課程範疇",
                    name: 'first',
                },               
                {
                    class: 'col',
                    data: "course",
                    title: "課程",
                    name: 'first',
                },               
                {
                    class: 'col',
                    data: "sb_obj",
                    title: "校本課程學習重點",
                    name: 'first',
                },        
                {
                    width: '100px',
                    data: "element",
                    title: "學習元素",
                    name: 'first',
                },              
                {
                    class: 'col',
                    data: "groups",
                    title: "組別",
                    name: 'first',
                },                
                {
                    class: 'big-col',
                    data: "expected_outcome",
                    title: "預期學習成果",
                    name: 'first',
                },        
                {
                    class: 'col',
                    data: "pre-skills",
                    title: "前備技能",
                    name: 'first',

                },  
                {
                    class: 'col',
                    data: "lpf_basic",
                    title: "LPF(基礎)",
                    name: 'first',
                },                
                {
                    class: 'col',
                    data: "lpf_advanced",
                    title: "LPF(高中)",
                    name: 'first',
                },                
                {
                    class: 'col',
                    data: "poas",
                    title: "POAS",
                    name: 'first',
                },                
                {
                    class: 'col',
                    data: "skills",
                    title: "Key Skill",
                    name: 'first',
                },                                  
                {
                    class: 'col',
                    data: "rel_les",
                    title: "相關項目編號",
                    name: 'first',
                },              
            ];
            
            $('[data-toggle="tooltip"]').tooltip();
            var subjectTable = $('#subjectTable').DataTable({
                scrollX: true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bSort": false,
                "pageLength": 10,
                "pagingType": "simple",
                //"sDom": '<"wrapper"lfptip>',
                "processing": false,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "columns": columnDefs,   
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/preview_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        let added_arr = <?= json_encode($added_ids)?>;
                        // console.log(typeof(added_arr))
                        d.added_ids = added_arr;
                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });
        });

    </script>

</body>

</html>