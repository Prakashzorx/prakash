// Importing express module
const express = require('express');
const app = express();
var bodyParser = require('body-parser');
var cors = require('cors');

app.use(cors());

var awsIot = require('aws-iot-device-sdk');

var response=[];

// Create application/x-www-form-urlencoded parser
var urlencodedParser = bodyParser.urlencoded({ extended: false })
app.use(express.json());
// console.log(__dirname);
// app.get('/index', (req, res) => {
//   res.sendFile(__dirname + '/index.html');
// });

// app.post('/1233', (req, res) => {
//   console.log(req.body); console.log("abcd");
//   const { username, password } = req.body;
//   const { authorization } = req.headers;
//   res.send({
//     username,
//     password,
//     authorization,
//   });
//   // console.log(username+
//   //   password+
//   //   authorization);
// });

app.post('/startDevice',async (req, res) => {
  // Prepare output in JSON format  
  //console.log(req.body.id); console.log("abc");
  var i=0;
  var milliseconds = new Date().getTime();
  const newLocal = req.body.id;
  var id = newLocal;


  var device = awsIot.device({
    keyPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-private.pem.key',
   certPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-certificate.pem.crt',
     caPath: 'cert/AmazonRootCA1.pem',
   clientId: 'testawsconnection',
       host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com',
       //qos:2
 });

device
  .on('connect', function() {
    //console.log('connect');
    //device.subscribe(`startDevice/${id}`);
   
    if(i==0){
      //device.publish(`startDevice/${id}`, JSON.stringify({"SLN":id,"ms":milliseconds,"sts":"ACTIVATE"}));
      device.publish(`startDevice/${id}`, JSON.stringify({"sts":1}));
    
   }
    i++;
    device.subscribe(`response/${id}`);
   
    
  });
  
device
  .on('message', async function(topic, payload) {
    
   // console.log('message', topic, payload.toString());
   //const response= await result(payload.toString(),topic);
    const response= '1';
    //let payl=payload;
     // console.log(response);
    // response['msg'] = payload.toString();
    // console.log(response['msg']);
    // if(response['msg']==value){
       res.end(response);
    // }
    
  });


   function result(payload,topic){
    const response=JSON.parse(payload);
    //console.log();
    var x=response.sts;
   // console.log(x);
    if(response.sts==1){
      return '1';
    }else if(response.sts==0){
      return '0';
    }
  }

})



app.post('/stopDevice',async (req, res) => {
  // Prepare output in JSON format  
  //console.log(req.body.id); console.log("abc");
  var i=0;
  var milliseconds = new Date().getTime();
  const newLocal = req.body.id;
  var id = newLocal;


  var device = awsIot.device({
    keyPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-private.pem.key',
   certPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-certificate.pem.crt',
     caPath: 'cert/AmazonRootCA1.pem',
   clientId: 'testawsconnection',
       host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com',
       //qos:2
 });

device
  .on('connect', function() {
    //console.log('connect');
    //device.subscribe(`startDevice/${id}`);
   
    if(i==0){
      //device.publish(`startDevice/${id}`, JSON.stringify({"SLN":id,"ms":milliseconds,"sts":"ACTIVATE"}));
      device.publish(`startDevice/${id}`, JSON.stringify({"sts":2}));
    
    }
    i++;
    device.subscribe(`response/${id}`);
   
    
  });
  
device
  .on('message', async function(topic, payload) {
    
   // console.log('message', topic, payload.toString());
   //const response= await result(payload.toString(),topic);
    const response= '1';
    //let payl=payload;
     // console.log(response);
    // response['msg'] = payload.toString();
    // console.log(response['msg']);
    // if(response['msg']==value){
       //res.end(response.toString());
       res.end(response);
    // }
    
  });


   function result(payload,topic){
    const response=JSON.parse(payload);
    //console.log(payload);console.log(topic);
    //var x=response.sts;
   // console.log(x);
    if(response.sts==2){
      return '1';
    }else if(response.sts==0){
      return '0';
    }
  }

})


//var config = require('./config.js');

// var iotData = device;

// console.log(device);

// const handler = (event, context) => {
//   const params = {
//     topic: `startDevice/${id}`,
//     payload: JSON.stringify({"SLN":id,"sts":"ACTIVATE"})
//   }
  
//   iotData.publish(params, (err, res) => {
//     if (err) return context.fail(err);
    
//     console.log(res);
//     return context.succeed();
//   });
// };

// exports.handler = handler;
 
//})

// app.post('/startDevice',(req, res) => {
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
//     console.log('connect');
//     //device.subscribe(`startDevice/${id}`);
//     device.subscribe(`startDevice/${id}/responce`);
//     if(i==0){
//       //device.publish(`startDevice/${id}`, JSON.stringify({"SLN":id,"ms":milliseconds,"sts":"ACTIVATE"}));
//       device.publish(`startDevice/${id}`, JSON.stringify({"SLN":id,"sts":"ACTIVATE"}));
    
//     }
//     i++;
    
//   });
  
// device
//   .on('message', function(topic, payload) {
    
//     //console.log('message', topic, payload.toString());
//     //let payl=payload;
//     response = payload.toString();
//     console.log(payload.toString());
//     res.end(response);
//   });



//})

// app.post('/startDevice',(req, res) => {
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
//     console.log('connect');
//     //device.subscribe(`startDevice/${id}`);
//     device.subscribe(`startDevice/${id}/responce`);
//     //if(i==0){
//       //device.publish(`startDevice/${id}`, JSON.stringify({"SLN":id,"ms":milliseconds,"sts":"ACTIVATE"}));
//       device.publish(`startDevice/${id}`, JSON.stringify({"SLN":id,"sts":"ACTIVATE"}));
    
//     //}
//     i++;
    
//   });
  
// device
//   .on('message', function(topic, payload) {
    
//     //console.log('message', topic, payload.toString());
//     //let payl=payload;
//     response = payload.toString();
//     console.log(payload.toString());
//     res.end(response);
//   });




// app.post('/process_post', urlencodedParser, function (req, res) {
//   // Prepare output in JSON format  
//   console.log(req.body); console.log("ab");
//   response = {
//     first_name: req.body.id,
//     last_name: req.body.password
//   };
//   console.log(response);
//   res.end(JSON.stringify(response));
// })


// var server = app.listen(8000, function () {
//   var host = server.address().address
//   var port = server.address().port

//   console.log("Example app listening at http://%s:%s", host, port)
// })
app.listen(3000, () => {
  //console.log('Our express server is up on port 3000');
});

// // Copyright Amazon.com, Inc. or its affiliates. All Rights Reserved.
// // SPDX-License-Identifier: MIT-0
// var awsIot = require('aws-iot-device-sdk');

// //
// // Replace the values of '<YourUniqueClientIdentifier>' and '<YourCustomEndpoint>'
// // with a unique client identifier and custom host endpoint provided in AWS IoT.
// // NOTE: client identifiers must be unique within your AWS account; if a client attempts
// // to connect with a client identifier which is already in use, the existing
// // connection will be terminated.
// //
// var device = awsIot.device({
//    keyPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-private.pem.key',
//   certPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-certificate.pem.crt',
//     caPath: 'cert/AmazonRootCA1.pem',
//   clientId: 'testawsconnection',
//       host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com'
// });

// //
// // Device is an instance returned by mqtt.Client(), see mqtt.js for full
// // documentation.
// //
// device
//   .on('connect', function() {
//     console.log('connect');
//     //device.subscribe('topic_2');
//     device.publish(`startDevice/${id}/123`, JSON.stringify({ test_data_from_bapu : 1}));
//   });

// device
//   .on('message', function(topic, payload) {
//     console.log('message', topic, payload.toString());
//   });