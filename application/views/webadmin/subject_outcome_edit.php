<!DOCTYPE html>
<html lang="en">

<head>
<?php include_once("head.php"); ?>
<style>
    .removeRow {
        z-index: 5;
        opacity: 1;
        cursor: pointer;
    }

    .removeRow i {
        z-index: -1;
        opacity: 1;
        cursor: pointer;
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
                        <!-- general form elements
                    <input type="hidden" name="id" value="<?= $id ?>"/>-->
                        <div class="box box-primary">
                            <!-- <div class="box-header">
                            <div class="row col-md-2">
                                <div class="btn-group" data-spy="affix" data-offset-top="2" style="z-index: 20;">
                                    <a href="<?= admin_url($page_setting['controller']) ?>" class="btn btn-default">
                                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                        <?= __('Cancel') ?>
                                    </a>

                                    <?php if (validate_user_access(['create_news', 'update_news'])) { ?>
                                        <button type="button" class="btn btn-primary" onclick="submit_form(this);">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i> <?= __('Save') ?>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div> -->
                            <!-- /.box-header -->

                            <div class="box-body">
                                <div id="signupalert" class="alert alert-danger margin_bottom_20"></div>

                                <h5 class="text-red"><b>???????????????</b></h5>

                                <div class="row">

                                    <div class="col-lg-5 d-flex">

                                        <div class="form-group w-100">
                                            <h3 class="text-blue"><b><?= $subject?> - <?= $subject_category ?></b></h5>
                                        </div>
                                        <a href="#" class="link nowrap mt-30 ml-2 controlSearchBtn">????????????</a>
                                    </div>
                                </div>
                                <hr>
                                <!-- <div class="subject_outcomeNew"> -->
                                    <h5 class="text-red"><b>???????????????</b></h5>

                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="form-group ">
                                                <label class="text-nowrap">?????? : </label>
                                                <div style="flex: 1"><?php form_list_type('courses_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '?????????...', 'enable_value' => $courses_list, 'form_validation_rules' => 'trim|required']) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="text-nowrap">???????????? : </label>
                                                <div style="flex: 1"><?php form_list_type('categories_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '?????????...', 'enable_value' => $categories_list, 'form_validation_rules' => 'trim|required']) ?></div>                                               

                                            </div>
                                        </div>
                                        <div class="col-lg-6 d-flex align-items-start">


                                            <div class="form-group w-100">
                                                <label class="text-nowrap">???????????????????????? : (????????????) </label>
                                                <div style="flex: 1"><?php form_list_type('sb_obj_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '?????????...', 'enable_value' => $sb_obj_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>

                                            </div>
                                            <span class="ml-2 mr-2 mt-30">???</span>
                                            <div class="form-group w-100">
                                                <label class="text-nowrap">???????????? : (????????????) </label>
                                                <div style="flex: 1"><?php form_list_type('lesson_id[]', ['type' => 'select', 'class'=> 'form-control select2' , 'value' =>'',  'data-placeholder' => '?????????...', 'enable_value' => $lessons_list, 'form_validation_rules' => 'trim|required', 'multiple' => 1]) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">??? ???</button>
                                        </div>

                                    </div>
                                <!-- </div> -->

                                <div class="tableWrap">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="alert alert-info alert-dismissible fade in" role="alert" id="alert-add-item" style="display:none">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">??</span></button>
                                                <p> ????????? <strong id="item-count"></strong> ?????????</p>
                                            </div>
                                            <h5 class="text-purple"><b>???????????????</b></h5>

                                            <table class="table table-bordered table-striped" id="subjectTable">
                                                <!-- <thead>
                                                    <tr class="bg-light-blue color-palette">
                                                        <th class="no-sort"></th>
                                                        <th class="nowrap">??????</th>
                                                        <th class="nowrap">??????</th>
                                                        <th class="nowrap">????????????????????????</th>
                                                        <th class="nowrap">????????????????????????</th>
                                                        <th class="nowrap">????????????</th>
                                                        <th class="nowrap">??????</th>
                                                        <th class="nowrap">LPF(??????)</th>
                                                        <th class="nowrap">LPF(??????) P</th>
                                                        <th class="nowrap">POAS</th>
                                                        <th class="nowrap">Key Skill</th>
                                                        <th class="nowrap">????????????</th>
                                                        <th class="nowrap">??????????????????</th>
                                                        <th class="nowrap">????????????</th>
                                                        <th class="nowrap">??????????????????</th>
                                                    </tr>
                                                </thead> -->
                                                <tbody>
                                                </tbody>
                                            </table>
                                         
                                            <hr>
                                        </div>
                                        <div class="col-lg-12">
                                            <h5 class="text-yellow"><b>???????????????</b></h5>
                                            <table class="table table-bordered table-striped" id="subjectSelectedTable">
                                                <!-- <thead>
                                                    <tr class="bg-light-blue color-palette">
                                                        <th class="no-sort" style="min-width: 10px;"></th>
                                                        <th class="nowrap">??????</th>
                                                        <th class="nowrap">??????</th>
                                                        <th class="nowrap">????????????????????????</th>
                                                        <th class="nowrap">????????????????????????</th>
                                                        <th class="nowrap">????????????</th>
                                                        <th class="nowrap">??????</th>
                                                        <th class="nowrap">LPF(??????)</th>
                                                        <th class="nowrap">LPF(??????) </th>
                                                        <th class="nowrap">POAS</th>
                                                        <th class="nowrap">Key Skill</th>
                                                        <th class="nowrap">????????????</th>
                                                        <th class="nowrap">??????????????????</th>
                                                        <th class="nowrap">????????????</th>
                                                        <th class="nowrap">??????????????????</th>
                                                    </tr>
                                                </thead> -->
                                                <tbody>
                                                    <script>
                                                                

                                                    </script>
                                                </tbody>
                                            </table> 

                                            <div class="mt-4 d-flex justify-content-end">
                                                <input type="hidden" id="subject_lessons" name="subject_lessons[]" value=""></input>
                                                <input type="hidden" value=<?= $function?> name="action"> </input>
                                                <button type="submit" class="btn bg-maroon mw-100 mr-4">?????????</button>
                                                <button type="button" class="btn btn-default mw-100" onclick="location.href='<?= $return ?>';">??? ???</button>
                                            </div>
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

        <?php include_once("footer.php"); ?>

    </div>
    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>





    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();


            $(".searchBtn").click(function() {
                SubjectTable.draw();
            });

            let added_ids = new Set();

            <?php if ($_SESSION['post_data']){ ?>
                let session_data = <?= json_encode($_SESSION['post_data'])?>;
                for (i = 0; i < session_data['added_ids'].length; i++) {
                    added_ids.add(parseInt(session_data['added_ids'][i]));
                };

            <?} else {?>   
                let added_arr = <?= json_encode($added_ids);?>;
                for (i = 0; i < added_arr.length; i++) {
                    added_ids.add(parseInt(added_arr[i]));
                };
            <? } ?>

            $('input[id=subject_lessons]').val(Array.from(added_ids));
            let columnDefs = [{
                width: '10px',
                data: "edit",
                name: 'first',
                class: 'no-sort',
            },   
            {
                class: 'col',
                data: "course",
                title: "??????",
                name: 'first',
            },       
            {
                width: '60px',
                data: "category",
                title: "????????????",
                name: 'first',
            },                       
            {
                class: 'col',
                data: "sb_obj",
                title: "????????????????????????",
                name: 'first',
            },        
            {
                width: '100px',
                data: "element",
                title: "????????????",
                name: 'first',
            },              
            {
                class: 'col',
                data: "groups",
                title: "??????",
                name: 'first',
            },                
            {
                class: 'big-col',
                data: "expected_outcome",
                title: "??????????????????",
                name: 'first',
            },        
            {
                class: 'col',
                data: "pre-skills",
                title: "????????????",
                name: 'first',

            },  
            {
                class: 'col',
                data: "lpf_basic",
                title: "LPF(??????)",
                name: 'first',
            },                
            {
                class: 'col',
                data: "lpf_advanced",
                title: "LPF(??????)",
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
                title: "??????????????????",
                name: 'first',
            },              
        ];

            let  SubjectTable = $('#subjectTable').DataTable({
                // scrollY: '300px',
                scrollX: true,
                "language": {
                   "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bInfo": true,
                // "bSort": false,
                "bPaginate": true,
                // "paging": true,
                "pageLength": 10,
                // "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
                // "pagingType": "simple",
                "columns": columnDefs,   
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "searchDelay": 0,
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/search_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        let course_id = $('#courses_id').val();
                        let category_id = $('#categories_id').val();
                        let sb_obj_id = $('#sb_obj_id').val();
                        let lesson_id = $('#lesson_id').val();
                        let subject_id = $('#subject_id').val();

                        d.course_search = course_id;
                        d.category_search = category_id;
                        d.sb_obj_search = sb_obj_id;
                        d.lesson_search = lesson_id;
                        d.subject_search = subject_id;
            
                    },
                    "complete": function(e){
                        $('[data-toggle="tooltip"]').tooltip();

                        $(".addLesson").change(function(e) {
                            if ($(this).is(':checked')) {
                                added_ids.add(parseInt(this.value))
                                subjectSelectedTable.draw();
                            } else {
                                added_ids.delete(parseInt(this.value));
                                subjectSelectedTable.draw();
                            }
                        });
                        let old_arr = Array.from(added_ids)
                        for (let i = 0; i < old_arr.length; i++) {
                            $(`input[type=checkbox][class=addLesson][value=${old_arr[i]}]`).prop('checked', true)
                        }

                        $(".removeRow").click(function() {
                            added_ids.delete(parseInt(this.attributes.value.value));
                            subjectSelectedTable.draw();
                            SubjectTable.draw();
                        });
                        $('input[id=subject_lessons]').val(Array.from(added_ids));

                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });





                let subjectSelectedTable = $('#subjectSelectedTable').DataTable({
                scrollX: true,
                "language": {
                   "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/Chinese-traditional.json') ?>",
                },
                "order": [],
                "bSort": false,
                "pageLength": 50,
                "pagingType": "input",
                //"sDom": '<"wrapper"lfptip>',
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                "searchDelay": 0, 
                "bPaginate": false,
                "bAutoWidth": false,
                "columns": columnDefs,   

                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/select_ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        d.added_ids = Array.from(added_ids)
                    },
                    "complete": function(e){
                        $(".addLesson").change(function() {
                            if ($(this).is(':checked')) {
                                added_ids.add(parseInt(this.value))
                                // console.log(Array.from(added_ids));
                            } else {
                                added_ids.delete(parseInt(this.value))
                                // console.log(Array.from(added_ids));
                            }
                        });

                        
                        $(".removeRow").click(function() {
                            added_ids.delete(parseInt(this.attributes.value.value));
                            console.log(Array.from(added_ids))
                            subjectSelectedTable.draw();
                            SubjectTable.draw();

                        });
                        $('input[id=subject_lessons]').val(Array.from(added_ids));
                        show_status()

                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });


            function show_status() {
                let count = added_ids.size;
                $('#item-count').html(count);
                $('#alert-add-item').fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
            }


            function ajax_choose(subject_id) {
                $.ajax({
                    url: '<?= (admin_url($page_setting['controller'])) . '/select_subject' ?>',
                    method:'POST',
                    data:{subject_id:subject_id},
                    dataType:'json',
                    beforeSend:function(){
                        $('#sub_category_id').empty();
                    },
                    success:function(d){
                        $('#sub_category_id').select2({
                            data: d
                        });
                    },
                })
            }

            $("#subject_id").change(function() {
                ajax_choose(this.value)
            })
        });



    </script>

</body>

</html>