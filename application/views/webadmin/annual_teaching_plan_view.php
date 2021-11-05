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
                        <?= form_open_multipart($form_action, 'class="form-horizontal" id="myForm"'); ?>
                        <!-- Modal box -->
                        <div class="modal fade in" tabindex="-1" role="dialog" id="studentModal">
                            <div class="modal-dialog modal-lg modal-dialog-centered w-25" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title bold">設定學生能力程度 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button></h3>
                                        </div>
                                    <div class="modal-body">
                                        <div class="row d-flex list-row-header mb-2" id="edit-groups">
                                            <div class="col-3 bold">

                                            </div>
                                        </div>
                                        <div class="row mb-4 ">
                                            <div class="col-md-12"  id="edit-body">
                                                <?php foreach ($student_list as $i =>  $row) {?>
                                                    <div class="col-6 bold mb-2"> 
                                                        <label style="white-space:nowrap">
                                                        <?= $row ?>: &nbsp</label>
                                                        <?php form_list_type('studentLevel['.$i.']', ['type' => 'select', 'class'=> 'form-control select2', 'enable_value' => $level_list ,'value' => 1, 'form_validation_rules' => 'trim|required']) ?>
                                                    </div> 
                                                <? } ?>
                                            </div> 

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                    <!-- <button type="submit" id="save-edit-btn" class="btn btn-success">儲 存</button> -->
                                        <button type="button" id="save-edit-btn" class="btn btn-success" data-dismiss="modal">儲 存</button>
                                        <input type="hidden" name="ato_id" value="<?= $id ?>"></input>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Ends -->
                        <div class="box box-primary">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
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
                                            <label class="text-nowrap">單元： </label>
                                            <p><?= $module?></p>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex">
                                        <div class="form-group w-100">
                                            <label class="text-nowrap">單元名稱: </label>
                                            <p><?= $annual_module?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">單元日期： </label>
                                            <p class="mt-2"><?= $date_from ? $date_from .' 至 '. $date_to : 'NA' ?></p>
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
                                            <p><?=$today?></p> 
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">編寫教師：</label>
                                            <p><?= $edited_by?></p>

                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                    <h4 class="bold pt-4">課題:</h4>
                                    <h2 class="text-blue"><?= $topic?></h2>
                                    </div>
                                </div>
                                <hr>
                                <table class="table table-bordered table-striped width100p" id="mainTable">
                                </table> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="bold pt-4 text-blue">學習活動 :</h4>
                                        <table class="table table-bordered table-striped width100p" id="eventTable">
                                        </table> 
                                    </div>
                                </div> 
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label class="text-nowrap"><h4 class=" bold">備註：</h4></label>
                                        <p><?= $remarks ? $remarks : 'NA'?></p> 
                                        <hr>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <!-- <button type="button" class="btn bg-primary mw-100 mb-4 mr-4">下 載 至 Word</button> -->
                                    <button type="button" id="submitBtn" class="btn bg-purple mw-100 mb-4 mr-4">下 一 步</button>
                                    <!-- <button type="button" class="btn bg-maroon mw-100 mb-4 mr-4">提 交</button> -->
                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">返 回</button>
                                    <input class="hidden" name="asg_id" value=<?= $asg_id ?> />
                                    <input class="hidden" name="ato_id" value=<?= $id ?> />
                                    <input class="hidden" name="event_count" value=<?= json_encode($event_count) ?> />
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
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
            let columnDefs = [
            {
                data: "order",
                title: "次序項目",
                class: "no-sort ",
                name :"first",
            }, 
            {
                data: "id",
                title: "",
                class: "no-sort w-10px hidden"
            }, 
            {
                data: "common_value",
                class: "hidden",
            }, 
            {
                data: "category",
                title: "範疇",
                orderable: false,
                name:"first",
                class: "mouseover"
            }, 
            {
                data: "sb_obj",
                title: "校本課程學習重點",
                class: "no-sort",
                orderable: false,
                name:"first"
            }, 
            {
                data: "element",
                title: "學習元素",
                class: "",
                orderable: false,
                name:"first"
            }, 
            {
                data: "group",
                title: "組別",
                class: "",
                orderable: false,
                name:"first"
            }, 
            {
                data: "expected_outcome",
                title: "預期學習成果",
                class: "no-sort",
                name:"first",
                orderable: false,

            }, 
            {
                data: "addon",
                title: "補充內容",
                class: "w-90px no-sort",
                name:"first",
                orderable: false,

            }, 
            {
                data: "performance",
                title: "關鍵表現項目",
                class: "no-sort",
                name:"first",
                orderable: false,

            }, 
            {
                data: "assessment",
                title: "評估模式",
                class: "no-sort",
                orderable: false,

            },
            {
                render: function(data, type, row, index) {
                    if (data.checked == 1 ) {
                        let result = `<input type="checkbox" name="allStudentCheck[${data.id}]" class="allCheck" value="${data.id}" checked disabled/>`;
                        return result;

                    } else {
                        let result = `<input type="checkbox" name="allStudentCheck[${data.id}]" class="allCheck" value="${data.id}" disabled/>`;
                        return result;

                    }
                },
                data: "all_select",
                title: "全選",
                class: "no-sort",
                orderable: false,
            },
            {
                render: function(data, type, row, index) {
                    if (data.checked == 1 ) {
                        let result = `<div style="display:flex; align-items: center"><input type="checkbox" name="partStudentCheck[${data.id}]" class="partCheck" value="${data.id}" multiple="multiple" checked disabled/>
                                <select class="form-control select2 level" id="level_${data.id}" name="level[${data.id}]" multiple="multiple" disabled>
                                    <option value="1">L</option>
                                    <option value="2">LM</option>
                                    <option value="3">M</option>
                                    <option value="4">MH</option>
                                    <option value="5">H</option>
                                </select></div>`;
                        $(`#level_${data.id}`).val(data.level).select2().change();
                        return result;
                    } else {
                        let result = `<div style="display:flex; align-items: center"><input type="checkbox" name="partStudentCheck[${data.id}]" class="partCheck" value="${data.id}" multiple="multiple" disabled/>
                                <select class="form-control select2 level" id="level_${data.id}" name="level[${data.id}]" disabled>
                                </select></div>`;
                        return result;
                    }
                },
                data: "part_select",
                title: " <button type='button' class='btn bg-yellow' data-toggle='modal' data-target='#studentModal'><i class='fa fa-plus' id='studentModalBtn'/>部分學生</button> ",
                class: "no-sort",
                orderable: false,
            },
        ];
        let data = <?php echo json_encode($table_data)?>;

        let table = $('#mainTable').DataTable({
            scrollX: true,
            dom: 'frtip',
            data: data,
            stateSave:true,
            "language": {
                "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
            },
            "order": [[0, 'asc']],
            "data-sort": true,
            "bSort": false,
            "pageLength": 10,
            "pagingType": "simple",
            "processing": true,
            "bProcessing": true,
            "serverSide": false,
            "ordering": true,
            "searching": false,
            "searchDelay": 0,
            "columns": columnDefs,  
        });


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
            },
            {
                render: function(data, type, row, index) {
                    let result = `<img id="output[${data}][1]" class="imgBox" /><img id="output[${data}][2]" class="imgBox" /><img id="output[${data}][3]" class="imgBox" />`;
                    return result;
                },
                data: "photos",
                title: "預覽圖片",
                name:"first",
                // class: "d-flex",
            }
        ]
        let activity_data = <?php echo json_encode($activity_data)?>;

        let eventTable = $('#eventTable').DataTable({
            // "scrollY": "600px",
            // scrollX: false,

            // "scrollCollapse": true,
            "paging": false,
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
            data: activity_data,
            "initComplete": function(settings, json) {
                // document.addEventListener("DOMContentLoaded", () => {
                    let activity_count = <?= json_encode($activity_count)?>;
                    console.log('aac', activity_count);
                    for (i = 0; i < activity_count.length; i++) {
                        let img1 = localStorage.getItem(`activity[${i}]_image[1]`);                    
                        let img2 = localStorage.getItem(`activity[${i}]_image[2]`);
                        let img3 = localStorage.getItem(`activity[${i}]_image[3]`);

                        if (img1) {
                            document.getElementById(`output[${i}][1]`).setAttribute("src", img1);
                        }
                        if (img2) {
                            document.getElementById(`output[${i}][2]`).setAttribute("src", img2);
                        }
                        if (img3) {
                            document.getElementById(`output[${i}][3]`).setAttribute("src", img3);
                        }
                    }
                // })
            },
        });  

    </script>

</body>

</html>