<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends MY_Controller
{

	public function index()
	{
		//$this->load->view('Body/index');
		// $this->default_template($this->view_directory->assessment());
		// echo 'hello';
		$this->login_template($this->view_directory->login());
	}
	// 
	public function selfassesment()
	{

		$this->data['student_information'] = 'Body/AssessmentContent/StudentInformation';
		$this->data['advising'] = 'Body/AssessmentContent/Advising';
		$this->data['payment'] = 'Body/AssessmentContent/Payment';
		$this->data['advising_modals'] = 'Body/AssessmentContent/AdvisingModals';

		$from_session_reference_number = '3';
		$this->data['courses'] = $this->get_student_course_choices($from_session_reference_number);
		$array = array();
		foreach ($this->data['courses'] as $course) {
			$course_info = $this->get_student_course_info($course);
			$array[] = $course_info;
		}
		$this->data['courses_info'] = $array;

		// die(json_encode($this->data['courses']));

		$this->default_template($this->view_directory->assessment());
	}
	// Waiting For Datas but Working
	public function wizard_tracker_status()
	{
		$ref_no = $this->input->post('Reference_Number');
		$status = $this->AssesmentModel->tracker_status();
		$data['registration'] = 0;
		$data['advising'] = 0;
		$data['student_information'] = 0;

		// if ($status['Ref_Num_fec'] != null && $status['Ref_Num_si'] != null && $status['Ref_Num_ftc'] != null) {
		// 	$data['registration'] = 1;
		// } else if ($status['Ref_Num_ftc'] != null) {
		// 	$data['advising'] = 1;
		// } else {
		// 	$data['student_information'] = 1;
		// }
		echo json_encode($data);
		// return json_encode($data);
	}
	// Waiting updates
	public function shs_balance_checker($student_number)
	{
		// // $student_number = '20150349';
		// $student_number = $this->input->post('student_number');
		$overall_fees = $this->AssesmentModel->get_overall_fees($student_number);
		$overall_payment = $this->AssesmentModel->get_overall_payment($student_number);
		$total = $overall_payment['AmountofPayment'] - $overall_fees['Fees'];
		$array = array(
			'overall_payment' => $overall_payment['AmountofPayment'],
			'overall_fees' => $overall_fees['Fees'],
			'total' => $total,
		);
		if (!empty($overall_fees) && !empty($overall_payment)) {
			if ($total >= -1) {
				// echo "<br>".$total;
				$array['status'] = 'no_dept';
			} else {
				// echo "<br> Total Dept : ".$total;
				$array['status'] = 'dept';
			}
			// echo "<br> Total : " . ($overall_payment['AmountofPayment'] - $overall_fees['Fees']);
		} else {
			// echo "Empty";
			$array['status'] = 'empty';
		}
		echo json_encode($array);
	}
	// Waiting For Datas but Working
	public function get_student_course_choices($reference_number)
	{
		$student = $this->AssesmentModel->get_student_by_reference_number($reference_number);
		$courses = array(
			'0' => $student['Course_1st'],
			'1' => $student['Course_2nd'],
			'2' => $student['Course_3rd'],
		);
		// echo $courses;
		return $courses;
	}
	// Get Program by Program Code
	public function get_student_course_info($program_code)
	{
		$course_info = $this->AssesmentModel->get_course_program_code($program_code);
		// echo json_encode($course_info);
		return $course_info;
	}
	// Get Program Major by Program Code
	public function get_student_course_major($program_code)
	{
		$major = $this->AssesmentModel->get_major_by_course($program_code);
		echo json_encode($major);
		return $major;
	}
	public function update_course_by_reference_number()
	{
		$get_in_Session = '5';
		$check_course = $this->check_course_by_reference_number($get_in_Session);
		if ($check_course == 'none') {
			$array = array(
				'reference_number' => $get_in_Session,
				'course' => $this->input->post('course'),
				'major' => $this->input->post('major'),
			);
			$update = $this->AssesmentModel->upadte_course_by_reference_number($array);
			if ($update) {
				// Ongoing
			}
		}else{
			die('You Alredy Have Course! Contact MIS department for this issue.');
		}
	}
	public function check_course_by_reference_number($reference_number)
	{
		$student = $this->AssesmentModel->get_student_by_reference_number($reference_number);
		if ($student['Course']) {
			return $student;
		} else {
			return 'none';
		}
	}

	public function forgotPassword()
	{
		$this->login_template($this->view_directory->forgotPassword());
	}
	public function changePassword()
	{
		$this->login_template($this->view_directory->changePassword());
	}
	public function passwordReset()
	{
		$this->default_template($this->view_directory->passwordReset());
	}
	public function logout()
	{
		redirect(base_url('/'));
	}
}
