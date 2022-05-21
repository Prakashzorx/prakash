const net = require("net")
var mysql = require('mysql');
const express = require('express');
const app = express();
var bodyParser = require('body-parser');
var cors = require('cors');
var hexToBinary = require('hex-to-binary');
const date22 = require('date-and-time');
const { toASCII } = require("punycode");
const { exit } = require("process");
const dayjs = require('dayjs');
 


var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "Mukunda@123",
    database: "test"
});

con.connect(function (err) {
    if (err) {
        // device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
        throw err;
    }

    var sql = "SELECT `id`,`rct` FROM tcpdata";

    con.query(sql, function (err, result) {
        //console.log(result);
        if (err) {

            throw err;
        }
        result.forEach(myFunction);





    });
    //con.end();

    function myFunction(item, index) {
        //text += index + ": " + item + "<br>"; 
      //console.log(item.id + ' ' + item.rct + ' ' + index);
        var now     = new Date();   
        var nyear    = now.getFullYear();
        var nmonth   = now.getMonth()+1; 
        var ndate     = now.getDate();
        var nhour    = now.getHours();
        var nminute  = now.getMinutes();
        var nsecond  = now.getSeconds(); 


        var rct = item.rct;
        var year1 = rct.substring(0, 2);

        var year = '20'+parseInt(year1, 16).toString(10);
        //console.log(year);
        // if(year>nyear){
        //     year=1000;
        // }
        var month1 = rct.substring(2, 4);
        var month = parseInt(month1, 16).toString(10);
        // if(month>nmonth){
        //     month=00;
        // }
        var date1 = rct.substring(4, 6);
        var date = parseInt(date1, 16).toString(10);
        // if(date>ndate){
        //     date=00;
        // }
        var hour1 = rct.substring(6, 8);
        var hour = parseInt(hour1, 16).toString(10);
        // if(hour>12){
        //     hour=00;
        // }
        var minute1 = rct.substring(8, 10);
        var minute = parseInt(minute1, 16).toString(10);
        // if(minute>59){
        //     minute=00;
        // }
        var second1 = rct.substring(10, 12);
        var second = parseInt(second1, 16).toString(10);
        // if(second>59){
        //     second=00;
        // }
        if(year>nyear||year<2022){  
            year=1111;month=11;date=11;hour=11;minute=11;second=11;
        }
        var full_rct = year + '/' + month + '/' + date + ' ' + hour + ':' + minute + ':' + second;
        var offset = new Date(full_rct).getTime();
        var time = offset + 19800000;
        var timestamp = new Date(time);
        //console.log(timestamp);
       
        var datetime = date22.format(timestamp, 'YYYY-MM-DD HH:mm:ss');
       // console.log(datetime);
        var sql1 = "UPDATE `tcpdata` SET `rct_timestamp`='" + datetime + "' WHERE `id`='" + item.id + "'";
        // var values1 = [
        //     [full_rct], [item.id],

        // ];
        con.query(sql1, function (err, result) {
           // console.log(sql1);
            if (err) {
                //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
                throw err;
            }

            //console.log("1 record inserted");
        });

    }
    //con.end();
})