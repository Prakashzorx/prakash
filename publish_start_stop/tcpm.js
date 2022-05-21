const net = require("net")
var mysql = require('mysql');
const express = require('express');
const app = express();
var bodyParser = require('body-parser');
var cors = require('cors');
var hexToBinary = require('hex-to-binary');
const date = require('date-and-time');
const { toASCII } = require("punycode");
const nodemailer = require('nodemailer');







var conn = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "Mukunda@123",
    database: "mk_db"
});
var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "Mukunda@123",
    database: "test"
});
// var val= connection();
// console.log(val);
conn.connect(function (err) {
    if (err) {
        // device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
        throw err;
    }

    var offset = new Date().getTime();
    var time = offset + 19800000 - 600000;
    //var time = offset - 600000;
    var timestamp = new Date(time);
    //console.log(offset);
    //var datetime = '2022-05-05 15:05:05';//date.format(timestamp, 'YYYY-MM-DD HH:mm:ss');
    var datetime = date.format(timestamp, 'YYYY-MM-DD HH:mm:ss');
    //console.log(datetime);
    //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
    var sql = "SELECT DISTINCT(`tcp_register`.`imei`) FROM `tcp_assign_machine` JOIN `tcp_register` ON `tcp_assign_machine`.`tcp_machineid`=`tcp_register`.`id` JOIN `store` ON `tcp_assign_machine`.`tcp_store`=`store`.`id` JOIN `brand_tbl` ON `brand_tbl`.`id`=`tcp_assign_machine`.`tcp_brand` JOIN `users` ON `users`.`user_id`=`tcp_assign_machine`.`tcp_pri_user` JOIN `countries` ON `countries`.`id`=`store`.`country` JOIN `states` ON `states`.`id`=`store`.`state` JOIN `cities` ON `cities`.`id`=`store`.`city` WHERE `tcp_assign_machine`.`status`='1'";
    conn.query(sql, async function (err, result) {
        // console.log(sql);
        if (err) {
            //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
            throw err;
        }

        //console.log(result[0]);
        if (result) {

            result.forEach(myFunction);
            function myFunction(item, index) {
                //console.log(item);
                var sql1 = `SELECT * FROM \`tcpdata\` where startbits='TZ' AND 'sts'=0 AND \`imei\` LIKE '${item.imei}' AND \`rct_timestamp\` > '${datetime}' ORDER BY \`id\` DESC LIMIT 1`;
                con.query(sql1, async function (err, result1) {
                    //console.log(sql1);
                    if (err) {
                        //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
                        throw err;
                    }

                    //console.log(result1[0]);
                    var res = result1[0];
                    //var imei=result1[0].imei;
                    // console.log(res.rct_timestamp);
                    if (res) {
                        if (res['alarm_type'] == 'a0') {//a0----------------56
                           // console.log(res.temp);
                            var temperature=res.temp;
                            //var temperature=-20.0002;
                            var temp=parseFloat(temperature).toFixed(1); 
                           // console.log(temp);
                            //console.log(res['rct_timestamp']);
                            var datetime2 = date.format(res['rct_timestamp'], 'YYYY-MM-DD hh:mm A');
                           // console.log(datetime2);
                            var sql2 = `SELECT \`tcp_assign_machine\`.\`id\`,\`tcp_assign_machine\`.\`tcp_machineid\` as \`machine_id\`,\`tcp_assign_machine\`.\`tcp_brand\` as \`brand_id\`,\`tcp_assign_machine\`.\`tcp_store\` as \`store_id\`,\`tcp_assign_machine\`.\`tcp_pri_user\` as \`user_id\`,\`tcp_register\`.\`imei\` as \`machine\`,\`tcp_register\`.\`tcp_machine_type\` as \`ptype\`,\`brand_tbl\`.\`brand_name\`,\`store\`.\`store_name\`,\`store\`.\`pincode\`,\`countries\`.\`name\` as \`country\`,\`states\`.\`name\` as \`state\`,\`cities\`.\`name\`as \`city\`,\`countries\`.\`id\` as \`countryid\`,\`states\`.\`id\` as \`stateid\`,\`cities\`.\`id\`as \`cityid\`,\`users\`.\`name\` as \`username\`,\`users\`.\`email\` as \`email\`, \`users\`.\`phone\` as \`phone\`,\`tcp_register\`.\`tcp_machine_type\` AS \`ptype\` FROM \`tcp_assign_machine\` JOIN \`tcp_register\` ON \`tcp_assign_machine\`.\`tcp_machineid\`=\`tcp_register\`.\`id\` JOIN \`store\` ON \`tcp_assign_machine\`.\`tcp_store\`=\`store\`.\`id\` JOIN \`brand_tbl\` ON \`brand_tbl\`.\`id\`=\`tcp_assign_machine\`.\`tcp_brand\` JOIN \`users\` ON \`users\`.\`user_id\`=\`tcp_assign_machine\`.\`tcp_pri_user\` JOIN \`countries\` ON \`countries\`.\`id\`=\`store\`.\`country\` JOIN \`states\` ON \`states\`.\`id\`=\`store\`.\`state\` JOIN \`cities\` ON \`cities\`.\`id\`=\`store\`.\`city\`  WHERE \`tcp_assign_machine\`.\`status\`='1' AND \`tcp_register\`.\`imei\`='${item.imei}'`;
                            conn.query(sql2, async function (err, result2) {
                                //console.log(sql2);
                                if (err) {
                                    //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
                                    throw err;
                                }

                                //console.log(result2);
                                // var res=result1[0];
                                // if (res['alarm_type']=='a0') {
                                // }
                                if (result2) {
                                    result2.forEach(myFunction);
                                    function myFunction(item1, index) {
                                        var emailuser = item1.email;
                                        //console.log(emailuser);
                                        var html = '<!doctype html><html lang="en-US">';

                                        html += '<head>';
                                        html += '<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />';
                                        html += '<title>Warning</title>';
                                        html += '<meta name="description" content="">';
                                        html += ' </head>';
                                        html += ' <style>';
                                        html += '      a:hover {text-decoration: underline !important;}';
                                        html += ' </style>';

                                        html += '  <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">';
                                        html += ' <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"';
                                        html += '  style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: ' + 'Open Sans' + ', sans-serif;">';
                                        html += '  <tr>';
                                        html += '       <td>';
                                        html += '          <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0"';
                                        html += '               align="center" cellpadding="0" cellspacing="0">';
                                        html += '              <tr>';
                                        html += '                   <td style="height:80px;">&nbsp;</td>';
                                        html += '               </tr>';

                                        html += '       <tr>';
                                        html += '                    <td style="text-align:center;">';
                                        html += ' <a href="https://mykitchenos.com" title="logo" target="_blank">';
                                        html += '                         <img width="60" src="http://www.mykitchenos.com/publish_start_stop/mfpllogo.png" title="logo" alt="logo">';
                                        html += '             </a>';
                                        html += '           </td>';
                                        html += '       </tr>';
                                        html += '       <tr>';
                                        html += '           <td style="height:20px;">&nbsp;</td>';
                                        html += '       </tr>';

                                        html += '       <tr>';
                                        html += '           <td>';
                                        html += '               <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"';
                                        html += '                   style="max-width:670px; background:#fff; border-radius:3px;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);padding:0 40px;">';
                                        html += '                   <tr>';
                                        html += '                       <td style="height:40px;">&nbsp;</td>';
                                        html += '                   </tr>';
                                        html += '                  ';
                                        html += '                   <tr>';
                                        html += '                       <td style="padding:0 15px; text-align:center;">';
                                        html += '                           <h1 style="color:#1e1e2d; font-weight:400; margin:0;font-size:32px;font-family:' + 'Rubik' + ',sans-serif;">Temperature Over Threshold Warning Reminder</h1>';
                                        html += '                  <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; ';
                                        html += '                  width:100px;"></span>';
                                        html += '              </td>';
                                        html += '          </tr>';

                                        html += '          <tr>';
                                        html += '              <td>';
                                        html += '                  <table cellpadding="0" cellspacing="0"';
                                        html += '                      style="width: 100%; border: 1px solid #ededed">';
                                        html += '                      <tbody>';
                                        html += '                          <tr>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        html += '                                  IMEI:</td>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        html += item.imei+'</td>';
                                        html += '                          </tr>';
                                        html += '                          <tr>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        html += '                                  Brand:</td>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        html +=     item1.brand_name+'</td>';


                                        html += '                          </tr>';
                                        html += '                          <tr>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        html += '                                 Type of alarm </td>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        html +=  'Temperature Over Threshold</td>';
                                        html += '                          </tr>';
                                        html += '                          <tr>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        html += '                                 Temperature </td>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        html +=    temp+'</td>';
                                        html += '                          </tr>';
                                            
                                        html += '                          <tr>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        html += '                                  Store Name:</td>';
                                        html += '                                    <td';
                                        html += '                                        style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        html +=    item1.store_name +'</td>';
                                        html += '                                </tr>';
                                        html += '                          <tr>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        html += '                                 Country </td>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        html +=    item1.country+'</td>';
                                        html += '                          </tr>';
                                        html += '                          <tr>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        html += '                                 State </td>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        html +=    item1.state+'</td>';
                                        html += '                          </tr>';
                                        html += '                          <tr>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        html += '                                 City </td>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        html +=    item1.city+'</td>';
                                        html += '                          </tr>';
                                        html += '                          <tr>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        html += '                                 User Name </td>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        html +=    item1.username+'</td>';
                                        html += '                          </tr>';
                                        html += '                          <tr>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        html += '                                 Timestamp </td>';
                                        html += '                              <td';
                                        html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        html +=    datetime2+'</td>';
                                        html += '                          </tr>';
                                        // html += '                          <tr>';
                                        // html += '                              <td';
                                        // html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                                        // html += '                                  Machine type</td>';
                                        // html += '                              <td';
                                        // html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                                        // html +=    item1.ptype +'</td>';
                                        // html += '                          </tr>';

                                 
                                      
                                        html += '                   </tbody>';
                                        html += '               </table>';
                                        html += '           </td>';
                                        html += '       </tr>';
                                        html += '                     <tr>';
                                        html += '                         <td style="height:40px;">&nbsp;</td>';
                                        html += '                     </tr>';
                                        html += '                 </table>';
                                        html += '             </td>';
                                        html += '         </tr>';
                                        html += '         <tr>';
                                        html += '             <td style="height:20px;">&nbsp;</td>';
                                        html += '         </tr>';
                                        html += '         <tr>';
                                        html += '             <td style="text-align:center;">';
                                        html += '             <p style="font-size:14px; color:#455056bd;">Contact System Administrator</p><p style="font-size:14px; color:#455056bd;">Mukunda Foods Pvt. Ltd.</p><p style="font-size:14px; color:#455056bd;">naveen@mukundafoods.com</p>';
                                        html += '             </td>';
                                        html += '         </tr>';
                                        // html += '         <tr>';
                                        // html += '             <td style="text-align:center;">';
                                        // html += '             <p style="font-size:14px; color:#455056bd;">Mukunda Foods Pvt. Ltd.</p>';
                                        // html += '             </td>';
                                        // html += '         </tr>';
                                        // html += '         <tr>';
                                        // html += '             <td style="text-align:center;">';
                                        // html += '             <p style="font-size:14px; color:#455056bd;">naveen@mukundafoods.com</p>';
                                        // html += '             </td>';

                                        // html += '         </tr>';
                                        html += '         <tr>';
                                        html += '             <td style="text-align:center;">';
                                        html += '                     <p style="font-size:14px; color:#455056bd; line-height:18px; margin:0 0 0;">&copy; <strong>www.mukundafoods.com</strong></p>';
                                        html += '             </td>';
                                        html += '         </tr>';
                                        html += '     </table>';
                                        html += '        </td>';
                                        html += '      </tr>';
                                        html += '  </table></body></html>';
                                        let mailTransporter = nodemailer.createTransport({
                                            service: 'gmail',
                                            auth: {
                                                user: 'mykitchenos.mukundafoods@gmail.com',
                                                pass: 'Prataps@4891'
                                            }
                                        });
                                        let mailDetails = {
                                            from: 'mykitchenos.mukundafoods@gmail.com',
                                            //to: 'bapukhatavi@gmail.com',
                                            to: emailuser,
                                            //to: 'bapukhatavi@gmail.com,naveen@mukundafoods.com,rakesh@mukundafoods.com',//'+email+'',
                                            subject: 'Temperature Over Threshold',
                                            html: html
                                           // html: `<center><h1 style="color:red">Alert!!!</h1></center><br><br><br><h1 style="color:red">Temperature Over Threshold Warning.</h1><br><h3>Machine Details</h3><h3>IMEI :${item.imei}</h3><br><h3>Brand :${item1.brand_name}</h3><br><h4>At the time :${res.rct_timestamp}</h3><br><br><h3>User :${item1.username}</h3><br><h3>Store :${item1.store_name}</h3><br><h3>Machine type :${item1.ptype}</h3><br><h3>Store :${item1.store_name}</h3><br><h3>Country :${item1.country}</h3><br><h3>State :${item1.state}</h3><br><h3>city :${item1.city}</h3><br><h3>Temperature :${res.temp}</h3><br><h3>Type Of alarm : Temperature over threshold</h3><h2>Contact System Administrator</h2><br><br><br><h5>Regards,</h5><p>Mukunda Foods Pvt. Ltd.</p><p>naveen@mukundafoods.com</p>`
                                        };
                                        mailTransporter.sendMail(mailDetails, function (err, data) {
                                            if (err) {
                                                // console.log(err);
                                            } else {
                                                response = 'mail sent';
                                                res.end(response);
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    }
                });
            }


        }
    });

    //con.end();
})


// //DB connection and insert data
// var con = mysql.createConnection({
//     host: "localhost",
//     user: "root",
//     password: "Mukunda@123",
//     database: "test"
// });
// //  function connection(){
// con.connect(function (err) {
//     if (err) {
//         // device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
//         throw err;
//     }
//     // console.log("Connected!");
//     //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
//     var sql = "SELECT * FROM `tcpdata` WHERE `sts`=0 LIMIT 1";
//     con.query(sql, async function (err, result) {
//         //console.log(sql);
//         if (err) {
//             //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
//             throw err;
//         }
//         //var x=await insertquery(result);
//         //console.log(x);
//         if (result) {

//             result.forEach(myFunction);

//             //var i = 0;
//             // var text='';

//             function myFunction(item, index) {
//                 //text += index + ": " + item ;
//                 if (index < 1) {

//                    //  console.log(item);
//                     if (item.alarm_type == 'a0') {

//                         //console.log('a0');
//                         //console.log(item.rct_timestamp);
//                         var rctdate = item.rct_timestamp;
//                         // console.log(rctdate);
//                         var datet = date.format(rctdate, 'YYYY-MM-DD');
//                         //  console.log(datet);
//                         var timed = date.format(rctdate, 'HH:mm:ss');
//                         // console.log(timed);

//                         var offset = rctdate.getTime();
//                         var time = offset + 19800000;
//                         var timestamp = new Date(time);
//                         //console.log(timestamp);
//                         var sql1 = "SELECT * FROM `temp_threshold_log_daily` WHERE `imei` LIKE '" + item.imei + "' AND `date` LIKE '%" + datet + "%' AND `alarm_type` LIKE 'a0' AND `sts`=0 ORDER BY `id` DESC LIMIT 1;";
//                         // console.log(sql1);
//                         // console.log(date);console.log(time);
//                         con.query(sql1, async function (err, result1) {

//                             if (err) {
//                                 //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
//                                 throw err;
//                             }
//                             //console.log(result[0].id);
//                             var res = result1[0];
//                             // console.log(result1.length);
//                             if (result1.length == 0) {


//                                 var sql2 = "INSERT INTO `temp_threshold_log_daily`(`imei`, `date`,`time`,`alarm_type`,`sts`) VALUES ?";

//                                 var values = [
//                                     [item.imei, datet, timed, item.alarm_type, 0],
//                                 ];
//                                 con.query(sql2, [values], async function (err, result2) {
//                                     // console.log(sql);
//                                     if (err) {
//                                         //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
//                                         throw err;
//                                     }
//                                     //   console.log('Email sent successfully');
//                                     let mailTransporter = nodemailer.createTransport({
//                                         service: 'gmail',
//                                         auth: {
//                                             user: 'mykitchenos.mukundafoods@gmail.com',
//                                             pass: 'Prataps@4891'
//                                         }
//                                     });
//                                     let mailDetails = {
//                                         from: 'mykitchenos.mukundafoods@gmail.com',
//                                         //  to: 'naveen@mukundafoods.com,rakesh@mukundafoods.com',
//                                         to: 'bapukhatavi@gmail.com',
//                                         subject: 'Temerature Over Threshold Warning',
//                                         html: '<center><h1 style="color:red">Alert!!!</h1></center><br><br><br><h1 style="color:red">Temperature Over Threshold Warning.</h1><br><h3>Machine Details</h3><h4>IMEI :' + item.imei + '</h3><br><h4>At the time :' + timestamp + '</h3><br><br><h2>Contact System Administrator</h2><br><br><br><h5>Regards,</h5><p>Mukunda Foods Pvt. Ltd.</p><p>naveen@mukundafoods.com</p>'
//                                     };
//                                     mailTransporter.sendMail(mailDetails, function (err, data) {
//                                         if (err) {
//                                             // console.log(err);
//                                         } else {
//                                              //console.log('Email sent successfully');
//                                         }
//                                     });
//                                 });
//                             } else {
//                                 //console.log(res.id);
//                                 var hms = res.time; // your input string
//                                 var a = hms.split(':'); // split it at the colons


//                                 // minutes are worth 60 seconds. Hours are worth 60 minutes.
//                                 var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);
//                                 //  console.log(res.time);
//                                 //  console.log(seconds);
//                                 var b = timed.split(':'); // split it at the colons


//                                 // minutes are worth 60 seconds. Hours are worth 60 minutes.
//                                 var seconds2 = (+b[0]) * 60 * 60 + (+b[1]) * 60 + (+b[2]);
//                                 // console.log(timed);
//                                 // console.log(seconds2);
//                                 var remain = seconds2 - seconds;
//                                 // console.log(remain);
//                                 var sts = res.sts + 1;
//                                 //  console.log(sts);
//                                 if (remain > 1800) {
//                                     // console.log('above half an hour');
//                                     var sql3 = "UPDATE `temp_threshold_log_daily` SET `date`='" + datet + "',`time`='" + timed + "',`sts`=" + sts + " WHERE `id`=" + res.id + ";";


//                                     con.query(sql3, async function (err, result3) {
//                                         // console.log(sql);
//                                         if (err) {
//                                             //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
//                                             throw err;
//                                         }
//                                         let mailTransporter = nodemailer.createTransport({
//                                             service: 'gmail',
//                                             auth: {
//                                                 user: 'mykitchenos.mukundafoods@gmail.com',
//                                                 pass: 'Prataps@4891'
//                                             }
//                                         });
//                                         let mailDetails = {
//                                             from: 'mykitchenos.mukundafoods@gmail.com',
//                                             //  to: 'naveen@mukundafoods.com,rakesh@mukundafoods.com',
//                                             to: 'bapukhatavi@gmail.com',
//                                             subject: 'Temerature Over Threshold Warning',
//                                             html: '<center><h1 style="color:red">Alert!!!</h1></center><br><br><br><h1 style="color:red">Temperature Over Threshold Warning.</h1><br><h3>Machine Details</h3><h4>IMEI :' + item.imei + '</h3><br><h4>At the time :' + timestamp + '</h3><br><br><h2>Contact System Administrator</h2><br><br><br><h5>Regards,</h5><p>Mukunda Foods Pvt. Ltd.</p><p>naveen@mukundafoods.com</p>'
//                                         };
//                                         mailTransporter.sendMail(mailDetails, function (err, data) {
//                                             if (err) {
//                                                 // console.log(err);
//                                             } else {
//                                                  //console.log('Email sent successfully');
//                                             }
//                                         });
//                                     });
//                                 } else {
//                                     //console.log('belove half an hour');
//                                 }

//                             }
//                         });


//                     }
//                     // console.log(item.id);
//                     var sql = "UPDATE `tcpdata` SET `sts`=1 WHERE `id`=" + item.id + ";";

//                     con.query(sql, async function (err, result) {
//                             //console.log(sql);
//                         if (err) throw err;
//                         // console.log(result.affectedRows + " record(s) updated");
//                         // let mailTransporter = nodemailer.createTransport({
//                         //     service: 'gmail',
//                         //     auth: {
//                         //         user: 'mykitchenos.mukundafoods@gmail.com',
//                         //         pass: 'Prataps@4891'
//                         //     }
//                         // });

//                         // let mailDetails = {
//                         //     from: 'mykitchenos.mukundafoods@gmail.com',
//                         //     to: 'bapukhatavi@gmail.com',
//                         //     subject: 'Test mail',
//                         //     text: 'Node.js testing mail for GeeksforGeeks'
//                         // };

//                         // mailTransporter.sendMail(mailDetails, function(err, data) {
//                         //     if(err) {
//                         //         console.log(err);
//                         //     } else {
//                         //         console.log('Email sent successfully');
//                         //     }
//                         // });
//                     });
//                     // con.end();
//                 }
//                 //  i++;
//                 // console.log(item);
//             }
//             // console.log("1 record inserted");

//             // var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')"";
//             // var values = [


//             // ];
//             // con.query(sql, [values], function (err, result) {
//             //     // console.log(sql);
//             //     if (err) {
//             //         //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
//             //         throw err;
//             //     }
//             //     if (result) {
//             //         console.log("1 record inserted");
//             //     }
//             //     //console.log("1 record inserted");
//             // });
//         }
//     });

//     //con.end();
// })
