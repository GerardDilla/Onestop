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
        $this->db->select('*, C.id AS sched_display_id, T1.Schedule_Time AS stime, T2.Schedule_Time AS etime, C.Start_Time AS SDstart, C.End_Time AS SDend');
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
    public function remove_all_advising_session($refnum)
    {
        $this->db->set('valid', 0);
        $this->db->where('Reference_Number', $refnum);
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

    public function check_if_foreigner($reference_no)
    {
        $this->db->trans_start();
        $this->db->select('Reference_Number');
        $this->db->from('Student_Info');
        $this->db->where('Reference_Number', $reference_no);
        $this->db->where('Nationality !=', 'FILIPINO');
        $this->db->trans_complete();

        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->num_rows();
    }

    public function check_international_program($program_code)
    {
        $this->db->select('*');
        $this->db->from('Programs');
        $this->db->where('Program_Code', $program_code);
        $this->db->where('international_program', 1);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_sched_advised($array_data)
    {
        $this->db->select('*');
        $this->db->from('Advising AS Adv');
        $this->db->join('Sched AS S', 'S.`Sched_Code` = Adv.`Sched_Code`', 'inner');
        $this->db->join('Sched_Display AS SD', 'Adv.`Sched_Display_ID` = SD.`id`', 'inner');
        $this->db->join('`Subject` AS Subj', '`Subj`.`Course_Code` = S.`Course_Code`', 'inner');
        $this->db->join('`Sections` AS Sec', '`Sec`.`Section_ID` = S.`Section_ID`', 'inner');
        $this->db->join('Room AS R', 'R.`ID` = SD.`RoomID`', 'inner');
        $this->db->join('`Instructor` AS Ins', 'Ins.`ID` = SD.`Instructor_ID`', 'left');
        $this->db->where('Adv.`Reference_Number`', $array_data['reference_no']);
        $this->db->where('Adv.`valid`', 1);
        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->result_array();
    }

    public function insert_sched_info($array_data)
    {
        #Copies Advising_Session data to Advising Table
        $reference_no = $array_data['reference_no'];
        $query = $this->db->query("
            INSERT INTO Advising (Reference_Number, Student_Number, Sched_Code, Sched_Display_ID, Semester, School_Year, `Status`, Program, Major, Year_Level, Section)
            SELECT Adv.`Reference_Number`, Adv.`Student_Number`, Adv.`Sched_Code`, Adv.`Sched_Display_ID`, Adv.`Semester`, Adv.School_Year, Adv.`Status`, 
            Adv.Program, Adv.Major, Adv.Year_Level, Sec.Section_Name 
            FROM `advising_session` AS Adv
            INNER JOIN Sections AS Sec ON Adv.Section = Sec.Section_ID
            WHERE Adv.`Reference_Number` = $reference_no
            AND Adv.`valid` = '1'
        ");
        $query_log = $this->db->last_query();
        return $query_log;
    }

    public function delete_advising_session($array_data)
    {
        $this->db->set('valid', 0);
        $this->db->where('Reference_Number', $array_data['reference_no']);
        $this->db->update('advising_session');

        $query_log = $this->db->last_query();
        // reset query
        $this->db->reset_query();

        return $query_log;
    }

    public function update_student_curriculum($array_data)
    {
        $this->db->set('Curriculum', $array_data['curriculum']);
        $this->db->where('Reference_Number', $array_data['reference_no']);
        $this->db->update('Student_Info');

        $query_log = $this->db->last_query();
        // reset query
        $this->db->reset_query();

        return $query_log;
    }

    public function remove_sched_info($array_data)
    {
        $this->db->set('valid', 0);
        $this->db->where('Reference_Number', $array_data['reference_no']);
        $this->db->where('Semester', $array_data['semester']);
        $this->db->where('School_Year', $array_data['school_year']);
        $this->db->update('Advising');

        $query_log = $this->db->last_query();
        // reset query
        $this->db->reset_query();

        return $query_log;
    }

    public function check_advised($array)
    {

        $this->db->where('Reference_Number', $array['Reference_Number']);
        //$this->db->where('School_Year', $array['School_Year']);
        //$this->db->where('Semester', $array['Semester']);
        $this->db->where('Dropped', 0);
        $this->db->where('Cancelled', 0);
        $this->db->where('valid', 1);
        $this->db->order_by('ID', 'DESC');
        /*
        $this->db->order_by('School_Year', 'DESC');
        $this->db->order_by('Semester', 'DESC');
        */
        $result = $this->db->get('Advising');
        $this->db->reset_query();
        return $result->result_array();
    }

    public function get_latest_section($refnumber)
    {

        #check latest enrolled section

    }
    public function get_course($refnum)
    {

        $this->db->select('p.Program_ID');
        $this->db->join('Programs as p', 's.Course = p.Program_Code');
        $this->db->where('Reference_Number', $refnum);
        $query = $this->db->get('Student_Info as s');
        if (!empty($query->result_array())) {
            return $query->result_array()[0]['Program_ID'];
        } else {
            return false;
        }
    }
    public function getfees_history($refnum)
    {
        $this->db->select('Reference_Number');
        $this->db->where('Reference_Number', $refnum);
        $query = $this->db->get('Fees_Enrolled_College');
        $count = $query->num_rows();
        if ($count > 0) {
            // Old Student
            return true;
        } else {
            // New Student
            return false;
        }
    }
    public function get_sections($program_id, $status)
    {

        $this->db->where('Program_ID', $program_id);
        if ($status == false) {
            $this->db->where('Year_Level', 1);
        }
        $this->db->where('Active', 1);
        $this->db->order_by('Year_Level', 'ASC');
        $query = $this->db->get('Sections');
        return $query->result_array();
    }
    public function getlegend()
    {

        $query = $this->db->get('Legend');
        return $query->row_array();
    }
    public function get_curriculum($param)
    {
        $this->db->where('Program_ID', $param['Program_ID']);
        $this->db->where('Curriculum_Year', $param['School_Year']);
        $this->db->where('Valid', 1);
        $query = $this->db->get('Curriculum_Info');
        return $query->row_array();
    }
    public function get_student_curriculum($refnum)
    {
        $this->db->select('Curriculum');
        $this->db->where('Reference_Number', $refnum);
        $query = $this->db->get('Student_Info');
        $result = $query->row_array();
        if (!empty($result)) {
            return $result['Curriculum'];
        } else {
            return false;
        }
    }
    public function convertTime($time)
    {
        $this->db->where('Time_From', $time);
        return $this->db->get('time')->row_array();
    }
    // For testing: remove on live
    public function insert_enrolled_subject_test($data)
    {


        $result = $this->db->query("
        
        INSERT INTO EnrolledStudent_Subjects (
            Reference_Number,
            Student_Number,
            Sched_Code,
            Semester,
            School_Year,
            Scheduler,
            Sdate,
            `Status`,
            Program,
            Major,
            Year_Level,
            Payment_Plan,
            Section
          )
          SELECT
            Reference_Number,
            Student_Number,
            Sched_Code,
            Semester,
            School_Year,
            Scheduler,
            Sdate,
            `Status`,
            Program,
            Major,
            Year_Level,
            Payment_Plan,
            Section
          FROM
            Advising
          WHERE Reference_Number = '" . $data['Reference_Number'] . "'
          AND School_Year = '" . $data['School_Year'] . "'
          AND Semester = '" . $data['Semester'] . "'
          AND valid = '1'

        ");
        return $result;
    }
    public function insert_fees_test($data)
    {

        $this->db->query("
        
        INSERT INTO fees_enrolled_college (
            Reference_Number,
            course,
            semester,
            schoolyear,
            YearLevel,
            Scholarship,
            discount,
            fullpayment,
            withdraw,
            withdrawalfee,
            pwithdrawalfee,
            tuition_Fee,
            InitialPayment,
            First_Pay,
            Second_Pay,
            Third_Pay,
            Fourth_Pay
          )
          SELECT
            Reference_Number,
            course,
            semester,
            schoolyear,
            YearLevel,
            Scholarship,
            discount,
            fullpayment,
            withdraw,
            withdrawalfee,
            pwithdrawalfee,
            tuition_Fee,
            InitialPayment,
            First_Pay,
            Second_Pay,
            Third_Pay,
            Fourth_Pay
          FROM
            fees_temp_college
          WHERE Reference_Number = '" . $data['Reference_Number'] . "'
          AND schoolyear = '" . $data['School_Year'] . "'
          AND semester = '" . $data['Semester'] . "'

        ");
        $this->db->reset_query();

        $this->db->select('id');
        $this->db->where('Reference_Number', $data['Reference_Number']);
        $this->db->where('schoolyear', $data['School_Year']);
        $this->db->where('semester', $data['Semester']);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $result = $this->db->get('fees_enrolled_college');
        $row = $result->row_array();
        $last_id = $row['id'];
        return $last_id;
    }
    public function insert_fees_items_test($id, $data)
    {
        $result = $this->db->query("
        

        INSERT INTO fees_enrolled_college_item (
            Fees_Enrolled_College_Id,
            Fees_Type,
            Fees_Name,
            Fees_Amount,
            Scholarship_Discount,
            valid
          )
          SELECT
            '" . $id . "',
            ftci.Fees_Type,
            ftci.Fees_Name,
            ftci.Fees_Amount,
            ftci.Scholarship_Discount,
            '1'
          FROM
            fees_temp_college_item AS ftci
            JOIN fees_temp_college AS ftc
            ON ftc.id = ftci.Fees_Temp_College_Id
          WHERE ftc.Reference_Number = '" . $data['Reference_Number'] . "'
          AND ftc.schoolyear = '" . $data['School_Year'] . "'
          AND ftc.semester = '" . $data['Semester'] . "'
        
        
        ");

        return $result;

        // INSERT INTO fees_enrolled_college_item (
        //     Fees_Enrolled_College_Id,
        //     Fees_Type,
        //     Fees_Name,
        //     Fees_Amount,
        //     Scholarship_Discount
        //   )
        //   SELECT
        //     Fees_Enrolled_College_Id,
        //     Fees_Type,
        //     Fees_Name,
        //     Fees_Amount,
        //     Scholarship_Discount
        //   FROM
        //     fees_temp_college_item
        //   WHERE Fees_Temp_College_Id = '" . $id . "'

        // ");



    }
    public function reset_progress($data)
    {

        #Remove Course
        $this->db->set('Course', 'N/A');
        $this->db->where('Reference_Number', $data['Reference_Number']);
        $this->db->update('Student_Info');
        $this->db->reset_query();

        #Remove Advising
        $this->db->set('valid', 0);
        $this->db->where('Reference_Number', $data['Reference_Number']);
        $this->db->where('School_Year', $data['School_Year']);
        $this->db->where('Semester', $data['Semester']);
        $this->db->update('Advising');
        $this->db->reset_query();

        #remove fees temp
        $this->db->set('Reference_Number', 0);
        $this->db->where('Reference_Number', $data['Reference_Number']);
        $this->db->where('schoolyear', $data['School_Year']);
        $this->db->where('semester', $data['Semester']);
        $this->db->update('fees_temp_college');
        $this->db->reset_query();

        #remove fees enrolled
        $this->db->set('Reference_Number', 0);
        $this->db->where('Reference_Number', $data['Reference_Number']);
        $this->db->where('schoolyear', $data['School_Year']);
        $this->db->where('semester', $data['Semester']);
        $this->db->update('fees_enrolled_college');
        $this->db->reset_query();

        #remove enrolled subjects
        $this->db->set('Reference_Number', 0);
        $this->db->where('Reference_Number', $data['Reference_Number']);
        $this->db->where('School_Year', $data['School_Year']);
        $this->db->where('Semester', $data['Semester']);
        $this->db->update('enrolledstudent_subjects');
        $this->db->reset_query();

        $this->db->set('interview_status', null);
        $this->db->where('reference_no', $data['Reference_Number']);
        $this->db->update('student_account');
        $this->db->reset_query();
    }
    public function check_existing_queue($data)
    {

        $this->db->select('Sched_Code');
        $this->db->where('Reference_Number', $data['Reference_Number']);
        $this->db->where('Sched_Code', $data['Sched_Code']);
        $this->db->where('valid', 1);
        $query = $this->db->get('advising_session');
        return $query->row_array();
    }
    public function count_subject_enrolled($data)
    {

        $query = $this->db->query("
        
            SELECT
            COUNT(Reference_Number) +
            (SELECT
            COUNT(Reference_Number)
            FROM
            EnrolledStudent_Subjects
            WHERE Sched_Code = '" . $data['Sched_Code'] . "'
            AND Dropped = 0
            AND Cancelled = 1) AS Occupants
            FROM
            Advising
            WHERE Sched_Code = '" . $data['Sched_Code'] . "'
            AND valid = 1

        ")->row_array();
        return $query['Occupants'];
    }
    public function check_advising_conflict($array_data)
    {
        #Parameters: Start time, End time, Days, Reference Number
        $day_array = explode(',', $array_data['day_array']);

        $where_check_time = '
        ((C.`Start_Time` BETWEEN "' . $array_data['end_time'] . '" AND "' . $array_data['start_time'] . '") 
        OR (C.`End_Time` BETWEEN "' . $array_data['end_time'] . '" AND "' . $array_data['start_time'] . '")
        OR ("' . $array_data['start_time'] . '" BETWEEN C.`Start_Time` AND C.`End_Time` AND "' . $array_data['end_time'] . '"  BETWEEN C.`Start_Time` AND C.`End_Time` )
        OR ("' . $array_data['start_time'] . '" >= C.`Start_Time` AND "' . $array_data['start_time'] . '" < C.`End_Time`)
        OR ("' . $array_data['end_time'] . '" > C.`Start_Time` AND "' . $array_data['end_time'] . '" <= C.`End_Time`)
        OR ("' . $array_data['start_time'] . '"  <= C.`Start_Time` AND "' . $array_data['end_time'] . '"  >= C.`End_Time`) )
        ';

        $this->db->select('*');
        $this->db->from('advising_session AS ASess');
        $this->db->join('Sched AS S', 'S.`Sched_Code` = ASess.`Sched_Code`', 'inner');
        $this->db->join('Sched_Display AS C', 'ASess.`Sched_Display_ID` = C.`id`', 'inner');
        //$this->db->join('Legend AS L', 'S.SchoolYear = L.School_Year AND S.Semester = L.Semester', 'inner');
        $this->db->where('ASess.School_Year', $array_data['school_year']);
        $this->db->where('ASess.Semester', $array_data['semester']);
        $this->db->where('ASess.`Reference_Number`', $array_data['reference_no']);
        $this->db->where('`ASess`.`valid`', 1);
        $this->db->where('C.RoomID !=', 93); //excempt room TBA

        $count = 0;
        $dayget = '';
        foreach ($day_array as $data) {
            if ($count == 0) {
                $dayget .= "`Day` LIKE '%$data%' ESCAPE '!'";
                $count++;
            } else {
                $dayget .= "OR `Day`LIKE '%$data%' ESCAPE '!'";
            }
        }
        $this->db->where('(' . $dayget . ')');

        $this->db->where($where_check_time);

        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->result_array();
    }
}
