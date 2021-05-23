<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require 'vendor/autoload.php';

class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->studentdata = array();
	}

	public function index()
	{   
        // if(empty(session("admin_id"))){
        //     $this->login_template($this->view_directory->admin_login());
		//     $this->appkey = 'testkey101';
        // }else{
        //     redirect(base_url('main/sdcainquiry'));
        // }
        $this->login_template($this->view_directory->admin_login());
        $this->appkey = 'testkey101';
	}
    public function loginProcess(){
        try {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$data = $this->adminmodel->login(array('username'=>$username,'password'=>$password));
			if(!empty($data)){
                $this->session->set_userdata("admin_id",$data['User_ID']);
				$this->session->set_flashdata('success', $data['User_FullName']);
				redirect(base_url('admin/sdcainquiry'));
			} else {
				$this->session->set_flashdata('msg', 'Incorrect username or password!!');
				redirect($_SERVER['HTTP_REFERER']);
			}
		} catch (\Exception $e) {
			$this->session->set_flashdata('msg', $e);
			redirect($_SERVER['HTTP_REFERER']);
		}
    }
    public function sdcaInquiry()
	{
		$getStudentInquiry = $this->adminmodel->getStudentInquiry();
		$count = 0;
		foreach ($getStudentInquiry as $inquiry) {
			$getStudentInquiry[$count]['total_message'] = $this->adminmodel->countTotalUnseenMessage($inquiry['ref_no']);
			++$count;
		}
		$this->data['getStudentInquiry'] = $getStudentInquiry;
		$this->chat_template($this->view_directory->chatAdmin());
	}
    public function logout(){
        $this->session->set_userdata("admin_id");
        redirect(base_url('admin/'));
    }
	public function getFilter(){
		if(filter_var('jfabregas@sdca.edu.ph',FILTER_VALIDATE_EMAIL) == true){
			echo "totoo";
		}
		else{
			echo "di totoo";
		}
	}
    // public function loginProc
}