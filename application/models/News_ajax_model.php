<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_ajax_model extends BaseModel
{
    protected $table = "news";

    public function photos()
    {
        return $this->hasMany('News_photo_model', 'news_id');
    }

    public static function form_list()
    {
        //$single_image_upload_init = 'data-language="zh_TW" data-show-upload="false" data-max-file-size="2048" data-el-error-container="#errorBlock" accept="image/*" data-allowed-file-extensions="[\'jpg\', \'jpeg\', \'gif\', \'png\']"';
        $single_image_upload_init = 'data-language="zh_TW" data-show-upload="false" data-max-file-size="2048" data-el-error-container="#errorBlock" accept="image/*" ';

        $form_list = array(
            'cover_img' => array('type' => 'elfinder_upload', 'label' => __('Cover Image'), 'attr' => 'required', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required'),
            'cover_img2' =>
                array('type' => 'file', 'label' => __('Cover Image2'), 'attr' => '', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim',
                'upload_config' => array(
                    'relative_path' => 'files/news_ajax/',
                    'upload_path' => FCPATH . 'assets/files/news_ajax/',
                    'allowed_types' => 'jpeg|jpg|png|pdf',
                    'max_size' => 2048,
                    'max_width' => 1980,
                    'max_height' => 678,
                    'encrypt_name' => TRUE,
                ),
                'thumb_config' => array(
                    'width' => 200,
                    'height' => 200,
                ),
            ),
            'single_upload' =>
                array('type' => 'single_image_upload', 'label' => __('Cover Image3'), 'attr' => '', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim', 'file_init' => $single_image_upload_init, 'path' =>'files/ajax_news/',
                    'upload_config' => array(
                        'relative_path' => 'files/news_ajax/',
                        'upload_path' => FCPATH . 'assets/files/news_ajax/',
                        'allowed_types' => 'jpeg|jpg|png|pdf',
                        'max_size' => 2048,
                        'max_width' => 1980,
                        'max_height' => 678,
                        'encrypt_name' => TRUE,
                    ),
                    'thumb_config' => array(
                        'width' => 200,
                        'height' => 200,
                    ),
                ),
            'title' => array('type' => 'text', 'label' => __('Title'), 'attr' => 'required', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required'),
            'short_content' => array('type' => 'text', 'label' => __('Short Content'), 'attr' => '', 'class' => 'tinymce_xs tinymce_field', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => ''),
            'content' => array('type' => 'textarea', 'label' => __('Content'), 'attr' => '', 'class' => 'tinymce tinymce_field', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim'),
            'date' => array('type' => 'text', 'label' => __('News Date'), 'attr' => 'required', 'class' => 'datepicker', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|callback_validate_date', 'form_validation_errors' => ['validate_date' => __('Please enter correct ') . ' %s.']),
            'start_date' => array('type' => 'text', 'label' => __('Start Date'), 'attr' => 'required', 'class' => 'datetimepicker', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required|callback_validate_start_date'),
            'end_date' => array('type' => 'text', 'label' => __('End Date'), 'attr' => 'required', 'class' => 'datetimepicker', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required|callback_validate_end_date'),
        );

        return $form_list;
    }
}