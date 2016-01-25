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

/* pChart library inclusions */
include("libs/charts/pChart2_1_4/class/pData.class.php");
include("libs/charts/pChart2_1_4/class/pDraw.class.php");
include("libs/charts/pChart2_1_4/class/pImage.class.php");
include("libs/charts/pChart2_1_4/class/pPie.class.php");

/* include all needed files */
include "business/CreateCharts.php";
include "business/CreateHtmlMail.php";
include "business/Calculations.php";
include "business/UtilHelper.php";

include "database/DatabaseAccess.php";

include "ui/HtmlPriming.php";
include "ui/HtmlClassification.php";
include "ui/HtmlDescInj.php";
include "ui/HtmlTimeComp.php";
include "ui/HtmlRecommendations.php";
include "ui/HtmlFooter.php";
include "ui/HtmlSummary.php";
include "ui/HtmlTwitterBadge.php";

// Parameter
//$id = $_GET['user'];

// create the chart object
$createChart = new CreateCharts();
$db = DBAccessSingleton::getInstance();

// Init DB and get all relevant db entries
$db->Init();  // init database

$allUser = array(5); // 3 = B // 5 = F // array(3,6);
//$allUser = $db->getUserIdsWithExtractions();

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
    $css = file_get_contents(__DIR__ . '/ui/mailing.css');
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
      //if ($recipients = $mailer->send($message, $failures)) { echo 'Message successfully sent!

         // write timestamp to database
         $db->WriteTimestampOfMailing($id);

      // } else { echo "There was an error:\n"; print_r($failures);}


}

