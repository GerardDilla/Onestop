const {getQuery,getQuery2} = require('../query/main');
const moment = require('moment');
class ChatService {
  constructor() {
    this.ideas = [];
  }

  async find() {
    let getdata = getQuery('SELECT * FROM student_inquiry WHERE 1 ORDER BY id ASC')
    return getdata.then((result)=>{
      return result
    }).catch(error=>{ return {error:error}});
  }

  async create(data) {
    // console.log()
    const this_time = moment().format('YYYY-MM-DD kk:mm:ss')
    let getdata = getQuery(`INSERT INTO student_inquiry(ref_no,message,date_created,user_type) VALUES(${data.ref_no},'${data.message}','${this_time}','${data.type}')`)
    getdata.then((result)=>{
      return result
    }).catch(error=>{ return {error:error}});
    // console.log('insert')
    // getdata;
    return {
      message:data.message,
      ref_no:data.ref_no,
      date_created:this_time,
      user_type:data.type
    }
  }
}
module.exports = ChatService