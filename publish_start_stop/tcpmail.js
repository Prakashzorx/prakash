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
    //var datetime = '2022-05-18 15:45:05';//date.format(timestamp, 'YYYY-MM-DD HH:mm:ss'); 
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
                            //console.log(res.temp);
                            var temperature = res.temp;
                            //var temperature=-20.0002;
                            var temp = parseFloat(temperature).toFixed(1);
                            // console.log(temp);
                            //console.log(res['rct_timestamp']);
                            var datetime2 = date.format(res['rct_timestamp'], 'YYYY-MM-DD HH:mm');

                            const sqlselect = `SELECT * FROM \`tcp_threshold\` WHERE imei=${item.imei}`;
                            //console.log(datetime2);
                            //var sqlinsert = newLocal;

                            conn.query(sqlselect, (err, result6) => {
                                //console.log(result6[0].id);//console.log(values);
                                if (err) {

                                    throw err;
                                }
                                if (result6.length > 0) {

                                    var sqlcheck = `SELECT * FROM \`tcp_threshold\` WHERE \`id\`=${result6[0].id}`;
                                   // console.log(sqlcheck);
                                    //var sqlinsert = newLocal;

                                    conn.query(sqlcheck, async function (err, resultcheck) {
                                        //console.log(date.format(resultcheck[0].timestamp, 'YYYY-MM-DD HH:mm'));
                                        if (err) {

                                            throw err;
                                        }
                                        var delaytime=date.format(resultcheck[0].timestamp, 'YYYY-MM-DD HH:mm');
                                        //console.log(datetime2);
                                     
                                        var s1 = Math.floor(new Date(datetime2).getTime() / 1000); 
                                        var s2 = Math.floor(new Date(delaytime).getTime() / 1000);
                                        var delay=s1-s2;
                                        var minutes = delay/60;
                                       // console.log(minutes);  
                                        if (resultcheck[0].count<4 && minutes>29) {
                                           // await sendmail(item.imei, temp, datetime2);
                                           var count=resultcheck[0].count+1;
                                            var sqlupdate = `UPDATE \`tcp_threshold\` SET \`count\`='${count}',\`sts\`='1',\`timestamp\`='${datetime2}' WHERE id=${result6[0].id}`;
                                            // console.log(sqlupdate);
                                            //var sqlinsert = newLocal;

                                            conn.query(sqlupdate, async function (err, resultupdate) {
                                                //console.log(resultupdate);
                                                if (err) {

                                                    throw err;  
                                                }
                                                //if(resultupdate)
                                                await sendmail(item.imei, temp, datetime2);
                                            });
                                        }else{

                                            var count=resultcheck[0].count;
                                            var sqlupdate = `UPDATE \`tcp_threshold\` SET \`count\`='${count}',\`sts\`='0',\`timestamp\`='${datetime2}' WHERE id=${result6[0].id}`;
                                             //console.log(sqlupdate);
                                            //var sqlinsert = newLocal;

                                            conn.query(sqlupdate, async function (err, resultupdate) {
                                                //console.log(resultupdate);
                                                if (err) {

                                                    throw err;  
                                                }
                                                //if(resultupdate)
                                               // await sendmail(item.imei, temp, datetime2);
                                            });

                                        }
                                    });

                                } else {
                                    var sqlinsert = "INSERT INTO `tcp_threshold`( `imei`, `count`, `sts`, `timestamp`) VALUES ?";
                                    //console.log(datetime2);
                                    //var sqlinsert = newLocal;
                                    var values = [
                                        [item.imei, '1', '1', datetime2],
                                    ];
                                    conn.query(sqlinsert, [values], async (err, result5) => {
                                       // console.log(sqlinsert); console.log(values);
                                        if (err) {

                                            throw err;
                                        }
                                        await sendmail(item.imei, temp, datetime2);
                                    });
                                }
                            });


                        }else{
                              //console.log(res.temp); 
                              var temperature = res.temp;
                              //var temperature=-20.0002;
                              var temp = parseFloat(temperature).toFixed(1);
                              // console.log(temp);
                              //console.log(res['rct_timestamp']);
                              var datetime2 = date.format(res['rct_timestamp'], 'YYYY-MM-DD HH:mm');
  
                              const sqlselect = `SELECT * FROM \`tcp_threshold\` WHERE imei=${item.imei}`;
                              //console.log(datetime2);
                              //var sqlinsert = newLocal;
  
                              conn.query(sqlselect, (err, result6) => {
                                  //console.log(result6[0].id);//console.log(values);
                                  if (err) {
  
                                      throw err;
                                  }
                                  if (result6.length > 0) {
  
                                     
                                         
                                             // await sendmail(item.imei, temp, datetime2);
                                         
                                              var sqlupdate = `UPDATE \`tcp_threshold\` SET \`count\`='0',\`sts\`='0',\`timestamp\`='${datetime2}' WHERE id=${result6[0].id}`;
                                              // console.log(sqlupdate);
                                              //var sqlinsert = newLocal;
  
                                              conn.query(sqlupdate, async function (err, resultupdate) {
                                                  //console.log(resultupdate);
                                                  if (err) {
  
                                                      throw err;  
                                                  }
                                                  //if(resultupdate)
                                                //  await sendmail(item.imei, temp, datetime2);
                                              });
                                         
  
                                  }
                                //    else {   
                                //       var sqlinsert = "INSERT INTO `tcp_threshold`( `imei`, `count`, `sts`, `timestamp`) VALUES ?";
                                //       //console.log(datetime2);
                                //       //var sqlinsert = newLocal;
                                //       var values = [
                                //           [item.imei, '0', '0', datetime2],
                                //       ];
                                //       conn.query(sqlinsert, [values], async (err, result5) => {
                                //           console.log(sqlinsert); console.log(values);
                                //           if (err) {
  
                                //               throw err;
                                //           }
                                //           //await sendmail(item.imei, temp, datetime2);
                                //       });
                                //   }
                              });
                        }
                    }
                });
            }


        }
    });

    //con.end();
})


async function sendmail(imei, temp, datetime2) {
    var sql2 = `SELECT \`tcp_assign_machine\`.\`id\`,\`tcp_assign_machine\`.\`tcp_machineid\` as \`machine_id\`,\`tcp_assign_machine\`.\`tcp_brand\` as \`brand_id\`,\`tcp_assign_machine\`.\`tcp_store\` as \`store_id\`,\`tcp_assign_machine\`.\`tcp_pri_user\` as \`user_id\`,\`tcp_register\`.\`imei\` as \`machine\`,\`tcp_register\`.\`tcp_machine_type\` as \`ptype\`,\`brand_tbl\`.\`brand_name\`,\`brand_tbl\`.\`bp_email\`,\`store\`.\`store_name\`,\`store\`.\`pincode\`,\`countries\`.\`name\` as \`country\`,\`states\`.\`name\` as \`state\`,\`cities\`.\`name\`as \`city\`,\`countries\`.\`id\` as \`countryid\`,\`states\`.\`id\` as \`stateid\`,\`cities\`.\`id\`as \`cityid\`,\`users\`.\`name\` as \`username\`,\`users\`.\`email\` as \`email\`, \`users\`.\`phone\` as \`phone\`,\`tcp_register\`.\`tcp_machine_type\` AS \`ptype\` FROM \`tcp_assign_machine\` JOIN \`tcp_register\` ON \`tcp_assign_machine\`.\`tcp_machineid\`=\`tcp_register\`.\`id\` JOIN \`store\` ON \`tcp_assign_machine\`.\`tcp_store\`=\`store\`.\`id\` JOIN \`brand_tbl\` ON \`brand_tbl\`.\`id\`=\`tcp_assign_machine\`.\`tcp_brand\` JOIN \`users\` ON \`users\`.\`user_id\`=\`tcp_assign_machine\`.\`tcp_pri_user\` JOIN \`countries\` ON \`countries\`.\`id\`=\`store\`.\`country\` JOIN \`states\` ON \`states\`.\`id\`=\`store\`.\`state\` JOIN \`cities\` ON \`cities\`.\`id\`=\`store\`.\`city\`  WHERE \`tcp_assign_machine\`.\`status\`='1' AND \`tcp_register\`.\`imei\`='${imei}'`;
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
                //var emailuser = item1.email;
               // var emailmanager = item1.bp_email;
                var emailuser = 'bapukhatavi@gmail.com';
                var emailmanager = 'bapu.braveryes@gmail.com';
                //var emailsend = "'"+emailuser+","+emailmanager+"'";  
                //console.log(emailsend); 
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
                html += imei + '</td>';
                html += '                          </tr>';
                html += '                          <tr>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                html += '                                  Brand:</td>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                html += item1.brand_name + '</td>';


                html += '                          </tr>';
                html += '                          <tr>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                html += '                                 Type of alarm </td>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                html += 'Temperature Over Threshold</td>';
                html += '                          </tr>';
                html += '                          <tr>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                html += '                                 Temperature </td>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                html += temp + '</td>';
                html += '                          </tr>';

                html += '                          <tr>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                html += '                                  Store Name:</td>';
                html += '                                    <td';
                html += '                                        style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                html += item1.store_name + '</td>';
                html += '                                </tr>';
                html += '                          <tr>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                html += '                                 Country </td>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                html += item1.country + '</td>';
                html += '                          </tr>';
                html += '                          <tr>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                html += '                                 State </td>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                html += item1.state + '</td>';
                html += '                          </tr>';
                html += '                          <tr>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                html += '                                 City </td>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                html += item1.city + '</td>';
                html += '                          </tr>';
                html += '                          <tr>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                html += '                                 User Name </td>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                html += item1.username + '</td>';
                html += '                          </tr>';
                html += '                          <tr>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">';
                html += '                                 Timestamp </td>';
                html += '                              <td';
                html += '                                  style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">';
                html += datetime2 + '</td>';
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
                    cc: emailmanager, 
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

