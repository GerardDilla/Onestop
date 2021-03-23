<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
	public function index()
	{
		//$this->load->view('Body/index');
		// $this->default_template($this->view_directory->assessment());
		// echo 'hello';
		$this->login_template($this->view_directory->login());
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
		if($this->email->send()){
				echo  'Email has been sent to '.$cp;
				echo  '<br><br>';
		}else{
				echo  "<h4>There was a problem with sending an email.</h4>";
				echo  "<br><br>For any concers, proceed to our <a href'#' style'font-size:15px; color:#00F;'>Helpdesk</a> or the MIS Office.";        
		}
		//email debugger
			echo $this->email->print_debugger(array('headers'));

	}
	public function loginProcess(){
		try{
			$username = $this->input->post('loginUsername');
			$password = $this->input->post('loginPassword');
			$data = $this->mainmodel->checkLogin($username,$password);
			if(!empty($data)){
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
	public function changePassword(){
		$this->login_template($this->view_directory->changePassword());
	}
	public function changeUserPass($key = ''){
		if(!empty($key)){
			$this->data['key'] = $key;
			$key = $this->encryption->decrypt($key);
			$data = $this->mainmodel->checkKey($key);
			if(!empty($data)){
				$this->login_template($this->view_directory->changeUserPass());
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
	public function sendEmail(){
		try{
			$data = $this->mainmodel->checkEmail($this->input->get('email'));
			if(!empty($data)){
				$this->email("Jhon Norman Fabregas",'jfabregas@sdca.edu.ph','St. Dominic College of Asia','jhonnormanfabregas@gmail.com','Forgot Password','Click this link to reset your password. {unwrap}http://example.com/a_long_link_that_should_not_be_wrapped.html{/unwrap}');
				// echo array('type'=>'success','msg' => "We've sent a confirmation link on your email. Click the link to reset your password.");
				$this->session->set_flashdata('success',"We've sent a confirmation link on your email. Click the link to reset your password.");
				redirect(base_url('main/forgotPassword'));
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
	public function changeUserPassProcess(){
		try{
			$key = $this->input->post('JoduXy33bU2EUwRsdjR0uhodvplaX54c5mVbGBNBYRU=');
			$key = $this->encryption->decrypt($key);
			$this->mainmodel->changeUserPass($key,array(
				'username' => $this->input->post('username') ,
				'password' => $this->input->post('new_password'),
				'automated_code' => ''
			));
			$this->session->set_flashdata('success',$e);
			redirect(base_url('/'));
		}
		catch(\Exception $e){
			$this->session->set_flashdata('msg',$e);
			redirect(base_url('/'));
			// <>
		}
	}
	public function selfassesment(){
		$this->data['student_information'] = 'Body/Assessment_Content/Student_Information';
		$this->data['advising'] = 'Body/Assessment_Content/Advising';
		$this->data['payment'] = 'Body/Assessment_Content/Payment';
		$this->default_template($this->view_directory->assessment());
	}
	public function passwordReset(){
		$this->default_template($this->view_directory->passwordReset());
	}
	public function logout(){
		redirect(base_url('/'));
	}
}
