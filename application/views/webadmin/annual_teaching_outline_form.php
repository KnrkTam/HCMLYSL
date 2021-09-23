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
                        <?= form_open_multipart($form_action, 'id="myForm" class="form-horizontal"'); ?>

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
                                <div class="alert alert-info alert-dismissible fade in" role="alert" id="alert-add-item" style="display:none">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <p> 已選擇 <strong id="item-count"></strong> 個項目</p>
                                </div>

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
                                        <button type="button" id="createBtn" class="btn bg-orange mw-100 mb-4 mr-4" >確 定</button>
                                        <input type="hidden" value=<?= $function?> name="action"> </input>
                                        <input type="hidden" id="common_lessons" name="common_lessons[]" value=""></input>
                                        <input type="hidden" id="selected_lessons" name="selected_lessons[]" value=""></input>
                                        <input type="hidden" name="action" value="create"></input>


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
                $(this).parent().parent().find(".addonRow").slideToggle('slow', function() {
                    if ($(this).is(':visible')){
                        $(this).parent().parent().find(".showMoreText").text("隱藏");
                    } else {
                        $(this).parent().parent().find(".showMoreText").text("顯示");
                    }
                });
            });
            let id = <?= $id ?>;
            let added_ids = new Set();
            let common_ids = new Set();



            $(".searchBtn").click(function() {
                // alert('clicked');
                mainTable.draw();

            });

            var columnDefs = [{
                data: "id",
                title: "",
                class: "no-sort w-10px noVis",
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
                render: function(data, type, row) {
                    if (row.relcode == "" | !row.rel_code) {
                        let result = '暫無相關項目編號';
                        return result;
                    } else {
                        let result = data;
                        return result;
                    }
                },
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

            function show_status () {
                let count = added_ids.size;
                if (count > 0) {
                    $('#item-count').html(count);
                    $('#alert-add-item').fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                }
            }

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


                        d.module_id = module_id;
                        d.year_id = year_id;

                    },
                    "complete": function(e){
                        $(".addLesson").change(function(e){
                            if ($(this).is(':checked')) {
                                added_ids.add(this.dataset.group + '_' + this.dataset.key_performance.toString());
                            } else {
                                added_ids.delete(this.dataset.group+ '_' +this.dataset.key_performance.toString());
                            }
                            console.log(Array.from(added_ids));
                            show_status();

                        })
                        let old_arr = Array.from(added_ids)
                        for (let i = 0; i < old_arr.length; i++) {
                            // console.log(old_arr[i].split(",")[0]);
                            // console.log(old_arr[i].split(",")[1]);
                            $(`input[type=checkbox][class=addLesson][data-group=${old_arr[i].split("_")[0]}][data-key_performance=${old_arr[i].split("_")[1]}]`).prop('checked', true);
                        }

                        show_status();
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
                rowsGroup: [
                //     'zore:name',
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
                    "url": "<?= admin_url($page_setting['controller'] . '/search_ajax_common') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        let year_id = $('#year_id').val();
                        d.year_id = year_id;
                    },
                    "complete": function(e){
                        $(".addCommon").change(function(e){
                            if ($(this).is(':checked')) {
                                // console.log(this.value)
                                // console.log(this.dataset.group)
                                // console.log(this.dataset.key_performance)
                                common_ids.add(this.dataset.group+ '_' +this.dataset.key_performance.toString());
                            } else {
                                common_ids.delete(this.dataset.group+ '_' +this.dataset.key_performance.toString());
                            //     console.log('unchecked');
                            //     console.log([this.dataset.group, this.dataset.key_performance])
                            }
                            console.log(common_ids);
                        })

                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });


            let createBtn = document.querySelector('#createBtn');
            createBtn.addEventListener("click",function(){
                createModule(Array.from(added_ids), Array.from(common_ids) ,id , annual_module_id.value );
                function createModule(added_ids, common_ids, id, annual_module_id){
                    $.ajax({
                    url: '<?= (admin_url($page_setting['controller'])) . '/validate' ?>',
                    method:'POST',
                    data:{added_ids:added_ids, common_ids:common_ids, id, annual_module_id: annual_module_id},
                    dataType:'json',     
                    beforeSend: function(){
                        
                        $('input[id=common_lessons]').val(common_ids);
                        $('input[id=selected_lessons]').val(added_ids);
                    },
                    success:function(data){
                        if (data.status == 'success') {
                            document.getElementById('myForm').submit();
                        } else {
                            alertify.error(data.status)
                        }
                    },
                    error: function(error){
                        alert('error');
                        // alert('duplicated');
                        // console.log(error);
                    }
                    });
                } 
            })        
        })

    </script>

</body>

</html>