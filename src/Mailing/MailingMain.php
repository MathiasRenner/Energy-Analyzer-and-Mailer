<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/11/15
 * Time: 17:42
 */

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

require_once 'config.php';
require_once __DIR__ . '/vendor/autoload.php';

include "libs/swiftmailer/lib/swift_required.php";
include "CreateCharts.php";
include "CreateHtmlMail.php";
include "SingletonSwiftMessage.php";
include "DatabaseAccess.php";
include "UtilHelper.php";

// Parameter
//$id = $_GET['user'];

// create the chart object
$createChart = new CreateCharts();
$db = DBAccessSingleton::getInstance();

// Init DB and get all relevant db entries
$db->Init();  // init database

$allUser = array(3); // array(3,6);
//$allUser = $db->userIdsWithExtractions;

foreach($allUser as $id)
{

// set the user db information
$db->Update($id);

// Create the message object
$message = new Swift_Message("This is your Amphiro report. Together we can save the planet!");
UtilSingleton::getInstance()->SetSwiftMailerInstance($message);

// create all charts
$createChart->CreateAllCharts();

// Create the html mail including all pictures + html + style
$htmlMailing = new CreateHtmlMail();
$html = $htmlMailing->CreateHTMLMailing();

// inline css
$cssToInlineStyles = new CssToInlineStyles();
$css = file_get_contents(__DIR__ . '/mailing.css');
$cssToInlineStyles->setHTML($html);
$cssToInlineStyles->setCSS($css);
// output
$html = $cssToInlineStyles->convert();

// the transport object
$transport = Swift_SmtpTransport::newInstance('mail.uni-bamberg.de', 587, 'tls');
$transport->setLocalDomain('[127.0.0.1]');

//TODO: Absender anpassen
$from = array('a@b.com' => 'Your Amphiro Team');
$to = array(
    //, $db->email => $db->firstname . ' ' . $db->familyname
);

// object for sending the finished mail
$mailer = Swift_Mailer::newInstance($transport);

// build your mail
$message->setFrom($from);
$message->setBody($html, 'text/html');

// further infos
//$text = "This is your Amphiro report. Together we can save the planet!";

$message->setTo($to);
//$message->addPart($text, 'text/plain');

// display for debug
print $message->getBody();

// for sending your email
//if ($recipients = $mailer->send($message, $failures)) { echo 'Message successfully sent!'; } else { echo "There was an error:\n"; print_r($failures);}

}
?>
