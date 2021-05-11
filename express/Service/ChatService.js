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
    })
  }

  async create(data) {
    console.log()
    const this_time = moment().format('YYYY-MM-DD kk:mm:ss')
    let getdata = getQuery(`INSERT INTO student_inquiry(ref_no,message,date_created) VALUES(${data.ref_no},'${data.message}','${this_time}')`)
    getdata.then((result)=>{
      return result
    })
    // console.log('insert')
    // getdata;
    return {
      message:data.message,
      ref_no:data.ref_no,
      date_created:this_time
    }
  }
}
module.exports = ChatService