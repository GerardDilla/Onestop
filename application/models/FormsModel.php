<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormsModel extends CI_Model
{
    public function digital_citizenship($array)
    {
        // optional: just to make sure that the field names are correct
        $data = array(
			'first_name' => $array['first_name'],
			'middle_name' => $array['middle_name'],
			'last_name' => $array['last_name'],
			'course' => $array['course'],
			'email' => $array['email'],
			'request' => $array['request'],
		);
        $this->db->insert('digital_citizenship', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
    
}
