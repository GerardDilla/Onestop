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
	public function forgotPassword()
	{
		$this->login_template($this->view_directory->forgotPassword());
	}
	public function changePassword()
	{
		$this->login_template($this->view_directory->changePassword());
	}
	public function selfassesment()
	{

		$this->data['student_information'] = 'Body/Assessment_Content/Student_Information';
		$this->data['advising'] = 'Body/Assessment_Content/Advising';
		$this->data['payment'] = 'Body/Assessment_Content/Payment';

		$this->default_template($this->view_directory->assessment());
	}
	public function passwordReset()
	{
		$this->default_template($this->view_directory->passwordReset());
	}
	public function logout()
	{
		redirect(base_url('/'));
	}
	public function wizard_tracker_status()
	{
		$this->load->database();
		$this->load->model('WizardModel', 'wizard_model');
		$status = $this->wizard_model->tracker_status();
		$data['enrolled'] = 0;
		$data['payment'] = 0;
		$data['advising'] = 0;
		if ($status['Ref_Num_fec'] != null && $status['Ref_Num_si'] != null && $status['Ref_Num_ftc'] != null) {
			$data['enrolled'] = 1;
		} else if ($status['Ref_Num_ftc'] != null) {
			$data['payment'] = 1;
		} else {
			$data['advising'] = 1;
		}
		echo json_encode($data);
		return $data;
	}
}
