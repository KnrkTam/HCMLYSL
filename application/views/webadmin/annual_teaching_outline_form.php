<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("head.php"); ?>

    <style>
        .addonRow {
            display: none;
        }
     
        
    </style>
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

                        <div class="box box-primary">
                            <!-- /.box-header -->

                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>


                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <p><?= $year?></p>
                                            <input type="hidden" value=<?= $year_id?> id="year_id"> </input>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">科目： </label>
                                            <p><?= $subject?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group ">
                                            <label class="text-nowrap">施教組別名稱： </label>
                                            <p><?= $group_name?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-5 d-flex">

                                        <div class="form-group w-100">
                                            <label class="text-nowrap">年度學習單元: </label>
                                            <?php form_list_type('annual_module_id', ['type' => 'select', 'class'=> 'form-control select2' ,'value' => $module_id, 'data-placeholder' => '請選擇...', 'enable_value' => $annual_modules_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                        <a href="#" class="link nowrap mt-30 ml-2 controlSearchBtn">檢視各級單元及備註內容</a>

                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap">單元： </label>
                                            <p class="mt-2"><?= $module?></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">週次： </label>
                                            <p class="mt-2"><?= $week_from?> 至 <?= $week_to?> </p>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="bold">搜尋單元：</h4>

                                <div class="row mb-4">
                                    <div class="col-lg-8">
                                            <?php form_list_type('search_id', ['type' => 'select', 'class'=> 'form-control select2' ,'value' => $module_id, 'data-placeholder' => '請選擇...', 'enable_value' => $annual_modules_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>
                                </div>
                                <h4 class="bold pt-4">搜尋結果</h4>
                                <table class="table table-bordered table-striped dataTable" id="subjectTable">
                                </table>

                                <hr>

                                <h4 class="bold pt-4">共通能力/價值觀</h4>

                                <table class="table table-bordered table-striped dataTable" id="commonSubjectTable">
                                </table>

                                    <hr>
                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="submit" class="btn bg-orange mw-100 mb-4 mr-4" >確 定</button>
                                        <input type="hidden" value=<?= $function?> name="action"> </input>

                                        <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">返 回</button>

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

        <?php include_once("footer.php"); ?>



    </div>
    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>
    <script>
        $(document).ready(function() {
            $("#search_id").select2({
                maximumSelectionLength: 5
            });


            $(document).on("click", ".showMoreBtn", function() {
                // $(this).parent().parent().find(".moduleBox").slideToggle('slow', function() {
                    // $(this).parent().find(".showMoreBtn").toggleClass('active', $(this).is(':visible'));
                    // $(this).parent().parent().find(".previewBox").remove();
                    $(this).parent().parent().find(".addonRow").slideToggle('slow', function() {
                        if ($(this).is(':visible')){
                            $(this).parent().parent().find(".showMoreText").text("隱藏");

                        // $(this).parent().find(".showMoreBtn i").attr("class", "fa fa-fw fa-minus-square-o");
                        } else {
                            // $(this).parent().parent().find(".addonRow").show();
                            // $(this).parent().parent().find(".addonRow").slideToggle('slow', function() {});
                            $(this).parent().parent().find(".showMoreText").text("顯示");


                            // $(this).parent().parent().find(".showMoreText").text("顯示");
                            // $(this).parent().find(".showMoreBtn i").attr("class", "fa fa-fw  fa-plus-square-o");
                        }
                    });

                    
                // })
            });
            // var data = [{
            //         "id": "1",
            //         "subjct": "語文1234",
            //         "course": "語文",
            //         "category": "聆聽",
            //         "coursepoint": "聽力訓練",
            //         "element": "技能",
            //         "group": "初組",
            //         "addon": "1.1 認識自己：去、坐",
            //         "studyresults": "能注意聲音的來源，對聲音作出反應",
            //         "performance": "有意識地留意及回應聲音 (1)",
            //         "evaluation": "A",
            //         "coursenum": "MN0155",
            //         "courserelatenum": "MN0449, MS0002",
            //         "projectnum": "",
            //         "remarks": "非華語",
            //     },
            //     {
            //         "id": "1",
            //         "subjct": "語文1234",
            //         "course": "語文",
            //         "category": "聆聽",
            //         "coursepoint": "聽力訓練",
            //         "element": "技能",
            //         "group": "初組",
            //         "addon": "1.1 認識自己：去、坐",
            //         "studyresults": "能注意聲音的來源，對聲音作出反應",
            //         "performance": "有意識地留意及回應聲音 (2)",
            //         "evaluation": "B",
            //         "coursenum": "MN0155",
            //         "courserelatenum": "MN0449, MS0002",
            //         "projectnum": "",
            //         "remarks": "非華語",
            //     },
            //     {
            //         "id": "2",
            //         "subjct": "自理",
            //         "course": "語文",
            //         "category": "聆聽",
            //         "coursepoint": "聽力訓練",
            //         "element": "技能",
            //         "group": "中組",
            //         "addon": "1.1 認識自己：去、坐",
            //         "studyresults": "能注意聲音的來源，對聲音作出反應",
            //         "performance": "有意識地留意及回應聲音 (1)",
            //         "evaluation": "A",
            //         "coursenum": "MN0155",
            //         "courserelatenum": "MN0449, MS0002",
            //         "projectnum": "",
            //         "remarks": "非華語",
            //     },
            //     {
            //         "id": "2",
            //         "subjct": "自理",
            //         "course": "語文",
            //         "category": "聆聽",
            //         "coursepoint": "聽力訓練",
            //         "element": "技能",
            //         "group": "中組",
            //         "addon": "1.1 認識自己：去、坐",
            //         "studyresults": "能注意聲音的來源，對聲音作出反應",
            //         "performance": "有意識地留意及回應聲音 (2)",
            //         "evaluation": "B",
            //         "coursenum": "MN0155",
            //         "courserelatenum": "MN0449, MS0002",
            //         "projectnum": "",
            //         "remarks": "非華語",
            //     },
            //     {
            //         "id": "2",
            //         "subjct": "自理",
            //         "course": "語文",
            //         "category": "聆聽",
            //         "coursepoint": "聽力訓練",
            //         "element": "技能",
            //         "group": "中組",
            //         "addon": "1.3 我的家：爸爸、媽媽",
            //         "studyresults": "能注意聲音的來源，對聲音作出反應",
            //         "performance": "有意識地留意及回應聲音 (3)",
            //         "evaluation": "c",
            //         "coursenum": "MN0155",
            //         "courserelatenum": "MN0449, MS0002",
            //         "projectnum": "",
            //         "remarks": "非華語",
            //     },
            //     {
            //         "id": "3",
            //         "subjct": "生活常規",
            //         "course": "語文",
            //         "category": "聆聽",
            //         "coursepoint": "聽力訓練",
            //         "element": "技能",
            //         "group": "初組",
            //         "addon": "1.3 我的家：爸爸、媽媽",
            //         "studyresults": "能注意聲音的來源，對聲音作出反應",
            //         "performance": "有意識地留意及回應聲音 (1)",
            //         "evaluation": "A",
            //         "coursenum": "MN0155",
            //         "courserelatenum": "MN0449, MS0002",
            //         "projectnum": "",
            //         "remarks": "非華語",
            //     }
            // ];


            $(".searchBtn").click(function() {
                // alert('clicked');
                mainTable.draw();

            });

            var columnDefs = [{
                // render: function(data, type, row) {

                //     var result = '<input type="checkbox" name="subjectCheck" class="subjectCheck" />';
                //     return result;
                //     // alert(row.id);
                //     // data: null,
                //     // title: "操作",
                //     // defaultContent:
                //     // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-lg">Delete</a>'
                //     // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-lg">Edit Btn</a>'

                // },
                data: "id",
                title: "",
                class: "no-sort w-10px noVis",
                // name: 'first',

            }, 
           {
                name: 'first',
                data: "code",
                title: "課程編號",
                class: ""
            }, {

                data: "group",
                title: "組別",
                class: "",
                name: 'first',

            },
            {
                data: "subject",
                title: "科目",
                class: "",
            }, 
            {

                data: "course",
                title: "課程",
                class: "",
            },{

                data: "category",
                title: "範疇",
                class: ""
            }, {

                data: "sb_obj",
                title: "校本課程學習重點",
                class: ""
            }, {

                data: "element",
                title: "學習元素",
                class: ""
            }, {

                data: "expected_outcome",
                title: "預期學習成果",
                class: ""
            }, {
                render: function(data, type, row) {
                        if (row.addon == "" || !row.addon) {
                            let result = '暫無補充內容';
                            return result;
                        } else {
                            // console.log(row.addon);
                            let result =  '<span class="addonRow">' + data + ' </span><span class="showMoreBtn"><a class="small showMoreText" style="cursor: pointer">顯示</a></span>';
                            return result;
                        }
                    },
                
                data: "addon",
                title: "補充內容",
                class: "w-180px"
            }, {
                data: "performance",
                title: "關鍵表現項目",
                class: "",
                name: 'first',

            }, {
                data: "assessment",
                title: "評估模式",
                class: "",
                name: 'first',


            },  {
                name: 'first',
                data: "related_lesson",
                title: "相關課程編號",
                class: ""
            }, {
                name: 'first',
                data: "rel_code",
                title: "相關項目編號",
                class: ""
            }, {
                name: 'first',
                data: "remarks",
                title: "備註",
                class: ""
            }];


            let mainTable = $('#subjectTable').DataTable({
                scrollX: true,
                dom: 'Bfrtip',
                "buttons": [{
                    extend: 'colvis',
                    text: '選擇顯示項目',
                    columns: ':not(.noVis)',
                    columnText: function ( dt, idx, title ) {
                        return title;
                    }
                }],
                rowsGroup: [
                    // 'zore:name',
                    'first:name',
                ],
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bInfo": true,
                "bPaginate": true,
                "pageLength": 5,
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "columns": columnDefs,            
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/search_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        let module_id = $('#search_id').val();
                        let year_id = $('#year_id').val();
                        // let annual_module_id = $('#annual_module_id').val();
                        // let category_id = $('#subject_category_id').val();
                        // let sb_obj_id = $('#sb_obj_id').val();
                        d.module_id = module_id;
                        d.year_id = year_id;
                        // d.annual_module_search = annual_module_id;
                        // d.subject_category_search = category_id;
                        // d.sb_obj_search = sb_obj_id;
                        // d.subject_search = subject_id;
                    },
                    "complete": function(e){
                        // $('[data-toggle="tooltip"]').tooltip();
                        // $(".addLesson").change(function(e) {
                        //     if ($(this).is(':checked')) {
                        //         added_ids.add(this.value)
                        //         e.stopPropagation();

                        //         subjectSelectedTable.draw();
                        //     } else {
                        //         added_ids.delete(this.value)
                        //         subjectSelectedTable.draw();

                        //     }
                        // });

                        // let old_arr = Array.from(added_ids)
                        // for (let i = 0; i < old_arr.length; i++) {
                        //     $(`input[type=checkbox][class=addLesson][value=${old_arr[i]}]`).prop('checked', true)
                        // }

                        // $(".removeRow").click(function() {
                        //     added_ids.delete(this.attributes.value.value);
                        //     subjectSelectedTable.draw();
                        //     Subject_dataTable.draw();

                        // });
                        // $('input[id=subject_lessons]').val(Array.from(added_ids));

                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });

            let commonSubjectTable = $('#commonSubjectTable').DataTable({
                scrollX: true,
                dom: 'Bfrtip',
                "buttons": [{
                    extend: 'colvis',
                    text: '選擇顯示項目',
                    columns: ':not(.noVis)',
                    columnText: function ( dt, idx, title ) {
                        return title;
                    }
                }],
                // rowsGroup: [
                //     'zore:name',
                //     'first:name',
                // ],
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bInfo": true,
                "bPaginate": true,
                "pageLength": 5,
                "processing": true,
                "serverSide": false,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "columns": columnDefs,            
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/search_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
               
                        // d.annual_module_search = annual_module_id;
                        // d.subject_category_search = category_id;
                        // d.sb_obj_search = sb_obj_id;
                        // // d.subject_search = subject_id;
                    },
                    "complete": function(e){
                        // $('[data-toggle="tooltip"]').tooltip();
                        // $(".addLesson").change(function(e) {
                        //     if ($(this).is(':checked')) {
                        //         added_ids.add(this.value)
                        //         e.stopPropagation();

                        //         subjectSelectedTable.draw();
                        //     } else {
                        //         added_ids.delete(this.value)
                        //         subjectSelectedTable.draw();

                        //     }
                        // });

                        // let old_arr = Array.from(added_ids)
                        // for (let i = 0; i < old_arr.length; i++) {
                        //     $(`input[type=checkbox][class=addLesson][value=${old_arr[i]}]`).prop('checked', true)
                        // }

                        // $(".removeRow").click(function() {
                        //     added_ids.delete(this.attributes.value.value);
                        //     subjectSelectedTable.draw();
                        //     Subject_dataTable.draw();

                        // });
                        // $('input[id=subject_lessons]').val(Array.from(added_ids));

                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });

        })

    </script>

</body>

</html>