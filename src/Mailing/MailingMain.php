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
include "SingletonSwiftMessage.php";
include "DBAccess.php";

// Parameter
//echo $_GET['user'];

// Init DB and get all relevant db entries
$id = 9; // id will be set from outside
$db = DBAccessSingleton::getInstance($id);
//echo $db->address;
//echo $db->username;

// create all charts
$createChart = new CreateCharts();
$createChart->CreateAllCharts();

// Create the html mail including all pictures + html + style
$htmlMailing = new CreateHtmlMail();
$html = $htmlMailing->CreateHTMLMailing();


// the transport object
// TODO: auf mail.uni.bamberg umstellen
$transport = Swift_SmtpTransport::newInstance('smtp-mail.outlook.com', 587, 'tls');
$transport->setUsername('xx.xx@live.com');
$transport->setPassword('xxx;');
//$transport = Swift_SmtpTransport::newInstance('mail.uni-bamberg.de');

// TODO: Absender anpassen
// TODO: Dynamisch den addressaten abfragen über die db con
$from = array('amphiro@live.com' =>'Amphiro_Absender');
$to = array(
    'xx.xx@gmail.com'  => 'xx'
);

// object for sending the finished mail
$mailer = Swift_Mailer::newInstance($transport);

// Create the message object
$message = SingletonMessage::Instance();

// build your mail
$message->setFrom($from);
$message->setBody($html, 'text/html');

// further infos
$text = "Here you can write plain Text and further infos...";

$message->setTo($to);
$message->addPart($text, 'text/plain');

// display for debug
print $message->getBody();//toString();

// for sending your email
//if ($recipients = $mailer->send($message, $failures)) { echo 'Message successfully sent!'; } else { echo "There was an error:\n"; print_r($failures);}

?>