const {getQuery} = require('../Query/main');
const moment = require("moment");

class ChatModel {
    constructor(){

    }
    async getChat(){
        let getdata = getQuery(`SELECT * FROM student_inquiry WHERE ref_no='${data.ref_no}' ORDER BY id ASC`)
        return getdata.then((result)=>{
        return result;
        }).catch(error=>console.log(error));
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
        const today = moment().format('YYYY-MM-DD kk:mm:ss');
        const getdata = getQuery(`INSERT INTO student_inquiry(ref_no,message,date_created,user_type,admin_id) VALUES('${data.ref_no}','${data.message}','${today}','${data.type}','${data.admin_id==""?0:data.admin_id}')`)
        
        return getdata.then((result)=>{
        return result
        }).catch(error=>{ console.log(error)});
    }
    // async getMessageNotifications(){
    //     let getdata = getQuery("SELECT * FROM student_inquiry WHERE `status`='not seen' AND `user_type` = 'student' GROUP BY ref_no ORDER BY date_created DESC LIMIT 5")
    //     return getdata.then((result)=>{
    //     return result
    //     }).catch(error=>{ console.log(error)});
    // }
    async getMessageNotifications(){
        const today = moment().format('YYYY-MM-DD')
        let getdata = getQuery("SELECT COUNT(id) as total_unseen,MAX(date_created) as last_notification_date,student_inquiry.*,CONCAT(si.First_Name,' ',si.Middle_Name,' ',si.Last_Name) AS full_name FROM student_inquiry INNER JOIN Student_Info AS si ON student_inquiry.ref_no = si.Reference_Number WHERE `status`='not seen' AND `user_type` = 'student' AND date_created LIKE '"+today+"%' GROUP BY ref_no ORDER BY date_created DESC LIMIT 5")
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

    async getTotalUnseenMessages(data){
        let getdata = getQuery(`SELECT *,COUNT(id) as total_unseen FROM student_inquiry WHERE ref_no = '${data.ref_no}' AND user_type="student" AND status = "not seen" GROUP BY ref_no`)
        return getdata.then((result)=>{
        return result
        }).catch(error=>{ console.log(error)});
    }

    async getMessageWithFilterDate(data){
        let getdata = getQuery(`SELECT COUNT(student_inquiry.id) as total_unseen,MAX(date_created) AS last_date,student_inquiry.date_created,Student_Info.YearLevel,Student_Info.Course,Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message,CONCAT(Student_Info.First_Name, ' ',Student_Info.Middle_Name,' ', Student_Info.Last_Name) as Full_Name FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number WHERE date_created BETWEEN CAST('${data.search_from}' AS DATE) AND CAST('${data.search_to}' AS DATE) AND user_type="student" GROUP BY ref_no ORDER BY date_created ASC`)
        return getdata.then((result)=>{
            return result
        }).catch(error=>{ console.log(error)});
    }
}

module.exports = ChatModel