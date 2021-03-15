<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BELL_TEST_CONTROLLER extends MY_Controller {

	public function index()
	{
		//$this->load->view('Body/index');
		$this->default_template($this->view_directory->bell_test_directory());

	}
}
?>