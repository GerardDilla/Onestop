<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends MY_Controller
{

	public function index()
	{
		//$this->load->view('Body/index');
		// $this->default_template($this->view_directory->assessment());
		// echo 'hello';
		$this->login_template($this->view_directory->login());
	}
	// 
	public function selfassesment()
	{

		$this->data['student_information'] = 'Body/AssessmentContent/StudentInformation';
		$this->data['advising'] = 'Body/AssessmentContent/Advising';
		$this->data['payment'] = 'Body/AssessmentContent/Payment';
		$this->data['advising_modals'] = 'Body/AssessmentContent/AdvisingModals';

		$this->default_template($this->view_directory->assessment());
	}
	// 
	public function wizard_tracker_status()
	{
		$ref_no = $this->input->post('Reference_Number');
		$this->load->database();
		$this->load->model('WizardModel');
		$status = $this->WizardModel->tracker_status();
		$data['registration'] = 0;
		$data['advising'] = 0;
		$data['student_information'] = 1;
		// if ($status['Ref_Num_fec'] != null && $status['Ref_Num_si'] != null && $status['Ref_Num_ftc'] != null) {
		// 	$data['registration'] = 1;
		// } else if ($status['Ref_Num_ftc'] != null) {
		// 	$data['advising'] = 1;
		// } else {
		// 	$data['student_information'] = 1;
		// }
		echo json_encode($data);
		// return json_encode($data);
	}

	public function forgotPassword()
	{
		$this->login_template($this->view_directory->forgotPassword());
	}
	public function changePassword()
	{
		$this->login_template($this->view_directory->changePassword());
	}
	public function passwordReset()
	{
		$this->default_template($this->view_directory->passwordReset());
	}
	public function logout()
	{
		redirect(base_url('/'));
	}
}
