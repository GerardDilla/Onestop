<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index()
	{
		//$this->load->view('Body/index');
		$this->default_template($this->view_directory->assessment());

	}
}
