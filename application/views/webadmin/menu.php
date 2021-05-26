<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= assets_url('webadmin/img/usericon.png') ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= _h($_SESSION['login_name']) ?></p>
                <small><?= get_login_role_name($_SESSION['login_role']) ?></small>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><?= __('MAIN NAVIGATION') ?></li>

            <?php
            $menu_list = array(

                array(
                    'main_menu' => __('各學階單元設定(master)'),
                    'url' => 'bk_master_modules',
                    'access' => 'view_news',
                    'icon' => 'fa-file-text',
                ),
                array(
                    'main_menu' => __('校本課程大綱 - 檢視'),
                    'url' => 'Bk_course_outline',
                    'access' => 'view_news',
                    'icon' => 'fa-file-text-o',
                ),


                //has sub menu
                array(
                    'main_menu' => '科目',
                    'url' => '',
                    'access' => 'view_news',
                    'icon' => 'fa fa-list-alt',
                    'sub_menu' => array(
                        array(
                            'title' => __('科目預期學習成果 - 檢視'),
                            'url' => 'Bk_subject_achievement',
                            'access' => 'view_news',
                            'icon' => 'fa-list-alt',
                        ),
                        array(
                            'title' => __('科目課程大綱 - 檢視'),
                            'url' => 'Bk_subject_outline',
                            'access' => 'view_news',
                            'icon' => 'fa-list-alt',
                        )
                    )
                ),
                array(
                    'main_menu' => __('設定各級年度學習單元 - 檢視'),
                    'url' => 'Bk_setting_unit',
                    'access' => 'view_news',
                    'icon' => 'fa-sticky-note-o',
                ),
                array(
                    'main_menu' => __('全校學習單元週次 - 檢視'),
                    'url' => 'Bk_study_unit',
                    'access' => 'view_news',
                    'icon' => 'fa-clipboard',
                ),
                array(
                    'main_menu' => __('課程及科目課程大綱樹狀圖'),
                    'url' => 'Bk_tree_map',
                    'access' => 'view_news',
                    'icon' => 'fa-map-o',
                ),

                array(
                    'main_menu' => '教職員',
                    'url' => '',
                    'access' => 'view_news',
                    'icon' => 'fa fa-mortar-board',
                    'sub_menu' => array(
                        array(
                            'title' => __('設定年度教職員 - 檢視'),
                            'url' => 'Bk_setting_teacher',
                            'access' => 'view_news',
                            'icon' => 'fa-mortar-board',
                        ),
                        array(
                            'title' => __('設定年度科長 - 檢視'),
                            'url' => 'Bk_setting_subject_teacher',
                            'access' => 'view_news',
                            'icon' => 'fa-mortar-board',
                        ),
                        array(
                            'title' => __('設定年度支援/個別化學習負責人 - 檢視'),
                            'url' => 'Bk_setting_support',
                            'access' => 'view_news',
                            'icon' => 'fa-mortar-board',
                        )
                    )
                ),


                /*
                array(
                    'main_menu' => __('設定年度教職員 - 檢視'),
                    'url' => 'Bk_setting_teacher',
                    'access' => 'view_news',
                    'icon' => ' fa-mortar-board',
                ),
                array(
                    'main_menu' => __('設定年度科長 - 檢視'),
                    'url' => 'Bk_setting_subject_teacher',
                    'access' => 'view_news',
                    'icon' => 'fa-mortar-board',
                ),
                array(
                    'main_menu' => __('設定年度支援/個別化學習負責人 - 檢視'),
                    'url' => 'Bk_setting_support',
                    'access' => 'view_news',
                    'icon' => 'fa-mortar-board',
                ),*/
                array(
                    'main_menu' => __('設定單元既定教學大綱 - 檢視'),
                    'url' => 'Bk_setting_subject_outline',
                    'access' => 'view_news',
                    'icon' => 'fa-file',
                ),
                array(
                    'main_menu' => __('補充內容 - 檢視'),
                    'url' => 'Bk_addon',
                    'access' => 'view_news',
                    'icon' => 'fa-plus',
                ),

                array(
                    'main_menu' => '分組',
                    'url' => '',
                    'access' => 'view_news',
                    'icon' => 'fa fa-users',
                    'sub_menu' => array(
                        array(
                            'title' => __('年度科目分組 - 檢視'),
                            'url' => 'Bk_group_subject',
                            'access' => 'view_news',
                            'icon' => 'fa-users',
                        ),
                        array(
                            'title' => __('年度服務分組 - 檢視'),
                            'url' => 'Bk_group_service',
                            'access' => 'view_news',
                            'icon' => 'fa-users',
                        )
                    )
                ),
                /*
                array(
                    'main_menu' => __('年度科目分組 - 檢視'),
                    'url' => 'Bk_group_subject',
                    'access' => 'view_news',
                    'icon' => 'fa-user-plus',
                ),
                array(
                    'main_menu' => __('年度服務分組 - 檢視'),
                    'url' => 'Bk_group_service',
                    'access' => 'view_news',
                    'icon' => 'fa-user-plus',
                ),*/
                array(
                    'main_menu' => __('年度教學大綱 - 檢視'),
                    'url' => 'Bk_teach_outline',
                    'access' => 'view_news',
                    'icon' => 'fa-calendar-o',
                ),
                array(
                    'main_menu' => __('年度教案 - 檢視 (全部)'),
                    'url' => 'Bk_teach_file',
                    'access' => 'view_news',
                    'icon' => 'fa-file-o',
                ),
                array(
                    'main_menu' => __('教學計劃評分 - 檢視'),
                    'url' => 'Bk_plan_score',
                    'access' => 'view_news',
                    'icon' => 'fa-pencil',
                ),
                array(
                    'main_menu' => __('年度學生支援服務評語 - 檢視'),
                    'url' => 'Bk_support_eva',
                    'access' => 'view_news',
                    'icon' => 'fa-edit',
                ),

                array(
                    'main_menu' => '單元',
                    'url' => '',
                    'access' => 'view_news',
                    'icon' => 'fa fa-book',
                    'sub_menu' => array(
                        array(
                            'title' => __('單元評估表 - 檢視'),
                            'url' => 'Bk_unit_eva',
                            'access' => 'view_news',
                            'icon' => 'fa-book',
                        ),
                        array(
                            'title' => __('單元學行行為表現 - 檢視'),
                            'url' => 'Bk_unit_perform',
                            'access' => 'view_news',
                            'icon' => 'fa-book',
                        ),
                        array(
                            'title' => __('單元出席紀錄 - 檢視'),
                            'url' => 'Bk_unit_attendance',
                            'access' => 'view_news',
                            'icon' => 'fa-book',
                        )
                    )
                ),
                /*
                array(
                    'main_menu' => __('單元評估表 - 檢視'),
                    'url' => 'Bk_unit_eva',
                    'access' => 'view_news',
                    'icon' => 'fa-file-powerpoint-o',
                ),
                array(
                    'main_menu' => __('單元學行行為表現 - 檢視'),
                    'url' => 'Bk_unit_perform',
                    'access' => 'view_news',
                    'icon' => 'fa-signal',
                ),
                array(
                    'main_menu' => __('單元出席紀錄 - 檢視'),
                    'url' => 'Bk_unit_attendance',
                    'access' => 'view_news',
                    'icon' => 'fa-book',
                ),*/
                array(
                    'main_menu' => __('全年學行評語 - 檢視'),
                    'url' => 'Bk_year_comments',
                    'access' => 'view_news',
                    'icon' => 'fa-commenting-o',
                ),
                array(
                    'main_menu' => __('校內/外獎項項目'),
                    'url' => 'Bk_awards',
                    'access' => 'view_news',
                    'icon' => 'fa-trophy',
                ),
                array(
                    'main_menu' => __('學生科目級別'),
                    'url' => 'Bk_subject_level',
                    'access' => 'view_news',
                    'icon' => 'fa-cube',
                ),
                //has sub menu
                /*array(
                    'main_menu' => 'Product Management (Sample)',
                    'url' => '',
                    'access' => 'view_news',
                    'icon' => 'fa fa-files-o',
                    'sub_menu' => array(
                        array(
                            'title' => __('Product'),
                            'url' => 'bk_product',
                            'access' => 'view_news',
                            'icon' => 'fa fa-circle-o',
                        ),
                        array(
                            'title' => __('Category Management'),
                            'url' => 'bk_category',
                            'access' => 'view_news',
                            'icon' => 'fa fa-circle-o',
                        ),
                    )
                ),

                //no submenu
  

                array(
                    'main_menu' => __('News2'),
                    'url' => 'bk_news2',
                    'access' => 'view_news',
                    'icon' => 'fa-newspaper-o',
                ),

                array(
                    'main_menu' => __('News (Ajax)'),
                    'url' => 'bk_news_ajax',
                    'access' => 'view_news',
                    'icon' => 'fa-newspaper-o',
                ),*/

                array(
                    'main_menu' => __('System User'),
                    'url' => 'bk_sys_user',
                    'access' => 'create_sys_user',
                    'icon' => 'fa-gear',
                ),
                array(
                    'main_menu' => __('Site Info'),
                    'url' => 'bk_site_info/modify/1',
                    'access' => 'update_site_info',
                    'icon' => 'fa-gears',
                ),
                
            );

            $url_uri = current_controller();

            foreach ($menu_list as $key => $main_menu) {
                $menu_list[$key]['enable_main_menu'] = false;
                $menu_list[$key]['active'] = false;

                if (empty($main_menu['sub_menu'])) {
                    if (validate_user_access([$main_menu['access']])) {
                        $menu_list[$key]['enable_main_menu'] = true;
                        $menu_list[$key]['active'] = ($main_menu['url'] == $url_uri ? true : false);
                    }
                } else {
                    foreach ($main_menu['sub_menu'] as $key2 => $sub_menu) {

                        $menu_list[$key]['sub_menu'][$key2]['enable_sub_menu'] = false;
                        $menu_list[$key]['sub_menu'][$key2]['active'] = false;

                        if (validate_user_access([$sub_menu['access']])) {
                            $menu_list[$key]['enable_main_menu'] = true;
                            $menu_list[$key]['sub_menu'][$key2]['enable_sub_menu'] = true;
                        }

                        if ($sub_menu['url'] == $url_uri) {
                            $menu_list[$key]['sub_menu'][$key2]['active'] = true;
                            $menu_list[$key]['active'] = true;
                        }
                    }
                }
            }

            foreach ($menu_list as $key => $main_menu) {
                if (empty($main_menu['sub_menu']) && $main_menu['enable_main_menu']) {
                    echo '<li class=" ' . ($main_menu['active'] ? 'active' : '') . '"><a href="' . admin_url($main_menu['url']) . '"> <i class="fa fa-fw ' . $main_menu['icon'] . '"></i><span> ' . __($main_menu['main_menu']) . '</span> </a></li>';
                } else {
                    if ($main_menu['enable_main_menu']) {
                        echo '<li class="' . ($main_menu['active'] ? 'active menu-open' : '') . ' treeview"><a href="#"><i class="fa fa-fw ' . $main_menu['icon'] . '"></i> <span> ' . $main_menu['main_menu'] . '</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a> <ul class="treeview-menu ">';
                        foreach ($main_menu['sub_menu'] as $sub_menu) {
                            if ($sub_menu['enable_sub_menu']) {
                                echo '<li class="' . ($sub_menu['active'] ? 'active' : '') . '"><a href="' . admin_url($sub_menu['url']) . '"><i class="fa fa-fw ' . $sub_menu['icon'] . '"></i>' . $sub_menu['title'] . '</a></li>';
                            }
                        }
                        echo '</ul></li>';
                    }
                }
            }
            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>