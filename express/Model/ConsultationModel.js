const {getQuery,getQuery2} = require('../Query/main');
const moment = require("moment");

class ConsultationModel {
    constructor(){

    }
    async insertData(table_name,data){
        const today = moment().format('YYYY-MM-DD kk:mm:ss');
        // const getdata = getQuery(`INSERT INTO student_inquiry(ref_no,message,date_created,user_type,admin_id) VALUES('${data.ref_no}','${data.message}','${today}','${data.type}','${data.admin_id==""?0:data.admin_id}')`)
        var arrayKeys = Object.keys(data);
        var arrayValues = Object.values(data);
        arrayKeys = arrayKeys.join();
        arrayValues = '"' + arrayValues.join('","')+'"';
        const getdata = getQuery2(`INSERT INTO ${table_name}(${arrayKeys}) VALUES(${arrayValues})`)
        return getdata.then((result)=>{
        return result
        }).catch(error=>{ console.log(error)});
    }
    async getAllLiveChatMessage(data){
        let getdata = getQuery2(`SELECT * FROM live_chat WHERE session_id = '${data.chat_id}' ORDER BY id ASC`)
        return getdata.then((result)=>{
        return result;
        }).catch(error=>console.log(error));
    }
}

module.exports = ConsultationModel