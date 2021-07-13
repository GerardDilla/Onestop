<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Main extends MY_Controller
{
	protected $token;
	public function __construct()
	{
		parent::__construct();
		$this->studentdata = array();
		$this->load->library('gdrive_uploader', array('folder_id' => '1_Ui30Jb_-N9ENG1XatjdT2GzVHXzmuRi'));
		// $this->load->library('gdrive_uploader', array('folder_id' => '1pqk-GASi0205D9Y8QEi0zGNrEdH8nmap'));
		
	}
	public function index()
	{	
		// generate token
		$token = hash('tiger192,3', uniqid());
		$this->data['csrf_token'] = $token;
		$_SESSION['csrf_token']['login'] = $token;

		$this->login_template($this->view_directory->login());
		$this->appkey = 'testkey101';
	
	}
	public function tokenHandler($type){
		if(isset($this->session->csrf_token)){
			if(isset($this->session->csrf_token[$type])){
				if($this->session->csrf_token[$type]==""||$this->session->csrf_token[$type]!=$this->input->post('b3df6e650330df4c0e032e16141f')){
					echo 'Something went wrong!';
					exit;
				}
			}else{
				echo 'Something went wrong!';
				exit;
			}
		}else{
			echo 'Something went wrong!';
			exit;
		}
		$_SESSION['csrf_token'][$type] = '';
	}
	public function selfassesment()
	{
		$ref_no = $this->session->userdata('reference_no');
		$legend = $this->AdvisingModel->getlegend();
		// $this->data['md5_ref_no'] = '29a83a8a9641bb860a679d7e5ba52d26';
		$this->data['md5_ref_no'] = md5($ref_no);

		// Get Enrolled Students
		$enrolled_students = $this->AssesmentModel->enrolled_student($ref_no);
		foreach ($enrolled_students as $enrolled_student) {
			if ($enrolled_student['semester'] != $legend['Semester'] && $enrolled_student['schoolyear'] != $legend['School_Year']) {
				$this->data['old_student'] = true;
			}
		}

		#Validation of Documents 
		$getRequirementsList = $this->mainmodel->getRequirementsList();
		$count = 0;
		foreach ($getRequirementsList as $list) {
			$checkRequirement = $this->mainmodel->checkRequirement($list['id_name']);
			$getRequirementsList[$count]['status'] = empty($checkRequirement['status']) ? '' : $checkRequirement['status'];
			$getRequirementsList[$count]['date'] = empty($checkRequirement['requirements_date']) ? '' : date("M. j,Y g:ia", strtotime($checkRequirement['requirements_date']));
			// date("M. j,Y g:ia",strtotime($checkRequirement['requirements_date']))
			++$count;
		}
		$this->data['requirements'] = $getRequirementsList;

		#Tab Views
		$this->data['student_information'] = 'Body/AssessmentContent/StudentInformation';
		$this->data['requirementstab'] = 'Body/ValidationDocuments';
		$this->data['advising'] = 'Body/AssessmentContent/Advising';
		$this->data['payment'] = 'Body/AssessmentContent/Payment';
		$this->data['advising_modals'] = 'Body/AssessmentContent/AdvisingModals';
		$this->data['registration'] = 'Body/AssessmentContent/Registration';

		// Get the courses student apllied
		// $this->data['student_courses'] = $this->get_student_course_choices($ref_no);
		// $array = array();
		// foreach ($this->data['student_courses'] as $student_course) {
		// 	$course_info = $this->get_student_course_info($student_course);
		// 	$array[] = $course_info;
		// }
		// $this->data['courses_info'] = $array;

		#Get Program Choice
		$this->data['courses'] = $this->AssesmentModel->get_all_programs();

		#Get from Student_Account Table
		$student_account = $this->AssesmentModel->get_student_account_by_reference_number($ref_no);
		$this->data['interview_status'] = $student_account['interview_status'];

		#Get from Student_Info Table
		$student_info_array = $this->AssesmentModel->get_student_by_reference_number($ref_no);
		$this->data['course'] = $student_info_array['Course'];
		// $course_info = $this->get_student_course_info($this->data['course']);
		// $this->data['courses_info'] = $course_info;
		// die(json_encode($this->data['courses_info']));

		#Get Course Info
		$picked_course = $this->get_student_course_info($student_info_array['Course']);
		$this->data['program_code'] = $picked_course['Program_Code'];
		$this->data['program_name'] = $picked_course['Program_Name'];

		#Get Major
		$major = $this->AssesmentModel->get_major_by_id($student_info_array['Major']);
		$this->data['major'] = $major['Program_Major'];

		#Get type (Transferee or Freshmen)
		$shs_bridge = $this->AssesmentModel->get_shs_student_number_by_reference_number($this->session->userdata('reference_no'));
		$this->data['shs_student_number'] = empty($shs_bridge) ? '' : $shs_bridge['shs_student_number'];
		$this->data['applied_status'] = empty($shs_bridge) ? '' : $shs_bridge['applied_status'];

		#Get Legend (Year and Semester Choices)
		$this->data['legend'] = $this->AdvisingModel->getlegend();

		#Get Advising Session
		$queue = $this->AdvisingModel->get_queued_subjects($this->session->userdata('reference_no'));
		$this->data['sy_session'] = empty($queue) ? $this->data['legend']['School_Year'] : $queue[0]['School_Year'];
		$this->data['sem_session'] = empty($queue) ? $this->data['legend']['Semester'] : $queue[0]['Semester'];

		#Get Current Advising History and Remove if legend did not match 
		// $advising_history = $this->AdvisingModel->get_advising_history(array('reference_no' => $this->session->userdata('reference_no')));
		// if (!empty($advising_history)) {
		// 	if ($advising_history['Legend_SY'] != $this->data['sy_session'] || $advising_history['Legend_Sem'] != $this->data['sem_session']) {
		// 		$this->AdvisingModel->remove_advising_session($this->session->userdata('reference_no'));
		// 	}
		// 	// echo json_encode($queue);
		// }

		#Set Advising Session as basis
		$this->session->set_userdata('SY_LEGEND', $this->data['sy_session'] != '' ? $this->data['sy_session'] : $this->data['legend']['School_Year']);
		$this->session->set_userdata('SEM_LEGEND', $this->data['sem_session'] != '' ? $this->data['sem_session'] : $this->data['legend']['Semester']);

		// SHS balance checker
		$shs_bridge = $this->AssesmentModel->get_shs_student_number_by_reference_number($ref_no);
		$this->data['shs_student_number'] = empty($shs_bridge) ? '' : $shs_bridge['shs_student_number'];
		$this->data['applied_status'] = empty($shs_bridge) ? '' : $shs_bridge['applied_status'];
		$this->data['csrf_token'] = hash('tiger192,3', uniqid());
		$this->default_template($this->view_directory->assessment());
	}

	public function get_student_information()
	{
		$student_info_array = $this->AssesmentModel->get_student_by_reference_number($this->session->userdata('reference_no'));
		echo json_encode($student_info_array);
	}

	// OSE LOGIN ,Password Reset and Setup User Pass
	public function setSession($data)
	{
		$this->session->set_userdata(array(
			'reference_no' =>  $data['reference_no'],
			'Student_Number' =>  $data['Student_Number'],
			'first_name' => $data['First_Name'],
			'middle_name' => $data['Middle_Name'],
			'last_name' => $data['Last_Name'],
			'yearlevel' => $data['YearLevel'],
			'course' => $data['Course'],
			'major' => $data['Major'],
			'admittedsy' => $data['AdmittedSY'],
			'admittedsem' => $data['AdmittedSEM'],
			'email' => $data['Email'],
			'student_folder' => $data['folder_name'],
			'gdrive_folder' => $data['gdrive_id']
		));
		// echo json_encode($data);
	}
	public function email($cp, $from, $from_name, $send_to, $subject, $message)
	{
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => '465',
			'smtp_timeout' => '7',
			'smtp_user' => 'webmailer@sdca.edu.ph',
			'smtp_pass' => 'sdca2017',
			'charset' => 'utf-8',
			'newline' => '\r\n',
			'mailtype'  => 'html',
			'validation' => true,
			'wordwrap' => true
		);
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from($from, $from_name);
		$this->email->to($send_to);
		$this->email->subject($subject);
		$this->email->message($message);
		if ($this->email->send()) {
			echo  'Email has been sent to ' . $cp;
			echo  '<br><br>';
		} else {
			echo  "<h4>There was a problem with sending an email.</h4>";
			echo  "<br><br>For any concers, proceed to our <a href'#' style'font-size:15px; color:#00F;'>Helpdesk</a> or the MIS Office.";
		}
		//email debugger
		// echo $this->email->print_debugger(array('headers'));

	}
	public function loginProcess()
	{
		$this->tokenHandler('login');
		try {
			$username = $this->input->post('loginUsername');
			$password = $this->input->post('loginPassword');

			$data = $this->mainmodel->checkLogin($username, $password);
			if (!empty($data)) {
				$this->setSession($data);
				$this->session->set_flashdata('success', $data['First_Name'] . ' ' . $data['Last_Name']);
				redirect(base_url('index.php/Main/selfassesment'));
			} else {
				$this->session->set_flashdata('msg', 'Incorrect username or password!!');
				redirect(base_url('/'));
			}
		} catch (\Exception $e) {
			$this->session->set_flashdata('msg', $e);
			redirect(base_url('/'));
		}
	}
	// Forgot Password Send Email when submit
	public function sendEmail()
	{
		$this->tokenHandler('forgot_password');
		$this->load->helper('string');
		try {
			$data = $this->mainmodel->checkEmail($this->input->post('email'));
			if (!empty($data)) {
				$codes = $this->mainmodel->getAllStudAccount();
				$generate_code = random_string('alnum', 20);
				foreach ($codes as $list) {
					if ($generate_code == $list['automated_code']) {
						$generate_code = random_string('alnum', 20);
					}
				}
				$this->mainmodel->changeKeyWithRefNo($data['reference_no'], array('automated_code' => $generate_code));

				// $encrypt_code = $this->encryption->encrypt($generate_code);

				// for live stdominiccollege.edu.ph
				$this->sdca_mailer->sendEmail($data['First_Name'] . ' ' . $data['Last_Name'], 'jfabregas@sdca.edu.ph', 'St. Dominic College of Asia', $this->input->post('email'), 'Forgot Password', 'Click this link to reset your password. {unwrap}https://stdominiccollege.edu.ph/Onestop/index.php/main/changePassword/' . $generate_code . '{/unwrap}');

				// $this->sdca_mailer->sendEmail($data['First_Name'] . ' ' . $data['Last_Name'], 'jfabregas@sdca.edu.ph', 'St. Dominic College of Asia', $this->input->post('email'), 'Forgot Password', 'Click this link to reset your password. {unwrap}https://localhost/Onestop/main/changePassword/' . $encrypt_code . '{/unwrap}');
				// echo array('type'=>'success','msg' => "We've sent a confirmation link on your email. Click the link to reset your password.");
				$this->session->set_flashdata('success', "We've sent a confirmation link on your email. Click the link to reset your password.");
				redirect(base_url('/'));
			} else {
				// echo array('type'=>'error','msg' => 'You input a wrong email!!');
				$this->session->set_flashdata('msg', 'You input a wrong email!!');
				redirect(base_url('index.php/Main/forgotPassword'));
			}
		} catch (\Exception $e) {
			$this->session->set_flashdata('msg', $e);
			redirect(base_url('index.php/Main/forgotPassword'));
		}
	}
	public function changePassword($key = '')
	{
		// token change password
		$token = hash('tiger192,3', uniqid());
		$this->data['csrf_token'] = $token;
		$_SESSION['csrf_token']['change_password'] = $token;

		if (!empty($key)) {
			$this->data['key'] = $key;
			$data = $this->mainmodel->checkKey($key);
			if (!empty($data)) {
				$this->login_template($this->view_directory->changePassword());
			} else {
				$this->session->set_flashdata('msg', 'Incorrect key!!');
				redirect(base_url('/'));
			}
		} else {
			$this->session->set_flashdata('msg', 'Incorrect key!!');
			redirect(base_url('/'));
		}
	}
	public function changePasswordProcess()
	{
		$this->tokenHandler('change_password');
		try {
			$key = $this->input->post('JoduXy33bU2EUwRsdjR0uhodvplaX54c5mVbGBNBYRU=');
			$password = $this->input->post('new_password');
			$this->mainmodel->changeUserPass($key, array(
				'password' => $password,
				'automated_code' => ''
			));
			$this->session->set_flashdata('success', 'You have successfully changed your password.!!');
			redirect(base_url('/'));
		} catch (\Exception $e) {
			$this->session->set_flashdata('msg', $e);
			redirect(base_url('/'));
		}
	}
	public function setupUserPass($key = '')
	{
		if (!empty($key)) {
			$this->data['key'] = $key;
			$data = $this->mainmodel->checkKey($key);
			$checkStudentInfoRefNo = $this->mainmodel->checkStudentInfoRefNo($key);
			$ref_id = empty($checkStudentInfoRefNo)?'':$checkStudentInfoRefNo['Reference_Number'];
			$checkStudentAccountByRefNo = $this->mainmodel->checkStudentAccountByRefNo($key);
			// creation of account using reference number
			if ($ref_id!=""&&$ref_id==$key) {
				if(!empty($checkStudentAccountByRefNo)){
					if($checkStudentAccountByRefNo['username']==""&&$checkStudentAccountByRefNo['password']==""){
						$this->mainmodel->updateAccountWithRefNo($key,array(
							'automated_code' => $key
						));
					}
					else{
						$this->session->set_flashdata('msg', 'Incorrect key!!');
						redirect(base_url('/'));
					}
					
				}
				else{
					$this->mainmodel->insert_student_account(array(
						'automated_code' => $key,
						'reference_no' => $key
					));
				}
				$this->login_template($this->view_directory->setupUserPass());
			}
			// creation of account using automated_code
			else if (!empty($data)) {
				$this->login_template($this->view_directory->setupUserPass());
				// exit;
			} else {
				$this->session->set_flashdata('msg', 'Incorrect key!!');
				redirect(base_url('/'));
			}
			// if (!empty($data)) {
			// 	$this->login_template($this->view_directory->setupUserPass());
			// 	exit;
			// } else {
			// 	$this->session->set_flashdata('msg', 'Incorrect key!!');
			// 	redirect(base_url('/'));
			// }
		} else {
			$this->session->set_flashdata('msg', 'Incorrect key!!');
			redirect(base_url('/'));
		}
	}
	public function changeUserPassProcess()
	{
		$this->tokenHandler('setup_userpass');
		try {
			$key = $this->input->post('JoduXy33bU2EUwRsdjR0uhodvplaX54c5mVbGBNBYRU=');
			// $data = $this->mainmodel->checkKey($key);
			$checkStudentAccountForDuplication  = $this->mainmodel->checkStudentAccountForDuplication('username', $this->input->post('username'));
			if (empty($checkStudentAccountForDuplication)) {
				// echo 'empty';
				$data = $this->mainmodel->checkKey($key);
				$folder_name = $data['First_Name'] . ' ' . $data['Middle_Name'] . ' ' . $data['Last_Name'];
				$this->mainmodel->changeUserPass($key, array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('new_password'),
					'automated_code' => '',
					'folder_name' => $folder_name
				));
				if (!is_dir('assets/student/' . $folder_name)) {
					mkdir('assets/student/' . $folder_name, 0777, true);
					mkdir('assets/student/' . $folder_name . '/requirement', 0777, true);
				}
				$this->setSession($data);
				$this->session->set_flashdata('success', $data['First_Name'] . ' ' . $data['Last_Name']);
				redirect(base_url('index.php/Main/selfassesment'));
			} else {
				// echo 'not empty';
				$this->session->set_flashdata('error', 'This username is not available to used!!');
				redirect($_SERVER['HTTP_REFERER']);
			}
		} catch (\Exception $e) {
			$this->session->set_flashdata('msg', $e);
			redirect(base_url('/'));
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('/'));
	}
	public function validateSession()
	{
		if (empty($this->session->userdata('reference_no'))) {
			$this->session->set_flashdata('msg', 'Session Expired!!');
			redirect(base_url('/'));
		}
	}

	// Inside OSE
	public function wizard_tracker_status()
	{
		#Sets Reference Number
		$ref_no = $this->session->userdata('reference_no');

		#Gets Legend
		$legend = $this->AdvisingModel->getlegend();

		#Compares legend to recent advising transaction (if any)
		$data = array(
			'reference_no' => $ref_no
		);

		#Defaults progress search to current legend if new student or new schoolyear
		$advising_history = $this->AdvisingModel->get_advising_history($data);
		$Schoolyear = $legend['School_Year'];
		$Semester = $legend['Semester'];
		if (!empty($advising_history)) {
			// if ($legend['School_Year'] == $advising_history['Legend_SY']) {

			// 	$Schoolyear = $advising_history['Taken_SY'];
			// }
			// if ($legend['Semester'] == $advising_history['Legend_Sem']) {
			// 	$Semester = $advising_history['Taken_Sem'];
			// }
			$Schoolyear = $advising_history['Taken_SY'];
			$Semester = $advising_history['Taken_Sem'];
		}
		// echo $Schoolyear . ':' . $Semester;
		#Checks progress
		$status = $this->AssesmentModel->tracker_status($ref_no, $Schoolyear, $Semester);
		$student_account = $this->AssesmentModel->get_student_account_by_reference_number($ref_no);
		// $count = 0;
		$enrolled_students = $this->AssesmentModel->enrolled_student($ref_no);
		foreach ($enrolled_students as $enrolled_student) {
			if ($enrolled_student['semester'] != $legend['Semester'] && $enrolled_student['schoolyear'] != $legend['School_Year']) {
				$data['old_student'] = 1;
			}
		}
		// die('asdasd');
		// echo $count;
		// die();
		// die(json_encode($count));
		// $data['payment'] = 0;
		// $data['advising'] = 0;
		// $data['requirements'] = 0;
		// $data['student_information'] = 0;

		if ($status['Ref_Num_fec'] != null && $status['Ref_Num_si'] != null && $status['Ref_Num_ftc'] != null) {
			$data['payment'] = 1;
		} else if ($status['Ref_Num_ftc'] != null) {
			$data['advising'] = 1;
		} else if ($student_account['interview_status'] != null) {
			$data['requirements'] = 1;
		} else if ($status['Course'] != 'N/A') {
			$data['student_information'] = 1;
		} else {
			$data['student_information'] = 0;
		}
		echo json_encode($data);
		// return json_encode($data);
	}
	// Waiting updates
	public function shs_balance_checker($student_number = '', $applied_status = '')
	{
		if ($applied_status == 'freshmen') {
			if ($student_number != "" || $student_number != null || $student_number) {
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
			} else {
				$array['status'] = 'no_student_number';
			}
		} else {
			$array['status'] = 'transferee';
		}

		return $array;
	}
	public function shs_balance_checker_echo($student_number = '', $applied_status = '')
	{
		if ($student_number != "" || $student_number != null) {
			$array = $this->shs_balance_checker($student_number, $applied_status);
			// die($array);
			echo json_encode($array);
		} else {
			echo 'No Input';
		}
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
	// Get Program by Program Code
	// Used For Ajax
	public function echo_get_student_course_info()
	{
		$program_code = $this->input->post('program_code');
		$program_major = $this->input->post('program_major');
		$course_info = $this->get_student_course_info($program_code);
		$major = $this->AssesmentModel->get_major_by_id($program_major);
		$course_info['Program_Major'] = $major['Program_Major'];
		echo json_encode($course_info);
	}
	// Get Program Major by Program Code
	// Used For Ajax
	public function get_student_course_major($program_code)
	{
		$major = $this->AssesmentModel->get_major_by_course($program_code);
		echo json_encode($major);
		return $major;
	}
	public function update_course_by_reference_number()
	{
		$reference_number = $this->session->userdata('reference_no');
		$student_number = $this->input->post('student_number');
		$status = $this->input->post('status');
		// $student_number = '2';
		// $status = 'freshmen';
		// $check_course = $this->check_course_by_reference_number($this->session->userdata('reference_no'));
		// if ($check_course == 'none') {
		$shs_status = $this->shs_balance_checker($student_number, $status);
		// die(json_encode($shs_status));
		if ($shs_status['status'] == 'empty') {
			echo json_encode(array(
				'title' => 'No Data Found in Database!',
				'body' => '',
				'status' => 'failed'
			));
			return;
		} else if ($shs_status['status'] == 'dept') {
			echo json_encode(array(
				'title' => 'You still have BALANCE!',
				'body' => '',
				'status' => 'failed'
			));
			return;
		} else {
			$today = date("Y-m-d H:i:s");
			$array_update = array(
				'reference_number' => $reference_number,
				'course' => $this->input->post('course'),
				'major' => $this->input->post('major'),
			);
			$update = $this->AssesmentModel->update_course_by_reference_number($array_update);
			//
			$shs_info = $this->AssesmentModel->get_shs_student_number_by_reference_number($reference_number);
			if (empty($shs_info)) {

				$array_insert_shs = array(
					'highered_reference_number' => $reference_number,
					'shs_student_number' => $student_number,
					'applied_status' => $status,
					'created_at' => $today,
				);
				$this->AssesmentModel->insert_shs_student_number($array_insert_shs);
			} else {
				$array_update_shs = array(
					'highered_reference_number' => $reference_number,
					'shs_student_number' => $student_number,
					'applied_status' => $status,
					'updated_at' => $today,
				);
				$this->AssesmentModel->update_shs_student_number($array_update_shs);
			}

			if ($update) {
				echo json_encode(array(
					'title' => 'Success',
					'body' => 'Course successfully updated.',
					'status' => 'success'
				));
			}
			return;
		}
		return;
		// } else {
		// 	echo json_encode(array(
		// 		'title' => 'You Already Have Course!',
		// 		'body' => 'Contact MIS department for this issue.',
		// 		'status' => 'failed'
		// 	));
		// 	return;
		// }
	}

	public function check_course_by_reference_number($reference_number)
	{
		$student = $this->AssesmentModel->get_student_by_reference_number($reference_number);
		if ($student['Course'] == 'N/A') {
			return 'none';
		} else if ($student['Course']) {
			return $student;
		} else {
			return 'none';
		}
	}

	public function forgotPassword()
	{
		// token forgot password
		$token = hash('tiger192,3', uniqid());
		$this->data['csrf_token'] = $token;
		$_SESSION['csrf_token']['forgot_password'] = $token;
		
		
		$this->login_template($this->view_directory->forgotPassword());
	}
	public function passwordReset()
	{
		// token password reset
		$token = hash('tiger192,3', uniqid());
		$this->data['csrf_token'] = $token;
		$_SESSION['csrf_token']['password_reset'] = $token;

		$this->default_template($this->view_directory->passwordReset());
	}
	public function passwordResetProcess()
	{
		$this->tokenHandler('password_reset');
		try {
			$old_password = $this->input->post('old_password');
			$new_password = $this->input->post('new_password');
			$reference_no = $this->session->userdata('reference_no');
			$data = $this->mainmodel->checkOldPassword($reference_no, $old_password);
			if (!empty($data)) {
				$this->mainmodel->updateAccountWithRefNo($reference_no, array(
					'password' => $new_password
				));
				$this->session->set_flashdata('success', 'You Successfully changed your password!');
				redirect(base_url('index.php/Main/passwordReset'));
			} else {
				$this->session->set_flashdata('error', 'Incorrect old password!!');
				redirect(base_url('index.php/Main/passwordReset'));
			}
		} catch (\Exception $e) {
			$this->session->set_flashdata('error', $e);
			redirect(base_url('index.php/Main/passwordReset'));
		}
	}
	public function dataTable()
	{
		$this->default_template($this->view_directory->dataTable());
	}
	public function getDataTableData()
	{
		$page = $this->input->get("page");
		$search = $this->input->get("search");
		if (empty($page)) {
			$page = 1;
		}
		// rows per page
		$per_page = 10;

		// offset 
		$offset = ($page * $per_page) - $per_page;

		if (!empty($search)) {
			$this->db->like('name', $search);
			$this->db->like('age',  $search);
			$this->db->like('date',  $search);
		}
		$sql = $this->db->get("sample", $per_page, $offset)->result_array();
		echo json_encode($sql);
	}
	public function validationOfDocuments()
	{
		// generate token
		// $token = hash('tiger192,3', uniqid());
		// $this->data['csrf_token'] = $token;
		// $_SESSION['csrf_token']['requirements'] = $token;

		// date_default_timezone_set('Asia/Kolkata');
		$getRequirementsList = $this->mainmodel->getRequirementsList();
		$count = 0;
		foreach ($getRequirementsList as $list) {
			$checkRequirement = $this->mainmodel->checkRequirement($list['id_name']);
			$getRequirementsList[$count]['status'] = empty($checkRequirement['status']) ? '' : $checkRequirement['status'];
			$getRequirementsList[$count]['date'] = empty($checkRequirement['requirements_date']) ? '' : date("M. j,Y g:ia", strtotime($checkRequirement['requirements_date']));
			// date("M. j,Y g:ia",strtotime($checkRequirement['requirements_date']))
			++$count;
		}
		// exit;
		$this->data['requirements'] = $getRequirementsList;
		$this->default_template($this->view_directory->validationOfDocuments());
	}
	public function validationOfTobeFollowedDocuments()
	{
		// date_default_timezone_set('Asia/Kolkata');
		$getRequirementsList = $this->mainmodel->getRequirementsList();
		$count = 0;
		foreach ($getRequirementsList as $list) {
			$checkRequirement = $this->mainmodel->checkRequirement($list['id_name']);
			$getRequirementsList[$count]['status'] = empty($checkRequirement['status']) ? '' : $checkRequirement['status'];
			$getRequirementsList[$count]['date'] = empty($checkRequirement['requirements_date']) ? '' : date("M. j,Y g:ia", strtotime($checkRequirement['requirements_date']));
			$getRequirementsList[$count]['if_married'] = empty($checkRequirement['if_married']) ? '0' : $checkRequirement['if_married'];
			// date("M. j,Y g:ia",strtotime($checkRequirement['requirements_date']))
			++$count;
		}
		$this->data['requirements'] = $getRequirementsList;
		$this->default_template($this->view_directory->ValidationOfTobeFollowedDocuments());
	}
	public function validationDocumentsProcess()
	{
		// $this->tokenHandler('requirements');

		$user_fullname = $this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') . ' ' . $this->session->userdata('last_name');
		date_default_timezone_set('Asia/manila');
		$ref_no = $this->session->userdata('reference_no');
		// for interview radio button
		$interview = $this->input->post('interview');
		$array_update = array(
			'reference_number' => $ref_no,
			'interview' => $this->input->post('interview'),
		);

		$this->AssesmentModel->update_interview_status($array_update);
		$getRequirementsList = $this->mainmodel->getRequirementsList();
		// $config['upload_path'] = './assets/student/'.$this->session->userdata('student_folder').'/requirement';
		$config['upload_path'] = './express/assets/';
		$config['allowed_types'] = '*';
		$row = "";
		$array_files = array();
		$array_filestodelete = array();
		$array_completefiles = array();
		$upload_count = 0;
		$error_count = 0;
		$error_files = array();
		$validate_count = 0;
		try {
			$email_data = array(
				'send_to' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
				'reply_to' => 'jfabregas@sdca.edu.ph',
				'sender_name' => 'St. Dominic College of Asia',
				'send_to_email' => $this->session->userdata('email'),
				'title' => 'Student Requirements',
				'message' => 'Email/ValidationOfDocument'
			);

			foreach ($getRequirementsList as $list) {
				$id_name = $list['id_name'];
				$checkRequirement = $this->mainmodel->checkRequirement($id_name);
				$config['file_name'] = $id_name . '_' . $ref_no . '' . date("YmdHis");
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->overwrite = true;
				$req_status = 'to follow';
				$status_col = empty($checkRequirement) ? '' : $checkRequirement['status'];
				if ($this->input->post('check_' . $list['id_name']) == null && $status_col == "") {
					++$validate_count;
					$req_status = 'pending';
					if ($this->upload->do_upload($id_name)) {
						++$upload_count;
						$uploaded_data = $this->upload->data();
						array_push($array_files, array(
							"name" => $uploaded_data['orig_name'],
							"type" => $uploaded_data['file_type'],
							'rq_name' => $list['rq_name']
						));
						array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
					} else {
						++$error_count;
						array_push($error_files, $list['id_name']);
					}
				} else if ($this->input->post('check_' . $list['id_name']) == null && $status_col == "to follow") {
					++$validate_count;
					$req_status = 'pending';
					if ($this->upload->do_upload($id_name)) {
						$uploaded_data = $this->upload->data();
						++$upload_count;
						array_push($array_files, array(
							"name" => $uploaded_data['orig_name'],
							"type" => $uploaded_data['file_type'],
							'rq_name' => $list['rq_name']
						));
						array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
					} else {
						++$error_count;
						array_push($error_files, $list['id_name']);
						// echo json_encode(array("msg" => $this->upload->display_errors()));
						// $this->session->set_flashdata('error', $this->upload->display_errors());

						// redirect($_SERVER['HTTP_REFERER']);
						// exit;
					}
				}



				$file_type = "";
				$orig_name = "";
				if ($this->input->post('check_' . $list['id_name']) == null) {
					$file_type = empty($uploaded_data['file_type']) ? '' : $uploaded_data['file_type'];
					$orig_name = empty($uploaded_data['orig_name']) ? '' : $uploaded_data['orig_name'];
				}
				if (!empty($checkRequirement)) {
					if ($checkRequirement['status'] == "to follow") {
						$this->mainmodel->updateRequirementLog(array(
							'requirements_date' => date("Y-m-d H:i:s"),
							'file_submitted' => $orig_name,
							'file_type' => $file_type,
							'status' => $req_status,
						), $id_name);
					}
					$row = $row . "<tr><td>" . $checkRequirement['requirements_name'] . "</td><td>" . date("M. j,Y g:ia") . "</td></tr>";
				} else {
					$this->mainmodel->newRequirementLog(array(
						'requirements_name' => $id_name,
						'requirements_date' => date("Y-m-d H:i:s"),
						'status' => $req_status,
						'reference_no' => $ref_no,
						'file_submitted' => $orig_name,
						'file_type' => $file_type,
						'if_married' => $id_name == 'marriage_certificate' ? $this->input->post('if_married') : 0
					));
				}
				// 

			}
			$getRequirementsLogPerRefNo = $this->mainmodel->getRequirementsLogPerRefNo();
			foreach ($getRequirementsLogPerRefNo as $reqloglist) {
				if ($reqloglist['requirements_name'] != "proof_of_payment") {
					array_push($array_completefiles, array(
						"name" => $reqloglist['rq_name'],
						"status" => $reqloglist['status'],
						"req_date" => $reqloglist['requirements_date'],
						"id_name" => $reqloglist['id_name'],
						"if_married" => $reqloglist['if_married']
					));
				}
			}
			$all_uploadeddata = array("folder_name" => $ref_no . '/' . $user_fullname, "data" => $array_files);
			if ($error_count == 0 && $upload_count > 0) {
				$result = $this->gdrive_uploader->index($all_uploadeddata);
				$decode_result = json_decode($result, true);
				if (!empty($result)) {
					if ($decode_result['msg'] == "success") {
						$this->sdca_mailer->sendHtmlEmail($email_data['send_to'], $email_data['reply_to'], $email_data['sender_name'], $email_data['send_to_email'], $email_data['title'], $email_data['message'], array(
							'student_name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') . ' ' . $this->session->userdata('last_name'),
							'requirements' => $array_completefiles,
							'datetime' => date("Y-m-d H:i:s"),
							'gdrive_link' => "https://drive.google.com/drive/u/0/folders/" . $result
						));

						$files = glob('express/assets/*'); // get all file names
						foreach ($files as $file) {
							if (in_array($file, $array_filestodelete)) {
								if (is_file($file)) {
									unlink($file); // delete file
								}
							}
						}
						$this->mainmodel->updateAccountWithRefNo($ref_no, array('gdrive_id' => $decode_result['id']));
						$this->session->set_userdata('gdrive_folder', $decode_result['id']);
						$this->session->set_flashdata('success', 'Successfully submitted!!');
						redirect($_SERVER['HTTP_REFERER']);
					} else {
						$this->session->set_flashdata('error', "Files Upload Error: " . $result);
						redirect($_SERVER['HTTP_REFERER']);
					}
				} else {
					$files = glob('express/assets/*'); // get all file names
					foreach ($files as $file) {
						if (in_array($file, $array_filestodelete)) {
							if (is_file($file)) {
								unlink($file); // delete file
							}
						}
					}
					// $this->mainmodel->revertIfErrorInRequirementUpload();
					$this->session->set_flashdata('error', 'Gdrive Uploader is Offline');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
			else if($upload_count == 0){
				$this->session->set_flashdata('success', 'Successfully submitted!!');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else {
				$this->mainmodel->revertIfErrorInRequirementUpload();
				$this->session->set_flashdata('error', 'Files Upload Error: ' . $error_count . ' files failed to upload!! failed on -');
				$error_files2 = implode(',',$error_files);
				$this->session->set_flashdata('error_files', $error_files2);
				redirect($_SERVER['HTTP_REFERER']);
			}
			// echo json_encode(array("msg" => 'Successfully Uploaded'));
		} catch (\Exception $e) {
			// echo $e;
			$this->session->set_flashdata('error', $e);
			redirect($_SERVER['HTTP_REFERER']);
			// echo json_encode(array("msg" => $e));
		}
	}
	// Payment Notification
	public function notifyWhenPaymentSubmitted($ref_no = "", $amount = "", $email = "")
	{

		$student_info = $this->mainmodel->getStudentAccountInfo($ref_no);
		//  CC to Accounting notification
		$student_email = "";
		if ($email != "") {
			$student_email = $email;
		} else {
			$student_email = $student_info['Email'];
		}
		$all_uploadeddata = array(
			'ref_no' => $ref_no,
			'amount' => $amount
		);
		$string = http_build_query($all_uploadeddata);
		$ch = curl_init("http://localhost:4003/api/NotifyIfSubmitted/");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_exec($ch);
		curl_close($ch);

		$email_data = array(
			'send_to' => $student_info['First_Name'] . ' ' . $student_info['Last_Name'],
			'reply_to' => 'jfabregas@sdca.edu.ph',
			'sender_name' => 'St. Dominic College of Asia',
			'send_to_email' => $student_email,
			'title' => 'Proof of Payment',
			'message' => 'Email/PaymentEvidence'
		);
		$this->sdca_mailer->sendHtmlEmail($email_data['send_to'], $email_data['reply_to'], $email_data['sender_name'], $email_data['send_to_email'], $email_data['title'], $email_data['message'], array('student_info' => $student_info, 'total_amount' => $amount));
	}
	public function uploadProofOfPayment()
	{
		// token proof of payment
		$token = hash('tiger192,3', uniqid());
		$this->data['csrf_token'] = $token;
		$_SESSION['csrf_token']['proof_of_payment'] = $token;

		$checkRequirement = $this->mainmodel->checkRequirement('proof_of_payment');
		$getStudentAccountInfo = $this->mainmodel->getStudentAccountInfo($this->session->userdata('reference_no'));
		$this->data['student_number'] = $getStudentAccountInfo['Student_Number'];
		if (!empty($checkRequirement)) {
			// $result = $this->gdrive_uploader->getFileId(array('file_name'=>$checkRequirement['file_submitted'],'folder_id'=>$this->session->userdata('gdrive_folder')));
			$this->data['gdrive_link'] = $checkRequirement['path_id'];
			$this->data['date_submitted'] = $checkRequirement['requirements_date'];
			$this->data['payment_type'] = empty($this->mainmodel->getProofOfPaymentInfo($checkRequirement['id'])) ? '' : $this->mainmodel->getProofOfPaymentInfo($checkRequirement['id'])['payment_type'];
		}
		// echo '<pre>'.print_r($checkRequirement,1).'</pre>';
		// exit;
		// print_r($checkRequirement);
		$this->default_template($this->view_directory->uploadProofOfPayment());
	}
	public function uploadProofOfPaymentProcess()
	{
		$this->tokenHandler('proof_of_payment');
		$user_fullname = $this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') . ' ' . $this->session->userdata('last_name');
		$ref_no = $this->session->userdata('reference_no');
		$id_name = "proof_of_payment";
		$config['upload_path'] = './express/assets/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $id_name . '_' . $ref_no . '' . date("YmdHis");
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		$this->upload->overwrite = true;
		$uploaded = array();
		$array_filestodelete = array();
		$checkRequirement = $this->mainmodel->checkRequirement('proof_of_payment');
		$orig_name = "";
		$orig_type = "";
		// print_r($_FILES['images']);
		// exit;
		if ($this->upload->do_upload('images')) {
			$uploaded_data = $this->upload->data();
			// print_r($uploaded_data);
			// echo 'success';
			// exit;
			$orig_name = $uploaded_data['orig_name'];
			$orig_type = $uploaded_data['file_type'];
			array_push($uploaded, array(
				"name" => $uploaded_data['orig_name'],
				"type" => $uploaded_data['file_type'],
				'rq_name' => 'Proof of Payment'
			));
			array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
			$result = $this->gdrive_uploader->index(array("folder_name" => $ref_no . '/' . $user_fullname, "data" => $uploaded));
			$decode_result = json_decode($result, true);
			$files = glob('express/assets/*'); // get all file names
			foreach ($files as $file) {
				if (in_array($file, $array_filestodelete)) {
					if (is_file($file)) {
						unlink($file); // delete file
					}
				}
			}
			if (!empty($result)) {
				if ($decode_result['msg'] == "success") {
					$this->session->set_userdata('gdrive_folder', $decode_result['id']);
					$this->mainmodel->updateAccountWithRefNo($ref_no, array('gdrive_id' => $decode_result['id']));
					if (!empty($checkRequirement)) {
						$this->mainmodel->updateRequirementLog(array(
							'requirements_name' => 'proof_of_payment',
							'requirements_date' => date("Y-m-d H:i:s"),
							'status' => 'pending',
							'reference_no' => $ref_no,
							'file_submitted' => $uploaded_data['orig_name'],
							'file_type' => $uploaded_data['file_type'],
							// 'path_id' => empty($getId)?'':$getId
						), 'proof_of_payment');
					} else {
						$req_id = $this->mainmodel->newRequirementLog(array(
							'requirements_name' => 'proof_of_payment',
							'requirements_date' => date("Y-m-d H:i:s"),
							'status' => 'pending',
							'reference_no' => $ref_no,
							'file_submitted' => $orig_name,
							'file_type' => $orig_type,
							// 'path_id' => empty($getId)?'':$getId
						));
						$this->mainmodel->insertProofOfPayments(array(
							'req_id' => $req_id,
							'bank_type' => $this->input->post('bank_type'),
							'payment_type' => $this->input->post('payment_type'),
							'acc_num' => $this->input->post('account_number'),
							'acc_holder_name' => $this->input->post('holder_name'),
							'payment_reference_no' => $this->input->post('reference_number'),
							'ref_no' => $ref_no,
							'amount_paid' => $this->input->post('amount_paid')
						));
					}
				} else {
					$this->session->set_flashdata('error', "Files Upload Error: " . $result);
					redirect($_SERVER['HTTP_REFERER']);
				}
			} else {
				$this->session->set_flashdata('error', "Files Upload Error: Google drive is OFFLINE");
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			$error = array('error' => $this->upload->display_errors());
			// print_r($error);
			// exit;
			$this->session->set_flashdata('error', 'Upload Error');
			redirect($_SERVER['HTTP_REFERER']);
			exit;
		}

		$this->session->set_flashdata('success', 'Successfully Uploaded');
		// $this->uploadProofOfPayment();
		redirect(base_url('index.php/Main/uploadProofOfPayment'));

		// header('Refresh: X; URL='.base_url('index.php/Main/uploadProofOfPayment'));
	}
	public function checkForGdriveUploader()
	{
		// $
		// echo $this->session->userdata('email');
		// $result = $this->gdrive_uploader->getFileId(array('file_name'=>'proof_of_payment_1958820210413144412.jpg','folder_id'=>'1G3uDh8fY0RF4B_uIjbhmXWtdXDdrH3tk'));
		// $result = $this->gdrive_uploader->getAllFilesInFolder();
		$result = $this->gdrive_uploader->getFileId(array('file_name' => 'proof_of_payment_120210516165438.jpg', 'folder_id' => '1liBMl-D_lnaddA7oWrsJv59V37XDFwtM'));
		// $decode = json_decode($result,true);
		// echo '<pre>'.print_r($decode,1).'</pre>';
		echo $result;
	}
	public function testSession()
	{
		echo $this->session->userdata('gdrive_folder');
	}
	public function getProofOfPaymentImage()
	{
		$checkRequirement = $this->mainmodel->checkRequirement('proof_of_payment');
		$result = $this->gdrive_uploader->getFileId(array('file_name' => $checkRequirement['file_submitted'], 'folder_id' => $this->session->userdata('gdrive_folder')));
		if (!empty($result)) {
			$this->mainmodel->updateRequirementLog(array('path_id' => $result), 'proof_of_payment');
		}
		echo json_encode($result);
	}

	public function assign_curriculum($param)
	{

		#get legends
		$legends = $this->AdvisingModel->getlegend();

		#get program_id
		$Course = $this->AdvisingModel->get_course($param['reference_number']);

		$inputs = array(
			'reference_no' => $param['reference_number'],
			'School_Year' => $legends['School_Year'],
			'Program_ID' => $Course
		);

		#get curriculum id
		$curriculumdata = $this->AdvisingModel->get_curriculum($inputs);
		$inputs['curriculum'] = $curriculumdata['Curriculum_ID'];

		#update curriculum data
		$updatestatus = $this->AdvisingModel->update_student_curriculum($inputs);
		return $updatestatus;
	}
	public function setApiSession()
	{
		$this->session->set_userdata(array('random_shit' => 'asdasdasdasd'));
		$random = $this->session->userdata('random_shit');
		echo json_encode(array('random_number' => $random));
	}
	public function ExportInquiry($ref = '')
	{
		$info  = $this->mainmodel->Get_Info($ref)->result_array();
		$param = array(
			'student_info' => $info[0],
			'student_type' => 'HED',
		);
		$this->load->library('Student', $param);
		$this->load->library('InquiryExport', $param);
		$this->inquiryexport->Export($info);
		//echo $ref;

	}

	public function interview_status()
	{
		$interview = $this->input->post('interview');
		$array_update = array(
			'reference_number' => $this->session->userdata('reference_no'),
			'interview' => $interview,
		);
		$this->AssesmentModel->update_interview_status($array_update);
		// die($post);
	}

	public function sdcaInquiry()
	{
		$getStudentInquiry = $this->mainmodel->getStudentInquiry();
		$count = 0;
		foreach ($getStudentInquiry as $inquiry) {
			$getStudentInquiry[$count]['total_message'] = $this->mainmodel->countTotalUnseenMessage($inquiry['ref_no']);
			++$count;
		}
		$this->data['getStudentInquiry'] = $getStudentInquiry;
		$this->chat_template($this->view_directory->chatAdmin());
	}
	public function forTest()
	{
		echo strtotime(date("Y-m-d H:i:s")) >= strtotime(date("Y-m-d 08:00:00")) && strtotime(date("Y-m-d H:i:s")) < strtotime(date("Y-m-d 17:00:00")) ? 'yes' : 'no';
	}
	// public function 

	public function enrollment_breakdown()
	{
		$this->default_template($this->view_directory->enrollmentBreakdown());
	}
	// public function ajaxBreakdownProofOfPayment(){
	// 	$proof = $this->mainmodel->getPoofOfPaymentLog();
	// 	echo json_encode($proof);
	// }
	public function ajaxBreakdownRequirements()
	{
		$array_completefiles = array();
		$getRequirementsLogPerRefNo = $this->mainmodel->getAllRequirementsLogByRef();
		foreach ($getRequirementsLogPerRefNo as $reqloglist => $values) {
			// if ($reqloglist['requirements_name'] != "proof_of_payment") {
			array_push($array_completefiles, array(
				"name" => $values['requirements_name'],
				"status" => $values['status'],
				"req_date" => $values['requirements_date'],
				"if_married" => $values['if_married']
			));
			// }
		}
		echo json_encode($getRequirementsLogPerRefNo);
	}
	public function account_creation_old()
	{
	}
	public function getOldAccountTable()
	{
		$legend = $this->AdvisingModel->getlegend();
		$getOldAccountStudentInfo = $this->mainmodel->getOldAccountStudentInfo($legend['Semester'], $legend['School_Year']);
		echo json_encode($getOldAccountStudentInfo);
		// echo '<pre>'.print_r($getOldAccountStudentInfo,1).'</pre>';
	}
	public function checksession()
	{
		if (!$this->session->userdata('reference_no')) {
			$this->session->set_flashdata('msg', 'Session Timed Out');
			echo base_url() . 'index.php/Main/logout';
		} else {
			echo '';
		}
	}
	public function unsetdata()
	{
		$this->session->unset_userdata('reference_no');
	}
	public function resetEnrollmentLegend()
	{
		$legend = $this->AdvisingModel->getlegend();
		$this->data['sem'] =  $legend['Semester'];
		$this->data['sy'] =  $legend['School_Year'];
		$this->default_template($this->view_directory->resetEnrollmentLegend());
	}
	public function updateEnrollmentLegend()
	{
		$sy = $this->input->get('school_year');
		$sem = $this->input->get('sem');
		$this->mainmodel->updateLegend(array('Semester' => $sem, 'School_Year' => $sy));
		echo json_encode('success');
	}
	public function hashSomething(){
		// $gen = hash(algo:'sha256',uniqid());
		$gen = hash('tiger192,3', uniqid());
		echo $this->session->csrf_token['login'];
	}
}
