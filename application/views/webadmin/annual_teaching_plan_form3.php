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
                                <div id="sortable">
                                    <div class="row mb-4 list-item">
                                        <div class="col-lg-11">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="text-nowrap">項目#： </label>
                                                        <?php form_list_type('activity_event[1][]', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $event_count, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="text-nowrap" for="eventName">活動名稱：
                                                        </label>
                                                        <input type="text" class="form-control" name="activity_name[1]" placeholder="請填寫活動名稱 ">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="text-nowrap">教材/教具：
                                                        </label>
                                                        <?php form_list_type('materials[1][]', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => [1 => 'IPAD', 2 => 'Notebook', 3 => 'PPT'], 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="text-nowrap">學習活動： </label>
                                                <textarea class="form-control" name="activity_content[1]" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>上載檔案：</label>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2" accept="image/*" onchange="loadFile(event, 1, 1)">
                                                        <img id="output[1][1]" class="w-75"/>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2" accept="image/*" onchange="loadFile(event, 1, 2)">
                                                        <img id="output[1][2]" class="w-75"/>

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="file" class="form-control-file mb-2" accept="image/*" onchange="loadFile(event,1, 3)">
                                                        <img id="output[1][3]" class="w-75"/>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="col-lg-1 text-right">
                                            <button type="button" class="btn bg-navy deleteBtn mt-4 mr-4" disabled><i class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="addBtn" class="btn btn-info mw-100 mb-4" onclick="addActivity(activity_count)"><i class="fa fa-fw fa-plus"></i> 增加一欄
                                </button>
                                <hr>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn bg-orange mw-100 mb-4 mr-4">確 定</button>
                                    <button type="button" class="btn btn-default mw-100 mb-4" onclick="goBack()">返 回</button>
                                    <input class="hidden" name="asg_id" value=<?= $asg_id ?> />
                                    <input class="hidden" name="ato_id" value=<?= $id ?> />
                                    <input class="hidden" name="atp_data" value=<?= json_encode($atp_data) ?> />
                                    <input class="hidden" name="atp_ato" value=<?= json_encode($atp_ato) ?> />
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
        // $(document).ready(function() {
        let loadFile = function(event,index, item) {
            let reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById(`output[${index}][${item}]`);
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        let activity_count = 1;
        let addActivity = function addActivity(activity_count) {
            <? $i++?>
            let index = activity_count + 1; 
            let content = `
            <div class="row mb-4 list-item" id="activity[${index}]">
                <div class="col-lg-11">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group ">
                                <label class="content-nowrap">項目#： </label>
                                <?php form_list_type('activity_event['.$i.'][]', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => $event_count, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-nowrap" for="eventName">活動名稱：
                                </label>
                                <input type="text" class="form-control" name="activity_name[${index}]" placeholder="請填寫活動名稱 ">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-nowrap">教材/教具：
                                </label>
                                <?php form_list_type('materials['. $i. '][]', ['type' => 'select', 'class'=> 'form-control select2' , 'data-placeholder' => '請選擇...', 'enable_value' => [1 => 'IPAD', 2 => 'Notebook', 3 => 'PPT'], 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="text-nowrap">學習活動： </label>
                        <textarea class="form-control" name="activity_content[${index}]" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>上載檔案：</label>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="file" class="form-control-file mb-2" accept="image/*" onchange="loadFile(event, ${index},1)">
                                <img id="output[${index}][1]" class="w-75"/>
                            </div>
                            <div class="col-lg-4">
                                <input type="file" class="form-control-file mb-2" accept="image/*" onchange="loadFile(event,${index}, 2)">
                                <img id="output[${index}][2]" class="w-75"/>

                            </div>
                            <div class="col-lg-4">
                                <input type="file" class="form-control-file mb-2" accept="image/*" onchange="loadFile(event,${index}, 3)">
                                <img id="output[${index}][3]" class="w-75"/>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="col-lg-1 text-right">
                    <button type="button" class="btn bg-navy deleteBtn mt-4 mr-4" onclick="delActivity(${index})"><i class="fa fa-trash-o"></i></button>
                </div>
                <hr/>
            </div>
            `;
            $('#sortable').append(content)
            activity_count++;
            $('select.select2').select2();

        };

        let delActivity = function delActivity(index) {
            let subject = document.getElementById(`activity[${index}]`)
            subject.remove()
            // $('#activity['+index+']').remove();
        };

    </script>

</body>

</html>