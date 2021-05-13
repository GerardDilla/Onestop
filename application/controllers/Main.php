<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Main extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->studentdata = array();
	}

	public function index()
	{	
		$this->login_template($this->view_directory->login());
		$this->appkey = 'testkey101';
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
		try {
			$username = $this->input->post('loginUsername');
			$password = $this->input->post('loginPassword');

			$data = $this->mainmodel->checkLogin($username, $password);
			if (!empty($data)) {
				$this->setSession($data);
				$this->session->set_flashdata('success', $data['First_Name'] . ' ' . $data['Last_Name']);
				redirect(base_url('main/selfassesment'));
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

				$encrypt_code = $this->encryption->encrypt($generate_code);

				// $encrypt_code = $generate_code;
				// $this->sendemail->test();exit;
				// echo $data['First_Name'].' '.$data['Last_Name'];exit;
				$this->sdca_mailer->sendEmail($data['First_Name'] . ' ' . $data['Last_Name'], 'jfabregas@sdca.edu.ph', 'St. Dominic College of Asia', $this->input->post('email'), 'Forgot Password', 'Click this link to reset your password. {unwrap}http://localhost/Onestop/main/changePassword/' . $encrypt_code . '{/unwrap}');
				// echo array('type'=>'success','msg' => "We've sent a confirmation link on your email. Click the link to reset your password.");
				$this->session->set_flashdata('success', "We've sent a confirmation link on your email. Click the link to reset your password.");
				redirect(base_url('/'));
			} else {
				// echo array('type'=>'error','msg' => 'You input a wrong email!!');
				$this->session->set_flashdata('msg', 'You input a wrong email!!');
				redirect(base_url('main/forgotPassword'));
			}
		} catch (\Exception $e) {
			$this->session->set_flashdata('msg', $e);
			redirect(base_url('main/forgotPassword'));
		}
	}
	public function changePassword($key = '')
	{
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
			if (!empty($data)) {
				$this->login_template($this->view_directory->setupUserPass());
			} else {
				$this->session->set_flashdata('msg', 'Incorrect key!!');
				redirect(base_url('/'));
			}
		} else {
			$this->session->set_flashdata('msg', 'Incorrect key!!');
			redirect(base_url('/'));
		}
	}
	public function changeUserPassProcess()
	{
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
				redirect(base_url('main/selfassesment'));
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

	public function selfassesment()
	{

		$this->data['student_information'] = 'Body/AssessmentContent/StudentInformation';
		$this->data['advising'] = 'Body/AssessmentContent/Advising';
		$this->data['payment'] = 'Body/AssessmentContent/Payment';
		$this->data['advising_modals'] = 'Body/AssessmentContent/AdvisingModals';

		// echo $this->session->userdata('reference_no');
		$this->data['courses'] = $this->get_student_course_choices($this->session->userdata('reference_no'));
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
		// $ref_no = $this->input->post('Reference_Number');
		$ref_no = $this->session->userdata('reference_no');
		$legend = $this->AdvisingModel->getlegend();
		$status = $this->AssesmentModel->tracker_status($ref_no, $legend['School_Year'], $legend['Semester']);
		// $data['registration'] = 1;
		// $data['advising'] = 1;
		// $data['student_information'] = 1;


		if ($status['Ref_Num_fec'] != null && $status['Ref_Num_si'] != null && $status['Ref_Num_ftc'] != null) {
			$data['registration'] = 1;
		} else if ($status['Ref_Num_ftc'] != null) {
			$data['advising'] = 1;
		} else if ($status['Course'] != null) {
			$data['student_information'] = 1;
		} else {
			$data['student_information'] = 0;
		}
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
		$check_course = $this->check_course_by_reference_number($this->session->userdata('reference_no'));
		if ($check_course == 'none') {
			$array = array(
				'reference_number' => $this->session->userdata('reference_no'),
				'course' => $this->input->post('course'),
				'major' => $this->input->post('major'),
			);
			$update = $this->AssesmentModel->update_course_by_reference_number($array);
			if ($update) {

				#Auto assigns curriculum
				$this->assign_curriculum($array);

				echo json_encode(array(
					'title' => 'Success',
					'body' => 'Course successfully updated.',
					'status' => 'success'
				));
			}
		} else {
			echo json_encode(array(
				'title' => 'You Alredy Have Course!',
				'body' => 'Contact MIS department for this issue.',
				'status' => 'failed'
			));
		}
	}
	public function check_course_by_reference_number($reference_number)
	{
		$student = $this->AssesmentModel->get_student_by_reference_number($reference_number);
		if ($student['Course'] == 'N/A') {
			return 'none';
		}
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
	public function passwordReset()
	{
		$this->default_template($this->view_directory->passwordReset());
	}
	public function passwordResetProcess()
	{
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
				redirect(base_url('main/passwordReset'));
			} else {
				$this->session->set_flashdata('error', 'Incorrect old password!!');
				redirect(base_url('main/passwordReset'));
			}
		} catch (\Exception $e) {
			$this->session->set_flashdata('error', $e);
			redirect(base_url('main/passwordReset'));
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
		$user_fullname = $this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') . ' ' . $this->session->userdata('last_name');
		date_default_timezone_set('Asia/manila');
		$ref_no = $this->session->userdata('reference_no');
		$getRequirementsList = $this->mainmodel->getRequirementsList();
		// $config['upload_path'] = './assets/student/'.$this->session->userdata('student_folder').'/requirement';
		$config['upload_path'] = './express/assets/';
		$config['allowed_types'] = '*';
		$row = "";
		$array_files = array();
		$array_filestodelete = array();
		$array_completefiles = array();
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
				$req_status = 'to be follow';
				$status_col = empty($checkRequirement) ? '' : $checkRequirement['status'];
				if ($this->input->post('check_' . $list['id_name']) == null && $status_col == "") {
					$req_status = 'pending';
					if ($this->upload->do_upload($id_name)) {
						$uploaded_data = $this->upload->data();
						array_push($array_files, array(
							"name" => $uploaded_data['orig_name'],
							"type" => $uploaded_data['file_type'],
							'rq_name' => $list['rq_name']
						));
						array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
					} else {
						// echo json_encode(array("msg" => $this->upload->display_errors()));
						$this->session->set_flashdata('error', $this->upload->display_errors());
						// redirect(base_url('main/validationOfDocuments'));exit;
						redirect($_SERVER['HTTP_REFERER']);
					}
				} else if ($this->input->post('check_' . $list['id_name']) == null && $status_col == "to be follow") {
					$req_status = 'pending';
					if ($this->upload->do_upload($id_name)) {
						$uploaded_data = $this->upload->data();
						array_push($array_files, array(
							"name" => $uploaded_data['orig_name'],
							"type" => $uploaded_data['file_type'],
							'rq_name' => $list['rq_name']
						));
						array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
					} else {
						// echo json_encode(array("msg" => $this->upload->display_errors()));
						$this->session->set_flashdata('error', $this->upload->display_errors());
						// redirect(base_url('main/validationOfDocuments'));exit;
						redirect($_SERVER['HTTP_REFERER']);
						exit;
					}
				}



				$file_type = "";
				$orig_name = "";
				if ($this->input->post('check_' . $list['id_name']) == null) {
					$file_type = empty($uploaded_data['file_type']) ? '' : $uploaded_data['file_type'];
					$orig_name = empty($uploaded_data['orig_name']) ? '' : $uploaded_data['orig_name'];
				}
				if (!empty($checkRequirement)) {
					if ($checkRequirement['status'] == "to be follow") {
						$this->mainmodel->updateRequirementLog(array(
							'requirements_date' => date("Y-m-d H:i:s"),
							'file_submitted' => $orig_name,
							'file_type' => $file_type,
							'status' => 'pending',
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
			// echo '<pre>'.print_r($array_completefiles,1).'</pre>';
			// exit;
			$all_uploadeddata = array("folder_name" => $ref_no . '/' . $user_fullname, "data" => $array_files);

			$string = http_build_query($all_uploadeddata);
			$ch = curl_init("http://localhost:4003/uploadtodrive/");
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$result = curl_exec($ch);
			if ($result != null && $result != "") {
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
				$this->mainmodel->updateAccountWithRefNo($ref_no, array('gdrive_id' => $result));
				$this->session->set_flashdata('success', 'Successfully submitted!!');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$files = glob('express/assets/*'); // get all file names
				foreach ($files as $file) {
					if (in_array($file, $array_filestodelete)) {
						if (is_file($file)) {
							unlink($file); // delete file
						}
					}
				}
				$this->mainmodel->revertIfErrorInRequirementUpload();
				$this->session->set_flashdata('error', 'Gdrive Uploader is Offline');
				redirect($_SERVER['HTTP_REFERER']);
			}
			curl_close($ch);
			// echo json_encode(array("msg" => 'Successfully Uploaded'));
		} catch (\Exception $e) {
			// echo $e;
			$this->session->set_flashdata('error', $e);
			redirect($_SERVER['HTTP_REFERER']);
			// echo json_encode(array("msg" => $e));
		}
	}
	public function notifyWhenPaymentSubmitted($ref_no = "", $amount = "", $email = "")
	{
		$student_info = $this->mainmodel->getStudentAccountInfo($ref_no);
		//  CC to Accounting notification
		$student_email = "";
		if ($student_info['Email'] != "") {
			$student_email = $student_info['Email'];
		} else {
			$student_email = $email;
		}
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
		$user_fullname = $this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') . ' ' . $this->session->userdata('last_name');
		$ref_no = $this->session->userdata('reference_no');
		$id_name = "proof_of_payment";
		$config['upload_path'] = './express/assets/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $id_name . '_' . $ref_no . '' . date("YmdHis");
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->overwrite = true;
		$uploaded = array();
		$array_filestodelete = array();
		$checkRequirement = $this->mainmodel->checkRequirement('proof_of_payment');
		$orig_name = "";
		$orig_type = "";
		if ($this->upload->do_upload('images')) {
			$uploaded_data = $this->upload->data();
			// print_r($uploaded_data);
			$orig_name = $uploaded_data['orig_name'];
			$orig_type = $uploaded_data['file_type'];
			array_push($uploaded, array(
				"name" => $uploaded_data['orig_name'],
				"type" => $uploaded_data['file_type'],
				'rq_name' => 'Proof of Payment'
			));
			array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
			$result = $this->gdrive_uploader->index(array("folder_name" => $ref_no . '/' . $user_fullname, "data" => $uploaded));

			$upload_success = false;
			if (!empty($result)) {
				$this->session->set_userdata('gdrive_folder', $result);
				$this->mainmodel->updateAccountWithRefNo($ref_no, array('gdrive_id' => $result));
			}
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
			$this->session->set_flashdata('error', 'Upload Error');
			redirect($_SERVER['HTTP_REFERER']);
			exit;
		}

		// res.send();

		$files = glob('express/assets/*'); // get all file names
		foreach ($files as $file) {
			if (in_array($file, $array_filestodelete)) {
				if (is_file($file)) {
					unlink($file); // delete file
				}
			}
		}
		$this->session->set_flashdata('success', 'Successfully Uploaded');
		// $this->uploadProofOfPayment();
		redirect(base_url('main/uploadProofOfPayment'));

		// header('Refresh: X; URL='.base_url('main/uploadProofOfPayment'));
	}
	public function checkForGdriveUploader()
	{
		// $
		// echo $this->session->userdata('email');
		// $result = $this->gdrive_uploader->getFileId(array('file_name'=>'proof_of_payment_1958820210413144412.jpg','folder_id'=>'1G3uDh8fY0RF4B_uIjbhmXWtdXDdrH3tk'));
		// $result = $this->gdrive_uploader->getAllFilesInFolder();
		$result = $this->gdrive_uploader->getFileId(array('file_name' => 'proof_of_payment_108820210415102145.jpg', 'folder_id' => $this->session->userdata('gdrive_folder')));
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
	public function setApiSession(){
		$this->session->set_userdata(array('random_shit'=>'asdasdasdasd'));
		$random = $this->session->userdata('random_shit');
		echo json_encode(array('random_number'=>$random));
	}
	
	public function sdcaInquiry()
	{
		$getStudentInquiry = $this->mainmodel->getStudentInquiry();
		$count = 0;
		foreach($getStudentInquiry as $inquiry){
			$getStudentInquiry[$count]['total_message'] = empty($this->mainmodel->countTotalUnseenMessage($inquiry['ref_no']))?0:$this->mainmodel->countTotalUnseenMessage($inquiry['ref_no']);
			++$count;
		}
		$this->data['getStudentInquiry'] = $getStudentInquiry;
		$this->chat_template($this->view_directory->chatAdmin());
	}
	// public function 
}
