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
include "DBAccess.php";
include "UtilHelper.php";

// Parameter
//echo $_GET['user'];

// Init DB and get all relevant db entries
$id = 1; // id will be set from outside
$db = DBAccessSingleton::getInstance();
$db->RunAll($id);  // init database
$db->Update($id);


//foreach ($db->userIdsWithExtractions as $id)
//{
//    $db->Update($id);
//    echo "<br/> ID: " . $id;

// create all charts
    $createChart = new CreateCharts();
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
// TODO: auf mail.uni.bamberg umstellen
//$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
//$transport->setUsername('eesys.mcm.mailer@gmail.com');
//$transport->setPassword('eesys.mcm.mailer1516');
//$transport = Swift_SmtpTransport::newInstance('mail.uni-bamberg.de');

    $transport = Swift_SmtpTransport::newInstance('smtp-mail.outlook.com', 587, 'tls');
    $transport->setUsername('raab.maximilian@live.com');
    $transport->setPassword('6Jv4LmEjzRxXPjr;');
//$transport = Swift_SmtpTransport::newInstance('mail.uni-bamberg.de');


// TODO: Absender anpassen
// TODO: Dynamisch den addressaten abfragen über die db con
    $from = array('eesys.mcm.mailer@gmail.com' => 'Amphiro_Absender');
    $to = array(
        'raab.maximilian@gmail.com' => 'Max Raab'
        //'eesys.mcm.mailer@gmail.com'  => 'our dummy account to send the mail'
        //, $db->email => $db->firstname . ' ' . $db->familyname
    );

// object for sending the finished mail
    $mailer = Swift_Mailer::newInstance($transport);

// Create the message object
    $message = SingletonMessage::Instance();

// build your mail
    $message->setFrom($from);
    $message->setBody($html, 'text/html');

// further infos
    $text = "This is your Amphiro report. Together we can save the planet!";

    $message->setTo($to);
    $message->addPart($text, 'text/plain');


// display for debug
    print $message->getBody();

// for sending your email
//if ($recipients = $mailer->send($message, $failures)) { echo 'Message successfully sent!'; } else { echo "There was an error:\n"; print_r($failures);}


//} // foreach $id
?>
