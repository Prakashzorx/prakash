// Importing express module
const express = require('express');
const app = express();
var bodyParser = require('body-parser');
var cors = require('cors');
const nodemailer = require('nodemailer');
app.use(cors());



var response = [];

// Create application/x-www-form-urlencoded parser
var urlencodedParser = bodyParser.urlencoded({ extended: false })
app.use(express.json());


app.post('/sendmail', async (req, res) => {

  const mail = req.body;
  console.log(mail);
  let mailTransporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
      user: 'mykitchenos.mukundafoods@gmail.com',
      pass: 'Prataps@4891'
    }
  });
  let mailDetails = {
    from: 'mykitchenos.mukundafoods@gmail.com',
    //  to: 'naveen@mukundafoods.com,rakesh@mukundafoods.com',
    //to: req.body.email,
    to: 'bapukhatavi@gmail.com',//'+email+'',
    subject: 'Temerature Over Threshold Warning',
    //html:'<h1>hi</h1>'
    html: '<center><h1 style="color:red">Alert!!!</h1></center><br><br><br><h1 style="color:red">Temperature Over Threshold Warning.</h1><br><h3>Machine Details</h3><h4>IMEI :' + req.body.imei + '</h3><br><h4>At the time :' + req.body.time + '</h3><br><br><h2>Contact System Administrator</h2><br><br><br><h5>Regards,</h5><p>Mukunda Foods Pvt. Ltd.</p><p>naveen@mukundafoods.com</p>'
  };
  mailTransporter.sendMail(mailDetails, function (err, data) {
    if (err) {
      // console.log(err);
    } else {
      response='mail sent';
      res.end(response);
    }
  });
})

app.listen(3232, () => {
  //console.log('Our express server is up on port 3000');
});





