<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AssesmentModel extends CI_Model
{
    public function tracker_status($ref_no)
    {
        $this->db->select('*,
            si.Reference_Number AS Ref_Num_si,
            si.Student_Number AS Std_Num_si,
            si.Course,
            ftc.Reference_Number AS Ref_Num_ftc,
            fec.Reference_Number AS Ref_Num_fec,
        ');
        $this->db->from('Student_Info si');
        $this->db->join('Fees_Temp_College ftc', 'si.Reference_Number = ftc.Reference_Number', 'LEFT');
        $this->db->join('Fees_Enrolled_College fec', 'si.Reference_Number = fec.Reference_Number', 'LEFT');
        $this->db->where('si.Reference_Number', $ref_no);
        $query = $this->db->get();
        // die($query->row_array()['Ref_Num_si']);
        return $query->row_array();
    }
    public function get_overall_fees($student_number)
    {
        $this->db->select('
            (
                Initial_Payment +
                First_Payment +
                Second_Payment +
                Third_Payment +
                Fourth_Payment +
                Fifth_Payment +
                Sixth_Payment +
                Seventh_Payment
            ) AS Fees,
            schoolyear,
            Student_Number
        ');
        $this->db->from('Basiced_EnrolledFees');
        $this->db->where('Student_Number', $student_number);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_overall_payment($student_number)
    {
        $this->db->select('
            SUM(AmountofPayment) AS AmountofPayment,
            Student_Number,
            SchoolYear
        ');
        $this->db->from('Basiced_Payments_Throuhput');
        $this->db->where('Student_Number', $student_number);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_student_by_reference_number($reference_number)
    {
        $this->db->select('*');
        $this->db->from('Student_Info');
        $this->db->where('Reference_Number', $reference_number);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_course_program_code($program_code)
    {
        $this->db->select('*');
        $this->db->from('Programs');
        $this->db->where('Program_Code', $program_code);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_major_by_course($program_code)
    {
        $this->db->select('*');
        $this->db->from('Program_Majors');
        $this->db->where('Program_Code', $program_code);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function update_course_by_reference_number($array)
    {
        $data = array(
            'Course' => $array['course'],
            'Major' => $array['major'],
        );
        $this->db->where('Reference_Number', $array['reference_number']);
        $this->db->update('Student_Info', $data);
        return true;
    }
}
