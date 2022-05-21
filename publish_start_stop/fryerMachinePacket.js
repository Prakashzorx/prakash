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
        //device.subscribe('recipePacket/+');
        device.subscribe('machinePacket/+');
        //
    });

device
    .on('message', function (topic, payload) {
        //console.log('message', topic, payload.toString());

       

        var SLN = '';
        var PType = '';
        var MACID = '';
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
        data = recpack['machine'];
        //console.log(recpack['PType']);
        if (!data) {

            var pt = recpack['PType'];
            if (pt == 'Fryer') {

                var con = mysql.createConnection({
                    host: "localhost",
                    user: "root",
                    password: "Mukunda@123",
                    database: "mk_db"
                });
                // console.log(pt);
                var PType = recpack['PType'];
                var MACID = recpack['MACID'];
                var SLN = recpack['MACID'];
                var HV = recpack['HV'];
                var sv = recpack['sv'];
                var LOC = recpack['LOC'];
                var ESPV = recpack['ESPV'];
                var HB = recpack['HB'];
                var TRC = recpack['TRC'];
                var R1C = recpack['R1C'];
                var R1P1C = recpack['R1P1C'];
                var R1P2C = recpack['R1P2C'];
                var R1P3C = recpack['R1P3C'];
                var R1P4C = recpack['R1P4C'];
                var R1P5C = recpack['R1P5C'];
                var R2C = recpack['R2C'];
                var R2P1C = recpack['R2P1C'];
                var R2P2C = recpack['R2P2C'];
                var R2P3C = recpack['R2P3C'];
                var R2P4C = recpack['R2P4C'];
                var R2P5C = recpack['R2P5C'];
                var R3C = recpack['R3C'];
                var R3P1C = recpack['R3P1C'];
                var R3P2C = recpack['R3P2C'];
                var R3P3C = recpack['R3P3C'];
                var R3P4C = recpack['R3P4C'];
                var R3P5C = recpack['R3P5C'];
                var R4C = recpack['R4C'];
                var R4P1C = recpack['R4P1C'];
                var R4P2C = recpack['R4P2C'];
                var R4P3C = recpack['R4P3C'];
                var R4P4C = recpack['R4P4C'];
                var R4P5C = recpack['R4P5C'];
                var R5C = recpack['R5C'];
                var R5P1C = recpack['R5P1C'];
                var R5P2C = recpack['R5P2C'];
                var R5P3C = recpack['R5P3C'];
                var R5P4C = recpack['R5P4C'];
                var R5P5C = recpack['R5P5C'];
                var R6C = recpack['R6C'];
                var R6P1C = recpack['R6P1C'];
                var R6P2C = recpack['R6P2C'];
                var R6P3C = recpack['R6P3C'];
                var R6P4C = recpack['R6P4C'];
                var R6P5C = recpack['R6P5C'];
                var R7C = recpack['R7C'];
                var R7P1C = recpack['R7P1C'];
                var R7P2C = recpack['R7P2C'];
                var R7P3C = recpack['R7P3C'];
                var R7P4C = recpack['R7P4C'];
                var R7P5C = recpack['R7P5C'];
                var R8C = recpack['R8C'];
                var R8P1C = recpack['R8P1C'];
                var R8P2C = recpack['R8P2C'];
                var R8P3C = recpack['R8P3C'];
                var R8P4C = recpack['R8P4C'];
                var R8P5C = recpack['R8P5C'];
                var R9C = recpack['R9C'];
                var R9P1C = recpack['R9P1C'];
                var R9P2C = recpack['R9P2C'];
                var R9P3C = recpack['R9P3C'];
                var R9P4C = recpack['R9P4C'];
                var R9P5C = recpack['R9P5C'];
                var R10C = recpack['R10C'];
                var R10P1C = recpack['R10P1C'];
                var R10P2C = recpack['R10P2C'];
                var R10P3C = recpack['R10P3C'];
                var R10P4C = recpack['R10P4C'];
                var R10P5C = recpack['R10P5C'];
                var timestamp1 = new Date();
                var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');
                var time = timestamp1.getTime();

                con.connect(function (err) {
                    if (err) {
                        device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
                        //throw err;
                    }
                    // console.log("Connected!");
                    //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
                    var sql = "INSERT INTO `fryermachinedata`( `time`, `ptype`, `macid`,`hv`, `sv`,`loc`,`espv`, `hb`,  `trc`, `r1c`, `r1p1c`, `r1p2c`, `r1p3c`, `r1p4c`, `r1p5c`, `r2c`, `r2p1c`, `r2p2c`, `r2p3c`, `r2p4c`, `r2p5c`, `r3c`, `r3p1c`, `r3p2c`, `r3p3c`, `r3p4c`, `r3p5c`, `r4c`, `r4p1c`, `r4p2c`, `r4p3c`, `r4p4c`, `r4p5c`, `r5c`, `r5p1c`, `r5p2c`, `r5p3c`, `r5p4c`, `r5p5c`, `r6c`, `r6p1c`, `r6p2c`, `r6p3c`, `r6p4c`, `r6p5c`, `r7c`, `r7p1c`, `r7p2c`, `r7p3c`, `r7p4c`, `r7p5c`, `r8c`, `r8p1c`, `r8p2c`, `r8p3c`, `r8p4c`, `r8p5c`, `r9c`, `r9p1c`, `r9p2c`, `r9p3c`, `r9p4c`, `r9p5c`, `r10c`, `r10p1c`, `r10p2c`, `r10p3c`, `r10p4c`, `r10p5c`) VALUES ?";
                    var values = [
                        [timestamp, PType, MACID, HV, SV, LOC, ESPV, HB, TRC, R1C, R1P1C, R1P2C, R1P3C, R1P4C, R1P5C, R2C, R2P1C, R2P2C, R2P3C, R2P4C, R2P5C, R3C, R3P1C, R3P2C, R3P3C, R3P4C, R3P5C, R4C, R4P1C, R4P2C, R4P3C, R4P4C, R4P5C, R5C, R5P1C, R5P2C, R5P3C, R5P4C, R5P5C, R6C, R6P1C, R6P2C, R6P3C, R6P4C, R6P5C, R7C, R7P1C, R7P2C, R7P3C, R7P4C, R7P5C, R8C, R8P1C, R8P2C, R8P3C, R8P4C, R8P5C, R9C, R9P1C, R9P2C, R9P3C, R9P4C, R9P5C, R10C, R10P1C, R10P2C, R10P3C, R10P4C, R10P5C],
                    ];
                    
                    con.query(sql, [values], function (err, result) {
                        //console.log(sql);
                        // console.log(values);
                        if (err) {
                            // device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "0" }));
                            //throw err;
                        } else {
                            // device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "1" }));
                        }
                        // if(i==0){

                        // }
                        //i++;
                        // console.log("1 record inserted");
                    });

                    var sql1 = "INSERT INTO `rawdata`(`time`, `SLN`, `ptype`, `macid`, `sv`, `av`, `appname`, `location`, `espv`,`hb`, `ec`, `rc`, `cc`, `eodcc`, `timestamp`, `sts`, `r1c`, `r1p1c`, `r1p2c`, `r1p3c`, `r1p4c`, `r1p5c`, `r2c`, `r2p1c`, `r2p2c`, `r2p3c`, `r2p4c`, `r2p5c`, `r3c`, `r3p1c`, `r3p2c`, `r3p3c`, `r3p4c`, `r3p5c`, `r4c`, `r4p1c`, `r4p2c`, `r4p3c`, `r4p4c`, `r4p5c`, `r5c`, `r5p1c`, `r5p2c`, `r5p3c`, `r5p4c`, `r5p5c`, `r6c`, `r6p1c`, `r6p2c`, `r6p3c`, `r6p4c`, `r6p5c`, `r7c`, `r7p1c`, `r7p2c`, `r7p3c`, `r7p4c`, `r7p5c`, `r8c`, `r8p1c`, `r8p2c`, `r8p3c`, `r8p4c`, `r8p5c`, `r9c`, `r9p1c`, `r9p2c`, `r9p3c`, `r9p4c`, `r9p5c`, `r10c`, `r10p1c`, `r10p2c`, `r10p3c`, `r10p4c`, `r10p5c`, `hv`) VALUES ?";
                    var values1 = [
                        [time, SLN, PType, MACID, SV, AV, ApNme, LOC, ESPV, HB, EC, TRC, CC, EODCC, timestamp, sts, R1C, R1P1C, R1P2C, R1P3C, R1P4C, R1P5C, R2C, R2P1C, R2P2C, R2P3C, R2P4C, R2P5C, R3C, R3P1C, R3P2C, R3P3C, R3P4C, R3P5C, R4C, R4P1C, R4P2C, R4P3C, R4P4C, R4P5C, R5C, R5P1C, R5P2C, R5P3C, R5P4C, R5P5C, R6C, R6P1C, R6P2C, R6P3C, R6P4C, R6P5C, R7C, R7P1C, R7P2C, R7P3C, R7P4C, R7P5C, R8C, R8P1C, R8P2C, R8P3C, R8P4C, R8P5C, R9C, R9P1C, R9P2C, R9P3C, R9P4C, R9P5C, R10C, R10P1C, R10P2C, R10P3C, R10P4C, R10P5C, HV,],
                    ];
                   
                    con.query(sql1, [values1], function (err, result) {
                        
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

            //     //console.log(pt);
            //     var PType = recpack['PType'];
            //     var MACID = recpack['MACID'];
            //     var SLN = recpack['MACID'];
            //     // var HV = recpack['HV'];
            //     var sv = recpack['SV'];
            //     // var LOC = recpack['LOC'];
            //     var ESPV = recpack['ESPV'];
            //     var HB = recpack['HB'];
            //     var TRC = recpack['TRC'];
            //     var R1C = recpack['R1C'];

            //     var R2C = recpack['R2C'];

            //     var R3C = recpack['R3C'];

            //     var R4C = recpack['R4C'];

            //     var R5C = recpack['R5C'];

            //     var R6C = recpack['R6C'];

            //     var R7C = recpack['R7C'];

            //     var R8C = recpack['R8C'];

            //     var R9C = recpack['R9C'];

            //     var R10C = recpack['R10C'];

            //     var timestamp1 = new Date();
            //     var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');
            //     var time = timestamp1.getTime();

            //     con.connect(function (err) {
            //         if (err) {
            //             device.publish(`response/${MACID}`, JSON.stringify({ "SLN": MACID, "timestamp": timestamp, "status": "0" }));
            //             //throw err;
            //         }
            //         // console.log("Connected!");
            //         //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
            //         var sql = "INSERT INTO `epanmachinedata`(`time`, `ptype`, `macid`, `sv`, `hb`, `espv`, `trc`, `r1c`, `r2c`, `r3c`, `r4c`, `r5c`, `r6c`, `r7c`, `r8c`, `r9c`, `r10c`) VALUES ?";
            //         var values = [
            //             [timestamp, PType, MACID, sv, HB, ESPV, TRC, R1C, R2C, R3C, R4C, R5C, R6C, R7C, R8C, R9C, R10C],
            //         ];
                   
            //         con.query(sql, [values], function (err, result) {
            //             //console.log(sql);
            //             // console.log(values);
            //             if (err) {
            //                 //device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "0" }));
            //                 //throw err;
            //             } else {
            //                 //device.publish(`response/${MACID}`, JSON.stringify({ "MACID": MACID, "timestamp": timestamp, "status": "1" }));
            //             }
            //             // if(i==0){

            //             // }
            //             //i++;
            //             // console.log("1 record inserted");
            //         });
            //         var sql1 = "INSERT INTO `rawdata`(`time`, `SLN`, `ptype`, `macid`, `sv`, `av`, `appname`, `location`, `espv`,`hb`, `ec`, `rc`, `cc`, `eodcc`, `timestamp`, `sts`, `r1c`, `r1p1c`, `r1p2c`, `r1p3c`, `r1p4c`, `r1p5c`, `r2c`, `r2p1c`, `r2p2c`, `r2p3c`, `r2p4c`, `r2p5c`, `r3c`, `r3p1c`, `r3p2c`, `r3p3c`, `r3p4c`, `r3p5c`, `r4c`, `r4p1c`, `r4p2c`, `r4p3c`, `r4p4c`, `r4p5c`, `r5c`, `r5p1c`, `r5p2c`, `r5p3c`, `r5p4c`, `r5p5c`, `r6c`, `r6p1c`, `r6p2c`, `r6p3c`, `r6p4c`, `r6p5c`, `r7c`, `r7p1c`, `r7p2c`, `r7p3c`, `r7p4c`, `r7p5c`, `r8c`, `r8p1c`, `r8p2c`, `r8p3c`, `r8p4c`, `r8p5c`, `r9c`, `r9p1c`, `r9p2c`, `r9p3c`, `r9p4c`, `r9p5c`, `r10c`, `r10p1c`, `r10p2c`, `r10p3c`, `r10p4c`, `r10p5c`, `hv`) VALUES ?";
            //         var values1 = [
            //             [time, SLN, PType, MACID, sv, AV, ApNme, LOC, ESPV, HB, EC, TRC, CC, EODCC, timestamp, sts, R1C, R1P1C, R1P2C, R1P3C, R1P4C, R1P5C, R2C, R2P1C, R2P2C, R2P3C, R2P4C, R2P5C, R3C, R3P1C, R3P2C, R3P3C, R3P4C, R3P5C, R4C, R4P1C, R4P2C, R4P3C, R4P4C, R4P5C, R5C, R5P1C, R5P2C, R5P3C, R5P4C, R5P5C, R6C, R6P1C, R6P2C, R6P3C, R6P4C, R6P5C, R7C, R7P1C, R7P2C, R7P3C, R7P4C, R7P5C, R8C, R8P1C, R8P2C, R8P3C, R8P4C, R8P5C, R9C, R9P1C, R9P2C, R9P3C, R9P4C, R9P5C, R10C, R10P1C, R10P2C, R10P3C, R10P4C, R10P5C, HV,],
            //         ];
                   
            //         con.query(sql1, [values1], function (err, result) {
            //               //console.log(sql1);
            //               //console.log(values1);
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
            //mysqli_close(con);

        } 
        // else {
        //     if (recpack['machine']) {

        //         var con = mysql.createConnection({
        //             host: "localhost",
        //             user: "root",
        //             password: "Mukunda@123",
        //             database: "mk_db"
        //         });
        //         //console.log("machinePacket");
        //         var recpack = JSON.parse(payload.toString())
        //         var pack = recpack['machine'];

        //         // echo $pack[0]['Fnlop'];
        //         var time = recpack['time'];
        //         //console.log(time);
        //         var SLN = recpack['sln'];
        //         var PType = pack['pt'];
        //         var MACID = pack['macId'];
        //         var SV = pack['sv'];
        //         var AV = pack['av'];
        //         var ApNme = pack['an'];
        //         var LOC = pack['ln'];
        //         var HB = pack['hb'];
        //         var EC = pack['ec'];
        //         var RC = pack['rc'];
        //         var TRC = pack['rc'];
        //         var CC = pack['ccc'];
        //         var EODCC = pack['ecc'];


        //         var timestamp1 = new Date();
        //         var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss');

        //         var time = timestamp1.getTime();




        //         //console.log(con);
        //         con.connect(function (err) {
        //             if (err) {
        //                 device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
        //                 //throw err;
        //             }
        //             // console.log("Connected!");
        //             //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
        //             var sql = "INSERT INTO `wokiemachinedata`(`time`, `SLN`, `ptype`, `macid`, `sv`, `av`, `appname`, `location`, `hb`, `ec`, `rc`, `cc`, `eodcc`,`timestamp`, `sts`) VALUES ?";
        //             var values = [
        //                 [time, SLN, PType, MACID, SV, AV, ApNme, LOC, HB, EC, RC, CC, EODCC, timestamp, 0],

        //             ];
                  
        //             con.query(sql, [values], function (err, result) {
        //                 //console.log(sql);
        //                 if (err) {
        //                     // device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "0" }));
        //                     //throw err;
        //                 } else {
        //                     //device.publish(`response/${SLN}`, JSON.stringify({ "SLN": SLN, "timestamp": timestamp, "status": "1" }));
        //                 }
        //                 // if(i==0){

        //                 // }
        //                 //i++;
        //                 // console.log("1 record inserted");
        //             });
        //             var sql1 = "INSERT INTO `rawdata`(`time`, `SLN`, `ptype`, `macid`, `sv`, `av`, `appname`, `location`, `espv`,`hb`, `ec`, `rc`, `cc`, `eodcc`, `timestamp`, `sts`, `r1c`, `r1p1c`, `r1p2c`, `r1p3c`, `r1p4c`, `r1p5c`, `r2c`, `r2p1c`, `r2p2c`, `r2p3c`, `r2p4c`, `r2p5c`, `r3c`, `r3p1c`, `r3p2c`, `r3p3c`, `r3p4c`, `r3p5c`, `r4c`, `r4p1c`, `r4p2c`, `r4p3c`, `r4p4c`, `r4p5c`, `r5c`, `r5p1c`, `r5p2c`, `r5p3c`, `r5p4c`, `r5p5c`, `r6c`, `r6p1c`, `r6p2c`, `r6p3c`, `r6p4c`, `r6p5c`, `r7c`, `r7p1c`, `r7p2c`, `r7p3c`, `r7p4c`, `r7p5c`, `r8c`, `r8p1c`, `r8p2c`, `r8p3c`, `r8p4c`, `r8p5c`, `r9c`, `r9p1c`, `r9p2c`, `r9p3c`, `r9p4c`, `r9p5c`, `r10c`, `r10p1c`, `r10p2c`, `r10p3c`, `r10p4c`, `r10p5c`, `hv`) VALUES ?";
        //             var values1 = [
        //                 [time, SLN, PType, MACID, SV, AV, ApNme, LOC, ESPV, HB, EC, TRC, CC, EODCC, timestamp, sts, R1C, R1P1C, R1P2C, R1P3C, R1P4C, R1P5C, R2C, R2P1C, R2P2C, R2P3C, R2P4C, R2P5C, R3C, R3P1C, R3P2C, R3P3C, R3P4C, R3P5C, R4C, R4P1C, R4P2C, R4P3C, R4P4C, R4P5C, R5C, R5P1C, R5P2C, R5P3C, R5P4C, R5P5C, R6C, R6P1C, R6P2C, R6P3C, R6P4C, R6P5C, R7C, R7P1C, R7P2C, R7P3C, R7P4C, R7P5C, R8C, R8P1C, R8P2C, R8P3C, R8P4C, R8P5C, R9C, R9P1C, R9P2C, R9P3C, R9P4C, R9P5C, R10C, R10P1C, R10P2C, R10P3C, R10P4C, R10P5C, HV],
        //             ];
                   
        //             con.query(sql1, [values1], function (err, result) {
        //                 //  console.log(sql);
        //                 //  console.log(values);
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

        //     }
        // }

    });

