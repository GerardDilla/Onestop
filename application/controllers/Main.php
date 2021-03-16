<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index()
	{
		//$this->load->view('Body/index');
		// $this->default_template($this->view_directory->assessment());
		// echo 'hello';
		$this->login_template($this->view_directory->login());
	}
	public function forgotPassword(){
		$this->login_template($this->view_directory->forgotPassword());
	}
	public function changePassword(){
		$this->login_template($this->view_directory->changePassword());
	}
	public function selfassesment(){
		$this->default_template($this->view_directory->assessment());
	}
	public function passwordReset(){
		$this->default_template($this->view_directory->passwordReset());
	}
	public function logout(){
		redirect(base_url('/'));
	}
}
