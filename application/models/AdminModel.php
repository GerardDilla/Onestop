<?php


class AdminModel extends CI_Model
{
    public function login($credentials)
    {
        $password = $credentials['password'];
        $this->db->select('User_ID');
        $this->db->select('User_FullName');
        $this->db->select('User_Position');
        $this->db->select('UserName');
        $this->db->where('UserName',$credentials['username']);
        // $this->db->where('Password',$credentials['password']);
        $this->db->where('AES_DECRYPT(`Password`, \''.$credentials['password'].'\') = \''.$credentials['password'].'\'');
        $this->db->where('tabValid',1);
        $this->db->from('Users');
        $query = $this->db->get()->row_array();

        $this->db->reset_query();

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
