<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MainModel extends CI_Model {
    public function checkLogin($username,$password){
        $this->db->select('*');
        $this->db->from('student_account');
        $this->db->join('student_info','student_account.reference_no = student_info.Reference_Number','left');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $this->db->where('status','active');
       return $this->db->get()->row_array();
    }
    public function checkKey($key){
        $this->db->select('*');
        $this->db->from('student_account');
        $this->db->join('student_info','student_account.reference_no = student_info.Reference_Number','left');
        $this->db->where('automated_code',$key);
        $this->db->where('automated_code !=','');
        return $this->db->get()->row_array();
    }
    public function changeUserPass($key,$data){
        $this->db->where('automated_code',$key);
        $this->db->update('student_account', $data);
    }
    public function changeKey($email,$data){
        $this->db->where('email',$email);
        $this->db->update('student_account', $data);
    }
    public function checkEmail($email){
        $this->db->select('student_account.*,student_info.First_Name,student_info.Last_Name');
        $this->db->from('student_account');
        $this->db->join('student_info','student_account.reference_no = student_info.Reference_Number');
        $this->db->where('student_account.email',$email);
        return $this->db->get()->row_array();
    }
    public function getAllStudAccount(){
        $this->db->where('automated_code !=','');
        return $this->db->get('student_account')->result_array();
    }
    public function checkOldPassword($reference_no,$old_password){
        $this->db->where('reference_no',$reference_no);
        $this->db->where('password',$old_password);
        return $this->db->get('student_account')->row_array();
    }
    public function updateAccountWithRefNo($reference_no,$data){
        $this->db->where('reference_no',$reference_no);
        $this->db->update('student_account', $data);
    }
    public function getRequirementsList(){
        return $this->db->get('requirements')->result_array(); 
    }
    public function checkRequirement($requirements_name){
        $ref_no = $this->session->userdata('reference_no');
        $this->db->where('requirements_name',$requirements_name);
        $this->db->where('reference_no',$ref_no);
        return $this->db->get('requirements_log')->row_array(); 
    }
    public function newRequirementLog($data){
        $this->db->insert('requirements_log', $data);
    }
    public function updateRequirementLog($data){
        $ref_no = $this->session->userdata('reference_no');
        $this->db->where('reference_no',$ref_no);
        $this->db->update('requirements_log', $data);
    }
}