<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Site_info_model extends BaseModel
	{
		protected $table = "site_info";

        // public function __construct()
        // {
        //     //disable where deleted = 0
        //     parent::$_allowDeleted = true;
		// }

		public static function form_list()
		{
			$form_list = array(
				'name_en' => array('type' => 'text', 'label' => __('System Title(En)'), 'attr' => 'required', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required'),
				'name_tc' => array('type' => 'text', 'label' => __('系統名稱(中文)'), 'attr' => 'required', 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required'),
				'meta_keyword_en' => array('type' => 'text', 'label' => __('Meta 關鍵字(英文)'), 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim'),
				'meta_keyword_tc' => array('type' => 'text', 'label' => __('Meta 關鍵字(中文)'), 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim'),
				'meta_description_en' => array('type' => 'text', 'label' => __('Meta 描述(英文)'), 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim'),
				'meta_description_tc' => array('type' => 'text', 'label' => __('Meta 描述(中文)'), 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim'),
				'url' => array('type' => 'text', 'label' => __('URL link'), 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim'),
				'copyright' => array('type' => 'text', 'label' => __('Copyright'), 'class' => '', 'style' => '', 'value' => '', 'enable_value' => '', 'help_txt' => '', 'form_validation_rules' => 'trim|required'),
			);
	
			return $form_list;
		}
	
		public static function form_checking()
		{
			$CI = &get_instance();
			$model = $CI->router->class;
	
			if (!empty($id)) {
				$news = $model::where('id', $id)->first();
	
				if (empty($news)) {
					$_SESSION['error_msg'] = __('Cannot find data.');
					redirect(admin_url('bk_' . static::$scope));
				}
				dump($news);
			}
	
			$rules = array();
			$form_list = self::form_list();
			foreach ($form_list as $field => $row) {
				array_push($rules, array(
						'field' => $field,
						'label' => $row['label'],
						'rules' => $row['form_validation_rules'],
						'errors' => form_validation_default_errors($row['label']),
					)
				);
	
				$form_data[$field] = $CI->input->post($field);
			}
	
			$CI->form_validation->set_rules($rules);
	
			$_SESSION['message'] = '';
	
			if ($CI->form_validation->run() == FALSE || !empty($_SESSION['message'])) {
				return ['response' => 0, 'msg' => validation_errors() . '<br>' . $_SESSION['message'], 'data' => ''];
			} else {
				return ['response' => 1, 'msg' => '', 'data' => $form_data];
			}
		}
	
		public static function form_submit($form_data, $id = NULL)
		{
			$CI = &get_instance();
	
			$form_list = self::form_list();
	
			$data = array(
				'updated_at' => date("Y-m-d H:i:s"),
				'updated_by' => $_SESSION["sys_user_id"],
				'created_at' => date("Y-m-d H:i:s"),
				'created_by' => $_SESSION["sys_user_id"],
			);
	
			foreach ($form_list as $field => $row) {
				if ($row['encryption']) {
					$data[$field] = $CI->encryption->encrypt($form_data[$field]);
				} else {
					$data[$field] = $form_data[$field];
				}
			}
	
			if (empty($id)) {
				$news = self::create($data);
				if ($news->id) {
					$result['msg'] = __('新增成功。');
				}
	
			} else {
				self::where('id', $id)->update($data);
				$result['msg'] = __('Changes Saved');
	
			}
			return $result;
		}
	}	