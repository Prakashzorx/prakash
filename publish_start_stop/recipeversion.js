// Importing express module
const express = require('express');
const app = express();
var bodyParser = require('body-parser');
var cors = require('cors');

app.use(cors());

var awsIot = require('aws-iot-device-sdk');

var response = [];
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

app.post('/sendversion', async (req, res) => {
  // Prepare output in JSON format  
  //console.log(req.body); console.log("abc");
  var i = 0;
  //  {
  //   id: '83',
  //   vrversion: 'v1',
  //   heatingtemp: '32',
  //   vtemp1: '123',
  //   vsleeptime: '123',
  //   deepsleep: '123'
  // }

  // var milliseconds = new Date().getTime();
  const id = req.body.id;
  const version = req.body.version;
  const vrversion = version.vrversion;
  const heatingtemp = version.heatingtemp;
  const vtemp1 = version.vtemp1;
  const vsleeptime = version.vsleeptime;
  const deepsleep = version.deepsleep;
  // var id = newLocal;
  //console.log(version);
  //console.log(vrversion);

  var device = awsIot.device({
    keyPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-private.pem.key',
    certPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-certificate.pem.crt',
    caPath: 'cert/AmazonRootCA1.pem',
    clientId: 'testawsconnection',
    host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com',
    //qos:2
  });

  device
    .on('connect', function () {
      //console.log('connect');
      //device.subscribe(`startDevice/${id}`);

      if (i == 0) {
        device.publish(`recipeUpdate/${id}`, JSON.stringify({ "RcpVer": vrversion, "PhT": heatingtemp, "ST": vsleeptime, "STT": vtemp1, "DST": deepsleep }));






        //device.publish(`startDevice/${id}`, JSON.stringify({"sts":1}));

      }
      i++;
      device.subscribe(`response/${id}`);


    });

  device
    .on('message', async function (topic, payload) {

      //console.log('message', topic, payload.toString());
      //const response= await result(payload.toString(),topic);
      const response = '1';
      //let payl=payload;
      // console.log(response);
      // response['msg'] = payload.toString();
      // console.log(response['msg']);
      // if(response['msg']==value){
      //res.end(response.toString());
      res.end(response);
      // }

    });


  function result(payload, topic) {
    const response = JSON.parse(payload);
    //console.log(payload);console.log(topic);
    //var x=response.sts;
    // console.log(x);
    if (response.stat == 2) {
      return '1';
    } else if (response.stat == 0) {
      return '0';
    }
  }

})


app.post('/sendrecipe', async (req, res) => {

  // console.log(req.body); console.log("abc");
  var i = 0;

  // {"version_id":"25","version_name":"v3","recipeidview":"1","recipe_nameview":"noddles",
  // "rct_1v":"24","T1Min_1v":"1","T1Sec_1v":"30","htMin_1v":"2","htSec_1v":"30","T2Min_1v":"3","T2Sec_1v":"30",
  // "rct_2v":"0","T1Min_2v":"0","T1Sec_2v":"0","htMin_2v":"0","htSec_2v":"0","T2Min_2v":"0","T2Sec_2v":"0",
  // "rct_3v":"0","T1Min_3v":"0","T1Sec_3v":"0","htMin_3v":"0","htSec_3v":"0","T2Min_3v":"0","T2Sec_3v":"0",
  // "rct_4v":"0","T1Min_4v":"0","T1Sec_4v":"0","htMin_4v":"0","htSec_4v":"0","T2Min_4v":"0","T2Sec_4v":"0",
  // "rct_5v":"0","T1Min_5v":"0","T1Sec_5v":"0","htMin_5v":"0","htSec_5v":"0","T2Min_5v":"0","T2Sec_5v":"0"}
  const id = req.body.id;
  const version = req.body.version;
  const version_id = version.version_id;
  const version_name = version.version_name;
  const recipeidview = version.recipeidview;
  const recipe_nameview = version.recipe_nameview;
  const rct_1v = version.rct_1v;
  const T1Min_1v = version.T1Min_1v * 60;
  const T1Sec_1v = version.T1Sec_1v;
  const T1_1v = parseInt(T1Min_1v) + parseInt(T1Sec_1v);
  const htMin_1v = version.htMin_1v * 60;
  const htSec_1v = version.htSec_1v;
  const ht_1v = parseInt(htMin_1v) + parseInt(htSec_1v);
  const T2Min_1v = version.T2Min_1v * 60;
  const T2Sec_1v = version.T2Sec_1v;
  const T2_1v = parseInt(T2Min_1v) + parseInt(T2Sec_1v);
  //console.log(T1_1v);

  const rct_2v = version.rct_2v;
  const T1Min_2v = version.T1Min_2v * 60;
  const T1Sec_2v = version.T1Sec_2v;
  const T1_2v = parseInt(T1Min_2v) + parseInt(T1Sec_2v);
  const htMin_2v = version.htMin_2v * 60;
  const htSec_2v = version.htSec_2v;
  const ht_2v = parseInt(htMin_2v) + parseInt(htSec_2v);
  const T2Min_2v = version.T2Min_2v * 60;
  const T2Sec_2v = version.T2Sec_2v;
  const T2_2v = parseInt(T2Min_2v) + parseInt(T2Sec_2v);

  const rct_3v = version.rct_3v;
  const T1Min_3v = version.T1Min_3v * 60;
  const T1Sec_3v = version.T1Sec_3v;
  const T1_3v = parseInt(T1Min_3v) + parseInt(T1Sec_3v);
  const htMin_3v = version.htMin_3v * 60;
  const htSec_3v = version.htSec_3v;
  const ht_3v = parseInt(htMin_3v) + parseInt(htSec_3v);
  const T2Min_3v = version.T2Min_3v * 60;
  const T2Sec_3v = version.T2Sec_3v;
  const T2_3v = parseInt(T2Min_3v) + parseInt(T2Sec_3v);

  const rct_4v = version.rct_4v;
  const T1Min_4v = version.T1Min_4v * 60;
  const T1Sec_4v = version.T1Sec_4v;
  const T1_4v = parseInt(T1Min_4v) + parseInt(T1Sec_4v);
  const htMin_4v = version.htMin_4v * 60;
  const htSec_4v = version.htSec_4v;
  const ht_4v = parseInt(htMin_4v) + parseInt(htSec_4v);
  const T2Min_4v = version.T2Min_4v * 60;
  const T2Sec_4v = version.T2Sec_4v;
  const T2_4v = parseInt(T2Min_4v) + parseInt(T2Sec_4v);

  const rct_5v = version.rct_5v;
  const T1Min_5v = version.T1Min_5v * 60;
  const T1Sec_5v = version.T1Sec_5v;
  const T1_5v = parseInt(T1Min_5v) + parseInt(T1Sec_5v);
  const htMin_5v = version.htMin_5v * 60;
  const htSec_5v = version.htSec_5v;
  const ht_5v = parseInt(htMin_5v) + parseInt(htSec_5v);
  const T2Min_5v = version.T2Min_5v * 60;
  const T2Sec_5v = version.T2Sec_5v;
  const T2_5v = parseInt(T2Min_5v) + parseInt(T2Sec_5v);



  var device = awsIot.device({
    keyPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-private.pem.key',
    certPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-certificate.pem.crt',
    caPath: 'cert/AmazonRootCA1.pem',
    clientId: 'testawsconnection',
    host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com',
    //qos:2
  });

  device
    .on('connect', function () {
      //console.log('connect');
      //device.subscribe(`startDe5ice/${id}`);

      if (i == 0) {
        device.publish(`recipeUpdate/${id}`, JSON.stringify({
          "RcpID": recipeidview,
          "RcpNa": recipe_nameview,
          "RCOT": "" + rct_1v + "-" + rct_2v + "-" + rct_3v + "-" + rct_4v + "-" + rct_5v + "",
          "CT1": "" + T1_1v + "-" + T1_2v + "-" + T1_3v + "-" + T1_4v + "-" + T1_5v + "",
          "HT": "" + ht_1v + "-" + ht_2v + "-" + ht_3v + "-" + ht_4v + "-" + ht_5v + "",
          "CT2": "" + T2_1v + "-" + T2_2v + "-" + T2_3v + "-" + T2_4v + "-" + T2_5v + "",

        }));
        //device.publish(`startDevice/${id}`, JSON.stringify({"sts":1}));

      }
      i++;
      device.subscribe(`response/${id}`);


    });

  device
    .on('message', async function (topic, payload) {

      // console.log('message', topic, payload.toString());
      //const response= await result(payload.toString(),topic);
      const response = '1';
      //let payl=payload;
      // console.log(response);
      // response['msg'] = payload.toString();
      // console.log(response['msg']);
      // if(response['msg']==value){
      //res.end(response.toString());
      res.end(response);
      // }
    });


  function result(payload, topic) {
    const response = JSON.parse(payload);
    //console.log(payload);console.log(topic);
    //var x=response.sts;
    // console.log(x);
    if (response.stat == 2) {
      return '1';
    } else if (response.stat == 0) {
      return '0';
    }
  }

})


app.post('/sendall', async (req, res) => {

  // console.log(req.body); console.log("abc");
  var i = 0;
  var vrversion=0;
  var heatingtemp=0;
  var vtemp1=0;
  var vsleeptime=0;
  var deepsleep=0;

  const idvalue = req.body.idvalue;
  const recipe = req.body.recipe;

  const id = idvalue.id;
  const version = idvalue.version;
console.log(version);
// const version = req.body.version;
 vrversion = version.vrversion;
 heatingtemp = version.heatingtemp;
 vtemp1 = version.vtemp1;
 vsleeptime = version.vsleeptime;
 deepsleep = version.deepsleep;

  // console.log(recipe);
  //var recipearray = JSON.parse(recipe)
  //console.log(recipe[0]);
  var rct_1 = [];
  var rct_2 = [];
  var rct_3 = [];
  var rct_4 = [];
  var rct_5 = [];
  var recipeid = [];
  var recipe_name = [];
  var jsonData = [];


  var total_T1_1 = [];
  var total_HT_1 = [];
  var total_T2_1 = [];

  var total_T1_2 = [];
  var total_HT_2 = [];
  var total_T2_2 = [];

  var total_T1_3 = [];
  var total_HT_3 = [];
  var total_T2_3 = [];

  var total_T1_4 = [];
  var total_HT_4 = [];
  var total_T2_4 = [];

  var total_T1_5 = [];
  var total_HT_5 = [];
  var total_T2_5 = [];

  var x = 0;
  recipe.forEach(element => {
    // console.log(element);

    recipeid[x] = element.recipeid;
    recipe_name[x] = element.recipe_name;

    rct_1[x] = element.rct_1;
    // console.log(rct_1[x]);

    total_T1_1[x] = element.total_T1_1;
    total_HT_1[x] = element.total_HT_1;
    total_T2_1[x] = element.total_T2_1;

    rct_2[x] = element.rct_2;
    total_T1_2[x] = element.total_T1_2;
    total_HT_2[x] = element.total_HT_2;
    total_T2_2[x] = element.total_T2_2;

    rct_3[x] = element.rct_3;
    total_T1_3[x] = element.total_T1_3;
    total_HT_3[x] = element.total_HT_3;
    total_T2_3[x] = element.total_T2_3;

    rct_4[x] = element.rct_4;
    total_T1_4[x] = element.total_T1_4;
    total_HT_4[x] = element.total_HT_4;
    total_T2_4[x] = element.total_T2_4;

    rct_5[x] = element.rct_5;
    total_T1_5[x] = element.total_T1_5;
    total_HT_5[x] = element.total_HT_5;
    total_T2_5[x] = element.total_T2_5;



     jsonData[x] = {  RcpID: recipeid[x],RcpNa: recipe_name[x],RCOT:rct_1[x]+'-' + rct_2[x] + '-' + rct_3[x] + '-' + rct_4[x] + '-' + rct_5[x] ,CT1:total_T1_1[x] + '-' + total_T1_2[x] + '-' + total_T1_3[x] + '-' + total_T1_4[x] + '-' + total_T1_5[x] ,HT:total_HT_1[x] + '-' + total_HT_2[x] + '-' + total_HT_3[x] + '-' + total_HT_4[x] + '-' + total_HT_5[x] ,CT2: total_T2_1[x] + '-' + total_T2_2[x] + '-' + total_T2_3[x] + '-' + total_T2_4[x] + '-' + total_T2_5[x] };
    //jsonData += '"HT": ' + total_HT_1[x] + '-' + total_HT_2[x] + '-' + total_HT_3[x] + '-' + total_HT_4[x] + '-' + total_HT_5[x] + ',';
    //jsonData += '"CT2":' + total_T2_1[x] + '-' + total_T2_2[x] + '-' + total_T2_3[x] + '-' + total_T2_4[x] + '-' + total_T2_5[x] + '},';


    x++;
    // console.log(jsonData);
    //jsonData += jsonData;

  });
 // console.log(jsonData);
// 

  var device = awsIot.device({
    keyPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-private.pem.key',
    certPath: 'cert/efb4ebe9d25aa6558d532d15c004bb7c62bc3ce0042b260f6a9da6d2bc5a6130-certificate.pem.crt',
    caPath: 'cert/AmazonRootCA1.pem',
    clientId: 'testawsconnection',
    host: 'a1bmjgj4h06eyc-ats.iot.ap-south-1.amazonaws.com',
    //qos:2
  });
   
// var obj=0;


    device
      .on('connect', async function () {
        //console.log('connect');
        //device.subscribe(`startDe5ice/${id}`);
//console.log(jsonData)
        if (i == 0) {
         // console.log(jsonData);
         // console.log(JSON.stringify(jsonData));
      device.publish(`recipeUpdate/${id}`, JSON.stringify({	



            "Version Info": [
              {

                "RcpVer": vrversion,
                "PhT": heatingtemp,
                "ST": vtemp1,
                "STT": vsleeptime,
                "DST": deepsleep
              }
            ],

            "Recipe List": jsonData,
            

          }));
          // console.log(jsonData)
          // console.log(JSON. stringify([InfVersiono]))

  // device.publish(`startDevice/${id}`, JSON.stringify({"sts":1}));
 
        }
        i++;
        device.subscribe(`response/${id}`);
        
        
      });
      
      device
      .on('message', async function (topic, payload) {

 console.log('message', topic, payload.toString());
  //         //const response= await result(payload.toString(),topic);
          const response = '1';
  //         //let payl=payload;
  //         // console.log(response);
  //         // response['msg'] = payload.toString();
  //         // console.log(response['msg']);
  //         // if(response['msg']==value){
  //         //res.end(response.toString());
          res.end(response);
          //return response;
          }
          );


       function result(payload,topic){
        const response=JSON.parse(payload);
  //       //console.log(payload);console.log(topic);
  //       //var x=response.sts;
  //      // console.log(x);
        if(response.stat==2){
          return '1';
        }else if(response.stat==0){                                
          return '0';
        }
      }

})

app.listen(3001, () => {
  //console.log('Our express server is up on port 3000');
});