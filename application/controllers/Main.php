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

		$this->data['student_information'] = 'Body/Assessment_Content/Student_Information';
		$this->data['advising'] = 'Body/Assessment_Content/Advising';
		$this->data['payment'] = 'Body/Assessment_Content/Payment';

		//The url you wish to send the POST request to
		$url = base_url() . 'index.php/temp_api/test';

		//The data you want to send via POST
		$fields = [
			'name '      => 'gerard',
			'type' => 'admin'
		];

		//url-ify the data for the POST
		$fields_string = http_build_query($fields);

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

		//So that curl_exec returns the contents of the cURL; rather than echoing it
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//execute post
		$result = curl_exec($ch);
		echo $result;

		//$this->default_template($this->view_directory->assessment());
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
