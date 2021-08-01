// import mysql from 'mysql'
const mysql = require('mysql')
// var pool = mysql.createPool({
//     connectionLimit: 10,
//     host: '10.0.0.9',
//     user: 'schoolsysdb',
//     password: 'Wpd2$Ya=$dCA<KXM25>',
//     database: 'schoolsysdb'
// })
var pool = mysql.createPool({
    connectionLimit: 10,
    host: 'localhost',
    user: 'root',
    password: 'asdf',
    database: 'schoolsysdb'
})

pool.getConnection((err, connection) => {
    if (err) {
        if (err.code === 'PROTOCOL_CONNECTION_LOST') {
            console.error('Database connection was closed.')
        }
        if (err.code === 'ER_CON_COUNT_ERROR') {
            console.error('Database has too many connections.')
        }
        if (err.code === 'ECONNREFUSED') {
            console.error('Database connection was refused.')
        }
    }
    if (connection) connection.release()
    return
})

module.exports = pool

