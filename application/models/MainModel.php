<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MainModel extends CI_Model {
    public function checkLogin($username,$password){
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $this->db->where('status','active');
       return $this->db->get('student_account')->row_array();
    }
    public function checkKey($key){
        $this->db->where('automated_code',$key);
        $this->db->where('automated_code !=','');
        return $this->db->get('student_account')->row_array();
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
        $this->db->where('email',$email);
        return $this->db->get('student_account')->row_array();
    }
    public function getAllStudAccount(){
        $this->db->where('automated_code !=','');
        return $this->db->get('student_account')->result_array();
    }
}