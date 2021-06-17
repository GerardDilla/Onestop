<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('FormsModel');
		$this->load->library('session');
		// $this->load->library('gdrive_uploader', array('folder_id' => '1ule2fZTDODUKtTNzqSPD-taEqAUYuPKZ'));
		$this->load->library('gdrive_uploader', array('folder_id' => '15hfHgkH02M7MW5h9-vHxUbut-HYaOamr'));
		$this->reference_number = $this->session->userdata('reference_no');
	}

	public function index()
	{
		// $this->data['DigitalCitizenship'] = 'Body/CitizenshipAndId/DigitalCitizenship';
		// $this->data['IdApplication'] = 'Body/CitizenshipAndId/IdApplication';
		$id_app = $this->FormsModel->check_student_id($this->reference_number);
		empty($id_app['count']) ? $this->data['id_app'] = true : $this->data['id_app'] = false;
		$digital = $this->FormsModel->check_student_digital($this->reference_number);
		empty($digital['count']) ? $this->data['digital'] = true : $this->data['digital'] = false;

		$this->default_template($this->view_directory->digitalAndIdForms());
		// $this->digital_citizenship();
		// $this->id_application();
	}

	public function digitalAndIdSubmit()
	{
		$config['upload_path'] = './express/assets/';
		$config['allowed_types'] = '*';
		//DIGITAL
		$digital_id = $this->FormsModel->check_student_digital($this->reference_number);
		$check_data = empty($digital_id['count']) ? "no_data" : $digital_id['count'];
		if ($check_data == 'no_data') {
			$first_name = $this->input->post('digital-first_name');
			$middle_name = $this->input->post('digital-middle_name');
			$last_name = $this->input->post('digital-last_name');
			$array = array(
				'reference_number' => $this->reference_number,
				'first_name' => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
			);
			$digital_id = $this->FormsModel->digital_citizenship($array);
			$accounts = $this->input->post('concern');
			foreach (empty($accounts) ?: $accounts as $account) {
				$array_account = array(
					'digital_id' => $digital_id,
					'request' => $account,
					'status' => 'pending',
				);
				$this->FormsModel->digital_citizenship_account($array_account);
			}
			// $this->session->set_flashdata('success', 'Digital Citizenship send');
			// redirect('forms/digital_citizenship');
		} else {
			// $this->session->set_flashdata('error', 'Already Created');
			// redirect('forms/digital_citizenship');
		}
		// ID
		$id_app = $this->FormsModel->check_student_id($this->reference_number);
		$check_data = empty($id_app['count']) ? "no_data" : $id_app['count'];

		$array_files = array();
		$array_filestodelete = array();
		$error_count = 0;
		if ($check_data == 'no_data') {
			$first_name = $this->input->post('id-first_name');
			$middle_name = $this->input->post('id-middle_name');
			$last_name = $this->input->post('id-last_name');
			$config['file_name'] = 'id_picture_' . $this->reference_number . '' . date("YmdHis");
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('id_picture')) {
				$uploaded_data = $this->upload->data();
				array_push($array_files, array(
					"name" => $uploaded_data['orig_name'],
					"type" => $uploaded_data['file_type']
				));
				array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
			} else {
				++$error_count;
			}
			$config['file_name'] = 'signature_' . $this->reference_number . '' . date("YmdHis");
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('signature')) {
				$uploaded_data = $this->upload->data();
				array_push($array_files, array(
					"name" => $uploaded_data['orig_name'],
					"type" => $uploaded_data['file_type']
				));
				array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
			} else {
				++$error_count;
			}
			if ($error_count == 0) {
				// $result = $this->gdrive_uploader->index(array("folder_name" => $this->reference_number . '/'.strtoupper($this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') . ' ' . $this->session->userdata('last_name')), "data" => $array_files));

				$result = $this->gdrive_uploader->uploadWithDifferentToken(array("token_type" => 'des', "folder_name" => $this->reference_number . '/' . strtoupper($this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') . ' ' . $this->session->userdata('last_name')), "data" => $array_files));
				$decode_result = json_decode($result, true);
				// echo json_encode($decode_result['id']);
				// die(json_encode($decode_result['id']));
				// exit;
				$files = glob('express/assets/*'); // get all file names
				foreach ($files as $file) {
					if (in_array($file, $array_filestodelete)) {
						if (is_file($file)) {
							unlink($file); // delete file
						}
					}
				}
				if (!empty($result)) {
					if ($decode_result['msg'] == "success") {
						$array = array(
							'reference_number' => $this->reference_number,
							'first_name' => $first_name,
							'middle_name' => $middle_name,
							'last_name' => $last_name,
							'status' => 'pending',
							'gdrive_folder_id' => $decode_result['id'],
						);
						$digital_id = $this->FormsModel->id_application($array);
						$this->session->set_flashdata('success', 'ID Application send');
						redirect($_SERVER['HTTP_REFERER']);
						return;
					} else {
						$this->session->set_flashdata('error', "Files Upload Error: " . $result);
						redirect($_SERVER['HTTP_REFERER']);
						return;
					}
				} else {
					$this->session->set_flashdata('error', "Files Upload Error: Google drive is OFFLINE");
					redirect($_SERVER['HTTP_REFERER']);
					return;
				}
			} else {
				$this->session->set_flashdata('error', 'Failed to Upload');
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}
		} else {
			$this->session->set_flashdata('error', 'Failed to Upload');
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
	}

	// public function tokenHandler($type){
	// 	if(isset($this->session->csrf_token)){
	// 		if(isset($this->session->csrf_token[$type])){
	// 			if($this->session->csrf_token[$type]==""||$this->session->csrf_token[$type]!=$this->input->post('b3df6e650330df4c0e032e16141f')){
	// 				echo 'Something went wrong!';
	// 				exit;
	// 			}
	// 		}else{
	// 			echo 'Something went wrong!';
	// 			exit;
	// 		}
	// 	}else{
	// 		echo 'Something went wrong!';
	// 		exit;
	// 	}
	// 	$_SESSION['csrf_token'][$type] = '';
	// }
	public function digital_data()
	{
	}

	public function digital_citizenship()
	{
		// generate token
		// $token = hash('tiger192,3', uniqid());
		// $this->data['csrf_token'] = $token;
		// $_SESSION['csrf_token']['digital'] = $token;

		$digital = $this->FormsModel->check_student_digital($this->reference_number);
		empty($digital['count']) ? $this->data['digital'] = true : $this->data['digital'] = false;

		$this->default_template($this->view_directory->digitalCitizenship());
	}
	public function submit_digital_citizenship()
	{
		// $this->tokenHandler('digital');

		$digital_id = $this->FormsModel->check_student_digital($this->reference_number);
		$check_data = empty($digital_id['count']) ? "no_data" : $digital_id['count'];
		if ($check_data == 'no_data') {
			$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
			$last_name = $this->input->post('last_name');
			$array = array(
				'reference_number' => $this->reference_number,
				'first_name' => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
			);
			$digital_id = $this->FormsModel->digital_citizenship($array);
			$accounts = $this->input->post('concern');
			foreach (empty($accounts) ?: $accounts as $account) {
				$array_account = array(
					'digital_id' => $digital_id,
					'request' => $account,
					'status' => 'pending',
				);
				$this->FormsModel->digital_citizenship_account($array_account);
			}
			$this->session->set_flashdata('success', 'Digital Citizenship send');
			redirect('forms/digital_citizenship');
		} else {
			$this->session->set_flashdata('error', 'Already Created');
			redirect('forms/digital_citizenship');
		}
	}
	public function ajaxGetStudent()
	{
		$student = $this->AssesmentModel->get_student_with_course($this->reference_number);
		echo json_encode($student);
	}
	public function id_data()
	{
		// generate token
		$token = hash('tiger192,3', uniqid());
		$this->data['csrf_token'] = $token;
		$_SESSION['csrf_token']['digital'] = $token;

		$id_app = $this->FormsModel->check_student_id($this->reference_number);
		empty($id_app['count']) ? $this->data['id_app'] = true : $this->data['id_app'] = false;
	}
	public function id_application()
	{
		$this->id_data();
		$this->default_template($this->view_directory->idApplication());
	}
	public function submit_id_application()
	{

		$config['upload_path'] = './express/assets/';
		$config['allowed_types'] = '*';

		$id_app = $this->FormsModel->check_student_id($this->reference_number);
		$check_data = empty($id_app['count']) ? "no_data" : $id_app['count'];

		$array_files = array();
		$array_filestodelete = array();
		$error_count = 0;
		if ($check_data == 'no_data') {
			$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
			$last_name = $this->input->post('last_name');
			$config['file_name'] = 'id_picture_' . $this->reference_number . '' . date("YmdHis");
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('id_picture')) {
				$uploaded_data = $this->upload->data();
				array_push($array_files, array(
					"name" => $uploaded_data['orig_name'],
					"type" => $uploaded_data['file_type']
				));
				array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
			} else {
				++$error_count;
			}
			$config['file_name'] = 'signature_' . $this->reference_number . '' . date("YmdHis");
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('signature')) {
				$uploaded_data = $this->upload->data();
				array_push($array_files, array(
					"name" => $uploaded_data['orig_name'],
					"type" => $uploaded_data['file_type']
				));
				array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
			} else {
				++$error_count;
			}
			if ($error_count == 0) {
				// $result = $this->gdrive_uploader->index(array("folder_name" => $this->reference_number . '/'.strtoupper($this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') . ' ' . $this->session->userdata('last_name')), "data" => $array_files));

				$result = $this->gdrive_uploader->uploadWithDifferentToken(array("token_type" => 'des', "folder_name" => $this->reference_number . '/' . strtoupper($this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') . ' ' . $this->session->userdata('last_name')), "data" => $array_files));
				$decode_result = json_decode($result, true);
				// echo json_encode($decode_result['id']);
				// die(json_encode($decode_result['id']));
				// exit;
				$files = glob('express/assets/*'); // get all file names
				foreach ($files as $file) {
					if (in_array($file, $array_filestodelete)) {
						if (is_file($file)) {
							unlink($file); // delete file
						}
					}
				}
				if (!empty($result)) {
					if ($decode_result['msg'] == "success") {
						$array = array(
							'reference_number' => $this->reference_number,
							'first_name' => $first_name,
							'middle_name' => $middle_name,
							'last_name' => $last_name,
							'status' => 'pending',
							'gdrive_folder_id' => $decode_result['id'],
						);
						$digital_id = $this->FormsModel->id_application($array);
						$this->session->set_flashdata('success', 'ID Application send');
						redirect($_SERVER['HTTP_REFERER']);
						return;
					} else {
						$this->session->set_flashdata('error', "Files Upload Error: " . $result);
						redirect($_SERVER['HTTP_REFERER']);
						return;
					}
				} else {
					$this->session->set_flashdata('error', "Files Upload Error: Google drive is OFFLINE");
					redirect($_SERVER['HTTP_REFERER']);
					return;
				}
			} else {
				$this->session->set_flashdata('error', 'Failed to Upload');
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}
		} else {
			$this->session->set_flashdata('error', 'Failed to Upload');
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
	}
}
