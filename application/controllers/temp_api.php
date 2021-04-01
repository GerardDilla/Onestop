<?php
defined('BASEPATH') or exit('No direct script access allowed');

class temp_api extends CI_Controller
{
	protected $reference_number;
	protected $student_number;
	protected $legend_sy;
	protected $legend_sem;
	protected $section;
	public function __construct()
	{

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');
		header('Access-Control-Request-Headers: Content-Type');
		$this->validkey = 'testkey101';
		parent::__construct();
		$this->load->model('AdvisingModel');
		$this->load->model('FeesModel');
		#Temporary Keys
		$this->reference_number = '14174';
		$this->student_number = '20122411';
		#Temporary Legends
		$this->legend_sy = '2019-2020';
		$this->legend_sem = 'FIRST';
		$this->section = '180';
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
		//$year_level = $this->Student_Model->get_year_level($array_data);
		// $year_level = $this->Student_Model->get_year_level($array_data);
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

		// 	// $student_info = $this->Student_Model->get_student_info_by_reference_no($array_data['reference_no']);
		// 	// $year_level = $this->Student_Model->get_year_level($array_data);

		// 	

		// 	// $array_output['success'] = 0;
		// 	// $array_output['message'] = "No Available Fees on:<br><br>";

		// 	// $array_output['message'] .= '- Section: <u>' . $year_level[0]['Section_Name'] . '</u><br>';

		// 	// $year_level = $this->Student_Model->get_year_level($array_data);
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
		// 	// $foreigner_checker = $this->Student_Model->check_if_foreigner($array_data['reference_no']);

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
		//print_r($array_data).'<br>';
		#Refnum checker
		// if (($array_data['reference_no'] == '') or (!is_numeric($array_data['reference_no']))) {
		// 	// Redirect to home page
		// 	//redirect('Advising');
		// 	$array_output['success'] = 0;
		// 	$array_output['message'] = "error: no data";
		// 	return;
		// }
		//installment modifier

		$installment_interest = 1.05;

		//get student info
		$student_info = $this->AdvisingModel->get_student_info_by_reference_no($this->reference_number);

		//get year level
		//$year_level = $this->Student_Model->get_year_level($array_data);
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

		$array_fees = $this->FeesModel->get_fees_without_admit($array_data);


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


			//print "foreign fee <br/>";
			//print_r($foreign_fee);

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

		//get lab fee
		/*
        $lab_fees = $this->FeesModel->get_lab_fee($array_data);
        $total_lab_fee = 0;
        foreach ($lab_fees as $key => $type) 
        {
            # code...
            if($array_data['plan'] === 'installment')
            {
                $total_lab_fee += ($type['Fee'] * $installment_interest );
            }
            else
            {
                $total_lab_fee += $type['Fee'];
            }
            
        }
        */

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
		/*
        $array_output = array(
            'success' => 1,
            'other_fee' => 5,
            'misc_fee' => 10, 
            'lab_fee' => 5, 
            'tuition_fee' => 6, 
            'total_fee' => 5
            
        );
        */
		return $array_output;

		//check student nationality

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
