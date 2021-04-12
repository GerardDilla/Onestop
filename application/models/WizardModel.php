<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WizardModel extends CI_Model
{
    public function tracker_status(){
        $this->db->select('*,
            si.Reference_Number as Ref_Num_si,
            si.Student_Number as Std_Num_si,
            ftc.Reference_Number as Ref_Num_ftc,
            fec.Reference_Number as Ref_Num_fec,
        ');
        $this->db->from('Student_Info si');
        $this->db->join('Fees_Temp_College ftc', 'si.Reference_Number = ftc.Reference_Number', 'LEFT');
        $this->db->join('Fees_Enrolled_College fec', 'si.Reference_Number = fec.Reference_Number', 'LEFT');
        $this->db->where('si.Reference_Number', '26066');
        $query = $this->db->get();
        // die($query->row_array()['Ref_Num_si']);
        return $query->row_array();
    }
}
