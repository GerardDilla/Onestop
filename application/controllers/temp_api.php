<?php
defined('BASEPATH') or exit('No direct script access allowed');

class temp_api extends CI_Controller
{

	public function __construct()
	{

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');
		header('Access-Control-Request-Headers: Content-Type');
		$this->validkey = 'testkey101';
		parent::__construct();
		$this->load->model('Advising');
	}
	public function index()
	{
		echo 'test';
	}
	public function subjects()
	{
		$params = array(
			'school_year' => $this->input->get('school_year'),
			'semester' => $this->input->get('semester'),
			'section' => $this->input->get('section'),
		);
		// die(json_encode($params));
		$result = $this->Advising->block_schedule($params);
		echo json_encode($result);
	}
	public function test()
	{
		$test = $this->input->post();
		$response = [
			'Input' => $test,
			'Status' => !empty($test) ? 'Received' : 'Fail'
		];
		echo json_encode($response);
	}
}
