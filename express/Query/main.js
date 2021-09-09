const database = require('../Config/database');
const database2 = require('../Config/database2');
async function getQuery(query){
    const data_wait = await new Promise(function(resolve,reject){
        database.query(query, function (err, result, fields) {
            // if (err) throw new Error(reject(err))
            if(err){
                reject(err)
            }
            else{
                resolve(result)
            }
            
        })
    }).then( function(result){
        return result
    }).catch(function(error){
        return error
    })
    return data_wait
}
async function getQuery2(query){
    const data_wait = await new Promise(function(resolve,reject){
        database2.query(query, function (err, result, fields) {
            // if (err) throw new Error(reject(err))
            if(err){
                reject(err)
            }
            else{
                resolve(result)
            }
            
        })
    }).then( function(result){
        return result
    }).catch(function(error){
        return error
    })
    return data_wait
}
module.exports = {getQuery,getQuery2}