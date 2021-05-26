<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AssesmentModel extends CI_Model
{
    public function tracker_status($ref_no, $sy, $sem)
    {
        $this->db->select('*,
            si.Reference_Number AS Ref_Num_si,
            si.Student_Number AS Std_Num_si,
            si.Course,
            ftc.Reference_Number AS Ref_Num_ftc,
            fec.Reference_Number AS Ref_Num_fec,
        ');
        $this->db->from('Student_Info si');
        $this->db->join('Fees_Temp_College ftc', 'si.Reference_Number = ftc.Reference_Number and ftc.schoolyear = "' . $sy . '" and ftc.semester = "' . $sem . '"', 'LEFT');
        $this->db->join('Fees_Enrolled_College fec', 'si.Reference_Number = fec.Reference_Number and fec.schoolyear = "' . $sy . '" and fec.semester = "' . $sem . '"', 'LEFT');
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

    public function get_student_with_course($reference_number)
    {
        $this->db->select('*');
        $this->db->from('Student_Info si');
        $this->db->where('Reference_Number', $reference_number);
        $this->db->join('Programs p', 'si.Course = p.Program_Code', 'LEFT');
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
    public function get_major_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('Program_Majors');
        $this->db->where('ID', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function update_course_by_reference_number($array_update)
    {
        $data = array(
            'Course' => $array_update['course'],
            'Major' => $array_update['major'],
        );
        $this->db->where('Reference_Number', $array_update['reference_number']);
        $this->db->update('Student_Info', $data);
        return true;
    }

    function insert_shs_student_number($array_insert)
    {
        $data = array(
            'highered_reference_number' => $array_insert['highered_reference_number'],
            'shs_student_number' => $array_insert['shs_student_number'],
            'applied_status' => $array_insert['applied_status'],
            'created_at' => $array_insert['created_at'],
        );
        $this->db->insert('senior_high_student_number', $data);
    }

    public function get_shs_student_number_by_reference_number($reference_number)
    {
        $this->db->select('*');
        $this->db->from('senior_high_student_number');
        $this->db->where('highered_reference_number', $reference_number);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_all_programs()
    {
        $this->db->select('*');
        $this->db->from('Programs');
        $this->db->order_by('Program_Code', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_student_account_by_reference_number($reference_number)
    {
        $this->db->select('*');
        $this->db->from('student_account');
        $this->db->where('reference_no', $reference_number);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_interview_status($array_update)
    {
        $data = array(
            'interview_status' => $array_update['interview'],
        );
        $this->db->where('reference_no', $array_update['reference_number']);
        $this->db->update('student_account', $data);
        return true;
    }
}
