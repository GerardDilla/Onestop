const {getQuery} = require('../Query/main');
const moment = require("moment");
class ChatModel {
    constructor(){

    }
    async getChat(){
        let getdata = getQuery(`SELECT * FROM student_inquiry WHERE ref_no='${data.ref_no}' ORDER BY id ASC`)
        return getdata.then((result)=>{
        return result;
        }).catch(error=>{ return {error:error}});
    }
    async getTotalMessageCount(){
        var current_message_count = getQuery(`SELECT student_inquiry.date_created,Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number  WHERE user_type = "student" GROUP BY student_inquiry.ref_no ORDER BY Student_Info.First_Name ASC`)
        return current_message_count.then((result)=>{ return result}).catch(error=> console.log(error));
    }
    async MessageCountPerRefNo(data){
        const today = moment().format('YYYY-MM-DD')
        // var current_message_count = getQuery(`SELECT Student_Info.YearLevel,Student_Info.Course,Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message,CONCAT(Student_Info.First_Name, ' ',Student_Info.Middle_Name,' ', Student_Info.Last_Name) as Full_Name FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number  WHERE user_type = "student" AND date_created LIKE '${today}%' GROUP BY student_inquiry.ref_no ORDER BY Student_Info.First_Name ASC`)
        var current_message_count = getQuery(`SELECT student_inquiry.date_created,Student_Info.YearLevel,Student_Info.Course,Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message,CONCAT(Student_Info.First_Name, ' ',Student_Info.Middle_Name,' ', Student_Info.Last_Name) as Full_Name FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number  WHERE user_type = "student" AND date_created LIKE '${data.search_date}%' GROUP BY student_inquiry.ref_no ORDER BY Student_Info.First_Name ASC`)
        return current_message_count.then((result)=>{ return result}).catch(error=> console.log(error)); 
    }
    async MessageCountPerRefNoWithoutSearch(data){
        const today = moment().format('YYYY-MM-DD')
        // var current_message_count = getQuery(`SELECT Student_Info.YearLevel,Student_Info.Course,Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message,CONCAT(Student_Info.First_Name, ' ',Student_Info.Middle_Name,' ', Student_Info.Last_Name) as Full_Name FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number  WHERE user_type = "student" AND date_created LIKE '${today}%' GROUP BY student_inquiry.ref_no ORDER BY Student_Info.First_Name ASC`)
        var current_message_count = getQuery(`SELECT student_inquiry.date_created,Student_Info.YearLevel,Student_Info.Course,Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message,CONCAT(Student_Info.First_Name, ' ',Student_Info.Middle_Name,' ', Student_Info.Last_Name) as Full_Name FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number  WHERE user_type = "student" GROUP BY student_inquiry.ref_no ORDER BY Student_Info.First_Name ASC`)
        return current_message_count.then((result)=>{ return result}).catch(error=> console.log(error)); 
    }
    async TotalMessageCountPerRefNo(data){
        const today = moment().format('YYYY-MM-DD')
        var current_message_count = getQuery(`SELECT student_inquiry.date_created,Student_Info.YearLevel,Student_Info.Course,Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message,CONCAT(Student_Info.First_Name, ' ',Student_Info.Middle_Name,' ', Student_Info.Last_Name) as Full_Name FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number  WHERE user_type = "student" GROUP BY student_inquiry.ref_no ORDER BY Student_Info.First_Name ASC`)
        return current_message_count.then((result)=>{ return result}).catch(error=> console.log(error)); 
    }
    async insertFromChatInquiry(data){
        const this_time = moment().format('YYYY-MM-DD kk:mm:ss')
        let getdata = getQuery(`INSERT INTO student_inquiry(ref_no,message,date_created,user_type,admin_id) VALUES(${data.ref_no},'${data.message}','${this_time}','${data.type}','${data.admin_id}')`)
        return getdata.then((result)=>{
        return result
        }).catch(error=>{ console.log(error)});
    }
    async getMessageNotifications(){
        let getdata = getQuery("SELECT * FROM student_inquiry WHERE `status`='not seen' AND `user_type` = 'student' GROUP BY ref_no ORDER BY date_created DESC LIMIT 5")
        return getdata.then((result)=>{
        return result
        }).catch(error=>{ console.log(error)});
    }
    async getMessageNotifications(){
        const today = moment().format('YYYY-MM-DD')
        let getdata = getQuery("SELECT student_inquiry.*,CONCAT(si.First_Name,' ',si.Middle_Name,' ',si.Last_Name) AS full_name FROM student_inquiry INNER JOIN Student_Info AS si ON student_inquiry.ref_no = si.Reference_Number WHERE `status`='not seen' AND `user_type` = 'student' AND date_created LIKE '"+today+"%' GROUP BY ref_no ORDER BY date_created DESC LIMIT 5")
        return getdata.then((result)=>{
        return result
        }).catch(error=>{ console.log(error)});
    }
    async getLastMessage(data){
        let getdata = getQuery(`SELECT * FROM student_inquiry WHERE ref_no = '${data.ref_no}' ORDER BY id ASC LIMIT 1`)
        return getdata.then((result)=>{
        return result
        }).catch(error=>{ console.log(error)});
    }
}

module.exports = ChatModel