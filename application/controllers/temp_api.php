<?php
defined('BASEPATH') or exit('No direct script access allowed');

class temp_api extends CI_Controller
{
	protected $reference_number;
	protected $student_number;
	protected $legend_sy;
	protected $legend_sem;
	public function __construct()
	{

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');
		header('Access-Control-Request-Headers: Content-Type');
		$this->validkey = 'testkey101';
		parent::__construct();
		$this->load->model('AdvisingModel');

		#Temporary Keys
		$this->reference_number = '12345';
		$this->student_number = '20202020';
		#Temporary Legends
		$this->legend_sy = '2020-2021';
		$this->legend_sem = 'FIRST';
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
		$result = $this->AdvisingModel->block_schedule($params);
		echo json_encode($result);
	}
	public function queue_subject_list()
	{
		$result = $this->AdvisingModel->get_queued_subjects($this->reference_number);
		echo json_encode($result);
	}
	public function queue_subject()
	{

		# 1. Check if required parameters are complete

		# 2. Check if slot is available

		# 3. Check if there are schedule conflicts

		
		//get year level
		//$year_level = $this->Student_Model->get_year_level($array_data);
		// $year_level = $this->Student_Model->get_year_level_v2($array_data);
		// if ($year_level[0]['Year_Level'] === 0) {
		// 	$year_level[0]['Year_Level'] = 1;
		// }

		// //status
		// if ($this->input->get('studType') === 'open') {
		// 	$status = "IRREGULAR";
		// } else {
		// 	# code...
		// 	$status = "REGULAR";
		// }
		$inputs = array(
			'SchedCode' => $this->input->post('schedcode'),
		);
		$schedData = $this->AdvisingModel->get_sched_info($inputs['SchedCode'])[0];

		//add the sched to session
		$array_insert = array(
			'Reference_Number' => $this->reference_number,
			'Student_Number' => $this->student_number,
			'Sched_Code' => $schedData['Sched_Code'],
			'Sched_Display_ID' => $schedData['sched_display_id'],
			'Semester' => $this->legend_sem,
			'School_Year' => $this->legend_sy,
			'Scheduler' => 'SELF',
			'Status' => 'NEEDS OTHER DATA',
			'Program' => 'NEEDS OTHER DATA',
			'Major' => 'NEEDS OTHER DATA',
			'Year_Level' => 'NEEDS OTHER DATA',
			'Section' =>  'NEEDS OTHER DATA',
			'Graduating' =>  'NEEDS OTHER DATA',
		);
		$status = $this->AdvisingModel->insert_sched_session($array_insert);
		echo $status;
	}

	public function unqueue_subject()
	{

		$id = $this->input->post('sessionId');
		$this->AdvisingModel->remove_advising_session($id);
		echo json_encode('removed');
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
