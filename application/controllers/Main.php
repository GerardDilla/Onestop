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
			'email' => $data['email'],
			'student_folder' => $data['folder_name']
		));
	}
	public function email($cp,$from,$from_name,$send_to,$subject,$message){
		$config = Array(
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => '465',
				'smtp_timeout' => '7',
				'smtp_user' => 'webmailer@sdca.edu.ph',
				'smtp_pass' => 'sdca2017',
				'charset' => 'utf-8',
				'newline' => '\r\n',
				'mailtype'  => 'html',
				'validation' => true
				// 'wordwrap' => true
		);
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from($from, $from_name);
		$this->email->to($send_to);
		$this->email->subject($subject);
		$this->email->message($message);
		if($this->email->send()){
				echo  'Email has been sent to '.$cp;
				echo  '<br><br>';
		}else{
				echo  "<h4>There was a problem with sending an email.</h4>";
				echo  "<br><br>For any concers, proceed to our <a href'#' style'font-size:15px; color:#00F;'>Helpdesk</a> or the MIS Office.";        
		}
		//email debugger
			// echo $this->email->print_debugger(array('headers'));

	}
	public function emailHtmlType($cp,$from,$from_name,$send_to,$subject,$message,$add_data){
		$config = Array(
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => '465',
				'smtp_timeout' => '7',
				'smtp_user' => 'webmailer@sdca.edu.ph',
				'smtp_pass' => 'sdca2017',
				'charset' => 'utf-8',
				'newline' => '\r\n',
				'mailtype'  => 'html',
				'validation' => true
				// 'wordwrap' => true
		);
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from($from, $from_name);
		$this->email->to($send_to);
		$this->email->subject($subject);
		$this->email->message($this->load->view($message,$add_data,true));
		if($this->email->send()){
				echo  'Email has been sent to '.$cp;
				echo  '<br><br>';
		}else{
				echo  "<h4>There was a problem with sending an email.</h4>";
				echo  "<br><br>For any concers, proceed to our <a href'#' style'font-size:15px; color:#00F;'>Helpdesk</a> or the MIS Office.";        
		}
		//email debugger
			// echo $this->email->print_debugger(array('headers'));

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
				$this->mainmodel->changeKey($this->input->post('email'),array('automated_code' => $generate_code ));
				$encrypt_code = $this->encryption->encrypt($generate_code);

				// print_r($data);exit;

				$encrypt_code = $generate_code;
				// $this->sendemail->test();exit;
				// echo $data['First_Name'].' '.$data['Last_Name'];exit;
				$this->email($data['First_Name'].' '.$data['Last_Name'],'jfabregas@sdca.edu.ph','St. Dominic College of Asia',$this->input->post('email'),'Forgot Password','Click this link to reset your password. {unwrap}http://localhost/Onestop/main/changePassword/'.$encrypt_code.'{/unwrap}');
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
	public function validationDocumentsProcess(){
		$files = glob('express/assets/*'); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file)) {
				unlink($file); // delete file
			}
		}
		date_default_timezone_set('Asia/manila');
		$ref_no = $this->session->userdata('reference_no');
		$getRequirementsList = $this->mainmodel->getRequirementsList();
		// $config['upload_path'] = './assets/student/'.$this->session->userdata('student_folder').'/requirement';
		$config['upload_path'] = './express/assets/';
		$config['allowed_types'] = '*';
		$row = "";
		$array_files = array();
		try{
			$email_data = array(
				'send_to' => $this->session->userdata('first_name').' '.$this->session->userdata('last_name'),
				'reply_to' => 'jfabregas@sdca.edu.ph',
				'sender_name' => 'St. Dominic College of Asia',
				'send_to_email' => $this->session->userdata('email'),
				'title' => 'Forgot Password',
				'message' => 'Email/ValidationOfDocument'
			);
			
			foreach($getRequirementsList as $list){
				if($this->input->post('check_'.$list['id_name'])==null){
				// echo $this->input->post($list['id_name']).'<br>';
				$id_name = $list['id_name'];
				$config['file_name'] = $id_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->overwrite = true;
				if ($this->upload->do_upload($id_name))
				{
					$uploaded_data = $this->upload->data();
					array_push($array_files,array(
						"name" => $uploaded_data['orig_name'],
						"type" => $uploaded_data['file_type'],
						'rq_name' => $list['rq_name']
					));
					
					// print_r($this->upload->data());
					// echo '<pre>'.print_r($this->upload->data(),1).'</pre><br>';

					// array_push()
				}
				else{
					// echo json_encode(array("msg" => $this->upload->display_errors()));
					$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect(base_url('main/validationOfDocuments'));exit;
				}
				$checkRequirement = $this->mainmodel->checkRequirement($id_name);
				if(!empty($checkRequirement)){
					$row = $row."<tr><td>".$checkRequirement['requirements_name']."</td><td>".date("M. j,Y g:ia")."</td></tr>";
					$this->mainmodel->updateRequirementLog(array(
						'requirements_date' => date("Y-m-d H:i:s")
					));
				}
				else{
					$this->mainmodel->newRequirementLog(array(
						'requirements_name' => $id_name,
						'requirements_date' => date("Y-m-d H:i:s"),
						'status' => 'pending',
						'reference_no' => $ref_no
					));
				}


				// 
				}
			}
			$all_uploadeddata = array("folder_name"=>$ref_no,"data"=> $array_files);

			$string = http_build_query($all_uploadeddata);
			$ch = curl_init("http://localhost:4003/uploadtodrive/");
			curl_setopt($ch,CURLOPT_POST,true);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

			$result = curl_exec($ch);
			if($result=="success"){
				$this->emailHtmlType($email_data['send_to'],$email_data['reply_to'],$email_data['sender_name'],$email_data['send_to_email'],$email_data['title'],$email_data['message'],array(
					'student_name' => $this->session->userdata('first_name').' '.$this->session->userdata('middle_name').' '.$this->session->userdata('last_name'),
					'requirements' => $array_files,
					'datetime' => date("Y-m-d H:i:s")
				));
				$this->session->set_flashdata('success','Successfully submitted!!');
				redirect(base_url('main/validationOfDocuments'));
			}
			else{
				$this->session->set_flashdata('error','Gdrive Uploader is Offline');
				redirect(base_url('main/validationOfDocuments'));
			}
			curl_close($ch);
			// echo json_encode(array("msg" => 'Successfully Uploaded'));
		}
		catch(\Exception $e){
			// echo $e;
			$this->session->set_flashdata('error',$e);
			redirect(base_url('main/validationOfDocuments'));
			// echo json_encode(array("msg" => $e));
		}
		
	}
	public function createFolder(){
		$name = $this->input->get('name');
		// if(!mkdir('assets/student/'.$name,0777,true)){
		// 	echo 'failed';
		// }
		if (!is_dir('assets/student/'.$name)) {
			mkdir('assets/student/'.$name,0777,true);
			mkdir('assets/student/'.$name.'/requirement',0777,true);
		}
	}
	public function sampleSendMail(){
		$array_files = array(
			array(
			"name" => "image1.jpg",
			"type" => "image/jpg",
			"rq_name" => "Birth Certificate"
			),
			array(
			"name" => "image2.jpg",
			"type" => "image/jpg",
			"rq_name" => "Good Moral"
			),
			array(
			"name" => "image3.jpg",
			"type" => "image/jpg",
			"rq_name" => "Form 137"
			));
		$email_data = array(
			'send_to' => $this->session->userdata('first_name').' '.$this->session->userdata('last_name'),
			'reply_to' => 'jfabregas@sdca.edu.ph',
			'sender_name' => 'St. Dominic College of Asia',
			'send_to_email' => $this->session->userdata('email'),
			'title' => 'Forgot Password',
			'message' => 'Email/ValidationOfDocument'
		);
		// $this->emailHtmlType($email_data['send_to'],$email_data['reply_to'],$email_data['sender_name'],$email_data['send_to_email'],$email_data['title'],$email_data['message'],array(
		// 	'student_name' => $this->session->userdata('first_name').' '.$this->session->userdata('middle_name').''.$this->session->userdata('last_name'),
		// 	'requirements' => $array_files,
		// 	'datetime' => date("Y-m-d H:i:s"))
		// );
		echo '<pre>'.print_r(array(
			'student_name' => $this->session->userdata('first_name').' '.$this->session->userdata('middle_name').' '.$this->session->userdata('last_name'),
			'requirements' => $array_files,
			'datetime' => date("Y-m-d H:i:s")
		),1).'</pre>';
		// $this->load->view('Email/ValidationOfDocument',array(
				
	}
	public function sampleMail(){
		$this->sendmail->index();
	}
}
