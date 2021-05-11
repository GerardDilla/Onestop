const {getQuery,getQuery2} = require('../query/main');
const moment = require('moment');
class IdeaService {
  constructor() {
    this.ideas = [];
  }

  async find() {
    let getdata = getQuery2('SELECT *,name_text as text,time_created as time FROM livestream WHERE 1 ORDER BY id ASC')
    return getdata.then((result)=>{
      return result
    })
  }

  async create(data) {
    console.log()
    const this_time = moment().format('h:mm:ss a');
    let getdata = getQuery2(`INSERT INTO livestream(name_text,tech,viewer,time_created) VALUES('${data.text}','${data.tech}','${data.viewer}','${this_time}')`)
    getdata.then((result)=>{
      return result
    })
    console.log('insert')
    // getdata;
    return {
      text:data.text,
      tech:data.tech,
      viewer:data.viewer,
      time:this_time
    }
  }
}
module.exports = IdeaService