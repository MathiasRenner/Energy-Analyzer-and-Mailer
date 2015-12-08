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

$subject = 'Our MCM Mailing';
$from = array('absender@live.com' =>'Absender');
$to = array(
    'xx.xx@gmail.com'  => 'xx'
# ,'recipient2@example2.com' => 'Recipient2 Name'
);

$id = 9;
$db = DBAccessSingleton::getInstance($id);
//echo $db->address;
//echo $db->username;

$transport = Swift_SmtpTransport::newInstance('smtp-mail.outlook.com', 587, 'tls');
$transport->setUsername('xx.xx@live.com');
$transport->setPassword('xxx;');

//$transport = Swift_SmtpTransport::newInstance('mail.uni-bamberg.de');

$mailer = Swift_Mailer::newInstance($transport);

$text = "Here you can write plain Text";

// Create the Charts
$createChart = new CreateCharts();
$createChart->CreateDummyChart();

// Create the message object
$message = SingletonMessage::Instance();// new Swift_Message($subject);

// Create the html mail including all pictures
$htmlMailing = new CreateHtmlMail();
$html = $htmlMailing->CreateHTMLMailing();


use Openbuildings\Swiftmailer\CssInlinerPlugin;
require "libs/CssToInlineStyles-master/src/CssToInlineStyles.php";
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
require "libs/swiftmailer-css-inliner-master/src/CssInlinerPlugin.php";



$mailer->registerPlugin(new CssInlinerPlugin());



// create instance
//$cssToInlineStyles = new CssToInlineStyles();

//$css = file_get_contents(__DIR__ . '/mailing.css');
//$html = file_get_contents(__DIR__ . '/MailingDesign.html');
//$cssToInlineStyles->setHTML($html);
//$cssToInlineStyles->setCSS($css);
// output
//$html -> $cssToInlineStyles->convert();

// build your mail
$message->setFrom($from);
$message->setBody($html, 'text/html');

// further infos
$message->setTo($to);
$message->addPart($text, 'text/plain');

print $message->getBody();//toString();


// Parameter
//echo $_GET['user'];

// for sending your email
if ($recipients = $mailer->send($message, $failures)) { echo 'Message successfully sent!'; } else { echo "There was an error:\n"; print_r($failures);}

?>