<?php
defined('BASEPATH') or exit('No direct script access allowed');

class temp_api extends CI_Controller
{

	public function __construct()
	{

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');
		header('Access-Control-Request-Headers: Content-Type');

		parent::__construct();
	}
	public function index()
	{
		echo 'test';
	}
	public function subjectchoices()
	{
	}
	public function test()
	{

		$test = $this->input->post();
		$response = [
			'Input' => $test,
			'Status' => $test ? 'Received' . $test : 'Fail'
		];

		return $this->response->setJSON($response);
	}
}
