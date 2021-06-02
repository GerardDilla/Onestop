<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentNotificationApi extends CI_Controller
{

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Request-Headers: Content-Type');
        parent::__construct();
        $this->load->model('MainModel');
        $this->load->library('email');
        $this->load->library('sdca_mailer', array('email' => $this->email, 'load' => $this->load));
        $this->load->database();
    }
    public function index()
    {
        if ($this->input->post("api_key") == "2021sdca") {
            $ref_no = $this->input->post("ref_no");
            $amount = $this->input->post("amount");
            // $email = $this->input->post("email");
            $cashier_id = $this->input->post("cashier_id");

                $student_info = $this->MainModel->getStudentAccountInfo($ref_no);
                //  CC to Accounting notification
                $student_email = "";
                // if ($email != "") {
                //     $student_email = $email;
                // } else {
                //     $student_email = $student_info['Email'];
                // }
                $student_email = empty($student_info['Email'])?'':$student_info['Email'];
                // echo json_encode($student_info);
                // exit;
                $all_uploadeddata = array(
                    'ref_no' => $ref_no,
                    'amount' => $amount
                );
                $string = http_build_query($all_uploadeddata);
                $ch = curl_init("http://stdominiccollege.edu.ph:4004/api/NotifyIfSubmitted/");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                // curl_exec($ch);
                curl_setopt($ch, CURLOPT_FAILONERROR, true);
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
                echo $error_msg .'<br>';
                }
                else{
                // echo json_encode(array('success'=>$result));
                }
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
                $this->MainModel->insertCashierPaymentLogs(array(
                    'cashier_id' => $cashier_id,
                    'total_amount' => $amount,
                    'email' => $student_email,
                    'ref_no' => $ref_no,
                    'date_created' => date("Y-m-d H:i:s")
                ));
                // echo json_encode('success');
            }
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
            $this->MainModel->insertCashierPaymentLogs(array(
                'cashier_id' => $cashier_id,
                'total_amount' => $amount,
                'email' => $student_email,
                'ref_no' => $ref_no,
                'date_created' => date("Y-m-d H:i:s")
            ));
        }
    }
}
