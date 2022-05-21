// Importing express module
const express = require('express');
const app = express();
var bodyParser = require('body-parser');
var cors = require('cors');

app.use(cors());

var awsIot = require('aws-iot-device-sdk');
var mysql = require('mysql');
var response = [];
const date = require('date-and-time');
// Create application/x-www-form-urlencoded parser
var urlencodedParser = bodyParser.urlencoded({ extended: false })
app.use(express.json());


var device = awsIot.device({
    keyPath: 'certpacket/68e75e21c9a81aebd315a66b06beef5bdebb82ea3465a18b2a068fba0c4b68fd-private.pem.key',
    certPath: 'certpacket/68e75e21c9a81aebd315a66b06beef5bdebb82ea3465a18b2a068fba0c4b68fd-certificate.pem.crt',
    caPath: 'certpacket/AmazonRootCA1.pem',
    clientId: 'packetawsconnection',
    host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com'
});

device
    .on('connect', function() {
        // console.log('connect');
        device.subscribe('recipePacket/+');
        //device.subscribe('machinePacket/+');
        //
    });

device
    .on('message', function(topic, payload) {
        //console.log('message', topic, payload.toString());

        // var con = mysql.createConnection({
        //     host: "localhost",
        //     user: "root",
        //     password: "Mukunda@123", 
        //     database: "mk_db"
        // });

        var time = '';

        var SLN = '';
        var PType = '';
        var MACID = '';
        var Rcpcry = '';
        var Rcpnme = '';
        var Rcpsrttme = '';

        var rcpstarttime = '';

        var Rcpendtme = '';

        var rcpendtime = '';

        var Rcpercd = '';
        var Fnlop = '';
        var appName = '';
        var cooktype = '';
        var RC = 1;
        var PType = 0;
        var MACID = 0;
        var RcpID = 0;
        var PorID = 0;
        var ErrID = 0;
        var CurrTem = 0;
        var Fnlop = 0;
        var RCName = 0;
        var RcpIDC = 0;
        var PorIDC = 0;
        var ErrC = 0;
        var CurrTemT = 0;
        var CurrTemB = 0;
        var timestamp1 = new Date();
        var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');
        //device.publish(`recipePacket/responce`, JSON.stringify({ test_data_from_bapu : 1}));
        var data = 0;
        var recpack = JSON.parse(payload.toString());
        //console.log(recpack);
        data = recpack['recipe'];
        if (!data) {
            var pt = recpack['PType'];
            if (pt == 'Fryer') {
                var con = mysql.createConnection({
                    host: "localhost",
                    user: "root",
                    password: "Mukunda@123",
                    database: "mk_db"
                });
                var PType = recpack['PType'];
                var MACID = recpack['MACID'];
                var SLN = recpack['MACID'];
                var RcpID = recpack['RcpID'];
                var PorID = recpack['PorID'];
                var ErrID = recpack['ErrID'];
                var CurrTem = recpack['CurrTem'];
                var Fnlop = recpack['Fnlop'];
                var RCName = recpack['RCName'];
                var RcpIDC = recpack['RcpIDC'];
                var PorIDC = recpack['PorIDC'];
                var ErrC = recpack['ErrC'];
                var timestamp1 = new Date();
                //console.log(timestamp1);
                var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');
                var time = timestamp1.getTime();
                con.connect(function(err) {
                    if (err) {
                        device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "0" }));
                        //throw err;
                    }
                    // console.log("Connected!");
                    //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
                    var sql = "INSERT INTO `fryerrecipedata`(`time`, `ptype`, `macid`, `rcpid`, `porid`, `errid`, `currtem`, `fnlop`, `rcname`, `rcpcount`, `porcount`, `errcount`) VALUES ?";
                    var values = [
                        [timestamp, PType, MACID, RcpID, PorID, ErrID, CurrTem, Fnlop, RCName, RcpIDC, PorIDC, ErrC],
                    ];
                    var i = 0;
                    con.query(sql, [values], function(err, result) {
                        //console.log(sql);
                        // console.log(values);
                        if (err) {
                            //device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "0" }));
                            throw err;
                        } else {
                            ///device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "1" }));
                        }
                        // if(i==0){

                        // }
                        //i++;
                        // console.log("1 record inserted");
                    });
                    var sql1 = "INSERT INTO `rcpdata`(`time`, `SLN`, `ptype`, `cookingtype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`, `rcpercd`, `finalop`, `rc`, `appname`, `timestamp`, `rcpid`, `porid`, `errid`, `currrtemp`,`rcpidc`, `porcount`, `errcount`, `currtempT`, `currtempB`) VALUES ?";
                    var values1 = [
                        [time, SLN, PType, cooktype, MACID, Rcpcry, RCName, rcpstarttime, rcpendtime, Rcpercd, Fnlop, RC, appName, timestamp, RcpID, PorID, ErrID, CurrTem, RcpIDC, PorIDC, ErrC, CurrTemT, CurrTemB],
                    ];
                    var i = 0;
                    con.query(sql1, [values1], function(err, result) {
                        //console.log(sql);
                       // console.log(values);
                        if (err) {
                            device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
                            //throw err;
                        } else {
                            device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "1" }));
                        }
                        // if(i==0){

                        // }
                        //i++;
                        // console.log("1 record inserted");
                    });
                    con.end();
                });

            } 
            // else if (pt == 'EPan') {
            //     var con = mysql.createConnection({
            //         host: "localhost",
            //         user: "root",
            //         password: "Mukunda@123",
            //         database: "mk_db"
            //     });
            //     var PType = recpack['PType'];
            //     var MACID = recpack['MACID'];
            //     var SLN = recpack['MACID'];
            //     var RcpID = recpack['RcpID'];
            //     var PorID = recpack['PorID'];
            //     var ErrID = recpack['ErrID'];
            //     var CurrTemT = recpack['CurrTemT'];
            //     var CurrTemB = recpack['CurrTemB'];
            //     var Fnlop = recpack['Fnlop'];
            //     var RCName = recpack['RCName'];
            //     var RcpIDC = recpack['RcpIDC'];
            //     //var PorIDC = recpack['PorIDC'];
            //     var ErrC = recpack['ErrC'];
            //     var timestamp1 = new Date();
            //     //console.log(timestamp1);
            //     var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');
            //     var time = timestamp1.getTime();
            //     con.connect(function(err) {
            //         if (err) {
            //             device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "0" }));
            //             //throw err;
            //         }
            //         // console.log("Connected!");
            //         //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
            //         var sql = "INSERT INTO `epanrecipedata`(`time`, `ptype`, `macid`, `rcpid`, `errid`, `currtemT`, `currtemB`, `fnlop`, `rcname`, `rcpcount`, `errcount`) VALUES ?";
            //         var values = [
            //             [timestamp, PType, MACID, RcpID, ErrID, CurrTemT, CurrTemB, Fnlop, RCName, RcpIDC, ErrC],
            //         ];
            //         var i = 0;
            //         con.query(sql, [values], function(err, result) {
            //             //console.log(sql);
            //             // console.log(values);
            //             if (err) {
            //                 //device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
            //                 throw err;
            //             } else {
            //                 // device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "1" }));
            //             }
            //             // if(i==0){

            //             // }
            //             //i++;
            //             // console.log("1 record inserted");
            //         });
            //         var sql1 = "INSERT INTO `rcpdata`(`time`, `SLN`, `ptype`, `cookingtype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`, `rcpercd`, `finalop`, `rc`, `appname`, `timestamp`, `rcpid`, `porid`, `errid`, `currrtemp`,`rcpidc`, `porcount`, `errcount`, `currtempT`, `currtempB`) VALUES ?";
            //         var values1 = [
            //             [time, SLN, PType, cooktype, MACID, Rcpcry, RCName, rcpstarttime, rcpendtime, Rcpercd, Fnlop, RC, appName, timestamp, RcpID, PorID, ErrID, CurrTem, RcpIDC, PorIDC, ErrC, CurrTemT, CurrTemB],
            //         ];
            //         var i = 0;
            //         con.query(sql1, [values1], function(err, result) {
            //              //console.log(sql);
            //             // console.log(values);
            //             if (err) {
            //                 device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
            //                 //throw err;
            //             } else {
            //                 device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "1" }));
            //             }
            //             // if(i==0){

            //             // }
            //             //i++;
            //             // console.log("1 record inserted");
            //         });
            //         con.end();
            //     });
            // }
        }
        //  else {
        //     if (recpack['recipe']) {
        //         var con = mysql.createConnection({
        //             host: "localhost",
        //             user: "root",
        //             password: "Mukunda@123",
        //             database: "mk_db"
        //         });
        //         var pack = recpack['recipe'];

        //         // echo $pack[0]['Fnlop'];
        //         //var time = recpack['time'];
        //         //console.log(time);
        //         var SLN = recpack['sln'];
        //         var PType = pack['pt'];
        //         var MACID = pack['macId'];
        //         var Rcpcry = pack['cat'];
        //         var RCName = pack['rcp'];
        //         var Rcpsrttme = pack['rst'];
        //         var rcpstarttime1 = new Date(Date.parse(Rcpsrttme));
        //         var rcpstarttime = date.format(rcpstarttime1, 'YYYY-MM-DD HH:mm:ss');
        //         // console.log(rcpstarttime);
        //         var Rcpendtme = pack['ret'];
        //         var rcpendtime1 = new Date(Date.parse(Rcpendtme));
        //         var rcpendtime = date.format(rcpendtime1, 'YYYY-MM-DD hh:mm:ss');
        //         // console.log(rcpendtime);
        //         var Rcpercd = pack['rec'];
        //         var Fnlop = pack['rt'];
        //         var appName = pack['an'];
        //         var cooktype = pack['toc'];
        //         var RC = 1;
        //         var timestamp1 = new Date();
        //         //console.log(timestamp1);
        //         var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');
        //         var time = timestamp1.getTime();





        //         //console.log(con);
        //         con.connect(function(err) {
        //             if (err) {
        //                 device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
        //                 //throw err;
        //             }
        //             // console.log("Connected!");
        //             //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
        //             var sql = "INSERT INTO wokierecipedata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES ?";
        //             var values = [
        //                 [time, SLN, PType, MACID, Rcpcry, RCName, rcpstarttime, rcpendtime, Rcpercd, Fnlop, RC, appName, cooktype, timestamp],

        //             ];
        //             con.query(sql, [values], function(err, result) {
        //                 // console.log(err);
        //                 // console.log(sql);
        //                 // console.log(values);
        //                 if (err) {
        //                     //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
        //                     throw err;
        //                 } else {
        //                     //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "1" }));
        //                 }

        //                 //console.log("1 record inserted");
        //             });
        //             var sql1 = "INSERT INTO `rcpdata`(`time`, `SLN`, `ptype`, `cookingtype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`, `rcpercd`, `finalop`, `rc`, `appname`, `timestamp`, `rcpid`, `porid`, `errid`, `currrtemp`,`rcpidc`, `porcount`, `errcount`, `currtempT`, `currtempB`) VALUES ?";
        //             var values1 = [
        //                 [time, SLN, PType, cooktype, MACID, Rcpcry, RCName, rcpstarttime, rcpendtime, Rcpercd, Fnlop, RC, appName, timestamp, RcpID, PorID, ErrID, CurrTem, RcpIDC, PorIDC, ErrC, CurrTemT, CurrTemB],
        //             ];
        //             var i = 0;
        //             con.query(sql1, [values1], function(err, result) {
        //                 //console.log(sql);
        //                 //console.log(values);
        //                 if (err) {
        //                     device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
        //                     //throw err;
        //                 } else {
        //                     device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "1" }));
        //                 }
        //                 // if(i==0){

        //                 // }
        //                 //i++;
        //                 // console.log("1 record inserted");
        //             });
        //             con.end();
        //         });

        //         //mysqli_close(con);
        //     }
        // }
        //mysqli_close(con);



    });