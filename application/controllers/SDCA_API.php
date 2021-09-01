<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SDCA_API extends CI_Controller
{

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Request-Headers: Content-Type');
        parent::__construct();
        // $this->load->model('MainModel');
        $this->load->library('email');
        $this->load->library('sdca_mailer', array('email' => $this->email, 'load' => $this->load));
        $this->load->model('MainModel','mainmodel');
        $this->load->library('gdrive_uploader', array('folder_id' => '1_Ui30Jb_-N9ENG1XatjdT2GzVHXzmuRi'));
        $this->load->library('session');
		// $this->load->library('gdrive_uploader', array('folder_id' => '1pqk-GASi0205D9Y8QEi0zGNrEdH8nmap'));
        $this->reference_number = $this->session->userdata('reference_no');
        $this->load->database();
    }
    public function index()
    {

    }
    // API FOR Student Portal for Uploading of Proof of Payments
    public function uploadProofOfPaymentProcess()
	{
        // $http_back = "http://localhost/SDCAPORTAL/index.php/ProofOfPayment";
        $http_back = "https://stdominiccollege.edu.ph/SDCAPORTAL/index.php/ProofOfPayment";
		$this->load->model('MainModel','mainmodel');
		// $this->tokenHandler('proof_of_payment');
		$user_fullname = $this->session->userdata('last_name').', '.$this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') ;
		$ref_no = $this->session->userdata('reference_no');
		$payment_term = $this->input->post('payment_term');
		$id_name = "proof_of_payment";
		$config['upload_path'] = './express/assets/';
		$config['allowed_types'] = '*';
		$config['file_name'] =  $payment_term . $ref_no . '' . date("YmdHis");
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
			$orig_name = $uploaded_data['orig_name'];
			$orig_type = $uploaded_data['file_type'];
			array_push($uploaded, array(
				"name" => $uploaded_data['orig_name'],
				"type" => $uploaded_data['file_type'],
				'rq_name' => 'Proof of Payment'
			));
			array_push($array_filestodelete, 'express/assets/' . $uploaded_data['orig_name']);
			// $result = $this->gdrive_uploader->uploadWithDifferentDriveID(array("main_folder_id"=>"1Hrg19tx5YgsxFJ2T--HblVRmoJtfnhhj","token_type"=>"","folder_name" => $this->reference_number . '/' . $user_fullname, "data" => $uploaded));
			$result = $this->gdrive_uploader->uploadWithDifferentDriveID(array("main_folder_id"=>"1aNXXe7fO_amTVsXYFMz8yz36NqeYCXnu","token_type"=>"treasury","folder_name" => $this->reference_number . '/' . $user_fullname, "data" => $uploaded));
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
					$this->session->set_userdata('proof_gdrive_folder', $decode_result['id']);
					// $this->mainmodel->updateAccountWithRefNo($this->reference_number, array('gdrive_id' => $decode_result['id']));
					// if (!empty($checkRequirement)) {
					// 	$this->mainmodel->updateRequirementLog(array(
					// 		'requirements_name' => 'proof_of_payment',
					// 		'requirements_date' => date("Y-m-d H:i:s"),
					// 		'status' => 'pending',
					// 		'reference_no' => $this->reference_number,
					// 		'file_submitted' => $uploaded_data['orig_name'],
					// 		'file_type' => $uploaded_data['file_type'],
					// 	), 'proof_of_payment');
					// } else {
					$req_id = $this->mainmodel->newRequirementLog(array(
						'requirements_name' => 'proof_of_payment',
						'requirements_date' => date("Y-m-d H:i:s"),
						'status' => 'pending',
						'reference_no' => $this->reference_number,
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
						'ref_no' => $this->reference_number,
						'amount_paid' => $this->input->post('amount_paid'),
						'gdrive_folder_id' => $decode_result['id'],
						'term' => $payment_term
					));
					// }
				} else {
					$this->session->set_flashdata('error', "Files Upload Error: " . $result);
					redirect($http_back);
				}
			} else {
				$this->session->set_flashdata('error', "Files Upload Error: Google drive is OFFLINE");
				redirect($http_back);
			}
		} else {
			$error = array('error' => $this->upload->display_errors());
			// print_r($error);
			// exit;
			$this->session->set_flashdata('error', 'Upload Error');
            redirect($http_back);
			exit;
		}

		$this->session->set_flashdata('success', 'Successfully Uploaded');
		// $this->uploadProofOfPayment();
		redirect($http_back);

		// header('Refresh: X; URL='.base_url('index.php/Main/uploadProofOfPayment'));
	}
}

