<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Main extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//$this->load->view('Body/index');
		// $this->default_template($this->view_directory->assessment());
		// echo 'hello';
		$this->login_template($this->view_directory->login());
		$this->appkey = 'testkey101';
	}
<<<<<<< HEAD
	// OSE LOGIN ,Password Reset and Setup User Pass
	public function setSession($data)
	{
		$this->session->set_userdata(array(
			'reference_no' =>  $data['reference_no'],
			'student_no' =>  $data['reference_no'],
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
=======
	public function forgotPassword()
>>>>>>> parent of 7cd9605 (Merge branch 'development' into feature-advising)
	{
		$this->login_template($this->view_directory->forgotPassword());
	}
	public function selfassesment()
	{
		//$this->curl_test();
		$this->data['student_information'] = 'Body/Assessment_Content/Student_Information';
		$this->data['advising'] = 'Body/Assessment_Content/Advising';
		$this->data['payment'] = 'Body/Assessment_Content/Payment';
		$this->default_template($this->view_directory->assessment());
	}
	private function curl_test()
	{

		$url = base_url() . 'index.php/temp_api/test';
		$fields = [
			'name '      => 'gerard',
			'type' => 'admin'
		];
		$fields_string = http_build_query($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		echo $result;
	}
	public function passwordReset()
	{
		$this->default_template($this->view_directory->passwordReset());
	}
	public function logout()
	{
		redirect(base_url('/'));
	}
	public function export_assessmentform($reference_number, $schoolyear, $semester)
	{
		$reference_number = $reference_number;
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
			//$data['get_totalcash']               = $this->RegForm_Model->Get_Total_CashPayment($ref_num,$sem,$sy);
			$data['get_totalunits']               = $this->RegFormModel->totalUnitsAdvising_TRF($array);
			echo json_encode($data);
		}
		$this->load->view('Body/Assessment_Content/AssessmentForm');
	}

	public function phpspreadsheettest()
	{

		// $spreadsheet = new Spreadsheet();
		$this->inputFileType = 'Xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv\
		$this->inputFileName = './assets/excel_template/AssessmentForm_Template.xlsx';
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->inputFileName);
		$sheet = $spreadsheet->getActiveSheet();
		// $this->sheet1 = $this->spreadsheet->getSheet(0);
		// $this->sheet2 = $this->spreadsheet->getSheet(1);
		// $this->cell;

		$sheet->setCellValue('E8', '123145');
		$sheet->setCellValue('C9', 'GERARD DILLA');
		$sheet->setCellValue('D10', '12321321312321321321321321321');

		// $sheet->setCellValue('A1', 'Hello World !');

		// $writer = new Xlsx($spreadsheet);
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf($spreadsheet);
		$writer->writeAllSheets();
		// header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="teststes.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output'); // download file 
	}
	private function assessmentform_export_data()
	{
		$this->sheet1->setCellValue($data['Cell'], $data['Value']);
	}
}
