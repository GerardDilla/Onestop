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
        var current_message_count = getQuery(`SELECT Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number  WHERE user_type = "student" GROUP BY student_inquiry.ref_no ORDER BY Student_Info.First_Name ASC`)
        return current_message_count.then((result)=>{ return result}).catch(error=> console.log(error));
    }
    async MessageCountPerRefNo(data){
        var current_message_count = getQuery(`SELECT Student_Info.YearLevel,Student_Info.Course,Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number  WHERE user_type = "student" AND ref_no = "${data.ref_no}" GROUP BY student_inquiry.ref_no ORDER BY Student_Info.First_Name ASC`)
        return current_message_count.then((result)=>{ return result}).catch(error=> console.log(error)); 
    }
    async insertFromChatInquiry(data){
        const this_time = moment().format('YYYY-MM-DD kk:mm:ss')
        let getdata = getQuery(`INSERT INTO student_inquiry(ref_no,message,date_created,user_type) VALUES(${data.ref_no},'${data.message}','${this_time}','${data.type}')`)
        return getdata.then((result)=>{
        return result
        }).catch(error=>{ console.log(error)});
    }
}

module.exports = ChatModel