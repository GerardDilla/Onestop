<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BELL_TEST_CONTROLLER extends MY_Controller {

	public function index()
	{
		// $this->data['student_information'] = 'Body/Assessment_Content/Payment';
		// $student_information = $this->load->view('Body/Student_Information');
		// $this->data['testing_data']='asdsadasdasdsadas';
		$this->data['student_information'] = 'Body/Assessment_Content/Student_Information';
		$this->data['advising'] = 'Body/Assessment_Content/Advising';
		$this->data['payment'] = 'Body/Assessment_Content/Payment';
		$this->default_template($this->view_directory->bell_test_directory());

	}
}
?>