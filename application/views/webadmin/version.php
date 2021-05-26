<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("head.php"); ?>

    <style>
        .version_list li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include_once("header.php"); ?>

    <?php include_once("menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 916px;">

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!--<div class="box-header">
                            <h3 class="box-title">Hover Data Table</h3>
                        </div>-->
                        <!-- /.box-header -->
                        <div class="box-body">
                            Current Version: <?= VERSION ?><br><br>

                            Past Version:
                            <ul class="version_list">
                                <li>
                                    1.0.0 : Initial Project [Release Date: 2018-03-07]<br>
                                    - Added news module<br>
                                </li>

                                <li>
                                    1.1.0 : [Release Date: 2018-03-08]<br>
                                    - Added user login control<br>
                                    - Added user profile module<br>
                                    - Added system user module (allow to create / update / delete sys user)<br>
                                    - Added Permission and access control (news module)<br>
                                    - Updated header, menu<br>
                                    - Update controller and function list (order by name ASC)<br>
                                </li>

                                <li>
                                    1.1.1 : [Release Date: 2018-03-19]<br>
                                    - Bug fix : laravel model autoload issue<br>
                                    - Bug fix : sort changing no need to updated updated_at<br>
                                </li>

                                <li>
                                    1.2.0 : [Release Date: 2018-03-27]<br>
                                    - add webadmin/en/... url routes setting, language setting in constant.php<br>
                                    - add gettext/gettext library for po language translation<br>
                                    - add set_path function for setting path<br>
                                    - update composer.json file and vendor file<br>
                                </li>

                                <li>
                                    1.2.1 : [Release Date: 2018-03-28]<br>
                                    - Bug fix: routes.php<br>
                                </li>

                                <li>
                                    1.2.2 : [Release Date: 2018-03-28]<br>
                                    - Bug fix: routes.php<br>
                                </li>

                                <li>
                                    1.2.3 : [Release Date: 2018-04-04]<br>
                                    - Bug fix: routes.php, deal with tc, tc/<br>
                                    - change controller Webadmin -> Admin<br>
                                </li>

                                <li>
                                    1.2.4 : [Release Date: 2018-04-04]<br>
                                    - fix gettext _('') to __('')<br>
                                </li>

                                <li>
                                    1.2.5 : [Release Date: 2018-04-10]<br>
                                    - fix elfinder session issue<br>
                                    - enable native session in codeigniter<br>
                                </li>

                                <li>
                                    1.2.6 : [Release Date: 2018-04-11]<br>
                                    - redo route.php<br>
                                    - change locale/language setting in config<br>
                                    - auto generate php file from po file (when po file last modification date > php file last modification date)<br>
                                </li>

                                <li>
                                    1.3.0 : [Release Date: 2018-04-12]<br>
                                    - separate frontend controller and backend controller (prefix: BK_, eg: BK_News) <br>
                                    - change dir 'public' to 'assets' and update public_url() to assets_url() <br>
                                    - replace controller Welcome to Home and use as default controller (for frontend) <br>
                                    - grouping some file <br>
                                    - add send_email and sendgrid_email function <br>
                                </li>

                                <li>
                                    1.3.1 : [Release Date: 2018-04-12]<br>
                                    - update sys_user security checking, add role checking of user. <br>
                                </li>

                                <li>
                                    2.0.0 : [Release Date: 2018-04-18]<br>
                                    - major changes <br>
                                    - file structure <br>
                                    - add password js aes encryption <br>
                                </li>

                                <li>
                                    2.0.1 : [Release Date: 2018-04-19]<br>
                                    - rename controller <br>
                                </li>

                                <li>
                                    2.0.2 : [Release Date: 2018-04-19]<br>
                                    - move vendor file to application/vendor <br>
                                </li>

                                <li>
                                    2.0.3 : [Release Date: 2018-05-08]<br>
                                    - remove 'codeigniter-debugbar' libraries <br>
                                    - add 'phpdebugbar' libraries <br>
                                    - add 'init.php' in all webadmin files <br>
                                    - update elfinder validName <br>
                                    - update composer.json file, fixed libraries 'owasp/phprbac' version, no need to update<br>
                                    - update webadmin menu, add submenu demo and menu access right checking<br>
                                </li>

                                <li>
                                    2.1.0 : [Release Date: 2018-05-15] (By Nick)<br>
                                    - added send email function (using CodeIgniter Email Library)<br>
                                    - fixed bk_admin,bk_sys_user change password bug<br>
                                    - removed bk_admin functions: sha256_encryption,error_404,aes_encryption<br>
                                    - updated bk_permission init function<br>
                                    - added multiple language for role name<br>
                                    - enabled debug_log function<br>
                                    - added ci_send_email,force_redirect,single_upload,multi_upload function<br>
                                    - updated Init.php set_lang function<br>
                                    - fixed Login_log_model block_count bug<br>
                                    - removed /webadmin/init.php<br>
                                    - added upload js plugin<br>
                                    - updated webadmin user icon<br>
                                    - fixed webadmin main_menu permission bug<br>
                                    - added view/form save button to fixed position while scrolling<br>
                                    - added csrf ajax psot<br>
                                    - added codeigniter language<br>
                                </li>
                                <li>
                                    2.1.1 : [Release Date: 2018-05-15] (By Nick)<br>
                                    - Updated default Timezone to HongKong<br>
                                    - Fixed webadmin/en/member access bug<br>
                                    - Added bootstrap frontend example page<br>
                                    - Added index.html to improve protection<br>
                                    - Fixed menu uri bug<br>
                                    - Added ajax post CSRF protection<br>
                                </li>
                                <li>
                                    2.1.2 : [Release Date: 2018-05-31] (By Nick)<br>
                                    - Added PayPal Library<br>
                                    - Added Frontend functions demo and server information<br>
                                    - Added .htaccess CodeIgniter environment (development / testing / production)<br>
                                    - Added assets/captcha directory<br>
                                    - Moved backend controller to webadmin directory<br>
                                    - Fixed backend user session time out bug on validate_user_access function (by kelvin)<br>
                                    - Updated Init.php<br>
                                    - Updated captcha_checking function<br>
                                    - Updated database driver to PDO<br>
                                </li>
                                <li>
                                    2.1.3 : [Release Date: 2018-07-03] (By Kelvin)<br>
                                    - Added sanitize_data function in Init.php for $_GET / $_POST <br>
                                    - Added datatable jump to page input box, "pagingType": "input"<br>
                                    - remove aes_js jquery.js<br>
                                </li>
                            </ul>

                            <br><br>
                            Remaining Function:<br>

                            <ul class="version_list">
                                <li></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /.content-wrapper -->

    <?php include_once("footer.php"); ?>

</div>
<!-- ./wrapper -->
<?php include_once("script.php"); ?>
</body>
</html>
