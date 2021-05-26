function tinymce_init(init_selector, init_width, init_height, root_path) {

    tinymce.init({
        //remove p tag
        forced_root_block: false,
        force_p_newlines: false,
        remove_linebreaks: false,
        force_br_newlines: true,
        remove_trailing_nbsp: false,
        verify_html: false,
        //end
        relative_urls: false,
        remove_script_host: false,
        document_base_url: root_path,

        selector: init_selector,
        width: init_width,
        height: init_height,
        //language: 'zh_TW',
        theme: 'modern',
        invalid_elements: "script",
        fontsize_formats: "10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 31px 32px 36px 38px 40px",

        font_formats: 'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats; 新細明體=PMingLiU; 標楷體=DFKai-sb; 微軟正黑體=Microsoft JhengHei;',

        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | fontselect fontsizeselect forecolor backcolor emoticons',
        image_advtab: true,
        templates: [
            {title: '全行', description: '全行1', url: root_path + 'assets/libraries/tinymce-4.7.9/resources/template/template1.html'},
        ],
        content_css: [
            //root_path+'public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css'
        ],
        /*formats: {
         alignleft: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'left'},
         aligncenter: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center'},
         alignright: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'right'},
         alignfull: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full'},
         bold: {inline: 'span', 'classes': 'bold'},
         italic: {inline: 'span', 'classes': 'italic'},
         underline: {inline: 'span', 'classes': 'underline', exact: true},
         strikethrough: {inline: 'del'},
         customformat: {inline: 'span', styles: {color: '#00ff00', fontSize: '20px'}, attributes: {title: 'My custom format'}}
         },*/
        /*templates: [
         { title: 'Test template 1', content: 'Test 1' },
         { title: 'Test template 2', content: 'Test 2' }
         ],*/
        /*content_css: [
         '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
         '//www.tinymce.com/css/codepen.min.css'
         ]*/

        // file_browser_callback: elFinderBrowser
        file_picker_callback: elFinderBrowser
    });
}


function elFinderBrowser(callback, value, meta) {
    tinymce.activeEditor.windowManager.open({
        file: root_path + 'assets/libraries/elFinder-2.1.32/elfinder.html',// use an absolute path!
        title: 'elFinder 2.1',
        width: 900,
        height: 450,
        resizable: 'yes'
    }, {
        oninsert: function (file, fm) {
            var url, reg, info;

            // URL normalization
            url = fm.convAbsUrl(file.url);

            // Make file info
            info = file.name + ' (' + fm.formatSize(file.size) + ')';

            // Provide file and text for the link dialog
            if (meta.filetype == 'file') {
                callback(url, {text: info, title: info});
            }

            // Provide image and alt text for the image dialog
            if (meta.filetype == 'image') {
                callback(url, {alt: info});
            }

            // Provide alternative source and posted for the media dialog
            if (meta.filetype == 'media') {
                callback(url);
            }
        }
    });
    return false;
}