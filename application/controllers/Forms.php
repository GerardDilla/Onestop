<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms extends MY_Controller
{
	function __construct() {
        parent::__construct();
		$this->load->model('FormsModel');
    }

	public function index()
	{

    }
    public function digital_citizenship()
	{
		$this->default_template($this->view_directory->digitalCitizenship());
	}
	public function submit_digital_citizenship(){
		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$last_name = $this->input->post('last_name');
		$course = $this->input->post('course');
		$email = $this->input->post('email');
		$concern = $this->input->post('concern'); // Array
		$request = '';
		$request_details = $this->input->post('request_details');
		$request_textfield = $this->input->post('request_others_textfield');
		if($request_details == 'request_others'){
			$request = $request_textfield;
		}else{
			$request = $request_details;
		}
		// foreach($concern as $concerns){
		// 	echo $concerns;
		// }
		$array = array(
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'course' => $course,
			'email' => $email,
			'request' => $request,
		);
		$digital_id = $this->FormsModel->digital_citizenship($array);
	}
    public function id_application()
	{
		$this->default_template($this->view_directory->idApplication());
	}
}
?>