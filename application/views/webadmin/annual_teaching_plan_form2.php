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
                                            <label class="text-nowrap required">節數： </label>
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
                                            <label class="text-nowrap required">編寫教師：</label>
                                            <?php form_list_type('created_by', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $_SESSION['sys_user_id'], 'data-placeholder' => '請選擇...', 'enable_value' => $staff_list, 'form_validation_rules' => 'trim|required']) ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                    <h4 class="bold pt-4 required">課題:</h4>
                                    <input type="text" class="form-control" name="topic" placeholder="e.g. 家居清潔及美化家居 "/>
                                    <!-- <input type='file' id='testFile'>
                                    <img id="testImage" src="" alt="Preview" class="w-75"/> -->

                                    </div>
                                </div>
                                <hr>
                                <span class="text-red small">*可拖曳目標以變換項目次序</span>
                                <table class="table table-bordered table-striped width100p" id="mainTable">
                                </table> 
                                <div id="sortable">
                                    <div class="row mb-4 list-item activity">
                                        <div class="col-lg-11">
                                        <label class="content-nowrap text-green">活動 1： </label>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="text-nowrap required">項目#： </label>
                                                        <?php form_list_type('activity_event[0][]', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $event_count, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="text-nowrap required" for="eventName">活動名稱：
                                                        </label>
                                                        <input type="text" class="form-control" name="activity_name[0]" placeholder="請填寫活動名稱 ">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="text-nowrap">教材/教具：
                                                        </label>
                                                        <input type="text" class="form-control" name="materials[0]" placeholder="請填寫活動教材/教具 ">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="text-nowrap required" >學習活動： </label>
                                                <textarea class="form-control" name="activity_content[0]" rows="3" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>上載檔案：</label>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2" accept="image/*" name="photo[0][1]" onchange="loadFile(event, 0, 1)">
                                                        <img id="output[0][1]" class="w-75"/>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2" accept="image/*"  name="photo[0][2]" onchange="loadFile(event, 0, 2)">
                                                        <img id="output[0][2]" class="w-75"/>

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2" accept="image/*"  name="photo[0][3]" onchange="loadFile(event,0, 3)">
                                                        <img id="output[0][3]" class="w-75"/>
                                                    </div>
                                                </div>
                                                <hr/>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 text-right">
                                            <button type="button" class="btn bg-navy deleteBtn mt-4 mr-4" disabled><i class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    <button type="button" id="add-btn" class="btn btn-info mw-100 mb-4" ><i class="fa fa-fw fa-plus"></i> 增加一欄
                                    </button>
                                    <hr>
                                <div class="row mb-4">
                                    <div class="col-lg-6" style="display:flex">
                                    <h4 class="bold pt-4 mr-4" style="white-space:nowrap">備註:</h4>
                                        <textarea class="form-control" name="remark" rows="3"></textarea>
                                    </div>
                                </div>
                                <hr>
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

    <?= form_close() ?>



    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>




    <script>

        let loadFile = function(event,index, item) {
            let reader = new FileReader();
            reader.onload = function(){
                console.log('reader', reader);
                console.log('file', event.target.files[0])
                let file = event.target.files[0];
                let output = document.getElementById(`output[${index}][${item}]`);
                if (file.size < 100000) {
                    localStorage.setItem(`activity[${index}]_image[${item}]`, reader.result)
                    output.src = reader.result;

                } else {
                    alert('Error: Size of image cannot be larger than 100 kb')
                }
            };

            reader.readAsDataURL(event.target.files[0]);
        };
// Setitem
            // document.querySelector('#testFile').addEventListener('change', function () {
            //     let reader = new FileReader();
            //     reader.onload = function(){
            //         localStorage.setItem('recent-image', reader.result)
            //         console.log(reader.result);
            //     };
            //     reader.readAsDataURL(this.files[0]);
            // });
// Get item
            let j_arr = [0, 1, 2];
            document.addEventListener("DOMContentLoaded", () => {
                for (i = 0; i < j_arr.length; i++) {
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
            });


        $(document).ready(function() {
            let year_id = <?= $year_id ?>;
            let asg_id = <?= $asg_id?>; 
            let data = <?php echo json_encode($table_data)?>;

            let columnDefs = [
            {
                render: function(data, type, row, index) {
                    let result = `#${data}<input name="order[${data}]" hidden value="${row['id']}"></input>  `;
                    return result;
                },
                data: "order",
                title: "項目次序",
                class: "no-sort mouseover",
                orderable: false,
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
                class: "no-sort mouseover",
                orderable: false,
                name:"first"
            }, 
            {
                data: "element",
                title: "學習元素",
                class: "mouseover",
                orderable: false,
                name:"first"

            }, 
            {
                data: "group",
                title: "組別",
                class: "mouseover",
                orderable: false,
                name:"first"
            }, 
            {
                data: "expected_outcome",
                title: "預期學習成果",
                class: "no-sort mouseover",
                name:"first",
                orderable: false,

            }, 
            {
                data: "addon",
                title: "補充內容",
                class: "w-90px no-sort mouseover",
                name:"first",
                orderable: false,

            }, 
            {
                data: "performance",
                title: "關鍵表現項目",
                class: "no-sort mouseover",
                name:"first",
                orderable: false,

            }, 
            {
                data: "assessment",
                title: "評估模式",
                class: "no-sort mouseover",
                orderable: false,

            },
            {
                render: function(data, type, row, index) {
                    let result = `<input type="checkbox" name="allStudentCheck[${data}]" class="allCheck" value="${data}" />`;
                    return result;
                },
                data: "all_select",
                title: " <input type='checkbox'  class='allCheckAll'>全選</input>",
                class: "no-sort",
                orderable: false,
            },
            {
                render: function(data, type, row, index) {
                    let result = `<div style="display:flex; align-items: center"><input type="checkbox" name="partStudentCheck[${data}]" class="partCheck" value="${data}" multiple="multiple"/>
                                <select class="form-control select2 level" id="level_${data}" name="level[${data}][]" multiple="multiple" required>
                                    <option value="1">L</option>
                                    <option value="2">LM</option>
                                    <option value="3">M</option>
                                    <option value="4">MH</option>
                                    <option value="5">H</option>
                                </select></div>`;
                    return result;

                },
                data: "part_select",
                title: " <button type='button' class='btn bg-yellow' data-toggle='modal' data-target='#studentModal'><i class='fa fa-plus' id='studentModalBtn'/>部分學生</button> ",
                class: "no-sort",
                orderable: false,
            },
        ];

            let table = $('#mainTable').DataTable({
                scrollX: true,
                rowReorder: {
                    dataSrc: 'order',
                    selector: 'td.mouseover'
                },
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
                "drawCallback": function(d) {
                    $('.allCheckAll').click(function(){
                    if (this.checked == true) {
                        $('.allCheck').prop('checked', true);
                        $('.partCheck').prop('checked', false);
                        $(`.level`).prop("disabled", true);
                    } else {
                        $('.allCheck').prop('checked', false);
                        $(`.level`).prop("disabled", false);

                    }
                    })
                },
            
            });

        

            $('#event_count').val(table.data().count())


            $('.allCheckAll').click(function(){
                alert('allcheck!');
                $('.allCheck').props('checked', 'checked');
            })


            ajax_choose(asg_id)
            function ajax_choose(asg_id) {
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/fetch_student_list' ?>',
                method:'POST',
                data:{asg_id: asg_id},
                dataType:'json',
                success:function(d){
                    $('.select2').select2();
                    $('.partCheck').on('change', function() {
                        let value = this.value;
                        $('.allCheckAll').prop('checked', false);

                        $(`.allCheck[value=${this.value}]`).prop("checked",false);
                        $(`#level_${value}`).prop("disabled",false);

                    });
                    $('.allCheck').on('change', function() {
                        let value = this.value;
                        $(`.partCheck[value=${value}]`).prop("checked",false);
                        $(`#level_${value}`).prop("disabled", true);
                    });   
                },
                })
            }     
        });

        var _lsTotal = 0,
            _xLen, _x;
        for (_x in localStorage) {
            if (!localStorage.hasOwnProperty(_x)) {
                continue;
            }
            _xLen = ((localStorage[_x].length + _x.length) * 2);
            _lsTotal += _xLen;
            console.log(_x.substr(0, 50) + " = " + (_xLen / 1024).toFixed(2) + " KB")
        };
        console.log("Total = " + (_lsTotal / 1024).toFixed(2) + " KB");


  

        let j = 1;
        $('#add-btn').click(function() {

            let content = `
            <div class="row mb-4 list-item activity">
                <div class="col-lg-11">
                 <label class="content-nowrap text-green">活動 ${(j+1)}： </label>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group ">
                                <label class="content-nowrap required">項目#： </label>
                                <select class="form-control select2"  name="activity_event[${j}][]" multiple="multiple" required>
                                <? foreach ($event_count as $k => $row) {?>
                                    <option value="<?= $k ?>"><?= $row?></option>
                                <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-nowrap required" for="eventName">活動名稱：
                                </label>
                                <input type="text" class="form-control" name="activity_name[${j}]" placeholder="請填寫活動名稱 ">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-nowrap">教材/教具：
                                </label>
                                <input type="text" class="form-control" name="materials[${j}]" placeholder="請填寫活動教材/教具 ">
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="text-nowrap required" >學習活動： </label>
                        <textarea class="form-control" name="activity_content[${j}]" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>上載檔案：</label>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="file" class="form-control-file mb-2" accept="image/*" onchange="loadFile(event, ${j},1)">
                                <img id="output[${j}][1]" class="w-75"/>
                            </div>
                            <div class="col-lg-4">
                                <input type="file" class="form-control-file mb-2" accept="image/*" onchange="loadFile(event,${j}, 2)">
                                <img id="output[${j}][2]" class="w-75"/>

                            </div>
                            <div class="col-lg-4">
                                <input type="file" class="form-control-file mb-2" accept="image/*" onchange="loadFile(event,${j}, 3)">
                                <img id="output[${j}][3]" class="w-75"/>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="col-lg-1 text-right">
                    <button type="button" class="btn bg-navy deleteBtn mt-4 mr-4" onclick="delActivity(this)"><i class="fa fa-trash-o"></i></button>
                </div>
                <hr>

            </div>

            `;
            $('#sortable').append(content)
            j++;

            $('select.select2').select2();

            //     let loadFile = function(event,index, item) {
            //     let reader = new FileReader();
            //     reader.onload = function(){
            //         var output = document.getElementById(`output[${index}][${item}]`);
            //         output.src = reader.result;
            //     };
            //     console.log('reader',reader.result)
            //     reader.readAsDataURL(event.target.files[0]);
            // };

        });

        let delActivity = function delActivity(e) {
            $(e).parents('.activity').remove();
            j-=1;
            // $('#activity['+index+']').remove();
        };

        
        let submitBtn = document.querySelector('#submitBtn');
        submitBtn.addEventListener("click",function(){

            let myForm = document.getElementById('myForm');
            let formData = $('#myForm').serializeJSON();

            passStage(formData);
            function passStage(formData){
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/validate' ?>',
                method:'POST',
                data:{form: formData},
                dataType:'json',     
                
                success:function(data){
                    if (data.status == 'success') {
                        document.getElementById('myForm').submit();
                    } else {
                        alertify.error(data.status)
                    }
                },
                error: function(error){
                    alert('error');
                }
                });
            } 
        })  


    </script>

</body>

</html>