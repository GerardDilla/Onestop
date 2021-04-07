<?php
defined('BASEPATH') or exit('No direct script access allowed');

class temp_api extends CI_Controller
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


		#Temporary Keys
		$this->reference_number = '14174';
		$this->student_number = '20122411';

		#Temporary Legends : Must be auto generated
		$this->legend_sy = '2019-2020';
		$this->legend_sem = 'FIRST';
		$this->section = '180';
		$this->curriculum = '236';

		#Generate current Date
		$datestring = "%Y-%m-%d %H:%i:%s";
		$time = time();
		$this->date_now = date($datestring, $time);
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
			'section' => $this->section,
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
		// $year_level = $this->AdvisingModel->get_year_level($array_data);
		// $year_level = $this->AdvisingModel->get_year_level($array_data);
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
			'Status' => '1',
			'Program' => '1',
			'Major' => '0',
			'Year_Level' => '1',
			'Section' =>  $this->section,
			'Graduating' =>  'NEEDS OTHER DATA',
			'valid' => 1
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


	public function payment_plan()
	{

		$array_data = array(
			'reference_no' => $this->reference_number,
			'plan' => $this->input->get('plan'),
			'school_year' => $this->legend_sy,
			'semester' => $this->legend_sem,
			'section' => $this->section
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
		if ($year_level[0]['Year_Level'] === 0) {
			$year_level[0]['Year_Level'] = 1;
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
		if ($array_fees == NULL) {
			# code...
			$array_output['success'] = 0;
			$array_output['message'] = "The selected fees was not yet set.";
			return;
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
			'section' => $this->section,
			// 'payment' => $this->input->post('payment'), #??
			'payment' => 0,
			'curriculum' => $this->curriculum,
			'transaction_item' => "MATRICULATION",           //change later
			'transaction_type' => "CASH"                //change later

		);

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

		$this->AdvisingModel->insert_sched_info($array_data);
		//insert fees
		$this->insert_enrollment_fees($array_data);

		#Updates student information if new enrollee
		if ($array_data['student_no'] === 0) {

			$this->AdvisingModel->update_student_curriculum($array_data);
		}

		echo 'advising_success';
	}

	public function insert_enrollment_fees($array_data)
	{

		$installment_interest = 1.05;
		$array_computed_fees = $this->display_fee($array_data);

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
			//$data['get_totalcash']               = $this->RegForm_Model->Get_Total_CashPayment($ref_num,$sem,$sy);
			$data['get_totalunits']               = $this->RegFormModel->totalUnitsAdvising_TRF($array);
			echo json_encode($data);
		}
	}
}
