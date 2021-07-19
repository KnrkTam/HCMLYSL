<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("head.php"); ?>

<style>

    .nav-toggle-icon {
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

                                <ul class="colorMapList inlinelist">
                                    <li class="text-red bold">課程</li>
                                    <li class="text-green bold">範疇</li>
                                    <li class="text-maroon bold">校本課程學習重點</li>
                                    <li class="text-purple bold">預期學習成果</li>
                                    <li class="text-orange bold">關鍵表現項目</li>
                                </ul>


                                <div class="mt-4 mb-4"><a class="link showAllBtn" href="#">全部展開</a> |　<a class="link hideAllBtn" href="#">全部隱藏</a> </div>
                            <?php foreach ($courses as $i => $course) { ?>
                                <ul class="nav nav-list-main">
                                    <li><label class="nav-toggle nav-header"><span class="nav-toggle-icon text-red mr-2"><i class="fa fa-fw fa-plus-square-o"></i> <?= $course->name?></span> <a class="link" href="#" data-toggle="modal" data-target="#newCategory">新增</a> | <a class="link" href="#" data-toggle="modal" data-target="#editCategory">修改範疇</a></label>
                                    <?php foreach ($course->cat as $j => $category) { ?>
                                        <ul class="nav nav-list nav-left-ml">
                                            <li><label class="nav-toggle nav-header"><span class="nav-toggle-icon text-green mr-2"><i class="fa fa-fw fa-plus-square-o"></i><?= $category->name?></span> <a class="link" href="#" data-toggle="modal" data-target="#newStudyPoint">新增</a> | <a class="link" href="#" data-toggle="modal" data-target="#editStudyPoint">修改校本課程學習重點</a></label>
                                            <?php foreach (Lessons_model::where('category_id', $category->id)->get() as $row) {?>
                                                <ul class="nav nav-list nav-left-ml">
                                                    <li><label class="nav-toggle nav-header"><span class="nav-toggle-icon text-maroon mr-2"><i class="fa fa-fw fa-plus-square-o"></i> <?= Sb_obj_model::name($row->sb_obj_id)?></span> <a class="link" href="#" data-toggle="modal" data-target="#newStudyResults">新增</a> | <a class="link" href="#" data-toggle="modal" data-target="#editStudyResults">修改預期學習成果</a></label>
                                                    <?php foreach (Lessons_model::where('course_id', $i)->where('category_id', $j)->get() as $row) {?>

                                                        <ul class="nav nav-list nav-left-ml">
                                                            <li><label class="nav-toggle nav-header"><span class="nav-toggle-icon text-purple mr-2"><i class="fa fa-fw fa-plus-square-o"></i> [初組] 能注意活動及作出反應</span> <a class="link" href="#" data-toggle="modal" data-target="#keyPerformance">新增/修改關鍵表現</a></label>
                                                                <ul class="nav nav-list nav-left-ml lastList">
                                                                    <li class="text-orange">對物件產生興趣，嘗試用不同的方法探索物件(如:拿起數粒、排列物件等)
                                                                    </li>
                                                                    <li class="text-orange">察覺物件的用途(如: 會對不同形狀的物件有反應、按口號作踏步動作等)</li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    <? } ?>
                                                    </li>
                                                </ul>
                                            <? } ?>
                                            </li>
                                        </ul>
                                    <? } ?>
                                    </li>
                                </ul>
                                <hr>
                            <? } ?>
                                

                                <!-- <ul class="nav nav-list-main">
                                    <li><label class="nav-toggle nav-header"><span class="nav-toggle-icon text-red mr-2"><i class="fa fa-fw fa-plus-square-o"></i> 語文</span> <a class="link" href="#" data-toggle="modal" data-target="#newCategory">新增</a> | <a class="link" href="#" data-toggle="modal" data-target="#editCategory">修改範疇</a></label>
                                        <ul class="nav nav-list nav-left-ml">
                                            <li><label class="nav-toggle nav-header"><span class="nav-toggle-icon text-green mr-2"><i class="fa fa-fw fa-plus-square-o"></i> 聆聽</span> <a class="link" href="#" data-toggle="modal" data-target="#newStudyPoint">新增</a> | <a class="link" href="#" data-toggle="modal" data-target="#editStudyPoint">修改校本課程學習重點</a></label>
                                                <ul class="nav nav-list nav-left-ml">
                                                    <li><label class="nav-toggle nav-header"><span class="nav-toggle-icon text-maroon mr-2"><i class="fa fa-fw fa-plus-square-o"></i> 聽力訓練</span> <a class="link" href="#" data-toggle="modal" data-target="#newStudyResults">新增</a> | <a class="link" href="#" data-toggle="modal" data-target="#editStudyResults">修改預期學習成果</a></label>
                                                        <ul class="nav nav-list nav-left-ml">
                                                            <li><label class="nav-toggle nav-header"><span class="nav-toggle-icon text-purple mr-2"><i class="fa fa-fw fa-plus-square-o"></i> [初組] 能注意活動及作出反應</span> <a class="link" href="#" data-toggle="modal" data-target="#keyPerformance">新增/修改關鍵表現</a></label>
                                                                <ul class="nav nav-list nav-left-ml lastList">
                                                                    <li class="text-orange">對物件產生興趣，嘗試用不同的方法探索物件(如:拿起數粒、排列物件等)
                                                                    </li>
                                                                    <li class="text-orange">察覺物件的用途(如: 會對不同形狀的物件有反應、按口號作踏步動作等)</li>
                                                                </ul>
                                                            </li>

                                                        </ul>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul> -->



                                <hr>
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




        <div class="modal fade in" tabindex="-1" role="dialog" id="classNumber">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"><b>搜尋課程編號</b> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-3">
                                <div class="form-group">

                                    <select class="form-control">
                                        <option value="" hidden>選擇課程</option>
                                        <option value="語文">語文</option>
                                        <option value="音">音</option>
                                        <option value="科技">科技</option>
                                        <option value="STEM">STEM</option>
                                    </select>
                                </div>


                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">

                                    <select class="form-control">
                                        <option value="" hidden>選擇範疇</option>
                                        <option value="語文">語文</option>
                                        <option value="音">音</option>
                                        <option value="科技">科技</option>
                                        <option value="STEM">STEM</option>
                                    </select>
                                </div>


                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">

                                    <select class="form-control">
                                        <option value="" hidden>校本課程學習重點</option>
                                        <option value="語文">語文</option>
                                        <option value="音">音</option>
                                        <option value="科技">科技</option>
                                        <option value="STEM">STEM</option>
                                    </select>
                                </div>


                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-success  mb-4">搜 尋</button>
                            </div>
                        </div>
                        <div class="">
                            <table class="table table-bordered table-striped width100p" id="searchCourseNumberTable">
                                <thead>
                                    <tr class="bg-light-blue color-palette">
                                        <th class="no-sort"></th>
                                        <th class="nowrap">課程</th>
                                        <th class="nowrap">範疇</th>
                                        <th class="nowrap">中央課程學習重點</th>
                                        <th class="nowrap">校本課程學習重點</th>
                                        <th class="nowrap">學習元素</th>
                                        <th class="nowrap">組別</th>
                                        <th class="nowrap">LPF(基礎)</th>
                                        <th class="nowrap">LPF(高中)</th>
                                        <th class="nowrap">POAS</th>
                                        <th class="nowrap">Key Skill</th>
                                        <th class="nowrap">預期學習成果</th>
                                        <th class="nowrap">課程編號</th>
                                        <th class="nowrap">相關課程編號</th>
                                        <th class="nowrap">相關項目編號</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" name="searchCourseNumberCheck" class="searchCourseNumberCheck" /></td>
                                        <td>語文</td>
                                        <td>聆聽</td>
                                        <td>聽力訓練</td>
                                        <td>聽力訓練</td>
                                        <td>技能</td>
                                        <td>初組、中組</td>
                                        <td>I2</td>
                                        <td>I2</td>
                                        <td class="nowrap">IB.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                        <td class="nowrap">IC.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>

                                        <td>能注意聲音的來源，對聲音作出反應</td>
                                        <td class="courseNum">MN0155</td>
                                        <td>MN0449,MS0002</td>

                                        <td></td>
                                    </tr>
                                    <tr>

                                        <td><input type="checkbox" name="searchCourseNumberCheck" class="searchCourseNumberCheck" /></td>
                                        <td>語文</td>
                                        <td>聆聽</td>
                                        <td>聽力訓練</td>
                                        <td>聽力訓練</td>
                                        <td>技能</td>
                                        <td>初組、中組</td>
                                        <td>I2</td>
                                        <td>I2</td>
                                        <td class="nowrap">IB.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                        <td class="nowrap">IC.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                        <td>能注意聲音的來源，對聲音作出反應</td>
                                        <td class="courseNum">MN0157</td>
                                        <td>MN0449,MS0002</td>

                                        <td></td>
                                    </tr>
                                    <tr>

                                        <td><input type="checkbox" name="searchCourseNumberCheck" class="searchCourseNumberCheck" /></td>
                                        <td>語文</td>
                                        <td>聆聽</td>
                                        <td>聽力訓練</td>
                                        <td>聽力訓練</td>
                                        <td>技能</td>
                                        <td>初組、中組</td>
                                        <td>I2</td>
                                        <td>I2</td>
                                        <td class="nowrap">IB.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>
                                        <td class="nowrap">IC.3 <span data-toggle="tooltip" title="Hooray!"><i class="fa fa-info-circle"></i></span></td>

                                        <td>能注意聲音的來源，對聲音作出反應</td>
                                        <td class="courseNum">MN0156</td>
                                        <td>MN0449,MS0002</td>

                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary comfirmSelectCourseNumber">選擇課程編號</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade in" tabindex="-1" role="dialog" id="editCategory">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">校本課程及科目課程大綱 - 新增校本課程學習重點 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">


                        <div class="row mb-4">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>課程： </label>
                                    <input type="text" class="form-control" placeholder="" value="語文" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>範疇： </label>
                                    <select class="form-control" disabled>
                                        <option value="" hidden>請選擇</option>
                                        <option value="聆聽" selected>聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                    </select>
                                </div>
                            </div>




                        </div>
                        <p class="text-red">**課程、範疇,不能重覆</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">確 定</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" tabindex="-1" role="dialog" id="newCategory">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">校本課程及科目課程大綱 - 新增範疇 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">


                        <div class="row mb-4">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>課程： </label>
                                    <input type="text" class="form-control" placeholder="" value="語文" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>範疇： </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <p class="text-red">**課程、範疇 不能重覆</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-orange ">新 增</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" tabindex="-1" role="dialog" id="newStudyPoint">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">校本課程及科目課程大綱 - 修改範疇 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">


                        <div class="row mb-4">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>課程： </label>
                                    <input type="text" class="form-control" placeholder="" value="語文" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>範疇： </label>
                                    <select class="form-control" disabled>
                                        <option value="" hidden>請選擇</option>
                                        <option value="聆聽" selected>聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>中央課程學習重點： </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="聽力訓練">聽力訓練</option>
                                        <option value="聽力訓練">聽力訓練</option>
                                        <option value="聽力訓練">聽力訓練</option>
                                        <option value="聽力訓練">聽力訓練</option>
                                        <option value="聽力訓練">聽力訓練</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>校本課程學習重點： </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="聽力訓練">聽力訓練</option>
                                        <option value="聽力訓練">聽力訓練</option>
                                        <option value="聽力訓練">聽力訓練</option>
                                        <option value="聽力訓練">聽力訓練</option>
                                        <option value="聽力訓練">聽力訓練</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <p class="text-red">**課程、範疇、中央課程學習重點、校本課程學習重點 不能重覆</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-orange ">新 增</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" tabindex="-1" role="dialog" id="editStudyPoint">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">校本課程及科目課程大綱 - 修改校本課程學習重點 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">


                        <div class="row mb-4">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>課程： </label>
                                    <input type="text" class="form-control" placeholder="" value="語文" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>範疇： </label>
                                    <select class="form-control" disabled>
                                        <option value="" hidden>請選擇</option>
                                        <option value="聆聽" selected>聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>中央課程學習重點： </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="聆聽" selected>聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                        <option value="聆聽">聆聽</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>*校本課程學習重點： </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="意識數學活動" selected>意識數學活動</option>
                                        <option value="意識數學活動">意識數學活動</option>
                                        <option value="意識數學活動">意識數學活動</option>
                                        <option value="意識數學活動">意識數學活動</option>
                                        <option value="意識數學活動">意識數學活動</option>
                                    </select>
                                </div>
                            </div>



                        </div>
                        <p class="text-red">**課程、範疇、中央課程學習重點、校本課程學習重點,不能重覆</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">確 定</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" tabindex="-1" role="dialog" id="newStudyResults">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">校本課程及科目課程大綱 - 新增預期學習成果 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">


                        <button type="button" class="btn mw-100 btn-default mb-4" onclick="location.href='../webadmin/Bk_course_outline';">返回校本課程大綱</button>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>課程： </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="語文">語文</option>
                                        <option value="音">音</option>
                                        <option value="科技">科技</option>
                                        <option value="STEM">STEM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>範疇：
                                    </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="聆聽">聆聽</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>課程編號： <span class="text-red small">*課程編號不能重覆</span></label>
                                    <input type="text" class="form-control" placeholder="請輸入...">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>中央課程學習重點： </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="聽力訓練">聽力訓練</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>校本課程學習重點：
                                    </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="聆聽">聽力訓練</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>相關課程編號： <a class="link small searchClassNumBtn" href="#" data-toggle="modal" data-target="#classNumber">搜尋編號</a></label>
                                    <input type="text" class="form-control inputCourseNumber" placeholder="e.g.: #SC557, #BD003" Disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <p class="mb-4 bold"> <span class="text-red">*</span>學習元素：</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="study" value="知識" id="knowledge">
                                    <label class="form-check-label" for="knowledge">知識</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="study" value="技能" id="skill">
                                    <label class="form-check-label" for="skill">技能</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="study" value="態度" id="attitude">
                                    <label class="form-check-label" for="attitude">態度</label>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <p class="mb-4 bold"> <span class="text-red">*</span>組別：</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="初組" id="lowLevel">
                                    <label class="form-check-label" for="lowLevel">初組</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="中組" id="middleLevel">
                                    <label class="form-check-label" for="middleLevel">中組</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="高組" id="heightLevel">
                                    <label class="form-check-label" for="heightLevel">高組</label>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap">相關項目編號： </label>
                                    <input type="text" class="form-control" placeholder="自訂輸入">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>LPF(基礎) <small>(2 層分類, 單項選擇)</small></label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="I2">I2</option>
                                        <option value="I3">I3</option>
                                        <option value="I4">I4</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>LPF(基礎) <small>(2 層分類, 單項選擇)</small></label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="I2">I2</option>
                                        <option value="I3">I3</option>
                                        <option value="I4">I4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>POAS： <small>(2 層分類, 單項選擇)</small></label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="IC.3">IC.3</option>
                                        <option value="IC.3">IC.3</option>
                                        <option value="IC.3">IC.3</option>
                                        <option value="IC.3">IC.3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex">
                                <div class="form-group w-100">
                                    <label class="text-nowrap">Key Skills <small>(2 層分類,可多項選擇)</small> </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="IC.3">IC.3</option>
                                        <option value="IC.3">IC.3</option>
                                        <option value="IC.3">IC.3</option>
                                        <option value="IC.3">IC.3</option>
                                    </select>
                                </div>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="checkbox" value="前備技能" id="frontSkill">
                                    <label class="form-check-label text-nowrap" for="frontSkill">前備技能</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="bold"><span class="text-red">*</span>預期學習成果：</label>
                                    <textarea class="form-control" rows="3" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                        <p class="text-red">**課程編號,不能重覆</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-orange ">新 增</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" tabindex="-1" role="dialog" id="editStudyResults">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">校本課程及科目課程大綱 - 修改預期學習成果 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">


                        <button type="button" class="btn mw-100 btn-default mb-4" onclick="location.href='../webadmin/Bk_master_lesson_outline';">返回校本課程大綱</button>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>課程： </label>
                                    <select class="form-control" disabled>
                                        <option value="" hidden>請選擇</option>
                                        <option value="語文" selected>語文</option>
                                        <option value="音">音</option>
                                        <option value="科技">科技</option>
                                        <option value="STEM">STEM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>範疇：
                                    </label>
                                    <select class="form-control" disabled>
                                        <option value="" hidden>請選擇</option>
                                        <option value="聆聽" selected>聆聽</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>課程編號： <span class="text-red small">*課程編號不能重覆</span></label>
                                    <input type="text" class="form-control" placeholder="請輸入...">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>中央課程學習重點： </label>
                                    <select class="form-control" disabled>
                                        <option value="" hidden>請選擇</option>
                                        <option value="聽力訓練" selected>聽力訓練</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>校本課程學習重點：
                                    </label>
                                    <select class="form-control" disabled>
                                        <option value="" hidden>請選擇</option>
                                        <option value="聆聽" selected>聽力訓練</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>相關課程編號： <a class="link small searchClassNumBtn" href="#" data-toggle="modal" data-target="#classNumber">搜尋編號</a></label>
                                    <input type="text" class="form-control inputCourseNumber" value="MN0155" Disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <p class="mb-4 bold"> <span class="text-red">*</span>學習元素：</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="study" checked value="知識" id="knowledge">
                                    <label class="form-check-label" for="knowledge">知識</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="study" value="技能" id="skill">
                                    <label class="form-check-label" for="skill">技能</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="study" value="態度" id="attitude">
                                    <label class="form-check-label" for="attitude">態度</label>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <p class="mb-4 bold"> <span class="text-red">*</span>組別：</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" checked value="初組" id="lowLevel">
                                    <label class="form-check-label" for="lowLevel">初組</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="中組" id="middleLevel">
                                    <label class="form-check-label" for="middleLevel">中組</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="高組" id="heightLevel">
                                    <label class="form-check-label" for="heightLevel">高組</label>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap">相關項目編號： </label>
                                    <input type="text" class="form-control" value="MN0449, MS0002">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>LPF(基礎) <small>(2 層分類, 單項選擇)</small></label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="I2" selected>I2</option>
                                        <option value="I3">I3</option>
                                        <option value="I4">I4</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>LPF(基礎) <small>(2 層分類, 單項選擇)</small></label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="I2">I2</option>
                                        <option value="I3" selected>I3</option>
                                        <option value="I4">I4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>POAS： <small>(2 層分類, 單項選擇)</small></label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="IC.3">IC.3</option>
                                        <option value="IC.3" selected>IC.3</option>
                                        <option value="IC.3">IC.3</option>
                                        <option value="IC.3">IC.3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex">
                                <div class="form-group w-100">
                                    <label class="text-nowrap">Key Skills <small>(2 層分類,可多項選擇)</small> </label>
                                    <select class="form-control">
                                        <option value="" hidden>請選擇</option>
                                        <option value="IC.3">IC.3</option>
                                        <option value="IC.3" selected>IC.3</option>
                                        <option value="IC.3">IC.3</option>
                                        <option value="IC.3">IC.3</option>
                                    </select>
                                </div>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="checkbox" checked value="前備技能" id="frontSkill">
                                    <label class="form-check-label text-nowrap" for="frontSkill">前備技能</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="bold"><span class="text-red">*</span>預期學習成果：</label>
                                    <textarea class="form-control" rows="3" placeholder="">能注意聲音的來源，對聲音作出反應</textarea>
                                </div>
                            </div>
                        </div>
                        <p class="text-red">**課程編號,不能重覆</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">確 定</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" tabindex="-1" role="dialog" id="keyPerformance">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title bold">校本課程及科目課程大綱 - 新增/修改關鍵表現 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h3>

                    </div>
                    <div class="modal-body">


                        <button type="button" class="btn mw-100 btn-default mb-4" onclick="location.href='../webadmin/Bk_course_outline';">返回校本課程大綱</button>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>課程： </label>
                                    <p>語文</p>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>範疇：
                                    </label>
                                    <p>聆聽</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>課程編號： <span class="text-red small">*課程編號不能重覆</span></label>
                                    <p>MN0155</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-nowrap"><span class="text-red">*</span>中央課程學習重點： </label>
                                    <p>聽力訓練</p>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="bold"><span class="text-red">*</span>預期學習成果：</label>
                                    <p>能注意聲音的來源，對聲音作出反應</p>

                                </div>
                            </div>
                        </div>
                        <div class="row d-flex list-row-header mb-2">
                            <div class="col-4 bold">
                                關鍵表現編號：
                            </div>
                            <div class="col-8 bold">
                                關鍵表現項目：
                            </div>
                        </div>

                        <div class="list list-row card" id="sortable" data-sortable-id="0" aria-dropeffect="move">
                            <div class="list-item" data-id="1" data-item-sortable-id="0" draggable="true" role="option" aria-grabbed="false">


                                <div class="mb-3 row d-flex">

                                    <div class="form-group col-4 mb-0 d-flex align-items-center">
                                        <span class="movePoint"><i class="fa fa-fw fa-hand-stop-o mr-2"></i></span>
                                        <input type="text" class="form-control" value="MN0155-01">
                                    </div>

                                    <div class="col-8 d-flex">
                                        <input type="text" class="form-control mr-2" value=" 有意識地留意及回應聲音 (1)">
                                        <button type="button" class="btn bg-navy deleteBtn" disabled><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="list-item" data-id="2" data-item-sortable-id="0" draggable="true" role="option" aria-grabbed="false">


                                <div class="mb-3 row d-flex">

                                    <div class="form-group col-4 mb-0 d-flex align-items-center">
                                        <span class="movePoint"><i class="fa fa-fw fa-hand-stop-o mr-2"></i></span>
                                        <input type="text" class="form-control" value="MN0155-01">
                                    </div>

                                    <div class="col-8 d-flex">
                                        <input type="text" class="form-control mr-2" value=" 有意識地留意及回應聲音 (2)">
                                        <button type="button" class="btn bg-navy deleteBtn"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="list-item" data-id="3" data-item-sortable-id="0" draggable="true" role="option" aria-grabbed="false">

                                <div class="mb-3 row d-flex">

                                    <div class="form-group col-4 mb-0 d-flex align-items-center">
                                        <span class="movePoint"><i class="fa fa-fw fa-hand-stop-o mr-2"></i></span>
                                        <input type="text" class="form-control" value="MN0155-01">
                                    </div>

                                    <div class="col-8 d-flex">
                                        <input type="text" class="form-control mr-2" value=" 有意識地留意及回應聲音 (3)">
                                        <button type="button" class="btn bg-navy deleteBtn"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="list-item" data-id="4" data-item-sortable-id="0" draggable="true" role="option" aria-grabbed="false">

                                <div class="mb-3 row d-flex">

                                    <div class="form-group col-4 mb-0 d-flex align-items-center">
                                        <span class="movePoint"><i class="fa fa-fw fa-hand-stop-o mr-2"></i></span>
                                        <input type="text" class="form-control" value="MN0155-01">
                                    </div>

                                    <div class="col-8 d-flex">
                                        <input type="text" class="form-control mr-2" value=" 有意識地留意及回應聲音 (1)">
                                        <button type="button" class="btn bg-navy deleteBtn"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="button" class="btn btn-info addBtn"><i class="fa fa-fw fa-plus"></i>增加一欄</button>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"> 確 定 </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關 閉</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->
    <?php include_once("script.php"); ?>
    <script>
        $(document).ready(function() {
            $("#sortable").sortable();
            $("#sortable").disableSelection();
        });
        $('ul.nav-left-ml').toggle();
        $('label.nav-toggle span').click(function() {
            $(this).parent().parent().children('ul.nav-left-ml').toggle(300);
            let cs = $(this).children('i').attr("class");
            console.log(this)

            if (cs == 'fa fa-fw fa-plus-square-o') {
                $(this).children('i').removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
            }
            if (cs == 'fa fa-fw fa-minus-square-o') {
                $(this).children('i').removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
            }
        });


        $('.showAllBtn').click(function() {
            $(".nav-list").slideDown();
            $(".nav-list-main i").attr("class", "fa fa-fw fa-minus-square-o");
        });
        $('.hideAllBtn').click(function() {
            $(".nav-list").slideUp();
            $(".nav-list-main i").attr("class", "fa fa-fw fa-plus-square-o");
        });


        // $('#searchCourseNumberTable').DataTable({
        //     scrollX: true,
        //     scrollCollapse: true,
        //     bFilter: false,
        //     bInfo: true,
        //     bLengthChange: false,
        //     columnDefs: [{
        //         targets: 'no-sort',
        //         orderable: false,
        //         width: 100
        //     }]

        // });

        $(".searchClassNumBtn").click(function() {

            $('#newStudyResults').modal('hide');

        });

        var countRow = $(".list-item").data("id");
        $('.addBtn').click(function() {
            countRow++;
            $('#sortable:last').before('<div class="list-item" data-id="' + countRow + '" data-item-sortable-id="0" draggable="true" role="option" aria-grabbed="false"><div class="mb-3 row d-flex"><div class="form-group col-4 mb-0 d-flex align-items-center"><span class="movePoint"><i class="fa fa-fw fa-hand-stop-o mr-2"></i></span><input type="text" class="form-control" value=""></div><div class="col-8 d-flex"><input type="text" class="form-control mr-2" value=""><button type="button" class="btn bg-navy deleteBtn"><i class="fa fa-trash-o"></i></button></div></div></div>');
        });

        // remove row
        $(document).on('click', '.deleteBtn', function() {
            $(this).closest('.list-item').remove();
        });

        $(".comfirmSelectCourseNumber").click(function() {
            var courseNumberCount = new Array();
            $("input[name='searchCourseNumberCheck']:checked").each(function() {
                courseNumberCount.push($(this).closest("tr").find(".courseNum").text());
            });

            $('.inputCourseNumber').val(courseNumberCount);
            $('#classNumber').modal('hide');

            $('#newStudyResults').modal('show');
        });

    


    </script>

</body>

</html>