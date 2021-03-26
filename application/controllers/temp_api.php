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
	public function queue_subject()
	{
		$array_output = array();

		# 1. Check if required parameters are complete

		# 2. Check if slot is available

		# 3. Check if there are schedule conflicts

		$array_data = array(
			'sched_display_id' => $this->input->get('schedDisplayId'),
			'reference_no' => $this->input->get('referenceNo'),
			'student_no' => $this->input->get('Student_Number'),
			'school_year' => $this->input->get('schoolYear'),
			'semester' => $this->input->get('semester'),
			'section' => $this->input->get('section'),
			'unittype' => $this->input->get('unittype'),
			'unitnumber' => ''
		);

		//check if unit is checked
		if (!isset($array_data['unittype'])) {

			$array_output['success'] = 0;
			$array_output['message'] = "Please Choose if Student is Graduating or Non Graduating.";
			echo json_encode($array_output);
			return;
		}

		//check if course have pre req
		$course_info = $this->Course_Model->get_course_pre_req($array_data);
		if ($course_info == NULL) {
			# code...
			$array_output['success'] = 0;
			$array_output['message'] = "No Data";
			echo json_encode($array_output);
			return;
		}

		$array_data['course_code'] = $course_info[0]['subject'];

		//check if sched is already added
		$course_duplicate = $this->Student_Model->check_sched_session_duplicate($array_data);
		if ($course_duplicate != NULL) {
			$array_output['success'] = 0;
			$array_output['selected'] = 1;
			$array_output['message'] = $course_info[0]['subject'] . " is already selected.";
			echo json_encode($array_output);
			return;
		}


		//check if bypass is activated
		if (($this->session->advising_bypass) && ($this->session->advising_bypass['advising_bypass'] === true)) {
			# code...
			//insert bypass log
			$this->array_bypass_logs['bypassers_id'] = $this->session->advising_bypass['program_chair_id'];
			$this->array_bypass_logs['action'] = 'Added(' . $this->input->get('schedDisplayId') . ') Bypass(prerequisite)';
			$this->array_bypass_logs['reference_no'] = $this->input->get('referenceNo');
			$this->Module_Bypass_Model->insert_logs($this->array_bypass_logs);
			$this->session->unset_userdata('advising_bypass');
		}
		//check if the student passed the pre req course
		elseif ($course_info[0]['pre_req'] != NULL) {
			//insert bypass checker here
			if ($this->input->get('bypassCheck') === "1") {
				# code...
				$array_output['success'] = 2;
				$array_output['message'] = "Directing to Bypass Login";
				echo json_encode($array_output);
				return;
			} elseif ($student_info[0]['Reference_Number'] === 0) {
				$array_output['success'] = 0;
				$array_output['message'] = "Please enroll " . $course_info[0]['pre_req'] . " first.";
				echo json_encode($array_output);
				return;
			}

			//get student grades
			$array_data['course_code_pre_req'] = $course_info[0]['pre_req'];
			$student_course_result = $this->Student_Model->get_student_course_grade($array_data);

			//check if the student have taken the course
			if ($student_course_result == NULL) {
				$array_output['success'] = 0;
				$array_output['message'] = "Please enroll " . $course_info[0]['pre_req'] . " first.";
				echo json_encode($array_output);
				return;
			}

			//get legend data for bypass pre req req
			$legend_data = $this->Schedule_Model->get_legend();

			//remarks name
			if ($student_course_result[0]['Remarks_ID'] === 3) {
				# code...
				$remarks_type = "INC";
			} elseif ($student_course_result[0]['Remarks_ID'] === 8) {
				$remarks_type = "Ongoing";
			} elseif ($student_course_result[0]['Remarks_ID'] === 0) {
				$remarks_type = "Not yet Encoded";
			} elseif ($student_course_result[0]['Remarks_ID'] === 1) {
				# code...
				$remarks_type = "Passed";
			} else {
				# code...
				$remarks_type = "Failed";
			}

			//approve by using module bypass
			if ((($student_course_result[0]['Remarks_ID'] === 3) or ($student_course_result[0]['Remarks_ID'] === 8) or ($student_course_result[0]['Remarks_ID'] === 0)) && ($legend_data[0]['BypassPre'] === 1)) {
				# code...

				$array_output['message'] = "Note: The subject that you are trying to add have pre requisite of subject " . $course_info[0]['pre_req'] . " and is " . $remarks_type;
			} else
			//if($student_course_result[0]['Final_Grade'] < 75.00) //check if the student passed 
			{
				if (($student_course_result[0]['Remarks_ID'] === 3) or ($student_course_result[0]['Remarks_ID'] === 8) or ($student_course_result[0]['Remarks_ID'] === 0) or ($student_course_result[0]['Remarks_ID'] === 2)) {
					# code...
					$array_output['success'] = 0;
					$array_output['message'] = "Cannot add the selected schedule because the status of the student's prerequisite subject is" . $course_info[0]['pre_req'] . ".";
					echo json_encode($array_output);
					return;
				}
			}
		}

		//check if there is still available slot

		$array_data['sched_code'] = $course_info[0]['Sched_Code'];

		$total_enrolled = $this->Schedule_Model->get_sched_total_enrolled_no_sd($array_data);
		$total_advised = $this->Schedule_Model->get_sched_total_advised($array_data);

		$consumed_slots = $total_enrolled[0]['total_enrolled'] + $total_advised[0]['total_advised'];

		$slot = $course_info[0]['Total_Slot'] -  $consumed_slots;
		//echo json_encode($array_output);
		if ($slot < 1) {
			$array_output['success'] = 0;
			$array_output['message'] = "The slot is full for " . $course_info[0]['subject'] . ". <br>Choose another schedule <br>(Advised: " . $total_advised[0]['total_advised'] . " , Enrolled: " . $total_enrolled[0]['total_enrolled'] . ")<br><br>";
			echo json_encode($array_output);
			return;
		}

		//check if there is conflict with other schedule
		$array_data['start_time'] = $course_info[0]['sched_start_time'];
		$array_data['end_time'] = $course_info[0]['sched_end_time'];
		$array_data['day_array'] = $course_info[0]['Day'];

		$conflict_check = $this->Student_Model->check_advising_conflict($array_data);
		if ($conflict_check) {
			$array_output['success'] = 0;
			$array_output['message'] = "Conflict with " . $conflict_check[0]['Course_Code'] . ". Choose another schedule";
			echo json_encode($array_output);
			return;
		}

		//Check if it exceeds unit count
		$unitcheck = $this->Student_Model->get_sched_session_units($array_data);
		$upcomingunit = $unitcheck[0]['total_units'] + ($course_info[0]['Course_Lec_Unit'] + $course_info[0]['Course_Lab_Unit']);
		if (!in_array($student_info[0]['Course'], $this->unit_excempted())) {
			if ($upcomingunit > $array_data['unitnumber']) {

				$array_output['success'] = 0;
				$array_output['message'] = "Failed to add " . $course_info[0]['subject'] . ", Exceeds maximun number of units (" . $array_data['unittype'] . ")";
				echo json_encode($array_output);
				return;
			}
		}


		//get year level
		//$year_level = $this->Student_Model->get_year_level($array_data);
		$year_level = $this->Student_Model->get_year_level_v2($array_data);
		if ($year_level[0]['Year_Level'] === 0) {
			$year_level[0]['Year_Level'] = 1;
		}

		//status
		if ($this->input->get('studType') === 'open') {
			$status = "IRREGULAR";
		} else {
			# code...
			$status = "REGULAR";
		}


		//add the sched to session
		$array_insert = array(
			'Reference_Number' => $this->input->get('referenceNo'),
			'Student_Number' => $student_info[0]['Student_Number'],
			'Sched_Code' => $course_info[0]['Sched_Code'],
			'Sched_Display_ID' => $this->input->get('schedDisplayId'),
			'Semester' => $array_data['semester'],
			'School_Year' => $array_data['school_year'],
			'Scheduler' => 'N/A',
			'Status' => $status,
			'Program' => $student_info[0]['Course'],
			'Major' => $student_info[0]['Major'],
			'Year_Level' => $year_level[0]['Year_Level'],
			'Section' =>  $this->input->get('section'),
			'Graduating' =>  $this->input->get('unittype'),
		);


		$this->Student_Model->insert_sched_session($array_insert);
		//print_r($array_insert);
		$array_output['success'] = 1;
		$array_output['message'] = "Added " . $course_info[0]['subject'] . " to the Queue!";
		echo json_encode($array_output);
		return;
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
