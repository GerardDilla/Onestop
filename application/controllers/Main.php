<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
	public function index()
	{
		$this->login_template($this->view_directory->login());
	}
	// OSE LOGIN ,Password Reset and Setup User Pass
	public function setSession($data){
		$this->session->set_userdata(array(
			'reference_no' =>  $data['reference_no'],
			'first_name' => $data['First_Name'],
			'middle_name' => $data['Middle_Name'],
			'last_name' => $data['Last_Name'],
			'yearlevel' => $data['YearLevel'],
			'course' => $data['Course'],
			'major' => $data['Major'],
			'admittedsy' => $data['AdmittedSY'],
			'admittedsem' => $data['AdmittedSEM'],
			'email' => $data['Email'],
			'student_folder' => $data['folder_name']
		));
	}
	public function loginProcess(){
		try{
			$username = $this->input->post('loginUsername');
			$password = $this->input->post('loginPassword');
			$data = $this->mainmodel->checkLogin($username,$password);
			if(!empty($data)){
				// print_r($data);
				$this->setSession($data);
				$this->session->set_flashdata('success',$data['First_Name'].' '.$data['Last_Name']);
				// exit;
				redirect(base_url('main/selfassesment'));
			}else{
				$this->session->set_flashdata('msg','Incorrect username or password!!');
				redirect(base_url('/'));
			}
		}
		catch(\Exception $e){
			$this->session->set_flashdata('msg',$e);
			redirect(base_url('/'));
		}
		
	}
	public function forgotPassword(){
		$this->login_template($this->view_directory->forgotPassword());
	}
	// Forgot Password Send Email when submit
	public function sendEmail(){
		$this->load->helper('string');
		try{
			$data = $this->mainmodel->checkEmail($this->input->post('email'));
			if(!empty($data)){
				$codes = $this->mainmodel->getAllStudAccount();
				$generate_code = random_string('alnum', 20);
				foreach($codes as $list){
					if($generate_code==$list['automated_code']){
						$generate_code = random_string('alnum', 20);
					}
				}
				$this->mainmodel->changeKeyWithRefNo($data['reference_no'],array('automated_code' => $generate_code ));

				// $encrypt_code = $this->encryption->encrypt($generate_code);

				$encrypt_code = $generate_code;
				// $this->sendemail->test();exit;
				// echo $data['First_Name'].' '.$data['Last_Name'];exit;
				$this->sdca_mailer->sendEmail($data['First_Name'].' '.$data['Last_Name'],'jfabregas@sdca.edu.ph','St. Dominic College of Asia',$this->input->post('email'),'Forgot Password','Click this link to reset your password. {unwrap}http://localhost/Onestop/main/changePassword/'.$encrypt_code.'{/unwrap}');
				// echo array('type'=>'success','msg' => "We've sent a confirmation link on your email. Click the link to reset your password.");
				$this->session->set_flashdata('success',"We've sent a confirmation link on your email. Click the link to reset your password.");
				redirect(base_url('/'));
			}
			else{
				// echo array('type'=>'error','msg' => 'You input a wrong email!!');
				$this->session->set_flashdata('msg','You input a wrong email!!');
				redirect(base_url('main/forgotPassword'));
			}
			
		}
		catch(\Exception $e){
			$this->session->set_flashdata('msg',$e);
			redirect(base_url('main/forgotPassword'));
		}
	}
	public function changePassword($key = ''){
		if(!empty($key)){
			$this->data['key'] = $key;
			$data = $this->mainmodel->checkKey($key);
			if(!empty($data)){
				$this->login_template($this->view_directory->changePassword());
			}
			else{
				$this->session->set_flashdata('msg','Incorrect key!!');
				redirect(base_url('/'));
			}
		}
		else{
			$this->session->set_flashdata('msg','Incorrect key!!');
			redirect(base_url('/'));
		}
	}
	public function changePasswordProcess(){
		try{
			$key = $this->input->post('JoduXy33bU2EUwRsdjR0uhodvplaX54c5mVbGBNBYRU=');
			$password = $this->input->post('new_password');
			$this->mainmodel->changeUserPass($key,array(
				'password' => $password,
				'automated_code' => ''
			));
			$this->session->set_flashdata('success','You have successfully changed your password.!!');
			redirect(base_url('/'));
		}
		catch(\Exception $e){
			$this->session->set_flashdata('msg',$e);
			redirect(base_url('/'));
		}
	}
	public function setupUserPass($key = ''){
		if(!empty($key)){
			$this->data['key'] = $key;
			$data = $this->mainmodel->checkKey($key);
			if(!empty($data)){
				$this->login_template($this->view_directory->setupUserPass());
			}
			else{
				$this->session->set_flashdata('msg','Incorrect key!!');
				redirect(base_url('/'));
			}
		}
		else{
			$this->session->set_flashdata('msg','Incorrect key!!');
			redirect(base_url('/'));
		}
		
	}
	public function changeUserPassProcess(){
		try{
			$key = $this->input->post('JoduXy33bU2EUwRsdjR0uhodvplaX54c5mVbGBNBYRU=');
			// $data = $this->mainmodel->checkKey($key);
			$checkStudentAccountForDuplication  = $this->mainmodel->checkStudentAccountForDuplication('username',$this->input->post('username'));
			if(empty($checkStudentAccountForDuplication)){
				// echo 'empty';
				$data = $this->mainmodel->checkKey($key);
				$folder_name = $data['First_Name'].' '.$data['Middle_Name'].' '.$data['Last_Name'];
				$this->mainmodel->changeUserPass($key,array(
					'username' => $this->input->post('username') ,
					'password' => $this->input->post('new_password'),
					'automated_code' => '',
					'folder_name' => $folder_name
				));
				if (!is_dir('assets/student/'.$folder_name)) {
					mkdir('assets/student/'.$folder_name,0777,true);
					mkdir('assets/student/'.$folder_name.'/requirement',0777,true);
				}
				$this->setSession($data);
				$this->session->set_flashdata('success',$data['First_Name'].' '.$data['Last_Name']);
				redirect(base_url('main/selfassesment'));
			}
			else{
				// echo 'not empty';
				$this->session->set_flashdata('error','This username is not available to used!!');
				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}
		catch(\Exception $e){
			$this->session->set_flashdata('msg',$e);
			redirect(base_url('/'));
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('/'));
	}
	public function validateSession(){
		if(empty($this->session->userdata('reference_no'))){
			$this->session->set_flashdata('msg','Session Expired!!');
			redirect(base_url('/'));
		}
	}

	// Inside OSE

	public function selfassesment(){
		$this->data['student_information'] = 'Body/Assessment_Content/Student_Information';
		$this->data['advising'] = 'Body/Assessment_Content/Advising';
		$this->data['payment'] = 'Body/Assessment_Content/Payment';
		$this->default_template($this->view_directory->assessment());
	}
	public function passwordReset(){
		$this->default_template($this->view_directory->passwordReset());

	}
	public function passwordResetProcess(){
		try{
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$reference_no = $this->session->userdata('reference_no');
		$data = $this->mainmodel->checkOldPassword($reference_no,$old_password);
			if(!empty($data)){
				$this->mainmodel->updateAccountWithRefNo($reference_no,array(
					'password' => $new_password
				));
				$this->session->set_flashdata('success','You Successfully changed your password!');
				redirect(base_url('main/passwordReset'));
			}
			else{
				$this->session->set_flashdata('error','Incorrect old password!!');
				redirect(base_url('main/passwordReset'));
			}
		}
		catch(\Exception $e){
			$this->session->set_flashdata('error',$e);
			redirect(base_url('main/passwordReset'));
		}
	}
	public function dataTable(){
		$this->default_template($this->view_directory->dataTable());

	}
	public function getDataTableData(){
		$page = $this->input->get("page");
		$search = $this->input->get("search");
		if(empty($page)){
			$page = 1;
		}
		// rows per page
		$per_page = 10;

		// offset 
		$offset = ($page * $per_page) - $per_page;

		if(!empty($search)){
			$this->db->like('name', $search);
			$this->db->like('age',  $search);
			$this->db->like('date',  $search);
		}
		$sql = $this->db->get("sample",$per_page,$offset)->result_array();
		echo json_encode($sql);
	}
	public function validationOfDocuments(){
		// date_default_timezone_set('Asia/Kolkata');
		$getRequirementsList = $this->mainmodel->getRequirementsList();
		$count = 0;
		foreach($getRequirementsList as $list){
			$checkRequirement = $this->mainmodel->checkRequirement($list['id_name']);
			$getRequirementsList[$count]['status'] = empty($checkRequirement['status'])?'':$checkRequirement['status'];
			$getRequirementsList[$count]['date'] = empty($checkRequirement['requirements_date'])?'':date("M. j,Y g:ia",strtotime($checkRequirement['requirements_date']));
			// date("M. j,Y g:ia",strtotime($checkRequirement['requirements_date']))
			++$count;
		}
		// exit;
		$this->data['requirements'] = $getRequirementsList;
		$this->default_template($this->view_directory->validationOfDocuments());
	}
	public function validationOfTobeFollowedDocuments(){
		// date_default_timezone_set('Asia/Kolkata');
		$getRequirementsList = $this->mainmodel->getRequirementsList();
		$count = 0;
		foreach($getRequirementsList as $list){
			$checkRequirement = $this->mainmodel->checkRequirement($list['id_name']);
			$getRequirementsList[$count]['status'] = empty($checkRequirement['status'])?'':$checkRequirement['status'];
			$getRequirementsList[$count]['date'] = empty($checkRequirement['requirements_date'])?'':date("M. j,Y g:ia",strtotime($checkRequirement['requirements_date']));
			// date("M. j,Y g:ia",strtotime($checkRequirement['requirements_date']))
			++$count;
		}
		// exit;
		// echo '<pre>'.print_r($getRequirementsList,1).'</pre>';
		// exit;
		$this->data['requirements'] = $getRequirementsList;
		$this->default_template($this->view_directory->ValidationOfTobeFollowedDocuments());
	}
	public function validationDocumentsProcess(){
		$user_fullname = $this->session->userdata('first_name').' '.$this->session->userdata('middle_name').' '.$this->session->userdata('last_name');
		
		
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
		try{
			$email_data = array(
				'send_to' => $this->session->userdata('first_name').' '.$this->session->userdata('last_name'),
				'reply_to' => 'jfabregas@sdca.edu.ph',
				'sender_name' => 'St. Dominic College of Asia',
				'send_to_email' => $this->session->userdata('email'),
				'title' => 'Student Requirements',
				'message' => 'Email/ValidationOfDocument'
			);
			
			foreach($getRequirementsList as $list){
				// if($this->input->post('check_'.$list['id_name'])!=null){
				// 	$this->mainmodel->newRequirementLog(array(
				// 		'requirements_name' => $id_name,
				// 		'requirements_date' => date("Y-m-d H:i:s"),
				// 		'status' => 'to be follow',
				// 		'reference_no' => $ref_no
				// 	));
				// }
				
				// echo $this->input->post($list['id_name']).'<br>';
				
				$id_name = $list['id_name'];
				$checkRequirement = $this->mainmodel->checkRequirement($id_name);
				$config['file_name'] = $id_name.'_'.$ref_no.''.date("YmdHis");
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->overwrite = true;
				$req_status = 'to be follow';
				$status_col = empty($checkRequirement)?'':$checkRequirement['status'];
				if($this->input->post('check_'.$list['id_name'])==null&&$status_col==""){
					$req_status = 'pending';
					if ($this->upload->do_upload($id_name))
					{
						$uploaded_data = $this->upload->data();
						array_push($array_files,array(
							"name" => $uploaded_data['orig_name'],
							"type" => $uploaded_data['file_type'],
							'rq_name' => $list['rq_name']
						));
						array_push($array_filestodelete,'express/assets/'.$uploaded_data['orig_name']);
						
					}
					else{
						// echo json_encode(array("msg" => $this->upload->display_errors()));
						$this->session->set_flashdata('error',$this->upload->display_errors());
						// redirect(base_url('main/validationOfDocuments'));exit;
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if($this->input->post('check_'.$list['id_name'])==null&&$status_col=="to be follow"){
					$req_status = 'pending';
					if ($this->upload->do_upload($id_name))
					{
						$uploaded_data = $this->upload->data();
						array_push($array_files,array(
							"name" => $uploaded_data['orig_name'],
							"type" => $uploaded_data['file_type'],
							'rq_name' => $list['rq_name']
						));
						array_push($array_filestodelete,'express/assets/'.$uploaded_data['orig_name']);
						
					}
					else{
						// echo json_encode(array("msg" => $this->upload->display_errors()));
						$this->session->set_flashdata('error',$this->upload->display_errors());
						// redirect(base_url('main/validationOfDocuments'));exit;
						redirect($_SERVER['HTTP_REFERER']);exit;
					}
				}
				

				
				$file_type = "";
				$orig_name = "";
				if($this->input->post('check_'.$list['id_name'])==null){
					$file_type = empty($uploaded_data['file_type'])?'':$uploaded_data['file_type'];
					$orig_name = empty($uploaded_data['orig_name'])?'':$uploaded_data['orig_name'];
				}
				if(!empty($checkRequirement)){
					// $getRequirementsLog = $this->mainmodel->getRequirementsLog($r);
					if($checkRequirement['status']=="to be follow"){
						$this->mainmodel->updateRequirementLog(array(
							'requirements_date' => date("Y-m-d H:i:s"),
							'file_submitted' => $orig_name,
							'file_type' => $file_type,
							'status' => 'pending'
						),$id_name);
					}
					$row = $row."<tr><td>".$checkRequirement['requirements_name']."</td><td>".date("M. j,Y g:ia")."</td></tr>";
					
				}
				else{
					$this->mainmodel->newRequirementLog(array(
						'requirements_name' => $id_name,
						'requirements_date' => date("Y-m-d H:i:s"),
						'status' => $req_status,
						'reference_no' => $ref_no,
						'file_submitted' => $orig_name,
						'file_type' => $file_type
					));
				}
				

				// 
				
			}
			$getRequirementsLogPerRefNo = $this->mainmodel->getRequirementsLogPerRefNo();
			foreach($getRequirementsLogPerRefNo as $reqloglist){
				array_push($array_completefiles,array(
					"name" => $reqloglist['rq_name'],
					"status" => $reqloglist['status']
				));
			}
			$all_uploadeddata = array("folder_name"=>$ref_no.'/'.$user_fullname,"data"=> $array_files);

			$string = http_build_query($all_uploadeddata);
			$ch = curl_init("http://localhost:4003/uploadtodrive/");
			curl_setopt($ch,CURLOPT_POST,true);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

			$result = curl_exec($ch);
			if($result!=null&&$result!=""){
				$this->sdca_mailer->sendHtmlEmail($email_data['send_to'],$email_data['reply_to'],$email_data['sender_name'],$email_data['send_to_email'],$email_data['title'],$email_data['message'],array(
					'student_name' => $this->session->userdata('first_name').' '.$this->session->userdata('middle_name').' '.$this->session->userdata('last_name'),
					'requirements' => $array_completefiles,
					'datetime' => date("Y-m-d H:i:s"),
					'gdrive_link' => "https://drive.google.com/drive/u/0/folders/".$result
				));
				$files = glob('express/assets/*'); // get all file names
				foreach($files as $file){
					if(in_array($file, $array_filestodelete)){
						if(is_file($file)) {
							unlink($file); // delete file
						}
					}
				}
				$this->mainmodel->updateAccountWithRefNo($ref_no,array('gdrive_id'=>$result));
				$this->session->set_flashdata('success','Successfully submitted!!');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				$files = glob('express/assets/*'); // get all file names
				foreach($files as $file){
					if(in_array($file, $array_filestodelete)){
						if(is_file($file)) {
							unlink($file); // delete file
						}
					}
				}
				$this->mainmodel->revertIfErrorInRequirementUpload();
				$this->session->set_flashdata('error','Gdrive Uploader is Offline');
				redirect($_SERVER['HTTP_REFERER']);
			}
			curl_close($ch);
			// echo json_encode(array("msg" => 'Successfully Uploaded'));
		}
		catch(\Exception $e){
			// echo $e;
			$this->session->set_flashdata('error',$e);
			redirect($_SERVER['HTTP_REFERER']);
			// echo json_encode(array("msg" => $e));
		}
		
	}
	public function notifyWhenPaymentSubmitted($ref_no = "",$amount = ""){
		$student_info = $this->mainmodel->getStudentAccountInfo($ref_no);
		$email_data = array(
			'send_to' => $this->session->userdata('first_name').' '.$this->session->userdata('last_name'),
			'reply_to' => 'jfabregas@sdca.edu.ph',
			'sender_name' => 'St. Dominic College of Asia',
			'send_to_email' => $this->session->userdata('email'),
			'title' => 'Proof of Payment',
			'message' => 'Email/PaymentEvidence'
		);
		$this->sdca_mailer->sendHtmlEmail($email_data['send_to'],$email_data['reply_to'],$email_data['sender_name'],$email_data['send_to_email'],$email_data['title'],$email_data['message'],array('student_info'=>$student_info,'total_amount'=>$amount));
		
	}
	public function checkForGdriveUploader(){
		echo $this->session->userdata('email');
		// $result = $this->gdrive_uploader->index();
		// print_r($result);
		// echo $result['status'];
	}
}
