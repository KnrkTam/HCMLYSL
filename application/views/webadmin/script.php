<!-- jQuery 3
<script src="<?= assets_url('webadmin/admin_lte/bower_components/jquery/dist/jquery.min.js') ?>"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<!-- jquery UI -->
<script src="<?= assets_url('libraries/jquery-ui-1.12.1/jquery-ui.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= assets_url('webadmin/admin_lte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- SlimScroll -->
<script src="<?= assets_url('webadmin/admin_lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?= assets_url('webadmin/admin_lte/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets_url('webadmin/admin_lte/dist/js/adminlte.min.js') ?>"></script>
<!-- js-cookie -->
<script src="<?= assets_url('webadmin/js/js.cookie.min.js') ?>"></script>

<?php if ($GLOBALS["jquery19"] == 1) { ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>


<?php } ?>
<?php if ($GLOBALS["datatable"] == 1) { ?>
    <!-- DataTables 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>-->
    <script src="<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= assets_url('webadmin/admin_lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
    <script src="<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/js/input.js') ?>"></script>
    <script src="<?= assets_url('webadmin/admin_lte/bower_components/boostrap-datatable/js/dataTables.rowsGroup.js') ?>"></script>
    <script src="<?= assets_url('webadmin/admin_lte/bower_components/boostrap-datatable/js/dataTables.fixedColumns.min.js') ?>"></script>


    <script src="<?= assets_url('webadmin/js/jquery.dragtable.js') ?>"></script>
    <script type="text/javascript">
        function stopPropagation(evt) {
            if (evt.stopPropagation !== undefined) {
                evt.stopPropagation();
            } else {
                evt.cancelBubble = true;
            }
        }


        var data_table = '';
        var datatable_with_filter = '';

        $(document).ready(function() {
            data_table = $('.datatable').DataTable({
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/' . get_wlocale() . '.json') ?>"
                },
                "order": [],
                "bSort": false,
                "pageLength": 100,
                "pagingType": "input",
                "fnInitComplete": function(oSettings) { //all old method may need add fn
                    this.api().columns().every(function() {
                        var column = this;
                        if ($(column.header()).hasClass('input2select')) {
                            var select = $('<select class="form-control input-sm" style="width:90%;"><option value=""><?= __('All') ?></option></select>')
                                .appendTo($(column.header()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function(d, j) {
                                if (d != '') {
                                    select.append('<option value="' + d + '">' + d + '</option>');
                                }
                            });
                        }

                    });
                }
            });

            $('.datatable-with-filter thead th:not(.no-filter)').each(function() {
                var title = $('.datatable-with-filter thead th').eq($(this).index()).text();
                // console.log(title);
                if (title) {
                    $(this).html('<input type="text" placeholder="' + title + '" class="form-control input-sm" style="width:90%;" onclick="stopPropagation(event);" />');
                }
            });

            // DataTable
            datatable_with_filter = $('.datatable-with-filter').DataTable({
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/' . get_wlocale() . '.json') ?>"
                },
                "order": [],
                "bSort": false,
                "pageLength": 100,
                "pagingType": "input",
                "fnInitComplete": function(oSettings) { //all old method may need add fn
                    this.api().columns().every(function() {
                        var column = this;
                        if ($(column.header()).hasClass('input2select')) {
                            var select = $('<select class="form-control input-sm" style="width:90%;"><option value=""><?= __('All') ?></option></select>')
                                .appendTo($(column.header()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function(d, j) {
                                if (d != '') {
                                    select.append('<option value="' + d + '">' + d + '</option>');
                                }
                            });
                        }

                    });
                }
            });

            $("input.search_init, textarea.search_init").keyup(function(e) {
                e.stopPropagation();
                // e.preventDefault();
            });

            if (datatable_with_filter.context.length) {
                // Apply the search
                datatable_with_filter.columns().eq(0).each(function(colIdx) {
                    $('input', datatable_with_filter.column(colIdx).header()).on('keyup change', function() {
                        datatable_with_filter
                            .column(colIdx)
                            .search(this.value)
                            .draw();
                    });
                });
            }

            var Ajax_datatable = $('#Ajax_datatable').DataTable({
                "language": {
                    "url": "<?= assets_url('webadmin/admin_lte/bower_components/datatables.net/' . get_wlocale() . '.json') ?>"
                },
                "order": [],
                "bSort": false,
                "pageLength": 50,
                "pagingType": "input",
                //"sDom": '<"wrapper"lfptip>',
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "searching": true,
                "searchDelay": 0,
                "ajax": {
                    "url": "<?= admin_url($page_setting['controller'] . '/ajax') ?>",
                    "method": "get",
                    "timeout": "30000",
                    "data": function(d) {
                        console.log('Ajax_datatable');
                        d.csrf_token = csrf_token;
                        var filter_type = $('#filter_type').val();
                        d.search_filter_type = filter_type;
                        d.search_filter_para = $('#filter_' + filter_type + '_para').val();
                        console.log(d);
                    },
                    "error": function(e) {
                        console.log(e);
                    }
                },
            });
        });
    </script>
<?php } ?>

<?php if ($GLOBALS["fancybox"] == 1) { ?>
    <script src="<?= assets_url('js/fancybox2.0/jquery.fancybox.js') ?>"></script>
<?php } ?>

<?php if ($GLOBALS["datetimepicker"] == 1) { ?>

    <script type="text/javascript" src="<?= assets_url('libraries/datetimepicker/jquery-ui-timepicker-addon.js') ?>"></script>
    <script type="text/javascript" src="<?= assets_url('libraries/datetimepicker/i18n/jquery-ui-timepicker-addon-i18n.min.js') ?>"></script>
    <script type="text/javascript" src="<?= assets_url('libraries/datetimepicker/jquery-ui-sliderAccess.js') ?>"></script>
    <!-- if use non-english -->
    <!--<script type="text/javascript" src="<? /*= assets_url('libraries/datetimepicker/i18n/datepicker-zh-TW.js') */ ?>"></script>
    <script type="text/javascript" src="<? /*= assets_url('libraries/datetimepicker/i18n/jquery-ui-timepicker-zh-TW.js') */ ?>"></script>-->

    <script type="text/javascript">
        $(function() {
            $('.datetimepicker').datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: "hh:mm:ss",
                language: 'en'
            });
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            //$.datepicker.setDefaults($.datepicker.regional['zh-TW']);
        });
    </script>
<?php } ?>

<?php if ($GLOBALS["tinymce"] == 1) { ?>
    <script type="text/javascript" src="<?= assets_url('libraries/tinymce_4.7.9/jquery.tinymce.min.js') ?>"></script>
    <script type="text/javascript" src="<?= assets_url('libraries/tinymce_4.7.9/tinymce.min.js') ?>"></script>
    <script type="text/javascript" src="<?= assets_url('libraries/tinymce_4.7.9/tinymce_init.js?v=20180306') ?>"></script>
    <script type="text/javascript">
        var root_path = '<?= base_url() ?>';
        tinymce_init(".tinymce", '100%', 700, root_path); //1.target element  2.width  3.height
        tinymce_init(".tinymce_sm", '100%', 400, root_path); //1.target element  2.width  3.height
        tinymce_init(".tinymce_xs", '100%', 200, root_path); //1.target element  2.width  3.height
    </script>
<?php } ?>

<?php if ($GLOBALS["select2"] == 1) { ?>
    <script src="<?= assets_url('webadmin/admin_lte/bower_components/select2/dist/js/select2.min.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select.select2').select2();
        });
    </script>
<?php } ?>
<?php if ($GLOBALS["ionslider"] == 1) { ?>
    <!-- Ion Slider -->
    <script src="<?= assets_url('webadmin/admin_lte/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js') ?>"></script>

<?php } ?>

<?php if ($GLOBALS["elfinder"] == 1) { ?>
    <!-- elfinder.full.js for multiple language -->
    <script src="<?= assets_url('libraries/elFinder-2.1.32/js/elfinder.full.js') ?>"></script>
    <script type="text/javascript">
        $(function() {
            $('.elfinder_btn').click(function(event) {
                var _this = $(this);

                var elfinder = $('#elfinder').elfinder({
                    url: '<?= assets_url() ?>libraries/elFinder-2.1.32/php/connector.minimal.php', // connector URL (REQUIRED)
                    lang: '<?= get_wlocale() ?>', //en, zh_TW, zh_CN
                    resizable: false,
                    getfile: {
                        onlyURL: true,
                        multiple: true,
                        folders: true,
                        oncomplete: ''
                    },
                    handlers: {
                        dblclick: function(event, elfinderInstance) {
                            fileInfo = elfinderInstance.file(event.data.file);

                            if (fileInfo.mime !== 'directory') {
                                //console.log(elfinderInstance.url(event.data.file));
                                console.log(fileInfo);
                                var full_path = elfinderInstance.url(event.data.file);
                                var file_path = full_path.split("/../../../");
                                _this.val(file_path[1]);
                                //_this.val(fileInfo.name);
                                //$("#editor").val(elfinderInstance.url(event.data.file));
                                elfinderInstance.destroy();
                                //$('#elfinder').dialog('close');
                                return false; // stop elfinder
                            }
                        },
                        destroy: function(event, elfinderInstance) {
                            elfinder.dialog('close');
                        }
                    },

                    uiOptions: {
                        // toolbar configuration
                        toolbar: [
                            ['upload'],
                            ['download', 'getfile'],
                            ['copy', 'cut', 'paste', 'rm'],
                            ['duplicate', 'rename', 'resize', 'chmod'],
                            ['info'],
                            ['search'],
                            ['view', 'sort'],
                        ],

                        //ori setting
                        /*toolbar : [
                         ['home', 'back', 'forward', 'up', 'reload'],
                         ['netmount'],
                         ['mkdir', 'mkfile', 'upload'],
                         ['open', 'download', 'getfile'],
                         ['undo', 'redo'],
                         ['copy', 'cut', 'paste', 'rm', 'empty'],
                         ['duplicate', 'rename', 'edit', 'resize', 'chmod'],
                         ['selectall', 'selectnone', 'selectinvert'],
                         ['quicklook', 'info'],
                         ['extract', 'archive'],
                         ['search'],
                         ['view', 'sort'],
                         ['help'],
                         ['fullscreen']
                         ],*/

                    },
                    contextmenu: {
                        // navbarfolder menu
                        navbar: ['open', 'download', '|', 'upload', 'mkdir', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'rename', '|', 'places', 'info', 'chmod', 'netunmount'],
                        // current directory menu
                        cwd: ['undo', 'redo', '|', 'back', 'up', 'reload', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'view', 'sort', 'selectall', 'colwidth', '|', 'info', '|', 'fullscreen', '|', 'preference'],
                        // current directory file menu
                        files: ['getfile', '|', 'open', 'download', 'opendir', 'quicklook', '|', 'upload', 'mkdir', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', 'rename', 'edit', 'resize', '|', 'selectall', 'selectinvert', '|', 'places', 'info', 'chmod']

                        //ori setting
                        /*// navbarfolder menu
                         navbar : ['open', 'download', '|', 'upload', 'mkdir', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', 'empty', '|', 'rename', '|', 'archive', '|', 'places', 'info', 'chmod', 'netunmount'],
                         // current directory menu
                         cwd    : ['undo', 'redo', '|', 'back', 'up', 'reload', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'empty', '|', 'view', 'sort', 'selectall', 'colwidth', '|', 'info', '|', 'fullscreen', '|', 'preference'],
                         // current directory file menu
                         files  : ['getfile', '|' ,'open', 'download', 'opendir', 'quicklook', '|', 'upload', 'mkdir', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', 'empty', '|', 'rename', 'edit', 'resize', '|', 'archive', 'extract', '|', 'selectall', 'selectinvert', '|', 'places', 'info', 'chmod', 'netunmount']*/


                    },
                }).dialog({
                    title: 'filemanager',
                    resizable: true,
                    width: 920,
                    height: 500
                });
            });
            $('.elfinder_btn_remove').click(function() {
                $(this).parent().prev().val('');
            });
        });
    </script>
    <div id="elfinder"></div>
<?php } ?>

<?php if ($GLOBALS["aes_js"] == 1) { ?>
    <script type="text/javascript" src="<?= assets_url('libraries/cryptojs-aes-php/aes.js') ?>"></script>
    <script type="text/javascript" src="<?= assets_url('libraries/cryptojs-aes-php/aes-json-format.js') ?>"></script>
    <script type="text/javascript">
        $('form').on("submit", function() {
            $(this).find('.aesjs').each(function() {
                if ($(this).val()) {
                    var clone = $(this).clone();
                    $(this).attr('form', 'nosubmit');
                    clone.attr('type', 'hidden').val(CryptoJS.AES.encrypt(JSON.stringify($(this).val()), '<?= cryptoJSPW() ?>', {
                        format: CryptoJSAesJson
                    }).toString()).appendTo($(this).parent());
                }
            });
        });
    </script>
<?php } ?>

<?php if ($GLOBALS["fileinput"] == 1) { ?>
    <!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
    <!-- link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
    <!-- optionally uncomment line below if using a theme or icon set like font awesome (note that default icons used are glyphicons and `fa` theme can override it) -->
    <!-- link https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css media="all" rel="stylesheet" type="text/css" /-->
    <!--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
    <!-- piexif.min.js is only needed for restoring exif data in resized images and when you
        wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="<?= assets_url('libraries/bootstrap-fileinput/js/plugins/piexif.min.js') ?>" type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
        This must be loaded before fileinput.min.js -->
    <script src="<?= assets_url('libraries/bootstrap-fileinput/js/plugins/sortable.min.js') ?>" type="text/javascript"></script>
    <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for
        HTML files. This must be loaded before fileinput.min.js -->
    <script src="<?= assets_url('libraries/bootstrap-fileinput/js/plugins/purify.min.js') ?>" type="text/javascript"></script>
    <!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js
       3.3.x versions without popper.min.js. -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>-->
    <!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
        dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>-->
    <!-- the main fileinput plugin file -->
    <script src="<?= assets_url('libraries/bootstrap-fileinput/js/fileinput.js') ?>"></script>
    <!-- optionally uncomment line below for loading your theme assets for a theme like Font Awesome (`fa`) -->
    <!-- script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/themes/fa/theme.min.js"></script -->
    <!-- optionally if you need translation for your language then include  locale file as mentioned below -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/locales/LANG.js"></script>-->

    <script src="<?= assets_url('libraries/bootstrap-fileinput/js/locales/' . get_wlocale() . '.js') ?>"></script>

<?php } ?>


<script src="<?= assets_url('libraries/alertify/alertify.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
    function confirm_delete(path) {
        alertify.set({
            labels: {
                ok: "<?= __('Delete') ?>",
                cancel: "<?= __('Cancel') ?>"
            }
        });

        alertify.confirm("<?= __('Confirm to delete?') ?>", function(e) {
            if (e) {
                location.href = path;
            } else {
                // user clicked "cancel"
            }
        });
    }

    function confirm_save(form_id) {
        alertify.set({
            labels: {
                ok: "<?= __('Save') ?>",
                cancel: "<?= __('Cancel') ?>"
            }
        });
        alertify.confirm("<?= __('Confirm to save?') ?>", function(e) {
            if (e) {
                $('#' + form_id).submit();
            } else {
                // user clicked "cancel"
            }
        });
    }

    $(function() {
        <?php
        if (!empty($_SESSION["log_msg"])) {
            echo 'alertify.log("' . $_SESSION["log_msg"] . '");';
            unset($_SESSION["log_msg"]);
        }

        if (!empty($_SESSION["success_msg"])) {
            echo 'alertify.success("' . $_SESSION["success_msg"] . '");';
            unset($_SESSION["success_msg"]);
        }

        if (!empty($_SESSION["error_msg"])) {
            echo 'alertify.error("' . $_SESSION["error_msg"] . '");';
            unset($_SESSION["error_msg"]);
        }
        ?>

        alertify.set({
            labels: {
                ok: "<?= __('Confirm') ?>",
                cancel: "<?= __('Cancel') ?>"
            },
            buttonReverse: false,
            delay: 10000
        });

        window.alert = function(msg) {
            alertify.alert(msg);
        };


        // open last opened treeview and sidebar-collapse
        if (typeof Cookies !== 'undefined') {
            var cookie_value = Cookies.get('sidebar-collapse');
            if (cookie_value == "true") {
                $("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
            }

            $("body").on("collapsed.pushMenu", function() {
                Cookies.set('sidebar-collapse', true);
            }).on("expanded.pushMenu", function() {
                Cookies.set('sidebar-collapse', false);
            });
            // var cookie_value2 = Cookies.get('treeview-open');
            // if (typeof cookie_value2 !== 'undefined') {
            //     $($('.sidebar-menu .treeview').get(cookie_value2)).addClass('active');
            // }
        }

    });


    //check upload file
    $(document).on("change", "input[type='file']", function() {
        if (!$(this).hasClass('fileinput')) {
            var _this = $(this);
            var _file = this.files[0];
            var valid_file = true;
            var total_file_size = 0;
            var _URL = window.URL || window.webkitURL;
            var img = new Image();

            //check image width and height
            img.onload = function() {
                //console.log(this.width + " " + this.height);
                if (this.width >= 2000 || this.height >= 2000) {
                    $(_this).val("");
                    alert("<?= __('Resolution of uploaded images should be lower than 2000px.') ?>");
                    return false;
                }
            };
            img.src = _URL.createObjectURL(_file);

            //console.log("Size: " + (this.files[0].size / (1024 * 1024)).toFixed(2) + " MB \n");
            if (_file.size > (1024 * 1024 * 2)) {
                //txt = "Size: " + (this.files[0].size / (1024*1024)).toFixed(2) + " MB \n";
                $(_this).val("");
                alert("<?= __('Uploaded file size should be smaller than 2MB.') ?>");
                return false;
            } else {
                total_file_size += _file.size;
            }

            //console.log(total_file_size / (1024 * 1024).toFixed(2) + " MB \n");
            if (total_file_size > (1024 * 1024 * 10)) {
                $(_this).val("");
                total_file_size = 0;

                alert("<?= __('Total uploaded file size should be smaller than 10MB.') ?>");
            }
        }
    });

    var csrf_token = '<?= $this->security->get_csrf_hash() ?>';

    //ajax csrf
    <?php if (config_item('csrf_protection')) { ?>
        $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
            if (options.type.toLowerCase() === "post") {
                jqXHR.setRequestHeader('X-CSRFToken', '<?= $this->security->get_csrf_hash() ?>');
            }
        });
    <?php } ?>

    //.ajax function list
    $(function() {
        $('form').submit(function() {
            show_loading();
            return true;
        });
    });

    function show_loading() {
        $('body').append('<div id="loading"><div class="loader"></div></div>');
    }

    function hide_loading() {
        $(document).find('#loading').remove();
    }

    //general ajax function list
    function scroll_to_error(el) {
        $('html, body').animate({
            scrollTop: $(el).offset().top - 50
        }, 250);
    }

    function ajax_update_sort(_this) {
        var form_data = new FormData($(_this).closest('form')[0]);

        $.ajax({
            url: '<?= admin_url($page_setting['controller'] . '/ajax/update_sort') ?>',
            type: 'POST',
            data: form_data,
            dataType: 'json',
            timeout: 5000,
            contentType: false,
            processData: false,
            beforeSend: function() {
                show_loading();
            },
            complete: function() {
                hide_loading();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                alertify.error('HTTP Status: ' + xhr.status + '<br>' + thrownError);
            },
            success: function(result) {
                //reload datatable
                console.log(result);
                if (result.success === true) {
                    alertify.success(result.message);
                    $('#Ajax_datatable').DataTable().draw();
                } else {
                    alertify.error(result.message);
                }
            }
        });
    }

    function ajax_delete_record(id) {
        alertify.set({
            labels: {
                ok: "<?= __('Delete') ?>",
                cancel: "<?= __('Cancel') ?>"
            }
        });

        alertify.confirm("<?= __('Confirm to delete?') ?>", function(e) {
            if (e) {
                console.log(id);
                $.ajax({
                    url: '<?= admin_url($page_setting['controller'] . '/ajax/delete_record') ?>',
                    type: 'POST',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    timeout: 5000,
                    //contentType: false,
                    //processData: false,
                    beforeSend: function() {
                        show_loading();
                    },
                    complete: function() {
                        hide_loading();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                        alertify.error('HTTP Status: ' + xhr.status + '<br>' + thrownError);
                    },
                    success: function(result) {
                        //reload datatable
                        console.log(result);
                        if (result.success === true) {
                            alertify.success(result.message);
                            $('#Ajax_datatable').DataTable().draw();
                        } else {
                            alertify.error(result.message);
                        }
                    }
                });
            } else {
                // user clicked "cancel"
            }
        });
    }

    function ajax_update_status(id, status) {
        $.ajax({
            url: '<?= admin_url($page_setting['controller'] . '/ajax/update_status') ?>',
            type: 'POST',
            data: {
                id: id,
                status: status,
            },
            dataType: 'json',
            timeout: 5000,
            //contentType: false,
            //processData: false,
            beforeSend: function() {
                show_loading();
            },
            complete: function() {
                hide_loading();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                alertify.error('HTTP Status: ' + xhr.status + '<br>' + thrownError);
            },
            success: function(result) {
                //reload datatable
                console.log(result);
                if (result.success === true) {
                    alertify.success(result.message);
                    $('#Ajax_datatable').DataTable().draw();
                } else {
                    alertify.error(result.message);
                }
            }
        });
    }

    function ajax_submit_form(_this) {
        $('#signupalert').empty().hide();
        var missing_required = false;
        $(_this).closest('form').find('input, select, textarea').each(function(index) {
            if ($(this).prop('required') && !$(this).val()) {
                missing_required = true;
            }
        });
        var missing_required = false;
        if (missing_required) {
            $(document).find('.missing_required').remove();
            $('#signupalert').append('<p class="missing_required"><?= __('Please fill all required fields.') ?></p>').show();

            scroll_to_error('#signupalert');
            return;
        }

        var form_data = new FormData($(_this).closest('form')[0]);
        //special handle tinymce field when using ajax post data
        $(document).find('.tinymce_field').each(function() {
            form_data.append($(this).attr('name'), tinymce.get($(this).attr('id')).getContent());
        });
        // Display the key/value pairs
        for (var pair of form_data.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        $.ajax({
            url: '<?= admin_url($page_setting['controller'] . '/ajax/submit_form') ?>',
            type: 'POST',
            data: form_data,
            dataType: 'json',
            timeout: 5000,
            contentType: false,
            processData: false,
            beforeSend: function() {
                show_loading();
            },
            complete: function() {
                hide_loading();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                alertify.error('HTTP Status: ' + xhr.status + '<br>' + thrownError);
            },
            success: function(result) {
                console.log(result);
                if (result.success === true) {
                    //alertify.success(result.message);
                    location.href = '<?= admin_url($page_setting['controller'] . '/modify/') ?>' + result.data.id + '?success=1';
                } else {
                    //alertify.error(result.message);
                    $('#signupalert').append(result.message).show();
                    scroll_to_error('#signupalert');
                }
            }
        });
    }
</script>

<?php
//unset form data
unset($_SESSION['data']);

if (DEBUG && isset($debugbar) && isset($debugbarRenderer)) {

    if (!empty($_SESSION['debugbar_log'])) {
        $debugbar["messages"]->addMessage('===== Debug Bar Log =====');
        foreach ($_SESSION['debugbar_log'] as $item) {
            $debugbar["messages"]->addMessage($item);
        }
    }

    $debugbar["messages"]->addMessage('===== Query Log =====');
    $query_log = dq(1, 0, 1);
    foreach ($query_log as $query) {
        $debugbar["messages"]->addMessage($query);
    }
    $debugbar["messages"]->addMessage('===== End Query Log =====');
    echo $debugbarRenderer->render();

    unset($_SESSION['query_log']);
    unset($_SESSION['debugbar_log']);
}
