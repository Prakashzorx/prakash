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
    .on('connect', function () {
        // console.log('connect');
        device.subscribe('recipePacket/+');
        device.subscribe('machinePacket/+');
        device.subscribe('recipePacket/+/+');
        device.subscribe('machinePacket/+/+');

        //
    });

device
    .on('message', function (topic, payload) {
        //console.log('message', topic, payload.toString());
        var con = mysql.createConnection({
            host: "localhost",
            user: "root",
            password: "Mukunda@123",
            database: "mk_db"
        });



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



        var SV = 0;
        var AV = 0;
        var ApNme = '';
        var LOC = '';
        var HB = '';
        var HV = 0;
        var EC = 0;
        var RC = 0;
        var CC = 0;
        var ESPV = 0;
        var EODCC = 0;
        var sts = 0;
        var TRC = 0;
        var R1C = 0;
        var R1P1C = 0;
        var R1P2C = 0;
        var R1P3C = 0;
        var R1P4C = 0;
        var R1P5C = 0;
        var R2C = 0;
        var R2P1C = 0;
        var R2P2C = 0;
        var R2P3C = 0;
        var R2P4C = 0;
        var R2P5C = 0;
        var R3C = 0;
        var R3P1C = 0;
        var R3P2C = 0;
        var R3P3C = 0;
        var R3P4C = 0;
        var R3P5C = 0;
        var R4C = 0;
        var R4P1C = 0;
        var R4P2C = 0;
        var R4P3C = 0;
        var R4P4C = 0;
        var R4P5C = 0;
        var R5C = 0;
        var R5P1C = 0;
        var R5P2C = 0;
        var R5P3C = 0;
        var R5P4C = 0;
        var R5P5C = 0;
        var R6C = 0;
        var R6P1C = 0;
        var R6P2C = 0;
        var R6P3C = 0;
        var R6P4C = 0;
        var R6P5C = 0;
        var R7C = 0;
        var R7P1C = 0;
        var R7P2C = 0;
        var R7P3C = 0;
        var R7P4C = 0;
        var R7P5C = 0;
        var R8C = 0;
        var R8P1C = 0;
        var R8P2C = 0;
        var R8P3C = 0;
        var R8P4C = 0;
        var R8P5C = 0;
        var R9C = 0;
        var R9P1C = 0;
        var R9P2C = 0;
        var R9P3C = 0;
        var R9P4C = 0;
        var R9P5C = 0;
        var R10C = 0;
        var R10P1C = 0;
        var R10P2C = 0;
        var R10P3C = 0;
        var R10P4C = 0;
        var R10P5C = 0;
       
       
        var timestamp1 = new Date();
        var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');
        //device.publish(`recipePacket/responce`, JSON.stringify({ test_data_from_bapu : 1}));
        var data = 0;
        var recpack = JSON.parse(payload.toString());
        // console.log(recpack['sln']);
        var SLN = recpack['sln'];
        var MACID = recpack['MACID'];
        if (recpack['sln']) {
            // console.log(topic.localeCompare('recipePacket/' + SLN));
            if (topic == 'recipePacket/' + SLN) {
                //console.log(topic);
                var pack = recpack['recipe'];

                // echo $pack[0]['Fnlop'];
                var time = recpack['time'];
                //console.log(time);
                var SLN = recpack['sln'];
                var PType = pack['pt'];
                var MACID = pack['macId'];
                var Rcpcry = pack['cat'];
                var Rcpnme = pack['rcp'];
                var Rcpsrttme = pack['rst'];
                var rcpstarttime1 = new Date(Date.parse(Rcpsrttme));
                var rcpstarttime = date.format(rcpstarttime1, 'YYYY-MM-DD HH:mm:ss');
                // console.log(rcpstarttime);
                var Rcpendtme = pack['ret'];
                var rcpendtime1 = new Date(Date.parse(Rcpendtme));
                var rcpendtime = date.format(rcpendtime1, 'YYYY-MM-DD hh:mm:ss');
                // console.log(rcpendtime);
                var Rcpercd = pack['rec'];
                var Fnlop = pack['rt'];
                var appName = pack['an'];
                var cooktype = pack['toc'];
                var RC = 1;
                var mil = time;
                var seconds = mil / 1000;


                var timestamp1 = new Date(mil);
                var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');




                // var con = mysql.createConnection({
                //     host: "localhost",
                //     user: "root",
                //     password: "",
                //     database: "mk_db"
                // });
                //console.log(con);
                con.connect(function (err) {
                    if (err) {
                        device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
                        //throw err;
                    }
                    // console.log("Connected!");
                    //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
                    var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES ?";
                    var values = [
                        [time, SLN, PType, MACID, Rcpcry, Rcpnme, rcpstarttime, rcpendtime, Rcpercd, Fnlop, RC, appName, cooktype, timestamp],

                    ];
                    con.query(sql, [values], function (err, result) {
                        // console.log(err);
                        if (err) {
                            device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
                            //throw err;
                        } else {
                            device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "1" }));
                        }

                        //console.log("1 record inserted");
                    });
                    con.end();
                });

                //mysqli_close(con);

            }
            if (topic == 'machinePacket/' + SLN) {

                //console.log(topic);
                var recpack = JSON.parse(payload.toString())
                var pack = recpack['machine'];

                // echo $pack[0]['Fnlop'];
                var time = recpack['time'];
                //console.log(time);
                var SLN = recpack['sln'];
                var PType = pack['pt'];
                var MACID = pack['macId'];
                var SV = pack['sv'];
                var AV = pack['av'];
                var ApNme = pack['an'];
                var LOC = pack['ln'];
                var HB = pack['hb'];
                var EC = pack['ec'];
                var RC = pack['rc'];
                var CC = pack['ccc'];
                var EODCC = pack['ecc'];

                var mil = time;
                var seconds = mil / 1000;


                var timestamp1 = new Date(mil);
                var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');




                // var con = mysql.createConnection({
                //     host: "localhost",
                //     user: "root",
                //     password: "",
                //     database: "mk_db"
                // });
                //console.log(con);
                con.connect(function (err) {
                    if (err) {
                        device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
                        //throw err;
                    }
                    // console.log("Connected!");
                    //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
                    var sql = "INSERT INTO `rawdata`(`time`, `SLN`, `ptype`, `macid`, `sv`, `av`, `appname`, `location`, `hb`, `ec`, `rc`, `cc`, `eodcc`,`timestamp`, `sts`) VALUES ?";
                    var values = [
                        [time, SLN, PType, MACID, SV, AV, ApNme, LOC, HB, EC, RC, CC, EODCC, timestamp, 0],

                    ];
                    var i = 0;
                    con.query(sql, [values], function (err, result) {
                        //console.log(sql);
                        if (err) {
                            device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
                            //throw err;
                        } else {
                            device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "1" }));
                        }
                        // if(i==0){

                        // }
                        //i++;
                        // console.log("1 record inserted");
                    });
                    con.end();
                });
            }
        }

      

        if (topic == 'recipePacket/' + MACID) {  


          // console.log(topic);
            // var con = mysql.createConnection({
            //     host: "localhost",
            //     user: "root",
            //     password: "",
            //     database: "mk_db"
            // });
            var PType = recpack['PType'];
            if (PType == 'EPan') {
                var MACID = recpack['MACID'];
                var SLN = recpack['MACID'];
                var RcpID = recpack['RcpID'];
                var PorID = recpack['PorID'];
                var ErrID = recpack['ErrID'];
                var CurrTemT = recpack['CurrTemT'];
                var CurrTemB = recpack['CurrTemB'];
                var Fnlop = recpack['Fnlop'];
                var RCName = recpack['RCName'];
                var RcpIDC = recpack['RcpIDC'];
                //var PorIDC = recpack['PorIDC'];
                var ErrC = recpack['ErrC'];
                var timestamp1 = new Date();
                //console.log(timestamp1);
                var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');
                var time = timestamp1.getTime();
                con.connect(function (err) {
                    if (err) {
                        device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "0" }));
                       // throw err;
                    }
                    //console.log("Connected!");
                    // //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
                    // var sql = "INSERT INTO `epanrecipedata`(`time`, `ptype`, `macid`, `rcpid`, `errid`, `currtemT`, `currtemB`, `fnlop`, `rcname`, `rcpcount`, `errcount`) VALUES ?";
                    // var values = [
                    //     [timestamp, PType, MACID, RcpID, ErrID, CurrTemT, CurrTemB, Fnlop, RCName, RcpIDC, ErrC],
                    // ];

                    // con.query(sql, [values], function (err, result) {
                    //     //console.log(sql);
                    //     // console.log(values);
                    //     if (err) {
                    //         //device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
                    //         throw err;
                    //     } else {
                    //         // device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "1" }));
                    //     }
                    //     // if(i==0){

                    //     // }
                    //     //i++;
                    //     // console.log("2 record inserted");
                    // });
                    var sql1 = "INSERT INTO `rcpdata`(`time`, `SLN`, `ptype`, `cookingtype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`, `rcpercd`, `finalop`, `rc`, `appname`, `timestamp`, `rcpid`, `porid`, `errid`, `currrtemp`,`rcpidc`, `porcount`, `errcount`, `currtempT`, `currtempB`) VALUES ?";
                    var values1 = [
                        [time, SLN, PType, cooktype, MACID, RCName, RCName, rcpstarttime, rcpendtime, ErrID, Fnlop, RC, appName, timestamp, RcpID, PorID, ErrID, CurrTem, RcpIDC, PorIDC, ErrC, CurrTemT, CurrTemB],
                    ];

                    con.query(sql1, [values1], function (err, result) { 
                        //console.log(sql1);
                         //console.log(values1);
                        if (err) {
                            device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
                            //throw err;
                        } else {
                            device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "1" }));
                        }
                        // if(i==0){

                        // }
                        //i++;
                         //console.log("1 record inserted");
                    });
                    con.end();
                });
            } else {
                var PType = recpack['PType'];
                var MACID = recpack['MACID'];
                var SLN = recpack['MACID'];
                var appName = recpack['an'];
                var RcpID = recpack['RcpID'];
                var PorID = recpack['PorID'];
                var ErrID = recpack['ErrID'];
                var Rcpercd=recpack['ErrID'];
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
                con.connect(function (err) {
                    if (err) {
                        device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "0" }));
                       // throw err;
                    }
                    // // console.log("Connected!");
                    // //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
                    // var sql = "INSERT INTO `fryerrecipedata`(`time`, `ptype`, `macid`, `rcpid`, `porid`, `errid`, `currtem`, `fnlop`, `rcname`, `rcpcount`, `porcount`, `errcount`) VALUES ?";
                    // var values = [
                    //     [timestamp, PType, MACID, RcpID, PorID, ErrID, CurrTem, Fnlop, RCName, RcpIDC, PorIDC, ErrC],
                    // ];
                    // var i = 0;
                    // con.query(sql, [values], function (err, result) {
                    //     //console.log(sql);
                    //    //  console.log(values);
                    //     if (err) {
                    //         //device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "0" }));
                    //         throw err;
                    //     } else {
                    //         ///device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "1" }));
                    //     }
                    //     // if(i==0){

                    //     // }
                    //     //i++;
                    //      //console.log("firt record inserted");
                    // });
                    var sql1 = "INSERT INTO `rcpdata`(`time`, `SLN`, `ptype`, `cookingtype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`, `rcpercd`, `finalop`, `rc`, `appname`, `timestamp`, `rcpid`, `porid`, `errid`, `currrtemp`,`rcpidc`, `porcount`, `errcount`, `currtempT`, `currtempB`) VALUES ?";
                    var values1 = [
                        [time, SLN, PType, cooktype, MACID, RCName, PorID, rcpstarttime, rcpendtime, Rcpercd, Fnlop, RC, appName, timestamp, RcpID, PorID, ErrID, CurrTem, RcpIDC, PorIDC, ErrC, CurrTemT, CurrTemB]
                        //[time, SLN, PType, cooktype, MACID, Rcpcry, RCName, rcpstarttime, rcpendtime, Rcpercd, Fnlop, RC, appName, timestamp, RcpID, PorID, ErrID, CurrTem, RcpIDC, PorIDC, ErrC, CurrTemT, CurrTemB],
                    ];
                    var i = 0;
                    con.query(sql1, [values1], function (err, result) {
                        //console.log(sql1);
                        //console.log(values);
                        if (err) {
                            device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
                            throw err;
                        } else {
                            device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "1" }));
                        }
                        // if(i==0){
   
                        // }
                        //i++;
                         //console.log("1 record inserted");
                    });
                    con.end();
                });

            }
        }

        
        if (topic == 'machinePacket/' + MACID) {
            
            var PType = recpack['PType'];
            if (PType == 'Fryer') {

                var R1PC="0-0-0-0-0";
                var R2PC="0-0-0-0-0";
                var R3PC="0-0-0-0-0";
                var R4PC="0-0-0-0-0";
                var R5PC="0-0-0-0-0";
                var R6PC="0-0-0-0-0";
                var R7PC="0-0-0-0-0";
                var R8PC="0-0-0-0-0";
                var R9PC="0-0-0-0-0";
                var R10PC="0-0-0-0-0";

                var MACID = recpack['MACID'];
                var SLN = recpack['MACID'];
                var an = recpack['an'];
                var sv = recpack['sv'];
               // var LOC = recpack['LOC'];
                var ESPV = recpack['ESPV'];
                //var HB = recpack['HB'];
                var TRC = recpack['TRC'];
              
                if(!recpack['R1PC']){
                    R1PC='0-0-0-0-0';
                }else{
                    var R1C = recpack['TR1C'];
                    var R1PC = recpack['R1PC'];
                }
                const myArray1 = R1PC.split("-");
                //console.log(myArray1[0]);
                var R1P1C = myArray1[0];
                var R1P2C = myArray1[1];
                var R1P3C = myArray1[2];
                var R1P4C = myArray1[3];
                var R1P5C = myArray1[4];
               
                if(!recpack['R2PC']){
                    R2PC='0-0-0-0-0';
                }else{
                    var R2C = recpack['TR2C'];
                    var R2PC = recpack['R2PC'];
                }
                const myArray2 = R2PC.split("-");
                //console.log(myArray1[0]);
                var R2P1C = myArray2[0];
                var R2P2C = myArray2[1];
                var R2P3C = myArray2[2];
                var R2P4C = myArray2[3];
                var R2P5C = myArray2[4];
               
                if(!recpack['R3PC']){
                    R3PC='0-0-0-0-0';
                }else{
                    var R3C = recpack['TR3C']; 
                    var R3PC = recpack['R3PC'];
                }
                const myArray3 = R3PC.split("-");
                //console.log(myArray1[0]);
                var R3P1C = myArray3[0];
                var R3P2C = myArray3[1];
                var R3P3C = myArray3[2];
                var R3P4C = myArray3[3];
                var R3P5C = myArray3[4];
                
                if(!recpack['R4PC']){
                    R4PC='0-0-0-0-0';
                }else{
                    var R4C = recpack['TR4C'];
                    var R4PC = recpack['R4PC'];
                }
                const myArray4 = R4PC.split("-");
                //console.log(myArray1[0]);
                var R4P1C = myArray4[0];
                var R4P2C = myArray4[1];
                var R4P3C = myArray4[2];
                var R4P4C = myArray4[3];
                var R4P5C = myArray4[4];
               
                if(!recpack['R5PC']){
                    R5PC='0-0-0-0-0';
                }else{
                    var R5C = recpack['TR5C'];
                    var R5PC = recpack['R5PC'];
                }
                const myArray5 = R5PC.split("-");
                //console.log(myArray1[0]);
                var R5P1C = myArray5[0];
                var R5P2C = myArray5[1];
                var R5P3C = myArray5[2];
                var R5P4C = myArray5[3];
                var R5P5C = myArray5[4];
              
                if(!recpack['R6PC']){
                    R6PC='0-0-0-0-0';
                }else{
                    var R6C = recpack['TR6C'];
                    var R6PC = recpack['R6PC'];
                }
                const myArray6 = R6PC.split("-");
                //console.log(myArray1[0]);
                var R6P1C = myArray6[0];
                var R6P2C = myArray6[1];
                var R6P3C = myArray6[2];
                var R6P4C = myArray6[3];
                var R6P5C = myArray6[4];
               
                if(!recpack['R7PC']){
                    R7PC='0-0-0-0-0';
                }else{
                    var R7C = recpack['TR7C'];
                    var R7PC = recpack['R7PC'];
                }
                const myArray7 = R7PC.split("-");
                //console.log(myArray1[0]);
                var R7P1C = myArray7[0];
                var R7P2C = myArray7[1];
                var R7P3C = myArray7[2];
                var R7P4C = myArray7[3];
                var R7P5C = myArray7[4];
                
                if(!recpack['R8PC']){
                    R8PC='0-0-0-0-0';
                }else{
                    var R8C = recpack['TR8C'];
                    var R8PC = recpack['R8PC'];
                }
                const myArray8 = R8PC.split("-");
                //console.log(myArray1[0]);
                var R8P1C = myArray8[0];
                var R8P2C = myArray8[1];
                var R8P3C = myArray8[2];
                var R8P4C = myArray8[3];
                var R8P5C = myArray8[4];
               
                //var R9PC = recpack['R9PC'];
               // console.log(R9PC);
                if(!recpack['R9PC']){
                    R9PC='0-0-0-0-0';
                }else{
                    var R9C = recpack['TR9C'];
                    var R9PC = recpack['R9PC'];
                }
                const myArray9 = R9PC.split("-");
                //console.log(myArray1[0]);
                var R9P1C = myArray9[0];
                var R9P2C = myArray9[1];
                var R9P3C = myArray9[2];
                var R9P4C = myArray9[3];
                var R9P5C = myArray9[4];
                
                if(!recpack['R10PC']){
                    R10PC='0-0-0-0-0';
                }else{
                    var R10C = recpack['TR10C'];
                    var R10PC = recpack['R10PC'];
                }
                const myArray10 = R10PC.split("-");
                //console.log(myArray1[0]);
                var R10P1C = myArray10[0];
                var R10P2C = myArray10[1];
                var R10P3C = myArray10[2];
                var R10P4C = myArray10[3];
                var R10P5C = myArray10[4];
                var timestamp1 = new Date();
                var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');
                var time = timestamp1.getTime();

                con.connect(function (err) {
                    if (err) {
                        device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
                       // throw err;
                    }
                    // // console.log("Connected!");
                    // //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
                    // var sql = "INSERT INTO `fryermachinedata`( `time`, `ptype`, `macid`,`hv`, `sv`,`loc`,`espv`, `hb`,  `trc`, `r1c`, `r1p1c`, `r1p2c`, `r1p3c`, `r1p4c`, `r1p5c`, `r2c`, `r2p1c`, `r2p2c`, `r2p3c`, `r2p4c`, `r2p5c`, `r3c`, `r3p1c`, `r3p2c`, `r3p3c`, `r3p4c`, `r3p5c`, `r4c`, `r4p1c`, `r4p2c`, `r4p3c`, `r4p4c`, `r4p5c`, `r5c`, `r5p1c`, `r5p2c`, `r5p3c`, `r5p4c`, `r5p5c`, `r6c`, `r6p1c`, `r6p2c`, `r6p3c`, `r6p4c`, `r6p5c`, `r7c`, `r7p1c`, `r7p2c`, `r7p3c`, `r7p4c`, `r7p5c`, `r8c`, `r8p1c`, `r8p2c`, `r8p3c`, `r8p4c`, `r8p5c`, `r9c`, `r9p1c`, `r9p2c`, `r9p3c`, `r9p4c`, `r9p5c`, `r10c`, `r10p1c`, `r10p2c`, `r10p3c`, `r10p4c`, `r10p5c`) VALUES ?";
                    // var values = [
                    //     [timestamp, PType, MACID, an, SV, LOC, ESPV, HB, TRC, R1C, R1P1C, R1P2C, R1P3C, R1P4C, R1P5C, R2C, R2P1C, R2P2C, R2P3C, R2P4C, R2P5C, R3C, R3P1C, R3P2C, R3P3C, R3P4C, R3P5C, R4C, R4P1C, R4P2C, R4P3C, R4P4C, R4P5C, R5C, R5P1C, R5P2C, R5P3C, R5P4C, R5P5C, R6C, R6P1C, R6P2C, R6P3C, R6P4C, R6P5C, R7C, R7P1C, R7P2C, R7P3C, R7P4C, R7P5C, R8C, R8P1C, R8P2C, R8P3C, R8P4C, R8P5C, R9C, R9P1C, R9P2C, R9P3C, R9P4C, R9P5C, R10C, R10P1C, R10P2C, R10P3C, R10P4C, R10P5C],
                    // ];

                    // con.query(sql, [values], function (err, result) {
                    //     //console.log(sql);
                    //     // console.log(values);
                    //     if (err) {
                    //         // device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "0" }));
                    //        // throw err;
                    //     } else {
                    //         // device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "1" }));
                    //     }
                    //     // if(i==0){

                    //     // }
                    //     //i++;
                    //     // console.log("1 record inserted");
                    // });

                    var sql1 = "INSERT INTO `rawdata`(`time`, `SLN`, `ptype`, `macid`, `sv`, `av`, `appname`, `location`, `espv`,`hb`, `ec`, `rc`, `cc`, `eodcc`, `timestamp`, `sts`, `r1c`, `r1p1c`, `r1p2c`, `r1p3c`, `r1p4c`, `r1p5c`, `r2c`, `r2p1c`, `r2p2c`, `r2p3c`, `r2p4c`, `r2p5c`, `r3c`, `r3p1c`, `r3p2c`, `r3p3c`, `r3p4c`, `r3p5c`, `r4c`, `r4p1c`, `r4p2c`, `r4p3c`, `r4p4c`, `r4p5c`, `r5c`, `r5p1c`, `r5p2c`, `r5p3c`, `r5p4c`, `r5p5c`, `r6c`, `r6p1c`, `r6p2c`, `r6p3c`, `r6p4c`, `r6p5c`, `r7c`, `r7p1c`, `r7p2c`, `r7p3c`, `r7p4c`, `r7p5c`, `r8c`, `r8p1c`, `r8p2c`, `r8p3c`, `r8p4c`, `r8p5c`, `r9c`, `r9p1c`, `r9p2c`, `r9p3c`, `r9p4c`, `r9p5c`, `r10c`, `r10p1c`, `r10p2c`, `r10p3c`, `r10p4c`, `r10p5c`, `hv`) VALUES ?";
                    var values1 = [
                        [time, SLN, PType, MACID, SV, AV, an, LOC, ESPV, HB, EC, TRC, CC, EODCC, timestamp, sts, R1C, R1P1C, R1P2C, R1P3C, R1P4C, R1P5C, R2C, R2P1C, R2P2C, R2P3C, R2P4C, R2P5C, R3C, R3P1C, R3P2C, R3P3C, R3P4C, R3P5C, R4C, R4P1C, R4P2C, R4P3C, R4P4C, R4P5C, R5C, R5P1C, R5P2C, R5P3C, R5P4C, R5P5C, R6C, R6P1C, R6P2C, R6P3C, R6P4C, R6P5C, R7C, R7P1C, R7P2C, R7P3C, R7P4C, R7P5C, R8C, R8P1C, R8P2C, R8P3C, R8P4C, R8P5C, R9C, R9P1C, R9P2C, R9P3C, R9P4C, R9P5C, R10C, R10P1C, R10P2C, R10P3C, R10P4C, R10P5C, HV],
                    ];

                    con.query(sql1, [values1], function (err, result) {

                        if (err) {
                            device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
                           // throw err;
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
            } else {

                // console.log(topic);
                // var con = mysql.createConnection({
                //     host: "localhost",
                //     user: "root",
                //     password: "",
                //     database: "mk_db"
                // });

                //console.log(pt);
                var PType = recpack['PType'];
                var MACID = recpack['MACID'];
                var SLN = recpack['MACID'];
                // var HV = recpack['HV'];
                var sv = recpack['SV'];
                // var LOC = recpack['LOC'];
                var ESPV = recpack['ESPV'];
                var HB = recpack['HB'];
                var TRC = recpack['TRC'];
                var R1C = recpack['R1C'];

                var R2C = recpack['R2C'];

                var R3C = recpack['R3C'];

                var R4C = recpack['R4C'];

                var R5C = recpack['R5C'];

                var R6C = recpack['R6C'];

                var R7C = recpack['R7C'];

                var R8C = recpack['R8C'];

                var R9C = recpack['R9C'];

                var R10C = recpack['R10C'];

                var timestamp1 = new Date();
                var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');
                var time = timestamp1.getTime();

                con.connect(function (err) {
                    if (err) {
                        device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
                        throw err;
                    }
                    // // console.log("Connected!");
                    // //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
                    // var sql = "INSERT INTO `epanmachinedata`(`time`, `ptype`, `macid`, `sv`, `hb`, `espv`, `trc`, `r1c`, `r2c`, `r3c`, `r4c`, `r5c`, `r6c`, `r7c`, `r8c`, `r9c`, `r10c`) VALUES ?";
                    // var values = [
                    //     [timestamp, PType, MACID, sv, HB, ESPV, TRC, R1C, R2C, R3C, R4C, R5C, R6C, R7C, R8C, R9C, R10C],
                    // ];

                    // con.query(sql, [values], function (err, result) {
                    //     //console.log(sql);
                    //     // console.log(values);
                    //     if (err) {
                    //         //device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "0" }));
                    //         throw err;
                    //     } else {
                    //         //device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "1" }));
                    //     }
                    //     // if(i==0){

                    //     // }
                    //     //i++;
                    //     // console.log("1 record inserted");
                    // });
                    var sql1 = "INSERT INTO `rawdata`(`time`, `SLN`, `ptype`, `macid`, `sv`, `av`, `appname`, `location`, `espv`,`hb`, `ec`, `rc`, `cc`, `eodcc`, `timestamp`, `sts`, `r1c`, `r1p1c`, `r1p2c`, `r1p3c`, `r1p4c`, `r1p5c`, `r2c`, `r2p1c`, `r2p2c`, `r2p3c`, `r2p4c`, `r2p5c`, `r3c`, `r3p1c`, `r3p2c`, `r3p3c`, `r3p4c`, `r3p5c`, `r4c`, `r4p1c`, `r4p2c`, `r4p3c`, `r4p4c`, `r4p5c`, `r5c`, `r5p1c`, `r5p2c`, `r5p3c`, `r5p4c`, `r5p5c`, `r6c`, `r6p1c`, `r6p2c`, `r6p3c`, `r6p4c`, `r6p5c`, `r7c`, `r7p1c`, `r7p2c`, `r7p3c`, `r7p4c`, `r7p5c`, `r8c`, `r8p1c`, `r8p2c`, `r8p3c`, `r8p4c`, `r8p5c`, `r9c`, `r9p1c`, `r9p2c`, `r9p3c`, `r9p4c`, `r9p5c`, `r10c`, `r10p1c`, `r10p2c`, `r10p3c`, `r10p4c`, `r10p5c`, `hv`) VALUES ?";
                    var values1 = [
                        [time, SLN, PType, MACID, sv, AV, ApNme, LOC, ESPV, HB, EC, TRC, CC, EODCC, timestamp, sts, R1C, R1P1C, R1P2C, R1P3C, R1P4C, R1P5C, R2C, R2P1C, R2P2C, R2P3C, R2P4C, R2P5C, R3C, R3P1C, R3P2C, R3P3C, R3P4C, R3P5C, R4C, R4P1C, R4P2C, R4P3C, R4P4C, R4P5C, R5C, R5P1C, R5P2C, R5P3C, R5P4C, R5P5C, R6C, R6P1C, R6P2C, R6P3C, R6P4C, R6P5C, R7C, R7P1C, R7P2C, R7P3C, R7P4C, R7P5C, R8C, R8P1C, R8P2C, R8P3C, R8P4C, R8P5C, R9C, R9P1C, R9P2C, R9P3C, R9P4C, R9P5C, R10C, R10P1C, R10P2C, R10P3C, R10P4C, R10P5C, HV,],
                    ];

                    con.query(sql1, [values1], function (err, result) {
                        // console.log(sql1);
                        // console.log(values1);
                        if (err) {
                            device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
                            throw err;
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
        }
    });