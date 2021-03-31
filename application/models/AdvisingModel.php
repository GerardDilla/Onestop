<?php


class AdvisingModel extends CI_Model
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
        $this->db->join('Sched AS B', 'A.Section_ID = B.Section_ID', 'left');
        $this->db->join('Sched_Display AS C', 'B.Sched_Code = C.Sched_Code', 'left');
        //$this->db->join('Legend AS D', 'B.SchoolYear = D.School_Year AND B.Semester = D.Semester', 'inner');
        $this->db->join('Subject AS E', 'E.Course_Code = B.Course_Code', 'left');
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

    public function insert_sched_session($array_data)
    {
        $this->db->insert('advising_session', $array_data);
        return $this->db->insert_id();
    }

    public function get_sched_info($schedCode)
    {
        $this->db->select('*, C.id AS sched_display_id, T1.Schedule_Time AS stime, T2.Schedule_Time AS etime');
        $this->db->from('Sections AS A');
        $this->db->join('Sched AS B', 'A.Section_ID = B.Section_ID', 'inner');
        $this->db->join('Sched_Display AS C', 'B.Sched_Code = C.Sched_Code', 'inner');
        //$this->db->join('Legend AS D', 'B.SchoolYear = D.School_Year AND B.Semester = D.Semester', 'inner');
        $this->db->join('`Subject` AS E', 'E.Course_Code = B.Course_Code', 'inner');
        $this->db->join('Room AS R', 'C.RoomID = R.ID', 'inner');
        $this->db->join('Time AS T1', 'C.Start_Time = T1.Time_From', 'inner');
        $this->db->join('Time AS T2', 'C.End_Time = T2.Time_To', 'inner');
        $this->db->join('Instructor AS I', 'I.ID = C.Instructor_ID', 'left');
        $this->db->where('B.Valid', 1);
        $this->db->where('C.Valid', 1);
        $this->db->where('B.Sched_Code', $schedCode);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_queued_subjects($reference_number)
    {

        $this->db->select('*, `ASess`.`ID` AS session_id');
        $this->db->from('advising_session AS ASess');
        $this->db->join('Sched AS S', 'S.`Sched_Code` = ASess.`Sched_Code`', 'inner');
        $this->db->join('Sched_Display AS SD', 'ASess.`Sched_Display_ID` = SD.`id`', 'inner');
        $this->db->join('`Subject` AS Subj', '`Subj`.`Course_Code` = S.`Course_Code`', 'inner');
        $this->db->join('`Sections` AS Sec', '`Sec`.`Section_ID` = S.`Section_ID`', 'inner');
        $this->db->join('Room AS R', 'R.`ID` = SD.`RoomID`', 'inner');
        $this->db->join('`Instructor` AS Ins', 'Ins.`ID` = SD.`Instructor_ID`', 'left');
        $this->db->where('ASess.`Reference_Number`', $reference_number);
        $this->db->where('ASess.`valid`', 1);
        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->result_array();
    }

    public function remove_advising_session($id)
    {
        $this->db->set('valid', 0);
        $this->db->where('ID', $id);
        $this->db->update('advising_session');
    }

    public function get_year_level($array_data)
    {
        $this->db->select('*');
        $this->db->from('Sections');
        $this->db->where('Section_ID', $array_data['section']);

        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_student_info_by_reference_no($reference_no)
    {
        $this->db->select('*, PM1.`Program_Major` AS 1st_major, PM2.`Program_Major` AS 2nd_major, PM3.`Program_Major` AS 3rd_major');
        $this->db->from('Student_Info AS SI');
        $this->db->join('`Program_Majors` AS PM1', 'PM1.`ID` = SI.`Course_Major_1st`');
        $this->db->join('Program_Majors AS PM2', 'PM2.`ID` = SI.`Course_Major_2nd`');
        $this->db->join('Program_Majors AS PM3', 'PM3.`ID` = SI.`Course_Major_3rd`');
        $this->db->where('Reference_Number', $reference_no);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_sched_session($array_data)
    {
        $this->db->select('*, `ASess`.`ID` AS session_id');
        $this->db->from('advising_session AS ASess');
        $this->db->join('Sched AS S', 'S.`Sched_Code` = ASess.`Sched_Code`', 'inner');
        $this->db->join('Sched_Display AS SD', 'ASess.`Sched_Display_ID` = SD.`id`', 'inner');
        $this->db->join('`Subject` AS Subj', '`Subj`.`Course_Code` = S.`Course_Code`', 'inner');
        $this->db->join('`Sections` AS Sec', '`Sec`.`Section_ID` = S.`Section_ID`', 'inner');
        $this->db->join('Room AS R', 'R.`ID` = SD.`RoomID`', 'inner');
        $this->db->join('`Instructor` AS Ins', 'Ins.`ID` = SD.`Instructor_ID`', 'left');
        $this->db->where('ASess.`Reference_Number`', $array_data['reference_no']);
        $this->db->where('ASess.`valid`', 1);
        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->result_array();
    }
}
