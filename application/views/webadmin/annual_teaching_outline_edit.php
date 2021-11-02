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
                    <?= ($page_setting['scope']) ?> (補充內容)
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
                        <div class="box box-primary">
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <div class="row mb-4">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="text-nowrap">科目：</label>
                                            <p><?= $subject?></p>
                                            <input type="hidden" id="asg_id" value="<?= $asg_id?>"></input>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="text-nowrap">組別名稱：</label>
                                            <p><?= $group_name?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                            
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-4">
                                    <div class="col-lg-4">
                                        <div class="form-group ">
                                            <label class="text-nowrap">預期學習成果：</label><span class="text-purple" id="common_value"></span>
                                            <?php form_list_type('expected_outcome', ['type' => 'select', 'class'=> 'select2 form-control ' , 'value' => 0, 'data-placeholder' => '請選擇...', 'enable_value' => $expected_outcome, 'disable_please_select' => 1]) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="bold">關鍵表現項目：</p>
                                        <span id="key_performances"></span>
                                    </div>
                                </div>

                                <div class="row d-flex list-row-header mb-2" id="groups">   
                                    <div class="col-3 bold">
                                        <button type="button" class="btn btn-warning mw-100 mb-4 mr-4" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i>修 改</button>
                                    </div>
                                </div>
                                <span id="add_content">
                                </span>

                                <div class="mt-4 d-flex justify-content-end">
                                    <!-- <button type="submit" class="btn btn-primary mw-100 mb-4 mr-4">確 定</button> -->
                                    <button type="button" class="btn btn-default mw-100 mb-4 mr-4" onclick="location.href='<?= admin_url($page_setting['controller'].'/view/'.$id) ?>';">返 回</button>
                                    <button type="button" class="btn btn-default mw-100 mb-4 " onclick="location.href='<?= admin_url($page_setting['controller']) ?>';">返回大綱</button>

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
        <?= form_open_multipart($form_action, 'class="form-horizontal"'); ?>
        <div class="modal fade in" tabindex="-1" role="dialog" id="editModal">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">修改補充內容 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                            </div> 

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="save-edit-btn" class="btn btn-success">儲 存</button>
                        <input type="hidden" name="ato_id" value="<?= $id ?>"></input>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close() ?>








    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>
    <script>
  
        $(document).ready(function() {
            let count = 0
            ajax_choose(expected_outcome.value, asg_id.value)
            function ajax_choose(expected_outcome, asg_id) {
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/select_expected_outcome' ?>',
                method:'POST',
                data:{expected_outcome:expected_outcome, asg_id: asg_id},
                dataType:'json',
                beforeSend:function(){
                    $('#groups').html(
                        `<div class="col-3 bold">
                            <button type="button" class="btn btn-warning mw-100 mb-4 mr-4" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i>修 改</button>
                        </div>`
                    )        
                    $('#edit-groups').html(
                        `<div class="col-3 bold">
                        </div>`
                    )               
                },
                success:function(d){
                    let myKeys = Object.values(d.add_content)
                    let myKeyPerformance = Object.values(d.list)
                    let myGroup = Object.values(d.groups)
                    let myModule = Object.values(d.modules)
                    
                    let text = "";
                    for (i = 0; i < myKeyPerformance.length; i++) {
                        text +=  myKeyPerformance[i] + '<br>' ;
                    }
                    // let add_content = Object.values(d.add_content);

                    let groups = "";
                    for(i = 0; i < myGroup.length; i++) {
                        groups += '<div class="col-3 bold">'
                                + myGroup[i]+       
                                '</div>'  
                    }

                    let add_content = "";
                    let j = 0;
                    for(i = 0; i < myModule.length; i++) {
                        add_content += 
                                `<div class="row mb-4">
                                    <div class="col-lg-3 bold">
                                        <p class="mt-2">`+ myModule[i] + `</p>
                                    </div>`
                                    for(y = 0; y < myGroup.length; y++) {
                                        let x = j + (myModule.length * y);
                                        add_content += 
                                            `<div class="col-lg-3 bold lowLevel d-flex nowrap align-items-center">
                                            <input type="text" class="form-control add-content" name="content[]" value="${myKeys[x]['lesson_additional_content'] ? myKeys[x]['lesson_additional_content'] : "" }" data-id="${myKeys[x]['id']}" disabled placeholder=""></input>
                                            <input type="hidden" name="id[]" value="${ myKeys[x]['id']}"></input>
                                            <input type="hidden" name="group[]" value="${y}"></input>
                                            <input type="hidden" name="module[]" value="${i}"></input>
                                            </div>
                                            `
                                    }
                                    add_content += `</div>`;

                                    j++;

                    }
                    $('#key_performances').html(text)
                    $('#add_content').html(add_content)
                    $('#edit-body').html(add_content)
                    $('#edit-body input').prop("disabled", false);
                    $('#edit-groups').append(groups)
                    $('#groups').append(groups)



                    if (d.common_value == 1) {
                        $('#common_value').html('(共通能力)'); 
                    } else {
                        $('#common_value').html(''); 

                    }
                    let countSelect = new Set();
                    countSelect.add(count)
                    count++;
                    console.log(d.common_value)
                },
                })
            }
            
            $('#expected_outcome').change(function() {
                ajax_choose(this.value, asg_id.value)
            
            })

            let editBtn = document.querySelector('#save-edit-btn');
            editBtn.addEventListener("click",function(){
                console.log($('#edit-body [name=^content]').length)
            // let confirmCreate = confirm(`Are you sure edit ${level_id.level_id.value}, ${modalCode.value}, ${modalName.value}, ${modalId.value}`);
            // editModule(level_id.level_id.value, modalCode.value, modalName.value, modalId.value);
            // function editModule(level_id, code, name, id){
            //     $.ajax({
            //     url: `<?= (admin_url($page_setting['controller'])) . '/edit/'?>${id}`,
            //     method:'POST',
            //     data:{level_id:level_id,code: code, name: name, id: id},
            //     dataType:'json',     
            //     success:function(data){
            //         if (data.status == 'success') {
            //             window.location.reload();
            //         } else if (data.status == 'no_change') {
            //             $('#editDetail').modal('hide');
            //         }else {
            //             alertify.error(data.status)
            //         }
            //     },
            //     error: function(error){
            //         alert('error');
            //     }
            //     });
            // } 
        })



        });

    </script>

</body>

</html>