<?php


class AdminModel extends CI_Model
{
    public function login($credentials)
    {
        $password = $credentials['password'];
        // $this->db->select('User_ID');
        // $this->db->select('User_FullName');
        // $this->db->select('User_Position');
        // $this->db->select('UserName');
        $this->db->where('username',$credentials['username']);
        // $this->db->where('Password',$credentials['password']);
        // $this->db->where('AES_DECRYPT(`Password`, \''.$credentials['password'].'\') = \''.$credentials['password'].'\'');
        $this->db->where('password',$credentials['password']);
        $this->db->where('status',$credentials['status']);
        $this->db->from('ose_admin_user');
        $query = $this->db->get()->row_array();

        $this->db->reset_query();

        return $query;
    }
    public function getStudentInquiry()
    {
        $this->db->select('*');
        $this->db->from('student_inquiry');
        $this->db->join('Student_Info', 'student_inquiry.ref_no = Student_Info.Reference_Number');
        $this->db->where('user_type', 'student');
        $this->db->group_by('ref_no');
        return $this->db->get()->result_array();
    }
    public function countTotalUnseenMessage($ref_no)
    {
        $this->db->select('count(id) as total_unseen');
        $this->db->from('student_inquiry');
        $this->db->where('ref_no', $ref_no);
        $this->db->where('status <> ', 'seen');
        $this->db->where('user_type', 'student');
        $this->db->group_by('ref_no');
        $result = $this->db->get()->row_array();
        return empty($result['total_unseen']) ? 0 : $result['total_unseen'];
    }

    public function getDigitalCitizenship(){
        $this->db->select('*');
        $this->db->from('digital_citizenship dc');
        $this->db->join('Student_Info si','dc.reference_number = si.Reference_Number','LEFT');
        $this->db->where('dc.id >','0');
        $this->db->where('dc.reference_number >','0');
        return $this->db->get()->result_array();
    }
    public function getDigitalCitizenshipAccount($digital_id){
        $this->db->select('*');
        $this->db->from('digital_citizenship_accounts');
        $this->db->where('digital_id',$digital_id);
        $this->db->order_by('request','ASC');
        return $this->db->get()->result_array();
    }
    public function updateDigitalCitizenshipAccount($array)
    {
        $data = array(
            'status' => $array['status']
        );
        $this->db->where('id', $array['digital_id']);
        $this->db->update('digital_citizenship_accounts', $data);
    }
    public function getIdApplication(){
        $this->db->select('ia.*,
        si.*');
        $this->db->from('id_application ia');
        $this->db->join('Student_Info si','ia.reference_number = si.Reference_Number','LEFT');
        $this->db->where('ia.id >','0');
        $this->db->where('ia.reference_number >','0');
        return $this->db->get()->result_array();
    }
    public function updateIdApplication($array)
    {
        $data = array(
            'status' => $array['status']
        );
        $this->db->where('id', $array['id_application']);
        $this->db->update('id_application', $data);
        return $array['id_application'];
    }
    public function getSingleIdApplication($id){
        $this->db->select('*');
        $this->db->from('id_application ia');
        $this->db->join('Student_Info si','si.Reference_Number = ia.reference_number');
        $this->db->where('ia.id',$id);
        return $this->db->get()->row_array();
    }
}
