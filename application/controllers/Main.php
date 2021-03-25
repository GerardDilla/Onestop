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
		$this->appkey = 'testkey101';
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
		//$this->curl_test();
		$this->data['student_information'] = 'Body/Assessment_Content/Student_Information';
		$this->data['advising'] = 'Body/Assessment_Content/Advising';
		$this->data['payment'] = 'Body/Assessment_Content/Payment';
		$this->default_template($this->view_directory->assessment());
	}
	private function curl_test()
	{

		$url = base_url() . 'index.php/temp_api/test';
		$fields = [
			'name '      => 'gerard',
			'type' => 'admin'
		];
		$fields_string = http_build_query($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		echo $result;
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
