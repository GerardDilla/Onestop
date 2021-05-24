<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ose_api extends CI_Controller
{
	protected $reference_number;
	protected $student_number;
	protected $legend_sy;
	protected $legend_sem;
	protected $section;
	protected $curriculum;
	protected $date_now;
	public function __construct()
	{

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');
		header('Access-Control-Request-Headers: Content-Type');
		$this->validkey = 'testkey101';
		parent::__construct();
		$this->load->model('AdvisingModel');
		$this->load->model('FeesModel');
		$this->load->model('RegFormModel');
		$this->load->model('AssesmentModel');
		$this->load->library('session');

		#Temporary Keys
		$this->reference_number = $this->session->userdata('reference_no');
		$this->student_number = $this->session->userdata('Student_Number');

		// $this->AdvisingModel->get_latest_section($this->reference_number)
		// $this->section = $this->AdvisingModel->get_latest_section($this->reference_number);
		// $this->curriculum = '';

		#Temporary Legends : Must be auto generated
		$legend = $this->AdvisingModel->getlegend();
		$this->legend_sy = $legend['School_Year'];
		$this->legend_sem = $legend['Semester'];

		$this->curriculum = $this->AdvisingModel->get_student_curriculum($this->reference_number);

		#Generate current Date
		$datestring = "%Y-%m-%d %H:%i:%s";
		$time = time();
		$this->date_now = date($datestring, $time);

		#Fixed Units
		$this->grad_units = 30;
		$this->nongrad_units = 27;
	}
	public function subjects()
	{
		$output = array(
			'status' => '',
			'data' => '',
			'type' => '',
			'encoded_fees' => '',
		);
		$params = array(
			'school_year' => $this->legend_sy,
			'semester' => $this->legend_sem,
			'section' => $this->input->get('section')
		);

		#returns 1 if old student
		$output['status'] = $this->AdvisingModel->getfees_history($this->reference_number);

		#Get Student type if transferee or new
		$type = $this->AssesmentModel->get_shs_student_number_by_reference_number($this->reference_number);
		$output['type'] = empty($type) ? '' : $type['applied_status'];

		// die(json_encode($params));
		$output['data'] = $this->AdvisingModel->block_schedule($params);
		echo json_encode($output);
	}
	public function queue_subject_list()
	{
		$output = array(
			'status' => '',
			'data' => '',
		);

		$result = $this->AdvisingModel->get_queued_subjects($this->reference_number);
		$count = 0;
		foreach ($result as $list) {
			$result[$count]['from_time'] = $this->AdvisingModel->convertTime($list['Start_Time'])['Schedule_Time'];
			$result[$count]['to_time'] = $this->AdvisingModel->convertTime($list['End_Time'])['Schedule_Time'];
			++$count;
		}
		$output['status'] = $this->AdvisingModel->getfees_history($this->reference_number);
		$output['data'] = $result;
		echo json_encode($output);
	}
	public function queue_subject()
	{
		#preset outputa data
		$output = array(
			'status' => '0',
			'data' => '',
		);

		#Check if required parameters are complete / Compiles needed data
		if (!$this->input->post('schedcode')) {

			$output['status'] = 0;
			$output['data'] = 'No Subject given';
			echo json_encode($output);
			die();
		}
		$inputs = array(
			'SchedCode' => $this->input->post('schedcode'),
		);
		$schedData = $this->AdvisingModel->get_sched_info($inputs['SchedCode'])[0];
		$array_insert = array(
			'Reference_Number' => $this->reference_number,
			'Student_Number' => $this->student_number,
			'Sched_Code' => $schedData['Sched_Code'],
			'Sched_Display_ID' => $schedData['sched_display_id'],
			'Semester' => $this->legend_sem,
			'School_Year' => $this->legend_sy,
			'Scheduler' => 'SELF',
			'Status' => '1',
			'Program' => '1',
			'Major' => '0',
			'Year_Level' => '1',
			'Section' =>  $this->input->post('section'),
			'Graduating' =>  'NEEDS OTHER DATA',
			'valid' => 1
		);

		#Runs all Checkers pertaining to the subject being added
		$status = $this->queueing_checkers($array_insert, $schedData);
		if ($status['status'] == 1) {

			$output['status'] = 0;
			$output['data'] = $status['data'];
			echo json_encode($output);
			die;
		}

		$insert_status = $this->AdvisingModel->insert_sched_session($array_insert);
		$output['status'] = 1;
		$output['data'] = $insert_status;
		echo json_encode($output);
	}

	public function queue_all_subjects()
	{

		$params = array(
			'school_year' => $this->legend_sy,
			'semester' => $this->legend_sem,
			'section' => $this->input->post('section')
		);
		// die(json_encode($params));
		$section_subjects = $this->AdvisingModel->block_schedule($params);
		$insert_status = array();
		foreach ($section_subjects as $subject) {

			$schedData = $this->AdvisingModel->get_sched_info($subject['Sched_Code'])[0];
			$array_insert = array(
				'Reference_Number' => $this->reference_number,
				'Student_Number' => $this->student_number,
				'Sched_Code' => $schedData['Sched_Code'],
				'Sched_Display_ID' => $schedData['sched_display_id'],
				'Semester' => $this->legend_sem,
				'School_Year' => $this->legend_sy,
				'Scheduler' => 'SELF',
				'Status' => '1',
				'Program' => '1',
				'Major' => '0',
				'Year_Level' => '1',
				'Section' =>  $this->input->post('section'),
				'Graduating' =>  'NEEDS OTHER DATA',
				'valid' => 1
			);
			$status = $this->queueing_checkers($array_insert, $schedData);
			if ($status['status'] == 1) {
				#Conflicts present
				$insert_status[$subject['Sched_Code']] = $status['data'];
			} else {
				#No Conflicts found
				$insert_status[$subject['Sched_Code']] = $this->AdvisingModel->insert_sched_session($array_insert);
			}
		}
		echo json_encode($insert_status);
	}

	private function queueing_checkers($data, $sched_data = array())
	{
		// echo json_encode($sched_data);
		#preset
		$output['status'] = 0;
		$output['data'] = '';

		#Check if Already Taken
		$existing_status = $this->AdvisingModel->check_existing_queue($data);
		if (!empty($existing_status)) {
			$output['status'] = 1;
			$output['data'] = 'Subject is already on Queue: ' . $sched_data['CourseCode'];
			return $output;
		}

		#Check if slot is available
		$slot_status = $this->AdvisingModel->count_subject_enrolled($data);
		// $new_slot = $slot_status + 1;
		// if ($new_slot >= $sched_data['Total_Slot']) {

		// 	$output['status'] = 1;
		// 	$output['data'] = 'The slots for this Subject is Full';
		// 	return $output;
		// }

		#Check if there are schedule conflicts
		$conflict_checker_parameters = array(
			'reference_no' => $data['Reference_Number'],
			'start_time' => $sched_data['SDstart'],
			'end_time' => $sched_data['SDend'],
			'day_array' => $sched_data['Day'],
			'school_year' => $this->legend_sy,
			'semester' => $this->legend_sem,
		);

		#Parameters: Start time, End time, Days, Reference Number
		$conflict_check = $this->AdvisingModel->check_advising_conflict($conflict_checker_parameters);
		if ($conflict_check) {
			$output['status'] = 1;
			$output['data'] = 'Subject is in Conflict with: ' . $conflict_check[0]['Course_Code'];
			return $output;
		}

		#Check if Transferee 
		#Get Student type if transferee or new
		$type = $this->AssesmentModel->get_shs_student_number_by_reference_number($this->reference_number);
		$student_type = empty($type) ? '' : $type['applied_status'];
		if ($student_type == 'transferee' && $sched_data['sp_pre_req'] != null) {
			$output['status'] = 1;
			$output['data'] = 'Transferees cannot add subjects with Pre-Requisites';
			return $output;
		}

		# Check if units exceed max amount
		# Get current units
		$overall_units = $this->AdvisingModel->count_queue_units($data);
		$subject_units = $this->AdvisingModel->get_queued_subject_units($data);
		$maxunits = $this->nongrad_units;
		# Get Max Units
		if ($sched_data['Year_Level'] == 4) {
			$maxunits = $this->grad_units;
		}
		if (($overall_units['Units'] + $subject_units['Units']) > $maxunits) {
			$output['status'] = 1;
			$output['data'] = 'Units will Exceed Maximun Amount';
			return $output;
		}

		#Check if subject has already been taken
		$finished_status = $this->AdvisingModel->check_finished_subject($data);
		if ($finished_status != 0) {
			$output['status'] = 1;
			$output['data'] = 'Subject was already taken before: ' . $sched_data['CourseCode'];
			return $output;
		}

		#Check if pre requisite has not been taken (Check if transferee)
		$prereq_status = $this->AdvisingModel->check_finished_finished_prerequisite($data, $sched_data['sp_pre_req']);
		if ($prereq_status == 0) {
			$output['status'] = 1;
			$output['data'] = 'Pre Requisite Subject has not been taken yet: ' . $sched_data['CourseCode'];
			return $output;
		}

		return $output;
	}

	public function unqueue_subject()
	{

		$id = $this->input->post('sessionId');
		$session = $this->AdvisingModel->get_coursecode_via_session($id);
		$this->AdvisingModel->remove_advising_session($id);
		echo $session['Course_Code'];
	}

	public function unqueue_all()
	{
		$this->AdvisingModel->remove_all_advising_session($this->reference_number);

		echo 'removed';
	}

	public function payment_plan()
	{

		$array_data = array(
			'reference_no' => $this->reference_number,
			'plan' => $this->input->get('plan'),
			'school_year' => $this->legend_sy,
			'semester' => $this->legend_sem,
			'section' => $this->input->get('section')
		);
		$array_fees = $this->display_fee($array_data);


		#Checker if all needed data is complete
		// if ($array_fees == NULL) {
		// 	# code...
		// 	//Get student info

		// 	// $student_info = $this->AdvisingModel->get_student_info_by_reference_no($array_data['reference_no']);
		// 	// $year_level = $this->AdvisingModel->get_year_level($array_data);

		// 	

		// 	// $array_output['success'] = 0;
		// 	// $array_output['message'] = "No Available Fees on:<br><br>";

		// 	// $array_output['message'] .= '- Section: <u>' . $year_level[0]['Section_Name'] . '</u><br>';

		// 	// $year_level = $this->AdvisingModel->get_year_level($array_data);
		// 	// if ($year_level[0]['Year_Level'] === 0) {
		// 	// 	$year_level[0]['Year_Level'] = 1;
		// 	// }
		// 	// $array_output['message'] .= "- Year Level: <u>" . $year_level[0]['Year_Level'] . "</u><br>";

		// 	// if (($student_info[0]['AdmittedSY'] === 'N/A') || ($student_info[0]['AdmittedSY'] === 0)) {
		// 	// 	$array_output['message'] .= '- Admitted SY: <u>' . $array_data['school_year'] . ' none</u><br>';
		// 	// } else {
		// 	// 	$array_output['message'] .= '- Admitted SY: <u>' . $student_info[0]['AdmittedSY'] . '</u><br>';
		// 	// }

		// 	// if (($student_info[0]['AdmittedSEM'] === 'N/A') || ($student_info[0]['AdmittedSEM'] == '')) {
		// 	// 	$array_output['message'] .= '- Admitted SEM: <u>' . $array_data['semester'] . ' none</u><br>';
		// 	// } else {
		// 	// 	$array_output['message'] .= '- Admitted SEM: <u>' . $student_info[0]['AdmittedSEM'] . '</u><br>';
		// 	// }

		// 	// //check if student is a foreigner
		// 	// $foreigner_checker = $this->AdvisingModel->check_if_foreigner($array_data['reference_no']);

		// 	// if ($foreigner_checker === 1) {
		// 	// 	# code...
		// 	// 	//get foreign fee (other fee)

		// 	// 	$foreign_fee = $this->FeesModel->get_foreign_fee($array_data);

		// 	// 	if (!$foreign_fee) {
		// 	// 		# code...
		// 	// 		$array_output['message'] .= '- Other Fee: <u>Foreign Fee</u> <br>';
		// 	// 	}
		// 	// }

		// 	$array_output['message'] .= "</ul><br>
		//     <h4 style='color:#cc0000'>
		//     <b>Please Contact The Accounting Office.</b>
		//     </h2>";

		// 	echo json_encode($array_output);
		// 	return;
		// }
		echo json_encode($array_fees);
	}


	public function display_fee($array_data)
	{

		$installment_interest = 1.05;

		//get student info
		$student_info = $this->AdvisingModel->get_student_info_by_reference_no($this->reference_number);

		//get year level
		//$year_level = $this->AdvisingModel->get_year_level($array_data);
		$year_level = $this->AdvisingModel->get_year_level($array_data);
		if (!empty($year_level)) {
			if ($year_level[0]['Year_Level'] === 0) {
				$year_level[0]['Year_Level'] = 1;
			}
		} else {
			echo 0;
			die();
		}

		$array_data['program_code'] = $student_info[0]['Course'];
		$array_data['year_level'] = $year_level[0]['Year_Level'];

		//get advising session
		$advising_session = $this->AdvisingModel->get_sched_session($array_data);

		//compute total units
		$total_units = 0;
		foreach ($advising_session as $key => $sched) {
			# code...
			$total_units += $sched['Course_Lec_Unit'];
			$total_units += $sched['Course_Lab_Unit'];
		}

		//check if admitted sy is available
		if (($student_info[0]['AdmittedSY'] === 'N/A') || ($student_info[0]['AdmittedSY'] === 0)) {
			# code...
			$array_data['AdmittedSY'] =  $array_data['school_year'];
		} else {
			$array_data['AdmittedSY'] = $student_info[0]['AdmittedSY'];
		}

		//check if admitted sem is available
		//echo ' student info admitted sem:'.$student_info[0]['AdmittedSEM'].'<br>';
		if (($student_info[0]['AdmittedSEM'] == 'N/A') || ($student_info[0]['AdmittedSEM'] === 0)) {
			//echo 'enter admitted sem = n/a'.'<br>';
			# code...
			$array_data['AdmittedSEM'] =  $array_data['semester'];
		} else {
			$array_data['AdmittedSEM'] = $student_info[0]['AdmittedSEM'];
		}
		//$array_data['AdmittedSEM'] = $student_info[0]['AdmittedSEM'];
		//get fees details

		$array_fees = $this->FeesModel->get_fees($array_data);
		//print_r($array_data).'<br>';
		if (empty($array_fees)) {

			$array_output = array(
				'success' => 0,
				'other_fee' => 0,
				'misc_fee' => 0,
				'lab_fee' => 0,
				'tuition_fee' => 0,
				'total_fee' => 0
			);
			$array_output['message'] = "There Are no Encoded Fees as of Now";
			return $array_output;
		}
		$total_misc = 0;
		$total_other = 0;


		foreach ($array_fees as $key => $fees) {
			# code...
			if ($fees['Fees_Type'] === "MISC") {

				if ($array_data['plan'] === 'installment') {
					$total_misc += ($fees['Fees_Amount'] * $installment_interest);
				} else {

					$total_misc += $fees['Fees_Amount'];
				}
			} else {
				if ($array_data['plan'] === 'installment') {
					$total_other += ($fees['Fees_Amount'] * $installment_interest);
				} else {
					$total_other += $fees['Fees_Amount'];
				}
			}
		}

		//get subject other fee

		$array_subject_other_fee = $this->FeesModel->get_subject_other_fee_session($array_data);


		foreach ($array_subject_other_fee as $key => $subject_other_fee) {
			# code...
			if ($array_data['plan'] === 'installment') {
				$total_other += ($subject_other_fee['Other_Fee'] * $installment_interest);
			} else {

				$total_other += $subject_other_fee['Other_Fee'];
			}
		}
		//check if student is a foreigner
		$foreigner_checker = $this->AdvisingModel->check_if_foreigner($array_data['reference_no']);

		if ($foreigner_checker === 1) {
			# code...
			#check if the foreigner selected the international program 
			$international_program_check = $this->AdvisingModel->check_international_program($array_data['program_code']);

			if (empty($international_program_check)) {
				# code...
				$foreign_fee = $this->FeesModel->get_foreign_fee($array_data);

				if (!$foreign_fee) {
					# code...
					return;
				}

				if ($array_data['plan'] === 'installment') {
					$total_other += ($foreign_fee[0]['Fees_Amount'] * $installment_interest);
				} else {
					$total_other += $foreign_fee[0]['Fees_Amount'];
				}
			}
		}

		$total_other = number_format($total_other, 2, '.', '');
		$total_misc = number_format($total_misc, 2, '.', '');

		//tuition fee
		$tuition = $array_fees[0]['TuitionPerUnit'] * $total_units;


		if ($array_data['plan'] === 'installment') {
			//$tuition += ($tuition * $installment_interest);
			$tuition *= $installment_interest;
		}
		$tuition = number_format($tuition, 2, '.', '');


		//get subject lab fee
		$total_lab_fee = 0;

		$array_subject_lab_fee = $this->FeesModel->get_subject_lab_fee_session($array_data);
		foreach ($array_subject_lab_fee as $key => $subject_lab_fee) {
			# code...
			if ($array_data['plan'] === 'installment') {
				$total_lab_fee += ($subject_lab_fee['Lab_Fee'] * $installment_interest);
			} else {

				$total_lab_fee += $subject_lab_fee['Lab_Fee'];
			}
		}

		$total_lab_fee = number_format($total_lab_fee, 2, '.', '');

		$total_fee = $total_other + $total_misc + $total_lab_fee + $tuition;

		$array_output = array(
			'success' => 1,
			'other_fee' => $total_other,
			'misc_fee' => $total_misc,
			'lab_fee' => $total_lab_fee,
			'tuition_fee' => $tuition,
			'total_fee' => $total_fee

		);
		return $array_output;
	}

	public function advise_student()
	{

		$output = array(
			'success' => 1,
			'message' => '',
		);

		//get student info
		$student_info = $this->AdvisingModel->get_student_info_by_reference_no($this->reference_number);

		//get current sem and sy
		//$array_legend = $this->Schedule_Model->get_legend();

		$array_data = array(
			'program_code' => $student_info[0]['Course'],
			'reference_no' => $this->reference_number,
			'student_no' => $this->student_number,
			'date' => $this->date_now,
			'semester' => $this->legend_sem,
			'school_year' => $this->legend_sy,
			'plan' => $this->input->get('plan'),
			'section' => $this->input->get('section'),
			// 'payment' => $this->input->post('payment'), #??
			'payment' => 0,
			'curriculum' => $this->curriculum,
			'transaction_item' => "MATRICULATION",           //change later
			'transaction_type' => "CASH"                //change later

		);

		if (!$this->input->get('section')) {

			$output['success'] = 0;
			$output['message'] = 'Select Subjects you want to enroll first';
			echo json_encode($output);
			die();
		}

		//check if admitted sy is available
		if (($student_info[0]['AdmittedSY'] === 'N/A') || ($student_info[0]['AdmittedSY'] === 0)) {
			# code...
			$array_data['AdmittedSY'] =  $array_data['school_year'];
		} else {
			$array_data['AdmittedSY'] = $student_info[0]['AdmittedSY'];
		}

		//check if admitted sem is available
		if (($student_info[0]['AdmittedSEM'] === 'N/A') || ($student_info[0]['AdmittedSEM'] === 0)) {
			# code...
			$array_data['AdmittedSEM'] =  $array_data['semester'];
		} else {
			$array_data['AdmittedSEM'] = $student_info[0]['AdmittedSEM'];
		}

		//get year level
		//$year_level = $this->AdvisingModel->get_year_level($this->reference_number);
		$year_level = $this->AdvisingModel->get_year_level($array_data);
		if ($year_level[0]['Year_Level'] === 0) {
			$year_level[0]['Year_Level'] = 1;
		}

		$array_data['year_level'] = $year_level[0]['Year_Level'];

		//check if the student is already advised 
		$check_advised = $this->AdvisingModel->get_sched_advised($array_data);
		if ($check_advised != NULL) {

			$array_data['check_advised'] = 1;
			$this->AdvisingModel->remove_sched_info($array_data);
			$array_college_fees_data = $this->FeesModel->get_fees_college_data($array_data);
			$array_data['fees_temp_college_id'] = $array_college_fees_data[0]['id'];
			$this->FeesModel->remove_fees_item($array_data['fees_temp_college_id']);
		} else {
			$array_data['check_advised'] = 0;
		}

		#Checkers
		$array_computed_fees = $this->display_fee($array_data);
		if ($array_computed_fees['success'] == 0) {
			#No Fees
			$output['success'] = 0;
			$output['message'] = $array_computed_fees['message'];
			echo json_encode($output);
			die();
		}

		$queuedata = $this->AdvisingModel->get_queued_subjects($array_data['reference_no']);
		if (empty($queuedata)) {
			$output['success'] = 0;
			$output['message'] = 'Select Subjects you want to enroll first';
			echo json_encode($output);
			die();
		}

		#Inserts Subject Queues
		$this->AdvisingModel->insert_sched_info($array_data);

		#Inserts Fees
		$this->insert_enrollment_fees($array_data, $array_computed_fees);

		echo json_encode($output);
		// #Updates student information if new enrollee: REDUNDANT
		// if ($array_data['student_no'] === 0) {

		// 	$this->AdvisingModel->update_student_curriculum($array_data);
		// }
	}

	public function insert_enrollment_fees($array_data, $array_computed_fees)
	{

		$installment_interest = 1.05;


		if ($array_data['plan'] === 'installment') {
			//get installment plan formula
			$array_plan_formula = $this->FeesModel->get_payment_plans();
			$array_data['initial_payment'] = number_format(($array_computed_fees['total_fee'] * ($array_plan_formula[0]['Upon_Registration'] / 100)), 2, '.', '');
			$array_data['first_payment'] = number_format(($array_computed_fees['total_fee'] * ($array_plan_formula[0]['First_Pay'] / 100)), 2, '.', '');
			$array_data['second_payment'] = number_format(($array_computed_fees['total_fee'] * ($array_plan_formula[0]['Second_Pay'] / 100)), 2, '.', '');
			$array_data['third_payment'] = number_format(($array_computed_fees['total_fee'] * ($array_plan_formula[0]['Third_Pay'] / 100)), 2, '.', '');
			$array_data['fourth_payment'] = number_format(($array_computed_fees['total_fee'] * ($array_plan_formula[0]['Fourth_Pay'] / 100)), 2, '.', '');
			$array_data['full_payment'] = 0;
		} else {

			$array_data['initial_payment'] = 0.00;
			$array_data['full_payment'] = 1;
			$array_data['initial_payment'] = $array_computed_fees['total_fee'];
			$array_data['first_payment'] = 0.00;
			$array_data['second_payment'] = 0.00;
			$array_data['third_payment'] = 0.00;
			$array_data['fourth_payment'] = 0.00;
		}

		//insert fee
		$array_insert_fee = array(
			'Reference_Number' => $array_data['reference_no'],
			'course' => $array_data['program_code'],
			'semester' => $array_data['semester'],
			'schoolyear' => $array_data['school_year'],
			'YearLevel' => $array_data['year_level'],
			'fullpayment' => $array_data['full_payment'],
			'tuition_Fee' => $array_computed_fees['tuition_fee'],
			'InitialPayment' => $array_data['initial_payment'],
			'First_Pay' => $array_data['first_payment'],
			'Second_Pay' => $array_data['second_payment'],
			'Third_Pay' => $array_data['third_payment'],
			'Fourth_Pay' => $array_data['fourth_payment']
		);

		//check if there is data in Fees temp college 
		$array_college_fees_data = $this->FeesModel->get_fees_college_data($array_data);
		if ($array_college_fees_data != NULL) {
			# code...
			$array_data['fees_temp_college_id'] = $array_college_fees_data[0]['id'];
		}

		#Inserts Fees to Fees_Enrolled_College
		if (($array_data['check_advised'] === 1) && ($array_college_fees_data != NULL)) {

			$this->FeesModel->replace_fees_college_data($array_insert_fee, $array_data);
		} else {

			$array_fees_data = $this->FeesModel->insert_fees_college($array_insert_fee);
			$array_data['fees_temp_college_id'] = $array_fees_data['insert_id'];
			$this->array_logs['action'] = $array_fees_data['query_log'];
		}

		//get fees details
		$array_fees = $this->FeesModel->get_fees($array_data);
		if ($array_fees) {

			foreach ($array_fees as $key => $fees) {

				if ($array_data['plan'] === 'installment') {
					$fees['Fees_Amount'] *= $installment_interest;
				}

				$array_fees_item[] = array(
					'Fees_Temp_College_Id' => $array_data['fees_temp_college_id'],
					'Fees_Type' => $fees['Fees_Type'],
					'Fees_Name' => $fees['Fees_Name'],
					'Fees_Amount' => $fees['Fees_Amount']
				);
			}
		} else {
			die('Fees for this section has not been encoded yet.');
		}


		//get foreign fee
		//check if student is a foreigner
		$foreigner_checker = $this->AdvisingModel->check_if_foreigner($array_data['reference_no']);
		if ($foreigner_checker === 1) {
			# code...
			#check if the foreigner selected the international program 
			$international_program_check = $this->Program_Model->check_international_program($array_data['program_code']);

			if (empty($international_program_check)) {
				# code...
				$foreign_fee = $this->FeesModel->get_foreign_fee($array_data);

				if (!$foreign_fee) {
					# code...
					return;
				}

				if ($array_data['plan'] == 0) {
					$foreign_fee[0]['Fees_Amount'] *= $this->installment_interest;
				}

				$array_fees_item[] = array(
					'Fees_Temp_College_Id' => $array_data['fees_temp_college_id'],
					'Fees_Type' => $foreign_fee[0]['Fees_Type'],
					'Fees_Name' => $foreign_fee[0]['Fees_Name'],
					'Fees_Amount' => $foreign_fee[0]['Fees_Amount']
					//'valid' => 1
				);
			}
		}

		#Gets other fees
		$array_subject_other_fee = $this->FeesModel->get_subject_other_fee_advised($array_data);

		if ($array_subject_other_fee != NULL) {
			# code...
			foreach ($array_subject_other_fee as $key => $subject_other_fee) {
				# code...
				if ($array_data['plan'] === 'installment') {
					$subject_other_fee['Other_Fee'] *= $installment_interest;
				}

				$array_fees_item[] = array(
					'Fees_Temp_College_Id' => $array_data['fees_temp_college_id'],
					'Fees_Type' => 'OTHER',
					'Fees_Name' => $subject_other_fee['Subject_Type'],
					'Fees_Amount' => $subject_other_fee['Other_Fee']
				);
			}
		}

		#Gets subject lab fee
		$total_lab_fee = 0;

		$array_subject_lab_fee = $this->FeesModel->get_subject_lab_fee_advised($array_data);

		if ($array_subject_lab_fee != NULL) {
			# code...

			foreach ($array_subject_lab_fee as $key => $subject_lab_fee) {
				# code...
				if ($array_data['plan'] === 'installment') {
					$subject_lab_fee['Lab_Fee'] *= $installment_interest;
				}
				$array_fees_item[] = array(
					'Fees_Temp_College_Id' => $array_data['fees_temp_college_id'],
					'Fees_Type' => 'LAB',
					'Fees_Name' => $subject_lab_fee['Subject_Type'],
					'Fees_Amount' => $subject_lab_fee['Lab_Fee']
				);
			}
		}

		$this->FeesModel->insert_fees_item($array_fees_item);

		$this->AdvisingModel->delete_advising_session($array_data);

		return;
	}

	public function temporary_regform_ajax()
	{
		$reference_number = $this->reference_number;
		if ($reference_number != '') {

			$searcharray['Reference_Number'] = $reference_number;
			$AdvisedCheck = $this->AdvisingModel->check_advised($searcharray);
			$array = array(
				'sy' => $this->legend_sy,
				'sem' => $this->legend_sem,
				'refnum' => $this->reference_number
			);
			$data['get_Advise'] = $this->RegFormModel->Get_advising_ajax($array);
			if (empty($data['get_Advise'])) {
				echo '0';
				die();
			}
			foreach ($data['get_Advise']  as $row) {
				$section         = $row->Section_Name;
				$course        = $row->Course;
				$sem           = $row->Semester;
				$sy            = $row->School_Year;
				$yl            = $row->YL;
				$ref_num       = $row->Reference_Number;
				$stu_num       = $row->Student_Number;
				$admmitedSy    = $row->AdmittedSY;
				$admmitedSem    = $row->AdmittedSEM;
			}
			$data['get_TotalCountSubject']       = $this->RegFormModel->Get_CountSubject_Advising_TRF($stu_num, $sem, $sy);
			$data['get_labfees']                 = $this->RegFormModel->Get_LabFeesAdvising_TRF($ref_num, $course, $sem, $sy, $yl);
			$data['get_miscfees']                = $this->RegFormModel->Get_MISC_FEE_TRF($ref_num, $course, $sem, $sy, $yl);
			$data['get_otherfees']                = $this->RegFormModel->Get_OTHER_FEE_TRF($ref_num, $course, $sem, $sy, $yl);
			$data['get_tuitionfee']              = $this->RegFormModel->Get_Tuition_FEE_TRF($course, $sem, $sy, $yl, $ref_num, $admmitedSy, $admmitedSem);
			//$data['get_totalcash']               = $this->RegFormModel->Get_Total_CashPayment($ref_num,$sem,$sy);
			$data['get_totalunits']               = $this->RegFormModel->totalUnitsAdvising_TRF($array);
			echo json_encode($data);
		}
	}

	public function export_assessmentform()
	{
		$reference_number = $this->reference_number;
		if ($reference_number != '') {

			$searcharray['Reference_Number'] = $reference_number;
			$AdvisedCheck = $this->AdvisingModel->check_advised($searcharray);
			$array = array(
				'sy' => $this->legend_sy,
				'sem' => $this->legend_sem,
				'refnum' => $this->reference_number
			);
			$data['get_Advise'] = $this->RegFormModel->Get_advising_ajax($array);
			if (empty($data['get_Advise'])) {

				echo false;
				die();
			}
			foreach ($data['get_Advise']  as $row) {
				$section         = $row->Section_Name;
				$course        = $row->Course;
				$sem           = $row->Semester;
				$sy            = $row->School_Year;
				$yl            = $row->YL;
				$ref_num       = $row->Reference_Number;
				$stu_num       = $row->Student_Number;
				$admmitedSy    = $row->AdmittedSY;
				$admmitedSem    = $row->AdmittedSEM;
			}
			$data['get_TotalCountSubject']       = $this->RegFormModel->Get_CountSubject_Advising_TRF($stu_num, $sem, $sy);
			$data['get_labfees']                 = $this->RegFormModel->Get_LabFeesAdvising_TRF($ref_num, $course, $sem, $sy, $yl);
			$data['get_miscfees']                = $this->RegFormModel->Get_MISC_FEE_TRF($ref_num, $course, $sem, $sy, $yl);
			$data['get_otherfees']                = $this->RegFormModel->Get_OTHER_FEE_TRF($ref_num, $course, $sem, $sy, $yl);
			$data['get_tuitionfee']              = $this->RegFormModel->Get_Tuition_FEE_TRF($course, $sem, $sy, $yl, $ref_num, $admmitedSy, $admmitedSem);
			//$data['get_totalcash']               = $this->RegFormModel->Get_Total_CashPayment($ref_num,$sem,$sy);
			$data['get_totalunits']               = $this->RegFormModel->totalUnitsAdvising_TRF($array);
			// echo json_encode($data);
		}
		$this->load->view('Body/AssessmentContent/AssessmentForm', $data);
	}
	public function export_registrationform()
	{
		$array = array(
			'sy' => $this->legend_sy,
			'sem' => $this->legend_sem,
			'refnum' => $this->reference_number
		);

		# Stops if it doesnt receive reference number
		if (!$array['refnum']) {
			echo 'Reference Number Not Found';
			die();
		}

		#Checkers if student is enrolled
		$this->data['check_enrolled_student']  = $this->RegFormModel->Check_Enrolled_Student($array);
		$this->data['check_fees_student']      = $this->RegFormModel->Check_Fees_Student($array);

		if ($this->data['check_fees_student']->num_rows() == 0 && $this->data['check_enrolled_student']->num_rows() == 0) {

			echo 'Not Enrolled';
			die();
		} else {

			$this->data['student_data']  = $this->RegFormModel->Get_enrolled($array);
			foreach ($this->data['student_data']  as $row) {

				$array = array(
					'section'    => $row['Section_Name'],
					'course'     => $row['Course'],
					'sem'        => $row['Semester'],
					'sy'         => $row['School_Year'],
					'yl'         => $row['YL'],
					'ref_num'    => $row['Reference_Number'],
					'stu_num'    => $row['Student_Number'],
					'admmitedSy' => $row['AdmittedSY'],
					'admmitedSem' => $row['AdmittedSEM']
				);
			}

			$this->data['get_TotalCountSubject']       = $this->RegFormModel->Get_CountSubject_enrolled($array);
			$this->data['get_labfees']                 = $this->RegFormModel->Get_LabFeesEnrolled($array);
			$this->data['get_miscfees']                = $this->RegFormModel->Get_MISC_FEE($array);
			$this->data['get_otherfees']                = $this->RegFormModel->Get_OTHER_FEE($array);
			$this->data['get_totalcash']               = $this->RegFormModel->Get_Total_CashPayment($array);
			$this->data['get_totalunits']              = $this->RegFormModel->totalUnitsEnrolled($array);
		}
		$this->load->view('Body/AssessmentContent/RegistrationForm_Export', $this->data);
	}

	public function get_section()
	{
		$output = array(
			'section_id' => '',
			'sections' => '',
		);
		#Get Program ID
		$Course = $this->AdvisingModel->get_course($this->reference_number);

		#Check if new student or old: Returns bool
		$Feesdata = $this->AdvisingModel->getfees_history($this->reference_number);

		#Get section based on whether $Feesdata is true(old student) or false(new student)
		$output['sections'] = $this->AdvisingModel->get_sections($Course, $Feesdata);

		#Gets Queue
		$queue = $this->AdvisingModel->get_queued_subjects($this->reference_number);
		if (!empty($queue)) {
			$output['section_id'] = $queue[0]['Section_ID'];
		} else {
			$output['section_id'] = 'none';
		}
		echo json_encode($output);
	}
	public function setpaid_test()
	{
		# Will Remove: for development only
		$array = array(
			'Reference_Number' => $this->reference_number,
			'School_Year' => $this->legend_sy,
			'Semester' => $this->legend_sem,
		);
		$this->AdvisingModel->insert_enrolled_subject_test($array);
		$fees_id = $this->AdvisingModel->insert_fees_test($array);
		$this->AdvisingModel->insert_fees_items_test($fees_id, $array);
		// insert_fees_test
	}
	public function reset_progress()
	{
		# Will Remove: for development only
		$array = array(
			'Reference_Number' => $this->reference_number,
			'School_Year' => $this->legend_sy,
			'Semester' => $this->legend_sem,
		);
		$this->AdvisingModel->reset_progress($array);
	}
	public function Forms()
	{

		$array = array(
			'sy' => $this->legend_sy,
			'sem' => $this->legend_sem,
			'refnum' => $this->reference_number
		);

		# Stops if it doesnt receive reference number
		if (!$array['refnum']) {
			echo 'Reference Number Not Found';
			die();
		}

		#Checkers if student is enrolled
		$this->data['check_enrolled_student']  = $this->RegFormModel->Check_Enrolled_Student($array);
		$this->data['check_fees_student']      = $this->RegFormModel->Check_Fees_Student($array);

		if ($this->data['check_fees_student']->num_rows() == 0 && $this->data['check_enrolled_student']->num_rows() == 0) {

			echo 'Not Enrolled';
			die();
			
		} else {

			$this->data['student_data']  = $this->RegFormModel->Get_enrolled($array);
			foreach ($this->data['student_data']  as $row) {

				$array = array(
					'section'    => $row['Section_Name'],
					'course'     => $row['Course'],
					'sem'        => $row['Semester'],
					'sy'         => $row['School_Year'],
					'yl'         => $row['YL'],
					'ref_num'    => $row['Reference_Number'],
					'stu_num'    => $row['Student_Number'],
					'admmitedSy' => $row['AdmittedSY'],
					'admmitedSem' => $row['AdmittedSEM']
				);
			}

			$this->data['get_TotalCountSubject']       = $this->RegFormModel->Get_CountSubject_enrolled($array);
			$this->data['get_labfees']                 = $this->RegFormModel->Get_LabFeesEnrolled($array);
			$this->data['get_miscfees']                = $this->RegFormModel->Get_MISC_FEE($array);
			$this->data['get_otherfees']                = $this->RegFormModel->Get_OTHER_FEE($array);
			$this->data['get_totalcash']               = $this->RegFormModel->Get_Total_CashPayment($array);
			$this->data['get_totalunits']              = $this->RegFormModel->totalUnitsEnrolled($array);
		}

		echo json_encode($this->data);
	}

	public function total_online_payment()
	{
		// die($this->reference_number);
		$array = array(
			'sy' => $this->legend_sy,
			'sem' => $this->legend_sem,
			'refnum' => $this->reference_number
		);
		$data['get_Advise'] = $this->RegFormModel->Get_advising_return_array($array);
		$initial_pay = 0;
		$first_pay = 0;
		$second_pay = 0;
		$third_pay = 0;
		$fourth_pay = 0;
		$selected_pay = $this->input->post('select_pay');
		foreach ($selected_pay as $payment) {
			if ($payment == 'initial') {
				$initial_pay = $data['get_Advise'][0]['InitialPayment'];
			}
			if ($payment == 'first') {
				$first_pay = $data['get_Advise'][0]['First_Pay'];
			}
			if ($payment == 'second') {
				$second_pay = $data['get_Advise'][0]['Second_Pay'];
			}
			if ($payment == 'third') {
				$third_pay = $data['get_Advise'][0]['Third_Pay'];
			}
			if ($payment == 'fourth') {
				$fourth_pay = $data['get_Advise'][0]['Fourth_Pay'];
			}
			if ($payment == 'downpayment') {
				$initial_pay = 0;
				$first_pay = 0;
				$second_pay = 0;
				$third_pay = 0;
				$fourth_pay = 0;
				$downpayment = '5000.00';
			}
		}
		$total = $initial_pay + $first_pay + $second_pay + $third_pay + $fourth_pay + $downpayment;
		if ($total <= 0) {
			$this->session->set_flashdata('online_payment_zero', 'Zero Total is ot valid!');
			redirect('main/selfassesment');
			die();
		}
		// die($total);
		redirect("https://stdominiccollege.edu.ph/SDCAPayment?payment=" . $total);
	}
	public function check_encoded_fees()
	{

		$array_data = array(
			'reference_no' => $this->reference_number,
			'plan' => $this->input->get('plan'),
			'school_year' => $this->legend_sy,
			'semester' => $this->legend_sem,
			'section' => $this->input->get('section')
		);
		$fees_status = $this->display_fee($array_data);
		echo json_encode($fees_status);
	}
}
