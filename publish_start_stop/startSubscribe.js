

// Copyright Amazon.com, Inc. or its affiliates. All Rights Reserved.
// SPDX-License-Identifier: MIT-0
var awsIot = require('aws-iot-device-sdk');

//
// Replace the values of '<YourUniqueClientIdentifier>' and '<YourCustomEndpoint>'
// with a unique client identifier and custom host endpoint provided in AWS IoT.
// NOTE: client identifiers must be unique within your AWS account; if a client attempts
// to connect with a client identifier which is already in use, the existing
// connection will be terminated.
//
var device = awsIot.device({
   keyPath: 'cert/7ee4f0599da46d0122974ff1d33eec7e951135f647d9a53e78b403334e9f8999-private.pem.key',
  certPath: 'cert/7ee4f0599da46d0122974ff1d33eec7e951135f647d9a53e78b403334e9f8999-certificate.pem.crt',
    caPath: 'cert/AmazonRootCA1.pem',
  clientId: 'testawsconnection',
      host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com'
});



// // Parse URL-encoded bodies (as sent by HTML forms)
// app.use(express.urlencoded());

// // Parse JSON bodies (as sent by API clients)
// app.use(express.json());

// // Access the parse results as request.body
// app.post('/', function(request, response){
//     console.log(request.body.user.name);
//     //console.log(request.body.user.email);
// });
//
// Device is an instance returned by mqtt.Client(), see mqtt.js for full
// documentation.
//
device
  .on('connect', function() {
    console.log('connect');
    device.subscribe('startMachine/+/start');
   // device.publish('topic_2', JSON.stringify({ test_data_from_bapu : 1}));
  });

device
  .on('message', function(topic, payload) {
    console.log('message', topic, payload.toString());
  });