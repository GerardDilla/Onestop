<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormsModel extends CI_Model
{
    public function digital_citizenship($array)
    {
        // optional: just to make sure that the field names are correct
        $data = array(
            'reference_number' => $array['reference_number'],
			'first_name' => $array['first_name'],
			'middle_name' => $array['middle_name'],
			'last_name' => $array['last_name'],
			// 'course' => $array['course'],
			// 'email' => $array['email'],
			// 'request' => $array['request'],
		);
        $this->db->insert('digital_citizenship', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
    public function digital_citizenship_account($array)
    {
        // optional: just to make sure that the field names are correct
        $data = array(
            'digital_id' => $array['digital_id'],
			'request' => $array['request'],
			'status' => $array['status'],
		);
        $this->db->insert('digital_citizenship_accounts', $data);
        $lastid = $this->db->insert_id();
    }
    // check if already in the database
    public function check_student_digital($reference_number)
    {
        $this->db->select('count(*) as count');
        $this->db->from('digital_citizenship');
        $this->db->where('Reference_Number',$reference_number);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function id_application($array)
    {
        // optional: just to make sure that the field names are correct
        $data = array(
            'reference_number' => $array['reference_number'],
			'first_name' => $array['first_name'],
			'middle_name' => $array['middle_name'],
			'last_name' => $array['last_name'],
			'status' => $array['status'],
		);
        $this->db->insert('id_application', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
    public function check_student_id($reference_number)
    {
        $this->db->select('count(*) as count');
        $this->db->from('id_application');
        $this->db->where('Reference_Number',$reference_number);
        $query = $this->db->get();
        return $query->row_array();
    }
    
}
