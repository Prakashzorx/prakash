

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
  keyPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-private.pem.key',
 certPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-certificate.pem.crt',
   caPath: 'cert/AmazonRootCA1.pem',
 clientId: 'testawsconnection',
     host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com'
});



//
// Device is an instance returned by mqtt.Client(), see mqtt.js for full
// documentation.
//
device
  .on('connect', function() {
    console.log('connect');
    //device.subscribe('startMachine/+/start');
   device.publish('topic_2', JSON.stringify({ test_data_from_bapu : 1}));
  });

device
  .on('message', function(topic, payload) {
    console.log('message', topic, payload.toString());
  });