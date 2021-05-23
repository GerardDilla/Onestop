<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('FormsModel');
		$this->load->library('session');

		$this->reference_number = $this->session->userdata('reference_no');
	}

	public function index()
	{
	}
	public function digital_citizenship()
	{
		$this->default_template($this->view_directory->digitalCitizenship());
	}
	public function submit_digital_citizenship()
	{
		$digital_id = $this->FormsModel->check_student_digital($this->reference_number);
		// die(($digital_id['count']));
		$check_data = empty($digital_id['count']) ? "no_data" : $digital_id['count'];
		if ($check_data == 'no_data') {
			$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
			$last_name = $this->input->post('last_name');
			// die($email);

			// $concern = $this->input->post('concern');

			// foreach($concern as $concerns){
			// 	echo $concerns;
			// }
			// $
			$array = array(
				'reference_number' => $this->reference_number,
				'first_name' => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
				// 'course' => $course,
				// 'email' => $email,
			);
			$digital_id = $this->FormsModel->digital_citizenship($array);
			$this->session->set_flashdata('success', 'Digital Citizenship send');
			redirect('forms/digital_citizenship');
		}else{
			$this->session->set_flashdata('error', 'Already Created');
			redirect('forms/digital_citizenship');
		}
	}
	public function ajaxGetStudent()
	{
		$student = $this->AssesmentModel->get_student_with_course($this->reference_number);
		echo json_encode($student);
	}
	public function id_application()
	{
		$this->default_template($this->view_directory->idApplication());
	}
	public function submit_id_application()
	{
		$id_app = $this->FormsModel->check_student_id($this->reference_number);
		// die(($digital_id['count']));
		$check_data = empty($id_app['count']) ? "no_data" : $id_app['count'];
		if ($check_data == 'no_data') {
			$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
			$last_name = $this->input->post('last_name');
			// die($email);

			// $concern = $this->input->post('concern');

			// foreach($concern as $concerns){
			// 	echo $concerns;
			// }
			// $
			$array = array(
				'reference_number' => $this->reference_number,
				'first_name' => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
				'status' => 'pending',
				// 'course' => $course,
				// 'email' => $email,
			);
			$digital_id = $this->FormsModel->id_application($array);
			$this->session->set_flashdata('success', 'ID Application send');
			redirect('forms/id_application');
		}else{
			$this->session->set_flashdata('error', 'Already Have Data');
			redirect('forms/id_application');
		}
	}
}
