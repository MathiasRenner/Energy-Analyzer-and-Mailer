<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/11/15
 * Time: 17:42
 */

include_once "libs/swiftmailer/lib/swift_required.php";

include "CreateCharts.php";
include "CreateHtmlMail.php";

$subject = 'Our MCM Mailing';
$from = array('absender@live.com' =>'Absender');
$to = array(
    'xx.yy@abc.com'  => 'xx'
# ,'recipient2@example2.com' => 'Recipient2 Name'
);


$transport = Swift_SmtpTransport::newInstance('smtp-mail.outlook.com', 587, 'tls');
//$transport->setUsername('xx.yy@live.com');
//$transport->setPassword('xx');

//$transport = Swift_SmtpTransport::newInstance('mail.uni-bamberg.de');

$mailer = Swift_Mailer::newInstance($transport);

$text = "Here you can write plain Text";

// Craete the Charts
$createChart = new CreateCharts();
$createChart->CreateDummyChart();

// Create the message object
$message = new Swift_Message($subject);

// Get all your pictures
$cid = $message->embed(Swift_Image::fromPath('pictures/test.png'));
//$cid2 = $message->embed(Swift_Image::fromPath('dummyXYZ.png'));

// Create the html mail including all pictures
$htmlMailing = new CreateHtmlMail();
$html = $htmlMailing->CreateHTMLMailing($cid);

// build your mail
$message->setFrom($from);
$message->setBody($html, 'text/html');

// furhter infos
$message->setTo($to);
$message->addPart($text, 'text/plain');

print $message->getBody();

//$mysqli = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
//$res = mysqli_query($mysqli, "SELECT * FROM b1user");
//$row = mysqli_fetch_assoc($res);
//echo $row['username'];

// Parameter
//echo $_GET['user'];


// for sending your email
//if ($recipients = $mailer->send($message, $failures)) { echo 'Message successfully sent!'; } else { echo "There was an error:\n"; print_r($failures);}

?>