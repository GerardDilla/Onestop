<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainModel extends CI_Model
{
    public function checkLogin($username, $password)
    {
        $this->db->select('*');
        $this->db->from('student_account');
        $this->db->join('student_info', 'student_account.reference_no = student_info.Reference_Number', 'left');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('status', 'active');
        return $this->db->get()->row_array();
    }
    public function checkKey($key)
    {
        $this->db->select('*');
        $this->db->from('student_account');
        $this->db->join('student_info', 'student_account.reference_no = student_info.Reference_Number', 'left');
        $this->db->where('automated_code', $key);
        $this->db->where('automated_code !=', '');
        return $this->db->get()->row_array();
    }
    public function changeUserPass($key, $data)
    {
        $this->db->where('automated_code', $key);
        $this->db->update('student_account', $data);
    }
    public function changeKey($email, $data)
    {
        $this->db->where('email', $email);
        $this->db->update('student_account', $data);
    }
    public function changeKeyWithRefNo($ref_no, $data)
    {
        $this->db->where('reference_no', $ref_no);
        $this->db->update('student_account', $data);
    }
    public function checkEmail($email)
    {
        $this->db->select('student_account.*,student_info.First_Name,student_info.Last_Name');
        $this->db->from('student_account');
        $this->db->join('student_info', 'student_account.reference_no = student_info.Reference_Number');
        $this->db->where('student_info.Email', $email);
        return $this->db->get()->row_array();
    }
    public function getAllStudAccount()
    {
        $this->db->where('automated_code !=', '');
        return $this->db->get('student_account')->result_array();
    }
    public function checkOldPassword($reference_no, $old_password)
    {
        $this->db->where('reference_no', $reference_no);
        $this->db->where('password', $old_password);
        return $this->db->get('student_account')->row_array();
    }
    public function updateAccountWithRefNo($reference_no, $data)
    {
        $this->db->where('reference_no', $reference_no);
        $this->db->update('student_account', $data);
    }
    public function getRequirementsList()
    {
        return $this->db->get('requirements')->result_array();
    }
    public function getAllRequirementsLogByRef()
    {
        $ref_no = $this->session->userdata('reference_no');
        // $this->db->where('requirements_name', 'proof_of_payment');
        $this->db->where('reference_no', $ref_no);
        return $this->db->get('requirements_log')->result_array();
    }
    public function checkRequirement($requirements_name)
    {
        $ref_no = $this->session->userdata('reference_no');
        $this->db->where('requirements_name', $requirements_name);
        $this->db->where('reference_no', $ref_no);
        return $this->db->get('requirements_log')->row_array();
    }
    public function newRequirementLog($data)
    {
        $this->db->insert('requirements_log', $data);
        return $this->db->insert_id();
    }
    public function updateRequirementLog($data, $req)
    {
        $ref_no = $this->session->userdata('reference_no');
        $this->db->where('requirements_name', $req);
        $this->db->where('reference_no', $ref_no);
        $this->db->update('requirements_log', $data);
    }
    public function revertIfErrorInRequirementUpload()
    {
        $ref_no = $this->session->userdata('reference_no');
        $this->db->where('reference_no', $ref_no);
        $this->db->delete('requirements_log');
    }
    public function getStudentAccountInfo($ref_no)
    {
        $this->db->where('Reference_Number', $ref_no);
        return $this->db->get('student_info')->row_array();
    }
    public function getRequirementsLogPerRefNo()
    {
        $ref_no = $this->session->userdata('reference_no');
        $this->db->select('requirements_log.*,requirements.rq_name,requirements.id_name');
        $this->db->from('requirements_log');
        $this->db->join('requirements', 'requirements_log.requirements_name = requirements.id_name', 'left');
        $this->db->where('reference_no', $ref_no);
        return $this->db->get()->result_array();
    }
    public function checkStudentAccountForDuplication($col, $value)
    {
        $this->db->select('status');
        $this->db->where($col, $value);
        return $this->db->get('student_account')->row_array();
    }
    public function insertProofOfPayments($data)
    {
        $this->db->insert('proof_of_payment_info', $data);
    }
    public function getProofOfPaymentInfo($req_id)
    {
        $this->db->where('req_id', $req_id);
        return $this->db->get('proof_of_payment_info')->row_array();
    }
    public function Get_Info($refstu)
    {

        $this->db->select('*');
        $this->db->from('Student_Info as S');
        $this->db->join('4ps_inquiry_infoid as 4ps', 'S.Reference_Number = 4ps.Reference_Number', 'LEFT');
        $this->db->where('S.Student_Number', $refstu);
        $this->db->or_where('S.Reference_Number', $refstu);

        $query = $this->db->get();
        return $query;
    }

    public function getStudentInquiry(){
        $this->db->select('*');
        $this->db->from('student_inquiry');
        $this->db->join('student_info','student_inquiry.ref_no = student_info.Reference_Number');
        $this->db->where('user_type','student');
        $this->db->group_by('ref_no');
        return $this->db->get()->result_array();
    }
    public function countTotalUnseenMessage($ref_no){
        $this->db->select('count(id) as total_unseen');
        $this->db->from('student_inquiry');
        $this->db->where('ref_no',$ref_no);
        $this->db->where('status <> ','seen');
        $this->db->where('user_type','student');
        $this->db->group_by('ref_no');
        $result = $this->db->get()->row_array();
        return empty($result['total_unseen'])?0:$result['total_unseen'];
    }
}
