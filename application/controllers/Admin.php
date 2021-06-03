<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require 'vendor/autoload.php';

class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->studentdata = array();
	}

	public function index()
	{
		// if(empty(session("admin_id"))){
		//     $this->login_template($this->view_directory->admin_login());
		//     $this->appkey = 'testkey101';
		// }else{
		//     redirect(base_url('index.php/Main/sdcainquiry'));
		// }
		$this->login_template($this->view_directory->admin_login());
		$this->appkey = 'testkey101';
	}
	public function loginProcess()
	{
		try {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$data = $this->adminmodel->login(array('username' => $username, 'password' => $password, 'status' => 'active'));
			if (!empty($data)) {
				$this->session->set_userdata("admin_id", $data['id']);
				$this->session->set_flashdata('success', $data['name']);
				redirect(base_url('admin/sdcainquiry'));
			} else {
				$this->session->set_flashdata('msg', 'Incorrect username or password!!');
				redirect($_SERVER['HTTP_REFERER']);
			}
		} catch (\Exception $e) {
			$this->session->set_flashdata('msg', $e);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function sdcaInquiry()
	{
		$getStudentInquiry = $this->adminmodel->getStudentInquiry();
		$count = 0;
		foreach ($getStudentInquiry as $inquiry) {
			$getStudentInquiry[$count]['total_message'] = $this->adminmodel->countTotalUnseenMessage($inquiry['ref_no']);
			++$count;
		}
		$this->data['getStudentInquiry'] = $getStudentInquiry;
		$this->chat_template($this->view_directory->chatAdmin());
	}
	public function digitalCitizenship()
	{
		$this->chat_template($this->view_directory->adminDigitalCitizenship());
	}
	public function idApplication()
	{
		$this->chat_template($this->view_directory->adminIdApplication());
	}
	// DIgital
	public function getDigitalCitizenship()
	{
		$getDigitalCitizenship = $this->adminmodel->getDigitalCitizenship();

		// $student = $this->AssesmentModel->get_student_with_course($getDigitalCitizenship['reference_number']);
		// $first_name = $this->clean($student['First_Name']);
		// $last_name = $this->clean($student['Last_Name']);
		// $getDigitalCitizenship['email'] = $first_name.'.'.$last_name.'@sdca.edu.ph';

		echo json_encode($getDigitalCitizenship);
	}
	public function getDigitalCitizenshipAccount()
	{
		$digital_id = $this->input->post('digital_id');
		$getDigitalCitizenshipAccount = $this->adminmodel->getDigitalCitizenshipAccount($digital_id);
		echo json_encode($getDigitalCitizenshipAccount);
	}

	public function updateDigitalCitizenshipAccount()
	{
		$digital_id = $this->input->post('digital_id');
		$status = $this->input->post('status');
		$array = array(
			'digital_id' => $digital_id,
			'status' => $status,
		);
		$this->adminmodel->updateDigitalCitizenshipAccount($array);
	}
	// ID 
	public function getIdApplication()
	{
		$getIdApplication = $this->adminmodel->getIdApplication();
		echo json_encode($getIdApplication);
	}
	public function updateIdApplication()
	{
		$id_application = $this->input->post('id_application');
		$status = $this->input->post('status');
		// die($id_application);
		$array = array(
			'id_application' => $id_application,
			'status' => $status,
		);
		$this->adminmodel->updateIdApplication($array);
	}

	public function logout()
	{
		$this->session->set_userdata("admin_id");
		redirect(base_url('admin/'));
	}

	function test_name()
	{
		$student = $this->AssesmentModel->get_student_with_course($this->reference_number);
		$first_name = $this->clean($student['First_Name']);
		$last_name = $this->clean($student['Last_Name']);
		echo $first_name.'.'.$last_name.'@sdca.edu.ph';
	}

	function clean($string)
	{
		$trim = trim($string);
		$trim_string = str_replace(' ', '', $trim);
		return strtolower($trim_string);
	}
}
