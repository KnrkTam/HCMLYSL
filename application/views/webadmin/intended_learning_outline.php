<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("head.php"); ?>
    <style>
        .big-col {
            width: 400px !important;
            position: relative;
        }
        .col {
            width: 50px;
            position: relative;

        }
        table {
            table-layout:fixed;
        } 
        .highlight{
            position:absolute;
            right: 5%;
            bottom: 5%;
        }
        span.select2-selection__choice__remove {
            display: none;
        }
        .select2-selection__choice__remove {
            display: none;
        }

        .showMoreBtn {
            cursor: pointer;
        }

        .moduleBox {
            overflow: hidden;
            display: flex;
            flex-direction: column;
            /* height: 60px; */
            align-items: baseline;
            justify-content: flex-start;
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
                        <div class="box box-primary">
                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>
                                <div class="row mb-4">
                                    <div class="col-lg-2">
                                        <div class="form-group ">
                                            <label class="text-nowrap"><span class="text-red">*</span>科目： </label>
                                            <div style="flex: 1"><?php form_list_type('subject_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_id,  'data-placeholder' => '請選擇...', 'enable_value' => $subject_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap"><span class="text-red">*</span>學習單元：</label>
                                            <div style="flex: 1"><?php form_list_type('annual_module_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $annual_module_id,  'data-placeholder' => '請選擇...', 'enable_value' => $modules_list, 'form_validation_rules' => 'trim|required']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">科目範疇:</label>
                                            <div style="flex: 1"><?php form_list_type('subject_category_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $subject_category_id, 'enable_value' => $subject_categories_list,  'data-placeholder' => '請選擇...', 'form_validation_rules' => 'trim|required']) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="text-nowrap">備註：</label>
                                            <div style="flex: 1"><?php form_list_type('remark_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $remark_id, 'enable_value' => $remarks_list, 'data-placeholder' => '請選擇...', 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>

                                </div>




                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller'].'/create')?>';">新增課程至年度學習單元 </button>


                                <div class="">
                                    <ul class="colorMapList inlinelist mb-4">
                                        <li class="text-aqua bold">非華語</li>
                                        <li class="text-green bold">新生入學評估</li>
                                    </ul>
                                    <table class="table table-bordered table-striped" id="mainTable">
                                    </table>
                                </div>


                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        <?= form_close() ?>
                        <div class="modal fade in" tabindex="-1" role="dialog" id="editDetail">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title bold"><span id="modal-title">Title</span> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button></h3>
                                    </div>
                                <div class="modal-body">

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-nowrap">學習單元： </label>
                                                <div style="flex: 1"><?php form_list_type('module_id[]', ['type' => 'select', 'class'=> 'select2 form-control' , 'value' =>'',  'enable_value' => $select_list, 'form_validation_rules' => 'trim|required', 'disable_please_select' => 1, 'multiple' => 1]) ?></div>
                                                <input type="text" class="form-control hidden"  id="modalId" value="">
                                                <input type="text" class="form-control hidden"  id="subjectLesson" value="">

                                            </div>
                                        </div>


                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="edit-btn" class="btn btn-primary">確 定</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                                </div>
                            </div>
                        </div>
                    </div>
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


            $(document).on("click", ".editLinkBtn", function () {
            let myId = $(this).data('id');
            let mySubject = $(this).data('subject');
            let mySubjectLesson = $(this).data('subject_lesson')
            let mySubjectCat = $(this).data('subject_cat');
            let myModule = $(this).data('modules');
            let myLesson = $(this).data('lesson');

            console.log(myModule);
            $(".modal-body #module_id").val(myModule).trigger('change');;
            $(".modal-body #subjectLesson").val( mySubjectLesson );
            // $(".modal-body #level_id").val( myLevel );
            $(".modal-body #modalId").val( myId );
            $(".modal-header #modal-title").html(mySubject+'   '+ mySubjectCat + '    ' +myLesson);

        });

        let editBtn = document.querySelector('#edit-btn');
        editBtn.addEventListener("click",function(){
            let module_arr = $('#module_id').val();
            editModule(module_arr, modalId.value, subjectLesson.value);
            function editModule(module_arr, id, subject_lesson_id){
                $.ajax({
                url: `<?= (admin_url($page_setting['controller'])) . '/edit/'?>${id}`,
                method:'POST',
                data:{module_arr: module_arr, id: id, subject_lesson_id:subject_lesson_id},
                dataType:'json',     
                success:function(data){
                    if (data.status == 'success') {
                        window.location.reload();
                    } else if (data.status == 'no_change') {
                        $('#editDetail').modal('hide');
                    }else {
                        alertify.error(data.status)
                    }
                },
                error: function(error){
                    alert('error');
                }
                });
            } 
        })


            $('[data-toggle="tooltip"]').tooltip();
            let columnDefs = [{
                    width: '10px',
                    data: "edit",
                    name: 'first',
                    class: 'no-sort noVis',
                },     
                {
                    width: '60px',
                    data: "subject",
                    title: "科目",
                    name: 'first',
                    buttons: [ 'columnsVisibility' ],
                    visibility: true
                },               
                {
                    class: 'col',
                    data: "subject_category",
                    title: "科目範疇",
                    name: 'first',
                },               
                {
                    class: 'col',
                    data: "lesson",
                    title: "課程編號",
                    name: 'first',
                },        
                // {
                //     class: 'col',
                //     data: "course",
                //     title: "課程",
                //     name: 'first',
                // },                
                // {
                //     class: 'col',
                //     data: "category",
                //     title: "範疇",
                //     name: 'first',
                // },                
                {
                    width: '120px',
                    data: "sb_obj",
                    title: "校本課程學習重點",
                    name: 'first',
                },                
                {
                    class: 'col',
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
                    render: function(data, type, row) {
                        let result = "";
                        let preview = "";
                        console.log(row.modules)
                        let modules_arr = row.modules.split("&nbsp");

                            for (i = 0; i < modules_arr.length; i++) {
                                result += '<button type="button" class="btn-xs btn btn-success badge">' + modules_arr[i] + '</button>';
                            }
                            for (i = 0; i < 3; i++) {
                                preview += '<button type="button" class="btn-xs btn btn-success badge">' + modules_arr[i] + '</button>';

                            }
                        if (modules_arr.length < 4) {
                            return result;
                        } else {
                            return  '<div class="previewBox">'+ preview + '</div>'+ '<div class="moduleBox" style="display: none">' +  result  + '</div><a class="small showMoreBtn"><i class="fa fa-fw fa-plus-square-o"></i><span>顥示更多</span></a>';
                            
                        }
                    },
                    name: 'first',
                    data: "modules",
                    title: "單元",
                    width: '100px',
                    
                },          
                {
                    class: 'big-col',
                    data: "performance",
                    title: "關鍵表現項目",
                    name: 'double',
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
                    data: "remarks",
                    title: "備註",
                    name: 'first',
                },              
            ];

          

            let mainTable = $('#mainTable').DataTable({
            rowsGroup: [
                'first:name',
            ],
            scrollX: true,
            "language": {
                "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
            },
            dom: 'Bfrtip',
            "buttons": [{
                extend: 'colvis',
                text: '選擇顯示項目',
                columns: ':not(.noVis)',
                columnText: function ( dt, idx, title ) {
                    return title;
                }
            }],
            "order": [],
            'autoWidth': false,
            "bSort": false,
            "info": false,
            "bPaginate": true,
            "pageLength": 5,
            "pagingType": "input",
            "bProcessing": true,
            "processing": true,
            "serverSide": true,
            'searching': false,
            "ordering": true,
            "columns": columnDefs,   
            "ajax": {
                "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
                "method": "get",
                "timeout": "30000",
                "data": function(d) {
                    let subject_id = $('#subject_id').val();
                    let category_id = $('#subject_category_id').val();
                    let module_id = $('#annual_module_id').val();
                    let remark_id = $('#remark_id').val();

                    d.subject_search = subject_id
                    d.category_search = category_id;
                    d.module_search = module_id;
                    d.remark_search = remark_id;
                },
                "complete" : function(){
                    $('[data-toggle="tooltip"]').tooltip();

                },
            },
            }); 


            // function ajax_choose(subject_id) {
            //     $.ajax({
            //     url: '<?= (admin_url($page_setting['controller'])) . '/select_subject' ?>',
            //     method:'POST',
            //     data:{subject_id:subject_id},
            //     dataType:'json',
            //     beforeSend:function(){
            //         $('#subject_category_id').empty();
            //         },
            //     success:function(d){
            //         $('#subject_category_id').select2({
            //             data: d
            //         });
            //         $('#subject_category_id').val(<?= $_POST['subject_category_id']?>)
            //         },
            //     })
            // }

            $(document).on("click", ".showMoreBtn", function() {
                $(this).parent().parent().find(".moduleBox").slideToggle('slow', function() {
                    $(this).parent().find(".showMoreBtn").toggleClass('active', $(this).is(':visible'));
                    $(this).parent().parent().find(".previewBox").remove();

                    if ($(this).parent().find(".showMoreBtn").hasClass("active")){
                        $(this).parent().find(".showMoreBtn span").text("隱藏");
                        $(this).parent().find(".showMoreBtn i").attr("class", "fa fa-fw fa-minus-square-o");
                    } else {
                        // $(this).parent().parent().find(".previewBox").show();
                        $(this).parent().find(".showMoreBtn span").text("顯示更多");
                        $(this).parent().find(".showMoreBtn i").attr("class", "fa fa-fw  fa-plus-square-o");
                    }
                })
            });

            let sub_cat_data =  <?php echo $subject_categories_list?>;

            $('#subject_category_id').select2({
                data: sub_cat_data
            });

            // $("#subject_id").change(function() {
            //     ajax_choose(this.value)
            // })


            $(".searchBtn").click(function() {
                mainTable.draw();

            });
        });
    
    </script>

</body>

</html>