const { getQuery, getQuery2 } = require('../Query/main');
const moment = require('moment');
class ChatService {
  constructor() {
    this.ideas = [];
    this.messages = [];
  }

  async find() {
    // console.log(data)
    let getdata = getQuery(`SELECT Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number  WHERE 1 GROUP BY student_inquiry.ref_no ORDER BY Student_Info.First_Name ASC`)
    return getdata.then((result) => {
      // console.log(result);
      return result
    }).catch(error => { return { error: error } });
  }
  async get(data) {
    // console.log(data)
    let getdata = getQuery(`SELECT * FROM student_inquiry WHERE ref_no='${data.ref_no}' ORDER BY id ASC`)
    return getdata.then((result) => {
      return result;
    }).catch(error => { return { error: error } });
  }
  async update(id, data) {
    // console.log(data);
    let getdata = getQuery(`UPDATE student_inquiry SET status = 'seen' WHERE ref_no = '${id}' AND user_type <> '${data.type}'`)
    getdata.then((result) => {
      return result
    }).catch(error => { return { error: error } });
    return {
      ref_no: id,
      type: data.type
    }
  }
  async create(data) {
    // console.log()
    const this_time = moment().format('YYYY-MM-DD kk:mm:ss')
    let getdata = getQuery(`INSERT INTO student_inquiry(ref_no,message,date_created,user_type) VALUES(${data.ref_no},'${data.message}','${this_time}','${data.type}')`)
    getdata.then((result) => {
      return result
    }).catch(error => { return { error: error } });
    // console.log('insert')
    // getdata;
    var current_message_count = getQuery(`SELECT Student_Info.First_Name,Student_Info.Middle_Name,Student_Info.Last_Name,Student_Info.Reference_Number as ref_no,COUNT(student_inquiry.id) as total_message FROM student_inquiry INNER JOIN Student_Info ON student_inquiry.ref_no = Student_Info.Reference_Number  WHERE user_type = "student" GROUP BY student_inquiry.ref_no ORDER BY Student_Info.First_Name ASC`)

    var getCurrent = async function () {
      var newval = new Promise((resolve, reject) => {
        current_message_count.then((result) => {
          resolve({
            message: data.message,
            ref_no: data.ref_no,
            date_created: this_time,
            user_type: data.type,
            return_id: data.return_id,
            message_count: result
          })
        }).catch(error => { console.log(error) })
      })
      return newval
    };

    return getCurrent().then(response => { console.log(response); return response; })

  }
}
module.exports = ChatService