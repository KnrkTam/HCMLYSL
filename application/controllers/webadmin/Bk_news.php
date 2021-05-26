<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	use Illuminate\Database\Capsule\Manager as DB;

	class Bk_news extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->load->model('News_model');
		}


		public function create()
		{
			check_sys_user_login(['create_news']);

			$this->load->view('webadmin/news_form');
		}

		public function delete($id)
		{
			check_sys_user_login(['delete_news']);

			$result = News_model::find($id);

			$data = array(
				"deleted"    => 1,
				"deleted_by" => $_SESSION['sys_user_id'],
				"deleted_at" => date('Y-m-d H:i:s'),
			);
			News_model::where('id', $id)->update($data);

			//update sort
			$db_result = DB::table('news')->where('sort', '>', $result['sort'])->update(['sort' => DB::raw('sort-1')]);

			if ($db_result) {
				$_SESSION["success_msg"] = __('Update Successfully');
			}

			redirect(admin_url('bk_news'));
		}

		public function index()
		{
			check_sys_user_login(['view_news']);

			/*$result = _curl('http://musicpro.musiccircle.hk/uat/test.php', array('test' => 123), 1);
			var_dump($result);*/

			$data["news_index"] = News_model::get();
//			var_dump($data);
			$this->load->view('webadmin/news_index', $data);
		}

        public function delete_multiple_upload()
        {
            check_sys_user_login(['view_news']);

            $id = $this->input->post('key');
            $photo = News_photo_model::find($id);
            if ($photo->id) {
                $photo->delete()->save();
                $path = FCPATH . 'assets/files/' . $photo->photo;
                if (file_exists($path)) {
                    unlink($path);
                }
                $path = FCPATH . 'assets/files/thumb/' . $photo->photo;
                if (file_exists($path)) {
                    unlink($path);
                }
                echo json_encode(array());
            } else {
                echo json_encode(array('error' => __('Failed to delete')));
            }
        }

		public function modify($id)
		{
			check_sys_user_login(['view_news']);

			$query = News_model::find($id);
			if (empty($query)) {
                redirect(admin_url('bk_news'));
			} else {
				$data = $query->toArray();
			}

            $photos = array();
            $photos_preview = array();
            foreach ($query->photos as $photo) {
                $photos[] = array(
                    'key'   => $photo->id,
                );
                $photos_preview[] = assets_url('files/' . $photo->photo);
            }
            $data['photos_json'] = json_encode($photos);
            $data['photos_preview'] = json_encode($photos_preview);

			$data["id"] = $id;

			$this->load->view('webadmin/news_form', $data);
		}

		public function sort()
		{
			check_sys_user_login(['update_news']);

			$sorts = $this->input->post('sort');
			if (!empty($sorts)) {
				foreach ($sorts as $id => $sort) {
					$data = array(
						"sort"       => $sort,
						//'updated_at' => date("Y-m-d H:i:s"),
						//'updated_by' => $_SESSION["sys_user_id"],
					);
					News_model::where('id', $id)->update($data);
				}
			}

			$_SESSION["success_msg"] = __('Update Successfully');
            redirect(admin_url('bk_news'));
		}

		public function status($id, $status)
		{
			check_sys_user_login(['update_news']);

			$data = array(
				"status"     => $status,
				'updated_by' => $_SESSION["sys_user_id"],
			);
			News_model::where('id', $id)->update($data);

			$_SESSION['success_msg'] = __('Update Successfully.');

            redirect(admin_url('bk_news'));
		}

		public function submit_form($id = null)
		{
			check_sys_user_login(['create_news', 'update_news']);

			//tackle language parameter
			if(!is_numeric($id)){
				$id = null;
			}

            /** CodeIgniter Form Validation Checking
             *
             * You need to put all post data on this list (include hidden field)
             *
             * Rules ref:
             * https://www.codeigniter.com/user_guide/libraries/form_validation.html#rule-reference
             */

            $rules = array(
                array(
                    'field' => 'cover_img',
                    'label' => __('Cover Image'),
                    'rules' => 'trim',
                ),
                array(
                    'field' => 'title',
                    'label' => __('Title'),
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'short_content',
                    'label' => __('Short Content'),
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'content',
                    'label' => __('Content'),
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'date',
                    'label' => __('News Date'),
                    'rules' => 'trim|required|callback_validate_date',
                ),
                array(
                    'field' => 'start_date',
                    'label' => __('Start Date'),
                    'rules' => 'trim|required|callback_validate_start_date',
                    'errors' => array(
                        'validate_date' => __('Please enter correct ') . ' %s.'
                    )
                ),
                array(
                    'field' => 'end_date',
                    'label' => __('End Date'),
                    'rules' => 'trim|required|callback_validate_end_date',
                    'errors' => array(
                        'validate_date' => __('Please enter correct ') . ' %s.'
                    )
                ),
                array(
                    'field' => 'del_img',
                    'label' => __('Delete cover image'),
                    'rules' => 'is_natural',
                ),
                array(
                    'field' => 'del_single_upload',
                    'label' => __('Delete single image upload'),
                    'rules' => 'is_natural',
                ),
            );

            $this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == false) {
				if (empty($id)) {
					$this->create();
				} else {
					$this->modify($id);
				}
			} else {
			    //save form submitted data to $form_data
			    $form_data = array();
			    foreach ($rules as $rule){
                    $form_data[$rule['field']] = $this->input->post($rule['field']);
                }

                // check user delete cover image or not
                $cover_img = $this->input->post('del_img') == 1 ? '' : $form_data['cover_img'];

                $data = array(
                    'cover_img'     => $cover_img,
                    'title'         => $this->input->post('title'),
                    'short_content' => $this->input->post('short_content'),
                    'content'       => $this->input->post('content'),
                    'date'          => $this->input->post('date'),
                    'start_date'    => $this->input->post('start_date'),
                    'end_date'      => $this->input->post('end_date'),
                    'updated_at'    => date("Y-m-d H:i:s"),
                    'updated_by'    => $_SESSION["sys_user_id"],
                );

                //single image upload
                $upload_path = FCPATH . 'assets/files/';
                $single_upload = single_upload('single_upload', array(
                    'upload_path'   => $upload_path,
                    'allowed_types' => 'jpeg|jpg|png',
                    'max_size'      => 2048,
                    'max_width'     => 1980,
                    'max_height'    => 678,
                    'encrypt_name'  => true,
                ));
                //if success return $single_upload['filename'] else return $single_upload['error']

                if ($single_upload['error']) {
                    $_SESSION['error_msg'] = $single_upload['error'];
                    history_back();
                }else if($single_upload['filename']) {
                    $data['single_upload'] = $single_upload['filename'];
                }
                if($id && $form_data['del_single_upload'] == 1){
			        $news_model = News_model::find($id);
			        if($news_model->id) {
                        $file_path = $upload_path.$news_model->single_upload;
                        if (file_exists($file_path)) {
                            $data['single_upload'] = ''; // remove on database
                            unlink($file_path);
                        }
                    }
                }
                //end of single image upload


                // multiple image upload
                $photos = multi_upload('multiple_upload', array(
                    'upload_path'   => FCPATH . 'assets/files/',
                    'allowed_types' => 'jpeg|jpg|png',
                    'max_size'      => 2048,
                    'max_width'     => 780,
                    'max_height'    => 424,
                    'encrypt_name'  => true,
                ), array( // create thumbnail image
                    'width'  => 121,
                    'height' => 66,
                ));

				//insert into database
				if (empty($id)) {
					validate_user_access(['create_news'], 0);

					$data['sort']       = News_model::max('sort') + 1;
					$data['created_at'] = date("Y-m-d H:i:s");
					$data['created_by'] = $_SESSION["sys_user_id"];
					$news_model = News_model::create($data);

					$_SESSION['success_msg'] = __('Create Successfully.');
				} else {
					validate_user_access(['update_news'], 0);
                    $news_model = News_model::find($id);
					News_model::where('id', $id)->update($data);

					$_SESSION['success_msg'] = __('Update Successfully.');
				}


				if($news_model->id && !empty($photos)) {
                    foreach ($photos as $photo) {
                        News_photo_model::create(array(
                            'news_id' => $news_model->id,
                            'photo'   => $photo
                        ));
                    }
                }

                redirect(admin_url('bk_news'));
			}
		}

		//validate datetime
		public function validate_date()
		{
			$format = 'Y-m-d';
			$d      = DateTime::createFromFormat($format, $this->input->post('date'));
			return $d && $d->format($format) == $this->input->post('date');
		}

		//validate datetime
		public function validate_end_date()
		{
			$format = 'Y-m-d H:i:s';
			$d      = DateTime::createFromFormat($format, $this->input->post('end_date'));
			return $d && $d->format($format) == $this->input->post('end_date');
		}

		//validate datetime
		public function validate_start_date()
		{
			$format = 'Y-m-d H:i:s';
			$d      = DateTime::createFromFormat($format, $this->input->post('start_date'));
			return $d && $d->format($format) == $this->input->post('start_date');
		}

	}
