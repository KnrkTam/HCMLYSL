function tinymce_init(init_selector, init_width, init_height) {
    tinymce.init({
        //remove p tag
        forced_root_block : false,
        force_p_newlines : false,
        remove_linebreaks : false,
        force_br_newlines : true,
        remove_trailing_nbsp : false,
        verify_html : false,
        //end

        selector: init_selector,
        width : init_width,
        height : init_height,
        language: 'zh_TW',
        theme: 'modern',
        invalid_elements : "script",
        fontsize_formats: "10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 31px 32px 36px 38px 40px",
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true,
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

        /*file_browser_callback: function(field, url, type, win) {
         tinyMCE.activeEditor.windowManager.open({
         file: '../uploader/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
         title: 'Upload Your Images',
         width: 700,
         height: 500,
         inline: true,
         close_previous: false
         }, {
         window: win,
         input: field
         });
         return false;
         }*/
    });
}