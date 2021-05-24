<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentNotificationApi extends CI_Controller
{
    
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Request-Headers: Content-Type');
        $this->load->model("MainModel","mainmodel");
        $this->load->library('email');
        $this->load->library('sdca_mailer', array('email' => $this->email, 'load' => $this->load));
    }
    public function index($ref_no = "", $amount = "", $email = ""){
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
}