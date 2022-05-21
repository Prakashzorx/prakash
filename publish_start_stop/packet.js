// Importing express module
const express = require('express');
const app = express();
var bodyParser = require('body-parser');
var cors = require('cors');

app.use(cors());

var awsIot = require('aws-iot-device-sdk');
var mysql = require('mysql');
var response=[];
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
     device.subscribe('machinePacket/+');
     //
   });
 
 device
   .on('message', function(topic, payload) {
    // console.log('message', topic, payload.toString());
     
   
      
        //device.publish(`recipePacket/responce`, JSON.stringify({ test_data_from_bapu : 1}));
       
        var recpack = JSON.parse(payload.toString());
        //console.log(recpack);
        if(recpack['recipe']){
        var pack =recpack['recipe'] ;
        
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
      
     
        var timestamp1 =new Date(mil);
        var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss'); 
       
   
      
   
           var con = mysql.createConnection({
             host: "localhost",
             user: "root",
             password: "Mukunda@123",
             database: "mk_db"
           });
   
           con.connect(function(err) {
             if (err){
              device.publish(`response/${SLN}`, JSON.stringify({"SLN":SLN,"timestamp":timestamp,"status":"0"}));
              //throw err;
             }  
            // console.log("Connected!");
             //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
             var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES ?";
             var values = [
               [time, SLN, PType,MACID,Rcpcry,Rcpnme,rcpstarttime,rcpendtime,Rcpercd,Fnlop,RC,appName,cooktype,timestamp],
               
             ];
             con.query(sql, [values],  function (err, result) {
              // console.log(err);
               if (err){
                device.publish(`response/${SLN}`, JSON.stringify({"SLN":SLN,"timestamp":timestamp,"status":"0"}));
                //throw err;
               } else{
                device.publish(`response/${SLN}`, JSON.stringify({"SLN":SLN,"timestamp":timestamp,"status":"1"}));
               }
               
               //console.log("1 record inserted");
             });
             con.end();
           });

           //mysqli_close(con);
      }else{

        //console.log("machinePacket");
        var recpack = JSON.parse(payload.toString())
        var pack =recpack['machine'] ;
        
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
      
     
        var timestamp1 =new Date(mil);
        var timestamp = date.format(timestamp1, 'YYYY-MM-DD hh:mm:ss'); 
       
   
      
   
           var con = mysql.createConnection({
             host: "localhost",
             user: "root",
             password: "Mukunda@123",
             database: "mk_db"
           });
   
           con.connect(function(err) {
             if (err){
              device.publish(`response/${SLN}`, JSON.stringify({"SLN":SLN,"timestamp":timestamp,"status":"0"}));
              //throw err;
             } 
            // console.log("Connected!");
             //var sql = "INSERT INTO rcpdata( time, SLN, `ptype`, `macid`, `rcptype`, `rcpname`, `rcpstarttime`, `rcpendtime`,`rcpercd`, `finalop`, `rc`,`appname`,`cookingtype`,`timestamp`) VALUES (time, 'SLN', 'PType','MACID','Rcpcry','Rcpnme','rcpstarttime','rcpendtime','Rcpercd','Fnlop',RC,'appName','cooktype','timestamp')";
             var sql = "INSERT INTO `rawdata`(`time`, `SLN`, `ptype`, `macid`, `sv`, `av`, `appname`, `location`, `hb`, `ec`, `rc`, `cc`, `eodcc`,`timestamp`, `sts`) VALUES ?";
             var values = [
               [time, SLN, PType,MACID,SV,AV,ApNme,LOC,HB,EC,RC,CC,EODCC,timestamp,0],
               
             ];
             var i=0;
             con.query(sql, [values],  function (err, result) {
              // console.log(sql);
               if (err){
                device.publish(`response/${SLN}`, JSON.stringify({"SLN":SLN,"timestamp":timestamp,"status":"0"}));
                //throw err;
               } else{
                device.publish(`response/${SLN}`, JSON.stringify({"SLN":SLN,"timestamp":timestamp,"status":"1"}));
               }
              // if(i==0){
               
              // }
              //i++;
              // console.log("1 record inserted");
             });
             con.end();
           });
      }
    
      //mysqli_close(con);

 

   });
 
  
// app.post('/startDevice',async (req, res) => {
//   // Prepare output in JSON format  
//   //console.log(req.body.id); console.log("abc");
//   var i=0;
//   var milliseconds = new Date().getTime();
//   const newLocal = req.body.id;
//   var id = newLocal;


//   var device = awsIot.device({
//     keyPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-private.pem.key',
//    certPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-certificate.pem.crt',
//      caPath: 'cert/AmazonRootCA1.pem',
//    clientId: 'testawsconnection',
//        host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com',
//        //qos:2
//  });

// device
//   .on('connect', function() {
//     //console.log('connect');
//     //device.subscribe(`startDevice/${id}`);
   
//     if(i==0){
//       //device.publish(`startDevice/${id}`, JSON.stringify({"SLN":id,"ms":milliseconds,"STS":"ACTIVATE"}));
//       device.publish(`startDevice/${id}`, JSON.stringify({"SLN":id,"STS":"ACTIVATE"}));
    
//     }
//     i++;
//     device.subscribe(`startDevice/${id}/response`);
   
    
//   });
  
// device
//   .on('message', async function(topic, payload) {
    
//    // console.log('message', topic, payload.toString());
    
//     const response= await result(payload.toString(),topic);
//     //let payl=payload;
//      // console.log(response);
//     // response['msg'] = payload.toString();
//     // console.log(response['msg']);
//     // if(response['msg']==value){
//        res.end(response.toString());
//     // }
    
//   });


//    function result(payload,topic){
//     const response=JSON.parse(payload);
//     //console.log();
//     //var x=response.UPDATE;
//     //console.log(x);
//     if(response.UPDATE==1){
//       return response.UPDATE;
//     }else if(response.UPDATE==0){
//       return response.UPDATE;
//     }
//   }

// })



// app.post('/stopDevice',async (req, res) => {
//   // Prepare output in JSON format  
//   //console.log(req.body.id); console.log("abc");
//   var i=0;
//   var milliseconds = new Date().getTime();
//   const newLocal = req.body.id;
//   var id = newLocal;


//   var device = awsIot.device({
//     keyPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-private.pem.key',
//    certPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-certificate.pem.crt',
//      caPath: 'cert/AmazonRootCA1.pem',
//    clientId: 'testawsconnection',
//        host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com',
//        //qos:2
//  });

// device
//   .on('connect', function() {
//     //console.log('connect');
//     //device.subscribe(`startDevice/${id}`);
   
//     if(i==0){
//       //device.publish(`startDevice/${id}`, JSON.stringify({"SLN":id,"ms":milliseconds,"STS":"ACTIVATE"}));
//       device.publish(`stopDevice/${id}`, JSON.stringify({"SLN":id,"STS":"DEACTIVATE"}));
    
//     }
//     i++;
//     device.subscribe(`stopDevice/${id}/response`);
   
    
//   });
  
// device
//   .on('message', async function(topic, payload) {
    
//    // console.log('message', topic, payload.toString());
    
//     const response= await result(payload.toString(),topic);
//     //let payl=payload;
//      // console.log(response);
//     // response['msg'] = payload.toString();
//     // console.log(response['msg']);
//     // if(response['msg']==value){
//        res.end(response.toString());
//     // }
    
//   });


//    function result(payload,topic){
//     const response=JSON.parse(payload);
//     //console.log();
//     //var x=response.UPDATE;
//     //console.log(x);
//     if(response.UPDATE==1){
//       return response.UPDATE;
//     }else if(response.UPDATE==0){
//       return response.UPDATE;
//     }
//   }

// })



//    app.listen(3000, () => {
//     console.log('Our express server is up on port 3000');
// });