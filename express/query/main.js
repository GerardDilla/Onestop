// database connection
var database = require('../config/database.js');


async function getQuery(query){
    const data_wait = await new Promise(function(resolve,reject){
        database.query(query, function (err, result, fields) {
            if (err) throw new Error(reject(err))
            resolve(result)
        })
    }).then( function(result){
        return result
    })
    return data_wait
}
// async function getQuery2(query){
//     const data_wait = await new Promise(function(resolve,reject){
//         database2.query(query, function (err, result, fields) {
//             if (err) throw new Error(reject(err))
//             resolve(result)
//         })
//     }).then( function(result){
//         return result
//     })
//     return data_wait
// }
module.exports = {getQuery}