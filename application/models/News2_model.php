<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News2_model extends BaseModel
{
    protected $table = 'news2';

    public static function form_list()
    {
        //$single_image_upload_init = 'data-language="zh_TW" data-show-upload="false" data-max-file-size="2048" data-el-error-container="#errorBlock" accept="image/*" data-allowed-file-extensions="[\'jpg\', \'jpeg\', \'gif\', \'png\']"';
        $single_image_upload_init = 'data-language="zh_TW" data-show-upload="false" data-max-file-size="2048" data-el-error-container="#errorBlock" accept="image/*" ';

        $form_list = array(
            'title_tc' => array('type' => 'text', 'label' => __('Title (TC)'), 'attr' => 'required', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required'),
            'title_en' => array('type' => 'text', 'label' => __('Title (EN)'), 'attr' => 'required', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required'),
            'date' => array('type' => 'text', 'label' => __('Date'), 'attr' => 'required', 'class' => 'datetimepicker', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required'),
            'base64_img' => array('type' => 'file', 'label' => __('Base64 Img'), 'label_class' => 'required', 'attr' => '', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => __('File Format: jpg, png, pdf | Size: < 2MB'), 'form_validation_rules' => 'trim', 'path' => assets_url('files/news/base64_img/'), 'base64_path' => ('assets/files/news/base64_img/'),'base64' => true),
            'cover_img_tc' => array('type' => 'single_image_upload', 'label' => __('Cover Img (TC)'), 'label_class' => 'required','attr' => '', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => __('Suggested Resolution: Width 441px X Height 248px'), 'form_validation_rules' => 'trim', 'file_init' => $single_image_upload_init, 'path' =>'files/news/cover_img/'),
            'cover_img_en' => array('type' => 'single_image_upload', 'label' => __('Cover Img (EN)'), 'label_class' => 'required','attr' => '', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => __('Suggested Resolution: Width 441px X Height 248px'), 'form_validation_rules' => 'trim', 'file_init' => $single_image_upload_init, 'path' =>'files/news/cover_img/'),
            'banner_tc' => array('type' => 'single_image_upload', 'label' => __('Banner (TC)'), 'attr' => '', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim', 'file_init' => $single_image_upload_init, 'path' =>'files/news/banner/'),
            'banner_en' => array('type' => 'single_image_upload', 'label' => __('Banner (EN)'), 'attr' => '', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim', 'file_init' => $single_image_upload_init, 'path' =>'files/news/banner/'),
            'content_tc' => array('type' => 'textarea', 'label' => __('Content (TC)'), 'attr' => '', 'class' => 'tinymce', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim'),
            'content_en' => array('type' => 'textarea', 'label' => __('Content (EN)'), 'attr' => '', 'class' => 'tinymce', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim'),
        );  

        return $form_list;
    }

}