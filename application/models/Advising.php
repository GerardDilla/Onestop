<?php


class Advising extends CI_Model
{

    public function block_schedule($array_data)
    {
        #Parameters: school_year, semester, section

        $this->db->select('
        B.Sched_Code,
        E.Course_Code,
        E.Course_Title,
        A.Section_Name,
        E.Course_Lec_Unit,
        E.Course_Lab_Unit,
        C.Day,
        C.Start_Time,
        C.End_Time,
        R.`Room`,
        I.Instructor_Name,
        C.id AS sched_display_id
        ');
        $this->db->from('Sections AS A');
        $this->db->join('Sched AS B', 'A.Section_ID = B.Section_ID', 'inner');
        $this->db->join('Sched_Display AS C', 'B.Sched_Code = C.Sched_Code', 'inner');
        //$this->db->join('Legend AS D', 'B.SchoolYear = D.School_Year AND B.Semester = D.Semester', 'inner');
        $this->db->join('`Subject` AS E', 'E.Course_Code = B.Course_Code', 'inner');
        $this->db->join('Room AS R', 'C.RoomID = R.ID', 'inner');
        $this->db->join('Instructor AS I', 'I.ID = C.Instructor_ID', 'left');
        $this->db->where('A.Active', 1);
        $this->db->where('A.Section_ID !=', 829);
        $this->db->where('B.Valid', 1);
        $this->db->where('C.Valid', 1);

        $this->db->where('B.SchoolYear', $array_data['school_year']);
        $this->db->where('B.Semester', $array_data['semester']);

        $this->db->where('B.Section_ID', $array_data['section']);
        $this->db->order_by('B.`Sched_Code`', 'ASC');

        $query = $this->db->get();
        // reset query
        $this->db->reset_query();

        return $query->result_array();
    }
}
