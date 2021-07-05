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


                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                            <label class="text-nowrap">年度： </label>
                                            <?php form_list_type('year_id', ['type' => 'select', 'class'=> 'form-control select2' , 'value' => $year_id, 'data-placeholder' => '請選擇...', 'enable_value' => $years_list, 'form_validation_rules' => 'trim|required']) ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success mt-25 w-100 mb-4 searchBtn">搜 尋</button>
                                    </div>

                                </div>

                                <button type="button" class="btn btn-info mw-100 mb-4" id="read-btn">複製上年度</button>
                                <button type="button" class="btn bg-orange mw-100 mb-4" onclick="location.href='<?= admin_url($page_setting['controller'].'/create')?>';">新 增</button>


                                <div class="tableWrap">
                                    <table class="table table-bordered table-striped w-100" id="mainTable">
                                        <thead>
                                            <tr class="bg-light-blue color-palette">
                                                <th class="no-sort" style="min-width: 4px;  max-width:15px"></th>
                                                <th class="nowrap">年度</th>
                                                <th class="nowrap">職位</th>
                                                <th class="nowrap">姓名</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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

            $(".searchBtn").click(function() {
                AnnualStaffTable.draw();
            });

            let AnnualStaffTable = $('#mainTable').DataTable({
                scrollX: true,
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/' . get_wlocale() . '.json') ?>"
                },
                "order": [],
                "bSort": false,
                "bPaginate": false,
                "pageLength": 50,
                "pagingType": "input",
                "columnDefs": [ {
                    "targets": 0,
                    "orderable": false
                } ] ,
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "searching": false,
                dom: "rtiS",
                deferRender: true,
                // "drawType": 'none',
                "searchDelay": 0,     
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        console.log('ajax')
                        let year_id = $('#year_id').val();

                        d.year_search = year_id;

                    },
                    "complete" : function(){
                        $('[data-toggle="tooltip"]').tooltip();

                    },
                    "error": function(e) {
                        alertify.error('error')
                    },
               
                },
            });

     

            // let arrayData = [{"id" : "0001", "username" : "admin", "name" : "管理員", "name_eng" : "", "name_short" : "Admin", "user_post" : "管理員" },{"id" : "0053", "username" : "teacher60", "name" : "盧思忍", "name_eng" : "", "name_short" : "盧", "user_post" : "教師" },{"id" : "0054", "username" : "teacher06", "name" : "李淑秋", "name_eng" : "", "name_short" : "秋", "user_post" : "校長" },{"id" : "0058", "username" : "teacher19", "name" : "梁祖偉", "name_eng" : "", "name_short" : "梁", "user_post" : "教師" },{"id" : "0059", "username" : "teacher20", "name" : "高家音", "name_eng" : "", "name_short" : "高", "user_post" : "教師" },{"id" : "0060", "username" : "teacher21", "name" : "黃永康", "name_eng" : "", "name_short" : "康", "user_post" : "副校長" },{"id" : "0061", "username" : "teacher22", "name" : "黎健佩", "name_eng" : "", "name_short" : "佩", "user_post" : "教師" },{"id" : "0063", "username" : "teacher25", "name" : "周潔靜", "name_eng" : "", "name_short" : "潔", "user_post" : "教師" },{"id" : "0066", "username" : "teacher32", "name" : "黃少文", "name_eng" : "", "name_short" : "文", "user_post" : "教師" },{"id" : "0067", "username" : "teacher38", "name" : "雷尚慈", "name_eng" : "", "name_short" : "慈", "user_post" : "教師" },{"id" : "0068", "username" : "teacher39", "name" : "文雪琴", "name_eng" : "", "name_short" : "琴", "user_post" : "教師" },{"id" : "0069", "username" : "teacher40", "name" : "吳穎琳", "name_eng" : "", "name_short" : "穎", "user_post" : "教師" },{"id" : "0070", "username" : "teacher41", "name" : "樊潔瑩", "name_eng" : "", "name_short" : "瑩", "user_post" : "教師" },{"id" : "0071", "username" : "teacher43", "name" : "陳敬峰", "name_eng" : "", "name_short" : "峰", "user_post" : "教師" },{"id" : "0072", "username" : "teacher44", "name" : "李文慧", "name_eng" : "", "name_short" : "慧", "user_post" : "教師" },{"id" : "0073", "username" : "teacher47", "name" : "杜健聰", "name_eng" : "", "name_short" : "聰", "user_post" : "教師" },{"id" : "0074", "username" : "teacher48", "name" : "麥穎怡", "name_eng" : "", "name_short" : "麥", "user_post" : "教師" },{"id" : "0076", "username" : "teacher59", "name" : "許世源", "name_eng" : "", "name_short" : "許", "user_post" : "教師" },{"id" : "0078", "username" : "Staff01", "name" : "馮細芳", "name_eng" : "", "name_short" : "馮", "user_post" : "專業人員" },{"id" : "0079", "username" : "Staff03", "name" : "劉麗韻", "name_eng" : "", "name_short" : "韻", "user_post" : "專業人員" },{"id" : "0081", "username" : "Staff18", "name" : "羅敏儀", "name_eng" : "", "name_short" : "儀", "user_post" : "專業人員" },{"id" : "0082", "username" : "Staff28", "name" : "李宗元", "name_eng" : "", "name_short" : "元", "user_post" : "專業人員" },{"id" : "0083", "username" : "Staff43", "name" : "何桂英", "name_eng" : "", "name_short" : "Yuki", "user_post" : "校務處職員" },{"id" : "0085", "username" : "Staff49", "name" : "丘廣蓮", "name_eng" : "", "name_short" : "丘", "user_post" : "專業人員" },{"id" : "0088", "username" : "Staff60", "name" : "何慧美", "name_eng" : "", "name_short" : "May", "user_post" : "助理" },{"id" : "0098", "username" : "teacher54", "name" : "劉嘉文", "name_eng" : "", "name_short" : "嘉", "user_post" : "教師" },{"id" : "0104", "username" : "teacher62", "name" : "陳慧海", "name_eng" : "", "name_short" : "海", "user_post" : "教師" },{"id" : "0107", "username" : "teacher65", "name" : "廖樞婷", "name_eng" : "", "name_short" : "婷", "user_post" : "教師" },{"id" : "0113", "username" : "staff85", "name" : "何詠欣", "name_eng" : "", "name_short" : "何", "user_post" : "專業人員" },{"id" : "0114", "username" : "teacher67", "name" : "卓子詢", "name_eng" : "churk", "name_short" : "卓", "user_post" : "教師" },{"id" : "0118", "username" : "teacher70", "name" : "鍾嘉雯", "name_eng" : "", "name_short" : "鍾", "user_post" : "教師" },{"id" : "0119", "username" : "teacher71", "name" : "陳詠思", "name_eng" : "", "name_short" : "思", "user_post" : "教師" },{"id" : "0120", "username" : "teacher72", "name" : "伍永翠", "name_eng" : "", "name_short" : "翠", "user_post" : "教師" },{"id" : "0121", "username" : "teacher73", "name" : "林志明", "name_eng" : "", "name_short" : "林", "user_post" : "教師" },{"id" : "0122", "username" : "teacher74", "name" : "黃健豪", "name_eng" : "", "name_short" : "豪", "user_post" : "教師" },{"id" : "0125", "username" : "teacher77", "name" : "蕭浩群", "name_eng" : "", "name_short" : "群", "user_post" : "教師" },{"id" : "0127", "username" : "staff99", "name" : "梁穎欣", "name_eng" : "", "name_short" : "欣", "user_post" : "專業人員" },{"id" : "0128", "username" : "staff98", "name" : "區瑞琛", "name_eng" : "", "name_short" : "區", "user_post" : "專業人員" },{"id" : "0129", "username" : "staff100", "name" : "何永恩", "name_eng" : "", "name_short" : "恩", "user_post" : "助理" },{"id" : "0131", "username" : "staff103", "name" : "盧雅欣", "name_eng" : "", "name_short" : "雅", "user_post" : "專業人員" },{"id" : "0133", "username" : "staff92", "name" : "陳煜霖", "name_eng" : "", "name_short" : "Tim", "user_post" : "助理" },{"id" : "0135", "username" : "Staff86", "name" : "黃惠敏", "name_eng" : "", "name_short" : "敏", "user_post" : "助理" },{"id" : "0137", "username" : "teacher79", "name" : "陳君盛", "name_eng" : "", "name_short" : "君", "user_post" : "教師" },{"id" : "0138", "username" : "teacher80", "name" : "蔡少君", "name_eng" : "", "name_short" : "蔡", "user_post" : "教師" },{"id" : "0141", "username" : "teacher83", "name" : "黃芷欣", "name_eng" : "", "name_short" : "芷", "user_post" : "教師" },{"id" : "0143", "username" : "staff68", "name" : "教育心理學家", "name_eng" : "", "name_short" : "EP", "user_post" : "專業人員" },{"id" : "0147", "username" : "teacher85", "name" : "岑晉琳", "name_eng" : "", "name_short" : "岑", "user_post" : "教師" },{"id" : "0148", "username" : "teacher86", "name" : "葉金枝", "name_eng" : "", "name_short" : "枝", "user_post" : "教師" },{"id" : "0149", "username" : "teacher87", "name" : "蔡佳怡", "name_eng" : "", "name_short" : "佳", "user_post" : "教師" },{"id" : "0150", "username" : "teacher88", "name" : "余昕寧", "name_eng" : "", "name_short" : "余", "user_post" : "教師" },{"id" : "0151", "username" : "teacher89", "name" : "蔡笑珊", "name_eng" : "", "name_short" : "珊", "user_post" : "教師" },{"id" : "0152", "username" : "teacher90", "name" : "陳秋媚", "name_eng" : "", "name_short" : "媚", "user_post" : "教師" },{"id" : "0153", "username" : "staff125", "name" : "張煱嫘", "name_eng" : "", "name_short" : "煱", "user_post" : "職業治療師" },{"id" : "0154", "username" : "staff120", "name" : "楊欣琪", "name_eng" : "", "name_short" : "琪", "user_post" : "校務處職員" },{"id" : "0155", "username" : "staff121", "name" : "朱俊民", "name_eng" : "", "name_short" : "朱", "user_post" : "校務處職員" },{"id" : "0156", "username" : "teacher16", "name" : "黃思溢", "name_eng" : "", "name_short" : "溢", "user_post" : "教師" }];
            let jsonData = {};
            // for (let i = 0; i < arrayData.length; i++) {
            //     jsonData[i] = arrayData[i];
            // }
            // console.log(arrayData);
            // console.log(jsonData)
            // let arraydata = jsondata.map(element => element.username):
            let readBtn = document.querySelector('#read-btn');
            readBtn.addEventListener("click",function(){
            createModule();
            function createModule(){
                $.ajax({
                url: '<?= (admin_url($page_setting['controller'])) . '/readAPI' ?>',
                method:'POST',
                data: jsonData,
                dataType:'json',     
                success:function(data){
                    console.log((data))
                },
                error: function(error){
                    alertify.error('error');
                    
                }
                });
            } 
            })

        });




    </script>

</body>

</html>