<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("head.php"); ?>
    <style>
        .mouseover{
            cursor:grab;
        }

        .mouseover:active{
            cursor:grabbing;
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
                                            <p class="mt-2"><?= $date_from ?> 至 <?= $date_to ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="text-nowrap">節數： </label>
                                            <input type="text" class="form-control" name="session_count" placeholder="e.g. 1-3" />

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
                                            <?php form_list_type('created_by', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $status_id, 'data-placeholder' => '請選擇...', 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                    <h4 class="bold pt-4">課題:</h4>
                                    <input type="text" class="form-control" name="topic" placeholder="e.g. 家居清潔及美化家居 "/>
                                    </div>
                                </div>
                                <hr>

                                <!-- <div class="tableWrapOver"> -->
                                    <table class="table table-bordered table-striped width100p" id="mainTable">
                                    </table> 
                                <!-- </div> -->

                                <div class="row mb-4">
                                    <div class="col-lg-6" style="display:flex">
                                    <h4 class="bold pt-4 mr-4" style="white-space:nowrap">備註:</h4>
                                        <textarea class="form-control" name="remark" rows="3"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-4 d-flex justify-content-end">

                                    <!-- <button type="button" class="btn bg-primary mw-100 mb-4 mr-4">下 載 至 Word</button> -->
                                    <button type="submit" class="btn bg-purple mw-100 mb-4 mr-4">下 一 步</button>
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

    <?= form_close() ?>



    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>




    <script>
        $(document).ready(function() {
            let year_id = <?= $year_id ?>;
            let asg_id = <?= $asg_id?>; 
            let data = <?php echo json_encode($table_data)?>;

            let columnDefs = [
            {
                render: function(data, type, row, index) {
                    let result = `<input name=order[${data}]" class="hidden" value="${row['id']}" /> #${data}`;
                    return result;
                //     // data: null,
                //     // title: "操作",
                //     // defaultContent:
                //     // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-lg">Delete</a>'
                //     // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-lg">Edit Btn</a>'
                },
                data: "order",
                title: "次序項目",
                class: "no-sort mouseover",
                name :"first",
                orderable: "false",
                targets: 0,
            }, 
            {
                // render: function(data, type, row) {
                //     let result = `<input type="checkbox" name="subjectCheck[]" class="subjectCheck" value="${data}" />`;
                //     return result;
                //     // data: null,
                //     // title: "操作",
                //     // defaultContent:
                //     // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-lg">Delete</a>'
                //     // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-lg">Edit Btn</a>'
                // },
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
                    let result = `<input type="checkbox" name="allStudentCheck[${data}]" class="allCheck" value="${data}" />`;
                    return result;
                //     // data: null,
                //     // title: "操作",
                //     // defaultContent:
                //     // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-lg">Delete</a>'
                //     // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-lg">Edit Btn</a>'
                },
                data: "all_select",
                title: "全選",
                class: "no-sort",
                orderable: false,
            },
            {
                render: function(data, type, row, index) {
                    let result = `<input type="checkbox" name="partStudentCheck[${data}]" class="partCheck" value="${data}" />
                                <select class="form-control" name="level[${data}]" >
                                    <option value="1">低</option>
                                    <option value="2">中</option>
                                    <option value="3">高</option>
                                </select>`;
                    return result;

                //     // data: null,
                //     // title: "操作",
                //     // defaultContent:
                //     // '<a href="#"  class="editor_edit"  data-toggle="modal" data-id="editId" data-target="#itemEdit">Edit</a> / <a href="#" class="editor_remove" rdata-toggle="modal" data-target=".bd-example-modal-lg">Delete</a>'
                //     // defaultContent: '<a href="#" class="button moreBtn" data-toggle="modal" data-target=".bd-example-modal-lg">Edit Btn</a>'
                },
                data: "all_select",
                title: " <button type='button' class='btn bg-yellow' data-toggle='modal' data-target='#studentModal'><i class='fa fa-plus' id='studentModalBtn'/>部分學生</button> ",
                class: "no-sort",
                orderable: false,
            },
        ];

            let table = $('#mainTable').DataTable({
                scrollX: true,
                rowReorder: {dataSrc: 'order'},
                rowsGroup: [
                    'first:name',
                ],
                dom: 'frtip',
                // "buttons": [{
                //     extend: 'colvis',
                //     text: '選擇顯示項目',
                //     columns: ':not(.noVis)',
                //     columnText: function ( dt, idx, title ) {
                //         return title;
                //     }
                // }],
                data: data,
                stateSave:true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [[1]],
                "data-sort": true,
                "bSort": false,
                // "sorting": false,
                "pageLength": 10,
                "pagingType": "simple",
                "processing": true,
                "bProcessing": true,
                "serverSide": false,
                "ordering": true,
                "searching": false,
                "searchDelay": 0,
                "columns": columnDefs,  
                // "drawCallback": function(d) {
                //     console.log('count',table.data().count())
                // }
            
            });

            
            $('#event_count').val(table.data().count())



            ajax_choose(asg_id)
            function ajax_choose(asg_id) {
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/fetch_student_list' ?>',
                method:'POST',
                data:{asg_id: asg_id},
                dataType:'json',
                // beforeSend:function(){
                //     $('#groups').html(
                //         `<div class="col-3 bold">
                //             <button type="button" class="btn btn-warning mw-100 mb-4 mr-4" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i>修 改</button>
                //         </div>`
                //     )        
                //     $('#edit-groups').html(
                //         `<div class="col-3 bold">
                //         </div>`
                //     )               
                // },
                success:function(d){
                    // let student_list = Object.values(d);
                    // let student_ids = Object.keys(d);
                    // console.log(student_ids);
                    // // let myKeyPerformance = Object.values(d.list)
                    // // let myGroup = Object.values(d.groups)
                    // // let myModule = Object.values(d.modules)
                    
                    // let text = "";
                    // for (i = 0; i < student_list.length; i++) {
                    //     text +=  '<div class="col-6 bold mb-2"> <label style="white-space:nowrap">'
                    //             + student_list[i] + 
                    //             `: &nbsp</label><select  class="form-control" name="studentLevel[${student_ids[i]}]" >
                    //                 <option value="1">低</option>
                    //                 <option value="2">中</option>
                    //                 <option value="3">高</option>
                    //             </select>`+ 
                    //             '</div>' 
                    // }
                    // // let add_content = Object.values(d.add_content);

                    // let groups = "";
                    // for(i = 0; i < myGroup.length; i++) {
                    //     groups += '<div class="col-3 bold">'
                    //             + myGroup[i]+       
                    //             '</div>'  
                    // }

                    // let add_content = "";
                    // let j = 0;
                    // for(i = 0; i < myModule.length; i++) {
                    //     add_content += 
                    //             `<div class="row mb-4">
                    //                 <div class="col-lg-3 bold">
                    //                     <p class="mt-2">`+ myModule[i] + `</p>
                    //                 </div>`
                    //                 for(y = 0; y < myGroup.length; y++) {
                    //                     let x = j + (myModule.length * y);
                    //                     add_content += 
                    //                         `<div class="col-lg-3 bold lowLevel d-flex nowrap align-items-center">
                    //                         <input type="text" class="form-control add-content" name="content[]" value="${myKeys[x]['lesson_additional_content'] ? myKeys[x]['lesson_additional_content'] : "" }" data-id="${myKeys[x]['id']}" disabled placeholder=""></input>
                    //                         <input type="hidden" name="id[]" value="${ myKeys[x]['id']}"></input>
                    //                         <input type="hidden" name="group[]" value="${y}"></input>
                    //                         <input type="hidden" name="module[]" value="${i}"></input>
                    //                         </div>
                    //                         `
                    //                 }
                    //                 add_content += `</div>`;

                    //                 j++;

                    // }
                    // $('#key_performances').html(text)
                    // $('#add_content').html(add_content)
                    // $('#edit-body').html(text)

                    $('.partCheck').on('change', function() {
                        $(`.allCheck[value=${this.value}]`).prop("checked",false);
                    });
                    $('.allCheck').on('change', function() {
                        $(`.partCheck[value=${this.value}]`).prop("checked",false);
                    });   
                    // $('#edit-body input').prop("disabled", false);
                    // $('#edit-groups').append(groups)
                    // $('#groups').append(groups)



                    // if (d.common_value == 1) {
                    //     $('#common_value').html('(共通能力)'); 
                    // } else {
                    //     $('#common_value').html(''); 

                    // }
                    // let countSelect = new Set();
                    // countSelect.add(count)
                    // count++;
                    // console.log(d);
                },
                })
            }     
        });

    </script>

</body>

</html>