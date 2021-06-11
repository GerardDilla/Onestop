const express = require("express");
let router = express.Router();

router.get("/",(req,res)=>{
    const Meeting = require('google-meet-api').meet;
    Meeting({
        clientId : '624327898367-pvbv4n24nsthvspo5bs8rru6j17tfqtj.apps.googleusercontent.com',
        clientSecret : 'Tpsqnl7vdYxejH1tsVa2qN31',
        refreshToken : '1//043RMZa7pmG-8CgYIARAAGAQSNgF-L9Ir1J8Kx0jiUbTXxX9vAKIK89S5_Sadd-6qfXNpOtg4AZmxgq2Ge1UJDUDUJ1ydMLyDig',
        date : "2021-06-10",
        time : "10:59",
        summary : 'Meeting',
        location : 'with',
        description : 'description'
        }).then(function(result){
        console.log(result);//result it the final link
    })
});

module.exports = router;